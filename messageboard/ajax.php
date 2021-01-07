<?php session_start();

$classpath = $_GET['classpath'];
$method =  $_GET['method'];
 
switch($method) {
	case 'getPosts':
	 
	require_once($_SERVER['DOCUMENT_ROOT'].$classpath);
	$obj = new post();
	
	$dataArray['showpage'] = $_GET['showpage'];
	$dataArray['limitBy'] = '30days';
	
	$data = $obj->getPosts($dataArray);
	
	echo json_encode($data);
	 
	break;
	
	case 'update':
	 
	require_once($_SERVER['DOCUMENT_ROOT'].$classpath);
	$obj = new post();
	
	$dataArray['postid'] = $_POST['postid'];
	$dataArray['post'] = $_POST['post'];
	
	$data = $obj->update($dataArray);
	
	//echo json_encode($data);
	 
	break;
}
?>

<?php 
/* header("content-type:text/xml;charset=utf-8");
header("content-type:application/xml;charset=utf-8");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<data>\n";  
echo "\t<index>index</index>\n";  
echo "\t<messages>messages</messages>\n";
echo "</data>";


*/
?>


<?php /*?>$classpath = $_GET['classpath'];
$method =  $_GET['method'];
 
switch($method) {
	case 'getPosts':
	 
	require_once($_SERVER['DOCUMENT_ROOT'].$classpath);
	$obj = new post();
	
	$dataArray['showpage'] = $_GET['showpage'];
	$dataArray['limitBy'] = '30days';
	
	$data = $obj->getPosts($dataArray);
	
	header("content-type:application/xml;charset=utf-8");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";  
	echo "<data>\n";  
	echo "\t<index>" . $data["indexBox"] . "</index>\n";  
	echo "\t<messages>" . $data["messages"] . "</messages>\n";
	echo "</data>";
	
	break;
}
<?php */?>
