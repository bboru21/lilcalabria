<?php 	session_start(); // allow use of session variables
		session_destroy(); // destroy session variables
		header('location: index.php?status=loggedout'); // relocate to login page and indicate successful logout
?> 