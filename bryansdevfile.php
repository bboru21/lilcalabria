<?php	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php');
		global $config; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>lil'Calabria : la Famiglia's Website</title>

    
    <!-- jquery libraries -->
    <script type="text/javascript" src="<?= $config['urls']['baseurl']; ?>/lib/jquery/jquery.1.4.2.min.js"></script>

</head>

<body>

<?php
	
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.credentials.php');

$credentials = new credentials();

$result = $credentials->retrieve('password','bboru21@hotmail.com','bboru21');

echo $result;

?>



</body>
</html>
