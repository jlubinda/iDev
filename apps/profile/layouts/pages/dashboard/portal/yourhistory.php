<?php 
router(array("HEADER","profile"),"","",'','','file','');
if(chkSes()=="Active")
{
	$user = userData();
	$uid = $user["userID"];
	$Mobilex = $user["Mobile"];
	$Emailx = $user["Email"];
	$userID = $user["userID"];
	$AccountType = $user["AccountType"];
	$UserCode = $user["UserCode"];
	$org = $user["org"];
	$Branch = $user["Branch"];
	$Email = $user["Email"];
	$Mobile = $user["Mobile"];
	$LoginName = $user["LoginName"];
	$FirstName = $user["FirstName"];
	$LastName = $user["LastName"];
	$NickName = $user["NickName"];
	$_idxZx = $user["USER_PASS"];
	$Address = $user["Address"];
	$Postal = $user["Postal"];
	$Fax = $user["Fax"];
	$Telephone = $user["Telephone"];
	$Active = $user["Active"];
	$RecordEnteredBy = $user["RecordEnteredBy"];
	$Remarks = $user["Remarks"];
	$level = $user["level"];
	$userLevel = $user["level"];
	$userCountry = $user["Country"];
?>
<article class="container">
<?php
		
	$bookings = listBookings($Mobilex,$Emailx);
		
	for($a=0; $a<$bookings[0]['num']; $a++>=1)
	{
		?>
		<div class="row">
			<div class="col s12 l12">
			<b>ORDER No.: </b><?php echo $bookings[$a]["order_id"];?>
			<a class="right btn primary" href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/yourhistory.php&id=<?php echo $bookings[$a]['id'];?>&function=edit">MODIFY BOOKING</a>
			</div>
		</div>
		<?php
	}
?>
</article>
<hr><?php 
}
else
{
	include find_file("login.php");
}
router(array("FOOTER","profile"),"","",'','','file','');
?>