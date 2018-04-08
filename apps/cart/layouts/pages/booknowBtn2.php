<a href="#modal<?php echo $s;?>"  class="btn modal-trigger  modal-action modal-open red darken-2  " style=""><?php echo $buttonText;?></a>
<!-- Modal Structure -->
<div id="modal<?php echo $s;?>" class="modal">
    <div class="modal-content">
		<div class="right">
			<a href="#!" class=" modal-action modal-close  btn">X</a>
		</div>
		<form class="col s12" action="?ref=<?php echo $_REQUEST["ref"];?>">
			<?php
			if(chkSes=="Active")
			{
				$userX = userData();
				$myEmail = $userX["Email"];
			}
			else
			{
				$myEmail = "";
			}
			cartListedItem("TIME ONLY","CITYDRIVE",$productname,$productID,$price,"Day","Day",$img,"activator","",$s,$myEmail,$price_oot,$price_ooc);
			?>	
		</form>
	</div>		
</div>
<script>
$('#modal1').closeModal({ dismissible: true});
</script>