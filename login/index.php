<?php 	session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>lil'Calabria : Members' Login</title>
<?php
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); 
		global $config;
?>
<link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseurl']; ?>/lib/fancybox/<?php echo $config['libs']['css']['jquery.fancybox']; ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseurl']; ?>/lib/css/stylesheet.css" />

<script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/jquery/<?php echo $config['libs']['js']['jquery']; ?>"></script>
<script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/jquery/jquery.pubsub.js"></script>
<script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/jquery/jquery.textchange.min.js"></script>
<script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/fancybox/<?php echo $config['libs']['js']['jquery.easing']; ?>"></script>
<script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/fancybox/<?php echo $config['libs']['js']['jquery.fancybox']; ?>"></script>
<script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/js/calabria.core.js"></script>

</head>

<body id="login">

<div id="wrapper"> 

	<h4>Welcome to lil'Calabria. Members login to enter.</h4>

    <h5>
    <?php 	$status = (!isset($_GET['status'])) ? '' : $_GET['status'];
			
			if ($status == 'incorrect' ) echo 'Incorrect User Name or Password entered!';
            else if ($status == 'login') echo 'Members only may login here! Please insert a correct User Name and Password!';
            else if ($status == 'loggedout') echo 'You have successfully logged out.';
    ?>
    </h5>

    <form name="login-form" action="check_user.php" method="post">
               
        <label>User Name:
        <input type="text" name="username" title="Please enter your User Name" />
        </label>
        
        <label>Password:
        <input type="text" name="password" title="Please enter your Password" class="password" /> 
        </label>
        
        <input type="submit" value="login" class="button" />
              
        <a class="iframe" href="<?php echo $config['urls']['baseurl']; ?>/login/forgot.php?task=username">Forgot Username?</a> | <a class="iframe" href="<?php echo $config['urls']['baseurl']; ?>/login/forgot.php?task=password">Forgot Password?</a>
        
    </form>
    
</div>
<img class="background" src="<?php echo $config['urls']['baseurl']; ?>/images/login/vito_background2.jpg" />

<script type="text/javascript" src="<?php echo $config['urls']['baseurl']; ?>/lib/js/login.js"></script>
<script type="text/javascript">
login.Init();

'lil'.namespace();
lil.validate = {
	
	'exceptions': null,
	
	'init': function() {
		lil.validate.setExceptions();
	},
	'getExceptions': function() {
		if (!lil.validate.exceptions) {
			lil.validate.setExceptions();			
		}

		return lil.validate.excaptions;
	},
	'setExceptions': function() {
					
		var url = '/login/ajax.php',
		data = {classpath: '/lib/class/class.security.php', method: 'getExceptions'};
		
		$.ajax({
			url: url,
			data: data,
			success: function(data) {
				lil.validate.exceptions = data;
				
				$.publish('lil.validate.exceptions');
				
			},
			dataType: 'json'
		});
	}
};
</script>
</body>
</html>