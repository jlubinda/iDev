
	if($_REQUEST["gid"]=="")
	{
	$gName = $_REQUEST["galleryname"];
		
		if($_REQUEST["submitBtn"]=="")
		{
			echo '<form action="" method="POST" enctype="multipart/form-data">';
			echo '<table align="center" id="tables_css5"width="500">';
			echo '<tr><td align="center"><br><b><u>Gallery Style Update</u></b><br><br></td></tr>';
			
			$selD = "SELECT * FROM meta WHERE meta_data = '".md5("GALLERY-TYPES")."';";
			//echo $selD."<br>";
			$resD = mysqli_query($db,$selD);
			@$numD = mysqli_num_rows($resD);
			
			echo '<tr><td align="center"><b>Choose Gallery Style</b><br><select name="galleryname">';
			
			for($y=0; $y<$numD; $y++)
			{
			@$rwD = mysqli_fetch_array($resD);
			$idD = $rwD["id"];
			$useridD = $rwD["userid"];
			$dataD = $rwD["data"];
			echo '<option value="'.$idD.'">'.$useridD.'</option>';
			}
			
			echo '</select><br><br></td></tr>';	
			echo '<tr><td align="center"><input name="submitBtn" type="submit" value="Add Style To Page"></td></tr>';	
			echo '</table>';
		}
		elseif($_REQUEST["submitBtn"]=="Add Style To Page")
		{
			
		$selGt = "SELECT * FROM meta WHERE id = '".$gName."';";
		$resGt = mysqli_query($db,$selGt);
		@$numGt = mysqli_num_rows($resGt);
		@$rwGt = mysqli_fetch_array($resGt);
		$dataGt = $rwGt["data"];
		
				$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($_REQUEST["ref"])."','".$dataGt."','".md5("GALLERY-TYPE")."');";
				$resIn = mysqli_query($db,$ins);
				if($resIn)
				{
				echo '<p align="center">Success. Your Gallery Style has been added to this page.</p>';
				}
				else
				{
				echo '<p align="center">Error. Your Gallery Style has not been added to this page.</p>';
				}	
		}
	}
	elseif(!($_REQUEST["gid"]==""))
	{

		$sel = "SELECT * FROM _galleries WHERE id = '".$_REQUEST["gid"]."'";
		$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$name = $rw["name"];
		$title = $rw["title"];
		$srcV = $rw["src"];
		$Privacy = $rw["mode"];
		//echo "<b>".$title."</b>";
		
			$selI = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$srcV."' AND meta_data = '".md5("USER-ALBUM")."');";
			$resI = mysqli_query($db,$selI);
			@$rwI = mysqli_fetch_array($resI);
			$uidI = $rwI["userid"];
			$targetI = $rwI["data"];
		
			$selIv = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$srcV."' AND meta_data = '".md5("ALBUM-POST")."');";
			$resIv = mysqli_query($db,$selIv);
			@$rwIv = mysqli_fetch_array($resIv);
			$uidIv = $rwIv["userid"];
			$postV = $rwIv["data"];
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
			
			if(!($_REQUEST["id"]) && !($_REQUEST["submitBtn"]))
			{
			echo '<form action="" method="POST" enctype="multipart/form-data">';
			echo '<table align="center" id="tables_css5">';
			echo '<tr><td><b>Title</b><br><input name="gallery" value="'.$title.'" type="text" size="30"> <input type="Submit" name="submitBtn" value="Update Title"><br><br></td></tr>';	
			echo '<tr><td><b>Privacy Level</b><br><select name="Privacy"><option value="Free|Open">Available To All</option><option value="Secure|Open">Available to Logged In Users</option><option value="Secure|Priv">Available To Specific User Group(s)</option><option value="Secure|Password">Password Access Only</option></select> <input type="Submit" name="submitBtn" value="Update Privacy Level"><br><br></td></tr>';
			echo '<tr><td><b>Post</b><br><textarea name="about" rows="5" cols="50">'.$postV.'</textarea><br><input type="Submit" name="submitBtn" value="Update Post"><br><br></td></tr>';
			echo '<tr><td><input type="Submit" name="submitBtn" value="Delete Selected"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="fileToUpload[]" id="fileToUpload" type="file" multiple="" accept="image/jpeg" max="100"><input name="submitBtn" type="submit" value="Add To Album"></td></tr>';	
			echo '<tr><td align="center">';
			
					
					$selI2 = "SELECT * FROM meta WHERE userid = '".$srcV."' AND meta_data = '".md5("ALBUM-IMAGE")."';";
					//echo $selI2."<br>";
					$resI2 = mysqli_query($db,$selI2);
					@$numI2 = mysqli_num_rows($resI2);
					echo '<input name="count" value="'.$numI2.'" type="hidden">';
					for($a=0; $a<$numI2; $a++)
					{
					@$rwI2 = mysqli_fetch_array($resI2);
					$imgx = $rwI2["data"];
					$idx = $rwI2["id"];
						
						$target = "galleries/".$targetI."/".$imgx ;
						$targetthumb = "galleries/".$targetI."/thumb/".$imgx;
						
						
							$name1 = "galleries/".$targetI."/".$imgx;	
							$name2 = "galleries/".$targetI."/".$imgx;
							$name2x = $imgx;
							$saveto = $target;			

							
								$sel2 = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE data = '".$name2x."' AND meta_data = '".md5("ALBUM-IMAGE")."');";
								$res2 = mysqli_query($db,$sel2);
								@$rw2 = mysqli_fetch_array($res2);
								$id = $rw2["id"];
								
								
							$selI3 = "SELECT * FROM meta WHERE userid = '".$id."' AND meta_data = '".md5("IMAGE-COMMENT")."';";
							$resI3 = mysqli_query($db,$selI3);
							@$numI3 = mysqli_num_rows($resI3);
							@$rwI3 = mysqli_fetch_array($resI3);
							$commentx = $rwI3["data"];
							$idx2 = $rwI3["id"];
							
						echo '<input name="pic'.$a.'" value="'.$id.'" type="hidden">';
						echo '<div align="center" id="galleryIMG2"><table align="center" id="tables_css3"><tr><td align="center"><img src="'.$targetthumb.'" height="120" align="center"></td></tr><tr><td><textarea name="imgComment'.$a.'" title="Comments about this photo" rows="3" cols="25">'.$commentx.'</textarea></td></tr><tr><td><table align="center"><tr><td>Select:<input type="checkbox" name="select'.$a.'" value="Selected"> &nbsp;</td><td><a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function='.$_REQUEST["function"].'&unit='.$_REQUEST["unit"].'&gid='.$_REQUEST["gid"].'&id='.$id.'">Remove</a></td></tr></table></td></tr></table></div>';
						
					}						
				echo '</td></tr>';
				echo '<tr><td><input type="Submit" name="submitBtn" value="Submit"></td></tr>';	
				echo '</table></form>';
				}
				elseif($_REQUEST["id"] && !($_REQUEST["submitBtn"]))
				{
								
		if(!($_REQUEST["deleteBtn"]))
		{
		
			$selI2 = "SELECT * FROM meta WHERE id = '".$_REQUEST["id"]."';";
			$resI2 = mysqli_query($db,$selI2);
			@$numI2 = mysqli_num_rows($resI2);
			@$rwI2 = mysqli_fetch_array($resI2);
			$imgx = $rwI2["data"];
			$idx = $rwI2["id"];	
			
			$target1 = "galleries/".$targetI."/thumb/".$imgx;
			$target2 = "galleries/".$targetI."/".$imgx;
			
		echo '<form action="" method="POST">';
			echo '<table width="600" align="center">';
				echo '<tr>';
					echo '<td><img src="'.$target2.'" height ="70"><br>Are you sure you want to remove this image from your gallery?<br><input name="deleteBtn" value="Delete" type="submit"></td>';
				echo '</tr>';
			echo '</table>';
		echo '</form>';
		}
		elseif($_REQUEST["deleteBtn"]=="Delete")
		{
			
			$selI2 = "SELECT * FROM meta WHERE id = '".$_REQUEST["id"]."';";
			$resI2 = mysqli_query($db,$selI2);
			@$numI2 = mysqli_num_rows($resI2);
			$d=0;
			for($v=0; $v<$numI2; $v++)
			{
			@$rwI2 = mysqli_fetch_array($resI2);
			$imgx = $rwI2["data"];
			$idx = $rwI2["id"];	
			
			$target1 = "galleries/".$targetI."/thumb/".$imgx;
			$target2 = "galleries/".$targetI."/".$imgx;
			
			if(file_exists($target1))
			{
				if(unlink($target1))
				{
				$delf1 = "OK";
				}
				else
				{
				$delf1 = "Error";
				}
			}
			else
			{
			$delf1 = "OK";
			}
			
			if(file_exists($target2))
			{
				if(unlink($target2))
				{
				$delf2 = "OK";
				}
				else
				{
				$delf2 = "Error";
				}
			}
			else
			{
			$delf2 = "OK";
			}
			
				if($delf1=="OK" && $delf2=="OK")
				{			
					$del1 = "DELETE FROM meta WHERE id = '".$idx."';";
					$res1 = mysqli_query($db,$del1);
					
					if($res1)
					{
					$d=$d+1;
					}
					else
					{
					$d=$d;
					}
				}
				else
				{
				$d=$d;
				}
			}	

				if($d==$numI2)
				{
				echo '<p align="center">Success! your image has been removed from the gallery.</p>';
				}
				else
				{
				echo '<p align="center">Error removing image from gallery.</p>';
				}
		}
			}
			elseif($_REQUEST["submitBtn"]=="Submit")
			{
				for($a=0; $a<$_REQUEST["count"]; $a++)
				{
					$e=$e+1;
				
					$selI2 = "SELECT * FROM meta WHERE id = '".$_REQUEST["pic".$a]."';";
					$resI2 = mysqli_query($db,$selI2);
					@$numI2 = mysqli_num_rows($resI2);
					@$rwI2 = mysqli_fetch_array($resI2);
					$imgx = $rwI2["data"];
					$idx = $rwI2["id"];					
					
					$selI3 = "SELECT * FROM meta WHERE userid = '".$idx."' AND meta_data = '".md5("IMAGE-COMMENT")."';";
					$resI3 = mysqli_query($db,$selI3);
					@$numI3 = mysqli_num_rows($resI3);
					@$rwI3 = mysqli_fetch_array($resI3);
					$commentx = $rwI3["data"];
					$idx2 = $rwI3["id"];
					
					if($commentx==$_REQUEST["imgComment".$a])
					{
					
					}
					else
					{
					
					if(@$numI3>="1")
					{
					$update = "UPDATE meta SET data = '".$new_comment."' WHERE id = '".$idx2."';";
					}
					else
					{
					$update = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$idx."','".@ eregi_replace("'","`", $_REQUEST["imgComment".$a])."','".md5("IMAGE-COMMENT")."');";
					}
					//echo $update."<br>";
					$resup = mysqli_query($db,$update);
					
						if($resup)
						{
							if(@$numI3>="1")
							{
							echo '<p align="center">Comment has been updated successfully.</p>';
							}
							else
							{
							echo '<p align="center">Comment has been added successfully.</p>';
							}
						}
						else
						{
						echo '<p align="center">Error while updating comment.</p>';
						}
					}					
				}
			}
			elseif($_REQUEST["submitBtn"]=="Delete Selected")
			{
				$e=0;
				$f=0;
				for($a=0; $a<$_REQUEST["count"]; $a++)
				{
					if($_REQUEST["select".$a]=="Selected")
					{
					$e=$e+1;
						$selI2 = "SELECT * FROM meta WHERE id = '".$_REQUEST["pic".$a]."';";
						$resI2 = mysqli_query($db,$selI2);
						@$numI2 = mysqli_num_rows($resI2);
						$d=0;
						for($v=0; $v<$numI2; $v++)
						{
						@$rwI2 = mysqli_fetch_array($resI2);
						$imgx = $rwI2["data"];
						$idx = $rwI2["id"];	
						
						$target1 = "galleries/".$targetI."/thumb/".$imgx;
						$target2 = "galleries/".$targetI."/".$imgx;
						
						if(file_exists($target1))
						{
							if(unlink($target1))
							{
							$delf1 = "OK";
							}
							else
							{
							$delf1 = "Error";
							}
						}
						else
						{
						$delf1 = "OK";
						}
						
						if(file_exists($target2))
						{
							if(unlink($target2))
							{
							$delf2 = "OK";
							}
							else
							{
							$delf2 = "Error";
							}
						}
						else
						{
						$delf2 = "OK";
						}
						
							if($delf1=="OK" && $delf2=="OK")
							{			
								$del1 = "DELETE FROM meta WHERE id = '".$idx."';";
								$res1 = mysqli_query($db,$del1);
								
								if($res1)
								{
								$d=$d+1;
								}
								else
								{
								$d=$d;
								}
							}
							else
							{
							$d=$d;
							}
						}		

							if($d==$numI2)
							{
								$f=$f+1;
							}
							else
							{
								$f=$f;
							}
					}
				}

				
				if($e==$f)
				{
				echo '<p align="center">Success! your images have been removed from the gallery.</p>';
				}
				else
				{
				echo '<p align="center">Error removing images from gallery.</p>';
				}
			}
			elseif($_REQUEST["submitBtn"]=="Add To Album")
			{
			
		$gallery = $_REQUEST["gallery"];
		$array = $_FILES['fileToUpload']['tmp_name'];
		$typearray = $_FILES['fileToUpload']['type'];
		$namearray = $_FILES['fileToUpload']['name'];

		if((count($namearray)<1) || $namearray[0]=="")
		{
		$count = 0;
		}
		else
		{
		$count = count($namearray);
		}

		$msg = "";

		if($count<=0)
		{
		$msg .= "<p align='center'>No files have been uploaded. Please try again.</p>";
		}	
		
						echo "Number of Files ".($count)."<br><br>";
			
			$sess_idx1 = rand(0, 999999999999999999999999);
			$timexx1 = (date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s);
			$cccxC = md5(md5($timexx1)." |A1| ".md5($sess_idx1)." |B1| ".md5($userID)."".md5($gallery)."|C1| ".$_SESSION[SesUID()]." |D1| ");	
			$cccxD = md5(md5($timexx1)." |A2| ".md5($sess_idx1)." |B2| ".md5($userID)."".md5($gallery)."|C2| ".$_SESSION[SesUID()]." |D2| ");	
			
			
			echo '<form action="" method="POST">';
			echo '<input name="count" value="'.$_REQUEST["count"].'" type="hidden">';
			echo '<table align="center" id="tables_css">';
			echo '<tr><td align="center">';
			
				$target = "galleries/".$targetI;
				

				echo '<input name="jdi" value="'.$uidI.'" type="hidden">';
					$a = -1;
					foreach($namearray as $fileName)
					{
						$a = $a+1;

						$sess_idx = rand(0, 999999999999999999999999);
						$timexx = (date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s);
						$cccxA = md5(md5($timexx)." || ".md5($sess_idx)." || ".md5($userID)." |".md5($a.$gallery)."| ".$_SESSION[SesUID()]." |D| ");
						$cccxB = md5(md5($timexx)." |A| ".md5($sess_idx)." |B| ".md5($userID)." |".md5($a.$gallery)."|C| ".$_SESSION[SesUID()]." |D| ");	
						
						$qq = explode(".",$fileName);
						$filetype = strtolower($qq[1]);
						
						$target = "galleries/".$targetI."/".$cccxA.".".$filetype ;
						$targetthumb = "galleries/".$targetI."/thumb/".$cccxA.".".$filetype ;
						
						
						if($filetype=="jpg" || $filetype=="jpeg" || $filetype=="png" || $filetype=="gif")
						{
							if(@move_uploaded_file($array[$a], $target))
							{
							$name1 = "galleries/".$targetI."/".$fileName;	
							$name2 = "galleries/".$targetI."/".$cccxA.".".$filetype;
							$name2x = $cccxA.".".$filetype;
							$saveto = $target;
							copy($target,$targetthumb);				
						
							
						if($typearray[$a]=="image/gif")
						{
						$src = imagecreatefromgif($saveto);
						$src2 = imagecreatefromgif($targetthumb);
						}
						elseif($typearray[$a]=="image/jpeg")
						{
						$src = imagecreatefromjpeg($saveto);
						$src2 = imagecreatefromjpeg($targetthumb);
						}
						elseif($typearray[$a]=="image/pjpeg")
						{
						$src = imagecreatefromjpeg($saveto);
						$src2 = imagecreatefromjpeg($targetthumb);
						}
						elseif($typearray[$a]=="image/png")
						{
						$src = imagecreatefrompng($saveto);
						$src2 = imagecreatefrompng($targetthumb);
						}
						elseif($typearray[$a]=="image/jpg")
						{
						$src = imagecreatefromjpeg($saveto);
						$src2 = imagecreatefromjpeg($targetthumb);
						}
						
						
						//if ($typeok)
						//{
						list($w, $h) = getimagesize($saveto);
						$max = 500;
						$max2 = 100;
						$tw = $w;
						$th = $h;
						$jpeg_quality = 90;
						
						if ($w > $h)
						{
						$th = $max*$h/$w;
						$tw = $max;
						
						$thb = $max2*$h/$w;
						$twb = $max2;
						
						$h2 = $h;
						$w2 = $w;
						}
						elseif ($w < $h)
						{
						$th = $max;
						$tw = $max*$w/$h;
						
						$thb = $max2;
						$twb = $max2*$w/$h;
						
						$h2 = $h;
						$w2 = $w;
						}
						elseif ($h == $w)
						{
						$th = $max*$h/$w;
						$tw = $max;
						
						$thb = $max2*$h/$w;
						$twb = $max2;
						
						$h2 = $h;
						$w2 = $w;
						}
						
						$tmp = imagecreatetruecolor($tw, $th);
						imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w2, $h2);
						imageconvolution($tmp, array(array(-1, -1, -1),	array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
						imagejpeg($tmp, $saveto, $jpeg_quality);
						imagedestroy($tmp);
						imagedestroy($src);
						
						
						$tmp2 = imagecreatetruecolor($twb, $thb);
						imagecopyresampled($tmp2, $src2, 0, 0, 0, 0, $twb, $thb, $w2, $h2);
						imageconvolution($tmp2, array(array(-1, -1, -1),	array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
						imagejpeg($tmp2, $targetthumb, $jpeg_quality);
						imagedestroy($tmp2);
						imagedestroy($src2);
						
							
							
							${$a."ins"} = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$uidI."','".$name2x."','".md5("ALBUM-IMAGE")."');";
							${$a."res"} = mysqli_query($db,${$a."ins"});
							
							
								if(${$a."res"})
								{
								$sel2 = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE data = '".$name2x."' AND meta_data = '".md5("ALBUM-IMAGE")."');";
								$res2 = mysqli_query($db,$sel2);
								@$rw2 = mysqli_fetch_array($res2);
								$id = $rw2["id"];
								echo '<input name="pic'.$a.'" value="'.$id.'" type="hidden">';
								echo '<div align="center" id="galleryIMG"><table align="center" id="tables_css3"><tr><td align="center"><img src="'.$targetthumb.'" height="120" align="center"></td></tr><tr><td><textarea name="imgComment'.$a.'" title="Comments about this photo" rows="3" cols="25"></textarea></td></tr></table></div>';
								}
								else
								{
								echo '<p align="center">Sorry. An error occurred while uploading your image. Please try again later.</p>';
								}
							}
							else
							{
							echo '<p align="center">Sorry. An error occurred while uploading your image. Please try again later.</p>';
							}
						}
						else
						{
						echo '<p align="center">Sorry. Only JPEG, PNG and GIF file formats are supported. Please upload the correct image type.</p>';
						}
					}
											
				echo '</td></tr>';
				echo '<tr><td><input type="Submit" name="submitBtn" value="Submit"></td></tr>';	
				echo '</table></form>';
			}
			elseif($_REQUEST["submitBtn"]=="Update Title")
			{
				$update = "UPDATE _galleries SET title = '".@ eregi_replace("'","`", $_REQUEST["gallery"])."' WHERE id = '".$_REQUEST["gid"]."';";
				//echo $update."<br>";
				$resup = mysqli_query($db,$update);
				
				if($resup)
				{
				echo '<p align="center">Title has been updated successfully.</p>';
				}
				else
				{
				echo '<p align="center">Error while updating Title.</p>';
				}
			}
			elseif($_REQUEST["submitBtn"]=="Update Post")
			{
		
				if($postV==$_REQUEST["about"])
				{
				
				}
				else
				{
				
					if(!($postV==""))
					{
					$update = "UPDATE meta SET data = '".@ eregi_replace("'","`", $_REQUEST["about"])."' WHERE userid = '".$srcV."' AND meta_data = '".md5("ALBUM-POST")."';";
					}
					else
					{
					$update = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$srcV."','".@ eregi_replace("'","`", $_REQUEST["about"])."','".md5("ALBUM-POST")."');";
					}
					//echo $update."<br>";
					
					$resup = mysqli_query($db,$update);
					
					if($resup)
					{
						if(@$numI3>="1")
						{
						echo '<p align="center">Post has been updated successfully.</p>';
						}
						else
						{
						echo '<p align="center">Post has been added successfully.</p>';
						}
					}
					else
					{
					echo '<p align="center">Error while updating post.</p>';
					}
				}
			}
			elseif($_REQUEST["submitBtn"]=="Update Privacy Level")
			{	
				$update = "UPDATE _galleries SET mode = '".@ eregi_replace("'","`", $_REQUEST["Privacy"])."' WHERE id = '".$_REQUEST["gid"]."';";
				$resup = mysqli_query($db,$update);
				if($resup)
				{
				echo '<p align="center">Privacy has been updated successfully.</p>';
				}
				else
				{
				echo '<p align="center">Error while updating Privacy.</p>';
				}
			}
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}	