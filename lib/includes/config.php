<?php 
//*******************************************************
// BEGIN: New format for config variables...
//*******************************************************
$config = array(
	"db" => array(
		"db1" => array(
			//"host" => "appalabs.com",
			"host" => "localhost",
			"username" => "appalabs",
			"password" => "Wmng2sga!",
			"dbname" => "appalabs_lilcalabria"			
		) 
	),
	"urls" => array(
		"baseurl" => "http://lilcalabria.appalabs.com"
	),
	"paths" => array(
		"resources" => "/resources",
		"images" => array(
			"content" => $_SERVER["DOCUMENT_ROOT"] . "/img/content",
			"layout" => $_SERVER["DOCUMENT_ROOT"] . "/img/layout"
		)
	),
	"email" => array( // default email settings
		"from_name" => "Hadro",
		"from_email" => "bryan@appalabs.com",
		"smtp_mode" => "disabled",
		"smtp_host" => null,
		"smtp_port" => null,
		"smtp_username" => null
	),
	"libs" => array(
		"js" => array(
			"jquery" => "jquery-1.6.1.min.js",
			"jquery.easing" => "jquery.easing-1.3.pack.js",
			"jquery.fancybox" => "jquery.fancybox-1.3.4.js"
		),
		"css" => array(
			"jquery.fancybox" => "jquery.fancybox-1.3.4.css"
		)
	),
	"api" => array(
		"photobucket" => array(
			"username" => "bboru21",
			"password" => "2Wj1twbe",
			"key" => "149831446",
			"private_key" => "7731d4769a3400826eedf4dd01f72372"
		)
	)
);

defined("LIBRARY_PATH")
	or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
	
defined("TEMPLATES_PATH")
	or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

/* Error reporting. */
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);

//*******************************************************
// END: New format for config variables...
//*******************************************************

/*$dbhost = 'localhost';
$dbuser = 'appalabs_admin';
$dbpass = '2wj1twbe.';
$dbname = 'appalabs_lilcalabria';*/

// BEGIN: Configuration settings for PHPMailer

// Email Settings
$site['from_name'] = 'Bryan';
$site['from_email'] = 'bryan@appalabs.com';

// Just in case we need to relay to a different server,
// provide an option to use external mail server.

$site['smtp_mode'] = 'disabled'; // enabled or disabled
$site['smtp_host'] = null;
$site['smtp_port'] = null;
$site['smtp_username'] = null;

// END: Configuration settings for PHPMailer

//*******************************************************
// END: Old values kept to keep old apps from breaking:
//*******************************************************