<?php
if(function_exists('httpPostXMLq'))
{
	
}
else
{
	function httpPostXMLq($url,$xml){
		
		$headers = array(
			"Content-type: text/xml;charset=\"utf-8\"",
			"Accept: text/xml",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			"SOAPAction: \"run\""
		 );
		
			/*
		        //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);

            // send xml request to a server

            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

            curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			*/
			
			$ch = curl_init($url);
			@curl_setopt($ch, CURLOPT_MUTE, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$server_output = curl_exec($ch);
		curl_close($ch);

		return $server_output;
	}
}


if(function_exists('DirectPayAPIKey'))
{
	
}
else
{
	function DirectPayAPIKey(){
		return '0E523DB7-0FBA-453A-9B18-A1446F0B09F6'; //live
		//return 'D7E04568-FECD-4CDD-84BF-E5716FE77F62'; //test
	}
}

if(function_exists('createToken'))
{
	
}
else
{
	function createToken($PaymentAmount,$PaymentCurrency,$CompanyRef,$RedirectURL,$BackURL,$CompanyRefUnique,$PTL,$customerEmail,$servicesArray="",$allocationssArray=""){
	
						if($servicesArray=="")
						{
							if($allocationssArray=="")
							{
								
							$array = array(
								'API3G'=>array(
									'CompanyToken'=>DirectPayAPIKey(),
									'Request'=>'createToken',
									'Transaction'=>array (  
										'PaymentAmount'=>$PaymentAmount, 
										'PaymentCurrency'=>$PaymentCurrency, 
										'CompanyRef'=>$CompanyRef, 
										'RedirectURL'=>$RedirectURL,
										'BackURL'=>$BackURL,
										'CompanyRefUnique'=>$CompanyRefUnique,
										'PTL'=>$PTL,
										'customerEmail'=>$customerEmail) ) );
							}
							else
							{
								
							$array = array(
								'API3G'=>array(
									'CompanyToken'=>DirectPayAPIKey(),
									'Request'=>'createToken',
									'Transaction'=>array (
										'PaymentAmount'=>$PaymentAmount, 
										'PaymentCurrency'=>$PaymentCurrency, 
										'CompanyRef'=>$CompanyRef, 
										'RedirectURL'=>$RedirectURL,
										'BackURL'=>$BackURL,
										'CompanyRefUnique'=>$CompanyRefUnique,
										'PTL'=>$PTL,
										'customerEmail'=>$customerEmail),'Allocations'=>$allocationssArray) );
							}
						}
						else
						{
							
							if($allocationssArray=="")
							{
							$array = array(
								'API3G'=>array(
									'CompanyToken'=>DirectPayAPIKey(),
									'Request'=>'createToken',
									'Transaction'=>array (
										'PaymentAmount'=>$PaymentAmount, 
										'PaymentCurrency'=>$PaymentCurrency, 
										'CompanyRef'=>$CompanyRef, 
										'RedirectURL'=>$RedirectURL,
										'BackURL'=>$BackURL,
										'CompanyRefUnique'=>$CompanyRefUnique,
										'PTL'=>$PTL,
										'customerEmail'=>$customerEmail),'Services'=>$servicesArray) );
							}
							else
							{
								
							$array = array(
								'API3G'=>array(
									'CompanyToken'=>DirectPayAPIKey(),
									'Request'=>'createToken',
									'Transaction'=>array (
										'PaymentAmount'=>$PaymentAmount, 
										'PaymentCurrency'=>$PaymentCurrency, 
										'CompanyRef'=>$CompanyRef, 
										'RedirectURL'=>$RedirectURL,
										'BackURL'=>$BackURL,
										'CompanyRefUnique'=>$CompanyRefUnique,
										'PTL'=>$PTL,
										'customerEmail'=>$customerEmail),'Services'=>$servicesArray,'Allocations'=>$allocationssArray) );
							}
						}
						$xml = myArrayToXML($array);
				//echo '<pre>';
				//echo $xml;
				//echo '</pre><br><br>';
		$post = httpPostXMLq('https://secure.3gdirectpay.com/API/v5/',$xml);
	
		return $post;
	}
}


if(function_exists('verifyToken'))
{
	
}
else
{
	function verifyToken($TransactionToken){
	
		$array = array('API3G'=>array('CompanyToken'=>DirectPayAPIKey(),'Request'=>'verifyToken','TransactionToken'=>$TransactionToken));
							
		$xml = myArrayToXML($array);
				
		$post = httpPostXMLq('https://secure.3gdirectpay.com/API/v5/',$xml);
	
		return $post;
	}
}


if(function_exists('saveTransData'))
{
	
}
else
{
	function saveTransData($Token,$Result,$ResultExplanation,$CustomerName,$CustomerCredit,$TransactionApproval,$TransactionCurrency,$TransactionAmount,$FraudAlert,$FraudExplnation,$TransactionNetAmount,$TransactionSettlementDate,$TransactionRollingReserveAmount,$TransactionRollingReserveDate,$CustomerPhone,$CustomerCountry,$CustomerAddress,$CustomerCity,$CustomerZip,$MobilePaymentRequest,$AccRef,$Ref,$userID){
	
		include find_file("cnct.php");
		
		$ins = "INSERT INTO transactions (id,Token,Result,ResultExplanation,CustomerName,CustomerCredit,TransactionApproval,TransactionCurrency,TransactionAmount,FraudAlert,FraudExplnation,TransactionNetAmount,TransactionSettlementDate,TransactionRollingReserveAmount,TransactionRollingReserveDate,CustomerPhone,CustomerCountry,CustomerAddress,CustomerCity,CustomerZip,MobilePaymentRequest,AccRef,Ref,userID) VALUES ('','".$Token."','".$Result."','".$ResultExplanation."','".$CustomerName."','".$CustomerCredit."','".$TransactionApproval."','".$TransactionCurrency."','".$TransactionAmount."','".$FraudAlert."','".$FraudExplnation."','".$TransactionNetAmount."','".$TransactionSettlementDate."','".$TransactionRollingReserveAmount."','".$TransactionRollingReserveDate."','".$CustomerPhone."','".$CustomerCountry."','".$CustomerAddress."','".$CustomerCity."','".$CustomerZip."','".$MobilePaymentRequest."','".$AccRef."','".$Ref."','".$userID."');";
		$res = mysqli_query($db,$ins);
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}


if(function_exists('getTransData'))
{
	
}
else
{
	function getTransData($sql=""){
		
		if($sql=="")
		{
			$filter = "";
		}
		else
		{
			$filter = " ".$sql;
		}
	
		include find_file("cnct.php");
		
		$ins = "SELECT * FROM transactions ".$filter.";";
		//echo $ins."<br>";
		$res = mysqli_query($db,$ins);
		@$num = mysqli_num_rows($res);
		//echo "Num: ".$num."<br>";  
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$Token = $rw["Token"];
			$Result = $rw["Result"];
			$ResultExplanation = $rw["ResultExplanation"];
			$CustomerName = $rw["CustomerName"];
			$CustomerCredit = $rw["CustomerCredit"];
			$TransactionApproval = $rw["TransactionApproval"];
			$TransactionCurrency = $rw["TransactionCurrency"];
			$TransactionAmount = $rw["TransactionAmount"];
			$FraudAlert = $rw["FraudAlert"];
			$FraudExplnation = $rw["FraudExplnation"];
			$TransactionNetAmount = $rw["TransactionNetAmount"];
			$TransactionSettlementDate = $rw["TransactionSettlementDate"];
			$TransactionRollingReserveAmount = $rw["TransactionRollingReserveAmount"];
			$TransactionRollingReserveDate = $rw["TransactionRollingReserveDate"];
			$CustomerPhone = $rw["CustomerPhone"];
			$CustomerCountry = $rw["CustomerCountry"];
			$CustomerAddress = $rw["CustomerAddress"];
			$CustomerCity = $rw["CustomerCity"];
			$CustomerZip = $rw["CustomerZip"];
			$MobilePaymentRequest = $rw["MobilePaymentRequest"];
			$AccRef = $rw["AccRef"];
			$userID = $rw["userID"];
			$Ref = $rw["Ref"];
			$dateset = $rw["dateset"];
			
			$array[] = array('num'=>$num,'id'=>$id,'Token'=>$Token,'Result'=>$Result,'ResultExplanation'=>$ResultExplanation,'CustomerName'=>$CustomerName,'CustomerCredit'=>$CustomerCredit,'TransactionApproval'=>$TransactionApproval,'TransactionCurrency'=>$TransactionCurrency,'TransactionAmount'=>$TransactionAmount,'FraudAlert'=>$FraudAlert,'FraudExplnation'=>$FraudExplnation,'TransactionNetAmount'=>$TransactionNetAmount,'TransactionSettlementDate'=>$TransactionSettlementDate,'TransactionRollingReserveAmount'=>$TransactionRollingReserveAmount,'TransactionRollingReserveDate'=>$TransactionRollingReserveDate,'CustomerPhone'=>$CustomerPhone,'CustomerCountry'=>$CustomerCountry,'CustomerAddress'=>$CustomerAddress,'CustomerCity'=>$CustomerCity,'CustomerZip'=>$CustomerZip,'MobilePaymentRequest'=>$MobilePaymentRequest,'AccRef'=>$AccRef,'Ref'=>$Ref,'userID'=>$userID,'dateset'=>$dateset);
		}
		
		return $array;
		
		mysqli_close($db);
	}
}


if(function_exists('saveCartExtraChargeData'))
{
	
}
else
{
	function saveCartExtraChargeData($count,$itemNum,$pID,$item,$price,$qty,$ref_num,$extra1="",$extra2="",$extra3=""){
	
		include find_file("cnct.php");
		
		$ins = "INSERT INTO extraTransData (id,count,itemNum,pID,item,price,qty,ref_num,extra1,extra2,extra3) VALUES ('','".$count."','".$itemNum."','".$pID."','".$item."','".$price."','".$qty."','".$ref_num."','".$extra1."','".$extra2."','".$extra3."');";
		$res = mysqli_query($db,$ins);
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}


if(function_exists('getExtraChargeData'))
{
	
}
else
{
	function getExtraChargeData($sql=""){
		
		if($sql=="")
		{
			$filter = "";
		}
		else
		{
			$filter = " ".$sql;
		}
	
		include find_file("cnct.php");
		
		$ins = "SELECT * FROM extraTransData ".$filter.";";
		//echo $ins."<br>";
		$res = mysqli_query($db,$ins);
		@$num = mysqli_num_rows($res);
		//echo "Num: ".$num."<br>";
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$count = $rw["count"];
			$itemNum = $rw["itemNum"];
			$pID = $rw["pID"];
			$item = $rw["item"];
			$price = $rw["price"];
			$qty = $rw["qty"];
			$ref_num = $rw["ref_num"];
			$extra1 = $rw["extra1"];
			$extra2 = $rw["extra2"];
			$extra3 = $rw["extra3"];
			
			$array[] = array('num'=>$num,'id'=>$id,'count'=>$count,'itemNum'=>$itemNum,'pID'=>$pID,'item'=>$item,'qty'=>$qty,'ref_num'=>$ref_num,'extra1'=>$extra1,'extra2'=>$extra2,'extra3'=>$extra3);
		}
		
		return $array;
		
		mysqli_close($db);
	}
}



if(function_exists('getSummaryTransData'))
{
	
}
else
{
	function getSummaryTransData($column,$function,$sql=""){
		
		if($sql=="")
		{
			$filter = "";
		}
		else
		{
			$filter = " ".$sql;
		}
	
		include find_file("cnct.php");
		
		$ins = "SELECT ".$function."(".$column.") AS MyData FROM transactions".$filter.";";
		$res = mysqli_query($db,$ins);
		@$num = mysqli_num_rows($res);
		if($num>=1)
		{
			if($num==1)
			{
				@$rw = mysqli_fetch_array($res);
				$array = array('num'=>$num,'data'=>$rw["MyData"]);
			}
			elseif($num>=2)
			{
				for($a=0; $a<$num; $a++)
				{
					@$rw = mysqli_fetch_array($res);
					$MyData = $rw["MyData"];
					
					$array[] = array('num'=>$num,'data'=>$MyData);
				}
			}
		}
		else
		{
			return 0;
		}
		
		return $array;
		
		mysqli_close($db);
	}
}


if(function_exists('saveCartData'))
{
	
}
else
{
	function saveCartData($CartID,$merchantID,$name,$currency,$price,$discount,$src,$pID,$pType,$qty,$duration,$unit,$unitID,$pickUpTown,$pickUpArea,$pickUpDateTime,$DropOffCountry,$DropOffDateTime,$DropOffTown,$DrivingTo,$distance,$WithChauffeur,$chauffeur_rate,$chauffeur,$mileage_rate,$mileage_charge,$oneway_rental_fee,$total,$NoOfAdults,$NoOfChildren,$extra_charges,$ref_num,$CustomerEmail,$CustomerPhone,$status){
	
		include find_file("cnct.php");
		
		$ins = "INSERT INTO cart (id,CartID,merchantID,name,currency,price,discount,src,pID,pType,qty,duration,unit,unitID,pickUpTown,pickUpArea,pickUpDateTime,DropOffCountry,DropOffDateTime,DropOffTown,DrivingTo,distance,WithChauffeur,chauffeur_rate,chauffeur,mileage_rate,mileage_charge,oneway_rental_fee,total,NoOfAdults,NoOfChildren,extra_charges,Ref,CustomerEmail,CustomerPhon,status) VALUES ('','".$CartID."','".$merchantID."','".$name."','".$currency."','".$price."','".$discount."','".$src."','".$pID."','".$pType."','".$qty."','".$duration."','".$unit."','".$unitID."','".$pickUpTown."','".$pickUpArea."','".$pickUpDateTime."','".$DropOffCountry."','".$DropOffDateTime."','".$DropOffTown."','".$DrivingTo."','".$distance."','".$WithChauffeur."','".$chauffeur_rate."','".$chauffeur."','".$mileage_rate."','".$mileage_charge."','".$oneway_rental_fee."','".$total."','".$NoOfAdults."','".$NoOfChildren."','".$extra_charges."','".$ref_num."','".$CustomerEmail."','".$CustomerPhone."','".$status."');";
		$res = mysqli_query($db,$ins);
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}


if(function_exists('deleteCartData'))
{
	
}
else
{
	function deleteCartData($CartID){
	
		include find_file("cnct.php");
		
		$ins = "DELETE FROM cart WHERE Ref = '".$CartID."';";
		$res = mysqli_query($db,$ins);
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}


if(function_exists('countCartData'))
{
	
}
else
{
	function countCartData($CartID){
	
		include find_file("cnct.php");
		
		$ins = "SELECT COUNT(id) AS numID FROM cart WHERE Ref = '".$CartID."';";
		$res = mysqli_query($db,$ins);
		if($res)
		{
			$rw = mysqli_fetch_array($res);
			return $rw["numID"];
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}


if(function_exists('getCartData'))
{
	
}
else
{
	function getCartData($sql=""){
		
		if($sql=="")
		{
			$filter = "";
		}
		else
		{
			$filter = " ".$sql;
		}
	
		include find_file("cnct.php");
		
		$ins = "SELECT * FROM cart".$filter.";";
		$res = mysqli_query($db,$ins);
		@$num = mysqli_num_rows($res);
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$CartID = $rw["CartID"];  
			$merchantID = $rw["merchantID"];  
			$name = $rw["name"];  
			$currency = $rw["currency"];  
			$price = $rw["price"];  
			$discount = $rw["discount"];  
			$src = $rw["src"];  
			$pID = $rw["pID"];  
			$pType = $rw["pType"];  
			$qty = $rw["qty"];  
			$duration = $rw["duration"];  
			$unit = $rw["unit"];  
			$unitID = $rw["unitID"];  
			$pickUpTown = $rw["pickUpTown"];  
			$pickUpArea = $rw["pickUpArea"];  
			$pickUpDateTime = $rw["pickUpDateTime"];  
			$DropOffCountry = $rw["DropOffCountry"]; 
			$DropOffDateTime = $rw["DropOffDateTime"];  
			$DropOffTown = $rw["DropOffTown"];  
			$DrivingTo = $rw["DrivingTo"];  
			$distance = $rw["distance"];  
			$WithChauffeur = $rw["WithChauffeur"];  
			$chauffeur_rate = $rw["chauffeur_rate"];  
			$chauffeur = $rw["chauffeur"];  
			$mileage_rate = $rw["mileage_rate"];  
			$mileage_charge = $rw["mileage_charge"];  
			$oneway_rental_fee = $rw["oneway_rental_fee"];  
			$total = $rw["total"];  
			$NoOfAdults = $rw["NoOfAdults"];  
			$NoOfChildren = $rw["NoOfChildren"];  
			$extra_charges = $rw["extra_charges"];  
			$ref_num = $rw["Ref"];  
			$CustomerEmail = $rw["CustomerEmail"];  
			$CustomerPhone = $rw["CustomerPhone"];
			
			//'CartID'=>$CartID,'merchantID'=>$merchantID,'name'=>$name,'currency'=>$currency,'price'=>$price,'discount'=>$discount,'src'=>$src,'pID'=>$pID,'pType'=>$pType,'qty'=>$qty,'duration'=>$duration,'unit'=>$unit,'unitID'=>$unitID,'pickUpTown'=>$pickUpTown,'pickUpArea'=>$pickUpArea,'pickUpDateTime'=>$pickUpDateTime,'DropOffCountry'=>$DropOffCountry,'DropOffDateTime'=>$DropOffDateTime,'DropOffTown'=>$DropOffTown,'DrivingTo'=>$DrivingTo,'distance'=>$distance,'WithChauffeur'=>$WithChauffeur,'chauffeur_rate'=>$chauffeur_rate,'chauffeur'=>$chauffeur,'mileage_rate'=>$mileage_rate,'mileage_charge'=>$mileage_charge,'oneway_rental_fee'=>$oneway_rental_fee,'total'=>$total,'NoOfAdults'=>$NoOfAdults,'NoOfChildren'=>$NoOfChildren,'extra_charges'=>$extra_charges,'ref_num'=>$ref_num,'CustomerEmail'=>$CustomerEmail,'CustomerPhone'=>$CustomerPhone
			
			$array[] = array('num'=>$num,'id'=>$id,'CartID'=>$CartID,'merchantID'=>$merchantID,'name'=>$name,'currency'=>$currency,'price'=>$price,'discount'=>$discount,'src'=>$src,'pID'=>$pID,'pType'=>$pType,'qty'=>$qty,'duration'=>$duration,'unit'=>$unit,'unitID'=>$unitID,'pickUpTown'=>$pickUpTown,'pickUpArea'=>$pickUpArea,'pickUpDateTime'=>$pickUpDateTime,'DropOffCountry'=>$DropOffCountry,'DropOffDateTime'=>$DropOffDateTime,'DropOffTown'=>$DropOffTown,'DrivingTo'=>$DrivingTo,'distance'=>$distance,'WithChauffeur'=>$WithChauffeur,'chauffeur_rate'=>$chauffeur_rate,'chauffeur'=>$chauffeur,'mileage_rate'=>$mileage_rate,'mileage_charge'=>$mileage_charge,'oneway_rental_fee'=>$oneway_rental_fee,'total'=>$total,'NoOfAdults'=>$NoOfAdults,'NoOfChildren'=>$NoOfChildren,'extra_charges'=>$extra_charges,'Ref'=>$ref_num,'CustomerEmail'=>$CustomerEmail,'CustomerPhone'=>$CustomerPhone);
		}
		
		return $array;
		
		mysqli_close($db);
	}
}



if(function_exists('cancelBooking'))
{
	
}
else
{
	function cancelBooking($Ref){
		
			//echo "countCartData: ".countCartData($Ref)."<br>";
		
		if(countCartData($Ref)>=1)
		{
			$value = getCartData(" WHERE Ref = '".$Ref."'");
			
			$st = explode("|",$value[0]["status"]);
			
			include find_file("cnct.php");
			
			$update = "UPDATE cart SET status = 'CANCELLED|PENDING REFUND|".$st[2]."' WHERE Ref = '".$Ref."';";
			
			//echo $update."<br>";
			
			$res = mysqli_query($db,$update);
			if($res)
			{
				$tran = getTransData(" WHERE Ref = '".$Ref."'");
				
				$message = "Hello ".$tran[0]["CustomerName"]."<br><br>";
				$message .= "You have successfully cancelled your booking. We were looking forward to serving you, however, we understand your reasons for cancellation and will ensure the refund due is made available in the shortest possible time. Feel free to respond to us over this at any time using the reference number:".$Ref." to follow up on your due refund.<br><br>";
				$message .= "We look forward to seeing your soon and so feel free to ";
				$message .= "<a href='http://citydriverentacar.com/?ref=longtermshortterm.html' target='_new'>click here</a> Or go to http://citydriverentacar.com/?ref=longtermshortterm.html to reserve another vehicle.<br><br>";
				$message .= "We look forward to meeting you soon. <br><br>";
				$message .= "Warm regards,<br><br>";
				$message .= "Greg Chama<br>";
				$message .= "CEO";
				
				$message2 = "Hello Admin<br><br>";
				$message2 .= "".$tran[0]["CustomerName"].", email address ".$value[0]["CustomerEmail"]." has successfully cancelled the booking reference number ".$Ref.".<br><br>";
				$message2 .= "<a href='http://citydriverentacar.com/?ref=cart/viewcart.php&cartRef=".$Ref."' target='_new'>Click here</a> Or go to http://citydriverentacar.com/?ref=cart/viewcart.php&cartRef=".$Ref." to view the booking details.<br><br>";
				$message2 .= "Please ensure the necessary arrangements are made such as refunds and others. <br><br>";
				$message2 .= "Warm regards,<br><br>";
				$message2 .= "Greg Chama<br>";
				$message2 .= "CEO";
				
				email("BOOKING CANCELLATION",$message,"reservations@citydriverentacar.com",$value[0]["CustomerEmail"]);
				email("BOOKING CANCELLATION",$message2,"info@citydriverentacar.com","reservations@citydriverentacar.com");
				
				return 1;
			}
			else
			{
				return 0;
			}
			
			mysqli_close($db);
		}
		else
		{
			return 0;
		}
	}
}



if(function_exists('transList'))
{
	
}
else
{
	function transList($userID,$TransType){
		include find_file("apps/cart/layouts/pages/transList.php");
	}
}
?>