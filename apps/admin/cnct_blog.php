<?php

$config['db_host1']  = 'localhost';
$config['db_user1']  = 'root';
$config['db_pass1']  = '';
$config['db_name1']  = 'blog';

foreach($config as $k => $v){
    define(strtoupper($k),$v);
}

@ $db = mysqli_connect(DB_HOST1, DB_USER1, DB_PASS1,DB_NAME1);
if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$db2 = DB_NAME1;
$dbport1 = '3306';
?>