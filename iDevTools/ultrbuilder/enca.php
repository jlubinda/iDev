<?php	
$defualt_text = "\n";
$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';
$userBarVar = '$'.'UserBarData';
$UserBar = "";
$UserBar .= "UserBar(".$userBarVar.")";

if($_REQUEST["segment"]=="f1")
{
	$UserBarArray = "";
	for($f=1; $f<($_REQUEST["numSidebar"])+1; $f++)
	{
		if($_REQUEST["selectSidebar".$f]=="Yes")
		{
			$dd = $_REQUEST["orderSidebar".$f];
			$UserBarArray .= $_REQUEST["codeSidebar".$dd];
			
			if($f==$_REQUEST["numSidebar"])
			{
				$UserBarArray .= "";
			}
			else
			{
				$UserBarArray .= "|";
			}
		}
	}	

$precode .= $userBarVar." = ".$UserBarArray;
$precode .= "\n";
$precode .= "echo '<div id=".'"sidebar"'.">';";
$precode .= "\n";
$precode .= "	echo '<div id=".'"AdminSideBar"'.">'.AdminSideBar(".$requ3.",".$requ4.").'</div>';";
$precode .= "\n";
$precode .= "	echo '<div id=".'"UserSideBar"'.">'.".$UserBar.".'</div>';";
$precode .= "\n";
$precode .= "echo '</div>';";
}

	$defualt_text .= "\n";
	
if($_REQUEST["PageType"]=="Master File")
{
	if($_REQUEST["Privacy"]=="Free|Open")
	{
	$defualt_text .= " if(@privacy('Free|Open')=='Granted')";
	$defualt_text .= "\n{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) ABOVE THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= $precode;
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "subPages(".$requ3.",".$requ4.");";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) ABOVE THIS LINE";	
	$defualt_text .= "\n";
	$defualt_text .= "\n}";
	}
	elseif($_REQUEST["Privacy"]=="Secure|Open")
	{
	$defualt_text .= " if(@ privacy('Secure|Open')=='Granted')";
	$defualt_text .= "\n{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) ABOVE THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= $precode;
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "subPages(".$requ3.",".$requ4.");";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) ABOVE THIS LINE";	
	$defualt_text .= "\n";
	$defualt_text .= "\n}";
	}
	elseif($_REQUEST["Privacy"]=="Secure|Priv")
	{
	$defualt_text .= " if(@ privacy('Secure|Priv')=='Granted')";
	$defualt_text .= "\n{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) ABOVE THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= $precode;
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "subPages(".$requ3.",".$requ4.");";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) ABOVE THIS LINE";	
	$defualt_text .= "\n";
	$defualt_text .= "\n}";
	}
	elseif($_REQUEST["Privacy"]=="Secure|Password")
	{
	$defualt_text .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
	$defualt_text .= " echo @postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
	$defualt_text .= " 	if(@privacy('Secure|Password')=='Granted')";
	$defualt_text .= "\n	{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) ABOVE THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= $precode;
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "subPages(".$requ3.",".$requ4.");";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) ABOVE THIS LINE";	
	$defualt_text .= "\n	}";
	$defualt_text .= "\n}\n";
	}
}
else
{
	if($_REQUEST["Privacy"]=="Free|Open")
	{
	$defualt_text .= " if(@privacy('Free|Open')=='Granted')";
	$defualt_text .= "\n{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= $precode;
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE ABOVE THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n}\n";
	}
	elseif($_REQUEST["Privacy"]=="Secure|Open")
	{
	$defualt_text .= " if(@ privacy('Secure|Open')=='Granted')";
	$defualt_text .= "\n{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= $precode;
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE ABOVE THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n}\n";
	}
	elseif($_REQUEST["Privacy"]=="Secure|Priv")
	{
	$defualt_text .= " if(@ privacy('Secure|Priv')=='Granted')";
	$defualt_text .= "\n{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= $precode;
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE ABOVE THIS LINE";	
	$defualt_text .= "\n";
	$defualt_text .= "\n}\n";
	}
	elseif($_REQUEST["Privacy"]=="Secure|Password")
	{
	$defualt_text .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
	$defualt_text .= " echo @postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
	$defualt_text .= " 	if(@privacy('Secure|Password')=='Granted')";
	$defualt_text .= "\n	{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= $precode;
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE ABOVE THIS LINE";	
	$defualt_text .= "\n	}";
	$defualt_text .= "\n}\n";
	}
}
$defualt_text .= "\n \n";
?>