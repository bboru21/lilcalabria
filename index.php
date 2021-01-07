<?php	session_start();
		include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/header.php'); 
 		
		// get the last 15 updates
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.notifications.php');
		$note = new notifications();
		$notes = $note->init(15);
		
 		// get messages from last 150 days
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/class/class.messageboard.php');
		$mb = new post();
		$data = $mb->init(150);
		$indexbox = $data['indexBox'];
		$messages = $data['messages'];
?>
<ul class="triple_columns">
    <li>
        <p><span class="headline">Welcome, dear friends!</span><br />&nbsp;&nbsp;&nbsp;Welcome indeed to something that I'm sure will be very close to all of our hearts- The Family Website.  This will be a marvelous way for all of us to stay close and keep each other informed about what is happening in our ever changing lives. And what could be more important for the life of any family than that? I'm sure that we all look back on our days together at Christendom with tremendous fondness and gratitude. Those years were, in many ways, the best of our lives!  Without any real responsibilities or cares, we were free to live our lives exactly the way we wanted, without interference, and so we did.  And was that not the origin and purpose of The Family?  The Family was at the very heart and center of our years together.   It was our identity and our way of life: <i>"Vita Nostra."</i></p>
        <p>&nbsp;&nbsp;&nbsp;And so must all good things come to an end? Hopefully not.  It has obviously been a few years since we moved on from Christendom. We are now scattered across the country. We have pursued many different careers and paths. Some of us have kept in touch and some have not.</p>
    </li>
    <li> 
        <img src="/images/site/Family-2_250x325.jpg" width="240" height="325" />
        <p>And yet we all share the same Family roots. Our countless memories and our friendship must still call to us and bind us together.</p> 
    </li>
    <li>
    <p>&nbsp;&nbsp;&nbsp;And so I invite all of you to get involved with this, our website. It is here that we can look back to the past, keep in touch in the present, and look foward to the future. We will have a section devoted to the history of The Family.  Everyone is invited to write about their own memories and stories.  We will have a section for present news and events involving Family members, a section for posting pictures, and much more.  I think that this site has much potential, and so I am extremely excited about it.  I encourage everyone to get involved.</p> 
    <p>&nbsp;&nbsp;&nbsp;A huge "Thank You" goes out to Bryan for conceiving the idea of the site.  He has been planning it and working on it for over a year now.  His efforts have not been overlooked- we thank you Hadro, for this would not have happened without you! And so I look foward to hearing from all of you very much.  We have all entered upon our post- Christendom lives, but lets continue to live as a Family.<br /><br /><div align="right">--- <strong>Schmittino</strong>&nbsp;&nbsp;&nbsp;</div></p>
    </li>
</ul>

<hr class="divider" />

<ul class="double_columns">
    <li>
        <span class="headline">Recent Activity</span><br />
        <ul id="notifications"><?php echo $notes; ?></ul>
    </li>
    <li>
        <span class="headline">Message Board</span> <a href="#" id="board_switch" class="switch" title="Click here to write something on the Message Board.">Show/Hide</a>
				 
		<div id="board_wrapper" style="display:none;">
			<form id="board-form" action="<?php echo $config['urls']['baseurl']; ?>/messageboard/post.php" method="post">
				<textarea name="message"></textarea>
				<br />
				<input class="button" type="submit" value="Submit" />
			</form>
		</div>
		<br />
		<div id="index">
			<?php echo $indexbox; ?>
        </div>
		
		<ul id='messages'>
			<?php echo $messages; ?>
        </ul>
		
		<form id="edit-form">
			<input type="hidden" name="postid" />
			<textarea name="post"></textarea>
		</form>
		
		<script type="text/javascript">
		var id = <?php echo $_SESSION['userinfo']['id']; ?>;
		mb.Init(id);
		</script>
    </li>
</ul>
<?php include($_SERVER['DOCUMENT_ROOT']."/lib/includes/footer.php"); ?>