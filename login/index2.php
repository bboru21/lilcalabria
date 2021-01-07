<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>lil'Calabria : Members' Login</title> 
<link rel="stylesheet" type="text/css" href="http://lilcalabria.appalabs.com/lib/fancybox/jquery.fancybox-1.3.1.css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="http://lilcalabria.appalabs.com/lib/css/stylesheet.css" /> 
 
 <style>
 .background {
	display:none;
	position: absolute;
	top:0;
	left:0;
	z-index:0;
 }
 
 #wrapper {
	position:absolute;
	z-index: 1;
 }
 </style>
 
</head> 
 
<body id="login"> 
  
<div id="wrapper"> 
 
	<h4>Welcome to lil'Calabria. Members login to enter.</h4> 
 
    <h5> 
    Members only may login here! Please insert a correct User Name and Password!    </h5> 
 
    <form name="login-form" action="check_user.php" method="post"> 
               
        <label>User Name:
        <input type="text" name="username" title="Please enter your User Name" /> 
        </label> 
        
        <label>Password:
        <input type="text" name="password" title="Please enter your Password" class="password" /> 
        </label> 
        
        <input type="submit" value="login" class="button" /> 
              
        <a href="http://lilcalabria.appalabs.com/login/forgot.php?task=username">Forgot Username?</a> | <a href="http://lilcalabria.appalabs.com/login/forgot.php?task=password">Forgot Password?</a> 
        
    </form> 
    
</div>
<img class="background" src="http://lilcalabria.appalabs.com/images/login/vito_background2.jpg" />
 
<script type="text/javascript" src="http://lilcalabria.appalabs.com/lib/jquery/jquery.1.4.2.min.js"></script> 
<script type="text/javascript" src="http://lilcalabria.appalabs.com/lib/jquery/jquery.textchange.min.js"></script> 
<script type="text/javascript" src="http://lilcalabria.appalabs.com/lib/fancybox/jquery.easing.1.3.pack.js"></script> 
<script type="text/javascript" src="http://lilcalabria.appalabs.com/lib/fancybox/jquery.fancybox-1.3.1.pack.js"></script> 
<script type="text/javascript" src="http://lilcalabria.appalabs.com/lib/js/login.js"></script> 
<script type="text/javascript"> 
login.Init();
</script> 
</body> 
</html>