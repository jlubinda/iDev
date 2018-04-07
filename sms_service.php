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

$pending_bookings = listBookingStatuses();

for($q=0; $q<$pending_bookings[0]['num']; $q++)
{
	searchRoutine($pending_bookings[$q]['userid']);
}
?>