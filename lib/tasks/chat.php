<?php 

// http://net.tutsplus.com/tutorials/other/scheduling-tasks-with-cron-jobs/
// scheduled task so if it's accessed via http request, deny
//if (isset($_SERVER['REMOTE_ADDR'])) die('Permission denied.');

//require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/communicate.php');

$fp = fopen($_SERVER['DOCUMENT_ROOT']."/chat/log.html", 'w');
fwrite($fp, "");
fclose($fp);

/*$email = new email();

$email->Subject = 'Lilcalabria Notifications';
$email->Body = 'Clear chat scheduled task ran';
$email->AddAddress('bhadro@lilcalabria.com', 'Bryan Hadro');
$email->Send();

$email->ClearAddresses();
$email->ClearAttachments();*/
	

