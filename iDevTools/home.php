<table align="center" width="100%" bgcolor="#ffffff" border="0" height="100%">
<tr>
<td>
<?php
if(chkSes()=="Active")
{

echo "<table align='center'><tr><td align='left'><b>Hello ".$FirstName.". Welcome to iDev - Your Development Framework!</b> <br><br>Please ensure that you logout properly before closing the browser window, for proper session tracking. <br>Ensure also that you logout when you are leaving the computer to ensure the security of your data. <br><br>Thank you.</td></tr></table>";

//include_once "home/home_index.php";

}
?></td>
</tr></table>