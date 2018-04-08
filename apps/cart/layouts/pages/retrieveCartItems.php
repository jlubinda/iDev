<?php 
	
router(array("HEADER","website"),"","",'','','file','');
//include find_file("apps/cart/layouts/pages/nav.php");
echo "<h2>BOOKED VEHICLES</h2>";

if(chkSes()=="Active")
{
?>
<div style="margin:5px; padding:5px;">
	<?php 
	$value = getCartData(" WHERE Ref = '".$_REQUEST["cartRef"]."'");
			
	if($value[0]["num"]>=1)
	{
		for ($i=0; $i<$value[0]["num"]; $i++) 
		{
			if($value[$i]["pType"]=="VEHICLE")
			{	
			//echo "<div style='  margin:5px; background-color:#fff; border-radius: 17px;' align='left'>";
				echo "<div class='cart_items' id='itemx".$i."' style=' width:95%; font-size:11px; background-color:#fff; border-radius: 2px; padding:5px; margin:5px;'>";
				echo "<img src='".$value[$i]["src"]."' style='width:70px; margin:5px;'>";
				
				if($value[$i]["chauffeur"]>0)
				{
					$driver = " with a chauffeur";
				}
				else
				{
					$driver = " without a chauffeur";
				}
				
				$travel = "picking up the vehicle from ".$value[$i]["pickUpArea"]." ".$value[$i]["pickUpTown"]." at ".$value[$i]["pickUpDateTime"].", driving to ".$value[$i]["DrivingTo"]." and dropping off the vehicle in ".$value[$i]["DropOffTown"]."-".$value[$i]["DropOffCountry"]." at ".$value[$i]["DropOffDateTime"]."";
				
				echo "<div style='float: left'>".$value[$i]["qty"]." ".$value[$i]["name"]." for ".$value[$i]["duration"]." ".$value[$i]["unit"]."(s) travellers being ".$value[$i]["NoOfAdults"]." adults and ".$value[$i]["NoOfChildren"]." children".$driver.", ".$travel." <br>@Price: ".$value[$i]["currency"]."".$value[$i]["price"]." per ".$value[$i]["unit"]."</div>";
				echo "</div>";
			//echo "</div>";
			}
			else
			{
			//echo "<div style='  margin:5px; background-color:#fff; border-radius: 17px;' align='left'>";
				echo "<div class='cart_items' id='itemx".$i."' style=' width:300px; font-size:11px; background-color:#fff; border-radius: 2px; padding:5px; margin:5px;'>";
				echo "<img src='".$value[$i]["src"]."' style='width:70px; margin:5px;'>";
				echo "<div style='float: left'>".$value[$i]["qty"]." ".$value[$i]["name"]." for ".$value[$i]["duration"]." ".$value[$i]["unit"]."(s)<br>@ ".$value[$i]["currency"]."".$value[$i]["price"]." per ".$value[$i]["unit"]."</div>";
			echo "BOOKING REFERENCE NUMBER - ".$value[$i]["Ref"]."<br><a href='?ref=".$_REQUEST["ref"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&cartRef=".$value[$i]["Ref"]."&ammend=1'>AMMEND BOOKING</a>";
				echo "</div>";
			//echo "</div>";
			}
							
			$totalValue = $totalValue+($value[$i]["qty"]*$value[$i]["duration"]*$value[$i]["price"]);
		}
	}
	else
	{
		echo "<div style=' margin:5px; border-radius: 17px;'>THERE ARE NO ITEMS IN YOUR CART.</div>";
	}

	echo "<b>Total: </b>".$totalValue."</div>";
	?>
</div>
<?php
}
else
{
	include find_file("login.php");
}
	
router(array("FOOTER","website"),"","",'','','file','');
?>