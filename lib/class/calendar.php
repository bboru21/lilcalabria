<?php 
/**********************************************************************************************************
Collection of Date methods
***********************************************************************************************************/

class dates {

	/******************************************************************************************************
	Pass the month, Returns an array of all the date & description
	******************************************************************************************************/
	function getAnnualDates($month,$include_path) {
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); // Include file to set variables used for DB connection
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
		
		$query = "	SELECT strDescription, intDay 
					FROM tblDates
					WHERE intMonth = ?";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			
			/* bind parameters for markers, use letters for every variable you want paramed
			s = string, i = integer, d = double, b = blob  */
		   mysqli_stmt_bind_param($stmt, "i", $val1);
		   $val1 = $month;
		
			/* execute query */
			mysqli_stmt_execute($stmt);
		
		   
			mysqli_stmt_bind_result($stmt, $desc, $day);
			
			$dateArray = array();
			while (mysqli_stmt_fetch($stmt)) {
				$dateArray[$day] = $desc; 
			}
		}
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); // Close the DB connection
	
	return $dateArray;
		
	}

}

?>