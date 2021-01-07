<?php session_start();

$_SESSION['username'] = $_SESSION['userinfo']['alias']; 

$siteroot = 'http://' . $_SERVER['HTTP_HOST'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd" >

<html>
<head>
<title>Sample Chat Application</title>
<style>
body {
	background-color: #eeeeee;
	padding:0;
	margin:0 auto;
	font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
	font-size:11px;
}
</style>

<link type="text/css" rel="stylesheet" media="all" href="<?php echo $siteroot.'/lib/css/chat/chat.css'; ?>" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $siteroot.'/lib/css/chat/screen.css'; ?>" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $siteroot.'/lib/css/chat/screen_ie.css'; ?>" />
<![endif]-->
</head>

<body>
<div id="main_container">



<a href="javascript:void(0)" onClick="javascript:chatWith('Hadro')">Chat With Hadro</a>
<a href="javascript:void(0)" onClick="javascript:chatWith('BigMic')">Chat With Big Mic</a>
<!-- YOUR BODY HERE -->

</div>

<script type="text/javascript" src="<?php echo $siteroot.'/lib/js/jquery.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $siteroot.'/lib/js/chat.js'; ?>"></script>

</body>
</html>

