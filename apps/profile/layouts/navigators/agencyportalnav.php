<?php 

if($_REQUEST["unit"]=="" && $_REQUEST["function"]=="")
{
	$cssStyle1 = " font-weight: bold; color:#000;";
	$cssStyle2 = "";
	$cssStyle3 = "";
	$cssStyle4 = "";
	$cssStyle5 = "";
}
elseif($_REQUEST["unit"]=="2" && $_REQUEST["function"]=="")
{
	$cssStyle1 = "";
	$cssStyle2 = " font-weight: bold; color:#000;";
	$cssStyle3 = "";
	$cssStyle4 = "";
	$cssStyle5 = "";
}
elseif($_REQUEST["unit"]=="3" && $_REQUEST["function"]=="")
{
	$cssStyle1 = "";
	$cssStyle2 = "";
	$cssStyle3 = " font-weight: bold; color:#000;";
	$cssStyle4 = "";
	$cssStyle5 = "";
}
elseif($_REQUEST["unit"]=="4" && $_REQUEST["function"]=="")
{
	$cssStyle1 = "";
	$cssStyle2 = "";
	$cssStyle3 = "";
	$cssStyle4 = " font-weight: bold; color:#000;";
	$cssStyle5 = "";
}
elseif($_REQUEST["unit"]=="5" && $_REQUEST["function"]=="")
{
	$cssStyle1 = "";
	$cssStyle2 = "";
	$cssStyle3 = "";
	$cssStyle4 = "";
	$cssStyle5 = " font-weight: bold; color:#000;";
}
?>
<a href="./?ref=<?php echo $_REQUEST["ref"];?>&function=&unit=&vCode=<?php echo $_REQUEST["vCode"];?>" style=" margin:5px; font-size:11px; <?php echo $cssStyle1;?>">CONFIRM CODE</a>
<a href="./?ref=<?php echo $_REQUEST["ref"];?>&function=&unit=2&vCode=<?php echo $_REQUEST["vCode"];?>" style=" margin:5px; font-size:11px; <?php echo $cssStyle2;?>">NOTICES</a><?php /*
<a href="./?ref=<?php echo $_REQUEST["ref"];?>&function=&unit=3&vCode=<?php echo $_REQUEST["vCode"];?>" style=" margin:5px; font-size:11px; <?php echo $cssStyle3;?>">INFORMATION CENTER</a>*/?>
<a href="./?ref=<?php echo $_REQUEST["ref"];?>&function=&unit=4&vCode=<?php echo $_REQUEST["vCode"];?>" style=" margin:5px; font-size:11px; <?php echo $cssStyle4;?>">BECOME AN AGENT</a>