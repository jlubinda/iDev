	echo '<a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function=edit">Update Gallery Style For This Page</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function=setup&id=2">Install New Gallery Style</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function=setup&id=1">Install New Album Style</a><br><table align="center" width="99%" id="tables_css">';
	echo '<tr><td width="30"><b>No.</b></td><td width="51"><b></b></td><td><b>Title</b></td><td><b>Privacy</b></td><td><b>Misc.</b></td><td><b>Status</b></td><td><b></b></td><td><b></b></td><td><b></b></td></tr>';
	$sel = "SELECT * FROM _sliders;";
	$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows($res);
	for($a=0; $a<$num; $a++)
	{
	@$rw = mysqli_fetch_array($res);
	$id = $rw["id"];
	$title = $rw["title"];
	$src = $rw["src"];
	$type = $rw["Gtype"];
	$Privacy = $rw["mode"];
	$misc = $rw["misc"];
	$status = $rw["status"];
			
				$selI = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$src."' AND meta_data = '".md5("USER-ALBUM")."');";
				$resI = mysqli_query($db,$selI);
				@$rwI = mysqli_fetch_array($resI);
				$uidI = $rwI["userid"];
				$targetI = $rwI["data"];
									
				$imgs = "";
				$selI2 = "SELECT * FROM meta WHERE userid = '".$uidI."' AND meta_data = '".md5("ALBUM-IMAGE")."';";
				//echo $selI2."<br>";
				$resI2 = mysqli_query($db,$selI2);
				@$numI2 = mysqli_num_rows($resI2);
					for($v=0; $v<$numI2; $v++)
					{
					@$rwI2 = mysqli_fetch_array($resI2);
					$imgx = $rwI2["data"];
						if($v=="0")
						{
						$imgs .= $imgx;
						}
						else
						{
						$imgs .= "|".$imgx;
						}
					}
					
					$imgNum = rand(0,($numI2-1));
					
					$ii = explode("|",$imgs);
					$img = $ii[$imgNum];
				
				
						$selI3 = "SELECT * FROM meta WHERE userid = '".$idx."' AND meta_data = '".md5("IMAGE-COMMENT")."';";
						//echo $selI3."<br>";
						$resI3 = mysqli_query($db,$selI3);
						@$numI3 = mysqli_num_rows($resI3);
						for($f=0; $f<$numI3; $f++)
						{
						@$rwI3 = mysqli_fetch_array($resI3);
						$commentx = $rwI3["data"];
						$idx2 = $rwI3["id"];
						//echo '<div class="comments" align="left">'.$commentx.'</div><br>';
						}	
	
	echo '<tr><td><b>'.($a+1).'.</b></td><td><image src="galleries/'.$targetI.'/thumb/'.$img.'" width="50" height="50"></td><td>'.$title.'</td><td><b>'.$Privacy.'</td><td>'.$misc.'</td><td>'.$status.'</td><td><b><a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function=view&unit='.$_REQUEST["unit"].'&gid='.$id.'">View</a></b></td><td><b><a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function=edit&unit='.$_REQUEST["unit"].'&gid='.$id.'">Edit</a></b></td><td><b><a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function=delete&unit='.$_REQUEST["unit"].'&gid='.$id.'">Delete</a></b></td></tr>';
	}
	echo '</table>';