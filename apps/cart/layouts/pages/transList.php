<div style="margin:5px; padding:5px; background-color:#fff;">
  <!-- Modal content -->
	<table style=" ">
  <?php
  
  if($TransType=="UNPAID")
  {
	  $sql = " WHERE Result = '900' AND userID = '".$userID."'";
  }
  elseif($TransType=="PAID")
  {
	  $sql = " WHERE Result = '000' AND userID = '".$userID."'";
  }
  elseif($TransType=="AUTHORIZED")
  {
	  $sql = " WHERE Result = '001' AND userID = '".$userID."'";
  }
  elseif($TransType=="OVERPAY/UNDERPAY")
  {
	  $sql = " WHERE Result = '002' AND userID = '".$userID."'";
  }
  elseif($TransType=="DECLINED")
  {
	  $sql = " WHERE Result = '901' AND userID = '".$userID."'";
  }
  elseif($TransType=="PASSED PTL")
  {
	  $sql = " WHERE Result = '903' AND userID = '".$userID."'";
  }
  elseif($TransType=="CANCELLED")
  {
	  $sql = " WHERE Result = '904' AND userID = '".$userID."'";
  }
  
  $List = getTransData($sql);
  
  ?>
	<tr style="padding:5px; background-color:#333; color:#fff; min-width:350px;">
		<td>			
			<b>Result</b>
		</td>
		<td>			
			<b>Fraud Explanation</b>
		</td>
		<td>			
			<b>DATE SET</b>
		</td>
		<td>
		
		</td>
		<td>
		
		</td>
	</tr>
  <?php
  
  for($a=0; $a<$List[0]["num"]; $a++)
  {
  ?>
	<tr style="padding:5px; background-color:#ccc; color:#000; min-width:350px;">
		<td>			
			<?php echo $List[$a]["ResultExplanation"];?>
		</td>
		<td>			
			<?php echo $List[$a]["FraudExplnation"];?>
		</td>
		<td>			
			<?php echo $List[$a]["dateset"];?>
		</td>
		<td>			
			<a href="./?ref=cart/viewcart.php&cartRef=<?php echo $List[$a]["Ref"];?>" target="_new">
				<div>VIEW BOOKED VEHICLE(S)</div>
			</a>
		</td>
		<td>			
			<a href="https://secure.3gdirectpay.com/pay.asp?ID=<?php echo $List[$a]["Token"];?>">
				<div>PAY NOW</div>
			</a>
		</td>
	</tr>
  <?php 
  }
  ?>
	</table>
</div>