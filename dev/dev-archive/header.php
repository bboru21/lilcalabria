<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	
	$siteroot = 'http://'.$_SERVER['HTTP_HOST'];
	
	if ($_SESSION['LoggedIn'] != "yes") { 
		header('location: ' . $siteroot . '/login/index.php?login=none'); 
	}
	
	$_SESSION['username'] = $_SESSION['userinfo']['alias']; 
?> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>lil'Calabria : la Famiglia's Website</title>
<link rel="stylesheet" type="text/css" href="/lib/css/stylesheet.css" />

<!-- chat -->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $siteroot.'/lib/css/chat/chat.css'; ?>" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $siteroot.'/lib/css/chat/screen.css'; ?>" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo $siteroot.'/lib/css/chat/screen_ie.css'; ?>" />
<![endif]-->
<!-- chat -->

<?php 
	/*
	
	*/

	//$randNum = rand(1,2);
	//if ($randNum == 1) { echo '<link rel="stylesheet" type="text/css" href="/lib/css/green.css" />'; }
	
	// echo green spreadsheet for St. Patrick's day week
	if ( date('m') == 3 && date('d') > 11 && date('d') < 19 ) {
		echo '<link rel="stylesheet" type="text/css" href="/lib/css/green.css" />';
	}
?>
<script type="text/javascript" src="<?php echo $siteroot.'/lib/js/main.js'; ?>" language="javascript">/* Main javascript library for entire site */</script>
<script type="text/javascript" src="<?php echo $siteroot.'/lib/js/jquery.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $siteroot.'/lib/js/chat.js'; ?>"></script>
 
</head>

<body>
<!--<object width="190" height="93"><param name="movie" value="http://www.lost4815162342.com/flash/countdownmini.swf"></param><param name="wmode" value="transparent"></param><embed src="http://www.lost4815162342.com/flash/countdownmini.swf" type="application/x-shockwave-flash" width="190" height="93" wmode="transparent"></embed></object> -->
<table cellpadding="0" cellspacing="0" width="800" align="center">
<tr>
<td>
<?php include($siteroot.'/includes/nav_bar.php'); ?>
<br />

<table cellpadding="0" cellspacing="0" id="body" style="background-image:url(http://www.lilcalabria.com/images/site/paper_background.gif);">
	<tr>
		<td id="side">&nbsp;</td>
	  	<td colspan="5" align="center">
			<img src="http://www.lilcalabria.com/images/header1.png" />		</td>
		<td id="side">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="5" align="center">
			<span style="font-size:10px; font-style:italic;">"Do you spend time with your family? ...Good.  Because a man that doesn't spend time with his family can never be a real man" --Vito Corleone</span><br />
			<hr size="1" color="#333333" width="100%" /></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
			<td align="left"><?php echo 'Ciao ' . $_SESSION['userinfo']['alias'] . '!'; ?> <a href="/login/logout.php" style="font-size:10px;">Logout</a> | <a href="/login/change_login.php" style="font-size:10px;">Change Settings</a></td>
			<td colspan="3" style="font-weight:bold;text-align:center;" nowrap="nowrap"><?php include($siteroot.'/includes/date_notifications.php'); // displays messages for particular dates ?>&nbsp;</td>
			<td align="right">
			<span class="bodyFont2">
			<?php
				$today = date('l, F jS, Y');
				echo $today ;
		 	?>
			</span>		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="5"><hr size="1" color="#333333" width="100%" /></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="5">