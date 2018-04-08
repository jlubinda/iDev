<?php
		
if(chkSes()=="Active")
{
	$userData = userData();
	
	//live ServiceType: 6408
	//test ServiceType: 6502
	$time = date("Y/m/d");
	
	$servicesArray = array('Service'=>array('ServiceType'=>6502,'ServiceDescription'=>"Hiring Vehicle",'ServiceDate'=>$time));
	
	if($_SESSION["token"]=="" || !(isset($_SESSION["token"])))
	{
		if($_REQUEST["num"]=="" || $_REQUEST["num"]<="0")
		{
			
		}
		else
		{
			$tx = uniqueCode();
			
			$redirecturl = "http://citydrive.payitapp.co/?ref=cart/index.php";
			$backurl = "http://citydrive.payitapp.co/?ref=cart/index.php";
			
			$tokenx = createToken($_REQUEST["totalValue"],"USD",uniqueCode(),$redirecturl,$backurl,0,5,$userData["Email"],$servicesArray);
			$tokeny = XMLToArray($tokenx);
			$token = $tokeny["API3G"];
			
			if($token["Result"]=="000")
			{
				$_SESSION["token"] = $token["TransToken"];
				$_SESSION["ref"] = $tx;
				
				header("Location:https://secure.3gdirectpay.com/pay.asp?ID=".$token["TransToken"]);
				die();
			}
		}
	}
	else
	{
		
	}
}
	
router(array("HEADER","website"),"","",'','','file','');
include find_file("apps/cart/layouts/pages/nav.php");
		
if(chkSes()=="Active")
{
	if($_SESSION["token"]=="" || !(isset($_SESSION["token"])))
	{
		if($_REQUEST["num"]=="" || $_REQUEST["num"]<="0")
		{
			transList("UNPAID");
		}
		else
		{
			if($token["Result"]=="000")
			{
				
			}
			else
			{
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
		
		//echo "Result: ".$token2["Result"]."<br>";
		echo "<b>Result Explanation: </b>".$token2["ResultExplanation"]."<br>";
		if(!($token2["FraudAlert"]=="" || $token2["FraudAlert"]=="000"))
		{
			echo "<b>Fraud Alert: </b>".$token2["FraudExplnation"];
		}
		
		$save = saveTransData($_SESSION["token"],$token2["Result"],$token2["ResultExplanation"],$token2["CustomerName"],$token2["CustomerCredit"],$token2["TransactionApproval"],$token2["TransactionCurrency"],$token2["TransactionAmount"],$token2["FraudAlert"],$token2["FraudExplnation"],$token2["TransactionNetAmount"],$token2["TransactionSettlementDate"],$token2["TransactionRollingReserveAmount"],$token2["TransactionRollingReserveDate"],$token2["CustomerPhone"],$token2["CustomerCountry"],$token2["CustomerAddress"],$token2["CustomerCity"],$token2["CustomerZip"],$token2["MobilePaymentRequest"],$token2["AccRef"],$_SESSION["ref"]);
		
		if($save==1)
		{		
			if(count($_SESSION["cart"])>=1)
			{
				$value = end ($_SESSION['cart']); 
				$i = 0;
				while ($value) 
				{ 
					saveCartData($value["merchantID"],$value["name"],$value["price"],$value["src"],$value["pID"],$value["qty"],$value["duration"],$value["unit"],$value["unitID"],$_SESSION["ref"]);

					$value = prev($_SESSION['cart']); 
					$i=$i+1;
				}
			}
			else
			{
				
			}
			
			echo "<b>Total: </b>".$totalValue."</div>";
			echo "<br>Transaction Saved";
		}
		else
		{
			echo "<br>Sorry. Transaction Not Saved";
		}
		
		unset($_SESSION["token"]);
		unset($_SESSION["cart"]);
		unset($_SESSION["ref"]);
		
		transList("UNPAID");
	}
}
else
{
	include find_file("login.php");
}
	
router(array("FOOTER","website"),"","",'','','file','');
	
?>