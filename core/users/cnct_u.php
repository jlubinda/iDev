<?php
//$dbname = "uagrlttm_vp";
//$dbuser = "uagrlttm_vp";
//$dbpassword = "Vehicleportal2016!";
//$dbhost = "localhost";

include "dbu.php";

@ $db = mysql_connect($dbhost, $dbuser, $dbpassword);
if (!$db)
{echo "<p><strong> Could not connect to database. "
."Please try again later.</strong></p></body></html>";
exit;
}
$db2 = $dbname;
$dbport1 = '3306';
@ mysql_select_db($db2);
?>