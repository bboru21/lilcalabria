<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Settings</title>
		<?php 
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php'); 
		global $config;
		
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.credentials.php');
		$credentials = new credentials(); 
		
		$data = $credentials->getAll($_SESSION['userinfo']['id']);
		
		?>
		<link rel="stylesheet" type="text/css" href="<?= $config['urls']['baseurl'] .'/lib/css/stylesheet.css'; ?>" />
		<style type="text/css">
		#settings {
			background-color:#000000;
		}
		#settings input {
			width:200px;
		}
		#settings .button {
			width:50px;
		}
		</style>
	</head>
	<body id="settings">
	 test
	<form name="name-form">	 
		<label>First Name:<br />
			<input type="text" name="strFirstName" value="<?= $data['fname']; ?>" />
		</label>
		<label>Last Name:<br />
			<input type="text" name="strLastName" value="<?= $data['lname']; ?>" />
		</label>
		
		<label>User Name:<br />
			<input type="text" name="strUserName" value="<?= $data['uname']; ?>" />
		</label>
		
		<label>Alias:<br />
			<input type="text" name="strAlias" value="<?= $data['alias']; ?>" />
		</label>
		<input type="button" class="button" value="save">
	</form>
	
	<form name="password-form">		
		<label>Current Password:<br />
			<input type="password" name="strPassword" />	
		</label>
		<label>New Password:<br />
			<input type="password" name="strPassword-2" />	
		</label>
		<label>Confirm Password:<br />
			<input type="password" name="strPassword-2" />	
		</label>
		<input type="button" class="button" value="save">
	</form>
	
	<form name="email-form">	
		<label>E-mail:<br />
			<input type="text" name="strEmail2" value="<?= $data['email']; ?>" />
		</label>
		<input type="button" class="button" value="save">
	</form>
	
	<script type="text/javascript" src="<?= $config['urls']['baseurl'] .'/lib/jquery/jquery.1.4.2.min.js'; ?>"></script>
	<script type="text/javascript" src="<?= $config['urls']['baseurl'] .'/lib/js/cfdump/dump.js'; ?>"></script>
	<script type="text/javascript" src="<?= $config['urls']['baseurl'] .'/lib/js/calabria.core.js'; ?>"></script>
	<script type="text/javascript" src="<?= $config['urls']['baseurl'] .'/lib/js/calabria.validate.js'; ?>"></script>
	<script type="text/javascript">
	'calabria.settings'.namespace();
	
	calabria.settings = {
		"init": function(id) {
			
			$('.button').each( function() {
				$(this).bind('click', function() {
					calabria.settings.submit(id,this);		
				});
			});
		},
		"submit": function(id,node) {
			// extract data from the form and prepare it to be posted
			var $form = $(node).parent('form'), 
			arr = $form.serializeArray(),
			data = {};
			
			/* if ($form.attr('name') == 'password-form') {
				calabria.validate.compareStrings();
			*/
			
			// store the data
			data.classpath = '/lib/class/class.credentials.php';
			data.id = id;
			data.method = 'updateMany';
			data.values = arr;			
			calabria.settings.post(data);		
		},
		"post": function(data) {
					
			$.ajax({ type:'POST',  url: '/login/ajax.php', data: data, success: function() { alert('success'); }  });
		
		},
		"handler": function(data) {
		
		}
	};
	calabria.settings.init(<?php echo $_SESSION['userinfo']['id']; ?>);
	</script>
	</body>
</html>