<?php 
 
/***********************************************************************************************
This gets a certian number of user notifications from the database for display on the index page
************************************************************************************************/	
include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); // Include file to set variables used for DB connection
include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB

$query = "	SELECT n.strMessage AS message, UNIX_TIMESTAMP(n.datNoteDate) AS date, (SELECT m.strAlias FROM tblMembers AS m WHERE m.memberID = n.intMemberID) AS name 
			FROM tblNotifications AS n
			WHERE ysnActive = 1
			ORDER BY n.datNoteDate DESC
			LIMIT 10 ";

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

echo '<ul id="notifications">'.$notes.'</ul>';
 
}

include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); // Close the DB connection
?>