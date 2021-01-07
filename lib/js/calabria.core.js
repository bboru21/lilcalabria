// ********************************************************************// begin prototype functions// ********************************************************************//   Method: String.prototype.namespace//    simple method to create namespaces////   Usage://  >  'my.super.long.namespace'.namespace();
String.prototype.namespace = function(separator) {  var ns = this.split(separator || '.'), p = window, i, len;
  for (i = 0, len = ns.length; i < len; i++) {    p = p[ns[i]] = p[ns[i]] || {};  }};// ********************************************************************// end prototype functions// ********************************************************************
var debug = function() {
	try {		var i = arguments.length;		while (i--) {			console.log(arguments[0]);		}
	}
	catch(e){
		/* error */
	}
};