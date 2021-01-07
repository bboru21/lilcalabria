<?php 

require_once("../includes/dBug.php");

new dBug($_POST); 

exit;
/*
======================================================================
You may need to contact the host to make changes to the php.ini 
file to specify a default location for files to upload to. In this case 
the default was /tmp, which falls outside of the open_basedir 
restriction. It had to be changed to /vservers/bboru21/tmp,
 which is inside of the open_basedir - BeH
======================================================================
*/

$target_path = 'attachments/'; // Where the file is going to be placed

if (file_exists($target_path) == false) { mkdir($target_path); } // if there is no username directory, create it
//$target_path = $target_path . $gallery_name . '/';
//if (file_exists($target_path) == false) { mkdir($target_path); } // if no gallery exists with that name, create it

/* Add the original filename to our target path.  
Result is "uploads/filename.extension" */
$target_path .= basename( $_FILES['uploadedfile']['name']); 

$_FILES['uploadedfile']['tmp_name']; 

if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { 
	// update the database with the path, filename, galleryID, etc.
    echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
    " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
	exit;
}


//define the receiver of the email
$to = $_POST['toemail'];
//define the subject of the email
$subject = $_POST['subject'];
//create a boundary string. It must be unique
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(date('r', time()));
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: ".$_POST['fromemail']."\r\nReply-To: ".$_POST['fromemail'];
//add boundary string and mime type specification
$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
//read the atachment file contents into a string,
//encode it with MIME base64,
//and split it into smaller chunks
//$attachment = chunk_split(base64_encode(file_get_contents('attachment.zip')));
$attachment = "";
//define the body of the message.
ob_start(); //Turn on output buffering
?>
--PHP-mixed-<?php echo $random_hash; ?> 
Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>"

--PHP-alt-<?php echo $random_hash; ?> 
Content-Type: text/plain; charset="iso-8859-1"
Content-Transfer-Encoding: 7bit

<?php echo $_POST['message']; ?> 

--PHP-alt-<?php echo $random_hash; ?> 
Content-Type: text/html; charset="iso-8859-1"
Content-Transfer-Encoding: 7bit

<?php echo $_POST['message']; ?> 

--PHP-alt-<?php echo $random_hash; ?>--

--PHP-mixed-<?php echo $random_hash; ?> 
Content-Type: application/zip; name="attachment.zip" 
Content-Transfer-Encoding: base64 
Content-Disposition: attachment 

<?php echo $attachment; ?>
--PHP-mixed-<?php echo $random_hash; ?>--

<?php
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
echo $mail_sent ? "Mail sent" : "Mail failed";


?>