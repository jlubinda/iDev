<?php	
$fpadd = fopen("iDevTools/ultrbuilder/slider/add.php", "r");
$sizeadd = filesize("iDevTools/ultrbuilder/slider/add.php");
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
$defualt_text_add .= "\n";
$defualt_text_add .= $precodeadd;
$defualt_text_add .= "\n";
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
$defualt_text_add .= "\n";
$defualt_text_add .= $precodeadd;
$defualt_text_add .= "\n";
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
$defualt_text_add .= "\n";
$defualt_text_add .= $precodeadd;
$defualt_text_add .= "\n";
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
$defualt_text_add .= "\n";
$defualt_text_add .= $precodeadd;
$defualt_text_add .= "\n";
$defualt_text_add .= "\n";
$defualt_text_add .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_add .= "\n	}";
$defualt_text_add .= "\n}\n";
}
?>