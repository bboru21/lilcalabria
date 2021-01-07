<?php exit;	

		session_start(); 
		include("../includes/header.php");
 ?>
 <link rel="stylesheet" href="../lib/css/photo_uploads/photo_uploads.css" type="text/css" />
 <link rel="stylesheet" href="../lib/lightwindow/css/lightwindow.css" type="text/css" />
  
 <script language="javascript" type="text/javascript" src="../lib/js/prototype.js">/* Prototype library */</script>
 <script language="javascript" type="text/javascript" src="../lib/scriptaculous/src/effects.js">/* Scriptaculous Effects Library */</script>
 <script language="javascript" type="text/javascript" src="../lib/lightwindow/javascript/lightwindow.js"></script>
 <script language="javascript" type="text/javascript" src="../lib/js/main.js">/* Site's main javascript library */</script>
  <script>
  function showhide(task,el,holderid) {
  
  	if (task == 'show') {
		new Effect.SlideDown(holderid, { duration: 1.0 }); // prototype effect
		el.innerHTML = 'Hide';
		el.onclick = function () { showhide('hide',el,holderid); return false; }
		
	}
	else {
		new Effect.SlideUp(holderid, { duration: 1.0 }); // prototype effect
		el.innerHTML = 'Show'; 
		el.onclick = function () { showhide('show',el,holderid); return false; }
	}	
}
  </script>
<?php 
include('../includes/config.php'); // Include file to set variables used for DB connection
include('../includes/opendb.php'); // Connect to the DB

// Select photo galleries for member
$query = "	SELECT galleryID, strGalleryName 
			FROM tblGalleries 
			WHERE intGalleryMember = " . $_SESSION['MemberID'];


	if ($stmt = mysqli_prepare($conn, $query)) {
				
				//mysqli_stmt_bind_param($stmt,"i",$val1);
				
				mysqli_stmt_execute($stmt); // execute the SQL statement 
				
				mysqli_stmt_bind_result($stmt, $id, $gallery);
				$html = '';
				$rc = 0;
				while (mysqli_stmt_fetch($stmt)) {
					$html = $html.'<option value="'.$id.'">'.$gallery.'</option>';
					$rc++;
				}
															
				mysqli_stmt_close($stmt); // close SQL statement 
			}
			
include('../includes/closedb.php'); // Close the DB connection

?>
Upload Photos: <a href="#" onClick="javascript:showhide('show',this,'upHolder'); return false;">show</a>
<div id="upHolder" style="padding:10px;display:none;">

	<form id="photo_form" enctype="multipart/form-data" action="process.php" method="POST"> 	<!-- The data encoding type, enctype, MUST be specified as below -->
		<div style="padding:5px;display:<?php echo $display; ?>;">
		Galleries: <?php if ($rc > 0) { echo '
			<select name="selGalleryName">
				<option value="none">- Select A Photo Gallery -</option>'
				.$html.
			'</select>'; } ?>
		</div>
       
		<div style="padding:5px;">
			Gallery Name: <input type="text" name="inpGalleryName" />
		</div>
		<input type="hidden" name="MAX_FILE_SIZE" value="100000" /> 					<!-- MAX_FILE_SIZE must precede the file input field -->
		<!--Gallery Name: <input type="text" name="inpGalleryName" id="inpGalleryName" value="Please type the name of your photo gallery here (optional)." onfocus="javascript:removeText(this.id,'text'); return false;" {/> -->
		<div style="padding:5px;">
			Send this file: <input name="uploadedfile" type="file" /> 			<!-- Name of input element determines name in $_FILES array -->
		</div>
		<input type="submit" value="Send File" style="width:75px;"/>
	</form>
</div>

<br />
<br />
View Galleries:

<div>

</div>

<?php include("../includes/footer.php"); ?>
