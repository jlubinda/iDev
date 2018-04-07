<?php

$PageID = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
include_once "cnct.php";
include_once "sess.php";
include_once "plugins/includes/vars.php";
include_once "session.php";
include_once "mis/priv.php";
include_once "plugins/includes/functions.php";
include_once "mis/orgfiltermodule.php";
$lnk = themeurl();

if((isset($_POST['date']) && !($_POST['date']=="")) && (isset($_POST['dtype']) && !($_POST['dtype']=="")) && (isset($_POST['from']) && !($_POST['from']=="")) && (isset($_POST['status']) && !($_POST['status']=="")) && (isset($_POST['text']) && !($_POST['text']=="")) && (isset($_POST['type']) && !($_POST['type']=="")))
{
	if(INBOUND_SMS($_POST['from'],$_POST['text'],$_POST['status'],$_POST['date'],$_POST['dtype'],$_POST['type'])==1)
	{
		echo "1";
	}
	else
	{
		echo "0";
	}
}
else
{
	exit();
}
?>