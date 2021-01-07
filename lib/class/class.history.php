<?php 
class quotes {
	
	function getPosts($data) {
		
		$showpage = $data['showpage'];
		if (!isset($view)) { $view = 'some';}
		
		$indexBox = $this->getSimpleIndexInfo($view,$showpage);
		
		$perpage = $_SESSION['messageboard']['perpage'];
		$pagecount = $_SESSION['messageboard']['pagecount'];
		$idArray = $_SESSION['messageboard']['idArray'];
		$postcount = $_SESSION['messageboard']['postcount'];
		if (!isset($idArray[$showpage-1])) { $thisList = $idArray[0]; }
		else { $thisList = $idArray[$showpage-1]; }
		 		 		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php');
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		
		$query = "	SELECT mb.strMessage AS message, UNIX_TIMESTAMP(mb.datPostDate) AS date, (SELECT m.strAlias FROM tblMembers AS m WHERE m.memberID = mb.intMemberID) AS name 
			FROM tblMessageBoard AS mb
			WHERE mb.postid IN (".$thisList.")
			ORDER BY mb.datPostDate DESC";
		
		if ($stmt = mysqli_prepare($conn, $query)) {
			
			mysqli_stmt_execute($stmt); // execute the SQL statement 
			
			mysqli_stmt_bind_result($stmt, $message, $date, $name);
			
			$messages = '';
			while (mysqli_stmt_fetch($stmt)) {
				$date = date('n/d/y \a\t h:i A',$date);
				$messages .=  '<li><b>' . $name . ' wrote on ' . $date . ':</b> <div>' . $message . '</div></li>';
			}
			$messages = '<ul id="messages">'.$messages.'</ul>';
			
			mysqli_stmt_close($stmt); // close SQL statement 
		}
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
		
		$dataArray = array();
		$dataArray['indexBox'] = $indexBox;
		$dataArray['messages'] = $messages;
		
		return $dataArray;
	}
	
	function naughty_filter($str) {
		
		$str = str_ireplace(' cock ',' c**k ',$str);
		$str = str_ireplace(' nigger ','n****r ',$str);
		$str = str_ireplace('fuck','f**k',$str);
		$str = str_ireplace(' cunt ','c**t',$str);
		$str = str_ireplace(' vagina ','v****a',$str);
		$str = str_ireplace('child rapist','c***d r****t',$str);
		$str = str_ireplace(' semen ',' s***n ',$str);
	
		return $str;
		
	}
	
}
?>