<?php session_start();
		
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); // Grab our config settings
global $config;

// check referer
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.security.php');
$security = new security();
$security->checkreferer($config['urls']['baseurl'], $_SERVER['HTTP_REFERER']);

// insert the message
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.messageboard.php');
$mb = new post();
$message = $_POST['message'];
$result = $mb->insert($message);

if ($result) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/communication.php');
	 
	// recently been changed for approval purposes
	
	$subject = $_SESSION['userinfo']['alias'] . ' has just posted a new message!';
	$message = $_SESSION['userinfo']['alias'] . ' has just posted a message at '.$config['urls']['baseurl'].'!';
	 
	/*$email = new email();
	 
	$senderid = $_SESSION['userinfo']['id']; // current member id, sent to exclude this member from the email list
		
	$email_array = $email->getAddresses($senderid); // grab and array of email addresses
	
	foreach ($email_array as $recipient_name => $recipient_email) {
		
		if ($recipient_email != '') {
			// comment out old email code until i can update headers
			//$email->Subject = $subject;
			//$email->Body = $message;
			//$email->AddAddress($recipient_email, $recipient_name);
			//$email->Send();
			
			//$email->ClearAddresses();
			//$email->ClearAttachments();
			
			$headers = "MIME-Version: 1.0\n" ;
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
			//$headers .= 'To: Bryan Hadro <bhadro@trincon.net>'."\n";
			$headers .= 'From: lil\'Calabria Admin <bryan@appalabs.com>'."\n";
			
			mail($recipient_email, $subject, $message, $headers);
		}
	}*/
		
	// insert a notification for display on Recent Activity
	$message = 'posted a new message.';
	$memberid = $_SESSION['userinfo']['id'];
		
	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.notifications.php');
	$note = new notifications();
	$note->insert($message,$memberid);
	
	header('location:'.$config['urls']['baseurl'].'/index.php'); // Relocate to the mainpage
}
else die( "An error has occured. Please hit your back button and try again." );