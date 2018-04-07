<?php
$fpsetup = fopen("iDevTools/ultrbuilder/dbpage/setup.php", "r");
$sizesetup = filesize("iDevTools/ultrbuilder/dbpage/setup.php");
$arraysetup = fread($fpsetup, ($sizesetup+1));
$precodesetup = htmlentities($arraysetup);

$defualt_text_setup = "\n";
$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';

if($_REQUEST["SetupPrivacy"]=="Free|Open")
{
$defualt_text_setup .= " if(@privacy('Free|Open')=='Granted')";
$defualt_text_setup .= "\n{";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n";
$defualt_text_setup .= $precodesetup;
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n}\n";
}
elseif($_REQUEST["SetupPrivacy"]=="Secure|Open")
{
$defualt_text_setup .= " if(@ privacy('Secure|Open')=='Granted')";
$defualt_text_setup .= "\n{";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n";
$defualt_text_setup .= $precodesetup;
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "//END YOUR CODE ABOVE THIS LINE";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n}\n";
}
elseif($_REQUEST["SetupPrivacy"]=="Secure|Priv")
{
$defualt_text_setup .= " if(@ privacy('Secure|Priv')=='Granted')";
$defualt_text_setup .= "\n{";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n";
$defualt_text_setup .= $precodesetup;
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n}\n";
}
elseif($_REQUEST["SetupPrivacy"]=="Secure|Password")
{
$defualt_text_setup .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
$defualt_text_setup .= " echo @postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
$defualt_text_setup .= " 	if(@privacy('Secure|Password')=='Granted')";
$defualt_text_setup .= "\n	{";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "//START YOUR CODE BELOW THIS LINE";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n";
$defualt_text_setup .= $precodesetup;
$defualt_text_setup .= "\n";
$defualt_text_setup .= "\n";
$defualt_text_setup .= "//END YOUR CODE ABOVE THIS LINE";	
$defualt_text_setup .= "\n	}";
$defualt_text_setup .= "\n}\n";
}
?>