<?php

$dbname = "uagrosite";
$dbuser = "root";
$dbpassword = "";
$dbhost = "localhost";

$db = mysqli_connect($dbhost, $dbuser, $dbpassword,$dbname);
if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$db2 = $dbname;
$dbport1 = '3306';

?>