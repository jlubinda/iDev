<section id="four_columns2"><h2>CHECKOUT</h2>
<p>
<font size="2">
<p> 
<strong>Transaction  Security </strong>: 
Vehicle Portal has taken all reasonable measures and steps to ensure that all financial transaction performed on our site are safe and secure.
However we strongly advice all customers transacting on our site to ensure they have strong passwords for there cards and both their card details and passwords are kept away from public eye.Further in view of the above, Vehicle portal does not guarantee 100% security and  shall not be held responsible for any card fraud as a result of customers not taking sufficient personal security measures.
</p>
</font>
</p>
<?php

if(@privacy('Free|Open')=='Granted')
{
//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) BELOW THIS LINE



//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) ABOVE THIS LINE



$PageID = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];

//0000
if($_REQUEST["type"]=="return" || $_REQUEST["type"]=="notify")
{
$dLx = $_SESSION["typename"];
$dLx2 = $_SESSION["typename2"];
}
else
{
$dLx = "dLx".$_REQUEST["idx"];
$dLx2 = "dLx2".$_REQUEST["idx"];
}

$dLx3 = "dLx3".$_REQUEST["custom"];

@$year2 = date(Y);
@$day2 = date(z);
@$hour2 = date(G);
@$hour22 = date(h);
@$mins2 = date(i);
@$sec2 = date(s);

$sess_id2 = rand(0, 999999998);
$sess_id22 = rand(999999999, 99999999999999998);
$sess_id32 = rand(99999999999999999, 9999999999999999999999999999999);

$timex2 = ($year2*365*24*60*60)+($day2*24*60*60)+($hour2*60*60)+($mins2*60)+$sec2;
$cccD = md5($timex2." |12A1| ".$sess_id32." |13B1| ".$sess_id22." |14C1| ".$sess_id2);

if(!($_REQUEST["order_id"]==""))
{

	$_SESSION["order_id"] = $_REQUEST["order_id"];

	if($_REQUEST["type"]=="return")
	{
		
		$array = getNotificationData($_REQUEST["custom"]);
			
		if(($_REQUEST["status"]=="0000" || $_REQUEST["Status"]=="0000"))
		{
			
			$vvCode = md5(trim($_REQUEST["custom"]).getQuoteData(trim($_REQUEST["order_id"]),"VID").trim($_REQUEST["payer_email"]));
			
			$vvCode2 = md5($_SESSION['custom'].getQuoteData($_SESSION['order_num'],"VID").$_SESSION['payer_email']);
			
			
			if($vvCode2==$vvCode)
			{

				$booking = bookVehicle($_REQUEST["order_id"]);

				if($booking>=1)
				{

					contactCityDrive($_REQUEST["order_id"]);
					searchRoutine($_REQUEST["order_id"]);
					/*
					?>
					<script type="text/JavaScript">
					<!--
					function timedRefresh(timeoutPeriod) {
					setTimeout("window.open('<?php echo $linkB."&payer_email=".$_REQUEST["payer_email"]."&vCode=".$_SESSION["vCode"]."&sesCode=".$_SESSION["sesCode"]."&uCode=".$_SESSION["uCode"]."&tokenx=".md5($_SESSION["vCode"].$timey.$_SESSION["sesCode"].$timey.$_SESSION["uCode"]); ?>','_parent');",timeoutPeriod);
					}
					//   -->
					</script>
					<body onload="JavaScript:timedRefresh(1);">
					<a href="<?php echo $linkB."&payer_email=".$_REQUEST["payer_email"]."&vCode=".$_SESSION["vCode"]."&sesCode=".$_SESSION["sesCode"]."&uCode=".$_SESSION["uCode"]."&tokenx=".md5($_SESSION["vCode"].$timey.$_SESSION["sesCode"].$timey.$_SESSION["uCode"]);?>" target="_parent"><div style="margin:10px; float: left; padding:5px; background-color:#555; font-weight: bold; color:#fff; border-radius:5px;">If your browser does not redirect automatically, click here to continue...</div></a>
					<?php
					*/

					if(createUserAccount($FirstName,$LastName,$LoginName,$NickName,$Mobile,$Email,$Password,$Country,"User","","","1","0")==1)
					{
					$AccountCreated = "";
					}
					else
					{
					$AccountCreated = "";
					}

					$unq3 = uniqueCode();
					$_SESSION['confcode'] = md5($unq3.$invoiceNumber.$numDays.$first_name.' '.$last_name.getActualPrice($_REQUEST["id"],$typed).getVehicleCategory(viewVehicle($_REQUEST["id"],"VEHICLE TYPE")).$mileage_charge.$distance.$driver_rate.$vat.$vatpayable.$currency);
					$qcode3 = $unq3;
					?>
					<p style="width:98%; padding:5px;">
					SUCCESS! Please check your email for the Booking Confirmation Letter.
					</p>
					<?php
					
					$_SESSION['ontr'] = "";
					$_SESSION['custom'] = "";
					unset($_SESSION['ontr']);
					unset($_SESSION['custom']);
				}
				else
				{
					$unq3 = uniqueCode();
					$_SESSION['confcode'] = md5($unq3.$invoiceNumber.$numDays.$first_name.' '.$last_name.getActualPrice($_REQUEST["id"],$typed).getVehicleCategory(viewVehicle($_REQUEST["id"],"VEHICLE TYPE")).$mileage_charge.$distance.$driver_rate.$vat.$vatpayable.$currency);
					$qcode3 = $unq3;
					
					$message = "";
					$names = getQuoteData($_REQUEST["order_id"],"NAMES");
					$qty = getQuoteData($_REQUEST["order_id"],"NUM DAYS");
					$price = getActualPrice(getQuoteData($_REQUEST["order_id"],"VID"),$typed);
					$vtype = getVehicleCategory(viewVehicle(getQuoteData($_REQUEST["order_id"],"VID"),"VEHICLE TYPE"));
					$mileage_charge = $mileage_charge;
					$distance = $distance;
					$driver_rate = $driver_rate;
					$vat = $vat;
					$vatpayable = $vatpayable;
					$currency = $currency;
					$qcode = $qcode;
					
					email("VEHICLE PORTAL BOOKING CONFIRMATION",$message,"reservations@vehicleportal.co.zm",$_REQUEST["payer_email"]);
					?>
					<p style="width:98%; padding:5px;">
						SUCCESS! Contact Support for further assistance and please check your email for the Booking Confirmation Letter, or your can <a href="./documents/confirmationletter.php?names=<?php echo getQuoteData($_REQUEST["order_id"],"NAMES");?>&qty=<?php echo getQuoteData($_REQUEST["order_id"],"NUM DAYS");?>&price=<?php echo getActualPrice(getQuoteData($_REQUEST["order_id"],"VID"),$typed);?>&vtype=<?php echo getVehicleCategory(viewVehicle(getQuoteData($_REQUEST["order_id"],"VID"),"VEHICLE TYPE"));?>&mileage_charge=<?php echo $mileage_charge;?>&distance=<?php echo $distance;?>&driver_rate=<?php echo $driver_rate;?>&vat=<?php echo $vat;?>&vatpayable=<?php echo $vatpayable;?>&currency=<?php echo $currency;?>&qcode=<?php echo $qcode;?>" class="button">Click Here</a> to download now in PDF.
					</p>
					<?php
					$_SESSION['ontr'] = "";
					$_SESSION['custom'] = "";
					unset($_SESSION['ontr']);
					unset($_SESSION['custom']);
				}
			}
			else
			{
					$_SESSION['ontr'] = "";
					$_SESSION['custom'] = "";
					unset($_SESSION['ontr']);
					unset($_SESSION['custom']);
				echo "<p>Error in Transaction has been detected! Please try again using the correct procedure.</p>";
			}
		}
		elseif($_REQUEST["status"]=="0001" || $_REQUEST["Status"]=="0001")
		{
		?>
		<p style="width:98%; padding:5px;">
			TRANSACTION WAS ABORTED.
		</p>
		<?php
					$_SESSION['ontr'] = "";
					$_SESSION['custom'] = "";
					unset($_SESSION['ontr']);
					unset($_SESSION['custom']);
		}
		elseif($_REQUEST["status"]=="0002" || $_REQUEST["Status"]=="0002")
		{
		?>
		<p style="width:98%; padding:5px;">
			YOU HAVE CANCELLED THE PAYMENT.
		</p>
		<?php
					$_SESSION['ontr'] = "";
					$_SESSION['custom'] = "";
					unset($_SESSION['ontr']);
					unset($_SESSION['custom']);
		}
		elseif($_REQUEST["status"]=="0003" || $_REQUEST["Status"]=="0003")
		{
		?>
		<p style="width:98%; padding:5px;">
			TRANSACTION WAS NOT AUTHORIZED.
		</p>
		<?php
					$_SESSION['ontr'] = "";
					$_SESSION['custom'] = "";
					unset($_SESSION['ontr']);
					unset($_SESSION['custom']);
		}
		elseif($_REQUEST["status"]=="0004" || $_REQUEST["Status"]=="0004")
		{
		?>
		<p style="width:98%; padding:5px;">
			PAYMENT IS PENDING.
		</p>
		<?php
					$_SESSION['ontr'] = "";
					$_SESSION['custom'] = "";
					unset($_SESSION['ontr']);
					unset($_SESSION['custom']);
		}

	}
	elseif($_REQUEST["type"]=="cancel")
	{

		include "links.php";
		$link = "./";


		if($_REQUEST["ref"] && $_REQUEST["segment"] && $_REQUEST["function"] && $_REQUEST["unit"])
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}
		elseif($_REQUEST["ref"] && $_REQUEST["segment"] && $_REQUEST["function"] && !$_REQUEST["unit"])
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}
		elseif($_REQUEST["ref"] && $_REQUEST["segment"] && !$_REQUEST["function"] && !$_REQUEST["unit"])
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&segment=".$_REQUEST["segment"]."&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}
		elseif($_REQUEST["ref"] && !$_REQUEST["segment"] && !$_REQUEST["function"] && !$_REQUEST["unit"])
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}
		else
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}


		@$year = date(Y);
		@$day = date(z);
		@$hour = date(G);
		@$hour2 = date(h);
		@$mins = date(i);
		@$sec = date(s);

		$sess_id = rand(0, 9999999999998);
		$sess_id2 = rand(9999999999999, 999999999999999999998);
		$sess_id3 = rand(999999999999999999999, 99999999999999999999999999999999999);

		$timex = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60)+($mins*60)+$sec;
		$timey = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60);
		$cccA = md5($timex." || ".$sess_id." || ".$userID." || ".$_SESSION[SesUID()]);
		$cccB = md5($timex." |L| ".$sess_id2." |M| ".$userID." |N| ".$_SESSION[SesUID()]);
		$cccC = md5($timex." |12A| ".$sess_id3." |13B| ".$userID." |14C| ".$_SESSION[SesUID()]);


		$_SESSION["vCode"] = $cccA;
		$_SESSION["sesCode"] = $cccB;
		$_SESSION["uCode"] = $cccC;
		$_SESSION["hour"] = $hour;
		$_SESSION["order_id"] = $_REQUEST["order_id"];
		$_SESSION["hash"] = md5($_REQUEST["order_id"]."-".$_REQUEST["custom"]."-".$_REQUEST["status"]."-".$_REQUEST["payer_email"]."-".$timey."-".$_SESSION["vCode"]);

		?>
		<script type="text/JavaScript">
		<!--
		function timedRefresh(timeoutPeriod) {
		setTimeout("window.open('<?php echo $linkB."&payer_email=".$_REQUEST["payer_email"]."&vCode=".$_SESSION["vCode"]."&sesCode=".$_SESSION["sesCode"]."&uCode=".$_SESSION["uCode"]."&tokenx=".md5($_SESSION["vCode"].$timey.$_SESSION["sesCode"].$timey.$_SESSION["uCode"]); ?>','_parent');",timeoutPeriod);
		}
		//   -->
		</script>
		<body onload="JavaScript:timedRefresh(1);">
		<a href="<?php echo $linkB."&payer_email=".$_REQUEST["payer_email"]."&vCode=".$_SESSION["vCode"]."&sesCode=".$_SESSION["sesCode"]."&uCode=".$_SESSION["uCode"]."&tokenx=".md5($_SESSION["vCode"].$timey.$_SESSION["sesCode"].$timey.$_SESSION["uCode"]);?>" target="_parent"><div style="margin:10px; float: left; padding:5px; background-color:#555; font-weight: bold; color:#fff; border-radius:5px;">If your browser does not redirect automatically, click here to continue...</div></a>
		<?php
	}
	elseif($_REQUEST["type"]=="notify")
	{

		include "links.php";
		$link = "./";


		if($_REQUEST["ref"] && $_REQUEST["segment"] && $_REQUEST["function"] && $_REQUEST["unit"])
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}
		elseif($_REQUEST["ref"] && $_REQUEST["segment"] && $_REQUEST["function"] && !$_REQUEST["unit"])
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}
		elseif($_REQUEST["ref"] && $_REQUEST["segment"] && !$_REQUEST["function"] && !$_REQUEST["unit"])
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&segment=".$_REQUEST["segment"]."&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}
		elseif($_REQUEST["ref"] && !$_REQUEST["segment"] && !$_REQUEST["function"] && !$_REQUEST["unit"])
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}
		else
		{
		$linkB = $link."?ref=".iDevSite("STORE URL").".php&order_id=".$_REQUEST["order_id"]."&status=".$_REQUEST["status"]."&status=".$_REQUEST["status"]."&custom=".$_REQUEST["custom"];
		}


		@$year = date(Y);
		@$day = date(z);
		@$hour = date(G);
		@$hour2 = date(h);
		@$mins = date(i);
		@$sec = date(s);

		$sess_id = rand(0, 9999999999998);
		$sess_id2 = rand(9999999999999, 999999999999999999998);
		$sess_id3 = rand(999999999999999999999, 99999999999999999999999999999999999);

		$timex = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60)+($mins*60)+$sec;
		$timey = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60);
		$cccA = md5($timex." || ".$sess_id." || ".$userID." || ".$_SESSION[SesUID()]);
		$cccB = md5($timex." |L| ".$sess_id2." |M| ".$userID." |N| ".$_SESSION[SesUID()]);
		$cccC = md5($timex." |12A| ".$sess_id3." |13B| ".$userID." |14C| ".$_SESSION[SesUID()]);


		$_SESSION["vCode"] = $cccA;
		$_SESSION["sesCode"] = $cccB;
		$_SESSION["uCode"] = $cccC;
		$_SESSION["hour"] = $hour;
		$_SESSION["order_id"] = $_REQUEST["order_id"];
		$_SESSION["hash"] = md5($_REQUEST["order_id"]."-".$_REQUEST["custom"]."-".$_REQUEST["status"]."-".$_REQUEST["payer_email"]."-".$timey."-".$_SESSION["vCode"]);

		?>
		<script type="text/JavaScript">
		<!--
		function timedRefresh(timeoutPeriod) {
		setTimeout("window.open('<?php echo $linkB."&payer_email=".$_REQUEST["payer_email"]."&vCode=".$_SESSION["vCode"]."&sesCode=".$_SESSION["sesCode"]."&uCode=".$_SESSION["uCode"]."&tokenx=".md5($_SESSION["vCode"].$timey.$_SESSION["sesCode"].$timey.$_SESSION["uCode"]); ?>','_parent');",timeoutPeriod);
		}
		//   -->
		</script>
		<body onload="JavaScript:timedRefresh(1);">
		<a href="<?php echo $linkB."&payer_email=".$_REQUEST["payer_email"]."&vCode=".$_SESSION["vCode"]."&sesCode=".$_SESSION["sesCode"]."&uCode=".$_SESSION["uCode"]."&tokenx=".md5($_SESSION["vCode"].$timey.$_SESSION["sesCode"].$timey.$_SESSION["uCode"]);?>" target="_parent"><div style="margin:10px; float: left; padding:5px; background-color:#555; font-weight: bold; color:#fff; border-radius:5px;">If your browser does not redirect automatically, click here to continue...</div></a>
		<?php
	}
}
else
{

	if(($_REQUEST["fromcity"]=="" || $_REQUEST["tocity"]=="" || $_REQUEST["pick_date"]=="" || $_REQUEST["pick_location"]=="" || $_REQUEST["dropoff_date"]=="" || $_REQUEST["dropoff_location"]=="") || $_REQUEST["b_hire_details"]=="AMEND")
	{
		$step = 1;
	}
	else
	{
		if(chkSes()=="Inactive")
		{
			if(($_REQUEST["first_name"]=="" || $_REQUEST["last_name"]=="" || $_REQUEST["phone"]=="" || $_REQUEST["email"]=="") || $_REQUEST["b_contact_details"]=="AMEND")
			{
				$step = 2;
			}
			else
			{
				if($_REQUEST["mxm"]==1)
				{
					$step = 3;
				}
				else
				{
					$step = 3;
				}
			}
		}
		else
		{
			if($_REQUEST["mxm"]==1)
			{
				$step = 3;
			}
			else
			{
				$step = 3;
			}
		}
	}
				
				
	if($step>=3)
	{
		?>
		<div class="control-group" style="float: left; width:240px; margin:15px;">
			<div class="controls">
				<article class="img-item">
					<div class="control-group">
						<div class="controls">
							<div class="error left-align" id="err-name"><strong><u>YOUR VEHICLE OF CHOICE</u></strong></div>
						</div>
					</div><br>
					<strong style="font-size:14px;"><?php echo viewVehicle($_REQUEST["id"],"MAKE");?></strong><br>
					<span style="float:right; font-size:12px;"><?php echo viewVehicle($_REQUEST["id"],"YEAR")." model"; ?></span>
					<figure>
						<img src="images/<?php echo getVehicleCoverImage($_REQUEST["id"]);?>" alt="<?php echo viewVehicle($_REQUEST["id"],"MAKE")."  - ".viewVehicle($_REQUEST["id"],"YEAR")." model"; ?>" width="240" />

						<figcaption style="width: 230px;">
							<span style='font-size:12px;'>K<?php echo number_format(getActualPrice($_REQUEST["id"],"WITHIN"),2);?> / day (Within <?php echo getTown(viewVehicle($_REQUEST["id"],"LOCATION"));?>)</span>
							<span style='font-size:12px;'>K<?php echo number_format(getActualPrice($_REQUEST["id"],"OUTSIDE"),2);?> / day (Outside <?php echo getTown(viewVehicle($_REQUEST["id"],"LOCATION"));?>)</span>
						</figcaption>
					</figure>
				</article>
				<br>
				<a class="button" href="./?ref=<?php echo iDevSite("STORE URL");?>.php&id=&action=&fromcity=<?php echo $_REQUEST['fromcity'];?>&tocity=<?php echo $_REQUEST['tocity'];?>&pick_date=<?php echo $_REQUEST['pick_date'];?>&pick_time=<?php echo $_REQUEST['pick_time'];?>&pick_location=<?php echo $_REQUEST['pick_location'];?>&dropoff_date=<?php echo $_REQUEST['dropoff_date'];?>&dropoff_time=<?php echo $_REQUEST['dropoff_time'];?>&dropoff_location=<?php echo $_REQUEST['dropoff_location'];?>&dropoff_country=<?php echo $_REQUEST['dropoff_country'];?>&chuffer=<?php echo $_REQUEST['chuffer'];?>&adults=<?php echo $_REQUEST['adults'];?>&children=<?php echo $_REQUEST['children'];?>&first_name=<?php echo $first_name;?>&last_name=<?php echo $last_name;?>&phone=<?php echo $phone;?>&email=<?php echo $email;?>">
					<strong>CHANGE VEHICLE</strong>
				</a>
			</div>
		</div>

		<div class="control-group" style="float: left; margin:15px;">
		<div class="control-group">
		<div class="controls">
		<div class="error left-align" id="err-name"><strong><u>QUOTATION</u></strong></div>
		</div>
		</div><br>
		<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
		<div class="error left-align" id="err-name"><strong>Number of Days: </strong>
		<?php

		if(chkSes()=="Active")
		{
		$userdata = userData();
		$first_name = $userdata["FirstName"];
		$last_name = $userdata["LastName"];
		$phone = $userdata["Mobile"];
		$email = $userdata["Email"];
		}
		else
		{
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		}

		//$pickup_datex = getdate($_REQUEST["pick_date"]);
		//$droping_off_datex = getdate($_REQUEST["dropoff_date"]);

		//$pickup_date = $pickup_datex["mday"]."-".$pickup_datex["mon"]."-".$pickup_datex["year"]." @ ".$pickup_datex["hours"].":".$pickup_datex["minutes"];
		//$droping_off_date = $droping_off_datex["mday"]."-".$droping_off_datex["mon"]."-".$droping_off_datex["year"]." @ ".$droping_off_datex["hours"].":".$droping_off_datex["minutes"];

		$pickup_date = date("d-m-Y @ H:i", $_REQUEST["pick_date"]);
		$droping_off_date = date("d-m-Y @ H:i", $_REQUEST["dropoff_date"]);

		$pickup_dateD = date("d-m-Y", $_REQUEST["pick_date"]);
		$droping_off_dateD = date("d-m-Y", $_REQUEST["dropoff_date"]);

		$pickup_time = date("H:i", $_REQUEST["pick_date"]);
		$droping_off_time = date("H:i", $_REQUEST["dropoff_date"]);

		$cot = "10:00";
		$cut_off_time = date("H:i",strtotime($cot));

		//echo $pickup_date;

		$pku = explode("@", $pickup_date);
		$dku = explode("@", $droping_off_date);
		$ptime = trim($pku[1]);
		$dtime = trim($dku[1]);

		$ptmx = explode(":",$ptime);
		$dtmx = explode(":",$dtime);

		$phours = $ptmx[0];
		$pmins = $ptmx[1];

		$dhours = $dtmx[0];
		$dmins = $dtmx[1];

		$pickupdate = trim($pku[0]);
		$dropoff_date = trim($dku[0]);

		$dtxp = explode("-",$pickup_date);
		$dtxd = explode("-",$droping_off_date);

		$yeardaysp = days_in_year($pickupdate);
		$yeardaysd = days_in_year($dropoff_date);
		$monthdaysp = days_in_month($pickupdate);
		$monthdaysd = days_in_month($dropoff_date);
		$dayp = $dtxp[0];
		$dayd = $dtxp[0];
		$monthp = $dtxp[1];
		$monthd = $dtxp[1];
		$yearp = $dtxp[2];
		$yeard = $dtxp[2];

		$numDaysx = (((($yeard-1)*365.25)+date("z",strtotime($dropoff_date))+(($dhours/24)+($dmins/(24*60)))) - ((($yearp-1)*365.25)+date("z",strtotime($pickupdate))+(($phours/24)+($pmins/(24*60)))));

		$nmx = explode(".",$numDaysx);
		$nmxx = "0.".$nmx[1];

		$nmxx = $nmxx+0;

		if($numDaysx>=1)
		{
			if($nmxx<0.51)
			{
				$numDaysx2 = $nmx[0];
			}
			else
			{
				$numDaysx2 = $nmx[0]+1;
			}
		}
		else
		{
			$numDaysx2 = 1;
		}

		if($numDaysx2==1 && $pickup_dateD==$droping_off_dateD)
		{
			$numDays = 1;
		}
		elseif($numDaysx2==1 && !($pickup_dateD==$droping_off_dateD))
		{
			if($droping_off_time<=$cut_off_time)
			{
				$numDays = 1;
			}
			else
			{
				$numDays = 2;
			}
		}
		else
		{
			if($droping_off_time<=$cut_off_time)
			{
				$numDays = $numDaysx2;
			}
			else
			{
				$numDays = $numDaysx2+1;
			}
		}


		if($numDays==1)
		{
		$daytxt = "day";
		}
		else
		{
		$daytxt = "days";
		}
		echo  $numDays." ".$daytxt;?> 
		</div>
		</div>
		</div>

		<?php
		$tocityx = explode(",",$_REQUEST['tocity']);

		$tocity = $tocityx[0];

		$driving_from_array = getLocationDetails($_REQUEST["pickup_location"].", ".getTown($_REQUEST["fromcity"]).", ".getTown($_REQUEST["fromcity"],"COUNTRY"));
		$driving_to_array = getLocationDetails($_REQUEST["tocity"]);
		$dropoff_array = getLocationDetails($_REQUEST["dropoff_location"].", ".$_REQUEST["dropoff_country"]);
		$vehicle_location_array = getLocationDetails(getTown(viewVehicle($_REQUEST["id"],"LOCATION")).", ".getTown(viewVehicle($_REQUEST["id"],"COUNTRY")));

		if((($driving_from_array['country']==$driving_to_array['country']) && ($driving_from_array['town']==$driving_to_array['town'])) && (($driving_from_array['country']==$vehicle_location_array['country']) && ($driving_from_array['town']==$vehicle_location_array['town'])))
		{
		$typed = "WITHIN";
		}
		else
		{
		$typed = "OUT OF TOWN";
		}

		//echo "Hire Type: ".$typed."<br>";
		/*
		&chuffer=<?php echo $_REQUEST['chuffer'];?>&adults=<?php echo $_REQUEST['adults'];?>&children=<?php echo $_REQUEST['children'];?>
		*/
		?>
		<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
		<div class="error left-align" id="err-name"><strong>Price Per Day: </strong>
		K<?php echo number_format(getActualPrice($_REQUEST["id"],$typed),2);?></div>
		</div>
		</div>
		<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
		<div class="error left-align" id="err-name"><strong>Hire Total: </strong>
		K<?php echo number_format((getActualPrice($_REQUEST["id"],$typed)*$numDays),2);?></div>
		</div>
		</div>
		<?php

		$amountb = getActualPrice($_REQUEST["id"],$typed)*$numDays;

		if($_REQUEST["chuffer"]=="Yes")
		{
		?>
		<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
		<div class="error left-align" id="err-name"><strong>Driver Daily rate: </strong>
		K<?php echo number_format(getDriverRate($typed),2);?></div>
		</div>
		</div>
		<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
		<div class="error left-align" id="err-name"><strong>Driver Total: </strong>
		K<?php echo number_format((getDriverRate($typed)*$numDays),2);?></div>
		</div>
		</div>
		<?php
		$amountv = getDriverRate($typed)*$numDays;
		$driver_rate = getDriverRate($typed);
		}
		else
		{
		$amountv = 0;
		$driver_rate = 0;
		}


		if($numDays==1)
		{
			$distance_array = getDistance($driving_from_array['formatted_address'],$driving_to_array['formatted_address'])+getDistance($driving_to_array['formatted_address'],$dropoff_array['formatted_address']);
			$distance = round($distance_array['distance_value']/1000);
		}
		else
		{
			$distance = 0;
		}


		if(!(($driving_from_array['country']==$vehicle_location_array['country']) && ($driving_from_array['town']==$vehicle_location_array['town'])) && !(($dropoff_array['country']==$vehicle_location_array['country']) && ($dropoff_array['town']==$vehicle_location_array['town'])))
		{
			$oneway_rental = 2;
			$busfare = getBusFare(getTownID($vehicle_location_array['town']),getTownID($driving_from_array['town']))+getBusFare(getTownID($vehicle_location_array['town']),getTownID($dropoff_array['town']));
			$oneway_distance_array = getDistance($vehicle_location_array['formatted_address'],$driving_from_array['formatted_address'])+getDistance($vehicle_location_array['formatted_address'],$dropoff_array['formatted_address']);
			$oneway_distance = round($oneway_distance_array['distance_value']/1000);
		}
		elseif(((($driving_from_array['country']==$vehicle_location_array['country']) && ($driving_from_array['town']==$vehicle_location_array['town'])) && !(($dropoff_array['country']==$vehicle_location_array['country']) && ($dropoff_array['town']==$vehicle_location_array['town']))) || (!(($driving_from_array['country']==$vehicle_location_array['country']) && ($driving_from_array['town']==$vehicle_location_array['town'])) && (($dropoff_array['country']==$vehicle_location_array['country']) && ($dropoff_array['town']==$vehicle_location_array['town']))))
		{
			$oneway_rental = 1;
			
			if((($driving_from_array['country']==$vehicle_location_array['country']) && ($driving_from_array['town']==$vehicle_location_array['town'])) && !(($dropoff_array['country']==$vehicle_location_array['country']) && ($dropoff_array['town']==$vehicle_location_array['town'])))
			{
				$busfare =  getBusFare(getTownID($vehicle_location_array['town']),getTownID($dropoff_array['town']));
				$oneway_distance_array = getDistance($vehicle_location_array['formatted_address'],$dropoff_array['formatted_address']);
				$oneway_distance = round($oneway_distance_array['distance_value']/1000);
			}
			elseif(!(($driving_from_array['country']==$vehicle_location_array['country']) && ($driving_from_array['town']==$vehicle_location_array['town'])) && (($dropoff_array['country']==$vehicle_location_array['country']) && ($dropoff_array['town']==$vehicle_location_array['town'])))
			{
				$busfare =  getBusFare(getTownID($vehicle_location_array['town']),getTownID($driving_from_array['town']));
				$oneway_distance_array = getDistance($vehicle_location_array['formatted_address'],$driving_from_array['formatted_address']);
				$oneway_distance = round($oneway_distance_array['distance_value']/1000);
			}
			
		}
		else
		{
			$oneway_rental = 0;
			$busfare = 0;
			$oneway_distance = 0;
		}


		if($oneway_rental>=1)
		{
			if($oneway_rental==2)
			{
				$rentalTXT = "One";
			}
			elseif($oneway_rental==1)
			{
				$rentalTXT = "One";
			}
			
			$oneway_rental_fee = $busfare+(($oneway_distance/viewVehicle($_REQUEST["id"],"FUEL CONSUMPTION RATE")) * getPumpPrice(viewVehicle($_REQUEST["id"],"FUEL TYPE")));
			//$oneway_rental_fee = 1000;
			?>
			<div class="control-group" style="font-size:12px; margin:5px;">
				<div class="controls">
					<div class="error left-align" id="err-name"><strong><?php echo $rentalTXT;?> Way Rental Fee: </strong>
						K<?php echo number_format($oneway_rental_fee,2);?>
					</div>
				</div>
			</div>
			<?php
		}
		else
		{
			$oneway_rental_fee = 0;
		}


		if($numDays==1)
		{
			?>
			<div class="control-group" style="font-size:12px; margin:5px;">
			<div class="controls">
			<div class="error left-align" id="err-name"><strong>Mileage Rate Per Kilometer: </strong>
			K<?php echo number_format(getMileageCharge(viewVehicle($_REQUEST["id"],"TYPE")),2);?></div>
			</div>
			</div>
			<div class="control-group" style="font-size:12px; margin:5px;">
			<div class="controls">
			<div class="error left-align" id="err-name"><strong>Mileage Total: </strong>
			K<?php echo number_format((getMileageCharge(viewVehicle($_REQUEST["id"],"TYPE"))*$distance),2);?></div>
			</div>
			</div>
			<?php
			$amountf = getMileageCharge(viewVehicle($_REQUEST["id"],"TYPE"))*$distance;
			$mileage_charge = getMileageCharge(viewVehicle($_REQUEST["id"],"TYPE"));
		}
		else
		{
			$amountf = 0;
			$mileage_charge = 0;
		}
		?>
		<div class="control-group" style="font-size:12px; margin:5px;">
			<div class="controls">
				<div class="error left-align" id="err-name"><strong>GRAND TOTAL: </strong>K<?php echo number_format(($oneway_rental_fee+$amountb+$amountv+$amountf),2);?></div>
			</div>
		</div>
		<div class="control-group" style="font-size:12px; margin:5px;">
			<div class="controls">
				<div class="error left-align" id="err-name">&nbsp;</div>
			</div>
		</div>
		<div class="control-group" style="font-size:12px; margin:5px;">
			<div class="controls">
			<?php

			$amount = getActualPrice($_REQUEST["id"],$typed)*$numDays;
			$hiredetails = "";


			$quotationNumber = quoteForVehicle($_REQUEST["id"],$first_name.' '.$last_name,$email,$phone,$numDays,getActualPrice($_REQUEST["id"],$typed),getVehicleCategory(viewVehicle($_REQUEST["id"],"VEHICLE TYPE")),$mileage_charge,$distance,$driver_rate,$currency,$oneway_rental_fee,$pickup_date);
			$invoiceNumber = invoiceForVehicle($_REQUEST["id"],$first_name.' '.$last_name,$email,$phone,$numDays,getActualPrice($_REQUEST["id"],$typed),getVehicleCategory(viewVehicle($_REQUEST["id"],"VEHICLE TYPE")),$mileage_charge,$distance,$driver_rate,$currency,$oneway_rental_fee,$pickup_date);
			
			$unq = uniqueCode();
			$unq2 = uniqueCode();
			$unq3 = md5(uniqueCode().$email.$phone.$_REQUEST["id"]);
			$_SESSION['quotecode'] = md5($unq.$oneway_rental_fee.$quotationNumber.$numDays.$first_name.' '.$last_name.getActualPrice($_REQUEST["id"],$typed).getVehicleCategory(viewVehicle($_REQUEST["id"],"VEHICLE TYPE")).$mileage_charge.$distance.$driver_rate.$vat.$vatpayable.$currency);
			$_SESSION['invcode'] = md5($unq2.$oneway_rental_fee.$invoiceNumber.$numDays.$first_name.' '.$last_name.getActualPrice($_REQUEST["id"],$typed).getVehicleCategory(viewVehicle($_REQUEST["id"],"VEHICLE TYPE")).$mileage_charge.$distance.$driver_rate.$vat.$vatpayable.$currency);
			$_SESSION['custom'] = $unq3;
			$_SESSION['order_num'] = $invoiceNumber;
			$_SESSION['payer_email'] = $email;
			
			$quantityFC = 1;
			
			$_SESSION['ontr'] = md5($unq3.$_REQUEST["id"].$email);
			$qcode = $unq;
			$qcode2 = $unq2;
			

			flocashCheckout($invoiceNumber,$unq3,(($amountb+$amountv+$amountf+$oneway_rental_fee)/2),(($amountb+$amountv+$amountf+$oneway_rental_fee)/2),$quantityFC,$first_name,$last_name,$email,$phone,"","","PAY 50% TO RESERVE NOW");
			echo "<br>";
			flocashCheckout($invoiceNumber,$unq3,($amountb+$amountv+$amountf+$oneway_rental_fee),($amountb+$amountv+$amountf+$oneway_rental_fee),$quantityFC,$first_name,$last_name,$email,$phone,"","","PAY THE WHOLE AMOUNT");
			
			if($quotationNumber>=1 && $invoiceNumber>=1)
			{
				?>
				<br>
				<a class="button" href="./documents/quotation.php?qnum=<?php echo $quotationNumber; ?>&nrf=<?php echo $rentalTXT;?>&rentalfee=<?php echo $oneway_rental_fee; ?>&names=<?php echo $first_name." ".$last_name;?>&qty=<?php echo $numDays;?>&price=<?php echo getActualPrice($_REQUEST["id"],$typed);?>&vtype=<?php echo getVehicleCategory(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"));?>&mileage_charge=<?php echo $mileage_charge;?>&distance=<?php echo $distance;?>&driver_rate=<?php echo $driver_rate;?>&vat=<?php echo $vat;?>&vatpayable=<?php echo $vatpayable;?>&currency=<?php echo $currency;?>&qcode=<?php echo $qcode;?>" target="_new2">
					<strong>DOWNLOAD QUOTATION IN PDF</strong>
				</a>
				<br><br>
				<a class="button" href="./documents/invoice.php?qnum=<?php echo $invoiceNumber; ?>&nrf=<?php echo $rentalTXT;?>&rentalfee=<?php echo $oneway_rental_fee; ?>&names=<?php echo $first_name." ".$last_name;?>&qty=<?php echo $numDays;?>&price=<?php echo getActualPrice($_REQUEST["id"],$typed);?>&vtype=<?php echo getVehicleCategory(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"));?>&mileage_charge=<?php echo $mileage_charge;?>&distance=<?php echo $distance;?>&driver_rate=<?php echo $driver_rate;?>&vat=<?php echo $vat;?>&vatpayable=<?php echo $vatpayable;?>&currency=<?php echo $currency;?>&qcode=<?php echo $qcode2;?>" target="_new2">
					<strong>DOWNLOAD INVOICE IN PDF</strong>
				</a>
				<?php
			}
				?>
		</div>
		</div>
		</div>
		
		
		

<div class="control-group" style="float:left; margin:15px;">
<div class="control-group">
<div class="controls">
<div class="error left-align" id="err-name"><strong><u>YOUR HIRE DETAILS</u></strong></div>
</div>
</div><br>
<div class="control-group" style="font-size:12px; margin:5px;">
<div class="controls">
<div class="error left-align" id="err-name"><strong>Start Point: </strong>
<?php echo getTown($_REQUEST["fromcity"]);?></div>
</div>
</div>
<div class="control-group" style="font-size:12px; margin:5px;">
<div class="controls">
<div class="error left-align" id="err-name"><strong>Driving To: </strong>
<?php echo $_REQUEST["tocity"];?></div>
</div>
</div>

<div class="control-group" style="font-size:12px; margin:5px;">
<div class="controls">
<div class="error left-align" id="err-name"><strong>Pickup Date: </strong>
<?php echo $pickup_date;?></div>
</div>
</div>

<div class="control-group" style="font-size:12px; margin:5px;">
<div class="controls">
<div class="error left-align" id="err-name"><strong>Pickup Location: </strong>
<?php echo $_REQUEST["pick_location"];?></div>
</div>
</div>


<div class="control-group" style="font-size:12px; margin:5px;">
<div class="controls">
<div class="error left-align" id="err-name"><strong>Drop Off Date: </strong>
<?php echo $droping_off_date;?></div>
</div>
</div>
<div class="control-group" style="font-size:12px; margin:5px;">
<div class="controls">
<div class="error left-align" id="err-name"><strong>Drop Off Location: </strong>
<?php echo $_REQUEST["dropoff_location"];?></div>
</div>
</div>

<div class="control-group" style="font-size:12px; margin:5px;">
	<div class="controls">
		<div class="error left-align" id="err-name">
		<a class="button" href="./?ref=<?php echo iDevSite("STORE URL");?>.php&id=<?php echo $_REQUEST['id'];?>&action=book&fromcity=<?php echo $_REQUEST['fromcity'];?>&tocity=<?php echo $_REQUEST['tocity'];?>&pick_date=<?php echo $_REQUEST['pick_date'];?>&pick_time=<?php echo $_REQUEST['pick_time'];?>&pick_location=<?php echo $_REQUEST['pick_location'];?>&dropoff_date=<?php echo $_REQUEST['dropoff_date'];?>&dropoff_time=<?php echo $_REQUEST['dropoff_time'];?>&dropoff_location=<?php echo $_REQUEST['dropoff_location'];?>&dropoff_country=<?php echo $_REQUEST['dropoff_country'];?>&chuffer=<?php echo $_REQUEST['chuffer'];?>&adults=<?php echo $_REQUEST['adults'];?>&children=<?php echo $_REQUEST['children'];?>&first_name=<?php echo $first_name;?>&last_name=<?php echo $last_name;?>&phone=<?php echo $phone;?>&email=<?php echo $email;?>&b_hire_details=AMEND">
			<strong>AMMEND BOOKING DETAILS</strong>
		</a>
		</div>
	</div>
</div>

<div class="control-group" style="font-size:12px; margin:5px;">
<div class="controls">
<div class="error left-align" id="err-name">&nbsp;</div>
</div>
</div>
</div>
<div class="control-group" style="float:left; margin:15px;">
	<div class="control-group">
		<div class="controls">
			<div class="error left-align" id="err-name"><strong><u>YOUR CONTACT INFORMATION</u></strong></div>
		</div>
	</div><br>

	<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
			<div class="error left-align" id="err-name"><strong>First Name: </strong><?php echo $first_name;?></div>
		</div>
	</div>
	<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
			<div class="error left-align" id="err-name"><strong>Last Name: </strong><?php echo $last_name;?></div>
		</div>
	</div>
	<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
			<div class="error left-align" id="err-name"><strong>Phone: </strong><?php echo $phone;?></div>
		</div>
	</div>
	<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
			<div class="error left-align" id="err-name"><strong>Email: </strong><?php echo $email;?></div>
		</div>
	</div>
	<?php
	if(chkSes()=="Inactive")
	{
	?>
	<div class="control-group" style="font-size:12px; margin:5px;">
		<div class="controls">
			<a class="button" href="./?ref=<?php echo iDevSite("STORE URL");?>.php&id=<?php echo $_REQUEST['id'];?>&action=book&fromcity=<?php echo $_REQUEST['fromcity'];?>&tocity=<?php echo $_REQUEST['tocity'];?>&pick_date=<?php echo $_REQUEST['pick_date'];?>&pick_time=<?php echo $_REQUEST['pick_time'];?>&pick_location=<?php echo $_REQUEST['pick_location'];?>&dropoff_date=<?php echo $_REQUEST['dropoff_date'];?>&dropoff_time=<?php echo $_REQUEST['dropoff_time'];?>&dropoff_location=<?php echo $_REQUEST['dropoff_location'];?>&dropoff_country=<?php echo $_REQUEST['dropoff_country'];?>&chuffer=<?php echo $_REQUEST['chuffer'];?>&adults=<?php echo $_REQUEST['adults'];?>&children=<?php echo $_REQUEST['children'];?>&first_name=<?php echo $first_name;?>&last_name=<?php echo $last_name;?>&phone=<?php echo $phone;?>&email=<?php echo $email;?>&b_contact_details=AMEND">
				<strong>AMMEND CONTACT DETAILS</strong>
			</a>
		</div>
	</div>
	<?php
	}
	?>
</div>



<div class="control-group">
<div class="controls">
<div class="error left-align" id="err-name">&nbsp;</div>
</div>
</div>
		<?php
	}
	elseif($step<=2)
	{

		?>
		<script type="text/javascript">
		function submitform()
		{
			document.forms["myform"].submit();
		}
		</script>
		<form id="myform" action="./" method="GET">
			<input name="ref" type="hidden" value="<?php echo iDevSite("STORE URL");?>.php">
			<input name="id" type="hidden" value="<?php echo $_REQUEST["id"];?>">
			<input name="action" type="hidden" value="book">
			<input name="fromcity" type="hidden" value="<?php echo $_REQUEST["fromcity"];?>">
			<input name="tocity" type="hidden" value="<?php echo $_REQUEST["tocity"];?>">
			<input name="pick_date" type="hidden" value="<?php echo $_REQUEST["pick_date"];?>">
			<input name="pick_time" type="hidden" value="<?php echo $_REQUEST["pick_time"];?>">
			<input name="pick_location" type="hidden" value="<?php echo $_REQUEST["pick_location"];?>">
			<input name="dropoff_date" type="hidden" value="<?php echo $_REQUEST["dropoff_date"];?>">
			<input name="dropoff_time" type="hidden" value="<?php echo $_REQUEST["dropoff_time"];?>">
			<input name="dropoff_location" type="hidden" value="<?php echo $_REQUEST["dropoff_location"];?>">
			<input name="chuffer" type="hidden" value="<?php echo $_REQUEST["chuffer"];?>">
			<input name="adults" type="hidden" value="<?php echo $_REQUEST["adults"];?>">
			<input name="children" type="hidden" value="<?php echo $_REQUEST["children"];?>">
			<?php 
			if(chkSes()=="Active")
			{
				
			}
			else
			{
				?>
				<input name="first_name" type="hidden" value="<?php echo $_REQUEST["first_name"];?>">
				<input name="last_name" type="hidden" value="<?php echo $_REQUEST["last_name"];?>">
				<input name="phone" type="hidden" value="<?php echo $_REQUEST["phone"];?>">
				<input name="email" type="hidden" value="<?php echo $_REQUEST["email"];?>">
				<?php
			}
			?>	
			<input name="mxm" type="hidden" value="1">
		</form>
			<div class="control-group">
					<iframe name="checkout" onload="javascript: submitform()" style="width:1px; height: 1px; float:left;">
					</iframe>
			</div>
			<?php
	}
}

//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) BELOW THIS LINE



//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) ABOVE THIS LINE

}

?>
</section>
