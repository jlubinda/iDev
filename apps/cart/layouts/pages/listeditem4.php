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
	
	To view quote add item to cart
	
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
		<input type="hidden" id="item<?php echo $s;?>_name" value="TBA">
		<input type="hidden" id="item<?php echo $s;?>_price" value="<?php echo $price;?>">
		<input type="hidden" id="item<?php echo $s;?>_duration" value="0">
		    <div class="row">
               <div class="input-field col s6">
                  <input required placeholder="Pick Up Town"  id="item<?php echo $s;?>_pickUpTown" type="text" name="pick" class="validate"  >
                  <label for="item<?php echo $s;?>_pickUpTown"> </label>
				</div>
			   
			     <div class="input-field col s6">
                   <input required  placeholder="Pick Up Area" id="item<?php echo $s;?>_pickUpArea" type="text" name="pick" class="validate" >
                  <label for="item<?php echo $s;?>_pickUpArea"></label>   
               </div>
             
            </div>
						
							
						
			<div class="row">
				
				<div class="input-field col s6">      
					<input  required  placeholder="Driving To:Town,Country" id="item<?php echo $s;?>_DrivingTo" type="text" name="pick" class="validate">
					<label for="item<?php echo $s;?>_DrivingTo"></label>     
				</div>
				
				
			   
			   
			   
			     <div class="input-field col s6">      
                   <input  required placeholder="Drop off Town" id="item<?php echo $s;?>_DropOffTown" type="text" name="pick" class="validate"  >
                  <label for="item<?php echo $s;?>_DropOffTown"></label>   
               </div>
            </div>
						
					
<div class="row">
			<div class="input-field col s6">
			  <input required placeholder="Pickup Date&Time"  id="item<?php echo $s;?>_pickUpDateTime" type="text" class="validate" >
			  <label for="item<?php echo $s;?>_pickUpDateTime"> </label>
			</div>
			<div class="input-field col s6">      
				<input required  placeholder="Drop off Date&Time"  id="item<?php echo $s;?>_DropOffDateTime" type="text" class="validate" >
				<label for="item<?php echo $s;?>_DropOffDateTime"></label>   
		   </div>
		</div>
    
			
			<div class="row">		  
				<div class="input-field col s12">
					<select  name="myselect" id="item<?php echo $s;?>_pID"    class="required" >
					  <option   disabled="true" >    Choose Vehicle Category</option>
					  <?php 
					  $pe = listVehicleCategories();
					  for($e=0; $e<$pe[0]['num']; $e++)
					  {
						  echo '<option value="'.$pe[$e]['code'].'">'.$pe[$e]['name'].'</option>';
					  }
					  ?>
					</select>
					<label data-error="Select an vehiclce type">Choose Vehicle Category</label>
				</div>	
			</div>
						
				
						
			<div class="row">
				<div class="input-field col s6">
                     <select id="item<?php echo $s;?>_Chauffeur">
						<option value="Yes">Yes<option>
						<option value="No">No<option>
					 </select>
                     <label for="item<?php echo $s;?>_Chauffeur">Chauffeur</label>
				</div>
				
				<div class="input-field col s6">      
					<input required placeholder="Drop Off Country" id="item<?php echo $s;?>_DropOffCountry" type="text" value="Zambia" readonly="true" class="active validate" required>
					<label for="item<?php echo $s;?>_DropOffCountry"></label> 
               </div>
				
            </div>	
					
						
							 <div class="row">
               <div class="input-field col s6">
              
                  <input required placeholder="No.of Adults"  id="item<?php echo $s;?>_NoOfAdults" type="text" name="quantity" class="validate"  >
                  <label for="item<?php echo $s;?>_NoOfAdults"> </label>
               </div>
               <div class="input-field col s6">      
                   <input required placeholder="No.of Children" id="item<?php echo $s;?>_NoOfChildren" type="text" name="quantity" class="validate" >
                  <label for="item<?php echo $s;?>_NoOfChildren"></label>   
               </div>
			   
			   
			   
            </div>
		<button  onclick="cart('item<?php echo $s;?>');" href="#" class="btn modal-trigger         red darken-2  " style="">Add To Cart</button>
		<img class="<?php echo $url_class;?>" src="TBA" width="1" height="1" id="<?php echo $url_id;?>">
	</div>

	

	

	
	
	<style>
input:required {
  border: 2px solid green;
}
input:required:invalid {
  border: 2px solid red;
}
</style>

	
	