<?php
if(isset($_REQUEST["email"]) && !($_REQUEST["email"]==""))
{
	$valuex = getCartData(" WHERE Ref = '".$_SESSION["uniqueCode2"]."' AND CustomerEmail = '".$_REQUEST["email"]."'");
}
else
{
	$valuex[0]["num"] = 0;
}	

//echo "num:".$valuex[0]["num"]."<br>";

if($valuex[0]["num"]<=0)
{
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
	
	//live ServiceType: 6408
	//test ServiceType: 6502
	$time = date("Y/m/d");
			
	if($_REQUEST["submitBtn"]=="Make Full Payment")
	{
		$narration = "Full payment for ";
	}
	else
	{
		$narration = "50% payment for ";
	}
	
	$servicesArray = array('Service'=>array('ServiceType'=>6502,'ServiceDescription'=>$narration."Hiring Vehicle(s) and/or Accessories",'ServiceDate'=>$time));
	
	if($_SESSION["token"]=="" || !(isset($_SESSION["token"])))
	{
		if($_REQUEST["num"]=="" || $_REQUEST["num"]<="0")
		{
			
		}
		else
		{
			$tx = strtoupper($_SESSION["uniqueCode2"]);
			
			$redirecturl = "http://citydriverentacar.com/?ref=cart/index.php";
			$backurl = "http://citydriverentacar.com/?ref=cart/index.php";
			
			if(currentCurrency()=="ZMW")
			{
				if($_REQUEST["submitBtn"]=="Make Full Payment")
				{
					$totalValue = $_REQUEST["totalValue"]+($_REQUEST["totalValue"]*4.5/100)+(0.15*10)+($_REQUEST["totalValue"]*1.2/100);
				}
				else
				{
					$totalValue = (($_REQUEST["totalValue"])/2)+((($_REQUEST["totalValue"])/2)*4.5/100)+(0.15*10)+((($_REQUEST["totalValue"])/2)*1.2/100);
				}
			}
			else
			{
				if($_REQUEST["submitBtn"]=="Make Full Payment")
				{
					$totalValue = $_REQUEST["totalValue"];
				}
				else
				{
					$totalValue = ($_REQUEST["totalValue"]/2);
				}
			}
			
			$_SESSION['CustomerEmail'] = $_REQUEST["email"];
			
			/*
			echo "totalValue:".$totalValue."<br>";
			echo "uniqueCode2:".$_SESSION['uniqueCode2']."<br>";
			echo "currentCurrency:".currentCurrency()."<br>";
			echo "backurl:".$backurl."<br>";
			echo "email:".$_REQUEST["email"]."<br>";
			echo "servicesArray:";
			print_r($servicesArray);
			echo "<br>";*/
			
			$tokenx = createToken($totalValue,currentCurrency(),$_SESSION['uniqueCode2'],$redirecturl,$backurl,0,5,$_REQUEST["email"],$servicesArray);
			$tokeny = XMLToArray($tokenx);
			$token = $tokeny["API3G"];
			
			if($token["Result"]=="000")
			{
				$_SESSION["token"] = $token["TransToken"];
				$_SESSION["ref_num"] = $tx;
				
				header("Location:https://secure.3gdirectpay.com/pay.asp?ID=".$token["TransToken"]);
				die();
			}
		}
	}
	else
	{
		
	}
}
else
{
	deleteCartData($_SESSION["uniqueCode2"]);
			
	if(count($_SESSION["cart"])>=1)
	{
		$value = end ($_SESSION['cart']); 
		$i = 0;
		while ($value) 
		{
			saveCartData($value["CartID"],$value["merchantID"],$value["name"],$value["currency"],$value["price"],$value["discount"],$value["src"],$value["pID"],$value["pType"],$value["qty"],$value["duration"],$value["unit"],$value["unitID"],$value["pickUpTown"],$value["pickUpArea"],$value["pickUpDateTime"],$value["DropOffCountry"],$value["DropOffDateTime"],$value["DropOffTown"],$value["DrivingTo"],$value["distance"],$value["WithChauffeur"],$value["chauffeur_rate"],$value["chauffeur"],$value["mileage_rate"],$value["mileage_charge"],$value["oneway_rental_fee"],$value["total"],$value["NoOfAdults"],$value["NoOfChildren"],$value["extra_charges"],$_SESSION["ref_num"],$_SESSION['CustomerEmail'],$token2['CustomerPhone']);
			
			$value = prev($_SESSION['cart']); 
			$i=$i+1;
		}
	}
	else
	{
		
	}
			
	$message2x = "Hello Admin,<br><br>";
	$message2x .= "The booking, Reference Number <b>".$_SESSION["uniqueCode2"]."</b> has been ammended. <a href='http://citydriverentacar.com/?ref=cart/viewcart.php&cartRef=".$_SESSION["uniqueCode2"]."'>Click here</a> or go to http://citydriverentacar.com/?ref=cart/viewcart.php&cartRef=".$_SESSION["uniqueCode2"]." to view new booking details.<br>";	
	
	email("BOOKING AMMENDMENT NOTIFICATION",$message2x,"info@citydriverentacar.com","reservations@citydriverentacar.com");
}	
router(array("HEADER","website"),"","",'','','file','');
include find_file("apps/cart/layouts/pages/nav.php");

if($valuex[0]["num"]<=0)
{
	if($_SESSION["token"]=="" || !(isset($_SESSION["token"])))
	{
		if($_REQUEST["num"]=="" || $_REQUEST["num"]<="0")
		{
			if(chkSes()=="Active")
			{
				$userData = userData();
				transList($userData["Email"],"UNPAID");
			}
		}
		else
		{
			//
			if($token["Result"]=="0000")
			{
				
			}
			else
			{
				unset($_SESSION["uniqueCode"]);
				unset($_SESSION["uniqueCode2"]);
				unset($_SESSION["uniqueCode3"]);
				unset($_SESSION["token"]);
		
				echo "<b>Result: </b>".$token["Result"]."<br>";
				echo "<b>ResultExplanation:</b> ".$token["ResultExplanation"];
			}
		}
	}
	else
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
				$message .= "Welcome to the CItydrive family! We have created an account for your to allow you to make changes to your hire details if you need to:<br>";
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
			$message2 .= "Booking, Reference Number <b>".$_SESSION["ref_num"]."</b> has been ammended. <a href='http://citydriverentacar.com/?ref=cart/viewcart.php&cartRef=".$_SESSION["ref_num"]."'>Click here</a> or go to http://citydriverentacar.com/?ref=cart/viewcart.php&cartRef=".$_SESSION["ref_num"]." to view new booking details.<br>";
			
			email("ONLINE PAYMENT NOTIFICATION",$message2,"info@citydriverentacar.com","reservations@citydriverentacar.com");
		
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
}
router(array("FOOTER","website"),"","",'','','file','');
	
?>