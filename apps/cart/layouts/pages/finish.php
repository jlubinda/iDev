<?php

router(array("HEADER","website"),"","",'','','file','');
include find_file("apps/cart/layouts/pages/nav.php");

if(!($_SESSION["token"]=="") && isset($_SESSION["token"]))
{
	$tokenx2 = verifyToken($_SESSION["token"]);		
	$tokeny2 = XMLToArray($tokenx2);
	$token2 = $tokeny2["API3G"];
	
	echo "Result: ".$token2["Result"]."<br>";
	echo "<b>Result Explanation: </b>".$token2["ResultExplanation"]."<br>";
	if(!($token2["FraudAlert"]=="" || $token2["FraudAlert"]=="000"))
	{
		echo "<b>Fraud Alert: </b>".$token2["FraudExplnation"];
	}
	
	if(checkAccount("CHECK ALL",$_SESSION['CustomerEmail'])==0)
	{
		$userx = explode(" ", $token2["CustomerName"]);
		
		$Password = genPassword(6,12);
		
		//$token2["CustomerCountry"],$token2["CustomerAddress"],$token2["CustomerCity"],$token2["CustomerZip"]
		
		$createAccount = createUserAccount($userx[0],$userx[1],$_SESSION['CustomerEmail'],$token2["CustomerName"],$token2["CustomerPhone"],$_SESSION['CustomerEmail'],$Password,$token2["CustomerCountry"],"User","","","0","0",$token2["CustomerAddress"],$token2["CustomerZip"],"",$token2["CustomerPhone"],"","","","","","",$token2["CustomerCity"],"");
		
		if($createAccount==1)
		{
			$message = "Hello ".$token2["CustomerName"]."<br><br>";
			$message .= "Welcome to the Citydrive family! We have created an account for your to allow you to make changes to your hire details if you need to:<br>";
			$message .= "<b>USERNAME:</b> ".$_SESSION['CustomerEmail'];
			$message .= "<b>PASSWORD:</b> ".$Password."<br><br>";
			$message .= "<a href='http://citydriverentacar.com/?ref=login' target='_new'>Click here to login</a> Or go to http://citydriverentacar.com/?ref=login<br><br>";
			$message .= "Provide your email address as the username and the assigned password. go to your profile page under Dashboard and change your password to something you can easily remember.<br><br>";
			$message .= "Once again, welcome to our family. We look forward to meeting you in person. <br><br>";
			$message .= "Warm regards,<br><br>";
			$message .= "Greg Chama<br>";
			$message .= "CEO";
			
			email("WELCOME TO THE CITYDRIVE FAMILY",$message,"info@citydriverentacar.com",$_SESSION['CustomerEmail']);
			
			echo "An account has been created for you to allow you to ammend your booking details if you need to do so. Please check your email for your login details. Thank you.";
		}
	}
	
	
	
	
	
	$save = saveTransData($_SESSION["token"],$token2["Result"],$token2["ResultExplanation"],$token2["CustomerName"],$token2["CustomerCredit"],$token2["TransactionApproval"],$token2["TransactionCurrency"],$token2["TransactionAmount"],$token2["FraudAlert"],$token2["FraudExplnation"],$token2["TransactionNetAmount"],$token2["TransactionSettlementDate"],$token2["TransactionRollingReserveAmount"],$token2["TransactionRollingReserveDate"],$token2["CustomerPhone"],$token2["CustomerCountry"],$token2["CustomerAddress"],$token2["CustomerCity"],$token2["CustomerZip"],$token2["MobilePaymentRequest"],$token2["AccRef"],$_SESSION["ref_num"],$_SESSION['CustomerEmail']);
	$_SESSION['CustomerName'] = $token2["CustomerName"];
	
	$trand1 = (float) $token2["TransactionAmount"];
	
	if($trand1>0)
	{
		$message2 = "Hello Admin,<br><br>";
		$message2 .= "<b>".$token2["CustomerName"]."</b> has just paid online. Below are the transaction details:<br>";
		$message2 = "<u><b>Transaction Information</b></u><br>";
		$message2 .= "<b>Phone:</b> ".$token2['CustomerPhone']."<br>";
		$message2 .= "<b>Email:</b> ".$_SESSION['CustomerEmail']."<br>";
		$message2 .= "<b>Phone:</b> ".$token2['CustomerPhone']."<br>";
		$message2 .= "<b>Address:</b> ".$token2['CustomerAddress']."<br>";
		$message2 .= "<b>City:</b> ".$token2['CustomerCity']."<br>";
		$message2 .= "<b>Country:</b> ".$token2['CustomerCountry']."<br>";
		$message2 .= "<b>Zip Code:</b> ".$token2['CustomerZip']."<br><br>";
		$message2 .= "<b>TransactionCurrency:</b> ".$token2['TransactionCurrency']."<br>";
		$message2 .= "<b>Transaction Amount:</b> ".$token2['TransactionAmount']."<br>";
		$message2 .= "<b>Payment Gateway Result Explanation:</b> ".$token2['ResultExplanation']."<br>";
		$message2 .= "<b>Fraud Alert:</b> ".$token2['FraudExplnation']."<br>";
		$message2 .= "<b>Transaction Approval:</b> ".$token2['TransactionApproval']."<br>";
		$message2 .= "<b>Transaction Net Amount:</b> ".$token2['TransactionNetAmount']."<br>";
		$message2 .= "<b>Transaction Settlement Date:</b> ".$token2['TransactionSettlementDate']."<br>";
		$message2 .= "<b>Transaction Rolling Reserve Amount:</b> ".$token2['TransactionRollingReserveAmount']."<br>";
		$message2 .= "<b>Transaction Rolling Reserve Date:</b> ".$token2['TransactionRollingReserveDate']."<br>";
		$message2 .= "<b>Transaction Reference Number:</b> ".$_SESSION["ref_num"]."<br>";
		$message2 .= "<b>Acc Ref:</b> ".$token2['AccRef']."<br><br>";
		$message2 .= "Booking, Reference Number <b>".$_SESSION["ref_num"]."</b> has been saved. <a href='http://citydriverentacar.com/?ref=cart/viewcart.php&cartRef=".$_SESSION["ref_num"]."'>Click here</a> or go to http://citydriverentacar.com/?ref=cart/viewcart.php&cartRef=".$_SESSION["ref_num"]." to view new booking details (you must be logged in on www.citydriverentacar.com before clicking the link).<br>";
					
			$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

			$htmlx = '
			<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
				<tr>
					<td align="left" cellpadding="4">To: '.$_SESSION['CustomeName'].' <br />'.$_SESSION['CustomerEmail'].'</td>
					<td align="right" cellpadding="4"><span style="font-size:30px;">QUOTE</span><br>Q'.strtoupper($_SESSION["uniqueCode"]).'<br><strong>DATE:</strong> '.date("d-m-Y").'</td>
				</tr></table><br><br>
				
			<table cellspacing="3" cellpadding="4"  bgcolor="#cccccc">
				<tr>
					<td width="80"><b>QTY</b></td>
					<td width="260"><b>DESCRIPTION</b></td>
					<td width="130"><b>UNIT PRICE</b></td>
					<td><b>LINE TOTAL</b></td>
				</tr>';
			$currency = currentCurrency();
			$totalValue = 0;

			$valuex = end ($_SESSION['cart']); 
			$ix = 0;
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
		
				if(!(isset($valuex["pickUpArea"])) || $valuex["pickUpArea"]=="")
				{
					@$pickUpArea = "";
				}
				else
				{
					@$pickUpArea = $valuex["pickUpArea"];
				}
				
				
				if(!(isset($valuex["pickUpTown"])) || $valuex["pickUpTown"]=="")
				{
					@$pickUpTown = "";
				}
				else
				{
					@$pickUpTown = $valuex["pickUpTown"];
				}
				
				
				if(!(isset($valuex["pickUpDateTime"])) || $valuex["pickUpDateTime"]=="")
				{
					@$pickUpDateTime = "";
				}
				else
				{
					@$pickUpDateTime = $valuex["pickUpDateTime"];
				}
				
				
				if(!(isset($valuex["DrivingTo"])) || $valuex["DrivingTo"]=="")
				{
					@$DrivingTo = "";
				}
				else
				{
					@$DrivingTo = $valuex["DrivingTo"];
				}
				
				
				if(!(isset($valuex["distance"])) || $valuex["distance"]=="")
				{
					@$distance = "";
				}
				else
				{
					@$distance = $valuex["distance"];
				}
				
				if(!(isset($valuex["DropOffTown"])) || $valuex["DropOffTown"]=="")
				{
					@$DropOffTown = "";
				}
				else
				{
					@$DropOffTown = $valuex["DropOffTown"];
				}
				
				
				if(!(isset($valuex["DropOffDateTime"])) || $valuex["DropOffDateTime"]=="")
				{
					@$DropOffDateTime = "";
				}
				else
				{
					@$DropOffDateTime = $valuex["DropOffDateTime"];
				}
				
				
				$htmlx .= '<tr bgcolor="#ffffff">
					<td>'.$valuex["duration"].' days</td>
					<td><b>Hire of '.$valuex["qty"].' x '.$valuex["name"].'</b><br /><br /><b>PickUp Area</b> '.$pickUpArea.', '.$pickUpTown.'<br />on (date/time) '.$pickUpDateTime.'<br />
					<b>Driving From: </b>'.$pickUpTown.'<br />
					<b>Driving To: </b>'.$DrivingTo.'<br />
					<b>Drop Off Town: </b>'.$DropOffTown.' <br /> on (date/time) '.$DropOffDateTime.'</td>
					<td>'.$valuex["currency"].' '.(@number_format($valuex["price"],2)).'</td>
					<td>'.$valuex["currency"].' '.(@number_format(($valuex["price"]*$valuex["duration"]*$valuex["qty"]),2)).'</td>
				</tr>';
				
				if($valuex["oneway_rental_fee"]>0)
				{
				$htmlx .= '<tr bgcolor="#ffffff">
					<td></td>
					<td>ONEWAY RENTAL FEE</td>
					<td></td>
					<td>'.$valuex["currency"].' '.(@number_format(($valuex["oneway_rental_fee"]*$valuex["qty"]),2)).'</td>
				</tr>';
				}
				
				if($valuex["mileage_charge"]>0)
				{
				$htmlx .= '<tr bgcolor="#ffffff">
					<td>'.$valuex["distance"].' km</td>
					<td>MILEAGE</td>
					<td>'.$valuex["currency"].' '.(@number_format($valuex["mileage_rate"],2)).'</td>
					<td>'.$valuex["currency"].' '.(@number_format(($valuex["mileage_charge"]*$valuex["qty"]),2)).'</td>
				</tr>';
				}
				
				if($valuex["chauffeur"]>0)
				{
				$htmlx .= '<tr bgcolor="#ffffff">
					<td>'.$valuex["duration"].' days</td>
					<td>CHAUFFEUR</td>
					<td>'.$valuex["currency"].' '.(@number_format($valuex["chauffeur_rate"],2)).'</td>
					<td>'.$valuex["currency"].' '.(@number_format(($valuex["chauffeur"]*$valuex["qty"]),2)).'</td>
				</tr>';
				}
				
				$htmlx .= '<tr bgcolor="#ffffff"><td></td>
					<td></td>
					<td><b>ITEM TOTAL</b></td>
					<td>'.$valuex["currency"].' '.(@number_format((($valuex["price"]*$valuex["duration"]*$valuex["qty"])+($valuex["chauffeur"]*$valuex["qty"])+($valuex["mileage_charge"]*$valuex["qty"])+($valuex["oneway_rental_fee"]*$valuex["qty"])),2)).'</td>
				</tr>';
				$totalValue = $totalValue+(($valuex["price"]*$valuex["duration"]*$valuex["qty"])+($valuex["chauffeur"]*$valuex["qty"])+($valuex["mileage_charge"]*$valuex["qty"])+($valuex["oneway_rental_fee"]*$valuex["qty"]));
				$valuex = prev($_SESSION['cart']); 
				$ix=$ix+1;
			}
							
			$htmlx .= '<tr bgcolor="#ffffff"><td></td>
				<td></td>
				<td bgcolor="#cccccc"><b>SUB TOTAL</b></td>
				<td bgcolor="#cccccc">'.$currency.' '.(@number_format($totalValue,2)).'</td>
			</tr>';
			
			$htmlx .= '<tr bgcolor="#ffffff">
				<td></td>
				<td><b>INCLUDED:</b> COMPREHENSIVE INSURANCE, VEHICLE GIVEN WITH FULL TANK & RETURNED WITH FULL TANK</td>
				<td></td>
				<td></td>
			</tr>';

			$htmlx .= '<tr bgcolor="#ffffff">
				<td></td>
				<td></td>
				<td>'.$vat.'%</td>
				<td>'.$currency.' '.(@number_format(($totalValue*$vatd/100),2)).'</td>
			</tr>';
			
			$htmlx .= '<tr bgcolor="#cccccc">
				<td></td>
				<td></td>
				<td><b>TOTAL</b></td>
				<td>'.$currency.' '.(@number_format(($totalValue+(($totalValue*$vatd/100))),2)).'</td>
			</tr>';
		
			$htmlx .= '<tr bgcolor="#cccccc">
				<td></td>
				<td></td>
				<td><b>PAID</b></td>
				<td>'.$token2['TransactionCurrency'].' '.(@number_format((float) $token2['TransactionAmount'],2)).'</td>
			</tr>';
				
			$htmlx .= '</table><br><br>';
			
		email("ONLINE PAYMENT NOTIFICATION",$message2."<br><br><br><br>".$htmlx,"info@citydriverentacar.com","reservations@citydriverentacar.com");
	
		$status = "PAID|HIRE CONFIRMED PENDING PICKUP|".$token["Result"];
	}
	else
	{
		$status = "NOT PAID|HIRE UNCONFIRMED|".$token["Result"];
	}
	
	if($save==1)
	{
		if(count($_SESSION["cart"])>=1)
		{
			$value = end ($_SESSION['cart']); 
			$i = 0;
			while ($value) 
			{
				saveCartData($value["CartID"],$value["merchantID"],$value["name"],$value["currency"],$value["price"],$value["discount"],$value["src"],$value["pID"],$value["pType"],$value["qty"],$value["duration"],$value["unit"],$value["unitID"],$value["pickUpTown"],$value["pickUpArea"],$value["pickUpDateTime"],$value["DropOffCountry"],$value["DropOffDateTime"],$value["DropOffTown"],$value["DrivingTo"],$value["distance"],$value["WithChauffeur"],$value["chauffeur_rate"],$value["chauffeur"],$value["mileage_rate"],$value["mileage_charge"],$value["oneway_rental_fee"],$value["total"],$value["NoOfAdults"],$value["NoOfChildren"],$value["extra_charges"],$_SESSION["ref_num"],$_SESSION['CustomerEmail'],$token2['CustomerPhone'],$status);
				$value = prev($_SESSION['cart']);
				$i=$i+1;
			}
		}
		else
		{
			
		}
		
		echo "<b>Total: </b>".$token2["TransactionCurrency"].$token2["TransactionAmount"]."</div>";
		echo "<br>Transaction Saved";
		
		$trand = (float) $token2["TransactionAmount"];
		
		if($trand>0)
		{
		?>
		<iframe name="_confirmation" src="./documents/confirmationletter.pdf" style="border:2px solid grey; width:90%; min-width:400px; min-height:450px;"></iframe>
		<?php
		}
		else
		{
			unset($_SESSION["uniqueCode"]);
			unset($_SESSION["uniqueCode2"]);
			unset($_SESSION["uniqueCode3"]);
			unset($_SESSION["token"]);
		}
		//echo "<a href='./documents/confirmationletter.pdf'>RESERVATION CONFIRMATION LETTER</a>";
		
	}
	else
	{
		echo "<br>Sorry. Transaction Not Saved";
		
		unset($_SESSION["uniqueCode"]);
		unset($_SESSION["uniqueCode2"]);
		unset($_SESSION["uniqueCode3"]);
		unset($_SESSION["token"]);
	}
	
	if(isset($_SESSION['CustomerEmail']))
	{
		transList($_SESSION['CustomerEmail'],"UNPAID");
	}
	else
	{
		if(chkSes()=="Active")
		{
			$userData = userData();
			transList($userData["Email"],"UNPAID");
		}
	}
}
else
{
	if(isset($_SESSION['CustomerEmail']))
	{
		transList($_SESSION['CustomerEmail'],"UNPAID");
	}
	else
	{
		if(chkSes()=="Active")
		{
			$userData = userData();
			transList($userData["Email"],"UNPAID");
		}
	}
}
		
router(array("FOOTER","website"),"","",'','','file','');
	
?>