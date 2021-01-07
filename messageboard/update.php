<?php 

include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');

$query = " UPDATE tblMessageBoard SET strMessage = ? WHERE postID = ?";
			
if ($stmt = mysqli_prepare($conn, $query)) {
	
	mysqli_stmt_bind_param($stmt,"si",$post,$postid); 
	
	$postid = $_POST['postid'];
	$post = $_POST['post'];
		 																					
	mysqli_stmt_execute($stmt); 
					
	mysqli_stmt_close($stmt);
	  	
	include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');

}