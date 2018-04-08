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

.w3-modal{z-index:99999999;display:none;padding-top:150px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)}

.w3-modal-content{margin:auto;background-color:#fff;position:relative;padding:0;outline:0;width:600px}.w3-closebtn{text-decoration:none;float:right;font-size:24px;font-weight:bold;color:inherit}

@media (max-width:600px){.w3-modal-content{margin:0 10px;width:auto!important}.w3-modal{padding-top:30px}}
@media (max-width:768px){.w3-modal-content{width:500px}.w3-modal{padding-top:50px}}
@media (min-width:993px){.w3-modal-content{width:900px}}
</style>

<script type="text/javascript">

    $(document).ready(function(){

      $.ajax({
        type:'post',
        url:'./?ref=cart/add.php',
        data:{
          total_cart_items:"totalitems"
        },
        success:function(response) {
          document.getElementById("total_items").value=response;
        }
      });

    });


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
      }
     });
    }
	

    function cart(id)
    {
	  var ele=document.getElementById(id);
	  var img_src=ele.getElementsByTagName("img")[0].src;
	  var name=document.getElementById(id+"_name").value;
	  var price=document.getElementById(id+"_price").value;
	  var pID=document.getElementById(id+"_pID").value;
	  var qty=document.getElementById(id+"_qty").value;
	  var duration=document.getElementById(id+"_duration").value;
	  var unit=document.getElementById(id+"_unit").value;
	  var unitID=document.getElementById(id+"_unitID").value;
	  var merchantID=document.getElementById(id+"_merchantID").value;

	  $.ajax({
        type:'post',
        url:'./?ref=cart/add.php',
        data:{
          item_src:img_src,
          item_name:name,
          item_price:price,
          item_qty:qty,
          item_duration:duration,
          item_pID:pID,
          item_unit:unit,
		  item_merchantID:merchantID,
          item_unitID:unitID
        },
        success:function(response) {
          document.getElementById("total_items").value=response;
        }
      });
	
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
        //$("#mycart").slideToggle();
        }
      });
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
        //$("#mycart").slideToggle();
      }
     });
    }
	
</script>