<?php 
/**********************************************************************************************************
Collection of Communication methods
***********************************************************************************************************/

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/phpmailer/class.phpmailer.php');
 
class email extends PHPMailer {
 
	var $priority = 3;
    var $to_name;
    var $to_email;
    var $From = null;
    var $FromName = null;
    var $Sender = null;

	function FreakMailer()
    { 
        global $site;

        // Comes from config.php $site array

        if($site['smtp_mode'] == 'enabled')
        {
            $this->Host = $site['smtp_host'];
            $this->Port = $site['smtp_port'];
            if($site['smtp_username'] != '')
            {
                $this->SMTPAuth = true;
                $this->Username = $site['smtp_username'];
                $this->Password = $site['smtp_password'];
            }
            $this->Mailer = "smtp";
        }
        if(!$this->From)
        {
            $this->From = $site['from_email'];
        }
        if(!$this->FromName)
        {
            $this-> FromName = $site['from_name'];
        }
        if(!$this->Sender)
        {
            $this->Sender = $site['from_email'];
        }
        $this->Priority = $this->priority;
    }

	/******************************************************************************************************
	Pass the sender's ID and the include path (in order to be able to connect to the DB via the DB 
	includes); returns a numeric array of all member emails except for the senders, which can be looped 
	over to send emails. 
	******************************************************************************************************/
	function getAddresses($senderid = null) {
				
		if (!isset($senderid)) {
			$senderid = 0;
		}
				
		//global $dbhost, $dbuser, $dbpass, $dbname;
		global $config;
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
		
		$query = "SELECT	CASE
							WHEN strEmail1 = ''
							THEN strEmail2
							ELSE strEmail1
						END AS email, strFirstName AS firstname, strLastName AS lastname 
				FROM tblMembers 
				WHERE intAdmin > 0 AND memberID != ?";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			 
			mysqli_stmt_bind_param($stmt,"i",$val1);
			$val1 = $senderid;
														
			mysqli_stmt_execute($stmt); // execute the SQL statement 
			
			mysqli_stmt_bind_result($stmt, $email, $firstname, $lastname);
			
			
			$email_array = array();
			while (mysqli_stmt_fetch($stmt)) {
				
				$user = $firstname.' '.$lastname;
				$email_array[$user] = $email;
			}
			
			mysqli_stmt_close($stmt); // close SQL statement 
		}
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); // close the DB connection 	
		
	return $email_array;
	}
	
	/************************************************************** 
	Takes the email address, subject and message and sends out the
	email to the member. Returns true.
	***************************************************************/
	/*function notifyMembers($email,$subject,$message) {
		
		$to = $email;
		$subject = $subject;
		$today = date('m/d');
		$message = $message; // The message
		$message = wordwrap($message, 70); // In case any of our lines are larger than 70 characters, we should use wordwrap()
		$headers = 'From: lafamiglia@lilcalabria.com'."\r\n".'Reply-To: admin@lilcalabria.com';
		mail($to, $subject, $message, $headers); 
				
		$success = true;	
		
	return $success; 		
	}*/
}
?>