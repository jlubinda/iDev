
	<div class="items" id="item<?php echo $s;?>" style="width:100%;">
			<img class="<?php echo $url_class;?>" src="<?php echo $url;?>" id="<?php echo $url_id;?>" width="1" height="1">
       
		<input type="hidden" id="item<?php echo $s;?>_merchantID" value="<?php echo $merchantID;?>">
		<input type="hidden" id="item<?php echo $s;?>_unit" value="<?php echo $unit;?>">
		<input type="hidden" id="item<?php echo $s;?>_unitID" value="<?php echo $unitID;?>">
		<input type="hidden" id="item<?php echo $s;?>_name" value="<?php echo $productname;?>">
		<input type="hidden" id="item<?php echo $s;?>_price" value="<?php echo $price;?>">
		<div class="card-content">
			<p>QUANTITY: <input type="text" id="item<?php echo $s;?>_qty" value="1" align="center" size="10" style="text-align:center; width:80px;"> vehicle(s)</p>
			<p>DURATION: <input type="text" id="item<?php echo $s;?>_duration" value="1" align="center" size="10" style="text-align:center; width:80px;"> day(s)</p>
		</div>
		

         
		    <div class="row">
				<div>
    <h5 class="center-align"> Book Now </h5>
  </div>
        
							
               <div class="input-field col s6">
                  <input placeholder="Pick Up Town"  id="name" type="text" class="active validate" required>
                  <label for="name"> </label>
               </div>
               <div class="input-field col s6">      
                   <input placeholder="Pick Up Area" id="name" type="text" class="active validate" required>
                  <label for="name"></label>   
               </div>
            </div>
						
							
						
						    <div class="row">
						<div class="input-field col s6">
                  <input placeholder="Pickup Date&Time"  id="name" type="text" class="active validate" required>
                  <label for="name"> </label>
               </div>
               <div class="input-field col s6">      
                   <input placeholder="Pickup Location" id="name" type="text" class="active validate" required>
                  <label for="name"></label>   
               </div>
            </div>
						
						
							    <div class="row">
						<div class="input-field col s6">
                  <input placeholder="Drop off Date&Time"  id="name" type="text" class="active validate" required>
                  <label for="name"> </label>
               </div>
               <div class="input-field col s6">      
                   <input placeholder="Drop off location" id="name" type="text" class="active validate" required>
                  <label for="name"></label>   
               </div>
            </div>
						
				
							
					<div class="input-field col s12">
                  <p>
                     <input id="Chauffeur" type="checkbox" >
                     <label for="Chauffeur">Chauffeur</label>
                  </p>
               </div>
					
						
							 <div class="row">
               <div class="input-field col s6">
              
                  <input placeholder="No.of Adults"  id="name" type="text" class="active validate" required>
                  <label for="name"> </label>
               </div>
               <div class="input-field col s6">      
                   <input placeholder="No.of Children" id="name" type="text" class="active validate" required>
                  <label for="name"></label>   
               </div>
            </div>
		<input type="hidden" id="item<?php echo $s;?>_pID" value="<?php echo $productID;?>">
		<button onclick="cart('item<?php echo $s;?>')" href="#" class="btn modal-trigger         grey darken-2  " style="">Add To Cart</button>
	</div>
