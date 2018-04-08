<?php
  session_start();

  if(isset($_REQUEST['total_cart_items']))
  {
	echo count($_SESSION['cart']);
	exit();
  }

  if(isset($_POST['item_price'])) //
  {
		$currency = currentCurrency();
		
		//$exchange_rate = currency($currency,"CURRENCY CODES","RATE");
		$exchange_rate = 1;
		
		$pickup_date = date("Y/m/d H:i", strtotime($_REQUEST["item_pickUpDateTime"]));
		$droping_off_date = date("Y/m/d H:i", strtotime($_REQUEST["item_DropOffDateTime"]));

		$pickup_dateD = date("Y/m/d", strtotime($_REQUEST["item_pickUpDateTime"]));
		$droping_off_dateD = date("Y/m/d", strtotime($_REQUEST["item_DropOffDateTime"]));

		$pickup_time = date("H:i", strtotime($_REQUEST["item_pickUpDateTime"]));
		$droping_off_time = date("H:i", strtotime($_REQUEST["item_DropOffDateTime"]));

		$cot = "10:00";
		$cut_off_time = date("H:i",strtotime($cot));


		$pku = explode(" ", $pickup_date);
		$dku = explode(" ", $droping_off_date);
		$ptime = trim($pku[1]);
		$dtime = trim($dku[1]);

		$ptmx = explode(":",$ptime);
		$dtmx = explode(":",$dtime);

		$phours = $ptmx[0];
		$pmins = $ptmx[1];

		$dhours = $dtmx[0];
		$dmins = $dtmx[1];

		$pickupdate = trim($pickup_dateD);
		$item_DropOffDateTime = trim($droping_off_dateD);

		$dtxp = explode("-",$pickupdate);
		$dtxd = explode("-",$item_DropOffDateTime);

		$yeardaysp = days_in_year($pickupdate);
		$yeardaysd = days_in_year($item_DropOffDateTime);
		$monthdaysp = days_in_month($pickupdate);
		$monthdaysd = days_in_month($item_DropOffDateTime);
		$dayp = $dtxp[0];
		$dayd = $dtxd[0];
		$monthp = $dtxp[1];
		$monthd = $dtxd[1];
		$yearp = $dtxp[2];
		$yeard = $dtxd[2];
		
		$DyearDays = ($yeard-1)*365.25;
		$DDaysPassedInYear = date("z",strtotime($item_DropOffDateTime));
		
		$PyearDays = ($yearp-1)*365.25;
		$PDaysPassedInYear = date("z",strtotime($pickupdate));

		$numDaysx = (($DyearDays+$DDaysPassedInYear+(($dhours/24)+($dmins/(24*60)))) - ($PyearDays+$PDaysPassedInYear+(($phours/24)+($pmins/(24*60)))));

		
		
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

		
		if($numDaysx2==1)
		{
			if($pickup_dateD==$droping_off_dateD)
			{
				$numDays = 1;
			}
			else
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
		
		if($_POST['item_name']=="TBA")
		{
			$item_name = getVehicleCategory(getVehicleCategoryID($_POST['item_pID']));
		}
		else
		{
			if(!(getVehicleCategoryID($_POST['item_pID'])==""))
			{
				$item_name = getVehicleCategory(getVehicleCategoryID($_POST['item_pID']));
			}
			else
			{
				$item_name = $_POST['item_name'];
			}
		}
		
		
		//echo $item_name."<br>";
		
		$tocityx = explode(",",$_REQUEST['item_DrivingTo']);

		$tocity = $tocityx[0];

		$driving_from_array = getLocationDetails($_REQUEST["item_pickUpArea"].", ".$_REQUEST["item_pickUpTown"].", Zambia");
		$driving_to_array = getLocationDetails($_REQUEST["item_DrivingTo"]);
		$dropoff_array = getLocationDetails($_REQUEST["item_DropOffTown"].", ".$_REQUEST["item_DropOffCountry"]);
		
		if($driving_from_array['country']==$driving_to_array['country'])
		{
			if($driving_from_array['town']==$driving_to_array['town'])
			{
			$typed = "WITHIN";
			}
			else
			{
				if($driving_from_array['province']==$driving_to_array['province'])
				{
					if(getProvinceID($driving_from_array['province'],"PRICE SETTING")=="FLAT RATE" || getProvinceID($driving_from_array['province'],"PRICE SETTING")=="FLATRATE")
					{
						$typed = "WITHIN";
					}
					else
					{
						$typed = "OUT OF TOWN";
					}
				}
				else
				{
					$typed = "OUT OF TOWN";
				}
			}
		}
		else
		{
			$typed = "OUT OF COUNTRY";
		}
		
		if($_POST['item_price']=="TBA")
		{
			$discount = getDiscounts(getVehicleCategoryID($_POST['item_pID']),getCategoryPrice(getVehicleCategoryID($_POST['item_pID']),"",$typed,$currency),$currency);
			
			$price = $exchange_rate*(getCategoryPrice(getVehicleCategoryID($_POST['item_pID']),"",$typed,$currency));
			
			$amount_off = $discount["amount_off"];
		}
		else
		{
			if($currency=="USD")
			{
				$price = $_POST['item_price'];
				$amount_off = 0;
			}
			else
			{
				$price = $exchange_rate*($_POST['item_price']);
				$amount_off = 0;
			}
		}
		//$driving_from_array['town']==$driving_to_array['town']
		//echo "price: ".$_POST['item_price']."|||";
		
		$img_srcx = getVehicleCategoryImage($_POST['item_pID']);
		
		if(file_exists($img_srcx))
		{
			$img_src = getVehicleCategoryImage($_POST['item_pID']);
		}
		else
		{
			$img_src = $_POST['item_src'];
		}
		
		/////////////////////////////////////////////////////////////////////////////
		$hire_total = $price*$numDays;

		if($_REQUEST["item_Chauffeur"]=="Yes")
		{
			if($currency=="USD")
			{
				$driver_allowance_total = number_format(getDriverRate($typed),2)*$numDays;
				$driver_rate = getDriverRate($typed);
				$extra_charges[] = array('item'=>"CHAUFFEUR",'price'=>$driver_rate,'qty'=>$numDays);
			}
			else
			{
				$driver_allowance_total = number_format($exchange_rate*(getDriverRate($typed)),2)*$numDays;
				$driver_rate = $exchange_rate*(getDriverRate($typed));
				$extra_charges[] = array('item'=>"CHAUFFEUR",'price'=>$driver_rate,'qty'=>$numDays);
			}
		}
		else
		{
			$driver_allowance_total = 0;
			$driver_rate = 0;
		}
		
		//echo "DR:".$typed."|||";


		if($numDays==1)
		{
			$distance_array = getDistance($driving_from_array['formatted_address'],$driving_to_array['formatted_address'])+getDistance($driving_to_array['formatted_address'],$dropoff_array['formatted_address']);
			$distance = round($distance_array['distance_value']/1000);
		}
		else
		{
			$distance = 0;
		}


		if(($driving_from_array['country']==$dropoff_array['country']) && ($driving_from_array['town']==$dropoff_array['town']))
		{
			$oneway_rental = 0;
			$busfare = 0;
			$oneway_distance_array = 0;
			$oneway_distance = round($oneway_distance_array['distance_value']/1000);
		}
		elseif(($driving_from_array['country']==$dropoff_array['country']) && !($driving_from_array['town']==$dropoff_array['town']))
		{
			$oneway_rental = 1;
			
			if($currency=="USD")
			{
				$busfare =  getBusFare($dropoff_array['town']."-".$dropoff_array['country'],$driving_from_array['town']."-".$driving_from_array['country']);
				$oneway_distance_array = getDistance($dropoff_array['formatted_address'],$driving_from_array['formatted_address']);
				$oneway_distance = round($oneway_distance_array['distance_value']/1000);
			}
			else
			{
				$busfare =  $exchange_rate*(getBusFare($dropoff_array['town']."-".$dropoff_array['country'],$driving_from_array['town']."-".$driving_from_array['country']));
				$oneway_distance_array = getDistance($dropoff_array['formatted_address'],$driving_from_array['formatted_address']);
				$oneway_distance = round($oneway_distance_array['distance_value']/1000);
			}
		}
		elseif(!($driving_from_array['country']==$dropoff_array['country']) && !($driving_from_array['town']==$dropoff_array['town']))
		{
			$oneway_rental = 1;
			
			if($currency=="USD")
			{
				$busfare =  getBusFare($dropoff_array['town']."-".$dropoff_array['country'],$driving_from_array['town']."-".$driving_from_array['country']);
				$oneway_distance_array = getDistance($dropoff_array['formatted_address'],$driving_from_array['formatted_address']);
				$oneway_distance = round($oneway_distance_array['distance_value']/1000);
			}
			else
			{
				$busfare =  $exchange_rate*(getBusFare($dropoff_array['town']."-".$dropoff_array['country'],$driving_from_array['town']."-".$driving_from_array['country']));
				$oneway_distance_array = getDistance($dropoff_array['formatted_address'],$driving_from_array['formatted_address']);
				$oneway_distance = round($oneway_distance_array['distance_value']/1000);
			}
		}
		
		//echo $busfare."|||";
		

		if($oneway_rental==1)
		{
			if($oneway_rental==2)
			{
				$rentalTXT = "One";
			}
			elseif($oneway_rental==1)
			{
				$rentalTXT = "One";
			}
			
			if($currency=="USD")
			{
				$oneway_rental_fee = number_format($busfare+(($oneway_distance/getVehicleCategoryConsumpionRate(getVehicleCategoryID($_POST['item_pID']))) * getPumpPrice(getVehicleCategoryFuelType(getVehicleCategoryID($_POST['item_pID'])))),2);
			}
			else
			{
				$oneway_rental_fee = number_format($exchange_rate*($busfare+(($oneway_distance/getVehicleCategoryConsumpionRate(getVehicleCategoryID($_POST['item_pID']))) * getPumpPrice(getVehicleCategoryFuelType(getVehicleCategoryID($_POST['item_pID']))))),2);
			}
			
						//$oneway_rental_fee = 1000;
			
			$extra_charges[] = array('item'=>"ONEWAY RENTAL",'price'=>$oneway_rental_fee,'qty'=>1);
		}
		else
		{
			$oneway_rental_fee = 0;
		}

		//echo "OWR:".(getVehicleCategoryConsumpionRate(getVehicleCategoryID($_POST['item_pID'])))."|||";
		
		if($numDays==1)
		{
			if($driving_from_array['country']==$driving_to_array['country'])
			{
				if($driving_from_array['town']==$driving_to_array['town'])
				{
					$distancex = 0;
				}
				else
				{
					$distance_array = getDistance($driving_from_array['formatted_address'],$driving_to_array['formatted_address'])+getDistance($driving_to_array['formatted_address'],$dropoff_array['formatted_address']);
					$distancex = round($distance_array['distance_value']/1000);
				}
			}
			else
			{
				$distance_array = getDistance($driving_from_array['formatted_address'],$driving_to_array['formatted_address'])+getDistance($driving_to_array['formatted_address'],$dropoff_array['formatted_address']);
				$distancex = round($distance_array['distance_value']/1000);
			}
			
			if($currency=="USD")
			{
				$mileage_total = getMileageCharge(getVehicleCategoryID($_POST['item_pID']))*$distancex;
				$mileage_charge = getMileageCharge(getVehicleCategoryID($_POST['item_pID']));
				$extra_charges[] = array('item'=>"MILEAGE CHARGE",'price'=>$mileage_charge,'qty'=>$distancex);
			}
			else
			{
				$mileage_total = $exchange_rate*(getMileageCharge(getVehicleCategoryID($_POST['item_pID'])))*$distancex;
				$mileage_charge = $exchange_rate*(getMileageCharge(getVehicleCategoryID($_POST['item_pID'])));
				$extra_charges[] = array('item'=>"MILEAGE CHARGE",'price'=>$mileage_charge,'qty'=>$distancex);
			}
		}
		else
		{
			$mileage_total = 0;
			$mileage_charge = 0;
		}
		
		//echo $distancex."|||";
		
		$grand_total = number_format(($oneway_rental_fee+$hire_total+$driver_allowance_total+$mileage_total),2);
		
		
		$prType = checkVehicleOrNot($_POST['item_pID']);
		
	
	//$extra_charges[] = array('item'=>$ec_name,'price'=>$ec_price,'qty'=>$ec_qty);
	if($_POST['amend']==1)
	{
		$nma = $_POST['item_num'];
		
		if($_POST['item_email']=="")
		{
			
		}
		else
		{
			$_SESSION['CustomerEmail'] = $_POST['item_email'];
		}
		
		if($_POST['item_c_name']=="")
		{
			
		}
		else
		{
			$_SESSION['CustomeName'] = $_POST['item_c_name'];
		}
		
		$_SESSION['cart'][$nma] = array('CartID'=>$nma,'merchantID'=>$_POST['item_merchantID'],'CustomeName'=>$_POST['item_c_name'],'currency'=>$currency,'name'=>$item_name,'price'=>$price,'discount'=>$amount_off,'src'=>$img_src,'pID'=>$_POST['item_pID'],'pType'=>$prType,'qty'=>$_POST['item_qty'],'duration'=>$numDays,'unit'=>$_POST['item_unit'],'unitID'=>$_POST['item_unitID'],'pickUpTown'=>$_POST['item_pickUpTown'],'pickUpArea'=>$_POST['item_pickUpArea'],'pickUpDateTime'=>$_POST['item_pickUpDateTime'],'DropOffCountry'=>$_POST['item_DropOffCountry'],'DropOffDateTime'=>$_POST['item_DropOffDateTime'],'DropOffTown'=>$_POST['item_DropOffTown'],'DrivingTo'=>$_POST['item_DrivingTo'],'distance'=>$distance,'WithChauffeur'=>$_POST['item_Chauffeur'],'NoOfAdults'=>$_POST['item_NoOfAdults'],'NoOfChildren'=>$_POST['item_NoOfChildren'],'extra_charges'=>$extra_charges,'chauffeur_rate'=>$driver_rate,'chauffeur'=>$driver_allowance_total,'mileage_rate'=>$mileage_charge,'mileage_charge'=>$mileage_total,'oneway_rental_fee'=>$oneway_rental_fee,'total'=>$grand_total,'extra_charges_amount'=>$extra_charges_amount);
	
	$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

$html = '
<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
	<tr>
		<th align="left" bgcolor="#cccccc" style="margin:5px; float:left; width:350px;">
			<table style="margin:5px; float:left;">
				<tr>
					<td width="120"><img src="images/logo.png" width="120" ></td>
					<td style="margin:5px; float:left; width:250px;"><br><span style="font-size:20px;">City Drive Rent A Car</span><br><span style="font-size:11px;">Beyond the Ordinary...</span>
					</td>
				</tr>
			</table>
		</th>
		<th align="right" bgcolor="#cccccc" style="font-size:12px; width:280px;"><span style="font-size:30px;">QUOTE</span><br>Q'.strtoupper($_SESSION["uniqueCode"]).'<br><strong>DATE:</strong> '.date("d-m-Y").'</th>
	</tr>
	<tr>
		<td align="left" cellpadding="4">Plot no 6075/1 Chisokone Road, Northmead Lusaka Zambia<br>
Phone;+260-961 303910/+260-976760159<br>
reservations@citydriverentacar.com</td>
		<td align="right" cellpadding="4">Beneficiary: CITY DRIVE RENT A CAR LTD<br>
Bank Name; STANBIC BANK<br>
Bank Address; Arcades Shopping Mall<br>
Great East Road<br>
P O Box 31955<br>
Lusaka, Zambia<br>
TPIN No.1001978753<br>
Account Number: 9130003640225<br>
Swift Code: SBICZMLX<br>
Branch Name; ARCADES BRANCH<br>
Branch Code: 040010</td>
	</tr></table><br><br>
	
<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
	<tr>
		<td align="left" cellpadding="4">To: '.$_SESSION['CustomeName'].' <br />'.$_SESSION['CustomerEmail'].'</td>
		<td align="right" cellpadding="4">Email: '.$_SESSION['CustomerEmail'].'</td>
	</tr></table><br><br>
	
	
<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
	<tr>
		<td><b>JOB</b></td>
		<td><b>PAYMENT TERMS</b></td>
		<td><b>DUE DATE</b></td>
	</tr>
	<tr>
		<td>VEHICLE HIRE</td>
		<td>50% DOWN PAYMENT UP-FRONT, 50% BALANCE UPON HIRE</td>
		<td>UPON HIRE</td>
	</tr>
</table><br><br>
	
<table cellspacing="3" cellpadding="4"  bgcolor="#cccccc">
	<tr>
		<td width="80"><b>QTY</b></td>
		<td width="260"><b>DESCRIPTION</b></td>
		<td width="130"><b>UNIT PRICE</b></td>
		<td><b>LINE TOTAL</b></td>
	</tr>';
	
	
	$valuex = end ($_SESSION['cart']); 
	$ix = 0;
	$currency = currentCurrency();
	$totalValue = 0;
	while ($valuex) 
	{
		if($valuex["currency"]=="")
		{
			$currency = $currency;
		}
		else
		{
			$currency = $valuex["currency"];
		}
		
		$html .= '<tr bgcolor="#ffffff">
			<td><b>PickUp Area<b/> '.$valuex["pickUpArea"].', '.$valuex["pickUpTown"].' on (date/time) '.$valuex["pickUpDateTime"].'</td>
			<td><b>Driving From: </b>'.$valuex["pickUpTown"].'</td>
			<td><b>Driving To: </b>'.$valuex["DrivingTo"].' ('.@number_format(($valuex["distance"]/1000),3).'Km)</td>
			<td><b>Drop Off Town: </b>'.$valuex["DropOffTown"].' on (date/time) '.$valuex["DropOffDateTime"].'</td>
		</tr>';
		
	$html .= '<tr bgcolor="#ffffff">
		<td>'.$valuex["duration"].' days</td>
		<td>'.$valuex["qty"].' x '.$valuex["name"].'</td>
		<td>'.$valuex["currency"].' '.(@number_format($valuex["price"],2)).'</td>
		<td>'.$valuex["currency"].'<b/> '.(@number_format(($valuex["price"]*$valuex["duration"]*$valuex["qty"]),2)).'</td>
	</tr>';
	
	if($valuex["oneway_rental_fee"]>0)
	{
	$html .= '<tr bgcolor="#ffffff">
		<td></td>
		<td>ONEWAY RENTAL FEE</td>
		<td></td>
		<td>'.$valuex["currency"].' '.(@number_format(($valuex["oneway_rental_fee"]*$valuex["qty"]),2)).'</td>
	</tr>';
	}
	
	if($valuex["mileage_charge"]>0)
	{
	$html .= '<tr bgcolor="#ffffff">
		<td>'.$valuex["distance"].' km</td>
		<td>MILEAGE</td>
		<td>'.$valuex["currency"].' '.(@number_format($valuex["mileage_rate"],2)).'</td>
		<td>'.$valuex["currency"].' '.(@number_format(($valuex["mileage_charge"]*$valuex["qty"]),2)).'</td>
	</tr>';
	}
	
	if($valuex["chauffeur"]>0)
	{
	$html .= '<tr bgcolor="#ffffff">
		<td>'.$valuex["duration"].' days</td>
		<td>CHAUFFEUR</td>
		<td>'.$valuex["currency"].' '.(@number_format($valuex["chauffeur_rate"],2)).'</td>
		<td>'.$valuex["currency"].' '.(@number_format(($valuex["chauffeur"]*$valuex["qty"]),2)).'</td>
	</tr>';
	}
	
	$html .= '<tr bgcolor="#ffffff"><td></td>
		<td></td>
		<td><b>ITEM TOTAL</b></td>
		<td>'.$valuex["currency"].' '.(@number_format((($valuex["price"]*$valuex["duration"]*$valuex["qty"])+($valuex["chauffeur"]*$valuex["qty"])+($valuex["mileage_charge"]*$valuex["qty"])+($valuex["oneway_rental_fee"]*$valuex["qty"])),2)).'</td>
	</tr>';
	$totalValue = $totalValue+(($valuex["price"]*$valuex["duration"]*$valuex["qty"])+($valuex["chauffeur"]*$valuex["qty"])+($valuex["mileage_charge"]*$valuex["qty"])+($valuex["oneway_rental_fee"]*$valuex["qty"]));
	$valuex = prev($_SESSION['cart']); 
	$ix=$ix+1;
	}
	
	$html .= '<tr bgcolor="#ffffff"><td></td>
		<td></td>
		<td bgcolor="#cccccc"><b>SUB TOTAL</b></td>
		<td bgcolor="#cccccc">'.$currency.' '.(@number_format($totalValue,2)).'</td>
	</tr>';
	
	$html .= '<tr bgcolor="#ffffff">
		<td></td>
		<td><b>INCLUDED:</b> COMPREHENSIVE INSURANCE, VEHICLE GIVEN WITH FULL TANK & RETURNED WITH FULL TANK</td>
		<td></td>
		<td></td>
	</tr>';

	$html .= '<tr bgcolor="#ffffff">
		<td></td>
		<td></td>
		<td>'.$vat.'%</td>
		<td>'.$currency.' '.(@number_format(($totalValue*$vatd/100),2)).'</td>
	</tr>';
	
	$html .= '<tr bgcolor="#cccccc">
		<td></td>
		<td></td>
		<td><b>TOTAL</b></td>
		<td>'.$currency.' '.(@number_format(($totalValue+(($totalValue*$vatd/100))),2)).'</td>
	</tr>';
	
$html .= '</table><br><br>';

	email("CITYDRIVE PROSPECT PRELIMINARY QUOTE",$html,$_SESSION['CustomerEmail'],"info@citydriverentacar.com");
	email("CITYDRIVE PROSPECT PRELIMINARY QUOTE",$html,$_SESSION['CustomerEmail'],"reservations@citydriverentacar.com");
	}
	else
	{
		if(isset($_SESSION['cartnum']))
		{
			$nma = $_SESSION['cartnum']+1;
		}
		else
		{
			$nma = 0;
			if(isset($_SESSION["uniqueCode"]))
			{
				
			}
			else
			{
				$_SESSION["uniqueCode"] = strtoupper(uniqid());
			}
			
			
			if(isset($_SESSION["uniqueCode2"]))
			{
				
			}
			else
			{
				$_SESSION["uniqueCode2"] = strtoupper(uniqid());
			}
			
			
			if(isset($_SESSION["uniqueCode3"]))
			{
				
			}
			else
			{
				$_SESSION["uniqueCode3"] = strtoupper(uniqid());
			}
		}
		
		if($_POST['item_email']=="")
		{
			
		}
		else
		{
			$_SESSION['CustomerEmail'] = $_POST['item_email'];
		}
        if($_POST['item_c_name']=="")
		{
			
		}
		else
		{
			$_SESSION['CustomeName'] = $_POST['item_c_name'];
		}





		$_SESSION['cart'][$nma] = array('CartID'=>$nma,'merchantID'=>$_POST['item_merchantID'],'CustomeName'=>$_POST['item_c_name'], 'currency'=>$currency,'name'=>$item_name,'price'=>$price,'discount'=>$amount_off,'src'=>$img_src,'pID'=>$_POST['item_pID'],'pType'=>$prType,'qty'=>$_POST['item_qty'],'duration'=>$numDays,'unit'=>$_POST['item_unit'],'unitID'=>$_POST['item_unitID'],'pickUpTown'=>$_POST['item_pickUpTown'],'pickUpArea'=>$_POST['item_pickUpArea'],'pickUpDateTime'=>$_POST['item_pickUpDateTime'],'DropOffCountry'=>$_POST['item_DropOffCountry'],'DropOffDateTime'=>$_POST['item_DropOffDateTime'],'DropOffTown'=>$_POST['item_DropOffTown'],'DrivingTo'=>$_POST['item_DrivingTo'],'distance'=>$distance,'WithChauffeur'=>$_POST['item_Chauffeur'],'NoOfAdults'=>$_POST['item_NoOfAdults'],'NoOfChildren'=>$_POST['item_NoOfChildren'],'extra_charges'=>$extra_charges,'chauffeur_rate'=>$driver_rate,'chauffeur'=>$driver_allowance_total,'mileage_rate'=>$mileage_charge,'mileage_charge'=>$mileage_total,'oneway_rental_fee'=>$oneway_rental_fee,'total'=>$grand_total,'extra_charges_amount'=>$extra_charges_amount);
		$_SESSION['cartnum'] = $nma;
				
				
	$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

$html = '
<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
	<tr>
		<th align="left" bgcolor="#cccccc" style="margin:5px; float:left; width:350px;">
			<table style="margin:5px; float:left;">
				<tr>
					<td width="120"><img src="images/logo.png" width="120" ></td>
					<td style="margin:5px; float:left; width:250px;"><br><span style="font-size:20px;">City Drive Rent A Car</span><br><span style="font-size:11px;">Beyond the Ordinary...</span>
					</td>
				</tr>
			</table>
		</th>
		<th align="right" bgcolor="#cccccc" style="font-size:12px; width:280px;"><span style="font-size:30px;">QUOTE</span><br>Q'.strtoupper($_SESSION["uniqueCode"]).'<br><strong>DATE:</strong> '.date("d-m-Y").'</th>
	</tr>
	<tr>
		<td align="left" cellpadding="4">Plot no 6075/1 Chisokone Road, Northmead Lusaka Zambia<br>
Phone;+260-961 303910/+260-976760159<br>
reservations@citydriverentacar.com</td>
		<td align="right" cellpadding="4">Beneficiary: CITY DRIVE RENT A CAR LTD<br>
Bank Name; STANBIC BANK<br>
Bank Address; Arcades Shopping Mall<br>
Great East Road<br>
P O Box 31955<br>
Lusaka, Zambia<br>
TPIN No.1001978753<br>
Account Number: 9130003640225<br>
Swift Code: SBICZMLX<br>
Branch Name; ARCADES BRANCH<br>
Branch Code: 040010</td>
	</tr></table><br><br>
	
<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
	<tr>
		<td align="left" cellpadding="4">To: '.$_SESSION['CustomeName'].' <br />'.$_SESSION['CustomerEmail'].'</td>
		<td align="right" cellpadding="4">Email: '.$_SESSION['CustomerEmail'].'</td>
	</tr></table><br><br>
	
	
<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
	<tr>
		<td><b>JOB</b></td>
		<td><b>PAYMENT TERMS</b></td>
		<td><b>DUE DATE</b></td>
	</tr>
	<tr>
		<td>VEHICLE HIRE</td>
		<td>50% DOWN PAYMENT UP-FRONT, 50% BALANCE UPON HIRE</td>
		<td>UPON HIRE</td>
	</tr>
</table><br><br>
	
<table cellspacing="3" cellpadding="4"  bgcolor="#cccccc">
	<tr>
		<td width="80"><b>QTY</b></td>
		<td width="260"><b>DESCRIPTION</b></td>
		<td width="130"><b>UNIT PRICE</b></td>
		<td><b>LINE TOTAL</b></td>
	</tr>';
	
	
	$valuex = end ($_SESSION['cart']); 
	$ix = 0;
	$currency = currentCurrency();
	$totalValue = 0;
	while ($valuex) 
	{
		if($valuex["currency"]=="")
		{
			$currency = $currency;
		}
		else
		{
			$currency = $valuex["currency"];
		}   
		
		$html .= '<tr bgcolor="#ffffff">
			<td><b>PickUp Area<b/> '.$valuex["pickUpArea"].', '.$valuex["pickUpTown"].' on (date/time) '.$valuex["pickUpDateTime"].'</td>
			<td><b>Driving From: </b>'.$valuex["pickUpTown"].'</td>
			<td><b>Driving To: </b>'.$valuex["DrivingTo"].' ('.@number_format(($valuex["distance"]/1000),3).'Km)</td>
			<td><b>Drop Off Town: </b>'.$valuex["DropOffTown"].' on (date/time) '.$valuex["DropOffDateTime"].'</td>
		</tr>';
		
		$html .= '<tr bgcolor="#ffffff">
			<td>'.$valuex["duration"].' days</td>
			<td>'.$valuex["qty"].' x '.$valuex["name"].'</td>
			<td>'.$valuex["currency"].' '.(@number_format($valuex["price"],2)).'</td>
			<td>'.$valuex["currency"].'<b/> '.(@number_format(($valuex["price"]*$valuex["duration"]*$valuex["qty"]),2)).'</td>
		</tr>';
		
		if($valuex["oneway_rental_fee"]>0)
		{
		$html .= '<tr bgcolor="#ffffff">
			<td></td>
			<td>ONEWAY RENTAL FEE</td>
			<td></td>
			<td>'.$valuex["currency"].' '.(@number_format(($valuex["oneway_rental_fee"]*$valuex["qty"]),2)).'</td>
		</tr>';
		}
		
		if($valuex["mileage_charge"]>0)
		{
		$html .= '<tr bgcolor="#ffffff">
			<td>'.$valuex["distance"].' km</td>
			<td>MILEAGE</td>
			<td>'.$valuex["currency"].' '.(@number_format($valuex["mileage_rate"],2)).'</td>
			<td>'.$valuex["currency"].' '.(@number_format(($valuex["mileage_charge"]*$valuex["qty"]),2)).'</td>
		</tr>';
		}
		
		if($valuex["chauffeur"]>0)
		{
		$html .= '<tr bgcolor="#ffffff">
			<td>'.$valuex["duration"].' days</td>
			<td>CHAUFFEUR</td>
			<td>'.$valuex["currency"].' '.(@number_format($valuex["chauffeur_rate"],2)).'</td>
			<td>'.$valuex["currency"].' '.(@number_format(($valuex["chauffeur"]*$valuex["qty"]),2)).'</td>
		</tr>';
		}
		
		$html .= '<tr bgcolor="#ffffff"><td></td>
			<td></td>
			<td><b>ITEM TOTAL</b></td>
			<td>'.$valuex["currency"].' '.(@number_format((($valuex["price"]*$valuex["duration"]*$valuex["qty"])+($valuex["chauffeur"]*$valuex["qty"])+($valuex["mileage_charge"]*$valuex["qty"])+($valuex["oneway_rental_fee"]*$valuex["qty"])),2)).'</td>
		</tr>';
		$totalValue = $totalValue+(($valuex["price"]*$valuex["duration"]*$valuex["qty"])+($valuex["chauffeur"]*$valuex["qty"])+($valuex["mileage_charge"]*$valuex["qty"])+($valuex["oneway_rental_fee"]*$valuex["qty"]));
		$valuex = prev($_SESSION['cart']); 
		$ix=$ix+1;
	}
	
	$html .= '<tr bgcolor="#ffffff"><td></td>
		<td></td>
		<td bgcolor="#cccccc"><b>SUB TOTAL</b></td>
		<td bgcolor="#cccccc">'.$currency.' '.(@number_format($totalValue,2)).'</td>
	</tr>';
	
	$html .= '<tr bgcolor="#ffffff">
		<td></td>
		<td><b>INCLUDED:</b> COMPREHENSIVE INSURANCE, VEHICLE GIVEN WITH FULL TANK & RETURNED WITH FULL TANK</td>
		<td></td>
		<td></td>
	</tr>';

	$html .= '<tr bgcolor="#ffffff">
		<td></td>
		<td></td>
		<td>'.$vat.'%</td>
		<td>'.$currency.' '.(@number_format(($totalValue*$vatd/100),2)).'</td>
	</tr>';
	
	$html .= '<tr bgcolor="#cccccc">
		<td></td>
		<td></td>
		<td><b>TOTAL</b></td>
		<td>'.$currency.' '.(@number_format(($totalValue+(($totalValue*$vatd/100))),2)).'</td>
	</tr>';
	
$html .= '</table><br><br>';

	email("CITYDRIVE PROSPECT PRELIMINARY QUOTE",$html,$_SESSION['CustomerEmail'],"info@citydriverentacar.com");
	email("CITYDRIVE PROSPECT PRELIMINARY QUOTE",$html,$_SESSION['CustomerEmail'],"reservations@citydriverentacar.com");
	}
	echo count($_SESSION['cart']);
    exit();
  }

  if(isset($_POST['item_idx']))
  {
	$i = $_POST['item_idx'];

	unset($_SESSION['cart'][$i]);

    echo count($_SESSION['cart']);
    exit();
  }

  if(isset($_POST['item_currency']))
  {
	$_SESSION['currency'] = $_POST['item_currency'];

    echo $_SESSION['currency'];
    exit();
  }

  if(isset($_REQUEST['show_currency']))
  {
    echo currentCurrency();
    exit();
  }

if(isset($_REQUEST['showcart']))
{
  
	if(isset($_SESSION['cartnum']))
	{
		if(isset($_SESSION["uniqueCode"]))
		{
			
		}
		else
		{
			$_SESSION["uniqueCode"] = strtoupper(uniqid());
		}
		
		
		if(isset($_SESSION["uniqueCode2"]))
		{
			
		}
		else
		{
			$_SESSION["uniqueCode2"] = strtoupper(uniqid());
		}
		
		
		if(isset($_SESSION["uniqueCode3"]))
		{
			
		}
		else
		{
			$_SESSION["uniqueCode3"] = strtoupper(uniqid());
		}
	}
	
	
	echo '<form action="./?ref=cart/" method="POST" id="checkoutForm" name="checkoutForm">';
	echo '<input name="num" type="hidden" value="'.count($_SESSION["cart"]).'">';
	echo '<div style=" width:95%; min-width:100px; margin-left:auto; margin-right:auto;">';
		echo '<div style=" width:100%; min-width:340px; margin-left:auto; margin-right:auto;" id="div1">';
		
		$totalValue = 0; 
		
		if(count($_SESSION["cart"])>=1)
		{
			$valuexx = getCartData(" WHERE Ref = '".$_SESSION["uniqueCode2"]."'");
			
			if($valuexx[0]["num"]<=0)
			{
				echo '<a class="waves-effect waves-light btn" style=" color:#ffff00; padding:6px;" onclick="javascript: validate('."'Make Full Payment'".')">Make Full Payment</a>';
				echo '<a class="waves-effect waves-light btn" style=" color:#ffff00; padding:6px;" onclick="javascript: validate('."'Make 50% Payment'".')">Make 50% Payment</a>';
			}
			else
			{
				echo '<a class="waves-effect waves-light btn" style=" color:#ffff00; padding:6px;" onclick="javascript: validate('."'Make Full Payment'".')">Amend Booking</a>';
				//echo '<a class="waves-effect waves-light btn" style=" color:#ffff00; padding:6px;" onclick="javascript: validate('."'Make 50% Payment'".')">Make 50% Payment</a>';
			}
		}
		echo '<a class="btn darken-2" onclick="show_cart();document.getElementById(&#39;id01&#39;).style.display=&#39;none&#39;" href="#" style="float:right; padding:6px; color:#ff0000; font-size:13px; font-weight:bold;">×</a>';
		
		if(count($_SESSION["cart"])>=1)
		{
		  echo '<a class="waves-effect waves-light btn" onclick="clear_cart();document.getElementById(&#39;id01&#39;).style.display=&#39;none&#39;" style="float: right; padding:6px; color:#ffff00; font-size:13px;" href="#">Clear Cart</a>';
		}
		
		if(count($_SESSION["cart"])>=1)
		{
		echo "<br>";
		echo '<a class="waves-effect waves-light btn" style="float: left; padding:6px; color:#ffff00; font-size:13px;"   onClick="return Debounce.call(this)"  href="./documents/quotation.pdf" target="_new">DOWNLOAD QUOTATION</a>';
		echo '<a class="waves-effect waves-light btn" style="float: left; padding:6px; color:#ffff00; font-size:13px;"   onClick="return Debounce.call(this)"  href="./documents/invoice.pdf" target="_new">DOWNLOAD INVOICE</a>';
		
		
		
			if(chkSes()=="Active")
			{
				$userData = userData();
				
				echo "<input type='hidden' name='email' value='".$userData["Email"]."' id='emailAdd'>";
			}
			else
			{
				echo "<input type='email' name='email' placeholder='YOUR EMAIL ADDRESS' value='".$_SESSION['CustomerEmail']."' id='emailAdd' class='waves-effect' style='color:#000; padding:6px; width:150px;'> *";
			}
		}
		
		echo "</div>";
		








		if(count($_SESSION["cart"])>=1)
		{
			$value = end ($_SESSION['cart']); 
			$i = 0;
			$currency = currentCurrency();
			while ($value) 
			{
				if($value["currency"]=="")
				{
					$currency = $currency;
				}
				else
				{
					$currency = $value["currency"];
				}
				
				if($value["chauffeur"]>0)
				{
					$extra_charges_txt[$i] .= "(<b>CHAUFFEUR:</b> ".$currency."".$value["chauffeur_rate"]." x ".($value["chauffeur"]/$value["chauffeur_rate"]).")";
				}
				
				if($value["mileage_charge"]>0)
				{
					$extra_charges_txt[$i] .= "(<b>MILEAGE:</b> ".$currency."".$value["mileage_rate"]." x ".($value["mileage_charge"]/$value["mileage_rate"]).")";
				}
				
				if($value["oneway_rental_fee"]>0)
				{
					$extra_charges_txt[$i] .= "(<b>ONEWAY RENTAL FEE:</b> ".$currency."".$value["oneway_rental_fee"].")";
				}
				
				if(getVehicleCategoryExample($value["pID"])=="")
				{
					$example[$i] = "";
				}
				else
				{
					$example[$i] = " (".getVehicleCategoryExample($value["pID"])." or similar)";
				}
				
				//echo "<div style='  margin:5px; background-color:#fff; border-radius: 17px;' align='left'>";
				echo "<div class='cart_items' id='itemx".$i."' style=' width:100%; font-size:13px; background-color:#fff; border-radius: 2px; padding:5px; margin-bottom:5px;'>";
					echo "<table>";
						echo "<tr>";
							echo "<td>";
								echo "<img src='".$value["src"]."' style='width:140px; margin:5px;'>";
							echo "</td>";
							echo "<td>";
								echo "<div style='float: left'>".$value["qty"]." ".$value["name"]."".$example[$i]." for ".$value["duration"]." ".$value["unit"]."(s)<br>@ ".$currency."".$value["price"]." per ".$value["unit"].".<br>".$extra_charges_txt[$i]."<br><b>Sub Total: ".$currency."".(number_format(((($value["price"]*$value["duration"]*$value["qty"])+($value["chauffeur"]*$value["qty"])+($value["mileage_charge"]*$value["qty"])+($value["oneway_rental_fee"]*$value["qty"]))),2))."</b></div>";
								echo '<input name="productID'.$i.'" type="hidden" value="'.$value["pID"].'">';
								echo '<input name="img'.$i.'" type="hidden" value="'.$value["src"].'">';
								echo '<input name="price'.$i.'" type="hidden" value="'.$value["price"].'">';
								echo '<input name="merchantID'.$i.'" type="hidden" value="'.$value["merchantID"].'">';
								echo '<input name="unit'.$i.'" type="hidden" value="'.$value["unit"].'">';
								echo '<input name="unitID'.$i.'" type="hidden" value="'.$value["unitID"].'">';
								echo '<input name="extra_charges'.$i.'" type="hidden" value="'.json_encode($value["extra_charges"]).'">';
								
								echo '<input name="qty'.$i.'" type="hidden" value="'.$value["qty"].'">';
								echo '<input name="duration'.$i.'" type="hidden" value="'.$value["duration"].'">';
								echo '<input type="hidden" id="itemx'.$i.'_idx" value="'.$value["CartID"].'">';
							echo "</td>";
						echo "</tr>";
						echo "<tr style='height:20px;'>";
							echo "<td style='height:20px;'>";
							if(checkVehicleOrNot($value["pID"])=="VEHICLE")
							{
								if($value["pID"]=="6A" || $value["pID"]=="6B")
								{
									echo "<a href='?ref=camper/accessories.php' class='waves-effect waves-light btn' align='right' style='position:relative; border-radius: 5px; padding:5px; color:#fff; font-size:11px; width:100px;'>Add Accessories</a>";
								}
								else
								{
									echo "<a href='?ref=accessories.html&id=".$value["CartID"]."' class='waves-effect waves-light btn' align='right' style='position:relative; border-radius: 5px; padding:5px; color:#fff; font-size:11px; width:100px;'>Add Accessories</a>";
								}
							}
							
							echo "</td>";
							echo "<td style='height:20px;'>";
							echo "</td>";
						echo "</tr>";
						echo "<tr style='height:20px;'>";
							echo "<td style='height:20px;'>";
								echo "<a href='?ref=amend_booking.php&id=".$value["CartID"]."' class='waves-effect waves-light btn' align='right' style='position:relative; border-radius: 5px; padding:5px; color:#fff; font-size:11px; width:100px;'>Amend Booking</a>";
							echo "</td>";
							echo "<td style='height:20px;'>";
								echo "<a onclick='remove_item(".'"'."itemx".$i."".'"'.");document.getElementById(&#39;id01&#39;).style.display=&#39;none&#39;' align='right' class='waves-effect waves-light btn' style='position:relative; right:5px; border-radius: 5px; padding:5px; color:#fff; font-size:11px; width:110px;'>Remove From Cart </a>";
							echo "</td>";
						echo "</tr>";
					echo "</table>";
				echo "</div>";
				//echo "</div>";
				$_SESSION['cart'][$value["CartID"]]["total"] = ($value["price"]*$value["duration"]*$value["qty"])+($value["chauffeur"]*$value["qty"])+($value["mileage_charge"]*$value["qty"])+($value["oneway_rental_fee"]*$value["qty"]);
				$totalValue = $totalValue+(($value["price"]*$value["duration"]*$value["qty"])+($value["chauffeur"]*$value["qty"])+($value["mileage_charge"]*$value["qty"])+($value["oneway_rental_fee"]*$value["qty"]));
				$value = prev($_SESSION['cart']); 
				$i=$i+1;
			}

			echo '<input name="totalValue" id="totalValue" type="hidden" value="'.$totalValue.'">';
		}
		else
		{
			echo "<div style=' margin:5px; border-radius: 17px;'>THERE ARE NO ITEMS IN YOUR CART.</div>";
		}
		
		echo "<b>Total: </b>".$currency."".(number_format($totalValue,2))."</div>";
	echo "</form>";
	

	/*echo '<script src="apps/website/resources/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript">$(\'#checkoutForm\').submit(function(){
    if ($.trim($("#emailAdd").val()) === "") {
        alert(\'Please enter Email Address.\');
    return false;
    }});</script>';*/
	

	exit();	
}

  if(isset($_POST['clearcart']))
  {
	unset($_SESSION['cart']);
	unset($_SESSION['CustomerName']);
	unset($_SESSION['uniqueCode']);
	unset($_SESSION['uniqueCode2']);
	unset($_SESSION['uniqueCode3']);
	unset($_SESSION['cartnum']);
	echo 0;
    exit();	
  }
?>