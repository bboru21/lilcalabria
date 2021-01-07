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
 
$query = "	INSERT INTO tblTerminology (Title, Description, CreatedBy, CreatedDate, EditedBy, EditedDate, Active)
			VALUES ( ?, ?, ?, ?, ?, ?, 1 )";
			
if ($stmt = mysqli_prepare($conn, $query)) {
	
	mysqli_stmt_bind_param($stmt,"ssisis",$val1, $val2, $val3, $val4, $val5, $val6); // bind parameters; s = string, i = integer, d = double, b = blob 
					
	$val1 = $_POST['title']; // set variable values
	$val2 = $_POST['description'];
	$val3 = $_SESSION['userinfo']['id'];
	$val4 = date('Y-m-d H:i:s A');
	$val5 = $_SESSION['userinfo']['id'];
	$val6 = date('Y-m-d H:i:s A'); 
	 																					
	mysqli_stmt_execute($stmt); // execute the SQL statement 
					
	mysqli_stmt_close($stmt); // close SQL statement 
	  	
	include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); // close the DB connection 
	 
	// insert a notification for display on Recent Activity
	$message = ' posted new basement terminology.';
	$memberid = $_SESSION['userinfo']['id'];
		
	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/notifications.php');
	$note = new notifications();
	$note->insertNote($message,$memberid);	

}
else {
	exit('An error has occured. Please hit your back button.');
}

header('location: '.$config['urls']['baseurl'].'/history/'); 
?>