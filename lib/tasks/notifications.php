<?php 

// http://net.tutsplus.com/tutorials/other/scheduling-tasks-with-cron-jobs/
// scheduled task so if it's accessed via http request, deny
if (isset($_SERVER['REMOTE_ADDR'])) die('Permission denied.');

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/communication.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/dBug/dBug.php');

include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); 

$query = "SELECT strdescription FROM tblDates WHERE intmonth = ".date('n')." AND intday = ".date('j')." AND ysnannual = 1";

if ($stmt = mysqli_prepare($conn, $query)) {
		
		mysqli_stmt_execute($stmt); // execute the SQL statement 
		
		mysqli_stmt_bind_result($stmt, $description);
		
		$message = 'Just a reminder, today is ';
		while (mysqli_stmt_fetch($stmt)) {
			$message.= $description.'. ';
		}
		
		$message.= 'Ciao ciao!';
		$email = new email();
			 
		$email_array = $email->getAddresses(); // grab and array of email addresses
			
		//foreach ($email_array as $email_address)
		foreach ($email_array as $recipient_name => $recipient_email) {
			$email->Subject = "Today from LilCalabria";
			$email->Body = $message;
			$email->AddAddress($recipient_email, $recipient_name);
			$email->Send();
			
			$email->ClearAddresses();
			$email->ClearAttachments();
		}
		
		mysqli_stmt_close($stmt); // close SQL statement 
}

include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');


$email->Subject = "Scheduled Task Ran";
$email->Body = "Date notifications ran for LilCalabria";
$email->AddAddress("bboru21@hotmail.com", "Bryan");
$email->Send();

$email->ClearAddresses();
$email->ClearAttachments();

/*


        
$query = "SELECT strdescription FROM tblDates WHERE intmonth = ".date('n')." AND intday = ".date('j')." AND ysnannual = 1";

if ($stmt = mysqli_prepare($conn, $query)) {
		
		mysqli_stmt_execute($stmt); // execute the SQL statement 
		
		mysqli_stmt_bind_result($stmt, $description);
						
		while (mysqli_stmt_fetch($stmt)) {
			echo $description . '<br />';
		}
									
		mysqli_stmt_close($stmt); // close SQL statement 
		

		$email = new email();
			 
		$email_array = $email->getAddresses($senderid); // grab and array of email addresses
			
		//foreach ($email_array as $email_address)
		foreach ($email_array as $recipient_name => $recipient_email) {
			$email->Subject = $subject;
			$email->Body = $message;
			$email->AddAddress($recipient_email, $recipient_name);
			$email->Send();
			
			$email->ClearAddresses();
			$email->ClearAttachments();
		}


}

   
include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); */
			
