<?php 		
if($price=="TBA")
{
	if($productID=="6A" || $productID=="6B")
	{
		$pricev = getCategoryPrice(getVehicleCategoryID($productID),"","WITHIN","USD");
		$bCurrency = "USD";
	}
	else
	{
		$pricev = getCategoryPrice(getVehicleCategoryID($productID),"","WITHIN");
		$bCurrency = currentCurrency();
	}
}
else
{
	$pricev = $price;
	$bCurrency = currentCurrency();
}
?>
	<div class="items" id="item<?php echo $s;?>" style="width:100%;">

			<span style="size:10px;"><u><b><?php echo $productname;?></b></u></span> 
		    <div class="row">
               <div class="input-field col s6">      
					Price : <?php echo $bCurrency.$pricev;?> Per <?php echo $unit;?> Within Town
					<label for="item<?php echo $s;?>_qty"></label>   
                   <input placeholder="Quantity" id="item<?php echo $s;?>_qty" type="text" name="quantity" class="validate"  />
                  <label for="item<?php echo $s;?>_qty"></label>   
               </div>
            </div>
		    <div class="row">
               <div class="input-field col s6">   
					<label for="item<?php echo $s;?>_email"></label>   
                   <input placeholder="Your Email Address" id="item<?php echo $s;?>_email" type="email" name="email" value="<?php echo $_SESSION['CustomerEmail'];?>" class="validate"  />
                  <label for="item<?php echo $s;?>_email"></label>
               </div>
               <div class="input-field col s6">  
					<label for="item<?php echo $s;?>_c_name"></label>   
                   <input placeholder="Your Full Name" id="item<?php echo $s;?>_c_name" type="text" name="_c_name" class="validate"  />
                  <label for="item<?php echo $s;?>_c_name"></label>    
               </div>
            </div>
       
		<input type="hidden" id="item<?php echo $s;?>_merchantID" value="<?php echo $merchantID;?>">
		<input type="hidden" id="item<?php echo $s;?>_unit" value="<?php echo $unit;?>">
		<input type="hidden" id="item<?php echo $s;?>_unitID" value="<?php echo $unitID;?>">
		<input type="hidden" id="item<?php echo $s;?>_name" value="<?php echo $productname;?>">
		<input type="hidden" id="item<?php echo $s;?>_pID" value="<?php echo $productID;?>">
		<input type="hidden" id="item<?php echo $s;?>_price" value="<?php echo $price;?>">
		<input type="hidden" id="item<?php echo $s;?>_duration" value="0">
		<input type="hidden" id="item<?php echo $s;?>_pickUpArea" value="0">
		<input type="hidden" id="item<?php echo $s;?>_DropOffTown" value="0">
		<input type="hidden" id="item<?php echo $s;?>_pickUpTown" value="0">
		<input type="hidden" id="item<?php echo $s;?>_DropOffCountry" value="0">
		<input type="hidden" id="item<?php echo $s;?>_Chauffeur" value="0">
		<input type="hidden" id="item<?php echo $s;?>_DrivingTo" value="0">
		<input type="hidden" id="item<?php echo $s;?>_NoOfAdults" value="0">
		<input type="hidden" id="item<?php echo $s;?>_NoOfChildren" value="0">
 
				   
				   
		<div class="row">
			<div class="input-field col s6">
			  <input placeholder="Pickup Date&Time"  id="item<?php echo $s;?>_pickUpDateTime" type="text" class="active validate" required>
			  <label for="item<?php echo $s;?>_pickUpDateTime"> </label>
			</div>
			<div class="input-field col s6">      
				<input placeholder="Drop off Date&Time"  id="item<?php echo $s;?>_DropOffDateTime" type="text" class="active validate" required>
				<label for="item<?php echo $s;?>_DropOffDateTime"></label>   
		   </div>
		</div>
		<div class="card-content">
			<div class="row">
				<div class="input-field col s6">
                  <input placeholder="Quantity"  id="item<?php echo $s;?>_qty" type="text" class="active validate" required>
                  <label for="item<?php echo $s;?>_qty"> </label>
				</div>
            </div>
		</div>
		<button onclick="cart('item<?php echo $s;?>');Materialize.toast('Item added to Cart', 2000)" class="btn modal-trigger         red darken-2  " style="">Add To Cart</button>
	</div>
