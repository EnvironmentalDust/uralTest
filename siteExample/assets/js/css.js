// Get IE or Edge browser version
var version = detectIE();

if (version === false) {
	var csslink = document.createElement("link");
    csslink.rel = "stylesheet";
    csslink.type = "text/css";
    csslink.href="assets/css/style.css";
    document.getElementsByTagName("head")[0].appendChild(csslink); 
} else if (version >= 15) {
	var csslink = document.createElement("link");
    csslink.rel = "stylesheet";
    csslink.type = "text/css";
    csslink.href="assets/css/style.css";
	document.getElementsByTagName("head")[0].appendChild(csslink); 
} else {
    var csslink = document.createElement("link");
    csslink.rel = "stylesheet";
    csslink.type = "text/css";
    csslink.href="assets/css/ie.css";
    document.getElementsByTagName("head")[0].appendChild(csslink); 
}

function detectIE() {
	var ua = window.navigator.userAgent;

	var msie = ua.indexOf('MSIE ');
	if (msie > 0) {
		// IE 10 or older => return version number
		return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
	}

	var trident = ua.indexOf('Trident/');
	if (trident > 0) {
		// IE 11 => return version number
		var rv = ua.indexOf('rv:');
		return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
	}

	var edge = ua.indexOf('Edge/');
	if (edge > 0) {
		// Edge (IE 12+) => return version number
		return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
	}

	// other browser
	return false;
}