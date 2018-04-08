<?php
if(function_exists('cartListedItem'))
{
	
}
else
{
	function cartListedItem($type="ALL",$merchantID,$productname,$productID,$price,$unit,$unitID,$url,$url_class,$url_id,$s,$email="",$price_oot="",$price_ooc=""){
		
		if($type=="MIN")
		{
			include find_file("apps/cart/layouts/pages/listeditem2.php");
		}
		elseif($type=="ALL")
		{
			include find_file("apps/cart/layouts/pages/listeditem.php");
		}
		elseif($type=="TIME ONLY")
		{
			include find_file("apps/cart/layouts/pages/listeditem3.php");
		}
		elseif($type=="MAIN")
		{
			include find_file("apps/cart/layouts/pages/listeditem4.php");
		}
	}
}


if(function_exists('cartIcon2'))
{
	
}
else
{
	function cartIcon2(){
		include find_file("apps/cart/layouts/pages/cartIcon2.php");
	}
}


if(function_exists('cartIcon'))
{
	
}
else
{
	function cartIcon(){
		include find_file("apps/cart/layouts/pages/cartIcon.php");
	}
}








if(function_exists('cartDiv'))
{
	
}
else
{
	function cartDiv($width="",$bgcolor="",$color=""){
		include find_file("apps/cart/layouts/pages/cartDiv.php");
	}
}


if(function_exists('cartScripts'))
{
	
}
else
{
	function cartScripts(){
		include find_file("apps/cart/layouts/pages/scripts.php");
	}
}


if(function_exists('bookNowBtn'))
{
	
}
else
{
	function bookNowBtn($productnamex,$productID,$price,$img,$s,$buttonText="BOOK NOW",$typeXx="ALL",$email=""){	
		
		if($productnamex=="TBA")
		{
			if($productID=="TBA")
			{
				$typeX = "MAIN";
				$productname = $productnamex;
			}
			else
			{
				$typeX = $typeXx;
				$productname = getVehicleCategory($productID);
			}
		}
		else
		{
			$typeX = $typeXx;
			$productname = $productnamex;
		}
		
		include find_file("apps/cart/layouts/pages/booknowBtn.php");
	}
}


if(function_exists('bookNowBtn2'))
{
	
}
else
{
	function bookNowBtn2($productnamex,$productID,$price,$img,$s,$buttonText="BOOK NOW",$email=""){
		
		if($productnamex=="TBA")
		{
			$productname = getVehicleCategory(getCatIDFromCode($productID));
		}
		else
		{
			$productname = $productnamex;
		}
		
		include find_file("apps/cart/layouts/pages/booknowBtn2.php");
	}
}
?>