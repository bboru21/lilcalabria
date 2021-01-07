<?php	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php');
		global $config;
		
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.user.php');
		$user = new user(); 
		$user->check(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>lil'Calabria : la Famiglia's Website</title>
    
	<link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseurl'] .'/lib/css/stylesheet.css'; ?>" />
    
	<!--[if IE]><link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseurl'] .'/lib/css/stylesheet-ie.css'; ?>" /><![endif]-->
	
    <link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseurl']; ?>/lib/fancybox/<?php echo $config['libs']['css']['jquery.fancybox']; ?>" media="screen" />
    
    <!-- jquery libraries -->
    <script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/jquery/<?php echo $config['libs']['js']['jquery']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/fancybox/<?php echo $config['libs']['js']['jquery.easing']; ?>"></script>
    <script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/fancybox/<?php echo $config['libs']['js']['jquery.fancybox']; ?>"></script>   
    <script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/js/main.js">/* Main Javascript Library */</script> 
</head>

<body id="main"> 
<table cellpadding="0" cellspacing="0" width="800" align="center">
<tr>
<td>
<?php include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/nav.php'); ?>
<br />

<table cellpadding="0" cellspacing="0" id="body">
	<tr>
		<td id="side">&nbsp;</td>
	  	<td colspan="5" align="center">
			<img src="<?php echo $config['urls']['baseurl'] . '/images/header1.png'; ?>" />		</td>
		<td id="side">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td> 
			<td colspan="5" align="center">
			<span style="font-size:10px; font-style:italic;">"Do you spend time with your family? ...Good.  Because a man that doesn't spend time with his family can never be a real man" --Vito Corleone</span><br />
			<hr class="divider" /></td>
			<td>&nbsp;</td>
		</tr>
        <tr id="greeting">
		  <td>&nbsp;</td> 
			<td align="left">
				<?php echo 'Ciao ' . $_SESSION['userinfo']['alias'] . '!'; ?> 
                <a href="/login/logout.php">logout</a>
            </td>
			<td colspan="3" style="font-weight:bold;text-align:center;" nowrap="nowrap">
			<?php include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); 
        
				$query = "SELECT strdescription FROM tblDates WHERE intmonth = ".date('n')." AND intday = ".date('j')." AND ysnannual = 1";
				
				if ($stmt = mysqli_prepare($conn, $query)) {
						
						mysqli_stmt_execute($stmt); // execute the SQL statement 
						
						mysqli_stmt_bind_result($stmt, $description);
										
						while (mysqli_stmt_fetch($stmt)) {
							echo $description . '<br />';
						}
													
						mysqli_stmt_close($stmt); // close SQL statement 
						
				}
				else echo '&nbsp;';
				   
				include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); 
			?>
			</td>
			<td align="right">
			<span class="bodyFont2">
			<?php echo date('l, F jS, Y'); ?>
			</span>		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="5"><hr class="divider" /></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td id="content" colspan="5">