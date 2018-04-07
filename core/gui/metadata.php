<?php	

if(function_exists('metadata'))
{
	
}
else
{
	function metadata(){
		echo "\n".'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
		echo "\n".'<meta name="author" content="Trinity Systems Limited" />';
		echo "\n"."<link rel='icon' href='"."images/".iDevSite("FALCON")."' type='image/x-icon' />";
		echo "\n"."<link rel='shortcut icon' href='"."images/".iDevSite("FALCON")."' type='image/x-icon' />";
		echo "\n".'<title>'.iDevSite("TITLE").'</title>';
		if($_REQUEST["extn"]==1 && !($_REQUEST["ref"]==""))
		{
			PluginFeatures("META",pluginBinding("PLUGIN",pluginPages("UID",$_REQUEST["ref"]))); 
		}
		else
		{
			echo "\n".'<meta name="description" content="'.iDevSite("DESCRIPTION").'" />';
			echo iDevSite("ROBOTS");
		}
	}
}
?>