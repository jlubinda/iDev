<?php

@ $db = mysql_connect("localhost", "root", "");
if (!$db)
{echo "<p><strong> Could not connect to database. "
."Please try again later.</strong></p></body></html>";
exit;
}
$db2 = "uagro";
$dbport1 = '3306';
@ mysql_select_db($db2);
?>