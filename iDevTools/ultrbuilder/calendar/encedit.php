<?php	
$fpedit = fopen("iDevTools/ultrbuilder/calendar/edit.php", "r");
$sizeedit = filesize("iDevTools/ultrbuilder/calendar/edit.php");
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
$defualt_text_edit .= "\n";
$defualt_text_edit .= $precodeedit;
$defualt_text_edit .= "\n";
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
$defualt_text_edit .= "\n";
$defualt_text_edit .= $precodeedit;
$defualt_text_edit .= "\n";
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
$defualt_text_edit .= "\n";
$defualt_text_edit .= $precodeedit;
$defualt_text_edit .= "\n";
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
$defualt_text_edit .= "\n";
$defualt_text_edit .= $precodeedit;
$defualt_text_edit .= "\n";
$defualt_text_edit .= "\n";
$defualt_text_edit .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_edit .= "\n	}";
$defualt_text_edit .= "\n}\n";
}
?>