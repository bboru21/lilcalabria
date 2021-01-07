<?
session_start();
if($_SESSION['chat']['loggedin']){
	$text = $_POST['text'];
	
	$fp = fopen($_SERVER['DOCUMENT_ROOT']."/chat/log.html", 'a');
	fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['chat']['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
	fclose($fp);
}
?>