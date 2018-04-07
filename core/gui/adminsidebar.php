<?php

if(function_exists('mysidebar'))
{
	
}
else
{
	function mysidebar(){

		$refx = explode("/",$_REQUEST["ref"]);
		$ref = $refx[0];

		if($ref==iDevSite("DASHBOARD NAME").".php" || $ref==iDevSite("DASHBOARD NAME"))
		{
				
			if(checkPerm('admin.php|||',$level,'View')=="Yes")
			{
			?>
			<div style=" border-radius: 0px; background-color: #0A4948; padding: 5px; margin:5px; font-weight: bold;">
				<a href="?ref=<?php echo $_REQUEST["ref"];?>"><div style=" padding:2px; margin:5px; background-color: #000; color:#fff; font-size:10px;">&nbsp;&nbsp;ADMIN&nbsp;&nbsp;</div></a>
			</div>
			<?php
			}
		}
		elseif($ref=="admin.php" || $ref=="admin" || $ref=="settings" || $ref=="myadmin.php" || $ref=="myadmin")
		{
			if(privacy('Secure|Priv')=='Granted')
			{
				?>
				<div style=" border-radius: 0px; background-color: #0A4948; padding: 5px; margin:5px; font-weight: bold; width:170px;">
					<a href="?ref=<?php echo $ref;?>/&extn=SMS SETTINGS"><div style=" padding:2px; margin:3px; background-color: #000; color:#fff; font-size:10px;">&nbsp;&nbsp;SMS SETTINGS&nbsp;&nbsp;</div></a>
					<a href="?ref=<?php echo $ref;?>/&extn=MOBILE NETWORKS"><div style=" padding:2px; margin:3px; background-color: #000; color:#fff; font-size:10px;">&nbsp;&nbsp;MOBILE NETWORKS&nbsp;&nbsp;</div></a>
					<a href="?ref=<?php echo $ref;?>/&extn=GOOGLE API KEYS"><div style=" padding:2px; margin:3px; background-color: #000; color:#fff; font-size:10px;">&nbsp;&nbsp;GOOGLE API KEYS&nbsp;&nbsp;</div></a>
				</div>
				<?php
					
			}
		}
		else
		{
		}
	}
}
 

if(function_exists('AdminSideBar'))
{
	
}
else
{
	function AdminSideBar($a,$b){

	include find_file("cnct.php");
	include "mis/priv.php";

	$sidebarHtml = "";
	if(chkSes()=="Inactive")
	{

	}
	else
	{
	$sidebarHtml .= "<table align='center'>";
	$sidebarHtml .= "<tr>";
	$sidebarHtml .= "<td>";
	$sidebarHtml .= "<a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=view&unit=".$_REQUEST["unit"]."'>VIEW</a>";
	$sidebarHtml .= "</td>";
	$sidebarHtml .= "</tr>";
	$sidebarHtml .= "<tr>";
	$sidebarHtml .= "<td>";
	$sidebarHtml .= "<a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=add&unit=".$_REQUEST["unit"]."'>ADD</a>";
	$sidebarHtml .= "</td>";
	$sidebarHtml .= "</tr>";
	$sidebarHtml .= "<tr>";
	$sidebarHtml .= "<td>";
	$sidebarHtml .= "<a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=list&unit=".$_REQUEST["unit"]."'>LIST</a>";
	$sidebarHtml .= "</td>";
	$sidebarHtml .= "</tr>";
	$sidebarHtml .= "<tr>";
	$sidebarHtml .= "<td>";
	$sidebarHtml .= "<a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=setup&unit=".$_REQUEST["unit"]."'>SETUP</a>";
	$sidebarHtml .= "</td>";
	$sidebarHtml .= "</tr>";
	$sidebarHtml .= "</table>";
	}

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
						return $sidebarHtml;
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
						return $sidebarHtml;
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
					return $sidebarHtml;
				}
			}
			elseif($mode=="Free|Open")
			{
				return $sidebarHtml;
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
						return $sidebarHtml;
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
						return $sidebarHtml;
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
					return $sidebarHtml;
				}
			}
			elseif($mode=="Free|Open")
			{
				return $sidebarHtml;
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
						return $sidebarHtml;
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
						return $sidebarHtml;
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
					return $sidebarHtml;
				}
			}
			elseif($mode=="Free|Open")
			{
				return $sidebarHtml;
			}
			
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('showAdminBar'))
{
	
}
else
{
	function showAdminBar(){

		$refx = explode("/",$_REQUEST["ref"]);
		$ref = $refx[0];
			
		if($ref=="admin.php" || $ref=="admin" || $ref==(iDevSite("DASHBOARD NAME").".php") || $ref==iDevSite("DASHBOARD NAME") || $ref=="settings")
		{
		return 1;
		}
		else
		{
			return 0;
		}
	}
}
?>