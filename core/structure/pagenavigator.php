<?php

if(function_exists('pageNavigator'))
{
	
}
else
{
	function pageNavigator($f){

	include find_file("cnct.php");
	include "mis/priv.php";
		
		$p = explode("/", $f);
		$px = explode(".", $p[0]);
		$pagename = $px[0];
		
	if($f=="")
	{
		$sel = "SELECT * FROM _pages WHERE type = 'Master File' AND (id = (SELECT max(id) AS maxID FROM meta WHERE misc = 'SYS INDEX'));";
	}
	else
	{
		$sel = "SELECT * FROM _pages WHERE type = 'Master File' AND name = '".$pagename."' AND misc != 'SYS INDEX';";
	}

	@$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows(@$res);
	for($i=0; $i<$num; $i++)
	{
	@$rw = mysqli_fetch_array(@$res); $id = $rw["id"]; 
		$name = $rw["name"];
		$title = $rw["title"];
		$filetype = $rw["type"];
		$sidebar = $rw["sidebar"];
		$src = $rw["src"];
		$mode = $rw["mode"];
		$misc = $rw["misc"];
		$status = $rw["status"];
		
		if($filetype=="File" || $filetype=="Master File")
		{
			$selE = "SELECT * FROM meta WHERE userid = '".$src."';";
			@$resE = mysqli_query($db,$selE);
			@$rwE = mysqli_fetch_array(@$resE);
			$fileUrl = $rwE["data"];
			
			$EditLnk = "";
			$levelz = "";
			$levellist = "";
			
				$dir = explode("/",$fileUrl);
				$count = count($dir);
				for($o=0; $o<$count+1; $o++)
				{
				$EditLnk .= '';
				
					if($o==$count)
					{
					$termin = "";
					}
					else
					{
					$termin = "&";
					}
				
					if($o>"2")
					{
					$levelz = $levelz+1;
					$levellist .= "level".($o-3)."=".$dir[$o-2].$termin;
					}
					else
					{
					$levelz = $levelz;
					}
					
					
					if(($o+1)==$count)
					{				
						$unitclassX = explode(".",$dir[$o]);
						$unitclass = $unitclassX[0];
						$type = $unitclassX[1];
					}
				}
				
			if($count>"2")
			{
			$unitdir = $dir[1];
			}
			else
			{
			$unitdir = "";
			}
			
			if($misc=="SYS INDEX")
			{
			$webURL = "";
			}
			else
			{
			$webURL = $name.".php";
			}
		
			$view_url = $webURL;
			
		}
		elseif($filetype=="Post")
		{
			$edit_url = '?';
		}
		else
		{
			$edit_url = '?';
		}
		
		

	///////////////////////////////////////////////////////////////////////////
			$sel2 = "SELECT * FROM _pages WHERE id = (select max(id) AS maxID FROM _pages WHERE parent_page = '".$id."' AND misc = 'INDEX');";
			//echo $sel2;
			@$res2 = mysqli_query($db,$sel2);
			@$num2 = mysqli_num_rows(@$res2);
			for($i2=0; $i2<$num2; $i2++)
			{
			@$rw2 = mysqli_fetch_array(@$res2);
				$id2 = $rw2["id"];
				$name2 = $rw2["name"];
				$title2 = $rw2["title"];
				$filetype2 = $rw2["type"];
				$sidebar2 = $rw2["sidebar"];
				$src2 = $rw2["src"];
				$mode2 = $rw2["mode"];
				$misc2 = $rw2["misc"];
				$status2 = $rw2["status"];
				
				if($filetype2=="File" || $filetype2=="Master File")
				{
					$selE2 = "SELECT * FROM meta WHERE userid = '".$src2."';";
					@$resE2 = mysqli_query($db,$selE2);
					@$rwE2 = mysqli_fetch_array(@$resE2);
					$fileUrl2 = $rwE2["data"];
					
					$EditLnk2 = "";
					$level2 = "";
					$level2list2 = "";
					
						$dir2 = explode("/",$fileUrl2);
						$count2 = count($dir2);
						for($o2=0; $o2<$count2+1; $o2++)
						{
						$EditLnk2 .= '';
						
							if($o2==$count2)
							{
							$termin2 = "";
							}
							else
							{
							$termin2 = "&";
							}
						
							if($o2>"2")
							{
							$level2 = $level2+1;
							$level2list2 .= "level".($o2-3)."=".$dir2[$o2-2].$termin2;
							}
							else
							{
							$level2 = $level2;
							}
							
							
							if(($o2+1)==$count2)
							{				
								$unitclass2X2 = explode(".",$dir2[$o2]);
								$unitclass2 = $unitclass2X2[0];
								$type2 = $unitclass2X2[1];
							}
						}
						
					if($count2>"2")
					{
					$unitdir2 = $dir2[1];
					}
					else
					{
					$unitdir2 = "";
					}
							
					if($misc2=="INDEX")
					{
						if($misc=="SYS INDEX")
						{
						$webURL2 = "";
						}
						else
						{
						$webURL2 = $name.".php";
						}
					}
					else
					{
					$webURL2 = $name."/".$name2.".php";
					}
					
					$view_url2 = $webURL2;
					
				}
				elseif($filetype2=="Post")
				{
					$edit_url2 = '?';
				}
				else
				{
					$edit_url2 = '?';
				}
				
					
			
				$PageIDm2 = $view_url2."|||";
				
				if(checkPerm($PageIDm2,$level,'View')=="Yes")
				{
					$array[] = array('title'=>$title2,
							  'filetype'=>$filetype2,
							  'sidebar'=>$sidebar2,
							  'mode'=>$mode2,
							  'misc'=>$misc2,
							  'status'=>$status2,
							  'url'=>$view_url2,
							  'filename'=>$unitclass2.".php"); 
				}
			}
	///////////////////////////////////////////////////////////////////////////




	///////////////////////////////////////////////////////////////////////////
			$sel3 = "SELECT * FROM _pages WHERE (id != (select max(id) AS maxID FROM _pages WHERE parent_page = '".$id."' AND misc = 'INDEX')) AND (parent_page = '".$id."');";
			//echo $sel3;
			@$res3 = mysqli_query($db,$sel3);
			@$num3 = mysqli_num_rows(@$res3);
			for($i3=0; $i3<$num3; $i3++)
			{
			@$rw3 = mysqli_fetch_array(@$res3);
				$id3 = $rw3["id"];
				$name3 = $rw3["name"];
				$title3 = $rw3["title"];
				$filetype3 = $rw3["type"];
				$sidebar3 = $rw3["sidebar"];
				$src3 = $rw3["src"];
				$mode3 = $rw3["mode"];
				$misc3 = $rw3["misc"];
				$status3 = $rw3["status"];
				
				if($filetype3=="File" || $filetype3=="Master File")
				{
					$selE3 = "SELECT * FROM meta WHERE userid = '".$src3."';";
					@$resE3 = mysqli_query($db,$selE3);
					@$rwE3 = mysqli_fetch_array(@$resE3);
					$fileUrl3 = $rwE3["data"];
					
					$EditLnk3 = "";
					$level3 = "";
					$level3list3 = "";
					
						$dir3 = explode("/",$fileUrl3);
						$count3 = count($dir3);
						for($o3=0; $o3<$count3+1; $o3++)
						{
						$EditLnk3 .= '';
						
							if($o3==$count3)
							{
							$termin3 = "";
							}
							else
							{
							$termin3 = "&";
							}
						
							if($o3>"2")
							{
							$level3 = $level3+1;
							$level3list3 .= "level".($o3-3)."=".$dir3[$o3-2].$termin3;
							}
							else
							{
							$level3 = $level3;
							}
							
							
							if(($o3+1)==$count3)
							{				
								$unitclass3X3 = explode(".",$dir3[$o3]);
								$unitclass3 = $unitclass3X3[0];
								$type3 = $unitclass3X3[1];
							}
						}
						
					if($count3>"2")
					{
					$unitdir3 = $dir3[1];
					}
					else
					{
					$unitdir3 = "";
					}
							
					if($misc3=="INDEX")
					{
					$webURL3 = $name."/".$name3.".php";
					}
					else
					{
					$webURL3 = $name."/".$name3.".php";
					}
					
					$view_url3 = $webURL3;
					
				}
				elseif($filetype3=="Post")
				{
					$edit_url3 = '?';
				}
				else
				{
					$edit_url3 = '?';
				}
					
				$PageIDm3 = $view_url3."|||";
					
				if(checkPerm($PageIDm3,$level,'View')=="Yes")
				{
					$array[] = array('title'=>$title3,
									  'filetype'=>$filetype3,
									  'sidebar'=>$sidebar3,
									  'mode'=>$mode3,
									  'misc'=>$misc3,
									  'status'=>$status3,
									  'url'=>$view_url3,
									  'filename'=>$unitclass3.".php");
				}
					
			}
	///////////////////////////////////////////////////////////////////////////
	}
		
		mysqli_close($db);

	return $array;
	}
}
?>