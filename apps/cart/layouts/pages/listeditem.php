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

		
if($url=="TBA")
{
	$urlx = getVehicleCategoryImage($productID);
}
else
{
	$urlx = $url;
}
?>
	<div class="items" id="item<?php echo $s;?>" style="width:100%;">
	
	
			<span style="size:10px;"><u><b><?php echo $productname;?></b></u></span> 
		    <div class="row">
               <div class="input-field col s6">
				<img class="<?php echo $url_class;?>" src="<?php echo $urlx;?>" width="120" id="<?php echo $url_id;?>">
               </div>
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
		    <div class="row">
               <div class="input-field col s6">
                  <input placeholder="Pick Up Town"  id="item<?php echo $s;?>_pickUpTown" type="text"  name="pick"  class="validate" />
                  <label for="item<?php echo $s;?>_pickUpTown"> </label>
				</div>
		
			
               <div class="input-field col s6">
                   <input placeholder="Pick Up Area" id="item<?php echo $s;?>_pickUpArea" type="text"   name="pick"    class="validate" />
                  <label for="item<?php echo $s;?>_pickUpArea"></label>   
               </div>
              
            </div>
						
							
						
			<div class="row">
				
				<div class="input-field col s6">      
					<input placeholder="Driving To: Town, Country" id="item<?php echo $s;?>_DrivingTo" name= "pick" type="text" class="validate" />
					<label for="item<?php echo $s;?>_DrivingTo"></label>     
				</div>
				
				
				 <div class="input-field col s6">      
                   <input placeholder="Drop off Town" id="item<?php echo $s;?>_DropOffTown" name= "pick" type="text" class="validate" />
                  <label for="item<?php echo $s;?>_DropOffTown"></label>   
               </div>
				
            </div>
						
						
			<div class="row">
				<div class="input-field col s6">
				  <input placeholder="Pickup Date&Time"  id="item<?php echo $s;?>_pickUpDateTime" name= "date1" type="text" class="validate" />
				  <label for="item<?php echo $s;?>_pickUpDateTime"> </label>
				</div>
				<div class="input-field col s6">      
                  <input placeholder="Drop off Date&Time"  id="item<?php echo $s;?>_DropOffDateTime" name= "date2" type="text" class="validate" />
                  <label for="item<?php echo $s;?>_DropOffDateTime"> </label>    
				</div>
            </div>
						
				
						
			<div class="row">
				<div class="input-field col s6">
                     <select id="item<?php echo $s;?>_Chauffeur"       name="chauf" type="text" class="validate" />   
						<option value="Yes">Yes<option>
						<option value="No">No<option>
					 </select>
                     <label for="item<?php echo $s;?>_Chauffeur">Chauffeur</label>
				</div>
				<div class="input-field col s6">      
					<input placeholder="Drop Off Country" id="item<?php echo $s;?>_DropOffCountry" type="text" value="Zambia" readonly="true" class="active validate" required>
					<label for="item<?php echo $s;?>_DropOffCountry"></label> 
               </div>
            </div>	
					
						
							 <div class="row">
               <div class="input-field col s6">
              
                  <input placeholder="No.of Adults"  id="item<?php echo $s;?>_NoOfAdults" name= "quantity" type="text" class="validate" />
                  <label for="item<?php echo $s;?>_NoOfAdults"> </label>
               </div>
               <div class="input-field col s6">      
                   <input placeholder="No.of Children" id="item<?php echo $s;?>_NoOfChildren" name= "quantity" type="text" class="validate" />
                  <label for="item<?php echo $s;?>_NoOfChildren"></label>   
               </div>
            </div>
	<button onclick="cart('item<?php echo $s;?>');Materialize.toast('Item Added to Cart<a class=&quot;btn-flat yellow-text&quot;href=?ref=camper/accessories.php>Click! here to add Accessories<a>', 5000);" href="#" class="btn modal-trigger         red darken-2  " style="">Add To Cart</button>
	</div>
