<?php	
include_once "plugins/includes/vars.php";
include_once "mis/priv.php";
			
$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$_REQUEST["PageType"]."';";
$resX1 = mysqli_query($db,$selX1);
$rwX1 = mysqli_fetch_array($resX1);	
$plugin_url = $rwX1["data"];
$addfile = "plugins/".$plugin_url."/add/add.php";

$fpadd = fopen($addfile, "r");
$sizeadd = filesize($addfile);
$arrayadd = fread($fpadd, ($sizeadd+1));
$precodeadd = htmlentities($arrayadd);
	
$defualt_text_add = "\n";
$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';

if($_REQUEST["AddPrivacy"]=="Free|Open")
{
$defualt_text_add .= " if(@privacy('Free|Open')=='Granted')";
$defualt_text_add .= "\n{";
$defualt_text_add .= "\n";
$defualt_text_add .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_add .= "\n";
$defualt_text_add .= "\n ?>";
$defualt_text_add .= $precodeadd;
$defualt_text_add .= "\n <?php";
$defualt_text_add .= "\n";
$defualt_text_add .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_add .= "\n";
$defualt_text_add .= "\n}\n";
}
elseif($_REQUEST["AddPrivacy"]=="Secure|Open")
{
$defualt_text_add .= " if(@ privacy('Secure|Open')=='Granted')";
$defualt_text_add .= "\n{";
$defualt_text_add .= "\n";
$defualt_text_add .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_add .= "\n";
$defualt_text_add .= "\n ?>";
$defualt_text_add .= $precodeadd;
$defualt_text_add .= "\n <?php";
$defualt_text_add .= "\n";
$defualt_text_add .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_add .= "\n";
$defualt_text_add .= "\n}\n";
}
elseif($_REQUEST["AddPrivacy"]=="Secure|Priv")
{
$defualt_text_add .= " if(@ privacy('Secure|Priv')=='Granted')";
$defualt_text_add .= "\n{";
$defualt_text_add .= "\n";
$defualt_text_add .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_add .= "\n";
$defualt_text_add .= "\n ?>";
$defualt_text_add .= $precodeadd;
$defualt_text_add .= "\n <?php";
$defualt_text_add .= "\n";
$defualt_text_add .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_add .= "\n";
$defualt_text_add .= "\n}\n";
}
elseif($_REQUEST["AddPrivacy"]=="Secure|Password")
{
$defualt_text_add .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
$defualt_text_add .= " echo @postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
$defualt_text_add .= " 	if(@privacy('Secure|Password')=='Granted')";
$defualt_text_add .= "\n	{";
$defualt_text_add .= "\n";
$defualt_text_add .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_add .= "\n";
$defualt_text_add .= "\n ?>";
$defualt_text_add .= $precodeadd;
$defualt_text_add .= "\n <?php";
$defualt_text_add .= "\n";
$defualt_text_add .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_add .= "\n	}";
$defualt_text_add .= "\n}\n";
}
?>