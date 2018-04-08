<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

session_start();

if(isset($_POST['btn_price'])) //
{
	$_SESSION['booking'] = array('src'=>$_POST['btn_src'],'name'=>$_POST['btn_name'],'price'=>$_POST['btn_price'],'pID'=>$_POST['btn_pID']);

	echo count($_SESSION['booking']);
	exit();
}
?>