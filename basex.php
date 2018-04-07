<?php

error_reporting(E_ALL & ~E_NOTICE);

include_once "uid.php";
include_once "sess.php";
$PageID = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
include_once "plugins/includes/vars.php";
include_once "cnct.php";
include_once "session.php";
include_once "basex/priv.php";
include_once "plugins/includes/functions.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "misc/strict.dtd">
<html>
<head>
<link rel="icon" href="images/logo.gif" type="image/x-icon" />
<link rel="shortcut icon" href="images/logo.gif" type="image/x-icon" />
<title>BASE-X</title>
<?php
include_once "browser_detect.php";
$browser_name = $ua['name'];
?>
<?php
include_once "css.php";
?>

<script language="JavaScript">
function checkAll(theForm, cName, status) {
for (i=0,n=theForm.elements.length;i<n;i++)
if (theForm.elements[i].className.indexOf(cName) !=-1) {
theForm.elements[i].checked = status;
}
}
</script>
<?php
include_once "jquery.php";
?>
</head>
<body <?php
if($fg=="2")
{
?> id="test" onload="prettyPrint();"<?php
}
?>>
<table align="center" id="sysbg">
<tr>
<td  id="headA">
<table align="center" id="the_header">
<tr>
<td id="headerA">
<table width="100%">
<tr>
<td><?php
include_once "basex/regcomponent.php";
include_once "basex/basexnav.php";
?></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td id="navA">
<?php
include_once "basex/nav.php";
?>
</td>
</tr><?php
if(($_REQUEST["ref"]=="3" && $_REQUEST["segment"]) || (($_REQUEST["ref"] && $_REQUEST["segment"]) || ($_REQUEST["ref"]=="profile")) && !($_REQUEST["ref"]=="settings" && (($_REQUEST["segment"]=="e3") || ($_REQUEST["segment"]=="g1") || ($_REQUEST["segment"]=="c1") || ($_REQUEST["segment"]=="a1"))))
{
?>
<tr>
<td id="navB">
<?php
include_once "basex/navB.php";
?>
</td>
</tr><?php
}
?>
<tr>
<td id="mainbody">
<?php
include_once "basex/pages.php";
?>
</td>
</tr>
<tr>
<td id="mainbody2">
<?php include_once "basex/footer.php";?>
</td>
</tr>
</table>
</body>
</html>
