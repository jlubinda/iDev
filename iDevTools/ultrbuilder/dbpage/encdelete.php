<?php
$fpdelete = fopen("iDevTools/ultrbuilder/dbpage/delete.php", "r");
$sizedelete = filesize("iDevTools/ultrbuilder/dbpage/delete.php");
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
$defualt_text_delete .= "\n";
$defualt_text_delete .= $precodedelete;
$defualt_text_delete .= "\n";
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
$defualt_text_delete .= "\n";
$defualt_text_delete .= $precodedelete;
$defualt_text_delete .= "\n";
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
$defualt_text_delete .= "\n";
$defualt_text_delete .= $precodedelete;
$defualt_text_delete .= "\n";
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
$defualt_text_delete .= "\n";
$defualt_text_delete .= $precodedelete;
$defualt_text_delete .= "\n";
$defualt_text_delete .= "\n";
$defualt_text_delete .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_delete .= "\n	}";
$defualt_text_delete .= "\n}\n";
}
?>