<?php 	

exit;

session_start(); 
		include("../includes/header.php");
		require_once('../includes/dBug.php');
/*
======================================================================
You may need to contact the host to make changes to the php.ini 
file to specify a default location for files to upload to. In this case 
the default was /tmp, which falls outside of the open_basedir 
restriction. It had to be changed to /vservers/bboru21/tmp,
 which is inside of the open_basedir - BeH
======================================================================
*/
		
if($_POST['selGalleryName'] == 'none') { // if no current gallery is selected
	$gallery_name = $_POST['inpGalleryName']; // set the gallery name to text unput
	if ($gallery_name == '') { // if the input is blank set default to date in MM_DD_YY format
		$gallery_name = date('d_m_y');
	}
}
else {
	$gallery_name = $_POST['selGalleryName']; 
}
$target_path = 'photos/' . $_SESSION['UserName'] . '/'; // Where the file is going to be placed

if (file_exists($target_path) == false) { mkdir($target_path); } // if there is no username directory, create it
$target_path = $target_path . $gallery_name . '/';
if (file_exists($target_path) == false) { mkdir($target_path); } // if no gallery exists with that name, create it

/* Add the original filename to our target path.  
Result is "uploads/filename.extension" */
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

$_FILES['uploadedfile']['tmp_name']; 

if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { 
	// update the database with the path, filename, galleryID, etc.
    echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
    " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
}

include("../includes/footer.php"); 
?>