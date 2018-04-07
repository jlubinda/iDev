<?php
if(chkSes()=="Inactive")
{
?>
<link rel="stylesheet" type="text/css" href="css/nav2.css" />
<?php

if(isset ($_POST['login']) && ($_POST['login'] == 'Log in'))
{
//check_auth("USER_PASS",$_POST['searchterm'],"MD5","USER_ID",$_POST['users'],"users")

$uidx = check_auth("USER_PASS",$_POST['searchterm'],"","USER_ID",$_POST['users'],"users");
$uid = $uidx[0];
$lockout = $uidx[1];
$activeSess = $uidx[2];
$maxtime = $uidx[3];
$vCode = $uidx[4];

/** Validate captcha
if (!empty($_REQUEST['captcha']))
{
if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha'])
{
$captcha_message = "Invalid captcha";
$style = "background-color: #FF606C";
}
else
{
$captcha_message = "Valid captcha";
$style = "background-color: #CCFF99";
}

$request_captcha = htmlspecialchars($_REQUEST['captcha']);
unset($_SESSION['captcha']);
}
*/
$statusMsg = "";

if($activeSess=="-1")
{
$statusMsg .= "<p align='center'>Sorry. Wrong Log-In Details. Try again using correct details or <a href='?ref=recover'>click here for password recovery.</a></p>";
}

//if($_REQUEST['captcha']=="")
//{
//$statusMsg .= "<p align='center'>You have left the captcha field empty. Try again using correct details</p>";
//}

//if($captcha_message=="Invalid captcha")
//{
//$statusMsg .= "<p align='center'>Sorry. Wrong captcha. Try again using correct details.</a></p>";
//}

if($activeSess=="0")
{
$statusMsg .= "<p align='center'>Sorry. Your session could not be started. Please try again later.</p>";
}

if($lockout=="1")
{
$statusMsg .= "<p align='center'>You currently have an active session running. <a href='?ref=resolve&vCode=".$vCode."'>Click here to end it and log in again.</a></p>";
}

if($_POST["firsttimelogin"])
{
$ftlarray = createAccount("Administrator Superuser","MAIL AND SHOW PASSWORD",$_POST["adminEmail"],"","FIRST TIME LOGIN");

if($ftlarray['status']=="Account Created")
{
$statusMsg .= "<p align='center'>You have successfully configured your database. Now login as the Super User using the following details<br><b>Username:</b> 'com.admin' <br><b>Password:</b> ".$ftlarray['password']."</p>";
}
else
{
$statusMsg .= "<p align='center'>You have successfully configured your database. Now login as the Super User using the following details<br><b>Username:</b> 'com.admin' <br><b>Password:</b> ".$ftlarray['password']."</p>";
}
}
}

if ($_POST['login'] == 'Log in' && ($activeSess=="1" && $uid && $lockout=="0")/* && $captcha_message=="Valid captcha"*/ )
{
/* User successfully logged in, setting cookie */
$_SESSION[SesUID()] = $uid;
?>
<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
setTimeout("location.reload(true);",timeoutPeriod);
}
<?php
if($_REQUEST["ref"]=="" || $_REQUEST["ref"]=="login")
{
?>
window.location.replace("iDev.php");
<?php
}
else
{
?>
window.location.replace("iDev.php?ref=<?php echo $_REQUEST["ref"];?>");
<?php
}
?>


//   -->
</script>
<?php
}
else
{
?>
<table align='center' style=" width:390px; color: #000; margin-left: auto; margin-right: auto;" onload="document.getElementById('captcha-form').focus()">
<?php
echo "<tr>";
echo "<td>";
//echo "<img src='themes/".themeurl()."/img/logo.png' width='200' style='position: relative; top: 5px; right: 20px; float: right;'>";
echo "</td>";
echo "</tr>";
echo "<tr style=' width:100%;'>";
echo "<td style=' width:100%;'><form id='form1' name='form1' method='post' action=''>";
echo "<div style='float: left; margin: 5px; width:99%;'>";

echo $statusMsg;

if($_POST["firsttimelogin"])
{
$username = $_POST["adminuser"];
}
else
{
$username = $_POST["users"];
}
echo"</div>";

echo "<div style='float: left; margin: 5px; width:99%;'>";
echo "<div style='float: left; margin: 5px;'><b>Email: </b></div>";
echo "<div style='float: right; background-color:#FFA671;'><input name='users' type='text' value='".$username."' size='25' style=' float: left; position: relative; top: 0px; float: right; margin: 2px; background-color:#FFA671;'></div>";
echo "</div>";

echo "<div style='float: left; margin: 5px; width:99%;'>";
echo "<div style='float: left; margin: 5px;'><b>Password: </b></div>";
echo "<div style='float: right; background-color:#FFA671;'><input name='searchterm' type='password' size='25' style='position: relative; top: 0px; right: float: right; margin: 2px; background-color:#FFA671;'></div>";
echo "</div>";

?>
<div style='float: left; margin: 5px; width:99%;'>
<input style='width: 100px; float: right; margin-right: auto; height: 30px; font-size: 0px; font-weight: normal; text-decoration: none; background-image: url("themes/<?php echo themeurl(); ?>/images/img_05.png"); background-size: 100px; background-repeat: no-repeat; background-color: #EDEEEE; border:#FFFFFF solid 0px;' type='submit' name='login' value='Log in' /> &nbsp;&nbsp;
</div>
<?php
echo "</form>";
echo "</td></tr></table>";
}
}
else
{
//header("Location:  $link/a_index.php");
}
?>
