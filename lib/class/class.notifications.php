<?php 
class notifications {
	
	function init($number) {
		
		global $config;
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
		
		$query = "	SELECT n.strMessage AS message, UNIX_TIMESTAMP(n.datNoteDate) AS date, (SELECT m.strAlias FROM tblMembers AS m WHERE m.memberID = n.intMemberID) AS name 
					FROM tblNotifications AS n
					WHERE ysnActive = 1
					ORDER BY n.datNoteDate DESC
					LIMIT ".$number." ";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			/* bind parameters for markers, use letters for every variable you want paramed
			s = string, i = integer, d = double, b = blob  */
		   // mysqli_stmt_bind_param($stmt, "ss", $username, $password);
		
			/* execute query */
			$result = mysqli_stmt_execute($stmt);
		
			/* bind result variables: after the $stmt, you must have as many variables as you are selecting */
			mysqli_stmt_bind_result($stmt, $message, $date, $name);
		
			/* fetch value(s) */
			$notes = '';
			while (mysqli_stmt_fetch($stmt)) {
				$date = date('n/d/y g:i A',$date);
				$notes =  $notes . '<li><b>' . $name . '</b> ' . $message . ' ('. $date . ')' . '</li>'; 
			}
		
			$result = $notes;	 
		}
		else $result = false;
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); // Close the DB connection
		
		return $result;
	}
	
	/******************************************************************************************************
	Pass the sender's ID and the include path (in order to be able to connect to the DB via the DB 
	includes); returns a numeric array of all member emails except for the senders, which can be looped 
	over to send emails. 
	******************************************************************************************************/
	function insert($message,$memberid) {
		
		global $config;
		
		include($_SERVER['DOCUMENT_ROOT'] . '/lib/includes/opendb.php'); // Connect to the DB
		
		$query = "	INSERT INTO tblNotifications (strMessage, intMemberID, datNoteDate)
					VALUES (?, ?, ?)";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			
			mysqli_stmt_bind_param($stmt,"sis",$val1,$val2,$val3);
			
			$val1 = $message;
			$val2 = $memberid; 
			$val3 = date('Y-m-d H:i:s A'); // YYYY-MM-DD HH:mm:SS 
															
			mysqli_stmt_execute($stmt); // execute the SQL statement 
			
			//mysqli_stmt_bind_result($stmt, $email);
			
			//$i = 1;
			//$emailArray = array();
			//while (mysqli_stmt_fetch($stmt)) {
				//$emailArray[$i] = $email;
				//$i++;	
			//}
			
			mysqli_stmt_close($stmt); // close SQL statement 
			
			$success = true;
		}
		else {
			$success = false;
		}
		
		include($_SERVER['DOCUMENT_ROOT'] . '/lib/includes/closedb.php'); // close the DB connection 	
	
		
	return $success;
	} 
}
?>