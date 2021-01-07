<?php 	session_start();
		global $config;
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php');
?>
<META HTTP-EQUIV="expires" CONTENT="Sat, 14 Feb 2009 08:00:00 GMT">

<link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseurl'] .'/lib/css/stylesheet.css'; ?>" />
<style>
.wrapper {
	border-width: 1px;
	border-color: #999999;
	border-style: solid;
	border-collapse: collapse;
	background-image:url('http://www.lilcalabria.com/images/site/paper_background.gif');
	font-family:Georgia, "Times New Roman", Times, serif;
	padding:10px;
	
}
 
table {
	background:none;
	border:none;
	border-spacing:0px;
	font-size:12px;
	padding:5px;
}

td {
	color:#333;
	margin-bottom:20px;	
}

label {
	font-size:10px;	
}
</style>
<script>
function validateForm() {
	
	var thisForm = document.getElementById('changelogin_form');
	var thisLength = thisForm.inpNewPassword.value.length;
		
	if (thisLength > 35) {
		alert('Your new password cannot be longer than 35 characters!'); return false;
	} 
	else {
		thisForm.submit();
	}
} 
</script> 

<div class="wrapper">
<?php 	require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/security.php');
		 	
		if (isset($_POST['inpSubmit'])) {
			
			if ($_POST['inpNewPassword'] !== $_POST['inpConfirm']) {
				$pwmatch = 'no';
			}
			else {
								
				include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
							
				$query = "	UPDATE tblMembers 
							SET strPassWord = ? 
							WHERE memberID = " . $_SESSION['userinfo']['id'];
							
				if ($stmt = mysqli_prepare($conn, $query)) {
					
					mysqli_stmt_bind_param($stmt,"s",$val1); // bind parameters; s = string, i = integer, d = double, b = blob 
									
					$val1 = $_POST['inpNewPassword']; // set variable values
																										
					mysqli_stmt_execute($stmt); // execute the SQL statement 
									
					mysqli_stmt_close($stmt); // close SQL statement 
				}
				
				include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); // close the DB connection 
							
				echo '	<span style="color:#990000;font-weight:bold;">
							Your password has been changed!
						</span>';  
		
			}
		}
		
		// display failure message		
		if (isset($pwmatch) && $pwmatch == 'no') {
			echo '	<span style="color:#990000;font-weight:bold;">
						Your New Password and Confirmation password do not match. Please retype them
					</span>';
		}
		
?>

<fieldset>
<legend>Change Password</legend>
<form action="change_settings.php" method="post" id="changelogin_form">
    <table>
        <tr>
        	<td colspan="2">To change your password, please type your old password and your new password (twice - to ensure you don't mispell it) in the spaces below. Passwords must contain  alpha-numeric characters only (A-Z and 0-9) and can have a maximum length of 35 characters.</td>
        </tr>
        <tr> 
            <td><label>Old Password:</label> </td>
            <td><input type="password" id="inpOldPassword" name="inpOldPassword" /></td>
        </tr>
        <tr>
            <td><label>New Password:</label> </td>
            <td><input type="password" id="inpNewPassword" name="inpNewPassword" /></td>
        </tr>
        <tr>
            <td><label>Confirm:</label> </td>
            <td><input type="password" id="inpConfirm" name="inpConfirm" /></td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="hidden" name="inpSubmit" value="Change Password" />
            <input type="button" value="Submit" onClick="validateForm(); return false;" />
            </td>
        </tr>
    </table>
</form>
</fieldset>
</div>