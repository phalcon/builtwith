/*!
 * A polyfill for object-fit
 *
 * @author: Toni Pinel
 *
 */

;(function (window, document) {
	'use strict';

	var supports = function (){

		var div = document.createElement('div'),
			vendors = 'Khtml Ms O Moz Webkit'.split(' '),
			len = vendors.length;

		return function(prop) {
			if ( prop in div.style ) return true;

			prop = prop.replace(/^[a-z]/, function(val) {
				return val.toUpperCase();
			});

			while(len--) {
				if ( vendors[len] + prop in div.style ) {
					// browser supports box-shadow. Do what you need.
					// Or use a bang (!) to test if the browser doesn't.
					return true;
				}
			}
			return false;
		};
	}();

	var copyComputedStyle = function(from,to){
		var computed_style_object = false;
		//trying to figure out which style object we need to use depense on the browser support
		//so we try until we have one
		computed_style_object = from.currentStyle || document.defaultView.getComputedStyle(from,null);

		//if the browser dose not support both methods we will return null
		if(!computed_style_object) return null;

		var stylePropertyValid = function(name,value){
			//checking that the value is not a undefined
			return typeof value !== 'undefined' &&
						//checking that the value is not a object
					typeof value !== 'object' &&
						//checking that the value is not a function
					typeof value !== 'function' &&
						//checking that we dosent have empty string
					value.length > 0 &&
						//checking that the property is not int index ( happens on some browser
					value != parseInt(value);

		};

		//we iterating the computed style object and compy the style props and the values
		for(var property in computed_style_object)
		{
			//checking if the property and value we get are valid sinse browser have different implementations
			if(stylePropertyValid(property,computed_style_object[property]))
			{
				//applying the style property to the target element
				to.style[property] = computed_style_object[property];

			}
		}

	};

	if ( supports('object-fit') === false ) {

		var oImages = document.querySelectorAll('[data-object-fit]'),
			oDiv, sSource;

		for ( var nKey = 0; nKey < oImages.length; nKey++ ) {

			oDiv = document.createElement('div');

			if (oImages[nKey].getAttribute('data-src-retina')) {
				sSource = oImages[nKey].getAttribute('data-src-retina');
			} else if ( oImages[nKey].getAttribute('data-src')) {
				sSource = oImages[nKey].getAttribute('data-src');
			} else {
				sSource = oImages[nKey].src;
			}

			copyComputedStyle( oImages[nKey], oDiv );

			oDiv.style.display = "block";
			oDiv.style.backgroundImage = "url("+  sSource + ")";
			oDiv.style.backgroundPosition = "center center";
			oDiv.style.className = oImages[nKey].className;
			oDiv.style.backgroundRepeat = "no-repeat";

			switch (oImages[nKey].getAttribute('data-object-fit')) {
				case "cover":
					oDiv.style.backgroundSize = "cover";
					break;
				case "contain":
					oDiv.style.backgroundSize = "contain";
					break;
				case "fill":
					oDiv.style.backgroundSize = "100% 100%";
					break;
				case "none":
					oDiv.style.backgroundSize = "auto";
					break;
			}

			oImages[nKey].parentNode.replaceChild( oDiv, oImages[nKey]);
		}

	}

})(window, document);