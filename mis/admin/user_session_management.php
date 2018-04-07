<?php
 if(!isset (SesVar()) || !SesVar())
{

} 
else 
{

	if($view_permissions=="Yes")
	{
	
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e4" && $_REQUEST['function']=="list")
		{
		
		echo "<table align='center' width='1000' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='150'><u><b>User Type</b></u></td><td><u><b>User Name</b></u></td><td><u><b>Names</b></u></td><td width='150'><u><b>Postal</b></u></td><td width='150'><u><b>Physical</b></u></td><td><u><b>Tel</b></u></td><td><u><b>Fax</b></u></td><td><u><b>Email</b></u></td><td><u><b>Mobile</b></u></td><td><u><b>Country</b></u></td><td width='120'><u><b></b></u></td></tr>";

	
	
if($LimitedTozz == "Unlimited")
{
$limiter = "";
}
elseif($LimitedTozz == "Country")
{
$limiter = "WHERE (Country = '".$userCountry."')";
}
elseif($LimitedTozz == "User`s Organization")
{
$limiter = "WHERE (org = '".$org."') AND (Country = '".$userCountry."')";
}
elseif($LimitedTozz == "User`s Branch Only")
{
$limiter = "WHERE (Branch = '".$Branch."')";
}
else
{
$limiter = "WHERE (org = 'NIL') AND (Country = 'NIL')";
}
	
			$sel = "SELECT * FROM _user_acnts ".$limiter.";";
			//echo $sel;
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$userID = $row["userID"];
			$orgx = $row["org"];
			$FirstName = $row["FirstName"];
			$LastName = $row["LastName"];
			$typeName = $FirstName." ".$LastName;
			$postal = $row["Postal"];
			$physical = $row["Address"];
			$tel = $row["Telephone"];
			$fax = $row["Fax"];
			$email = $row["Email"];
			$Mobile = $row["Mobile"];
			$country = $row["Country"];
			$Status = $row["Status"];
			$typeCodex = $row["level"];
			$LoginName = $row["LoginName"];
			
			
				$selectType = "SELECT * FROM refer_users_types WHERE UserTypeCode = '".$typeCodex."';";
				@$resType = mysqli_query($db,$selectType);
				$rowType = mysqli_fetch_array($resType);
				$typeCode = $rowType["UserTypeName"];
			
			
			
	$select_onlinev = "SELECT * FROM online WHERE _idcry = '".$userID."';";
	$res_onlinev = mysqli_query($db,$select_onlinev);
	@$num_onlinev = mysqli_num_rows($res_onlinev);
		if($num_onlinev>="1")
		{
	$bn = $bn+1;
	$hj = explode(".",($bn/2));
	$d1 = $hj[0];
	$d2 = $hj[1];
	
	if($d2=="" || $d2=="0")
	{
	$bgcolor = "99FFFF";
	}
	else
	{
	$bgcolor = "ddffff";
	}
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($bn).") </td><td> &nbsp;&nbsp;".$typeCode."</td><td align='center' width='200'>".$LoginName."</td><td align='center' width='200'>".$typeName."</td><td width='150'>".$postal."</td><td width='150'>".$physical."</td><td>".$tel."</td><td>".$fax."</td><td>".$email."</td><td>".$Mobile."</td><td width='40'>".$country."</td><td align='center'><a href='?ref=settings&segment=e4&function=delete&unit=1&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$LoginName."'>Reset Session</a></td></tr>";
		}
	}
			
			echo "</table>";
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e4" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="1" && !$_REQUEST['submitBtn'] && $_REQUEST["typeID"])
		{
		
		
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<table align="center" width="700" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm the resetting of the session for the user '<?php echo $_REQUEST["typeName"]; ?>' username '<?php echo $_REQUEST["typeCode"]; ?>' <input name="submitBtn" type="submit" value="Reset"></td>
				</tr>
			</table>
			</form>
			<?php
		
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e4" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="1" && $_REQUEST['submitBtn']=="Reset")
		{
		$delete = "DELETE FROM online WHERE _idcry = '".$_REQUEST["typeID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "EReset User Session.";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}
		}
		else
		{
		//echo "test3";
		}

	}
	else
	{
	include "mis/access_denied.php";
	}
}
?>