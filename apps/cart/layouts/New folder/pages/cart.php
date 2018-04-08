<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

  session_start();

  if(isset($_REQUEST['total_cart_items']))
  {
	echo count($_SESSION['cart']);
	exit();
  }

  if(isset($_POST['item_price'])) //
  {
    $_SESSION['cart'][$_POST['item_merchantID']."|".$_POST['item_pID']] = array('merchantID'=>$_POST['item_merchantID'],'name'=>$_POST['item_name'],'price'=>$_POST['item_price'],'src'=>$_POST['item_src'],'pID'=>$_POST['item_pID'],'qty'=>$_POST['item_qty'],'duration'=>$_POST['item_duration'],'unit'=>$_POST['item_unit'],'unitID'=>$_POST['item_unitID']);

    echo count($_SESSION['cart']);
    exit();
  }

  if(isset($_POST['item_idx']))
  {
	$i = $_POST['item_idx'];

	unset($_SESSION['cart'][$i]);

    echo count($_SESSION['cart']);
    exit();
  }

if(isset($_REQUEST['showcart']))
{
	echo '<form action="./?ref=cart/" method="POST">';
	echo '<input name="num" type="hidden" value="'.count($_SESSION["cart"]).'">';
	echo '<div style=" width:100%; min-width:300px; margin-left:auto; margin-right:auto;">';
		echo '<div style=" width:100%; min-width:300px; margin-left:auto; margin-right:auto;">';
		
		$totalValue = 0; 
		
		if(count($_SESSION["cart"])>=1)
		{
		  echo '<button class="cd-add-to-cart" style=" color:#000; margin:5px; padding:5px;">CHECKOUT</button>';
		}
		echo '<a class="cd-add-to-cart" onclick="show_cart();document.getElementById(&#39;id01&#39;).style.display=&#39;none&#39;" href="#" style="float:right; color:#000; margin:5px; font-size:10px;">×</a>';
		
		if(count($_SESSION["cart"])>=1)
		{
		  echo '<a class="cd-add-to-cart" onclick="clear_cart();document.getElementById(&#39;id01&#39;).style.display=&#39;none&#39;" style="float: right; color:#000; margin:5px; font-size:10px;" href="#">Clear Cart</a>';
		}
		echo "</div>";
		
		if(count($_SESSION["cart"])>=1)
		{
			$value = end ($_SESSION['cart']); 
			$i = 0;
			while ($value) 
			{ 
				//echo "<div style='  margin:5px; background-color:#fff; border-radius: 17px;' align='left'>";
				echo "<div class='cart_items' id='itemx".$i."' style=' width:300px; font-size:11px; background-color:#fff; border-radius: 2px; padding:5px; margin:5px;'>";
				echo "<img src='".$value["src"]."' style='width:70px; margin:5px;'>";
				echo "<div style='float: left'>".$value["qty"]." ".$value["name"]." for ".$value["duration"]." ".$value["unit"]."(s)<br>@ ".$value["price"]." per ".$value["unit"]."</div>";
				echo '<input name="productID'.$i.'" type="hidden" value="'.$value["pID"].'">';
				echo '<input name="img'.$i.'" type="hidden" value="'.$value["src"].'">';
				echo '<input name="price'.$i.'" type="hidden" value="'.$value["price"].'">';
				echo '<input name="merchantID'.$i.'" type="hidden" value="'.$value["merchantID"].'">';
				echo '<input name="unit'.$i.'" type="hidden" value="'.$value["unit"].'">';
				echo '<input name="unitID'.$i.'" type="hidden" value="'.$value["unitID"].'">';
				
				
				echo '<input name="qty'.$i.'" type="hidden" value="'.$value["qty"].'">';
				echo '<input name="duration'.$i.'" type="hidden" value="'.$value["duration"].'">';
				echo '<input type="hidden" id="itemx'.$i.'_idx" value="'.$value["merchantID"]."|".$value["pID"].'">';
				echo "<p align='right' style='position:relative; top:-35px;'><a onclick='remove_item(".'"'."itemx".$i."".'"'.");document.getElementById(&#39;id01&#39;).style.display=&#39;none&#39;' href='#' class='cd-add-to-cart' style=' margin-left:50px; margin-top:10px; border-radius: 5px; padding:5px; color:#000; font-size:11px; width:70px;'>Remove</a></p>";
				echo "</div>";
				//echo "</div>";
				
				$totalValue = $totalValue+($value["qty"]*$value["duration"]*$value["price"]);
				
				$value = prev($_SESSION['cart']); 
				$i=$i+1;
			}
			
			echo '<input name="totalValue" type="hidden" value="'.$totalValue.'">';
		}
		else
		{
			echo "<div style=' margin:5px; border-radius: 17px;'>THERE ARE NO ITEMS IN YOUR CART.</div>";
		}
		
		echo "<b>Total: </b>".$totalValue."</div>";
	echo "</form>";
	exit();	
}

  if(isset($_POST['clearcart']))
  {
	unset($_SESSION['cart']);
	echo 0;
    exit();	
  }
?>