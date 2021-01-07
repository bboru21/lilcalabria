<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>lil'Calabria : Login Retrieval</title>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); 	global $config;
	$task = isset($_GET['task']) ? $_GET['task'] : 'password';
?>
<link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseurl'] .'/lib/css/stylesheet.css'; ?>" /><script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/jquery/<?php echo $config['libs']['js']['jquery']; ?>"></script><script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/jquery/jquery.pubsub.js"></script><script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/jquery/jquery.textchange.min.js"></script><script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/fancybox/<?php echo $config['libs']['js']['jquery.easing']; ?>"></script><script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/fancybox/<?php echo $config['libs']['js']['jquery.fancybox']; ?>"></script><script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/js/calabria.core.js"></script>
</head>
<body id="login-retrieval">
		<form id="retrieval-form" method="post">			<label>E-mail:				<input type="text" name="email" title="Please enter your E-mail Address" />			</label>
			<?php if ($task == 'username') { ?>				<label>Password:				<input type="text" name="value" title="Please enter your Password" class="password" /> 				</label>				<input type="hidden" name="task" value="username" />							<?php } else { ?>							<label>User Name:
				<input type="text" name="value" title="Please enter your User Name" />
				</label>
				<input type="hidden" name="task" value="password" />
			<?php } ?>
			<input type="button" value="send" class="button" />
			<!-- <input type="submit" value="send" class="button" /> -->
			<div id="result-message">
				<div style="display:none;">
					<img src="" />
					<span></span>
				</div>
			</div>
			
		</form>
<script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/js/login.js"></script><script type="text/javascript">
retrieve.Init();
</script>
</body>
</html>