<style>
.view_button{
	margin:5px; padding:5px; font-weight:bold; float: right; background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;
}
.view_button:hover{
	background-color:#84C639;
	color:#fff;
}
.like_button{
	margin:5px; padding:5px; font-weight:bold; float: right; background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;
}
.like_button:hover{
	background-color:#84C639;
	color:#fff;
}

.w3-modal{z-index:99999999;display:none;padding-top:30px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)}

.w3-modal-content{margin:auto;background-color:#fff;position:relative;padding:0;outline:0;width:600px}.w3-closebtn{text-decoration:none;float:right;font-size:24px;font-weight:bold;color:inherit}

@media (max-width:600px){.w3-modal-content{margin:0 10px;width:auto!important}.w3-modal{padding-top:30px}}
@media (max-width:768px){.w3-modal-content{width:500px}.w3-modal{padding-top:50px}}
@media (min-width:993px){.w3-modal-content{width:900px}}
</style>
<?php 
if(currentCurrency()=="USD")
{
	$chCurrency = "ZMW";
}
else
{
	$chCurrency = "USD";
}
?>
<script type="text/javascript">
    function cart_item_number()
    {
      $.ajax({
      type:'post',
      url:'./?ref=cart/add.php',
      data:{
          total_cart_items:"totalitems"
      },
      success:function(response) {
			
		   document.getElementById("total_items").value=response;
		   document.getElementById("total_items2").value=response;
			
			if(response>="1")
			{
				document.getElementById("currencyChangeForm").innerHTML = " ";
				document.getElementById("currencyChangeForm2").innerHTML = " ";
			}
			else
			{
				document.getElementById("currencyChangeForm").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
				document.getElementById("currencyChangeForm2").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
			}
      }
     });
    }
	

    function cart(id)
    {
	  var ele=document.getElementById(id);
		
		if(document.getElementById(id+"_qty").value  && document.getElementById(id+"_c_name").value && document.getElementById(id+"_pickUpArea").value && document.getElementById(id+"_pickUpTown").value && document.getElementById(id+"_pickUpDateTime").value && document.getElementById(id+"_DropOffTown").value && document.getElementById(id+"_DropOffCountry").value && document.getElementById(id+"_DropOffDateTime").value && document.getElementById(id+"_DrivingTo").value && document.getElementById(id+"_NoOfAdults").value && document.getElementById(id+"_NoOfChildren").value)
		{
		  var img_src=ele.getElementsByTagName("img")[0].src;
		  var email=document.getElementById(id+"_email").value;
		  var c_name=document.getElementById(id+"_c_name").value;
		  var name=document.getElementById(id+"_name").value;
		  var price=document.getElementById(id+"_price").value;
		  var pID=document.getElementById(id+"_pID").value;
		  var qty=document.getElementById(id+"_qty").value;
		  var duration=document.getElementById(id+"_duration").value;
		  var unit=document.getElementById(id+"_unit").value;
		  var unitID=document.getElementById(id+"_unitID").value;
		  var merchantID=document.getElementById(id+"_merchantID").value;
		  var pickUpArea=document.getElementById(id+"_pickUpArea").value;
		  var pickUpTown=document.getElementById(id+"_pickUpTown").value;
		  var pickUpDateTime=document.getElementById(id+"_pickUpDateTime").value;
		  var DropOffTown=document.getElementById(id+"_DropOffTown").value;
		  var DropOffCountry=document.getElementById(id+"_DropOffCountry").value;
		  var DropOffDateTime=document.getElementById(id+"_DropOffDateTime").value;
		  var DrivingTo=document.getElementById(id+"_DrivingTo").value;
		  var Chauffeur=document.getElementById(id+"_Chauffeur").value;
		  var NoOfAdults=document.getElementById(id+"_NoOfAdults").value;
		  var NoOfChildren=document.getElementById(id+"_NoOfChildren").value;

		  $.ajax({
			type:'post',
			url:'./?ref=cart/add.php',
			data:{
			  amend:'0',
			  item_email:email,
			  item_c_name:c_name,
			  item_src:img_src,
			  item_name:name,
			  item_price:price,
			  item_qty:qty,
			  item_duration:duration,
			  item_pID:pID,
			  item_unit:unit,
			  item_merchantID:merchantID,
			  item_unitID:unitID,
			  item_pickUpArea:pickUpArea,
			  item_pickUpTown:pickUpTown,
			  item_pickUpDateTime:pickUpDateTime,
			  item_DropOffCountry:DropOffCountry,
			  item_DrivingTo:DrivingTo,
			  item_DropOffDateTime:DropOffDateTime,
			  item_DropOffTown:DropOffTown,
			  item_Chauffeur:Chauffeur,
			  item_NoOfAdults:NoOfAdults,
			  item_NoOfChildren:NoOfChildren
			},
			success:function(response) {
			   document.getElementById("total_items").value=response;
			   document.getElementById("total_items2").value=response;
			   	
		Materialize.toast('<span>Item added to cart </span><a class=&quot;btn-flat yellow-text&quot; href=?ref=accessories.html> <a>', 5000);
		
				if(response>="1")
				{
					document.getElementById("currencyChangeForm").innerHTML = " ";
					document.getElementById("currencyChangeForm2").innerHTML = " ";
				}
				else
				{
					document.getElementById("currencyChangeForm").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
					document.getElementById("currencyChangeForm2").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
				}
			}
		  });
		}
		else
		{
			
			
		Materialize.toast('<span>Please ensure all fields are filled in</span><a class=&quot;btn-flat yellow-text&quot; href=?ref=accessories.html> <a>', 5000);
			
		

		}
		
		
		
		
		
    }


    function show_cart()
    {
      $.ajax({
      type:'post',
      url:'./?ref=cart/add.php',
      data:{
        showcart:"cart"
      },
      success:function(response) {
        document.getElementById("mycart").innerHTML=response;
       // $("#mycart").slideToggle();
      }
     });
    }

    function remove_item(id)
    {
	  var ele=document.getElementById(id);
	  var idx=document.getElementById(id+"_idx").value;
	
	  $.ajax({
        type:'post',
        url:'./?ref=cart/add.php',
        data:{
          item_idx:idx
        },
        success:function(response) {
			
		   document.getElementById("total_items").value=response;
		   document.getElementById("total_items2").value=response;
			
			if(response>="1")
			{
				document.getElementById("currencyChangeForm").innerHTML = " ";
				document.getElementById("currencyChangeForm2").innerHTML = " ";
			}
			else
			{
				document.getElementById("currencyChangeForm").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
				document.getElementById("currencyChangeForm2").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
			}
        //$("#mycart").slideToggle();
        }
      });
    }

    function amend_booking(id)
    {
	  var ele=document.getElementById(id);
		
		if(document.getElementById(id+"_qty").value && document.getElementById(id+"_c_name").value && document.getElementById(id+"_pickUpArea").value && document.getElementById(id+"_pickUpTown").value && document.getElementById(id+"_pickUpDateTime").value && document.getElementById(id+"_DropOffTown").value && document.getElementById(id+"_DropOffCountry").value && document.getElementById(id+"_DropOffDateTime").value && document.getElementById(id+"_DrivingTo").value && document.getElementById(id+"_NoOfAdults").value && document.getElementById(id+"_NoOfChildren").value)
		{
		  var img_src=ele.getElementsByTagName("img")[0].src;
		  var email=document.getElementById(id+"_email").value;
		 var c_name=document.getElementById(id+"_c_name").value;
		  var name=document.getElementById(id+"_name").value;
		  var price=document.getElementById(id+"_price").value;
		  var pID=document.getElementById(id+"_pID").value;
		  var qty=document.getElementById(id+"_qty").value;
		  var duration=document.getElementById(id+"_duration").value;
		  var unit=document.getElementById(id+"_unit").value;
		  var unitID=document.getElementById(id+"_unitID").value;
		  var merchantID=document.getElementById(id+"_merchantID").value;
		  var pickUpArea=document.getElementById(id+"_pickUpArea").value;
		  var pickUpTown=document.getElementById(id+"_pickUpTown").value;
		  var pickUpDateTime=document.getElementById(id+"_pickUpDateTime").value;
		  var DropOffTown=document.getElementById(id+"_DropOffTown").value;
		  var DropOffCountry=document.getElementById(id+"_DropOffCountry").value;
		  var DropOffDateTime=document.getElementById(id+"_DropOffDateTime").value;
		  var DrivingTo=document.getElementById(id+"_DrivingTo").value;
		  var Chauffeur=document.getElementById(id+"_Chauffeur").value;
		  var NoOfAdults=document.getElementById(id+"_NoOfAdults").value;
		  var NoOfChildren=document.getElementById(id+"_NoOfChildren").value;
		  var item_num=document.getElementById(id+"_cnum").value;

		  
		    
		  
		  
		  $.ajax({
			type:'post',
			url:'./?ref=cart/add.php',
			data:{
			  amend:'1',
			  item_email:email,
			  item_c_name:c_name,
			  item_num:item_num,
			  item_src:img_src,
			  item_name:name,
			  item_price:price,
			  item_qty:qty,
			  item_duration:duration,
			  item_pID:pID,
			  item_unit:unit,
			  item_merchantID:merchantID,
			  item_unitID:unitID,
			  item_pickUpArea:pickUpArea,
			  item_pickUpTown:pickUpTown,
			  item_pickUpDateTime:pickUpDateTime,
			  item_DropOffCountry:DropOffCountry,
			  item_DrivingTo:DrivingTo,
			  item_DropOffDateTime:DropOffDateTime,
			  item_DropOffTown:DropOffTown,
			  item_Chauffeur:Chauffeur,
			  item_NoOfAdults:NoOfAdults,
			  item_NoOfChildren:NoOfChildren
			},
			success:function(response) {
				
			   document.getElementById("total_items").value=response;
			   document.getElementById("total_items2").value=response;
			   
			}
		  });
		}
		else
		{
		   document.getElementById("total_items").value="MISSING DETAILS";
		   document.getElementById("total_items2").value="MISSING DETAILS";
		}
    }

    function clear_cart()
    {
      $.ajax({
      type:'post',
      url:'./?ref=cart/add.php',
      data:{
        clearcart:"cart"
      },
      success:function(response) {
			
		   document.getElementById("total_items").value=response;
		   document.getElementById("total_items2").value=response;
			
			if(response>="1")
			{
				document.getElementById("currencyChangeForm").innerHTML = " ";
				document.getElementById("currencyChangeForm2").innerHTML = " ";
			}
			else
			{
				document.getElementById("currencyChangeForm").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
				document.getElementById("currencyChangeForm2").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
			}
        //$("#mycart").slideToggle();
      }
     });
    }
	
	
	$(document).ready(function(){
	$.ajax({ url:'./?ref=cart/add.php',
		data:{
		  total_cart_items:"totalitems"
		},
		context: document.body,
		success: function(response){
			
		   document.getElementById("total_items").value=response;
		   document.getElementById("total_items2").value=response;
			
			if(response>="1")
			{
				document.getElementById("currencyChangeForm").innerHTML = " ";
				document.getElementById("currencyChangeForm2").innerHTML = " ";
			}
			else
			{
				document.getElementById("currencyChangeForm").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
				document.getElementById("currencyChangeForm2").innerHTML = "<input type='submit' name='changeCurrency' value='CHANGE TO <?php echo $chCurrency; ?>' style='background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;'>";
			}
		}});
	});
	
	
	$(document).ready(function(){
	$.ajax({ url:'./?ref=cart/add.php',
		data:{
		  show_currency:"currency"
		},
		context: document.body,
		success: function(response){
		   document.getElementById("currency").value=response;
		   document.getElementById("currency2").value=response;
		}});
	});	
	
	$(".imageToBeSwapped").on('change', function(){
		$("#imageToSwap").attr("src", $(this).find(":selected").attr("data-src"));
	});
</script>

<script>
	
$.fn.disableFor = function (time) {
    var el = this, qname = 'disqueue';
    el.queue(qname, function () {
        el.attr('disabled', 'disabled');
        setTimeout( function () {
            el.dequeue(qname);
        }, time);
    })
    .queue(qname, function () {
        el.removeAttr('disabled');
    })
    .dequeue(qname);
};

$('#pdf').click( function () {
    $(this).disableFor(5000);
});
</script>

<script> 
 function Debounce()
{

    var self = this
    if (this.clicked) return false;

    this.clicked = true;
    setTimeout(function() {self.clicked = false;}, 10000);

    return true;
}
</script>