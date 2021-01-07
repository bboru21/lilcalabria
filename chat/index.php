<?php
		
if (!isset($_SESSION['chat']['loggedin'])) $_SESSION['chat']['loggedin']  = false;
	
if(isset($_GET['chat_logout'])){	

	//Simple exit message
	$fp = fopen($_SERVER['DOCUMENT_ROOT']."/chat/log.html", 'a');
	fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['chat']['name'] ." has left the chat session.</i><br></div>");
	fclose($fp);
	
	$_SESSION['chat']['loggedin'] = false;
	    		
	header("Location: ".$_SERVER['SCRIPT_NAME']);}?>

<link type="text/css" rel="stylesheet" href="<?php echo $config['urls']['baseurl'].'/lib/css/chat/style.css' ?>" />

<script type="text/javascript">

//Load the file containing the chat log
function loadLog(){		
	var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
	$.ajax({
		url: "<?php  echo $config['urls']['baseurl'] . '/chat/log.html'; ?>",
		cache: false,
		success: function(html){		
			$("#chatbox").html(html); //Insert chat log into the #chatbox div	
			
			//Auto-scroll			
			var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
			if(newscrollHeight > oldscrollHeight){
				$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
			}				
		},
	});
}

$(document).ready(function(){
	// If user wants to end session
	$("#exit").click( function() {
		var exit = confirm("Are you sure you want to end the session?");
		if (exit) window.location = "<?php echo $config['urls']['baseurl'].$_SERVER['SCRIPT_NAME'].'?chat_logout=true'; ?>";
	});
	
	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("<?php echo $config['urls']['baseurl'].'/chat/post.php'; ?>", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	
	setInterval(loadLog, 1500);	//Reload file every 2500 ms or x ms if you wish to change the second parameter
});
</script>

<?php 
	
	/*if(isset($_POST['enter'])){
		if($_POST['name'] != ""){
			$_SESSION['chat']['name'] = stripslashes(htmlspecialchars($_POST['name']));
			$_SESSION['chat']['loggedin'] = true;
		}
		else{
			echo '<span class="error">Please type in a name</span>';
		}
	}*/
	if(isset($_GET['enter_chat'])){
		$_SESSION['chat']['name'] = $_SESSION['username'];
		$_SESSION['chat']['loggedin'] = true;	
	}
		
	if($_SESSION['chat']['loggedin'] ==  false){
		/*echo'
		<div id="loginform">
		<form action="'.$config['urls']['baseurl'].$_SERVER['SCRIPT_NAME'].'" method="post">
			<p>Family Chat - Please enter your name to continue:</p>
			<label for="name">Name:</label>
			<input type="text" name="name" id="name" />
			<input type="submit" name="enter" id="enter" value="Enter" />
		</form>
		</div>
		';*/
		echo '<a id="enter" href="'.$config['urls']['baseurl'].$_SERVER['SCRIPT_NAME'].'?enter_chat=true">Enter Chat</a>';
	}
	else{
?>

<div id="chat_wrapper">
	<div id="menu">
		<p class="welcome">Ciao, <b><?php echo $_SESSION['chat']['name']; ?></b></p>
		<p class="logout"><a id="exit" href="#">Exit Chat</a></p>
		<div style="clear:both"></div>
	</div>
	
	<div id="chatbox">
     <?php 
	 	$logfile = $_SERVER['DOCUMENT_ROOT']."/chat/log.html";
		if(file_exists($logfile) && filesize($logfile) > 0){  
			$handle = fopen($logfile, "r");  
			$contents = fread($handle, filesize($logfile));  
			fclose($handle);  
		       
			echo $contents;  
		}  
	?>
    </div>
	
	<form name="message" action="">
		<input name="usermsg" type="text" id="usermsg" size="63" />
		<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
	</form>
</div>

<?php } ?>