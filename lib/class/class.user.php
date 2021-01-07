<?php class user {
	
	function check() {
	
		global $config;
	
		if (!isset($_SESSION['userinfo']['loggedin'])) $_SESSION['userinfo']['loggedin'] = false;
		if (!$_SESSION['userinfo']['loggedin']) header('location:'.$config['urls']['baseurl'].'/login/index.php?status=login');
	}
	
	function login($username, $password) {
		
		global $config;
				
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB

		$query = "	SELECT memberID, strAlias, intAdmin
					FROM tblMembers 
					WHERE	strUserName = ?
					AND strPassword = ? ";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			/* bind parameters for markers, use letters for every variable you want param
			s = string, i = integer, d = double, b = blob  */
			mysqli_stmt_bind_param($stmt, "ss", $username, $password);
		
			/* execute query */
			mysqli_stmt_execute($stmt);
		
			/* bind result variables: after the $stmt, you must have as many variables as you are selecting */
			mysqli_stmt_bind_result($stmt, $memberid, $alias, $adminlevel);
		
			/* fetch value */
			$row = mysqli_stmt_fetch($stmt);
		 
		} 
		
		if ($row == true) {
			$_SESSION['userinfo']['alias'] = $alias;
			$_SESSION['userinfo']['id'] = $memberid;
			$_SESSION['userinfo']['adminlevel'] = $adminlevel;
			$_SESSION['userinfo']['loggedin'] = true;
				
			$result = true;
		}
		else { 
			session_unset(); 
			$result = false;
		}
		
		// Close the DB connection
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
		
		return $result;
	}
}