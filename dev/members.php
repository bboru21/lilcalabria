<?php 

	
	function get_members() {
		
		$returnArray = array();
		
		include($_SERVER['DOCUMENT_ROOT'] . '/lib/includes/config.php'); // Include file to set variables used for DB connection
		include($_SERVER['DOCUMENT_ROOT'] . '/lib/includes/opendb.php'); // Connect to the DB
		
		$query = "	SELECT strUserName
					FROM tblMembers
				";
				
				
		if ($stmt = mysqli_prepare($conn, $query)) {
					
			mysqli_stmt_execute($stmt); // execute the SQL statement 
			
			mysqli_stmt_bind_result($stmt, $id);
			
			$results = array();
			$i = 1;
			while (mysqli_stmt_fetch($stmt)) {
				$results[$i] = $id;
				$i++;
			}
			
			$returnArray['results'] = $results;
						
			mysqli_stmt_close($stmt); // close SQL statement 
			
			$returnArray['success'] = true;						
		}
		else {
			$returnArray['success'] = false;	
		}
		
		include($_SERVER['DOCUMENT_ROOT'] . '/lib/includes/closedb.php'); // close the DB connection 	
	
		
	return $returnArray;
	} 