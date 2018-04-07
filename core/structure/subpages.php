<?php 

if(function_exists('subPages'))
{
	
}
else
{
	function subPages($a,$b){

	include find_file("cnct.php");
	include "mis/priv.php";
		if($a && !$b)
		{
			$pgArray = explode("/", $a);
			$numPages = count($pgArray);
			
			if($numPages=="1")
			{
			$pidx = $pgArray[0];
			$pageArray = explode(".",$pidx);
			$rty = $pageArray[0];
			
			$st = "SELECT * FROM _pages WHERE id = '".$rty."' OR name = '".$rty."'";
			$rt = mysqli_query($db,$st);
			@$wt = mysqli_fetch_array($rt);
			$pid = $wt["id"];		
			
			$se = "SELECT * FROM _pages WHERE id = (SELECT max(id) AS maxID FROM _pages WHERE parent_page = '".$pid."' AND misc = 'INDEX');";
			$re = mysqli_query($db,$se);
			@$nm = mysqli_num_rows($re);
			@$rw = mysqli_fetch_array($re);
			$id = $rw["id"];
			$name = $rw["name"];
			$title = $rw["title"];
			$src = $rw["src"];
			$type = $rw["type"];
			$sidebar = $rw["sidebar"];
			$parent_page = $rw["parent_page"];
			$urly = $rw["url"];
			$mode = $rw["mode"];
			$misc = $rw["misc"];
			$status = $rw["status"];
			}
			elseif($numPages=="2")
			{
			$pidx = $pgArray[0];
			$sidx = $pgArray[1];
			$pageArray = explode(".",$pidx);
			$rty = $pageArray[0];
			$pageArray2 = explode(".",$sidx);
			$rty2 = $pageArray2[0];
			
			$st = "SELECT * FROM _pages WHERE id = '".$rty."' OR name = '".$rty."'";
			$rt = mysqli_query($db,$st);
			@$wt = mysqli_fetch_array($rt);
			$pid = $wt["id"];	
			
			$st2 = "SELECT * FROM _pages WHERE id = '".$rty2."' OR name = '".$rty2."'";
			$rt2 = mysqli_query($db,$st2);
			@$wt2 = mysqli_fetch_array($rt2);
			$pid2 = $wt2["id"];		
			
			$se = "SELECT * FROM _pages WHERE (id = '".$pid2."' || name = '".$pid2."') AND parent_page = '".$pid."';";
			$re = mysqli_query($db,$se);
			@$nm = mysqli_num_rows($re);
			@$rw = mysqli_fetch_array($re);
			$id = $rw["id"];
			$name = $rw["name"];
			$title = $rw["title"];
			$src = $rw["src"];
			$type = $rw["type"];
			$sidebar = $rw["sidebar"];
			$parent_page = $rw["parent_page"];
			$urly = $rw["url"];
			$mode = $rw["mode"];
			$misc = $rw["misc"];
			$status = $rw["status"];
			}
			elseif($numPages=="3")
			{
			$pidx = $pgArray[0];
			$sidx = $pgArray[1];
			$didx = $pgArray[2];
			$pageArray = explode(".",$pidx);
			$rty = $pageArray[0];
			$pageArray2 = explode(".",$sidx);
			$rty2 = $pageArray2[0];
			$pageArray3 = explode(".",$didx);
			$rty3 = $pageArray3[0];
			
			$st = "SELECT * FROM _pages WHERE id = '".$rty."' OR name = '".$rty."'";
			$rt = mysqli_query($db,$st);
			@$wt = mysqli_fetch_array($rt);
			$pid = $wt["id"];	
			
			$st2 = "SELECT * FROM _pages WHERE id = '".$rty2."' OR name = '".$rty2."'";
			$rt2 = mysqli_query($db,$st2);
			@$wt2 = mysqli_fetch_array($rt2);
			$pid2 = $wt2["id"];		
			
			$se = "SELECT * FROM _pages WHERE (id = '".$pid2."' || name = '".$pid2."') AND parent_page = '".$pid."';";
			$re = mysqli_query($db,$se);
			@$nm = mysqli_num_rows($re);
			@$rw = mysqli_fetch_array($re);
			$id = $rw["id"];
			$name = $rw["name"];
			$title = $rw["title"];
			$src = $rw["src"];
			$type = $rw["type"];
			$sidebar = $rw["sidebar"];
			$parent_page = $rw["parent_page"];
			$urly = $rw["url"];
			$mode = $rw["mode"];
			$misc = $rw["misc"];
			$status = $rw["status"];
			}
			
			
			$sel = "SELECT * FROM meta WHERE userid = '".$src."';";
			@$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array(@$res);
			$u_id = $rw["userid"];
			$url = $rw["data"]; 
			
			if($mode=="Secure|Password")
			{		
				if(chkSes()=="Inactive")
				{
				return privacy($mode);
				}
				else 
				{
					//if()
					//{
						if($type=="Master File")
						{
						return (include $url);
						}
						elseif($type=="File")
						{
						return (include $url);
						}
						else
						{
						return (pagepost($url));
						}
					//}
				}
			}
			elseif($mode=="Secure|Priv")
			{	
				if(chkSes()=="Inactive")
				{
				return privacy($mode);
				}
				else 
				{
					//if()
					//{
						if($type=="Master File")
						{
						return (include $url);
						}
						elseif($type=="File")
						{
						return (include $url);
						}
						else
						{
						return (pagepost($url));
						}
					//}
				}
			}
			elseif($mode=="Secure|Open")
			{
				if(chkSes()=="Inactive")
				{
				return privacy($mode);
				}
				else 
				{
					if($type=="Master File")
					{
					return (include $url);
					}
					elseif($type=="File")
					{
					return (include $url);
					}
					else
					{
					return (pagepost($url));
					}
				}
			}
			elseif($mode=="Free|Open")
			{
				if($type=="Master File")
				{
				return (include $url);
				}
				elseif($type=="File")
				{
				return (include $url);
				}
				else
				{
				return (pagepost($url));
				}
			}
			
		}
		elseif($a && $b)
		{
			$st = "SELECT * FROM _pages WHERE id = '".$a."' OR name = '".$a."'";
			$rt = mysqli_query($db,$st);
			@$wt = mysqli_fetch_array($rt);
			$pid = $wt["id"];
			
			$se = "SELECT * FROM _pages WHERE (id = '".$b."' || name = '".$b."') AND parent_page = '".$pid."';";
			$re = mysqli_query($db,$se);
			@$nm = mysqli_num_rows($re);
			@$rw = mysqli_fetch_array($re);
			$id = $rw["id"];
			$name = $rw["name"];
			$title = $rw["title"];
			$src = $rw["src"];
			$type = $rw["type"];
			$sidebar = $rw["sidebar"];
			$parent_page = $rw["parent_page"];
			$urly = $rw["url"];
			$mode = $rw["mode"];
			$misc = $rw["misc"];
			$status = $rw["status"];
			
			
			$sel = "SELECT * FROM meta WHERE userid = '".$src."';";
			@$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array(@$res);
			$u_id = $rw["userid"];
			$url = $rw["data"]; 
			
			if($mode=="Secure|Password")
			{		
				if(chkSes()=="Inactive")
				{
				return privacy($mode);
				}
				else 
				{
					//if()
					//{
						if($type=="Master File")
						{
						return (include $url);
						}
						elseif($type=="File")
						{
						return (include $url);
						}
						else
						{
						return (pagepost($url));
						}
					//}
				}
			}
			elseif($mode=="Secure|Priv")
			{	
				if(chkSes()=="Inactive")
				{
				return privacy($mode);
				}
				else 
				{
					//if()
					//{
						if($type=="Master File")
						{
						return (include $url);
						}
						elseif($type=="File")
						{
						return (include $url);
						}
						else
						{
						return (pagepost($url));
						}
					//}
				}
			}
			elseif($mode=="Secure|Open")
			{
				if(chkSes()=="Inactive")
				{
				return privacy($mode);
				}
				else 
				{
					if($type=="File")
					{
					return (include $url);
					}
					else
					{
					return (pagepost($url));
					}
				}
			}
			elseif($mode=="Free|Open")
			{
				if($type=="Master File")
				{
				return (include $url);
				}
				elseif($type=="File")
				{
				return (include $url);
				}
				else
				{
				return (pagepost($url));
				}
			}
			
		}
		elseif(!$a && !$b)
		{
			$se = "SELECT * FROM _pages WHERE id = (SELECT max(id) AS maxID FROM _pages WHERE parent_page = (SELECT max(id) AS maxID FROM _pages WHERE misc = 'SYS INDEX'));";
			$re = mysqli_query($db,$se);
			@$nm = mysqli_num_rows($re);
			@$rw = mysqli_fetch_array($re);
			$id = $rw["id"];
			$name = $rw["name"];
			$title = $rw["title"];
			$src = $rw["src"];
			$type = $rw["type"];
			$sidebar = $rw["sidebar"];
			$parent_page = $rw["parent_page"];
			$urly = $rw["url"];
			$mode = $rw["mode"];
			$misc = $rw["misc"];
			$status = $rw["status"];
			
			$sel = "SELECT * FROM meta WHERE userid = '".$src."';";
			@$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array(@$res);
			$u_id = $rw["userid"];
			$url = $rw["data"]; 
			
			if($mode=="Secure|Password")
			{
				if(chkSes()=="Inactive")
				{
				return privacy($mode);
				}
				else 
				{
					//if()
					//{
						if($type=="Master File")
						{
						return (include $url);
						}
						elseif($type=="File")
						{
						return (include $url);
						}
						else
						{
						return (pagepost($url));
						}
					//}
				}
			}
			elseif($mode=="Secure|Priv")
			{
				if(chkSes()=="Inactive")
				{
				return privacy($mode);
				}
				else 
				{
					//if()
					//{
						if($type=="Master File")
						{
						return (include $url);
						}
						elseif($type=="File")
						{
						return (include $url);
						}
						else
						{
						return (pagepost($url));
						}
					//}
				}
			}
			elseif($mode=="Secure|Open")
			{
				if(chkSes()=="Inactive")
				{
				return privacy($mode);
				}
				else 
				{
					if($type=="Master File")
					{
					return (include $url);
					}
					elseif($type=="File")
					{
					return (include $url);
					}
					else
					{
					return (pagepost($url));
					}
				}
			}
			elseif($mode=="Free|Open")
			{
				if($type=="Master File")
				{
				return (include $url);
				}
				elseif($type=="File")
				{
				return (include $url);
				}
				else
				{
				return (pagepost($url));
				}
			}
			
		}
		
		mysqli_close($db);
	}
}
?>