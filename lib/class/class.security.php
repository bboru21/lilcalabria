<?php class security {
/**********************************************************************************************************
Security methods for validating information
***********************************************************************************************************/
	
	/************************************************************** 
	For form (array) validation before information is inserted into 
	database; loops through the array given as an argument, and
	returns a clean array if each value is alpha-numeric. Breaks 
	and sends error message if false.
	***************************************************************/
	function validate_username_password($dataArray,$length) {
		
		$clean = array();
		
		foreach($dataArray as $key => $value) {
			
			// trim the value to prevent accidental spaces
			$value = trim($value);
			
			if ($this->alphanumeric($value,$length)) {
				$clean[$key] = $value;				
			}
			else  die("Your $key is incorrect. Please try again.");	
		}
		
		return $clean;
	}
	
	// check string is alphanumeric with exceptions
	function alphanumeric($str,$length) {
		
		$exceptions = '/[\.?!]/';
		
		if (ctype_alnum( preg_replace($exceptions,'',$str) ) && strlen($str) > 0 && strlen($str) <= $length) {
			$result = true;				
		}
		else {  $result = false; }
				
		return $result;
	}
	

	function checkreferer($url1,$url2) {
				
		$length = strlen($url1);
		$result = $url1==substr($url2,0,$length) ? true : die("You do not have permission to view this page!");
				
		return $result;
	}
	
	function getExceptions() {
		return '/[\.?!]/';
	}
}