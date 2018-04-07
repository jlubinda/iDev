<?php	
$fplist = fopen("iDevTools/ultrbuilder/dbpage/list.php", "r");
$sizelist = filesize("iDevTools/ultrbuilder/dbpage/list.php");
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
$defualt_text_list .= "\n";
$defualt_text_list .= $precodelist;
$defualt_text_list .= "\n";
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
$defualt_text_list .= "\n";
$defualt_text_list .= $precodelist;
$defualt_text_list .= "\n";
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
$defualt_text_list .= "\n";
$defualt_text_list .= $precodelist;
$defualt_text_list .= "\n";
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
$defualt_text_list .= "\n";
$defualt_text_list .= $precodelist;
$defualt_text_list .= "\n";
$defualt_text_list .= "\n";
$defualt_text_list .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_list .= "\n	}";
$defualt_text_list .= "\n}\n";
}
?>