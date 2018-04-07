<?php	
include_once "plugins/includes/vars.php";
include_once "mis/priv.php";
			
$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$_REQUEST["PageType"]."';";
$resX1 = mysqli_query($db,$selX1);
$rwX1 = mysqli_fetch_array($resX1);	
$plugin_url = $rwX1["data"];
$listfile = "plugins/".$plugin_url."/list/list.php";

$fplist = fopen($listfile, "r");
$sizelist = filesize($listfile);
$arraylist = fread($fplist, ($sizelist+1));
$precodelist = htmlentities($arraylist);
	
$defualt_text_list = "\n";
$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';

if($_REQUEST["ListPrivacy"]=="Free|Open")
{
$defualt_text_list .= " if(@privacy('Free|Open')=='Granted')";
$defualt_text_list .= "\n{";
$defualt_text_list .= "\n";
$defualt_text_list .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_list .= "\n";
$defualt_text_list .= "\n ?>";
$defualt_text_list .= $precodelist;
$defualt_text_list .= "\n <?php";
$defualt_text_list .= "\n";
$defualt_text_list .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_list .= "\n";
$defualt_text_list .= "\n}\n";
}
elseif($_REQUEST["ListPrivacy"]=="Secure|Open")
{
$defualt_text_list .= " if(@ privacy('Secure|Open')=='Granted')";
$defualt_text_list .= "\n{";
$defualt_text_list .= "\n";
$defualt_text_list .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_list .= "\n";
$defualt_text_list .= "\n ?>";
$defualt_text_list .= $precodelist;
$defualt_text_list .= "\n <?php";
$defualt_text_list .= "\n";
$defualt_text_list .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_list .= "\n";
$defualt_text_list .= "\n}\n";
}
elseif($_REQUEST["ListPrivacy"]=="Secure|Priv")
{
$defualt_text_list .= " if(@ privacy('Secure|Priv')=='Granted')";
$defualt_text_list .= "\n{";
$defualt_text_list .= "\n";
$defualt_text_list .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_list .= "\n";
$defualt_text_list .= "\n ?>";
$defualt_text_list .= $precodelist;
$defualt_text_list .= "\n <?php";
$defualt_text_list .= "\n";
$defualt_text_list .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_list .= "\n";
$defualt_text_list .= "\n}\n";
}
elseif($_REQUEST["ListPrivacy"]=="Secure|Password")
{
$defualt_text_list .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
$defualt_text_list .= " echo @postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
$defualt_text_list .= " 	if(@privacy('Secure|Password')=='Granted')";
$defualt_text_list .= "\n	{";
$defualt_text_list .= "\n";
$defualt_text_list .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_list .= "\n";
$defualt_text_list .= "\n ?>";
$defualt_text_list .= $precodelist;
$defualt_text_list .= "\n <?php";
$defualt_text_list .= "\n";
$defualt_text_list .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_list .= "\n	}";
$defualt_text_list .= "\n}\n";
}
?>