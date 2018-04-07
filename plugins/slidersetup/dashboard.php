<?php 

	$refx = explode("/",$_REQUEST["ref"]);
	$ref = $refx[1];
	
	if($ref=="bookmytour.php" || $ref=="bookmytour")
	{	
		include "booktours.php";
	}
	elseif($ref=="showmytours.php" || $ref=="showmytours")
	{
		include "mybookedtours.php";
	}

?>