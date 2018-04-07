<?php 

	$refx = explode("/",$_REQUEST["ref"]);
	$ref = $refx[1];
	
	if($ref=="createtour.php" || $ref=="createtour")
	{	
		include "tourcreator.php";
	}
	elseif($ref=="listtours.php" || $ref=="listtours")
	{	
		include "mytours.php";
	}
	elseif($ref=="createtourcategory.php" || $ref=="createtourcategory")
	{	
		include "tourcategorycreator.php";
	}
	elseif($ref=="listtourcategories.php" || $ref=="listtourcategories")
	{
		include "mytourcategories.php";
	}
	elseif($ref=="setuptours.php" || $ref=="setuptours")
	{
		include "toursetup.php";
	}

?>