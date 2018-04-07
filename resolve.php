<section  id="topbox">
<?php

$error_message = "";

if($_POST["submitBtn"]=="REQUEST VERIFICATION CODE" && $_POST["Mobile"]=="") {
$error_message .= 'You must fill in your registered mobile number.<br />';
}
  
if($_POST["submitBtn"]=="REQUEST VERIFICATION CODE" && $err=="1")
{
echo "<p align='center' style='color:#fff000; font-size:11px;'>".$error_message."</p>";
}

if(($_POST["Mobile"]=="" && $_POST["submitBtn"]=="REQUEST VERIFICATION CODE") || $_POST["submitBtn"]=="")
{

echo "<div style=' color:#fff; font-weight:bold; width: 98%; max-width:480px; padding:0%; margin-left:auto; margin-right:auto;' align='center'>";
echo "<form action='' method='POST'>";

echo "<div style='float: left; color:#fff; font-weight:normal; background-color:#1f1f1f; font-size:11px; width: 100%; margin:0px; padding:0px; border-radius:0px;'><div style='float: left; padding:7px;'>Welcome to UAgro.co! Fill the form below to recover your account:</div></div>";

echo "<div style='float: left; width: 98%; max-width:480px; padding:1%; color:#333; font-size:11px; font-weight:normal; background-color: #eee;'><table align='center' style='float: left;'>";
	echo "<tr>";
		echo "<td align='left'>";
			echo "<b>YOUR REGISTERED MOBILE NUMBER: </b>";
		echo "</td>";
		echo "<td>";
			echo "<input name='Mobile' type='text' size='25' value='".$_POST["Mobile"]."' style='margin:5px;' placeholder='eg +260977665544'>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td align='left'>";
			echo "<label><div style='background-color:#fff; margin:5px; padding:5px; width:120px;'>GET NEW CODE <input name='t_Type' type='radio' size='25' value='NEW' style='width:13px; height:13px;'></div></label>";
			echo "<b></b>";
		echo "</td>";
		echo "<td>";
			echo "<label><div style='background-color:#fff; margin:5px; padding:5px; width:140px;'>ALREADY HAVE CODE <input name='t_Type' type='radio' size='25' value='OLD' style='width:13px; height:13px;'></div></label>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td width='50%'>";
		echo "</td>";
		echo "<td align='right' width='50%'>";
			echo "<input name='submitBtn' class='button' type='submit' size='25' value='REQUEST VERIFICATION CODE' style='margin:5px; background-color:#888; font-weight: bold;'>";
		echo "</td>";
	echo "</tr>";
echo "</table></div>";
echo "</form></div>";
}
elseif($_POST["submitBtn"]=="REQUEST VERIFICATION CODE" && !($_POST["Mobile"]==""))
{
	if($_POST["t_Type"]=="OLD")
	{
			
			echo "<div style=' color:#fff; font-weight:bold; width: 98%; max-width:480px; padding:0%; margin-left:auto; margin-right:auto;' align='center'>";
			echo "<form action='' method='POST'>";

			echo "<div style='float: left; color:#fff; font-weight:normal; background-color:#1f1f1f; font-size:11px; width: 100%; margin:0px; padding:0px; border-radius:0px;'><div style='float: left; padding:7px;'>Welcome to UAgro.co! Fill the form below to recover your account:</div></div>";

			echo "<div style='float: left; width: 98%; max-width:480px; padding:1%; color:#333; font-size:11px; font-weight:normal; background-color: #eee;'><table align='center' style='float: left;'>";
				echo "<tr>";
					echo "<td align='left'>";
						echo "<b>THE VERIFICATION CODE SENT TO YOUR MOBILE: </b>";
					echo "</td>";
					echo "<td>";
						echo "<input name='Mobile' type='hidden' size='25' value='".$_POST["Mobile"]."'>";
						echo "<input name='vCode' type='text' size='25' style='margin:5px;' placeholder='eg 01234'>";
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td width='50%'>";
					echo "</td>";
					echo "<td align='right' width='50%'>";
						echo "<input name='submitBtn' class='button' type='submit' size='25' value='VERIFY' style='margin:5px; background-color:#888; font-weight: bold;'>";
					echo "</td>";
				echo "</tr>";
			echo "</table></div>";
			echo "</form></div>";
	}
	elseif($_POST["t_Type"]=="NEW")
	{
		$vCode = genAccountVCode($_POST["Mobile"]);

		if($vCode==0)
		{
			echo "<div style='float: left; color:#fff; font-weight:normal; background-color:#1f1f1f; font-size:11px; width: 100%; margin:0px; padding:0px; border-radius:0px;'><div style='float: left; padding:7px;'>Sorry. There is a problem with your account. Please contact the VPortal Support Team for help: support@vehicleportal.co.zm</div></div>";
		}
		elseif($vCode=="-1")
		{
			echo "<div style='float: left; color:#fff; font-weight:normal; background-color:#1f1f1f; font-size:11px; width: 100%; margin:0px; padding:0px; border-radius:0px;'><div style='float: left; padding:7px;'>Sorry. You have already generated a Verification Code. You can generate a new one after 15 minutes or you can contact the UAgro Support Team for help: support@uagro.co</div></div>";
		}
		else
		{
			sendVCode($_POST["Mobile"],$vCode);
			
			echo "<div style=' color:#fff; font-weight:bold; width: 98%; max-width:480px; padding:0%; margin-left:auto; margin-right:auto;' align='center'>";
			echo "<form action='' method='POST'>";

			echo "<div style='float: left; color:#fff; font-weight:normal; background-color:#1f1f1f; font-size:11px; width: 100%; margin:0px; padding:0px; border-radius:0px;'><div style='float: left; padding:7px;'>Welcome to UAgro.co! Fill the form below to recover your account:</div></div>";

			echo "<div style='float: left; width: 98%; max-width:480px; padding:1%; color:#333; font-size:11px; font-weight:normal; background-color: #eee;'><table align='center' style='float: left;'>";
				echo "<tr>";
					echo "<td align='left'>";
						echo "<b>THE VERIFICATION CODE SENT TO YOUR MOBILE: </b>";
					echo "</td>";
					echo "<td>";
						echo "<input name='Mobile' type='hidden' size='25' value='".$_POST["Mobile"]."'>";
						echo "<input name='vCode' type='text' size='25' style='margin:5px;' placeholder='eg 01234'>";
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td width='50%'>(Please note the code is valid only for 15 minutes from the time you request for it)";
					echo "</td>";
					echo "<td align='right' width='50%'>";
						echo "<input name='submitBtn' class='button' type='submit' size='25' value='VERIFY' style='margin:5px; background-color:#888; font-weight: bold;'>";
					echo "</td>";
				echo "</tr>";
			echo "</table></div>";
			echo "</form></div>";
		}
	}
}
elseif($_POST["submitBtn"]=="VERIFY" && !($_POST["Mobile"]==""))
{
	if(endActiveSession($_POST["vCode"],$_POST["Mobile"])==1)
	{
		echo "<div style='float: left; color:#fff; font-weight:normal; background-color:#1f1f1f; font-size:11px; width: 100%; margin:0px; padding:0px; border-radius:0px;'><div style='float: left; padding:7px;'>SUCCESS! YOUR PREVIOUS SESSION HAS BEEN ENDED FOR YOU. <a href='./?ref=login' class='button'>CLICK HERE</a> TO LOGIN</div></div>";
	}
	else
	{
		echo "<div style='float: left; color:#fff; font-weight:normal; background-color:#1f1f1f; font-size:11px; width: 100%; margin:0px; padding:0px; border-radius:0px;'><div style='float: left; padding:7px;'>Sorry. The Verification Code you have provided is not correct. You can generate a new one after 15 minutes or contact the Uagro Support Team for help: support@uagro.co</div></div>";
	}
}
?>

<br class="clear"/>
</section>