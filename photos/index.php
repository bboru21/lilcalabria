<?php	session_start();
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/header.php');
?>


<?php 
// http://oauth.net/core/1.0/
// http://pic.photobucket.com/dev_help/WebHelpPublic/Content/Getting%20Started/Consumer%20Authentication.htm

$consumer_key = $config['api']['photobucket']['key'];
$consumer_secret = $config['api']['photobucket']['private_key'];
//$ts = gmmktime(0, 0, 0, 1, 1, 1970);


//$url = "http://api123.photobucket.com/album/bboru21?format=xml&oauth_consumer_key=149831446&page=1&paginated=true&perpage=5";

//$response = file_get_contents($url);
//echo $response; 

?>




<?php include($_SERVER['DOCUMENT_ROOT']."/lib/includes/footer.php"); ?>