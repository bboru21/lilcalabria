<style type="text/css">
form {
	width:400px;
	height:400px;
	background-color:#FFFFFF;
}
</style>
<form id="photoform" enctype="multipart/form-data" action="process.php" method="POST"> 	
		
	<div>Gallery Name: <input type="text" name="inpGalleryName" /></div>
		
	<input type="hidden" name="MAX_FILE_SIZE" value="100000" /> 					
	
	<div>Send this file: <input name="uploadedfile" type="file" /> </div>
		<input type="submit" value="Send File" style="width:75px;"/>
</form>