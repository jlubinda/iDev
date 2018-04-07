<?php
include_once "plugins/includes/vars.php";
include_once "mis/priv.php";
			
$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$_REQUEST["PageType"]."';";
$resX1 = mysqli_query($db,$selX1);
$rwX1 = mysqli_fetch_array($resX1);	
$plugin_url = $rwX1["data"];
$deletefile = "plugins/".$plugin_url."/delete/delete.php";

$fpdelete = fopen($deletefile, "r");
$sizedelete = filesize($deletefile);
$arraydelete = fread($fpdelete, ($sizedelete+1));
$precodedelete = htmlentities($arraydelete);

$defualt_text_delete = "\n";
$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';

if($_REQUEST["DeletePrivacy"]=="Free|Open")
{
$defualt_text_delete .= " if(@privacy('Free|Open')=='Granted')";
$defualt_text_delete .= "\n{";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "\n ?>";
$defualt_text_delete .= $precodedelete;
$defualt_text_delete .= "\n <?php";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "\n}\n";
}
elseif($_REQUEST["DeletePrivacy"]=="Secure|Open")
{
$defualt_text_delete .= " if(@ privacy('Secure|Open')=='Granted')";
$defualt_text_delete .= "\n{";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "\n ?>";
$defualt_text_delete .= $precodedelete;
$defualt_text_delete .= "\n <?php";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "\n}\n";
}
elseif($_REQUEST["DeletePrivacy"]=="Secure|Priv")
{
$defualt_text_delete .= " if(@ privacy('Secure|Priv')=='Granted')";
$defualt_text_delete .= "\n{";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "\n ?>";
$defualt_text_delete .= $precodedelete;
$defualt_text_delete .= "\n <?php";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_delete .= "\n";
$defualt_text_delete .= "\n}\n";
}
elseif($_REQUEST["DeletePrivacy"]=="Secure|Password")
{
$defualt_text_delete .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
$defualt_text_delete .= " echo @postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
$defualt_text_delete .= " 	if(@privacy('Secure|Password')=='Granted')";
$defualt_text_delete .= "\n	{";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "\n ?>";
$defualt_text_delete .= $precodedelete;
$defualt_text_delete .= "\n <?php";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_delete .= "\n	}";
$defualt_text_delete .= "\n}\n";
}
?>