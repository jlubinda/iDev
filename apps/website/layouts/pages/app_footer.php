<div class="modal" id="applodesDialog">
    <div class="modal-content">
      <h4>Processing Your Data</h4>
      <p><img src="apps/website/resources/images/loading5.gif" width="70" class="left"> <span> Please wait.</span></p>
    </div>
    <div class="modal-footer">
      &nbsp;
    </div>
</div>

<div class="modal" id="applodesSuccess">
    <div class="modal-content">
      <h4>Processed Your Data</h4>
      <p><img src="apps/website/resources/images/status_success.png" width="70" class="left"> <span> Success!</span></p>
      <p>Success!</p>
    </div>
    <div class="modal-footer">
      &nbsp;
    </div>
</div>

<div class="modal" id="applodesNotice">
    <div class="modal-content">
      <h4>Processed Your Data</h4>
		<div class="row">
		<p><img src="apps/website/resources/images/status_warning.png" width="70" class="left"> <span id="applodesMessage"></span></p>
		</div>
		<div class="row">
			<div class="col s12 l12">Status Code: <span id="applodesStatusCode"></span></div>
		</div>
    </div>
    <div class="modal-footer">
      &nbsp;
    </div>
</div>

<div class="modal" id="applodesError">
    <div class="modal-content">
      <h4>Processed Your Data</h4>
		<div class="row">
		<p><img src="apps/website/resources/images/status_error.png" width="70" class="left"> <span id="applodesMessage"></span></p>
		</div>
		<div class="row">
			<div class="col s12 l12">Status Code: <span id="applodesStatusCode"></span></div>
		</div>
    </div>
    <div class="modal-footer">
      &nbsp;
    </div>
</div>

<footer class="page-footer grey darken-4">
    <div class="container">
            <div class="row">
              <div class="col s12 l4 m10">
                <h5 class="white-text"> </h5>
                <p class="white-text">Get every new update delivered to your inbox.</p>
			     <form>
			    
			      <div class="input-field">
			        <i class="mdi-communication-email prefix"></i>
			        <input id="icon_prefix" type="email" class="validate">
			        <label for="icon_prefix">Email</label>
			      </div>
			     
			     </form>
			    
			    <a class="waves-effect waves-light btn">Sign Up
                    <i class="fa fa-sign-in right"></i></a>
       </div><!--col-->
              
              
              <div id="categories" class="col l3 offset-l1 s12 m8">
                <h5 class="white-text">Our Company</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="?ref=aboutus.php">About us</a></li>
                  <li><a class="grey-text text-lighten-3" href="?ref=news/">News</a></li>
                  <li><a class="grey-text text-lighten-3" href="?ref=enviroment.php">Enviroment</a></li>
                  <li><a class="grey-text text-lighten-3" href="?ref=careers.php">Careers</a></li>
				  <li><a class="grey-text text-lighten-3" href="?ref=privacy.php">Privacy</a></li>
                   <li><a class="grey-text text-lighten-3" href="?ref=terms.php">Terms</a></li>
				  <li><a class="grey-text text-lighten-3" href="?ref=contact.php">Contacts</a></li>  
                </ul>
              </div><!--col-->
              
              
              

              
            </div><!--row-->
             <div class="row">

			</div>
			
			
            <div class="row">
            	<div class="col s12 l3 offset-l5">
            		
            	
            	<a href="#"><i style="font-size: 38px;" class="fa fa-facebook-square"></i></a> &nbsp;&nbsp;&nbsp;
            	<a href="#"><i style="font-size: 38px;" class="fa fa-twitter-square"></i></a>&nbsp;&nbsp;&nbsp;
            	<a href="#"><i style="font-size: 38px;" class="fa fa-google-plus-square"></i></a>
            	</div>
            	
            </div><!--row-->
          </div><!--conatiner-->
    <div class="footer-copyright">
      <div class="container">
       <p>Copyright © Vehicle Portal A Division Of City Drive Rent a Car. All rights Reserved</p>
       <br>
      </div>
    </div>
  </footer>

<!--End mc_embed_signup-->
  
  
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5947d11ae9c6d324a47362a0/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
  

<!--  Scripts-->

<!--  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
<script src="apps/website/resources/js/jquery-2.1.1.min.js"></script>
<?php 
if($GLOBALS["croppieSettings"]==1)
{
	echo croppieScripts($GLOBALS["croppieWidth"],$GLOBALS["croppieHeight"],$GLOBALS["croppieShape"],$GLOBALS["boundaryWidth"],$GLOBALS["boundaryHeight"],$GLOBALS["croppieImageName"],$GLOBALS["croppieTargetFolder"],$GLOBALS["croppieImageUploader"],$GLOBALS["croppieCustomOptions"],$GLOBALS["croppieCustomData"],$GLOBALS["croppieCustomData2"]);
}
?>
<script type="text/javascript">

	function showPopUp(el,statuscode="",message="") {
		var cvr = document.getElementById("cover");
		var dlg = document.getElementById(el);
		cvr.style.display = "block";
		dlg.style.display = "block";
		
		document.getElementById("applodesStatusCode").innerHTML = statuscode;
		document.getElementById("applodesMessage").innerHTML = message;
		
		if (document.body.style.overflow = "hidden") {
			cvr.style.width = "100%";
			cvr.style.height = "100%";
		}
	}
	
	function closePopUp(el) {
		var cvr = document.getElementById("cover");
		var dlg = document.getElementById(el);
		cvr.style.display = "none";
		dlg.style.display = "none";
		document.body.style.overflowY = "scroll";
	}
	
	
	function updateVehiclePrices(vehicle_id,newfees_within,newfees_outside,newfees_ooc,new_currency,new_country=""){
		
		var endpoint = "apps/annime/add/VehiclePrice/"+vehicle_id;
		showPopUp("applodesDialog");
		$.ajax({
		  url: "<?php echo API_URL();?>/<?php echo API_VERSION();?>/<?php echo API_KEY();?>/<?php echo API_OUTPUT_FORMAT();?>/<?php echo API_DATA_CENTRE();?>/<?php echo API_ENVIRONMENT();?>/"+endpoint,
		  type: "POST",
		  data: {localrate: newfees_within, ootrate: newfees_outside, oocrate: newfees_ooc, currency: new_currency, country: new_country },
		  success:function(response) {
			  
			var obj = jQuery.parseJSON(response);
			
			//$("#MyModal").openModal();
			//$("#MyModal").closeModal();
			
			if(obj.status=="success")
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesSuccess");
			   setTimeout(function () {
				  closePopUp("applodesSuccess");
				}, 1500);
			}
			else if(obj.status=="notice")
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesNotice",obj.statuscode,obj.message);
			   setTimeout(function () {
				  closePopUp("applodesNotice");
				}, 1500);
			}
			else
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesError",obj.statuscode,obj.message);
			   setTimeout(function () {
				  closePopUp("applodesError");
				}, 1500);
			}
		  }
		});
	}
	
	
	function editVehiceDetails(vehicle_id,vehiclemake,vehicletype,vehicle_color,vehicle_weight,enginesize,fueltype,conrate,tanksize,enginenumber,chassisnumber,transmission,seats,yearmake,doors,aircon,entertainment,safety,owner,owner_type,town,province,country="Zambia"){
		
		var endpoint = "apps/annime/edit/vehicles/"+vehicle_id;
		showPopUp("applodesDialog");
		$.ajax({
		  url: "<?php echo API_URL();?>/<?php echo API_VERSION();?>/<?php echo API_KEY();?>/<?php echo API_OUTPUT_FORMAT();?>/<?php echo API_DATA_CENTRE();?>/<?php echo API_ENVIRONMENT();?>/"+endpoint,
		  type: "POST",
		  data: {vehiclemake: vehiclemake, vehicletype: vehicletype, vehicle_color: vehicle_color, vehicle_weight: vehicle_weight, enginesize: enginesize, fueltype: fueltype, conrate: conrate, tanksize: tanksize, enginenumber: enginenumber, chassisnumber: chassisnumber, transmission: transmission, seats: seats, yearmake: yearmake, doors: doors, aircon: aircon, entertainment: entertainment, safety: safety, owner: owner, owner_type: owner_type, town: town, province: province, country: country },
		  success:function(response) {
			  
			var obj = jQuery.parseJSON(response);
			
			//$("#MyModal").openModal();
			//$("#MyModal").closeModal();
			
			if(obj.statuscode=="0000")
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesSuccess");
			   setTimeout(function () {
				  closePopUp("applodesSuccess");
				  window.open('./?ref=profile/yourvehicles.php'); 
				}, 1500);
			}
			else
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesError",obj.statuscode,obj.message);
			   setTimeout(function () {
				  closePopUp("applodesError");
				  window.open('./?ref=profile/yourvehicles.php&id='+vehicle_id+'&function=edit&type=vehicle'); 
				}, 1500);
			}
		  }
		});
	}
	
	
	function addMaintenanceDetails(vehicle_id,works_type,details_of_works,parts_removed,parts_added,mileage,mechanic){
		
		var endpoint = "apps/annime/add/MainenanceDetails/"+vehicle_id;
		showPopUp("applodesDialog");
		$.ajax({
		  url: "<?php echo API_URL();?>/<?php echo API_VERSION();?>/<?php echo API_KEY();?>/<?php echo API_OUTPUT_FORMAT();?>/<?php echo API_DATA_CENTRE();?>/<?php echo API_ENVIRONMENT();?>/"+endpoint,
		  type: "POST",
		  data: {works_type: works_type, details_of_works: details_of_works, parts_removed: parts_removed, parts_added: parts_added, mileage: mileage, mechanic: mechanic},
		  success:function(response) {
			  
			var obj = jQuery.parseJSON(response);
			
			//$("#MyModal").openModal();
			//$("#MyModal").closeModal();
			
			if(obj.statuscode=="0000")
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesSuccess");
			   setTimeout(function () {
				  closePopUp("applodesSuccess");
				  window.open('./?ref=profile/yourvehicles.php'); 
				}, 1500);
			}
			else
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesError",obj.statuscode,obj.message);
			   setTimeout(function () {
				  closePopUp("applodesError");
				  window.open('./?ref=profile/yourvehicles.php&id='+vehicle_id+'&function=edit&type=vehicle'); 
				}, 1500);
			}
		  }
		});
	}
	
	
	function addBreakdown(vehicle_id,driver_name,driver_id,details_of_breakdown,details_of_works,mechanic){
		
		var endpoint = "apps/annime/add/Breakdown/"+vehicle_id;
		showPopUp("applodesDialog");
		$.ajax({
		  url: "<?php echo API_URL();?>/<?php echo API_VERSION();?>/<?php echo API_KEY();?>/<?php echo API_OUTPUT_FORMAT();?>/<?php echo API_DATA_CENTRE();?>/<?php echo API_ENVIRONMENT();?>/"+endpoint,
		  type: "POST",
		  data: {driver_name: driver_name, driver_id: driver_id, details_of_breakdown: details_of_breakdown, details_of_works: details_of_works, mechanic: mechanic},
		  success:function(response) {
			  
			var obj = jQuery.parseJSON(response);
			
			//$("#MyModal").openModal();
			//$("#MyModal").closeModal();
			
			if(obj.statuscode=="0000")
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesSuccess");
			   setTimeout(function () {
				  closePopUp("applodesSuccess");
				  window.open('./?ref=profile/yourvehicles.php'); 
				}, 1500);
			}
			else
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesError",obj.statuscode,obj.message);
			   setTimeout(function () {
				  closePopUp("applodesError");
				  window.open('./?ref=profile/yourvehicles.php&id='+vehicle_id+'&function=edit&type=vehicle'); 
				}, 1500);
			}
		  }
		});
	}
	
	
	function addVehicleMilage(vehicle_id,mileage,notes=""){
		
		var endpoint = "apps/annime/add/Mileage/"+vehicle_id;
		showPopUp("applodesDialog");
		$.ajax({
		  url: "<?php echo API_URL();?>/<?php echo API_VERSION();?>/<?php echo API_KEY();?>/<?php echo API_OUTPUT_FORMAT();?>/<?php echo API_DATA_CENTRE();?>/<?php echo API_ENVIRONMENT();?>/"+endpoint,
		  type: "POST",
		  data: {mileage: mileage, notes: notes},
		  success:function(response) {
			  
			var obj = jQuery.parseJSON(response);
			
			//$("#MyModal").openModal();
			//$("#MyModal").closeModal();
			
			if(obj.statuscode=="0000")
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesSuccess");
			   setTimeout(function () {
				  closePopUp("applodesSuccess");
				  window.open('./?ref=profile/yourvehicles.php'); 
				}, 1500);
			}
			else
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesError",obj.statuscode,obj.message);
			   setTimeout(function () {
				  closePopUp("applodesError");
				  window.open('./?ref=profile/yourvehicles.php&id='+vehicle_id+'&function=edit&type=vehicle'); 
				}, 1500);
			}
		  }
		});
	}
	
	
	function updateVehicleStatus(vehicle_id,newVehicleStatus){
		
		if(newVehicleStatus=="ACTIVE")
		{
			var endpoint = "apps/annime/edit/activateVehicleOnVP/"+vehicle_id;
		}
		else
		{
			var endpoint = "apps/annime/edit/deactivateVehicleOnVP/"+vehicle_id;
		}
		
		showPopUp("applodesDialog");
		$.ajax({
		  url: "<?php echo API_URL();?>/<?php echo API_VERSION();?>/<?php echo API_KEY();?>/<?php echo API_OUTPUT_FORMAT();?>/<?php echo API_DATA_CENTRE();?>/<?php echo API_ENVIRONMENT();?>/"+endpoint,
		  type: "POST",
		  data: {localrate: vehicle_id },
		  success:function(response) {
			  
			var obj = jQuery.parseJSON(response);
			
			//$("#MyModal").openModal();
			//$("#MyModal").closeModal();
			
			if(obj.statuscode=="0000")
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesSuccess");
			   setTimeout(function () {
				  closePopUp("applodesSuccess");
				  location.reload();
				}, 1500);
			}
			else
			{
			   closePopUp("applodesDialog");
			   showPopUp("applodesError",obj.statuscode,obj.message);
			   setTimeout(function () {
				  closePopUp("applodesError");
				  location.reload();
				}, 1500);
			}
		  }
		});
	}
</script>
<script src="apps/website/resources/js/jquery-ui.min.js"></script>
<script src="apps/website/resources/fancybox/dist/jquery.fancybox.min.js"></script>
<script type="text/javascript">
	$("[data-fancybox]").fancybox({
		// Options will go here
	});
</script>

<script src="apps/website/resources/js/jquery.datetimepicker.full.js"></script>
<script src="apps/website/resources/js/jquery.validate.js"></script>
<script src="apps/website/resources/js/materialize.min.js"></script>


<script type="text/javascript">

    // Set checkbox on forms.html to indeterminate
	/*
    var indeterminateCheckbox = document.getElementById('indeterminate-checkbox');
    if (indeterminateCheckbox !== null)
      indeterminateCheckbox.indeterminate = true;
  */
//rome(dt);
(function ($) {
    $(function () {

        //initialize all modals           
        $('.modal').modal();

        //now you can open modal from code
        $('#modal1').modal('open');

        //or by click on trigger
        $('.trigger-modal').modal();
		
     $('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
      ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
          //alert("Ready");
          console.log(modal, trigger);
      },
     complete: function() {} // Callback for Modal close
   });
   
   
    $('.button-collapse').sideNav({
		  menuWidth: 300, // Default is 300
		  edge: 'left', // Choose the horizontal origin
		  closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
		  draggable: true, // Choose whether you can drag to open on touch screens,
		  onOpen: function(el) { /* Do Stuff*/ }, // A function to be called when sideNav is opened
		  onClose: function(el) { /* Do Stuff*/ }, // A function to be called when sideNav is closed
		}
	  );
	$(".dropdown-button").dropdown();
	$('.materialboxed').materialbox();
	$('.parallax').parallax();
	$('select').material_select();
	$('.dropdown-trigger').dropdown();
	//$('.modal').modal();
	$('.collapsible').collapsible();
	$('.sidenav').sideNav();
	
   

    }); // end of document ready
})(jQuery); // end of jQuery name space


  
</script>
<script src="apps/website/resources/js/jquery.flexslider.js"></script>


<!-- The Templates plugin is included to render the upload/download listings -->
<script src="apps/website/resources/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="apps/website/resources/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="apps/website/resources/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="apps/website/resources/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="apps/website/resources/js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="apps/website/resources/js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="apps/website/resources/js/jquery.fileupload-ui.js"></script>
<!-- The localization script -->
<script src="apps/website/resources/js/locale.js"></script>
<!-- The other plugins scripts -->
<!-- zClip http://www.steamdev.com/zclip/ -->
<script src="apps/website/resources/js/jquery.zclip.js"></script>




<script type="text/javascript">
	function addHidden(theForm, key, value) {
    // Create a hidden input element, and append it to the form:
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = key;
    input.value = value;
    theForm.appendChild(input);
}

	function validate(btn) {
    if (document.getElementById("emailAdd").value == "") {
		
		var para = document.createElement("p");
		var node = document.createTextNode("Please enter Email Address.");
		para.appendChild(node);

		var element = document.getElementById("div1");
		element.appendChild(para);

		
         //alert("Please enter Email Address");
         return false;
    } else {
		
		// Form reference:
		var theForm = document.forms["checkoutForm"];

		// Add data:
		addHidden(theForm, "submitBtn", btn);
        theForm.submit();
		//return true;
    }
}</script>




<?php cartScripts();?>

      <!--  Select-->
<!--
  <script>
$(document).ready(function(){
  $('.slider').slider({
    full_width:true,
    interval:5000,
    transition:800,
  });
});
  </script>
  
  -->
  
  <script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider();
  });
</script>
 <!--Drop down-->

  
  <!--Scroll button-->
	<script>
		$('.head-link').click(function(e) {
		e.preventDefault();
		
		var goto = $(this).attr('href');		$('html, body').animate({
			scrollTop: $(goto).offset().top
		}, 800);
	});	</script>
  
  <script>/*
	window.onerror = function(errorMsg) {
		$('#console').html($('#console').html()+'<br>'+errorMsg)
	}*/	$.datetimepicker.setLocale('en');<?php 
$hours = 1;
if($_REQUEST["ref"]=="amend_booking.php")
{
	$itema = $_SESSION['cart'][$_REQUEST["id"]];
}for($u=0; $u<14; $u++)
{
	?>
		$('#item<?php echo $u;?>_pickUpDateTime').datetimepicker({
		formatTime:'H:i',
		formatDate:'Y/m/d',
		dayOfWeekStart : 1,
		lang:'en'
		});
	<?php
	if($_REQUEST["ref"]=="amend_booking.php")
	{
		$dt = explode(" ",$itema["pickUpDateTime"]);
		$pickUpD = $dt[0];
		$pickUpT = $dt[1];
		?>
		$('#item<?php echo $u;?>_pickUpDateTime').datetimepicker({value:'<?php echo $itema["pickUpDateTime"];?>',step:10});
	<?php
	}
	else
	{
	?>
		$('#item<?php echo $u;?>_pickUpDateTime').datetimepicker({value:'<?php echo date("Y/m/d", strtotime(date("Y/m/d H:i"))+((1+$hours)*60*60));?> 09:00',step:10});
	<?php
	}
	?>
		$('#item<?php echo $u;?>_pickUpDateTime').datetimepicker({theme:'dark'})
		
		$('#item<?php echo $u;?>_DropOffDateTime').datetimepicker({
		formatTime:'H:i',
		formatDate:'Y/m/d',
		dayOfWeekStart : 1,
		lang:'en'
		});
	<?php
	
	if($_REQUEST["ref"]=="amend_booking.php")
	{
	?>
		$('#item<?php echo $u;?>_DropOffDateTime').datetimepicker({value:'<?php echo $itema["DropOffDateTime"];?>',step:10});
	<?php
	}
	else
	{
	?>
		$('#item<?php echo $u;?>_DropOffDateTime').datetimepicker({value:'<?php echo date("Y/m/d", strtotime(date("Y/m/d H:i"))+((24+$hours)*60*60));?> 09:00',step:10});
	<?php
	}
	?>
		$('#item<?php echo $u;?>_DropOffDateTime').datetimepicker({theme:'dark'})
	<?php 
}
?></script><!--Modal-->
  
  

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86434765-2', 'auto');
  ga('send', 'pageview');

</script>





<script>
$(document).ready(function() {
    if (typeof window.sessionStorage != undefined) {
        if (!sessionStorage.getItem('mySessionVal')) {
    //          ^^^ you can check time here as well ?
	
	 $(document).ready(function(){
       Materialize.toast('When making a booking ensure the currency is the same on all the items in the CART!', 1000, 'rounded' );
    });
			
			
		 sessionStorage.setItem('mySessionVal', true);
         sessionStorage.setItem('storedWhen', Date.now());	
		
        }
    }
});
</script>      

<script>
	  
    $('#form').validate({
        rules: {
           quantity : {  required: true,
 digits: true},pick: {  required: true,},cheuf: {  required: true},mobile: {  required: true,  minlength: 10,  maxlength: 13,  digits: true},address: {  required: true,  minlength: 10,},email: {  required: true,  minlength: 6,  email: true}
        },
        messages: { quantity: {  required: "This field Cannot be empty",  digits: "The input for this field should be a number"}, pick: {  required: "This field cannot be empty",
},vcategory: {  required: "Please select a vehicle",},mobile: {  required: "Please enter your mobile number",  minlength: "Mobile number should be more than 10 characters",  maxlength: "Mobile number should be less than 13 characters",  digits: "Mobile number should contain only digits"},address: {  required: "Please enter your address",  minlength: "Address should be more than 10 characters",},email: {  required: "Please enter your email address",  minlength: "Password should be more than 6 characters",  email: "Please enter a valid email address"}
        },
    });
 </script>
 
 <script>
  $( "#form" ).validate({
    rules: {
        myselect: { required: true }
    },
	messages: { myselect: {  required: "This field Cannot be empty"}}
	
});
 </script>


