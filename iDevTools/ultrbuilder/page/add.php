
	$gallery = $_REQUEST["gallery"];
	$Gtype = $_REQUEST["Gtype"];
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

	if($gallery=="")
	{
	$msg .= "<p align='center'>Gallery has no title. Please indicate the title for you to proceed.</p>";
	}

	if($count<=0)
	{
	$msg .= "<p align='center'>No files have been uploaded. Please try again.</p>";
	}	
		
	if(($_REQUEST["submitBtn"]=="") || ($_REQUEST["submitBtn"]=="Upload" && !($msg=="")))
	{
		?>
		<form method="post" action="" enctype="multipart/form-data">
		<table width="500" align="center" id="tables_css">
		<tr>
			<td><b>Album Title: </b></td><td><input name="gallery" type="text" size="40" value="<?php echo $_REQUEST["gallery"];?>" maxlength="20"></td>
		</tr>
		<tr>
			<td><b>Album Type: </b></td><td><select name="Gtype"><option value="Default-Horizontal">Default-Horizontal</option><option value="Default-Vertical">Default-Vertical</option><?php
			$selG = "SELECT * FROM meta WHERE meta_data = '".md5("ALBUM-TYPES")."';";
			$resG = mysqli_query($db,$selG);
			@$numG = mysqli_num_rows($resG);
			for($n=0; $n<$numG; $n++)
			{
			$rwG = mysqli_fetch_array($resG);
			$idr = $rwG["id"];
			$GtypeR = $rwG["userid"];
			$dataR = $rwG["data"];
			echo '<option value="'.$GtypeR.'">'.$GtypeR.'</option>';
			}
			?></select></td>
		</tr>
		<tr>
			<td><input name="fileToUpload[]" id="fileToUpload" type="file" multiple="" value="<?php echo $_FILES["fileToUpload"];?>" accept="image/jpeg" max="100"><input type="submit" value="Upload" name="submitBtn"></td>
		</tr>
		</table>
		</form>
		<script>
		var input = document.getElementById('fileToUpload');
		var list = document.getElementById('fileList');

		while (list.hasChildNodes()){
		list.removeChild(ul.firstChild);
		}

		for(var x=0; x<input.files.length; x++)
		{
		var li = document.createElement('li');
		li.innerHTML = 'File '+(x+1)+': '+ input.files[x].name;
		list.append(li);
		}
		</script>
	<?php
	}
	elseif($_REQUEST["submitBtn"]=="Upload" && ($msg==""))
	{
		echo "Number of Files ".($count)."<br><br>";
		
		$sess_idx1 = rand(0, 999999999999999999999999);
		$timexx1 = (date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s);
		$cccxC = md5(md5($timexx1)." |A1| ".md5($sess_idx1)." |B1| ".md5($userID)."".md5($gallery)."|C1| ".SesVar()." |D1| ");	
		$cccxD = md5(md5($timexx1)." |A2| ".md5($sess_idx1)." |B2| ".md5($userID)."".md5($gallery)."|C2| ".SesVar()." |D2| ");	
		
		if(@mkdir("galleries/".$cccxC))
		{
		@mkdir("galleries/".$cccxC."/thumb");
		echo '<form action="" method="POST">';
		echo '<input name="gallery" value="'.$gallery.'" type="hidden">';
		echo '<input name="Gtype" value="'.$Gtype.'" type="hidden">';
		echo '<input name="count" value="'.$count.'" type="hidden">';
		echo '<table align="center" id="tables_css">';
		echo '<tr><td><b>Title</b><br>'.$gallery.'<br><br></td></tr>';
		echo '<tr><td><b>Privacy Level</b><br><select name="Privacy"><option value="Free|Open">Available To All</option><option value="Secure|Open">Available to Logged In Users</option><option value="Secure|Priv">Available To Specific User Group(s)</option><option value="Secure|Password">Password Access Only</option></select><br><br></td></tr>';
		echo '<tr><td><b>Post</b><br><textarea name="about" rows="5" cols="50">'.$_REQUEST["about"].'</textarea><br><br></td></tr>';
		echo '<tr><td align="center">';
		
			$target = "galleries/".$cccxC;
			
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccxD."','".$cccxC."','".md5("USER-ALBUM")."');";
			$res = mysqli_query($db,$ins);
			if($res)
			{
			echo '<input name="jdi" value="'.$cccxD.'" type="hidden">';
				$a = -1;
				foreach($namearray as $fileName)
				{
					$a = $a+1;

					$sess_idx = rand(0, 999999999999999999999999);
					$timexx = (date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s);
					$cccxA = md5(md5($timexx)." || ".md5($sess_idx)." || ".md5($userID)." |".md5($a.$gallery)."| ".SesVar()." |D| ");
					$cccxB = md5(md5($timexx)." |A| ".md5($sess_idx)." |B| ".md5($userID)." |".md5($a.$gallery)."|C| ".SesVar()." |D| ");	
					
					$qq = explode(".",$fileName);
					$filetype = strtolower($qq[1]);
					
					$target = "galleries/".$cccxC."/".$cccxA.".".$filetype ;
					$targetthumb = "galleries/".$cccxC."/thumb/".$cccxA.".".$filetype ;
					
					
					if($filetype=="jpg" || $filetype=="jpeg" || $filetype=="png" || $filetype=="gif")
					{
						if(@move_uploaded_file($array[$a], $target))
						{
						$name1 = "galleries/".$cccxC."/".$fileName;	
						$name2 = "galleries/".$cccxC."/".$cccxA.".".$filetype;
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
					
						
						
						${$a."ins"} = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccxD."','".$name2x."','".md5("ALBUM-IMAGE")."');";
						${$a."res"} = mysqli_query($db,${$a."ins"});
						
						
							if(${$a."res"})
							{
							$sel2 = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE data = '".$name2x."' AND meta_data = '".md5("ALBUM-IMAGE")."');";
							$res2 = mysqli_query($db,$sel2);
							@$rw2 = mysqli_fetch_array($res2);
							$id = $rw2["id"];
							echo '<input name="pic'.$a.'" value="'.$id.'" type="hidden">';
							echo '<div align="center" id="galleryIMG"><table align="center" id="tables_css3"><tr><td align="center"><img src="'.$targetthumb.'" height="120" align="center"></td></tr><tr><td><textarea name="imgComment'.$a.'" title="Comments about this photo" rows="3" cols="25">'.$_REQUEST["imgComment".$a].'</textarea></td></tr></table></div>';
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
			}
			else
			{
			echo '<p align="center">Sorry. An error occurred while creating your gallery. Please try again later.</p>';
			}							
			echo '</td></tr>';
			echo '<tr><td><input type="Submit" name="submitBtn" value="Submit"></td></tr>';	
			echo '</table></form>';
		}
		else
		{
		echo '<p align="center">Sorry! Your album could not be created at this time. Please try again later.</p>';
		}
	}
	elseif($_REQUEST["submitBtn"]=="Submit")
	{
		$ins = "INSERT INTO _galleries (id,name,title,src,Gtype,parent_page,mode,misc,status,uid,org,UGroup,town,province,country) VALUES ('','','".@ eregi_replace("'","`", $_REQUEST["gallery"])."','".$_REQUEST["jdi"]."','".$_REQUEST["Gtype"]."','','".$_REQUEST["Privacy"]."','','Active','".$userID."','".$org."','".$level."','".$userTown."','".$userProvince."','".$userCountry."');";
		$res = mysqli_query($db,$ins);
		if($res)
		{
			if($postV=="")
			{
			
			}
			else
			{
				$update = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$_REQUEST["jdi"]."','".@ eregi_replace("'","`", $_REQUEST["about"])."','".md5("ALBUM-POST")."');";
				$resup = mysqli_query($db,$update);				
				if($resup)
				{
				echo '<p align="center">Post has been added successfully.</p>';
				}
				else
				{
				echo '<p align="center">Error while updating post.</p>';
				}
			}
			
			$b=0;
			$c=0;
			for($a=0; $a<$_REQUEST["count"]; $a++)
			{	
				
				if(!($_REQUEST["imgComment".$a]==""))
				{
				${$a."ins"} = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$_REQUEST["pic".$a]."','".@ eregi_replace("'","`", $_REQUEST["imgComment".$a])."','".md5("IMAGE-COMMENT")."');";
				${$a."res"} = mysqli_query($db,${$a."ins"});
				$b=$b+1;
					if(${$a."res"})
					{
					$c=$c+1;
					}
					else
					{
					$c=$c+0;
					}
				}
			}
			
			if($b==$c)
			{
			echo '<p align="center">Success! Your album has been created.</p>';
			}
			elseif(($b>$c) && ($c>"0"))
			{
			echo '<p align="center">Your album has been created but there was an error while adding comments</p>';
			}
			else
			{
			echo '<p align="center">Your album has been created but there was an error while adding comments</p>';
			}
		}
		else
		{
		echo '<p align="center">Sorry! Your album could not be created. Please try again later.</p>';
		}
	}
