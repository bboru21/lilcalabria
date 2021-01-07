<?php session_start();

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); // Grab our config settings
global $config;

// check referer
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.security.php');
$security = new security();
$security->checkreferer($config['urls']['baseurl'], $_SERVER['HTTP_REFERER']);

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/communication.php');

include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
			
// prepare insert statement

$query = "	INSERT INTO tblBasementQuotes (strQuote, strCaption, datDateCreated, intCreatedBy, ysnActive)
			VALUES ( ?, ?, ?, ?, 1 )";
			
if ($stmt = mysqli_prepare($conn, $query)) {
	
	mysqli_stmt_bind_param($stmt,"sssi",$val1, $val2, $val3, $val4); // bind parameters; s = string, i = integer, d = double, b = blob 
					
	$val1 = $_POST['quote']; // set variable values
	$val2 = $_POST['caption'];
	$val3 = date('Y-m-d H:i:s A');
	$val4 = $_SESSION['userinfo']['id'];
	 																					
	mysqli_stmt_execute($stmt); // execute the SQL statement 
					
	mysqli_stmt_close($stmt); // close SQL statement 
	  	
	include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); // close the DB connection 
	 
	// insert a notification for display on Recent Activity
	$message = ' posted a new basement quote.';
	$memberid = $_SESSION['userinfo']['id'];
		
	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.notifications.php');
	$note = new notifications();
	$note->insertNote($message,$memberid);	

}
else {
	exit('An error has occured. Please hit your back button.');
}

header('location: '.$config['urls']['baseurl'].'/history/'); 
?>