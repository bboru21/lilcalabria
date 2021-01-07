<?php

class credentials {
	
	var $exceptions = '.?!';
	
	function retrieve($task,$useremail,$value) {
			
		$id = $this->getMemberId($task,$useremail,$value);
			
		if ($id) {
			switch($task) {
				
				case 'username':
								
					$newusername = $this->getNewUserName($id);
					$username = $this->updateUserName($id,$newusername);
					
					$subject = "Notification from lil'Calabria.";
					$message = "Your username has been changed. Your new username is: $username";
					
				break;
				default:				
									
					$newpassword = 	$this->getNewPassword();
					$password = 	$this->updateNewPassword($id,$newpassword);
									
					$subject = "Notification from lil'Calabria.";
					$message = "Your password has been changed. Your new password is: $password";
			}
		}
		
		if (isset($password) || isset($username)) {
								
			$headers = "MIME-Version: 1.0\n" ;
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
			//$headers .= 'To: Bryan Hadro <bhadro@trincon.net>'."\n";
			$headers .= 'From: lil\'Calabria Admin <bryan@appalabs.com>'."\n";
			
			mail($useremail, $subject, $message,$headers);
						
			$result = 1;
		}
		else {
			$result = 0;
		}
		
		return $result;
	}
	
	function getMemberId($task,$email,$value) {
		global $config;
				
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
		
		if ($task == 'username') {
			$query = "SELECT memberid FROM tblMembers WHERE strpassword = ? AND stremail2 = ?";
		}
		else {
			$query = "SELECT memberid FROM tblMembers WHERE strusername = ? AND stremail2 = ?";	
		}
			
		if ($stmt = mysqli_prepare($conn, $query)) {
			mysqli_stmt_bind_param($stmt, "ss", $value,$email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id);
			$row = mysqli_stmt_fetch($stmt);
		} 
			
		if ($row == true) { 
			$result = $id;
		}
		else { 
			$result =  0; 
		}
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
			
		return $result;
	}
	
	function getUserName($id) {
		global $config;
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
		
		$query = "SELECT strusername FROM tblMembers WHERE memberid = ?";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $username);
			$row = mysqli_stmt_fetch($stmt);	
		}
		
		if ($row) { $result = $username; }
		else { $result = 0; }
		
		return $result;
	}
	
	function getNewUserName($id) {
		global $config;
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
		
		$query = "SELECT strfirstname, strlastname FROM tblMembers WHERE memberid = ?";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			/* bind parameters for markers, use letters for every variable you want param
			s = string, i = integer, d = double, b = blob  */
			mysqli_stmt_bind_param($stmt, "i", $id);
		
			/* execute query */
			mysqli_stmt_execute($stmt);
		
			/* bind result variables: after the $stmt, you must have as many variables as you are selecting */
			mysqli_stmt_bind_result($stmt, $fname, $lname);
		
			/* fetch value */
			$row = mysqli_stmt_fetch($stmt);	
		}
		
		if ($row == true) {
			$result =  strtolower( substr($fname,0,1).$lname );
		}  
		else {
			$result = 0;
		}
				
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
	
		return $result;
	}
	
	function updateUserName($id,$username) {
		global $config;
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		
		$query = "UPDATE tblMembers SET strusername = ? WHERE memberid = ?";
		
		if ($stmt = mysqli_prepare($conn,$query)) {
			mysqli_stmt_bind_param($stmt,'si',$username,$id);
			mysqli_stmt_execute($stmt);
		}
			
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
		
		return $this->getUserName($id);
	}
	
	function getPassword($id) {
		global $config;
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		
		$query = "SELECT strpassword FROM tblMembers WHERE memberid = ?";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $password);
			$row = mysqli_stmt_fetch($stmt);	
		}
		
		if ($row == true) {
			$result =  $password;
		}  
		else {
			$result = 0;
		}
				
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
	
		return $result;
	}
	
	function getNewPassword() {
		
		$exceptions = $this->exceptions;
				
		$chars = "abcdefghijkmnopqrstuvwxyz023456789".$exceptions;
		$lid = strlen($chars)-1;
		
		srand((double)microtime()*1000000); 
		$i = 0; 
		$pass = '' ; 
	
		while ($i <= 7) { 
			$num = rand() % $lid; 
			$tmp = substr($chars, $num, 1); 
			$pass = $pass . $tmp; 
			$i++; 
		} 
	
		return $pass;
	} 
	
	function updateNewPassword($id,$password) {
			
		global $config;
					
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
		
		$query = "UPDATE tblMembers SET strpassword = ? WHERE memberid = ?";
		
		if ($stmt = mysqli_prepare($conn,$query)) {
			mysqli_stmt_bind_param($stmt,'si',$password,$id);
			mysqli_stmt_execute($stmt);
		}
			
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
			
		return $this->getPassword($id);
	}
	
	function getAll($id) {
		global $config;
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		
		$query = "SELECT strfirstname, strlastname, strusername, stralias, strpassword, stremail2 FROM tblMembers WHERE memberid = ?";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $fname, $lname, $uname, $alias, $password, $email);
			$row = mysqli_stmt_fetch($stmt);	
		}
		
		if ($row == true) {
			$result = array( 	'fname' => $fname,
								'lname' => $lname,
								'uname' => $uname,
								'alias' => $alias,
								'password' => $password,
								'email' => $email);
		}  
		else {
			$result = 0;
		}
				
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
	
		return $result;
	}
	
	function updateMany($id,$data) {
		
		global $config;
					
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
		
		// create the sql
		$query = 'UPDATE tblMembers SET ';
		foreach($data AS $arr) {
			
			$query .= " " . $arr['name'] . " = '" . $arr['value'] . "',";	
		}
		$query = substr($query, 0, strlen($query)-1); 
		// remove the last thing
		
		$query .= " WHERE intMemberId = ?";
				
		/*if ($stmt = mysqli_prepare($conn,$query)) {
			mysqli_stmt_bind_param($stmt,'i',$id);
			mysqli_stmt_execute($stmt);
		}
			
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
			
		return $this->getPassword($id);*/
		
	} 
}