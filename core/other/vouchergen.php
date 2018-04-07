<?php 

if(function_exists('rand_string'))
{
	
}
else
{
	function rand_string($length,$type="NUMERIC") {
		
		if($type=="NUMERIC")
		{
			$chars = "0123456789";
		}
		elseif($type=="ALPHA")
		{
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		}
		elseif($type=="ALPHA-NUMERIC")
		{
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		}

		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	} 
}
 

if(function_exists('randomize'))
{
	
}
else
{
	function randomize($charsx) {
		$count = count($charsx);
		$chars = array();
		$chary = array();
		for($az=0; $az<$count; $az++)
		{
			$rand = rand(0,($count-1));
			
			while(in_array($rand,$chars))
			{
				$rand = rand(0,($count-1));
			}
			
			$chars[$az] = $rand;
			$chary[$az] = $charsx[$chars[$az]];
		}

		return $chary;
	}
}
 

if(function_exists('randomize2'))
{
	
}
else
{
	function randomize2($min,$count) {

		$chars = array();
		for($az=0; $az<$count; $az++)
		{
			$rand = rand(0,($count-1));
			
			while(in_array($rand,$chars))
			{
				$rand = rand(0,($count-1));
			}
			
			$chars[$az] = $rand;
		}

		return $chars;
	}
}
 

if(function_exists('trimVoucher'))
{
	
}
else
{
	function trimVoucher($voucher){
		
		$vv = explode(" ",$voucher);
		$countV = count($vv);
		$voucherX = "";
		for($v=0; $v<$countV; $v++)
		{
		$voucherX .= $vv[$v];
		}
		
		
		$vv2 = explode("-",$voucherX);
		$countV2 = count($vv);
		$voucherX2 = "";
		for($v2=0; $v2<$countV2; $v2++)
		{
		$voucherX2 .= $vv2[$v2];
		}
		
		$voucherXl = strtoupper($voucherX2);
		
		return $voucherXl;
	}
}
 

if(function_exists('gen_Code'))
{
	
}
else
{
	function gen_Code($pre="",$post=""){
		
		$my_string = rand_string( 3 );
		$my_string2 = rand_string(3);
		$my_string3 = rand_string( 2 );
		$my_string4 = rand_string( 5 );

		$voucherNumberA = $pre.$my_string."".$my_string2.$post;
		$voucherNumberB = $pre.$my_string."".$my_string2.$post;
		$array = array('A'=>$voucherNumberA,'B'=>$voucherNumberB);
		
		return $array;
	}
}
 

if(function_exists('genVoucherCode'))
{
	
}
else
{
	function genVoucherCode($pre="",$post=""){
		
		$my_string = rand_string( 4 );
		$my_string2 = rand_string(4);
		$my_string3 = rand_string( 3 );
		$my_string4 = rand_string( 5 );

		$voucherNumberA = $pre.$my_string." ".$my_string2." ".$my_string3.$post;
		$voucherNumberB = $pre.$my_string."".$my_string2."".$my_string3.$post;
		$array = array('A'=>$voucherNumberA,'B'=>$voucherNumberB);
		
		return $array;
	}
///////////////////////////////////////////////////////////////////////////// 
}
 

if(function_exists('voucherUsed'))
{
	
}
else
{
	function voucherUsed($voucher){
			
		include find_file("cnct.php");
		
		$sel = "SELECT COUNT(id) as numVouchers FROM meta WHERE data = '".trimVoucher($voucher)."' AND meta_data = '".md5("USED VOUCHERS")."';";
		@$res = mysqli_query($db,$sel);
		$rw = mysqli_fetch_array(@$res);
		$numVouchers = $rw["numVouchers"];
		
		mysqli_close($db);
		
		return $numVouchers;
	}
}
 

if(function_exists('checkVoucherExist'))
{
	
}
else
{
	function checkVoucherExist($voucher){

	include find_file("cnct.php");
		
		$sel = "SELECT COUNT(id) as numVouchers FROM vouchercodes WHERE voucher = '".trimVoucher($voucher)."';";
		@$res = mysqli_query($db,$sel);
		$rw = mysqli_fetch_array(@$res);
		$numVouchers = $rw["numVouchers"];
		
		mysqli_close($db);
		
		return $numVouchers;
	}
}
 

if(function_exists('checkCodeExist'))
{
	
}
else
{
	function checkCodeExist($voucher,$userID="",$expiry="1"){
			
		$current = date("Y-m-j H:i:s",strtotime(date("Y-m-j H:i:s")));
		
		if($userID=="")
		{
			$sel = "SELECT COUNT(id) as numVouchers,expiryDate FROM coupons WHERE voucher = '".trimVoucher($voucher)."';";
		}
		else
		{
			if($expiry=="0")
			{
				$sel = "SELECT COUNT(id) as numVouchers,expiryDate FROM coupons WHERE voucher = '".trimVoucher($voucher)."' AND mobileNumber = '".standadizesMobile($userID)."';";
			}
			elseif($expiry=="1")
			{
				$sel = "SELECT COUNT(id) as numVouchers,expiryDate FROM coupons WHERE voucher = '".trimVoucher($voucher)."' AND mobileNumber = '".standadizesMobile($userID)."' AND expiryDate > '".$current."';";
			}
		}
			
		include find_file("cnct.php");
		
		//echo "<br>".$sel."<br>";
		
		@$res = mysqli_query($db,$sel);
		$rw = mysqli_fetch_array(@$res);
		$numVouchers = $rw["numVouchers"];
		$expiryDate = $rw["expiryDate"];
			
		$expirey = date("Y-m-j H:i:s",strtotime($expiryDate));
		
		if($numVouchers>=1)
		{
			$state = 1;
		}
		else
		{			
			if($expirey>=$current)
			{
				$state = 0.5;
			}
			else
			{
				$state = 0;
			}
		}
		
		mysqli_close($db);
		
		return $state;
	}
}
 

if(function_exists('checkCouponExist'))
{
	
}
else
{
	function checkCouponExist($voucher,$userIDx="",$timeLimit="1"){
		
	$userID = standadizesMobile($userIDx);


	$limitT = strtotime(date("Y-m-j H:m:i"));


	  if($userID=="")
	  {
		if($timeLimit=="0")
		{
		  $sel = "SELECT COUNT(DISTINCT voucher) as numVouchers FROM coupons WHERE voucher = '".trimVoucher($voucher)."';";
		}
		else
		{
		  $sel = "SELECT COUNT(DISTINCT voucher) as numVouchers FROM coupons WHERE voucher = '".trimVoucher($voucher)."' AND expiryDate > '".$limitT."';";
		}
	  }
	  else
	  {
		if($timeLimit=="0")
		{
		  $sel = "SELECT COUNT(DISTINCT voucher) as numVouchers FROM coupons WHERE voucher = '".trimVoucher($voucher)."' AND mobileNumber = '".$userID."';";
		}
		else
		{
		  $sel = "SELECT COUNT(DISTINCT voucher) as numVouchers FROM coupons WHERE voucher = '".trimVoucher($voucher)."' AND mobileNumber = '".$userID."' AND expiryDate > '".$limitT."';";
		}
	  }
		
		include find_file("cnct.php");
	  
	  @$res = mysqli_query($db,$sel);
	  $rw = mysqli_fetch_array(@$res);
	  $numVouchers = $rw["numVouchers"];
		
		mysqli_close($db);
	  
	  return $numVouchers;
	}
}
 

if(function_exists('generateConfirmationCode'))
{
	
}
else
{
	function generateConfirmationCode($agent,$senderx,$altReceiverx="",$codeTpe="",$validitytime=""){
		
	$sender = standadizesMobile($senderx);
	$altReceiver = standadizesMobile($altReceiverx);
	  
		$code = rand_string(5);

		if($validitytime=="")
		{
		  $validityDuration = 6;
		}
		else
		{
		  $validityDuration = $validitytime;
		}


		while(checkCouponExist($code,$sender,$validityDuration)>=1)
		{
		$code = rand_string(5);
		}


		$expirey = strtotime("+ ".$validityDuration." minute",strtotime(date("Y-m-j H:i:s")));
		$expirey = date("Y-m-j H:i:s",$expirey);



		include find_file("cnct.php");
				
		$ins2 = "INSERT INTO meta (id,userid,data,meta_data,r_user) VALUES ('','".$agent."','".trimVoucher($code)."','".md5("CONFIRMATION CODE")."','".$sender."');";
		@$res2 = mysqli_query($db,$ins2);



		if(@$res2)
		{
		$ins = "INSERT INTO coupons (id,voucher,mobileNumber,tokens,expiryDate) VALUES ('','".$code."','".$sender."','0','".$expirey."');";
		@$res = mysqli_query($db,$ins);

		//echo $ins."<br>";

		if(@$res)
		{
			if($codeTpe=="")
			{
				$msgData = "Your UAgro confirmation code is";
			}
			else
			{
				$msgData = $codeTpe;
			}
			
			$message = $msgData." ".$code.".";
			
			//return $code;
			
			if($altReceiver=="")
			{
				$senderz = $sender;
			}
			else
			{
				$senderz = $altReceiver;
			}
			  
			if(sendSMS($senderz,$message))
			{
			return 1;
			}
			else
			{
			return 0;
			}	 
		}
		else
		{
		  return 0;
		}
		}
		else
		{
		return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('searchForVoucherNCoupon'))
{
	
}
else
{
	function searchForVoucherNCoupon($voucher){
		
	include find_file("cnct.php");
	 
		$sel = "SELECT * FROM vouchercodes WHERE voucher like '%".trimVoucher($voucher)."%';";			
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		
		if($num<="0")
		{
			$array[] = array('num'=>0,'id'=>"",'voucher'=>$voucher,'userID'=>"",'tokens'=>"",'expiryDate'=>"",'dateset'=>"",'state'=>"",'type'=>"BOOST");
		}
		else
		{
			
		$type = "BOOST";
		
			for($a=0; $a<$num; $a++)
			{
			$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$voucherx = $rw["voucher"];
			$userID = $rw["mobileNumber"];
			$tokens = $rw["tokens"];
			$expiryDate = $rw["expiryDate"];
			$dateset = $rw["dateset"];
			
			
			$expirey = date("Y-m-j",strtotime($expiryDate));
				
			$current = date("Y-m-j",strtotime(date("Y-m-j")));
			
				
				if($expirey<=$current)
				{
					$state = "EXPIRED";
				}
				else
				{
					if(voucherUsed($voucherx)>=1)
					{
						$state = "USED";
					}
					else
					{			
						if(checkVoucherExist($voucherx)>=1)
						{
							$state = "ACTIVE";
						}
						else
						{
							$state = "ERROR";
						}
					}
				}
			
			$array[] = array('num'=>$num,'id'=>$id,'voucher'=>$voucherx,'userID'=>$userID,'tokens'=>$tokens,'expiryDate'=>$expiryDate,'dateset'=>$dateset,'state'=>$state,'type'=>$type);
			}

		}
		
	mysqli_close($db);

		
	include find_file("cnct.php");
		
		$sel2 = "SELECT * FROM coupons WHERE voucher like '%".trimVoucher($voucher)."%';";
		@$res2 = mysqli_query($db,$sel2);
		@$num2 = mysqli_num_rows(@$res2);
		
		if($num2<="0")
		{
			$array[] = array('num'=>0,'id'=>"",'voucher'=>$voucher,'userID'=>"",'tokens'=>"",'expiryDate'=>"",'dateset'=>"",'state'=>"",'type'=>"FREE BOOST");
		}
		else
		{
		$type2 = "FREE BOOST";	
			
			for($b=0; $b<$num2; $b++)
			{
			$rw2 = mysqli_fetch_array(@$res2);
			$id2 = $rw2["id"];
			$voucherx2 = $rw2["voucher"];
			$userID2 = $rw2["mobileNumber"];
			$tokens2 = $rw2["tokens"];
			$expiryDate2 = $rw2["expiryDate"];
			$dateset2 = $rw2["dateset"];
			
			
			$expirey2 = date("Y-m-j",strtotime($expiryDate2));
				
			$current2 = date("Y-m-j",strtotime(date("Y-m-j")));
			
				
				if($expirey2<=$current2)
				{
					$state2 = "EXPIRED";
				}
				else
				{
					if(voucherUsed($voucherx2)>=1)
					{
						$state2 = "USED";
					}
					else
					{				
						if(checkCouponExist($voucherx2)>=1)
						{
							$state2 = "ACTIVE";
						}
						else
						{
							$state2 = "ERROR";
						}
					}
				}
			
			$array[] = array('num'=>$num2,'id'=>$id2,'voucher'=>$voucherx2,'userID'=>$userID2,'tokens'=>$tokens2,'expiryDate'=>$expiryDate2,'dateset'=>$dateset2,'state'=>$state2,'type'=>$type2);
			}

		}
		
		mysqli_close($db);
		
		return $array;
	}
}
 

if(function_exists('tokenPrice'))
{
	
}
else
{
	function tokenPrice($tokens,$price){
		
	include find_file("cnct.php");
	 
		$ins = "INSERT INTO _token_price (id,tokens,price) VALUES ('','".$tokens."','".$price."');";
		@$res = mysqli_query($db,$ins);
		if(@$res)
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
 

if(function_exists('codeGen'))
{
	
}
else
{	
	function codeGen($validity,$userID){
		
		$current = date("Y-m-j H:i:s",strtotime(date("Y-m-j H:i:s")));
		
		$expirey = strtotime("+ ".$validity." minute",strtotime(date("Y-m-j H:i:s")));
		$expirey = date("Y-m-j H:i:s",$expirey);
		
		
		$voucherX = gen_Code();
		
		while(checkCodeExist($voucherX['A'],standadizesMobile($userID),1)>=1)
		{
		$voucherX = gen_Code();
		}
			
		include find_file("cnct.php");

		$insTr = "INSERT INTO coupons (id,voucher,mobileNumber,tokens,expiryDate) VALUES ('','".$voucherX['B']."','".standadizesMobile($userID)."','".$tokens."','".$expirey."');";
		@$resTr = mysqli_query($db,$insTr);
		
		
		
		if(@$resTr)
		{
		$StatusMessage = $voucherX['A'];
		}
		else
		{
		$StatusMessage = "";
		}
		
		mysqli_close($db);
		
		return $StatusMessage;
	}
}
 

if(function_exists('voucherGen'))
{
	
}
else
{	
	function voucherGen($price,$validityDuration,$userIDx,$vType=""){
		
		include find_file("cnct.php");
			
		$userID = standadizesMobile($userIDx);
		 
		$selPrice = "SELECT * FROM _token_price WHERE id = (SELECT max(id) AS maxID FROM _token_price);";
		//echo $selPrice;
		@@$resPrice = mysqli_query($db,$selPrice);
		@$rowPrice = mysqli_fetch_array(@@$resPrice);
		$tokenQ = $rowPrice["tokens"];
		$priceQ = $rowPrice["price"];
		
		$tokenRate = $tokenQ/$priceQ;

		$tokens =  $price*$tokenRate; //ME-UP.com
		
		mysqli_close($db);
		
		
		$expirey = strtotime("+ ".$validityDuration." day",strtotime(date("Y-m-j")));
		$expirey = date("Y-m-j",$expirey);
		
		
			$voucherX = genVoucherCode();
			
			while((checkCouponExist($voucherX['A'])>=1) || (checkVoucherExist($voucherX['A'])>=1))
			{
			$voucherX = genVoucherCode();
			}

			
		if($vType=="COUPON")
		{
			$insTr = "INSERT INTO coupons (id,voucher,mobileNumber,tokens,expiryDate) VALUES ('','".$voucherX['B']."','".$userID."','".$tokens."','".$expirey."');";
		}
		else
		{
			$insTr = "INSERT INTO vouchercodes (id,voucher,mobileNumber,tokens,expiryDate) VALUES ('','".$voucherX['B']."','".$userID."','".$tokens."','".$expirey."');";
		}
		
		include find_file("cnct.php");
		
		
		@$resTr = mysqli_query($db,$insTr);
		
			if(@$resTr)
			{
			$StatusMessage = $voucherX['A'];
			}
			else
			{
			$StatusMessage = "";
			}
		
		mysqli_close($db);
		
		return $StatusMessage;
	}
}
 

if(function_exists('createVoucher'))
{
	
}
else
{
	function createVoucher($count="1",$price,$validityDuration,$userIDx){
		
	$userID = standadizesMobile($userIDx);

		$html .= "";
		for($a=0; $a<$count; $a++)
		{
			$voucher = voucherGen($price,$validityDuration,$userID);
			
			$html .= "<div style='width:200px; float: left; padding: 5px; margin: 10px; background-color:#ddd;'>";
				$html .= "<div style='width:96%; float: left; padding: 1%; background-color:#fff; color: #000;'>";
					$html .= "<b>".$voucher."</b><br>";
					$html .= "<b>K ".$price."</b><br>";
					$html .= "<b>Valid From:".date("d-m-Y")."</b><br>";
					$html .= "<b>Valid for ".$validityDuration." days.</b><br>";
				$html .= "</div>";
			$html .= "</div>";
		}
		
		return $html;
	}
}
 

if(function_exists('createCoupons'))
{
	
}
else
{
	function createCoupons($count="1",$price,$validityDuration,$userIDx){
		
	$userID = standadizesMobile($userIDx);

		$html .= "";
		for($a=0; $a<$count; $a++)
		{
			$voucher = voucherGen($price,$validityDuration,$userID,"COUPON");
			
			$html .= "<div style='width:200px; float: left; padding: 5px; margin: 10px; background-color:#ddd;'>";
				$html .= "<div style='width:96%; float: left; padding: 1%; background-color:#fff; color: #000;'>";
					$html .= "<b>".$voucher."</b><br>";
					$html .= "<b>K ".$price."</b><br>";
					$html .= "<b>Valid From:".date("d-m-Y")."</b><br>";
					$html .= "<b>Valid for ".$validityDuration." days.</b><br>";
				$html .= "</div>";
			$html .= "</div>";
		}
		
		return $html;
	}
}
 

if(function_exists('creditUserMainAccount'))
{
	
}
else
{
	function creditUserMainAccount($voucher,$userIDx){

	include find_file("cnct.php");
		
	$userID = standadizesMobile($userIDx);
		
		$sel = "SELECT * FROM vouchercodes WHERE voucher = '".trimVoucher($voucher)."';";
		@$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array(@$res);
		$tokens = $rw["tokens"];
		$expiryDate = $rw["expiryDate"];
		
		
		mysqli_close($db);	
		
		$expirey = date("Y-m-j",strtotime($expiryDate));
			
		$current = date("Y-m-j",strtotime(date("Y-m-j")));
			
		$expiryDatex = strtotime("+ 90 day",strtotime(date("Y-m-j")));
		$expiryDatex = date("Y-m-j",$expiryDatex);
			
		if(voucherUsed(trimVoucher($voucher))>=1)
		{	
			return "Sorry. This voucher has already been used.";
		}
		else
		{		
			if($expirey>=$current)
			{
				include find_file("cnct.php");
				
				$ins = "INSERT INTO tokens (id,tokens,uid,expiryDate) VALUES ('','".$tokens."','".$userID."','".$expiryDatex."');";
				@$resin = mysqli_query($db,$ins);
				
				$ins2 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($userID)."','".trimVoucher($voucher)."','".md5("USED VOUCHERS")."');";
				@$res2 = mysqli_query($db,$ins2);
				
				if(@$resin)
				{
					return 1;
				}
				else
				{
					return "Sorry. An error occurred in the process. Please try again later.";;
				}
		
				mysqli_close($db);
			}
			else
			{
				return "Sorry. Your voucher code is expired. Please get a new voucher to successfully topup.";
			}
		}
	}
}
 

if(function_exists('creditUserFreeBonus'))
{
	
}
else
{
	function creditUserFreeBonus($voucher,$userIDx){
		
	include find_file("cnct.php");
			
		$userID = standadizesMobile($userIDx);
	 
		$sel = "SELECT * FROM coupons WHERE voucher = '".trimVoucher($voucher)."';";
		@$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array(@$res);
		$tokens = $rw["tokens"];
		$expiryDate = $rw["expiryDate"];
		
	mysqli_close($db);
			
		
		$expirey = date("Y-m-j",strtotime($expiryDate));
			
		$current = date("Y-m-j",strtotime(date("Y-m-j")));
			
		$expiryDatex = strtotime("+ 90 day",strtotime(date("Y-m-j")));
		$expiryDatex = date("Y-m-j",$expiryDatex);
			
		if(voucherUsed(trimVoucher($voucher))>=1)
		{	
			return "Sorry. This voucher has already been used.";
		}
		else
		{		
			if($expirey>=$current)
			{
				include find_file("cnct.php");
				
				$ins = "INSERT INTO tokens (id,freetokens,uid,expiryDate) VALUES ('','".$tokens."','".$userID."','".$expiryDatex."');";
				@$resin = mysqli_query($db,$ins);
				
				$ins2 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($userID)."','".trimVoucher($voucher)."','".md5("USED VOUCHERS")."');";
				@$res2 = mysqli_query($db,$ins2);
				
				
				if(@$resin)
				{
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
				return "Sorry. Your voucher code is expired. Please get a new voucher to successfully topup.";
			}
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('topup'))
{
	
}
else
{
	function topup($voucher,$userIDx){
		
	$statusMessage = "";
		
	$userID = standadizesMobile($userIDx);

		$oneDay = 1;
		$today = strtotime(date("Y-m-j"));
		$today = date("Y-m-j",$today);
		
		if(checkVoucherExist(trimVoucher($voucher))<="0")
		{
			if(checkCouponExist(trimVoucher($voucher))>="1")
			{
				
				//if(chkSes()=="Active")
				//{
					return creditUserFreeBonus(trimVoucher($voucher),$userID);
				//}
				//else
				//{
					//return "You must be logged in to topup your account.";
				//}
			}
			else
			{
				return "Sorry. A problem was found with your RECHARGE CODE. Please use another one, or enter the details correctly.";
			}
		}
		else
		{
			//if(chkSes()=="Active")
			//{
				return creditUserMainAccount($voucher,$userID);
			//}
			//else
			//{
				//return "You must be logged in to topup your account.";
			//}
		}
		
	}
}
 

if(function_exists('voucherList'))
{
	
}
else
{
	function voucherList($type="",$data=""){
		
	include find_file("cnct.php");
	 
		if($type=="")
		{
			$sel = "SELECT * FROM vouchercodes ".$data.";";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$voucher = $rw["voucher"];
				$tokens = $rw["tokens"];
				$userID = $rw["mobileNumber"];
				$expiryDate = $rw["expiryDate"];
				$dateset = $rw["dateset"];
				
				$array[] = array('num'=>$num,'id'=>$id,'voucher'=>$voucher,'tokens'=>$tokens,'userID'=>$userID,'expiryDate'=>$expiryDate,'dateset'=>$dateset);
			}
			
			return $array;
		}
		elseif($type=="USED")
		{
			$sel = "SELECT * FROM vouchercodes WHERE voucher IN (SELECT data FROM meta WHERE meta_data = '".md5("USED VOUCHERS")."') ".$data.";";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$voucher = $rw["voucher"];
				$tokens = $rw["tokens"];
				$userID = $rw["mobileNumber"];
				$expiryDate = $rw["expiryDate"];
				$dateset = $rw["dateset"];
				
				$array[] = array('num'=>$num,'id'=>$id,'voucher'=>$voucher,'tokens'=>$tokens,'userID'=>$userID,'expiryDate'=>$expiryDate,'dateset'=>$dateset);
			}
			
			return $array;
		}
		elseif($type=="VALID")
		{
			$sel = "SELECT * FROM vouchercodes WHERE voucher NOT IN (SELECT data FROM meta WHERE meta_data = '".md5("USED VOUCHERS")."') ".$data.";";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$voucher = $rw["voucher"];
				$tokens = $rw["tokens"];
				$userID = $rw["mobileNumber"];
				$expiryDate = $rw["expiryDate"];
				$dateset = $rw["dateset"];
				
				$array[] = array('num'=>$num,'id'=>$id,'voucher'=>$voucher,'tokens'=>$tokens,'userID'=>$userID,'expiryDate'=>$expiryDate,'dateset'=>$dateset);
			}
			
			return $array;
		}
		elseif($type=="EXPIRED")
		{
			$today = strtotime(date("Y-m-j"));
			$today = date("Y-m-j",$today);
		
			$sel = "SELECT * FROM vouchercodes WHERE expiryDate < '".$today."' ".$data.";";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$voucher = $rw["voucher"];
				$tokens = $rw["tokens"];
				$userID = $rw["mobileNumber"];
				$expiryDate = $rw["expiryDate"];
				$dateset = $rw["dateset"];
				
				$array[] = array('num'=>$num,'id'=>$id,'voucher'=>$voucher,'tokens'=>$tokens,'userID'=>$userID,'expiryDate'=>$expiryDate,'dateset'=>$dateset);
			}
			
			return $array;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('couponList'))
{
	
}
else
{
	function couponList($type="",$data=""){
		
	include find_file("cnct.php");
	 
		if($type=="")
		{
			$sel = "SELECT * FROM coupons ".$data.";";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$voucher = $rw["voucher"];
				$tokens = $rw["tokens"];
				$userID = $rw["mobileNumber"];
				$expiryDate = $rw["expiryDate"];
				$dateset = $rw["dateset"];
				
				$array[] = array('num'=>$num,'id'=>$id,'voucher'=>$voucher,'tokens'=>$tokens,'userID'=>$userID,'expiryDate'=>$expiryDate,'dateset'=>$dateset);
			}
			
			return $array;
		}
		elseif($type=="USED")
		{
			$sel = "SELECT * FROM coupons WHERE voucher IN (SELECT data FROM meta WHERE meta_data = '".md5("USED VOUCHERS")."') ".$data.";";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$voucher = $rw["voucher"];
				$tokens = $rw["tokens"];
				$userID = $rw["mobileNumber"];
				$expiryDate = $rw["expiryDate"];
				$dateset = $rw["dateset"];
				
				$array[] = array('num'=>$num,'id'=>$id,'voucher'=>$voucher,'tokens'=>$tokens,'userID'=>$userID,'expiryDate'=>$expiryDate,'dateset'=>$dateset);
			}
			
			return $array;
		}
		elseif($type=="VALID")
		{
			$sel = "SELECT * FROM coupons WHERE voucher NOT IN (SELECT data FROM meta WHERE meta_data = '".md5("USED VOUCHERS")."') ".$data.";";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$voucher = $rw["voucher"];
				$tokens = $rw["tokens"];
				$userID = $rw["mobileNumber"];
				$expiryDate = $rw["expiryDate"];
				$dateset = $rw["dateset"];
				
				$array[] = array('num'=>$num,'id'=>$id,'voucher'=>$voucher,'tokens'=>$tokens,'userID'=>$userID,'expiryDate'=>$expiryDate,'dateset'=>$dateset);
			}
			
			return $array;
		}
		elseif($type=="EXPIRED")
		{
			$today = strtotime(date("Y-m-j"));
			$today = date("Y-m-j",$today);
		
			$sel = "SELECT * FROM coupons WHERE expiryDate < '".$today."' ".$data.";";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$voucher = $rw["voucher"];
				$tokens = $rw["tokens"];
				$userID = $rw["mobileNumber"];
				$expiryDate = $rw["expiryDate"];
				$dateset = $rw["dateset"];
				
				$array[] = array('num'=>$num,'id'=>$id,'voucher'=>$voucher,'tokens'=>$tokens,'userID'=>$userID,'expiryDate'=>$expiryDate,'dateset'=>$dateset);
			}
			
			return $array;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('registration'))
{
	
}
else
{
	function registration($receiver){
		
		$validity = 10;
		
		$message = "Your confirmation code is ".codeGen($validity,standadizesMobile($receiver)).".";
		
		return sendSMS($receiver,$message);
	}
}
?>