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
	
	
	//$save = saveTransData($_SESSION["token"],$token2["Result"],$token2["ResultExplanation"],$token2["CustomerName"],$token2["CustomerCredit"],$token2["TransactionApproval"],$token2["TransactionCurrency"],$token2["TransactionAmount"],$token2["FraudAlert"],$token2["FraudExplnation"],$token2["TransactionNetAmount"],$token2["TransactionSettlementDate"],$token2["TransactionRollingReserveAmount"],$token2["TransactionRollingReserveDate"],$token2["CustomerPhone"],$token2["CustomerCountry"],$token2["CustomerAddress"],$token2["CustomerCity"],$token2["CustomerZip"],$token2["MobilePaymentRequest"],$token2["AccRef"],$_SESSION["ref_num"],$_SESSION['CustomerEmail']);
	$_SESSION['CustomerName'] = $token2["CustomerName"];
	
	$trand1 = (float) $token2["TransactionAmount"];
	
	echo "<br>Transaction cancelled";
	
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