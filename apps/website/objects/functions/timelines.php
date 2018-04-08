<?php 

function addProductStage($pID,$fID,$batchID,$stateOfProduct){
	
	include find_file('cnct_uagro.php');
	
	$result2 =  mysql_query("INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($pID."|".$fID."|".$batchID)."','".$stateOfProduct."','".md5("FARM_PRODUCT_STAGE")."');");
	
	if($result2)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db);
}


function orderDetails($type,$orderID,$class){
	
include find_file('cnct_uagro.php');

 	if($type=='FARMER')
	{
		$sel = "SELECT * FROM farmerinputorder WHERE orderID = '".$orderID."';"; 
		//echo $sel;
		@$result = mysql_query($sel);
		@$rw = mysql_fetch_array($result);
		$orderedBy = $rw["farmerID"];
		$orderedFrom = $rw["stockistID"];
		$transporterID = $rw["transporterID"];
		$transporterPrice = $rw["transporterPrice"];
		$NegotiatedPrice = $rw["farmerNegotiatedPrice"];
		$transApprovalStatus = $rw["transApprovalStatus"];
		$status = $rw["status"];
		$orderData = $rw["orderData"];
		$total = $rw["total"];
		$orderDate = $rw["orderDate"];
		$batchID = $rw["batchID"];
	}
	elseif($type=='STOCKIST')
	{
		$sel = "SELECT * FROM stockistinputorder WHERE orderID = '".$orderID."';";
		@$result = mysql_query($sel);
		@$rw = mysql_fetch_array($result);
		$orderedBy = $rw["stockistID"];
		$orderedFrom = $rw["supplierID"];
		$transporterID = $rw["transporterID"];
		$transporterPrice = $rw["transporterPrice"];
		$NegotiatedPrice = $rw["stockistNegotiatedPrice"];
		$transApprovalStatus = $rw["transApprovalStatus"];
		$status = $rw["status"];
		$orderData = $rw["orderData"];
		$total = $rw["total"];
		$orderDate = $rw["orderDate"];
		$batchID = "";
	}
	elseif($type=='CUSTOMER')
	{
		$sel = "SELECT * FROM customerproductorder WHERE orderID = '".$orderID."';";
		@$result = mysql_query($sel);
		@$rw = mysql_fetch_array($result);
		$orderedBy = $rw["customerID"];
		$orderedFrom = $rw["farmerID"];
		$transporterID = $rw["transporterID"];
		$transporterPrice = $rw["transporterPrice"];
		$NegotiatedPrice = $rw["customerNegotiatedPrice"];
		$transApprovalStatus = $rw["transApprovalStatus"];
		$status = $rw["status"];
		$orderData = $rw["orderData"];
		$total = $rw["total"];
		$orderDate = $rw["orderDate"];
		$batchID = "";
	}
	
	
	if($class=="ORDERED BY")
	{
		return $orderedBy;
	}
	elseif($class=="ORDERED FROM")
	{
		return $orderedFrom;
	}
	elseif($class=="TRANSPORTER")
	{
		return $transporterID;
	}
	elseif($class=="TRANSPORTER PRICE")
	{
		return $transporterPrice;
	}
	elseif($class=="NEGOTIATED PRICE")
	{
		return $NegotiatedPrice;
	}
	elseif($class=="TRANSPORTER APPROVAL STATUS")
	{
		return $transApprovalStatus;
	}
	elseif($class=="ORDER STATUS")
	{
		return $status;
	}
	elseif($class=="ORDER DATA")
	{
		return $orderData;
	}
	elseif($class=="ORDER TOTAL")
	{
		return $total;
	}
	elseif($class=="ORDER DATE")
	{
		return $orderDate;
	}
	elseif($class=="BATCH")
	{
		return $batchID;
	}
	
	mysql_close($db);
}



function productStage($pID,$fID,$batchID,$type=""){
	
	include find_file('cnct_uagro.php');
	
	$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) as maxID FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_STAGE")."' AND userid = '".md5($pID."|".$fID."|".$batchID)."');"; //md5($productID."|".$farmerID)
	//echo $sel;
	$res = mysql_query($sel);
	@$rw = mysql_fetch_array($res);
	$id = $rw["id"];
	$userid = $rw["userid"];
	$data = $rw["data"];
	$dateset = $rw["dateset"];
			
			
	if($type=="" || $type=="GET STAGE")
	{
		return $data;
	}
	elseif($type=="DATESET")
	{
		return $dateset;
	}
	elseif($type=="ID")
	{
		return $id;
	}
	
	mysql_close($db);
}


function addProductPrice($productID,$farmerID,$batchID,$productPrice){
	
	include find_file('cnct_uagro.php');
	
	$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($productID."|".$farmerID."|".$batchID)."','".$productPrice."','".md5("FARM_PRODUCT_PRICE")."');";
	//echo $ins;
	$result2 =  mysql_query($ins);
	
	if($result2)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db);
}




function getProductPrice($farmerID,$productID,$batchID){
	
	include find_file('cnct_uagro.php');
	
	$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_PRICE")."' AND userid = '".md5($productID."|".$farmerID."|".$batchID)."');";
	//echo $sel."<br>";
	@$res = mysql_query($sel);
	@$num = mysql_num_rows($res);
	if($num>=1)
	{
		@$rw = mysql_fetch_array($res);
		return $rw["data"];
	}
	else
	{
		return 2;
	}
	
	mysql_close($db);
}


function productSales($farmerID,$productID="",$batchID=""){
	
	$amount=0;
	
	if($batchID=="")
	{
		$dates = "";
	}
	else
	{
		$batchdate = productStage($productID,$farmerID,$batchID,"DATESET");
		
		$dates = " AND orderDate >= '".$batchdate."'";
	}
	
	include find_file('cnct_uagro.php');
	
	if($productID=="")
	{
		$sel = "SELECT sum(total) AS sumTotals FROM customerproductorder WHERE farmerID = '".$farmerID."' AND status = 'paid for';";
		@$res = mysql_query($sel);
		@$rw = mysql_fetch_array($res);
		$amount = $rw["sumTotals"];
		
	
	//echo "testing: ".$sel."<br>";
	}
	else
	{
		$sel = "SELECT * FROM customerproductorder WHERE farmerID = '".$farmerID."' ".$dates." AND status = 'paid for';";
		@$res = mysql_query($sel);
		@$num = mysql_num_rows($res);
		for($i=0; $i<$num; $i++)
		{
			@$rw = mysql_fetch_array($res);
			$order = $rw["orderData"];
			$transporterPrice = $rw["transporterPrice"];
			$customerNegotiatedPrice = $rw["customerNegotiatedPrice"];
			$transApprovalStatus = $rw["transApprovalStatus"];
			
			if($transApprovalStatus=="")
			{
				if($customerNegotiatedPrice=="none" || $customerNegotiatedPrice=="" || !(isset($customerNegotiatedPrice)))
				{
					$trans = $transporterPrice;
				}
				else
				{
					$trans = $customerNegotiatedPrice;
				}
			}
			else
			{
				$trans = 0;
			}
			
			$dt = explode(",",$order);
			
			$amount = $amount+$trans;
			
			$a=0;
			$c=0;
			for($b=0; $b<count($dt); $b++)
			{
				$a=$a+1;
				
				if($a==6)
				{
					$c = $c+1;
				}
				else
				{
					$c = $c;
				}
				
				$product = $dt[((($c-1)*6)+2)];
				$productPrice = $dt[((($c-1)*6)+5)];
				
				if($a==6)
				{
				
					//echo "product: ".$product."<br>";
					//echo "productPrice: ".$productPrice."<br><br>";
					
					if($product==$productID)
					{
						$amount = $amount+$productPrice;
					}	
				
					$a=0;
				}
				else
				{
					$a=$a;
				}			
			}
		}
	}
	
	mysql_close($db);
	
	return $amount;
}


function productSalesQty($farmerID,$productID="",$batchID=""){
	
	$amount=0;
	
	if($batchID=="")
	{
		$dates = "";
	}
	else
	{
		$batchdate = productStage($productID,$farmerID,$batchID,"DATESET");
		$dates = " AND orderDate >= '".strtotime($batchdate)."'";
	}
	
	
	include find_file('cnct_uagro.php');

		$sel = "SELECT * FROM customerproductorder WHERE farmerID = '".$farmerID."' ".$dates." AND status = 'paid for';";
		@$res = mysql_query($sel);
		@$num = mysql_num_rows($res);
		for($i=0; $i<$num; $i++)
		{
			@$rw = mysql_fetch_array($res);
			$order = $rw["orderData"];
			$transporterPrice = $rw["transporterPrice"];
			$customerNegotiatedPrice = $rw["customerNegotiatedPrice"];
			$transApprovalStatus = $rw["transApprovalStatus"];
			
			if($transApprovalStatus=="")
			{
				if($customerNegotiatedPrice=="none" || $customerNegotiatedPrice=="" || !(isset($customerNegotiatedPrice)))
				{
					$trans = $transporterPrice;
				}
				else
				{
					$trans = $customerNegotiatedPrice;
				}
			}
			else
			{
				$trans = 0;
			}
			
			$dt = explode(",",$order);
			
			$amount = $amount+$trans;
			
			$a=0;
			$c=0;
			for($b=0; $b<count($dt); $b++)
			{
				$a=$a+1;
				
				if($a==6)
				{
					$c = $c+1;
				}
				else
				{
					$c = $c;
				}
				
				$product = $dt[((($c-1)*6)+2)];
				$productPrice = $dt[((($c-1)*6)+4)];
				
				if($a==6)
				{
				
					//echo "product: ".$product."<br>";
					//echo "productPrice: ".$productPrice."<br><br>";
					
					if($productID=="")
					{
						$amount = $amount+$productPrice;
					}
					else
					{
						if($product==$productID)
						{
							$amount = $amount+$productPrice;
						}	
					}
				
					$a=0;
				}
				else
				{
					$a=$a;
				}			
			}
		}
	
	mysql_close($db);
	
	
	return $amount;
}


function productPurchases($farmerID,$productID="",$batchID=""){
	
	include find_file('cnct_uagro.php');
	
	$amount = 0;

	if($productID=="")
	{

		$sl = "SELECT sum(total) as sumTotals FROM farmerinputorder WHERE farmerID = '".$farmerID."' AND status = 'paid for';";
		$rs = mysql_query($sl);
		@$rw = mysql_fetch_array($rs);
		$amount = $amount+$rw["sumTotals"];
	}
	else
	{
		$sl = "SELECT * FROM farmerinputorder WHERE farmerID = '".$farmerID."' AND productID = '".$productID."' AND status = 'paid for';";
				//echo "test: ".$sl."<br>";
		$rs = mysql_query($sl);
		@$nm = mysql_num_rows($rs);
		for($c=0; $c<$nm; $c++)
		{
			@$rw = mysql_fetch_array($rs);
			$orderData = $rw["orderData"];
			$dt2 = explode(",",$orderData);
			
			$a1=0;
			$c1=0;
			for($d=0; $d<count($dt2); $d++)
			{
				$a1=$a1+1;
				
				if($a1==5)
				{
					$c1 = $c1+1;
				}
				else
				{
					$c1 = $c1;
				}
				
				if($a1==5)
				{
				
				$input = $dt2[((($c1-1)*5)+1)];
				$inputPrice = $dt2[((($c1-1)*5)+4)];
				
				//echo "test ".$c.": ".$inputPrice."<br>";
				
				$amount = $amount+$inputPrice;
				$a1=0;
				}
				else
				{
					$a1=$a1;
				}
			}
		}

	}
	
	mysql_close($db);
	
	return $amount;
}



function productListing($farmerID,$productID="",$type=""){

	include find_file('cnct_uagro.php');
	
	if($productID=="")
	{
		$sel = "SELECT DISTINCT f.prodID AS productID,pName,packaging,description FROM farming f, product p WHERE f.prodID=p.pID AND farmerID='$farmerID';";
	}
	else
	{
		$sel = "SELECT DISTINCT f.prodID AS productID,pName,packaging,description FROM farming f, product p WHERE f.prodID=p.pID AND farmerID='$farmerID' AND prodID='$productID';";
	}
	
    //echo $sel;
	
	$result = mysql_query($sel);
	@$num = mysql_num_rows($result);
 
	// check for empty result
	if ($num > 0) 
	{
	   // user node
	   
		while($row = mysql_fetch_array($result))
		{
		//push all the products in the array
			if($type=="")
			{
				$prod[] = array('num'=>$num,'productID'=>$row["productID"],'pName'=>$row["pName"],'price'=>getCurrentProductPrice($farmerID,$row["productID"]),'description'=>$row["description"],'packaging'=>$row["packaging"]);
			}
			else
			{
				if($type=="PRICED PRODUCTS")
				{
					$timelines2 = timeline($farmerID,$row["productID"],"GET ALL");
					@$num2 = count($timelines2);
				
					//var_dump($timelines2);
				
					for($a2=0; $a2<$num2; $a2++)
					{
						//$batchID2x = $timelines2['id'];
						$batchID2 = $timelines2[$a2]['id'];
						
						//echo "test: ".$batchID2."<br>";
						
						if(productStage($row["productID"],$farmerID,$batchID2)=="Marketing")
						{
							if(getCurrentProductPrice($farmerID,$row["productID"])>0)
							{
								$prod[] = array('num'=>$num,'productID'=>$row["productID"],'pName'=>$row["pName"],'price'=>getCurrentProductPrice($farmerID,$row["productID"]),'description'=>$row["description"],'packaging'=>$row["packaging"],'batchID'=>$batchID2);
							}
						}
					}
				}
				else
				{
					$timelines2 = timeline($farmerID,$productID,"GET ALL");
					@$num2 = count($timelines2);
				
					//var_dump($timelines2);
				
					for($a2=0; $a2<$num2; $a2++)
					{
						//$batchID2x = $timelines2['id'];
						$batchID2 = $timelines2[$a2]['id'];
						
						if(productStage($productID,$farmerID,$batchID2)==$type)
						{
							$prod[] = array('num'=>$num,'productID'=>$productID,'pName'=>$row["pName"],'price'=>getCurrentProductPrice($farmerID,$productID),'description'=>$row["description"],'packaging'=>$row["packaging"],'batchID'=>$batchID2);
						}
					}
				}
			}
		}
		
		return $prod;
	}
	else 
	{
		return 0;
	}
	
	mysql_close($db);
}


function productQty($farmerID,$productID,$batchID=""){
	
	include find_file('cnct_uagro.php');
	
	if(!($batchID==""))
	{
		$sel = "SELECT sum(data) AS sumQuantity FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE_QTY")."' AND userid = '".md5($productID."|".$farmerID."|".$batchID)."';"; //md5($productID."|".$farmerID)
		//echo $sel;
		$res = mysql_query($sel);
		$rw = mysql_fetch_array($res);
		$sumQuantity = $rw["sumQuantity"];
		return $sumQuantity;
	}
	elseif($batchID=="")
	{
		$result = timeline($farmerID,$productID,"GET ALL");
		$num = count($result);
	 
		// check for empty result
		if ($num > 0) 
		{	
			$amount = 0;
			$response["products"] = array();
			for($a=0; $a<$num; $a++)
			{
				$batchID = $result[$a]["id"];
				$amount = $amount+productQty($farmerID,$productID,$batchID);
			}
			
			return $amount;
		}
		else
		{
			return 0;
		}
	}
	
	mysql_close($db);
}


function addProductQty($farmerID,$productID,$batchID,$quantity){
	
	if((productQty($farmerID,$productID,$batchID)+$quantity)<0)
	{
		return 2;
	}
	else
	{
	
		include find_file('cnct_uagro.php');
	
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($productID."|".$farmerID."|".$batchID)."','".$quantity."','".md5("FARM_PRODUCT_TIMELINE_QTY")."');";
		$res = mysql_query($ins);
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	
		mysql_close($db);
	}	
}


function timeline($userid="",$class="",$type="",$meta="",$quantity=""){
	
include find_file('cnct_uagro.php');

	if($type=="ADD")
	{
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($class."|".$userid)."','".(timeline($userid,$class,"MAX")+1)."|".$meta."|".$quantity."','".md5("FARM_PRODUCT_TIMELINE")."');";
		$result2 =  mysql_query($ins);		
		// check if row inserted or not
		if($result2) 
		{
			// successfully inserted into database
			if(addProductQty($farmerID,$productID,timeline($userid,$class,"MAX ID"),$quantity)==1)
			{
				return 1;
			}
			elseif(addProductQty($farmerID,$productID,timeline($userid,$class,"MAX ID"),$quantity)==0)
			{
				return 2;
			}
		} 
		else 
		{
			return 0;
		}
	}
	else
	{
		if($type=="")
		{ 

			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($class."|".$userid)."';"; //md5($productID."|".$farmerID)
			//echo $sel;
			$res = mysql_query($sel);
			@$num = mysql_num_rows($res);
			
			for($a=0; $a<$num; $a++)
			{
				$rw = mysql_fetch_array($res);
				$id = $rw["id"];
				$userid = $rw["userid"];
				$data = $rw["data"];
				$dateset = $rw["dateset"];

				$dt = explode("|",$data);
				$dt2 = explode(" ",$dateset);
				
				$batch = array();
				$batch["id"] = $id;
				$batch["userid"] = $userid;
				$batch["name"] = $dt[0];
				$batch["location"] = $dt[1];
				$batch["dateset"] = $dt2[0]; 
				$batch["quantity"] = productQty($userid,$class,$id); 
				$batch["price"] = getCurrentProductPrice($userid,$class); 
				
				$batches[] = $batch;
			}
			
			return $batches;
		}
		elseif($type=="GET ALL")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($class."|".$userid)."';"; //md5($productID."|".$farmerID)
			//echo $sel;
			$res = mysql_query($sel);
			@$num = mysql_num_rows($res);
			
			for($a=0; $a<$num; $a++)
			{
				$rw = mysql_fetch_array($res);
				$id = $rw["id"];
				$userid = $rw["userid"];
				$data = $rw["data"];
				$dateset = $rw["dateset"];

				$dt = explode("|",$data);
				$dt2 = explode(" ",$dateset);
				
				$batch[] = array('id'=>$id,'userid'=>$userid,'name'=>$dt[0],'location'=>$dt[1],'quantity'=>productQty($userid,$class,$id),'dateset'=>$dt2[0],'price'=>getProductPrice($userid,$class,$id));
			}
			
			return $batch;
		}
		elseif($type=="MAX")
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($class."|".$userid)."');"; //md5($productID."|".$farmerID)
			$res = mysql_query($sel);
			@$num = mysql_num_rows($res);
			@$rw = mysql_fetch_array($res);
			$data = $rw["data"];
			
			$dt = explode("|",$data);
			if($num>=1)
			{
				return $dt[0];
			}
			else
			{
				return 0;
			}
		}
		elseif($type=="MAX ID")
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($class."|".$userid)."');"; //md5($productID."|".$farmerID)
			$res = mysql_query($sel);
			@$num = mysql_num_rows($res);
			@$rw = mysql_fetch_array($res);
			$id = $rw["id"];
			
			if($num>=1)
			{
				return $id;
			}
			else
			{
				return "";
			}
		}
		elseif($type=="MAX ID WITH PRICE")
		{
			
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($class."|".$userid)."'  ORDER BY id ASC;"; //md5($productID."|".$farmerID)
			$res = mysql_query($sel);
			@$num = mysql_num_rows($res);
			
			$maxID = "";
			
			for($w=0; $w<$num; $w++)
			{
				@$rw = mysql_fetch_array($res);
				$id = $rw["id"];
				
				if(getProductPrice($userid,$class,$id)>0)
				{
					$maxID = $id;
				}
				else
				{
					$maxID = $maxID;
				}
			}
			
			if($num>0)
			{
				return $maxID;
			}
			else
			{
				return "";
			}
		}
		elseif($type=="NUM")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($class."|".$userid)."';"; //md5($productID."|".$farmerID)
			$res = mysql_query($sel);
			@$num = mysql_num_rows($res);
			
			return $num;
		}
		elseif($type=="ID")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($class."|".$userid)."' AND id = '".$meta."';"; //md5($productID."|".$farmerID)
			$res = mysql_query($sel);
			@$rw = mysql_fetch_array($res);
			$id = $rw["id"];
			$useridx = $rw["userid"];
			$data = $rw["data"];
			$dateset = $rw["dateset"];

			$dt = explode("|",$data);
			$dt2 = explode(" ",$dateset);
			
			$batch = array();
			$batch["id"] = $id;
			$batch["userid"] = $useridx;
			$batch["name"] = $dt[0];
			$batch["location"] = $dt[1];
			$batch["quantity"] = productQty($userid,$class,$id); 
			$batch["dateset"] = $dt2[0]; 
			$batch["price"] = getProductPrice($userid,$class,$id);
			
			return $batch;
		}
		elseif($type=="ID2")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($class."|".$userid)."' AND id = '".$meta."';"; //md5($productID."|".$farmerID)
			//echo $sel;
			$res = mysql_query($sel);
			@$rw = mysql_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$dateset = $rw["dateset"];

			$dt = explode("|",$data);
			$dt2 = explode(" ",$dateset);
			
			$batch = array('id'=>$id,'userid'=>$userid,'name'=>$dt[0],'location'=>$dt[1],'quantity'=>productQty($userid,$class,$id),'dateset'=>$dt2[0],'price'=>getProductPrice($userid,$class,$id));
			
			return $batch;
		}
		elseif($type=="DATESET")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($class."|".$userid)."' AND id = '".$meta."';"; //md5($productID."|".$farmerID)
			$res = mysql_query($sel);
			@$rw = mysql_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$dateset = $rw["dateset"];
			
			return $dateset;
		}
	}
	
	mysql_close($db);
}




function getCurrentProductPrice($farmerID,$productID){
	
	$maxBatch = timeline($farmerID,$productID,"MAX ID WITH PRICE");
	
	include find_file('cnct_uagro.php');
	
	$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_PRICE")."' AND userid = '".md5($productID."|".$farmerID."|".$maxBatch)."');";
	//echo $sel."<br>";
	@$res = mysql_query($sel);
	@$num = mysql_num_rows($res);
	if($num>=1)
	{
		@$rw = mysql_fetch_array($res);
		return $rw["data"];
	}
	else
	{
		return 2;
	}
	
	mysql_close($db);
}


function productTotalValue($farmerID,$productID="",$batchID=""){
	
	include find_file('cnct_uagro.php');
	
	if(!($farmerID=="") && !($productID=="") && !($batchID==""))
	{
		$sel = "SELECT * FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($productID."|".$farmerID)."' AND id = '".$batchID."';"; //md5($productID."|".$farmerID)
		//echo $sel;
		$res = mysql_query($sel);
		@$rw = mysql_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		$dateset = $rw["dateset"];

		$dt = explode("|",$data);
		$dt2 = explode(" ",$dateset);
		
		return (productQty($farmerID,$productID,$batchID)-productSalesQty($farmerID,$productID,$batchID))*getCurrentProductPrice($farmerID,$productID);
	}
	elseif(!($farmerID=="") && !($productID=="") && ($batchID==""))
	{
		$sel = "SELECT * FROM meta WHERE meta_data = '".md5("FARM_PRODUCT_TIMELINE")."' AND userid = '".md5($productID."|".$farmerID)."';"; //md5($productID."|".$farmerID)
		//echo $sel;
		$res = mysql_query($sel);
		@$num = mysql_num_rows($res);
		$total = 0;
		for($a=0; $a<$num; $a++)
		{
			$rw = mysql_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$dateset = $rw["dateset"];

			$dt = explode("|",$data);
			$dt2 = explode(" ",$dateset);
			
			$total = $total+productQty($farmerID,$productID,$id);
		}
		
		return ($total-productSalesQty($farmerID,$productID))*getCurrentProductPrice($farmerID,$productID);
	}
	elseif(!($farmerID=="") && ($productID=="") && ($batchID==""))
	{
		$result = productListing($farmerID,"","PRICED PRODUCTS");
		$num = count($result);
	 
		// check for empty result
			$total = 0;
			for($a=0; $a<$num; $a++)
			{			
			$productID = $result[$a]["productID"];	
			$total = $total+productTotalValue($farmerID,$productID);
			}
			
		return $total;
	}
	
	mysql_close($db);
}


function orderStatus($type,$orderID,$status){
	
include find_file('cnct_uagro.php');
 
    // insertion of a new row into the mysql database
	
	if($type=='FARMER')
	{
		$query = "UPDATE farmerinputorder SET status='".$status."' WHERE orderID= '".$orderID."';"; //status='paid for'
	}
						  
	if($type=='STOCKIST')
	{
		$query = "UPDATE stockistinputorder SET status='".$status."' WHERE orderID= '".$orderID."';";
	}
						  
	if($type=='CUSTOMER')
	{
		$query = "UPDATE customerproductorder SET status='".$status."' WHERE orderID= '".$orderID."';";
	}
	
	//echo $query;
	
	$result = mysql_query($query);
	
	if($result) 
	{
			return 1;
	} 
	else 
	{
		return 0;
	}
	
	mysql_close($db);
}
?>