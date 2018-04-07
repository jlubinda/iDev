
<?php
 if(!isset (SesVar()) || !SesVar())
{
include "home/home_index.php";
} 
else 
{


	//echo "<table align='center'><tr><td align='left'><b>Hello ".$FirstName.". Welcome to YC-MIS!</b> <br><br>Please ensure that you logout properly before closing the browser window, for proper session tracking. <br>Ensure also that you logout when you are leaving the computer to ensure the security of your data. <br><br>Thank you.</td></tr></table>";

include "home/home_index.php";

}
?>