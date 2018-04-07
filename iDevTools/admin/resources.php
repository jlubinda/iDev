<?php
 if(chkSes()=="Inactive")
{

} 
else 
{

	if($bx_permissions=="Yes")
	{
	echo "<br>";
	
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="a1")
		{
		echo "<p align='center'><iframe src='inf.php?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."' width='99%' height='400'></iframe>";
		
		echo "</p>";
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="a1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="2" && !$_REQUEST['submitBtn'] && $_REQUEST["typeID"])
		{
		}
	}
	else
	{
	include_once "mis/access_denied.php";
	}
}

?>