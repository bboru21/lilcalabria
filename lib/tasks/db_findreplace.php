<?php 
/*******************************************************************************************************************
This file is used for mass database find and replaces. Yes I know that mysql_connect is less secure than 
mysqli_connect(), but bound variables make this application a pain in the butt so... be happy with what it is - BeH
********************************************************************************************************************/
// exp_templates
// exp_weblog_data
$tableName = 'tblmessageboard'; // the table we're selecting from
$idCol = 'postID'; // the identity column of the table
$pattern = "/\\\'/"; // regular expression pattern we're looking for, here it would match 'ABCD'... see Regular Expression
$replaceThis = "\'"; // what you want to replace within the pattern string match, in this case "BC" 
$withThis = "&#39;"; // what you want to replace "$replaceThis" with, in this case "xx"... thus the string would now be 'AxxD'  

$testMode = true; // if true, will generate the SQL that will be used without execution; if false it will run the update query

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/dBug/dBug.php');

function left($str, $length) {
	return substr($str, 0, $length);
}

function right($str, $length) {
	return substr($str, -$length);
}

/* function getDir($str) {
	if ($str == 'FF00') { $folder_name = 'ff_00_01'; }
	//else if ($str == 'FF01') { $folder_name = 'ff_00_02'; }
	else if ($str == 'FF01') { $folder_name = 'ff_01_02'; }
	else if ($str == 'FF02') { $folder_name = 'ff_02_03'; }
	else if ($str == 'FF03') { $folder_name = 'ff_03_04'; }
	else if ($str == 'FF04') { $folder_name = 'ff_04_05'; }
	else if ($str == 'FF05') { $folder_name = 'ff_05_06'; }
	else if ($str == 'FF06') { $folder_name = 'ff_06_07'; }
	else if ($str == 'FF98') { $folder_name = 'ff_98_99'; }
	else if ($str == 'FF99') { $folder_name = 'ff_99_00'; }
	
	return $folder_name;
} */
	
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php');
	global $config;
		
	$dbhost = $config['db']['db1']['host'];
	$dbuser = $config['db']['db1']['username'];
	$dbpass = $config['db']['db1']['password'];
	$dbname = $config['db']['db1']['dbname'];
	
	$con = mysql_connect($dbhost,$dbuser,$dbpass);
	if (!$con) {
	  die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db($dbname, $con);
				
	$query = "SELECT * FROM ".$tableName; // our initial SQL query that we'll search through
	$result = mysql_query($query);
	
	// default variables we need before we loop
	$querySQL = '';	 // set query SQL to blank
	$queryArray = array(); // create an array, we'll store each update query here
	$q = 1; // query array index incremented everytime we loop
	
	// loop and create the UPDATE SQL			
	while($row = mysql_fetch_array($result)){
	  
	  	$addSQL = false; // if "true" by the end, that means we found matches and there is SQL that must be run
		$thisSQL = ''; // part of the sql statement that will be added to the $querySQL statement later
		
		// loop through the result query, looking for the pattern within each column...		
 		foreach($row as $colName => $data) {
			if (!is_numeric($colName)) {  
				// if a match is found, if dumps the string into a $strArray, which we use to update the old value with a new one, then find and replace the old value in the overall $data string with the new value
				if (preg_match_all($pattern, $data, $strArray)) {
	 					for ($i=0; $i < sizeof($strArray[0]); $i++) {
							$oldValue = $strArray[0][$i];
							//$folder_name = getDir(substr($oldValue,6,4));
														
							//$newValue = str_replace('href="','href="/pdf/facts_figures/'.$folder_name.'/',$oldValue);
							// this is where you use the $replaceThis and $withThis variables
							$newValue = str_replace($replaceThis,$withThis,$oldValue);							
														
							$data = str_replace($oldValue,$newValue,$data);
						}
					$thisSQL = $thisSQL." ".$colName." = '".addslashes($data)."',"; //$thisSQL = $thisSQL." field_id_1 = '".addSlashes($field_id_1)."',";
					$addSQL = true; // indicate what we have some SQL to run...
				}
			}
		}
	
		if ($addSQL) { 
			$length = strlen($thisSQL);
			// left() is a UDF to mimic ColdFusion
			$thisSQL = left($thisSQL, $length-1);
			// combine each update statement
			$thisSQL = " UPDATE ".$tableName." SET ".$thisSQL." WHERE ".$idCol." = ".$row[$idCol];
			$queryArray[$q] = $thisSQL; // add SQL to array
			$q++; // increment the index of the queryArray
		} 
		
	}
	
	mysql_close($con);
	
	if ($testMode) {
		/* DISPLAY THE SQL */
		echo '	<p>QUERY IS NOT BEING RUN<br />
				View the source and remove this paragraph if you wish to use the SQL.	
				</p>';	
		for ($i=1; $i<= sizeof($queryArray); $i++) {
			$query = $queryArray[$i];
			echo $query;
		}
	}
	else {
		
		/* RUN UPDATE QUERY */
		echo '	<p>QUERY IS BEING RUN:
				View the source and remove this paragraph if you wish to use the SQL.
				</p>';		
		 for ($i=1; $i<= sizeof($queryArray); $i++) {
					
			$con = mysql_connect($dbhost, $dbuser, $dbpass);
	
			if (!$con) {
			die('Could not connect: ' . mysql_error());
			 }
				
			mysql_select_db($dbname, $con); 
			
			$query = $queryArray[$i];
			echo $query;
			$result = mysql_query($query);
			
			mysql_close($con);  
		}  
	}
?>