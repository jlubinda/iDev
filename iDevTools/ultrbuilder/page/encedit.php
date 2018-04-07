<?php	
include_once "plugins/includes/vars.php";
include_once "mis/priv.php";
			
$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$_REQUEST["PageType"]."';";
$resX1 = mysqli_query($db,$selX1);
$rwX1 = mysqli_fetch_array($resX1);	
$plugin_url = $rwX1["data"];
$editfile = "plugins/".$plugin_url."/edit/edit.php";

$fpedit = fopen($editfile, "r");
$sizeedit = filesize($editfile);
$arrayedit = fread($fpedit, ($sizeedit+1));
$precodeedit = htmlentities($arrayedit);
	
$defualt_text_edit = "\n";
$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';

if($_REQUEST["EditPrivacy"]=="Free|Open")
{
$defualt_text_edit .= " if(@privacy('Free|Open')=='Granted')";
$defualt_text_edit .= "\n{";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "\n ?>";
$defualt_text_edit .= $precodeedit;
$defualt_text_edit .= "\n <?php";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "\n}\n";
}
elseif($_REQUEST["EditPrivacy"]=="Secure|Open")
{
$defualt_text_edit .= " if(@ privacy('Secure|Open')=='Granted')";
$defualt_text_edit .= "\n{";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "\n ?>";
$defualt_text_edit .= $precodeedit;
$defualt_text_edit .= "\n <?php";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "\n}\n";
}
elseif($_REQUEST["EditPrivacy"]=="Secure|Priv")
{
$defualt_text_edit .= " if(@ privacy('Secure|Priv')=='Granted')";
$defualt_text_edit .= "\n{";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "\n ?>";
$defualt_text_edit .= $precodeedit;
$defualt_text_edit .= "\n <?php";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_edit .= "\n";
$defualt_text_edit .= "\n}\n";
}
elseif($_REQUEST["EditPrivacy"]=="Secure|Password")
{
$defualt_text_edit .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
$defualt_text_edit .= " echo @postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
$defualt_text_edit .= " 	if(@privacy('Secure|Password')=='Granted')";
$defualt_text_edit .= "\n	{";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "\n ?>";
$defualt_text_edit .= $precodeedit;
$defualt_text_edit .= "\n <?php";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_edit .= "\n	}";
$defualt_text_edit .= "\n}\n";
}
?>