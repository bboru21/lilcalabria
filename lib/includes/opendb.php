<?php 
 
/* Opens the MYSQL database connection */

/*$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname); */
$conn = mysqli_connect($config['db']['db1']['host'], $config['db']['db1']['username'], $config['db']['db1']['password'], $config['db']['db1']['dbname']);

// check the connection
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>