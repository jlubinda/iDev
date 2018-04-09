<?php

$config['db_host2']  = 'localhost';
$config['db_user2']  = 'root';
$config['db_pass2']  = '';
$config['db_name2']  = 'blog';

foreach($config as $k => $v){
    define(strtoupper($k),$v);
}

@ $db = mysqli_connect(DB_HOST2, DB_USER2, DB_PASS2,DB_NAME2);
if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$db2 = DB_NAME2;
$dbport1 = '3306';
?>
