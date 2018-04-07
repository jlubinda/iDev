<?php 

if(function_exists('iDevSite'))
{
	
}
else
{
	function iDevSite($type="",$class="",$data=""){
		
		$PageIDxd = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
		
		$refx = explode("/",$_REQUEST["ref"]);
		$ref = $refx[1];
		$iDevConfig = iDevConfig();
		
		if($type=="URL")
		{
			return $iDevConfig["URL"];
		}
		elseif($type=="ACCESS")
		{
			return $iDevConfig["ACCESS"];
		}
		elseif($type=="BACKGROUND COLOR")
		{
			return $iDevConfig["BACKGROUND_COLOR"];
		}
		elseif($type=="LOGIN URL")
		{
			return $iDevConfig["LOGIN_URL"];
		}
		elseif($type=="TITLE")
		{
			return $iDevConfig["TITLE"];
		}
		elseif($type=="DESCRIPTION")
		{
			return $iDevConfig["DESCRIPTION"];
		}
		elseif($type=="ROBOTS")
		{
					
			if($_REQUEST["function"]=="" || $_REQUEST["function"]=="view" || $_REQUEST["function"]=="View")
			{
				$funct = 'View';
			}
			elseif($_REQUEST["function"]=="add" || $_REQUEST["function"]=="insert")
			{
				$funct = 'Insert';
			}
			elseif($_REQUEST["function"]=="delete" || $_REQUEST["function"]=="Delete")
			{
				$funct = 'Delete';
			}
			elseif($_REQUEST["function"]=="list" || $_REQUEST["function"]=="List")
			{
				$funct = 'List';
			}
			else
			{
				$funct = 'View';
			}
			
			
			if($class=="INDEX")	
			{
				return $iDevConfig["ROBOTS_INDEX"];
			}
			elseif($class=="FOLLOW")
			{
				return $iDevConfig["ROBOTS_FOLLOW"];
			}
			else
			{
				if((isset($indexA) && !($indexA=="")) && (isset($followA) && !($followA=="")))
				{
					if(checkPerm($PageIDxd,'',$funct)=="Yes")
					{
						return "<meta name='robots' content='".$iDevConfig["ROBOTS_INDEX"].",".$iDevConfig["ROBOTS_FOLLOW"]."' />";
					}
					else
					{
						return "<meta name='robots' content='not-index,not-follow' />";
					}
				}
				else
				{
					if(checkPerm($PageIDxd,'',$funct)=="Yes")
					{
						return "<meta name='robots' content='index,follow' />";
					}
					else
					{
						return "<meta name='robots' content='not-index,not-follow' />";
					}
				}
			}
		}
		elseif($type=="FALCON")
		{
			return $iDevConfig["FALCON"];
		}
		elseif($type=="TAGLINE")
		{
			return $iDevConfig["TAGLINE"];
		}
		elseif($type=="DASHBOARD NAME")
		{
			return $iDevConfig["DASHBOARD_NAME"];
		}
		elseif($type=="DASHBOARD URL")
		{
			return $iDevConfig["DASHBOARD_URL"];
		}
		elseif($type=="STORE")
		{
			return $iDevConfig["STORE"];
		}
		elseif($type=="STORE URL")
		{
			return $iDevConfig["STORE_URL"];
		}
		elseif($type=="DASHBOARD DISPLAY")
		{
			include find_file("cnct.php");
			
			if($class=="ADD")
			{
				$ins = "INSERT INTO meta (userid,data,meta_data) VALUES ('".md5($class)."','".$data."','".md5("SITE DASHBOARD PLUGIN")."');";
				@$res = mysqli_query($db,$ins);
				
				if(@$res)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				$sel = "SELECT data,COUNT(id) AS maxNUM FROM meta WHERE id = (SELECT max(id)  FROM meta WHERE meta_data = '".md5("SITE DASHBOARD PLUGIN")."');";
				@$res = mysqli_query($db,$sel);
				@$rw = mysqli_fetch_array(@$res);
				$num = $rw["maxNUM"];
				$siteaccess = $rw["data"];
				
				if($num<="0")
				{
					//return	PluginFeatures("DASHBOARD ICON");
				}
				else
				{
					//PluginFeatures("DASHBOARD ITEM",$siteaccess);
				}	
			}
			mysqli_close($db);
		}
		elseif($type=="STORE ACCESS")
		{
			return $iDevConfig["STORE_ACCESS"];
		}
		elseif($type=="STORE PLUGIN")
		{
			return $iDevConfig["STORE_PLUGIN"];
		}
		elseif($type=="YOUR STORE")
		{
			$iDevConfig["YOUR_STORE"];
		}
		elseif($type=="REDIRECT")
		{

			if($_REQUEST["ref"] && $_REQUEST["segment"] && $_REQUEST["function"] && $_REQUEST["unit"])
			{
			$linkX = $link."?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."";
			}
			elseif($_REQUEST["ref"] && $_REQUEST["segment"] && $_REQUEST["function"] && !$_REQUEST["unit"])
			{
			$linkX = $link."?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."";
			}
			elseif($_REQUEST["ref"] && $_REQUEST["segment"] && !$_REQUEST["function"] && !$_REQUEST["unit"])
			{
			$linkX = $link."?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."";
			}
			elseif($_REQUEST["ref"] && !$_REQUEST["segment"] && !$_REQUEST["function"] && !$_REQUEST["unit"])
			{
			$linkX = $link."?ref=".$_REQUEST["ref"]."";
			}
			else
			{
			$linkX = $link;
			}
			
			if($iDevConfig["REDIRECT"]=="YES")
			{
				if(iDevSite()=="localhost")
				{
					if(iDevSite("ACCESS")=="")
					{
						
					}
					else
					{
						if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) 
						{
							
						} 
						else 
						{
							return (header('Location: '.iDevSite("ACCESS").'://'.iDevSite().'/'.$linkX));
						}
					}
				}
				else
				{
					if(iDevSite("ACCESS")=="")
					{

					}
					else
					{
								
						if(iDevSite("ACCESS")=="http")
						{
							if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) 
							{
								return (header('Location: '.iDevSite("ACCESS").'://'.iDevSite().'/'.$linkX));
							} 
							else 
							{
								
							}
						}
						else
						{
							if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) 
							{
								
							} 
							else 
							{
								return (header('Location: '.iDevSite("ACCESS").'://'.iDevSite().'/'.$linkX));
							}
						}
					}	
				}
			}	
		}
		elseif($type=="")
		{
			return $iDevConfig["URL"];
		}
	}
}
?>