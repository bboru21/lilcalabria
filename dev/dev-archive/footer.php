</td>
<td>&nbsp;</td>
</tr>
<tr> 
	<td>&nbsp;</td>
	<td colspan="5"><hr size="1" color="#333333" width="100%" /></td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td colspan="5" style="text-align:center;">
    <span style="font-size:10px;">
    &copy; 2008, la Famaglia. To report any errors or for questions and comments, please send an e-mail to <a href="mailto:admin@lilcalabria.com">admin@lilcalabria.com</a>
    </span>
    </td>
    <td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td colspan="5"><hr size="1" color="#333333" width="100%" /></td>
	<td>&nbsp;</td>
</tr>

</table>


</td>
</tr>
</table>
<?php
	if (isset($_SESSION['userinfo']['id']) && $_SESSION['userinfo']['id'] == 1) {
		new dbug($_SESSION);
	}
?>
</body>
</html>
