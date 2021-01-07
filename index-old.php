<?php  
	 
	session_start(); 
		
	include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/header.php'); 
	   
?>

<!-- background="images/old_paper.jpg" -->
<table cellpadding="0" cellspacing="0" width="100%" style="background:none;border:none;">
	<tr>
	  <td>&nbsp;</td>
	  <td rowspan="2" align="left" valign="top" class="bodyFont2" width="30%"><p><span class="headline">Welcome, dear friends!</span><br />&nbsp;&nbsp;&nbsp;Welcome indeed to something that I'm sure will be very close to all of our hearts- The Family Website.  This will be a marvelous way for all of us to stay close and keep each other informed about what is happening in our ever changing lives. And what could be more important for the life of any family than that? I'm sure that we all look back on our days together at Christendom with tremendous fondness and gratitude. Those years were, in many ways, the best of our lives!  Without any real responsibilities or cares, we were free to live our lives exactly the way we wanted, without interference, and so we did.  And was that not the origin and purpose of The Family?  The Family was at the very heart and center of our years together.   It was our identity and our way of life: <i>"Vita Nostra."</i></p>
<p>&nbsp;&nbsp;&nbsp;And so must all good things come to an end? Hopefully not.  It has obviously been a few years since we moved on from Christendom. We are now scattered across the country. We have pursued many different careers and paths. Some of us have kept in touch and some have not.</p> </td>
<td>&nbsp;</td>
<td valign="middle" align="center" width="30%"><img src="<?php /*if ($_SESSION['MemberID'] == 2) { */ echo '/images/site/Family-2_250x325.jpg'; /*} else { echo '/images/site/kgb_grossman.jpg'; } */ ?>" width="250" height="325" style="border:1px solid #333333;" /></td>
<td>&nbsp;</td>
<td rowspan="2" align="left" valign="top" width="30%"><p>&nbsp;&nbsp;&nbsp;And so I invite all of you to get involved with this, our website. It is here that we can look back to the past, keep in touch in the present, and look foward to the future. We will have a section devoted to the history of The Family.  Everyone is invited to write about their own memories and stories.  We will have a section for present news and events involving Family members, a section for posting pictures, and much more.  I think that this site has much potential, and so I am extremely excited about it.  I encourage everyone to get involved.</p> 
<p>&nbsp;&nbsp;&nbsp;A huge "Thank You" goes out to Bryan for conceiving the idea of the site.  He has been planning it and working on it for over a year now.  His efforts have not been overlooked- we thank you Hadro, for this would not have happened without you! And so I look foward to hearing from all of you very much.  We have all enter upon our post- Christendom lives, but lets continue to live as a Family.<br /><br /><div align="right">--- <strong>Schmittino</strong>&nbsp;&nbsp;&nbsp;</div></p></td>
	  <td>&nbsp;</td>
	  </tr>
	<tr> 
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td valign="top"><p>And yet we all share the same Family roots. Our countless memories and our friendship must still call to us and bind us together.</p> 

</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td colspan="5"><hr class="divider" /></td>
		<td>&nbsp;</td>
	</tr>
	
      <tr>
       <td>&nbsp;</td>
       <td align="left" valign="top" class="bodyFont2">
       <span class="headline">Recent Activity</span><br />
	  <?php 
	    include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/notifications.php');  ?>
	  
	  </td>
       <td>&nbsp;</td>
	  
          <td colspan="3" >
       <span class="headline">Message Board</span>
          <?php 
		  	include($_SERVER['DOCUMENT_ROOT'].'/messageboard/messageboard.php');
		  ?>
          </td>
          <td>&nbsp;</td>
	  </tr>
	  
</table>
<?php include($_SERVER['DOCUMENT_ROOT']."/lib/includes/footer.php"); ?>