<?php
echo "<table align='center' id='tables_css' width='800'>";
echo "<tr>";
	echo "<td>";
		echo "<b>No.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Title.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Type.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Sidebar.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Mode.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Misc.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Status.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b></b>";
	echo "</td>";
	echo "<td>";
		echo "<b></b>";
	echo "</td>";
	echo "<td>";
		echo "<b></b>";
	echo "</td>";
	echo "<td>";
		echo "<b></b>";
	echo "</td>";
echo "</tr>";

$sel = "SELECT * FROM _pages WHERE type = 'Master File';";
$res = mysqli_query($db,$sel);
@$num = mysqli_num_rows($res);
for($i=0; $i<$num; $i++)
{
@$rw = mysqli_fetch_array($res);
	$id = $rw["id"];
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
		$resE = mysqli_query($db,$selE);
		@$rwE = mysqli_fetch_array($resE);
		$fileUrl = $rwE["data"];
		
		$EditLnk = "";
		$level = "";
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
				$level = $level+1;
				$levellist .= "level".($o-3)."=".$dir[$o-2].$termin;
				}
				else
				{
				$level = $level;
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
		$webURL = "./";
		}
		else
		{
		$webURL = "./?ref=".$name.".php";
		}
	
		$view_url = $webURL;
		$edit_url = "?ref=3&segment=a1&function=edit&unit=2&unitdir=".$unitdir."&unitclass=".$unitclass."&type=".$type."&level=".$level."&".$levellist."&&mode=php";
		$delete_url = "?ref=3&segment=a1&function=delete&unit=2&unitdir=".$unitdir."&unitclass=".$unitclass."&type=".$type."&level=".$level."&".$levellist;
		
	}
	elseif($filetype=="Post")
	{
		$edit_url = '?';
	}
	else
	{
		$edit_url = '?';
	}
	
	if($i=="0")
	{
		
	}
	else
	{
echo "<tr>";
	echo "<td>";
		echo "&nbsp;";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
	echo "</td>";
echo "</tr>";
	}

echo "<tr>";
	echo "<td>";
		echo (1+$i).".)";
	echo "</td>";
	echo "<td>";
		echo $title;
	echo "</td>";
	echo "<td>";
		echo $filetype;
	echo "</td>";
	echo "<td>";
		echo $sidebar;
	echo "</td>";
	echo "<td>";
		echo $mode;
	echo "</td>";
	echo "<td>";
		echo $misc;
	echo "</td>";
	echo "<td>";
		echo $status;
	echo "</td>";
	echo "<td>";
		echo "<a href='".$view_url."' target='_new'>View</a>";
	echo "</td>";
	echo "<td>";
		echo "<a href='".$edit_url."'>Edit</a>";
	echo "</td>";
	echo "<td>";
		echo "<a href='?ref=3&segment=f1&unit=4&typeID=".$id."'>Assign Sidebar</a>";
	echo "</td>";
	echo "<td>";
		echo "<a href='".$delete_url."'>Delete</a>";
	echo "</td>";
echo "</tr>";


///////////////////////////////////////////////////////////////////////////
		$sel2 = "SELECT * FROM _pages WHERE id = (select max(id) AS maxID FROM _pages WHERE parent_page = '".$id."' AND misc = 'INDEX');";
		//echo $sel2;
		$res2 = mysqli_query($db,$sel2);
		@$num2 = mysqli_num_rows($res2);
		for($i2=0; $i2<$num2; $i2++)
		{
		@$rw2 = mysqli_fetch_array($res2);
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
				$resE2 = mysqli_query($db,$selE2);
				@$rwE2 = mysqli_fetch_array($resE2);
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
					$webURL2 = "./";
					}
					else
					{
					$webURL2 = "./?ref=".$name.".php";
					}
				}
				else
				{
				$webURL2 = "./?ref=".$name."/".$name2.".php";
				}
				
				$view_url2 = $webURL2;
				$edit_url2 = "?ref=3&segment=a1&function=edit&unit=2&unitdir=".$unitdir2."&unitclass=".$unitclass2."&type=".$type2."&level=".$level2."&".$level2list2."&&mode=php";
				$delete_url2 = "?ref=3&segment=a1&function=delete&unit=2&unitdir=".$unitdir2."&unitclass=".$unitclass2."&type=".$type2."&level=".$level2."&".$level2list2;
			
			}
			elseif($filetype2=="Post")
			{
				$edit_url2 = '?';
			}
			else
			{
				$edit_url2 = '?';
			}
			
		echo "<tr>";
			echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;";
				echo "".(1+$i).".".(1+$i2)." ";
			echo "</td>";
			echo "<td>";
				echo $title2;
			echo "</td>";
			echo "<td>";
				echo $filetype2;
			echo "</td>";
			echo "<td>";
				echo $sidebar2;
			echo "</td>";
			echo "<td>";
				echo $mode2;
			echo "</td>";
			echo "<td>";
				echo $misc2;
			echo "</td>";
			echo "<td>";
				echo $status2;
			echo "</td>";
			echo "<td>";
				echo "<a href='".$view_url2."' target='_new'>View</a>";
			echo "</td>";
			echo "<td>";
				echo "<a href='".$edit_url2."'>Edit</a>";
			echo "</td>";
			echo "<td>";
				echo "<a href='?ref=3&segment=f1&unit=4&typeID=".$id2."'>Assign Sidebar</a>";
			echo "</td>";
			echo "<td>";
				echo "<a href='".$delete_url2."'>Delete</a>";
			echo "</td>";
		echo "</tr>";
		}
///////////////////////////////////////////////////////////////////////////




///////////////////////////////////////////////////////////////////////////
		$sel3 = "SELECT * FROM _pages WHERE (id != (select max(id) AS maxID FROM _pages WHERE parent_page = '".$id."' AND misc = 'INDEX')) AND (parent_page = '".$id."');";
		//echo $sel3;
		$res3 = mysqli_query($db,$sel3);
		@$num3 = mysqli_num_rows($res3);
		for($i3=0; $i3<$num3; $i3++)
		{
		@$rw3 = mysqli_fetch_array($res3);
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
				$resE3 = mysqli_query($db,$selE3);
				@$rwE3 = mysqli_fetch_array($resE3);
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
				$webURL3 = "./?ref=".$name."/".$name3.".php";
				}
				else
				{
				$webURL3 = "./?ref=".$name."/".$name3.".php";
				}
				
				$view_url3 = $webURL3;
				$edit_url3 = "?ref=3&segment=a1&function=edit&unit=2&unitdir=".$unitdir3."&unitclass=".$unitclass3."&type=".$type3."&level=".$level3."&".$level3list3."&&mode=php";
				$delete_url3 = "?ref=3&segment=a1&function=delete&unit=2&unitdir=".$unitdir3."&unitclass=".$unitclass3."&type=".$type3."&level=".$level3."&".$level3list3;
			
			}
			elseif($filetype3=="Post")
			{
				$edit_url3 = '?';
			}
			else
			{
				$edit_url3 = '?';
			}
			
		echo "<tr>";
			echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;";
				echo " &nbsp;&nbsp;&nbsp;&nbsp;x ".(1+$i).".".(1+$i3)." ";
			echo "</td>";
			echo "<td>";
				echo $title3;
			echo "</td>";
			echo "<td>";
				echo $filetype3;
			echo "</td>";
			echo "<td>";
				echo $sidebar3;
			echo "</td>";
			echo "<td>";
				echo $mode3;
			echo "</td>";
			echo "<td>";
				echo $misc3;
			echo "</td>";
			echo "<td>";
				echo $status3;
			echo "</td>";
			echo "<td>";
				echo "<a href='".$view_url3."' target='_new'>View</a>";
			echo "</td>";
			echo "<td>";
				echo "<a href='".$edit_url3."'>Edit</a>";
			echo "</td>";
			echo "<td>";
				echo "<a href='?ref=3&segment=f1&unit=4&typeID=".$id3."'>Assign Sidebar</a>";
			echo "</td>";
			echo "<td>";
				echo "<a href='".$delete_url3."'>Delete</a>";
			echo "</td>";
		echo "</tr>";
		}
///////////////////////////////////////////////////////////////////////////
}
echo "</table>";
?>