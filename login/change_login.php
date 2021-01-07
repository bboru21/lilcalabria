<link rel="stylesheet" href="../lib/css/login/login.css" type="text/css" />
<script language="javascript" src="../lib/js/prototype.js" type="text/javascript">/* Prototype library for extra JS functionality */</script>
<script type="text/javascript" src="../lib/js/main.js" language="javascript"></script>
<script>
function validateForm() {
	
	var thisForm = $('changelogin_form');
	var thisLength = thisForm.inpNewPassword.value.length;
		
	if (thisLength > 35) {
		alert('Your new password cannot be longer than 35 characters!'); return false;
	} 
	else {
		thisForm.submit();
	}
} 
</script> 
<?php 	session_start();
	
		//if ($_SESSION['userinfo']['id'] !== 1) {
			//exit('Sorry, this section is temporarily down for maintenance. Please try again later.');
		//}
		
		include($_SERVER['DOCUMENT_ROOT']."/lib/includes/header.php");
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/security.php');
		 	
		if (isset($_POST['inpSubmit'])) {
			
			if ($_POST['inpNewPassword'] !== $_POST['inpConfirm']) {
				$pwmatch = 'no';
			}
			else {
				
				include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); // Include file to set variables used for DB connection
				include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
							
				// prepare update statement
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

<div>To change your password, please type your old password and your new password (twice - to ensure you don't mispell it) in the spaces below. Passwords must contain  alpha-numeric characters only (A-Z and 0-9) and can have a maximum length of 35 characters.</div>

<form action="change_login.php" method="post" id="changelogin_form">
		<table cellspacing="0" width="100%" style="background:none;border:none;">
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr> 
				<td align="right"><strong>Old Password:</strong> </td>
				<td>
				<input type="text" id="inpOldPassword" name="inpOldPassword" value="Please type your current password that you wish to change." onFocus="removeText(this.id,'password')" />
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td align="right"><strong>New Password:</strong> </td>
				<td>
				<input type="text" id="inpNewPassword" name="inpNewPassword" value="Please type your new password that you want to change to." onFocus="removeText(this.id,'password')" />
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td align="right"><strong>Confirm:</strong> </td>
				<td><input type="text" id="inpConfirm" name="inpConfirm" value="Please retype your new password that you want to change to." onFocus="removeText(this.id,'password')" /></td>
			</tr>
            <tr>
				<td align="right">
                <input type="hidden" name="inpSubmit" value="Change Password" />
                <input type="button" value="Change Password" style="width:125px;" onClick="validateForm(); return false;" /></td>
				<td>&nbsp;</td>
			</tr>
		</td>
	</tr>
</table>
</form>

<?php include($_SERVER['DOCUMENT_ROOT']."/lib/includes/footer.php"); ?>