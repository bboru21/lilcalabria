<?php 

if (sizeof($_GET)>0) {
	$classpath = $_GET['classpath'];
	$method =  $_GET['method'];
}
else if (sizeof($_POST)>0) {
	$classpath = $_POST['classpath'];
	$method =  $_POST['method'];
}
else {
	exit('Error: No valid parameters found. Process aborted.');
}
 
switch($method) {
	case 'alphanumeric':
	 
	require_once($_SERVER['DOCUMENT_ROOT'].$classpath);
	$obj = new security();
	
	$data = $obj->alphanumeric($_GET['str'],255);
	
	echo json_encode($data);
	 
	break;
	
	case 'getExceptions':
		require_once($_SERVER['DOCUMENT_ROOT'].$classpath);
		$obj = new security();
	
		$data = $obj->getExceptions();
	
		echo json_encode($data);
	break;
	
	case 'retrieve':
		
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); 
				
		$task = $_GET['task'];
		$email = $_GET['email'];
		$value = $_GET['value'];
			
		require_once($_SERVER['DOCUMENT_ROOT'].$classpath);
		$credentials = new credentials();
		
		$data = $credentials->retrieve($task,$email,$value);
		
		echo json_encode($data);
	
	break;
	
	case 'updateMany':
		$id = $_POST['id'];
		$arr = $_POST['values'];
	
		require_once($_SERVER['DOCUMENT_ROOT'].$classpath);
		$credentials = new credentials();
		
		$data = $credentials->updateMany($id,$arr);
	
	break;
}
?>