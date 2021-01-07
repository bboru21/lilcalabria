<?php /*<style>
ul.nav {
	width:100%;
	text-align:center;
}

.nav li {
	float:left;
	list-style:none;
}
</style>

<ul class="nav">
	<li><a href="<?php echo $config['urls']['baseurl']; ?>/">Home</a></li>
    <li><a href="<?php echo $config['urls']['baseurl'] . '/history/'; ?>">History</a></li>
    <li><a href="<?php echo $config['urls']['baseurl'].'/photos/'; ?>">Photos</a></li>
    <li><a href="<?php echo $config['urls']['baseurl'] . '/calendar/'; ?>">Calendar</a></li>
</ul> */ 
?>

<table cellpadding="5" cellspacing="0" width="800" class="nav1"; >
	<tr id="nav_tr1">
    	      
		<td align="center"><span class="navLink1"><a href="<?php echo $config['urls']['baseurl']; ?>/">Home</a></span></td>
        <td align="center">&nbsp;|&nbsp;</td>
		<?php if ($_SESSION['userinfo']['adminlevel'] > 0) {
			echo '	<td align="center"><span class="navLink1"><a href="' . $config['urls']['baseurl'] . '/history/">History</a></span></td>
					<td align="center">&nbsp;|&nbsp;</td>' ; }
        ?>
		<td align="center"><span class="navLink1"><a href="<?php echo $config['urls']['baseurl'].'/photos/'; ?>">Photos</a></span></td>
		
        <td align="center">&nbsp;|&nbsp;</td>
        <td align="center"><span class="navLink1"><a href="<?php echo $config['urls']['baseurl'] . '/calendar/'; ?>">Calendar</a></span></td>
	</tr>
</table>