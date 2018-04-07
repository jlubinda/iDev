<?php
include_once "plugins/includes/vars.php";
include_once "mis/priv.php";
			
$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$_REQUEST["PageType"]."';";
$resX1 = mysqli_query($db,$selX1);
$rwX1 = mysqli_fetch_array($resX1);	
$plugin_url = $rwX1["data"];
$viewfile = "plugins/".$plugin_url."/view/view.php";			

$fpview = fopen($viewfile, "r");
$sizeview = filesize($viewfile);
$arrayview = fread($fpview, ($sizeview+1));
$precodeview = htmlentities($arrayview);
	
$defualt_text_view = "\n";
$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';

if($_REQUEST["ViewPrivacy"]=="Free|Open")
{
$defualt_text_view .= " if(@privacy('Free|Open')=='Granted')";
$defualt_text_view .= "\n{";
$defualt_text_view .= "\n";
$defualt_text_view .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_view .= "\n";
$defualt_text_view .= "\n ?>";
$defualt_text_view .= $precodeview;
$defualt_text_view .= "\n <?php";
$defualt_text_view .= "\n";
$defualt_text_view .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_view .= "\n";
$defualt_text_view .= "\n}\n";
}
elseif($_REQUEST["ViewPrivacy"]=="Secure|Open")
{
$defualt_text_view .= " if(@ privacy('Secure|Open')=='Granted')";
$defualt_text_view .= "\n{";
$defualt_text_view .= "\n";
$defualt_text_view .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_view .= "\n";
$defualt_text_view .= "\n ?>";
$defualt_text_view .= $precodeview;
$defualt_text_view .= "\n <?php";
$defualt_text_view .= "\n";
$defualt_text_view .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_view .= "\n";
$defualt_text_view .= "\n}\n";
}
elseif($_REQUEST["ViewPrivacy"]=="Secure|Priv")
{
$defualt_text_view .= " if(@ privacy('Secure|Priv')=='Granted')";
$defualt_text_view .= "\n{";
$defualt_text_view .= "\n";
$defualt_text_view .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_view .= "\n";
$defualt_text_view .= "\n ?>";
$defualt_text_view .= $precodeview;
$defualt_text_view .= "\n <?php";
$defualt_text_view .= "\n";
$defualt_text_view .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_view .= "\n";
$defualt_text_view .= "\n}\n";
}
elseif($_REQUEST["ViewPrivacy"]=="Secure|Password")
{
$defualt_text_view .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
$defualt_text_view .= " echo @postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
$defualt_text_view .= " 	if(@privacy('Secure|Password')=='Granted')";
$defualt_text_view .= "\n	{";
$defualt_text_view .= "\n";
$defualt_text_view .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_view .= "\n";
$defualt_text_view .= "\n ?>";
$defualt_text_view .= $precodeview;
$defualt_text_view .= "\n <?php";
$defualt_text_view .= "\n";
$defualt_text_view .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_view .= "\n	}";
$defualt_text_view .= "\n}\n";
}
?>