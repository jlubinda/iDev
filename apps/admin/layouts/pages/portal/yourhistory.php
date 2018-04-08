<div style="float: left; min-width:280px; width:99%; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
		<?php 
	$SesVar = SesVar();

	$online = "SELECT * FROM online WHERE _sessid = '".$SesVar."';";
	$online_res = mysqli_query($db,$online);
	$row_online = mysqli_fetch_array($online_res);
	$uid = $row_online["_idcry"];

	$session_query = "SELECT * FROM _user_acnts WHERE userID = '".$uid."' AND (ACTIVE = '1' OR ACTIVE = 'Yes');";
	$sess_res = mysqli_query($db,$session_query);
	@$num_sess = mysqli_num_rows($sess_res);
	$row_sess = mysqli_fetch_array($sess_res);
	$userCountry = $row_sess["Country"];
	$userID = $row_sess["userID"];
	$Mobilex = $row_sess["Mobile"];
	$Emailx = $row_sess["Email"];
		
	$bookings = listBookings($Mobilex,$Emailx);
		
	for($a=0; $a<$bookings[0]['num']; $a++>=1)
	{
		?>
		<div style="margin:5px; float: left; width:300px;; padding:5px; background-color:#555;">
			<b>ORDER No.: </b><?php echo $bookings[$a]["order_id"];?>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $bookings[$a]['id'];?>&function=edit">
				<div style="float: right; margin:5px;">MODIFY BOOKING</div>
			</a>
		</div>
		<?php
	}
	?>
</div>