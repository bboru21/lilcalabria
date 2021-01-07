<?php	session_start();  

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); // Include file to set variables used for DB connection
global $config;

// check referer
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.security.php');
$security = new security();
$security->checkreferer($config['urls']['baseurl'], $_SERVER['HTTP_REFERER']);

$arr = array('username'=> $_POST['username'], 'password' => $_POST['password']);
$clean = $security->validate_username_password($arr, 255);

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.user.php');
$user = new user();
$result = $user->login($clean['username'], $clean['password']);

// if true, relocate to main page
if ($result)	header('location:'.$config['urls']['baseurl'].'/index.php'); // Relocate to the mainpage
// if false, relocate to login page
else 			header('location:'.$config['urls']['baseurl'].'/login/index.php?status=incorrect');
