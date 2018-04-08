<?php
/*
		else
		{
			print_r($tokenx);
		}
		*/

if(isset($_REQUEST["email"]) && !($_REQUEST["email"]==""))
{
	$valuex = getCartData(" WHERE Ref = '".$_SESSION["uniqueCode2"]."' AND CustomerEmail = '".$_REQUEST["email"]."'");
}
else
{
	$valuex[0]["num"] = 0;
}


if($valuex[0]["num"]<=0 || $valuex[0]["num"]=="" || !(isset($valuex[0]["num"])))
{
	//0000
	
//echo "testing...<br>";

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
	
	
	
	$servicesArray = array('Service'=>array('ServiceType'=>6408,'ServiceDescription'=>$narration."Hiring Vehicle(s) and/or Accessories",'ServiceDate'=>$time));
	
	if($_REQUEST["num"]=="" || $_REQUEST["num"]<="0")
	{
		
	}
	else
	{
		$tx = strtoupper($_SESSION["uniqueCode2"]);
		
		$redirecturl = "https://citydriverentacar.com/?ref=cart/finish.php";
		$backurl = "https://citydriverentacar.com/?ref=cart/back.php";
		
		$_SESSION['CustomerEmail'] = $_REQUEST["email"];
		
		/*
		echo "totalValue:".$totalValue."<br>";
		echo "uniqueCode2:".$_SESSION['uniqueCode2']."<br>";
		echo "currentCurrency:".currentCurrency()."<br>";
		echo "backurl:".$backurl."<br>";WD
		echo "email:".$_REQUEST["email"]."<br>";
		echo "servicesArray:";
		print_r($servicesArray);
		echo "<br>";*/
		
		$tokenx = createToken($totalValue,currentCurrency(),$_SESSION['uniqueCode2'],$redirecturl,$backurl,0,5,$_REQUEST["email"],$servicesArray);
		$tokeny = XMLToArray($tokenx);
		$token = $tokeny["API3G"];
		
		//echo "total: ";
		//print_r($tokenx);
		//echo "<br>";
		
		//echo "| db cart num:".$valuex[0]["num"]."<br>";
		//echo "| cart num:".$_REQUEST["num"]."<br>";
		
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
	
}

router(array("FOOTER","website"),"","",'','','file','');
	
?>