<?php

$config['db_host3']  = 'localhost';
$config['db_user3']  = 'applod5_cd_user';
$config['db_pass3']  = 'Citydrive2017#';
$config['db_name3']  = 'applod5_ecomm';

foreach($config as $k => $v){
    define(strtoupper($k),$v);
}

@ $db = mysqli_connect(DB_HOST3, DB_USER3, DB_PASS3,DB_NAME3);
if(mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$db2 = DB_NAME3;
$dbport1 = '3306';
?>