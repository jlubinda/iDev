<?php
$fpview = fopen("iDevTools/ultrbuilder/dbpage/view.php", "r");
$sizeview = filesize("iDevTools/ultrbuilder/dbpage/view.php");
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
$defualt_text_view .= "\n";
$defualt_text_view .= $precodeview;
$defualt_text_view .= "\n";
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
$defualt_text_view .= "\n";
$defualt_text_view .= $precodeview;
$defualt_text_view .= "\n";
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
$defualt_text_view .= "\n";
$defualt_text_view .= $precodeview;
$defualt_text_view .= "\n";
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
$defualt_text_view .= "\n";
$defualt_text_view .= $precodeview;
$defualt_text_view .= "\n";
$defualt_text_view .= "\n";
$defualt_text_view .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_view .= "\n	}";
$defualt_text_view .= "\n}\n";
}
?>