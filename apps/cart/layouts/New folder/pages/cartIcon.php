<label style="margin-top:2px;">
<?php 
if(chkSes()=="Active")
{
	?>
		<p id="cart_button" style="" onclick="show_cart();document.getElementById(&#39;id01&#39;).style.display=&#39;block&#39;" class="w3-btn w3-large">
		  <img src="apps/cart/resources/images/cart.png" style="width:35px; height:35px; position:relative; top:0px;">
		  <input type="button" id="total_items" value="" style="background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;">
		</p>
	<?php 
}
?>
</label>