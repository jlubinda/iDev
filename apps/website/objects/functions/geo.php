<?php 
if(function_exists('currentCurrency'))
{
	
}
else
{
	function currentCurrency(){
		if(isset($_SESSION['currency']) && !($_SESSION['currency']==""))
		{
			return $_SESSION['currency'];
		}
		else
		{
			return "USD";
		}
	}
}
?>