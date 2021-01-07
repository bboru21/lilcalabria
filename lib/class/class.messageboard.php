<?php 
class post {
	
	function init($interval) {
					
		$today = date('Y-m-d');
				
		$idlist = $this->getIds($today,$interval);
			
		$perpage = 20; // number of records to show per page
		
		$idArray = $this->getIdArray($idlist,$perpage);
		
		// set pagination variables in session for easy ajax access
		$pagination = array(); 
		$pagination['perpage'] = $perpage;
		$pagination['postcount'] = count(explode(',',$idlist));
		$pagination['pagecount'] = count($idArray);
		$pagination['idArray'] = $idArray;
		
		$_SESSION['messageboard'] = $pagination;
		
		// in case you are using "link" pagination instead of ajax
		// if (!isset($_GET['showpage']) || !ctype_alnum($_GET['showpage'])) { $showpage = 1; }
		// else { $showpage = $_GET['showpage']; }
		
		$dataArray = array();
		$dataArray['showpage'] = '1';
		$dataArray['limitBy'] = '30days';
		
		// get index box and message board html
		$data = $this->getPosts($dataArray);
		
		return $data;
	}
	
	function getIds($today, $interval) {
	
		global $config;
	
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		
		/*$query = "	SELECT postID AS id
					FROM tblMessageBoard
					WHERE datPostDate >= DATE_SUB('".$today."', INTERVAL ".$interval." DAY) AND ysnActive = 1
					ORDER BY datpostdate DESC ";*/
		$query = "SELECT postID AS id
							FROM tblMessageBoard
							WHERE ysnActive = 1
							ORDER BY datpostdate DESC LIMIT 100";
								
		if ($stmt = mysqli_prepare($conn, $query)) {
					
					mysqli_stmt_execute($stmt); // execute the SQL statement 
					
					mysqli_stmt_bind_result($stmt, $id);
					
					$idlist = '';
					$i = 1;
					while (mysqli_stmt_fetch($stmt)) {
							$idlist = $idlist.$id.',';
							$i++;
					}
					$idlist = substr($idlist, 0, -1);
								
					mysqli_stmt_close($stmt); // close SQL statement 
					
		}
						
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');	
		
		return $idlist;
	}
	
	function getIdArray($idList,$perpage) {
		
		$oldArray = explode(',',$idList);
		$idcount = count($oldArray);
		$pagecount = ceil($idcount/$perpage);
	
		$newArray = array();
		
		$y = 0;
		for ( $n = 0; $n < $pagecount; $n++ ) { 						// n is the current index of the array (representing the current page number).
			$newArray[$n] = '';
			for ( $i = 1; $i < $perpage && $y < $idcount-1; $i++ ) { 	// i is the number of id's already added to the current array index.
																		// y is the number of id's already added (total).
				$newArray[$n] = $newArray[$n] . $oldArray[$y] . ','; 
				$y = $y+1;
			}
				
			if ( $i == $perpage || $y == $idcount-1 ) {
				$newArray[$n] = $newArray[$n] . $oldArray[$y];
				$y = $y+1;
			}
		}
	return $newArray;
	} 
	
	function getSimplePaginationInfo($view,$showpage) {
		
		$perpage = $_SESSION['messageboard']['perpage'];
		$pagecount = $_SESSION['messageboard']['pagecount'];
		$recordcount = $_SESSION['messageboard']['postcount'];
		
		$menu = '';
		for ($i=1; $i <= $pagecount; $i++) {
		
			if ($showpage == $i && $view == 'some') {
				
				$menu .= '<span style="font-weight:bold;font-size:10px;">' . $i . '</span>';
			}
			else {
				//$menu = $menu . '<a href="index.php?showpage='.$i.'&view='.$view.'#mb" style="font-size:10px;">' . $i . '</a>';
				$menu .= "<a href='#index' onclick='javascript: mb.Get($i); return false;' style='font-size:10px;'>$i</a>";	
			}
			if ($i !== $pagecount) { $menu = $menu . '&nbsp;<span class="divider">|</span>&nbsp;'; }
		}
	
	return $menu;
	}
	
	function getSimplePagination($view,$showpage) {
		
		$perpage = $_SESSION['messageboard']['perpage'];
		$pagecount = $_SESSION['messageboard']['pagecount'];
		$recordcount = $_SESSION['messageboard']['postcount'];
		
		$menu = '';
		for ($i=1; $i <= $pagecount; $i++) {
		
			if ($showpage == $i && $view == 'some') {
				
				$menu .= '<b>' . $i . '</b>';
			}
			else {
				$menu .= "<a href='#index' onclick='javascript: mb.Get($i); return false;'>$i</a>";	
			}
			if ($i !== $pagecount) { $menu = $menu . '&nbsp;<span class="divider">|</span>&nbsp;'; }
		}
	
	return $menu;
	}
	
	function getPosts($data) {
		
		$showpage = $data['showpage'];
		if (!isset($view)) { $view = 'some';}
		
		$indexBox = $this->getSimplePaginationInfo($view,$showpage);
		
		$perpage = $_SESSION['messageboard']['perpage'];
		$pagecount = $_SESSION['messageboard']['pagecount'];
		$idArray = $_SESSION['messageboard']['idArray'];
		$postcount = $_SESSION['messageboard']['postcount'];
		if (!isset($idArray[$showpage-1])) { $thisList = $idArray[0]; }
		else { $thisList = $idArray[$showpage-1]; }
		 		 		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/config.php');
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		 
		$query = "	SELECT mb.postid AS id, mb.intMemberID AS memberid, mb.strMessage AS message, UNIX_TIMESTAMP(mb.datPostDate) AS date, (SELECT m.strAlias FROM tblMembers AS m WHERE m.memberID = mb.intMemberID) AS name 
			FROM tblMessageBoard AS mb
			WHERE mb.postid IN (".$thisList.")
			ORDER BY mb.datPostDate DESC";
		
		$messages = "";
		if ($stmt = mysqli_prepare($conn, $query)) {
			
			mysqli_stmt_execute($stmt); // execute the SQL statement 
			
			mysqli_stmt_bind_result($stmt, $id, $memberid, $message, $date, $name);
			
			while (mysqli_stmt_fetch($stmt)) {
				$day = date('n/d/Y',$date);
				$time = date('g:i A',$date);
				$messages .=  "<li id='$id'><b><span class='memberid'>$memberid</span>$name wrote on <span class='date'>$day</span> at <span class='time'>$time</span>:</b> <div>". $message . "</div></li>";
			}
			
			//$messages = '<ul id="messages">'.$messages.'</ul>';
			
			mysqli_stmt_close($stmt); // close SQL statement 
		}
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
		
		$dataArray = array();
		$dataArray['indexBox'] = $indexBox;
		$dataArray['messages'] = $this->naughty_filter($messages);
		
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
	
	function escapeChars($str) {
		$str = str_replace('"', '&quot;', $str);
		$str = str_replace("'", '&#39;', $str);
		
		return $str;
	}
	
	function insert($message) {
		
		global $config;
		
		$message = $this->escapeChars($message);
		
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php'); // Connect to the DB
			
		// prepare insert statement
		
		$query = "	INSERT INTO tblMessageBoard (intMemberID, datPostDate, strMessage, ysnActive)
					VALUES ( ?, ?, ?, 1 )";
					
		if ($stmt = mysqli_prepare($conn, $query)) {
			
			mysqli_stmt_bind_param($stmt,"iss",$val1,$val2,$val3); // bind parameters; s = string, i = integer, d = double, b = blob 
			
			$val1 = $_SESSION['userinfo']['id']; 
			$val2 = date('Y-m-d H:i:s A');
			$val3 = $message; // set variable values
																									
			mysqli_stmt_execute($stmt); // execute the SQL statement 
							
			mysqli_stmt_close($stmt); // close SQL statement 
				
			include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php'); // close the DB connection
			
			$result = true;
		}
		else $result = false;
	
		return $result;
	}
	
	function update($data) {
		
		global $config;

		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		
		$query = " UPDATE tblMessageBoard SET strMessage = ? WHERE postID = ?";
					
		if ($stmt = mysqli_prepare($conn, $query)) {
			
			mysqli_stmt_bind_param($stmt,"si",$post,$postid); 
			
			$post = $data['post'];
			$postid = $data['postid'];
			
			mysqli_stmt_execute($stmt); 
							
			mysqli_stmt_close($stmt);
				
			include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
		
		}
	}
	
}