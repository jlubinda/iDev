<?php 	

if(function_exists('showAdminBar'))
{
	
}
else
{
	function sidebar($a){
	include find_file("cnct.php");

		if($a=="width")
		{
		$selMn = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("SIDEBAR-WIDTH")."');";
		@@$resMn = mysqli_query($db,$selMn);
		@$num = mysqli_num_rows(@$resMn);
			if($num>="1")
			{
			@$rwM = mysqli_fetch_array(@$resMn);
			$u_id = $rwM["userid"];
			$url = $rwM["data"];
			return $url;
			}
			else
			{
			return "";
			}
		}
		elseif($a=="display")
		{
			if($_REQUEST["ref"] && !$_REQUEST["segment"])
			{
			$pgArray = explode("/", $_REQUEST["ref"]);
			$numPages = count($pgArray);
			
			$pidx = $pgArray[0];
			$pageArray = explode(".",$pidx);
			$page = $pageArray[0];
			
			$pidx2 = $pgArray[1];
			$pageArray2 = explode(".",$pidx2);
			$segment = $pageArray2[0];
			
			if($numPages=="1")
			{
			$sl = "SELECT * FROM _pages WHERE (id = '".$page."' || name = '".$page."') AND sidebar='On';";
			$rl = mysqli_query($db,$sl);
			@$nl = mysqli_num_rows($rl);
			@$rwl = mysqli_fetch_array($rl);
			$id = $rwl["id"];
			$src = $rwl["src"];
			}
			elseif($numPages=="2")
			{
				
				$sly = "SELECT * FROM _pages WHERE (id = '".$segment."' || name = '".$segment."') AND sidebar='On';";
				$rly = mysqli_query($db,$sly);
				@$nly = mysqli_num_rows($rly);
				
				if($nly>="1")
				{
				$sl = "SELECT * FROM _pages WHERE (id = '".$segment."' || name = '".$segment."') AND sidebar='On';";
				$rl = mysqli_query($db,$sl);
				@$nl = mysqli_num_rows($rl);
				@$rwl = mysqli_fetch_array($rl);
				$id = $rwl["id"];
				$src = $rwl["src"];
				}
				else
				{
				$sl = "SELECT * FROM _pages WHERE (id = '".$page."' || name = '".$page."') AND sidebar='On';";
				$rl = mysqli_query($db,$sl);
				@$nl = mysqli_num_rows($rl);
				@$rwl = mysqli_fetch_array($rl);
				$id = $rwl["id"];
				$src = $rwl["src"];
				}
			}
			
			
			$selMn = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5((md5($id))."".(md5($src)))."');";
			@@$resMn = mysqli_query($db,$selMn);
			@$num = mysqli_num_rows(@$resMn);
			
				if($num>="1")
				{
				@$rwM = mysqli_fetch_array(@$resMn);
				$u_id = $rwM["userid"];
				$x = $rwM["data"];
				
				$sk = "SELECT * FROM _sidebars WHERE id = '".$x."';";
				$rk = mysqli_query($db,$sk);
				$rt = mysqli_fetch_array($rk);
				$s = $rt["src"];
					
					$seln = "SELECT * FROM meta WHERE userid = '".$s."';";
					@$resn = mysqli_query($db,$seln);
					@$rwn = mysqli_fetch_array(@$resn);
					$u_id = $rwn["userid"];
					$url = $rwn["data"]; 
				
					if($url)
					{
					return (include ($url));
					}
					else
					{
					return "";
					}
				}
				else
				{
				return "";
				}
			}
			elseif($_REQUEST["ref"] && $_REQUEST["segment"])
			{
			$sly = "SELECT * FROM _pages WHERE (id = '".$_REQUEST["segment"]."' || name = '".$_REQUEST["segment"]."') AND sidebar='On';";
			$rly = mysqli_query($db,$sly);
			@$nly = mysqli_num_rows($rly);
			
			if($nly>="1")
			{
			$sl = "SELECT * FROM _pages WHERE (id = '".$_REQUEST["segment"]."' || name = '".$_REQUEST["segment"]."') AND sidebar='On';";
			$rl = mysqli_query($db,$sl);
			@$nl = mysqli_num_rows($rl);
			@$rwl = mysqli_fetch_array($rl);
			$id = $rwl["id"];
			$src = $rwl["src"];
			}
			else
			{
			$sl = "SELECT * FROM _pages WHERE (id = '".$_REQUEST["ref"]."' || name = '".$_REQUEST["ref"]."') AND sidebar='On';";
			$rl = mysqli_query($db,$sl);
			@$nl = mysqli_num_rows($rl);
			@$rwl = mysqli_fetch_array($rl);
			$id = $rwl["id"];
			$src = $rwl["src"];
			}
			
			$selMn = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5((md5($id))."".(md5($src)))."');";
			@@$resMn = mysqli_query($db,$selMn);
			@$num = mysqli_num_rows(@$resMn);
			
				if($num>="1")
				{
				@$rwM = mysqli_fetch_array(@$resMn);
				$u_id = $rwM["userid"];
				$x = $rwM["data"];
				
				$sk = "SELECT * FROM _sidebars WHERE id = '".$x."';";
				$rk = mysqli_query($db,$sk);
				$rt = mysqli_fetch_array($rk);
				$s = $rt["src"];
					
					$seln = "SELECT * FROM meta WHERE userid = '".$s."';";
					@$resn = mysqli_query($db,$seln);
					@$rwn = mysqli_fetch_array(@$resn);
					$u_id = $rwn["userid"];
					$url = $rwn["data"]; 
				
					if($url)
					{
					return (include ($url));
					}
					else
					{
					return "";
					}
				}
				else
				{
				return "";
				}
			}
			elseif(!$_REQUEST["ref"] && !$_REQUEST["segment"])
			{	
			$sl = "SELECT * FROM _pages WHERE id = (SELECT max(id) AS maxID FROM _pages WHERE misc = 'SYS INDEX' AND sidebar = 'On');";
			$rl = mysqli_query($db,$sl);
			@$nl = mysqli_num_rows($rl);
			@$rwl = mysqli_fetch_array($rl);
			$id = $rwl["id"];
			$src = $rwl["src"];
			
			$selMn = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5((md5($id))."".(md5($src)))."');";
			@@$resMn = mysqli_query($db,$selMn);
			@$num = mysqli_num_rows(@$resMn);
			
				if($num>="1")
				{
				@$rwM = mysqli_fetch_array(@$resMn);
				$u_id = $rwM["userid"];
				$x = $rwM["data"];
				
				$sk = "SELECT * FROM _sidebars WHERE id = '".$x."';";
				$rk = mysqli_query($db,$sk);
				$rt = mysqli_fetch_array($rk);
				$s = $rt["src"];
					
					$seln = "SELECT * FROM meta WHERE userid = '".$s."';";
					@$resn = mysqli_query($db,$seln);
					@$rwn = mysqli_fetch_array(@$resn);
					$u_id = $rwn["userid"];
					$url = $rwn["data"]; 
				
					if($url)
					{
					return (include ($url));
					}
					else
					{
					return "";
					}
				}
				else
				{
				return "";
				}
			}
		}
		
		mysqli_close($db);
	}
}
?>