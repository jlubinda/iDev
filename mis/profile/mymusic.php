<?php
 if(!isset (SesVar()) || !SesVar())
{

} 
else 
{

	if($view_permissions=="Yes")
	{
	
	if($_REQUEST["unit"]=="1")
	{
	
	if(!$_REQUEST["rec_id"])
	{
	
	$sortx = $_REQUEST["sort"];
	if($_REQUEST["sort"])
	{
	$sorting = $sortx;
	}
	else
	{
	$sorting = 'id';
	}
	
	//Pages
	$limit = "20";
	$pagex = $_REQUEST["pagex"];
	if(!$pagex)
	{
	$page = "1";
	}
	else
	{
	$page = $pagex;
	}
	$upper_limit = ($page*$limit);
	$lower_limit = ($page*$limit)-$limit;
	
	$one = "1";
	$current = strtotime("+ ".$one." day",strtotime(date("Y-m-j")));
	$current = date("Y-m-j",$current);
	
	
	$query2b = "SELECT * FROM albums;";
	$result2b = mysqli_query($db,$query2b);
	@$numb2b = mysqli_num_rows($result2b);
	
	
	
	$query2 = "SELECT * FROM tracks  WHERE (artist = '".$userID."');";
	$result2 = mysqli_query($db,$query2);
	@$numb2 = mysqli_num_rows($result2);
	$pagesx = $numb2/$limit;
	$pagesy = @number_format($pagesx,0);
	if($pagesx>$pagesy)
	{
	$pagesz = $pagesy+1;
	$pagesv = @number_format($pagesz,0);
	}
	else
	{
	$pagesv = @number_format($pagesy,0);
	}
	$pages = $pagesv;
	
	//Pages

if($_REQUEST["lban"])
{
?>
<table align="center" width='200' id='tables_css3'><tr><td align='left'>&nbsp;&nbsp;<a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&unit=1">Back</a></td><td align='right'><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=4&unitx=&lban=<?php echo $_REQUEST["lban"]?>">Add Track To Album</a>&nbsp;&nbsp;</td></tr></table>
<table align="center" width="99%" id="tables_css"><tr><td><table align="center" width='99%' id=''>
<tr>
<td align='left'><p align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Artist</b></p><?php
echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src='profilepics/".$ProfilePic."' width='120' height='120' id='profpic'>";
echo "<br><br>&nbsp;&nbsp;&nbsp;&nbsp;<b>".$NickName."</b>";
?></td>
<td align='center'><?php
$selAl = "SELECT * FROM albums WHERE url = '".$_REQUEST["lban"]."';";
$resAl = mysqli_query($db,$selAl);
$rwAl = mysqli_fetch_array($resAl);
$albumTitle = $rwAl["album"];
$coverPic = $rwAl["coverPic"];
$Comments = $rwAl["Comments"];
$coverPicURL = "coverimages/".$coverPic;
echo '<table align="center" id="tables_css4" height="120" width="90%">';?><span class="xxe"><a href="?ref=<?php echo $_REQUEST["ref"];?>&segment=<?php echo $_REQUEST["segment"];?>&function=<?php echo $_REQUEST["function"];?>&unit=2&unitx=<?php echo $userID;?>&lban=<?php echo $_REQUEST["lban"];?>">Edit Album Details</a></span><?php echo '</td></tr><tr>';
if($Comments)
{
echo '<td>';
echo $Comments;
echo '</td>';
}
echo '</tr></table>';
?></td>
<td align='right'><p align='right'><b>Album</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><br><?php
echo "<img src='".$coverPicURL."' width='120' height='120' id='profpic'>&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<br><br><b>".$albumTitle."</b>&nbsp;&nbsp;&nbsp;&nbsp;";
?></td>
</tr>
</table>
<?php
}
echo "<p>";
if($_REQUEST["order"]=="DESC") 
{ 
$ordering = "ASC";
} 
else 
{ 
$ordering = "DESC";
}
$ordering2 = $_REQUEST["order"];

echo "Page: ";
	for($f=0; $f<$pages; $f++)
	{
	$b = $f + 1;
	if($b==$page)
	{
	echo "<strong><u><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&unitx=".$_REQUEST["unitx"]."&lban=".$_REQUEST["lban"]."&pagex=$b&order=$ordering2'>$b</a></u> &nbsp;&nbsp;</strong>";
	}
	else
	{
	echo "<a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&unitx=".$_REQUEST["unitx"]."&lban=".$_REQUEST["lban"]."&pagex=$b&order=$ordering2'>$b</a> &nbsp;&nbsp;";
	}
	}
	
	
	if($_REQUEST["lban"])
	{
	?>	
</p>
<table align="center" width="95%" id="tables_css3" bgcolor="#ffffff">
<tr bgcolor="#cfcfcf">
<td width="40"><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>"><span class="xxd">No.</span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=artist&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd">Title</span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=SerialNumber&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd">Genre </span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=PolicyNumber&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd">Contributing Artists</span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=ValidFrom&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd">Song Writers </span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=ValidTo&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd">Studio</span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=Insured&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd"></span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=InsuredVehicleRegistrationNumber&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>"><span class="xxd"></span></a></td><td width="60">&nbsp;</td>
</tr>
<?php
	}
	else
	{
?>
</p>
<table align="center" width="95%" id="tables_css3">
<tr bgcolor="#cfcfcf">
<td width="40"><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd"></span></a></td><td width="150"><span class="xxd"><b>Album</b></span></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=artist&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd">No. of Tracks</span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=PolicyNumber&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd">Contributing Artists</span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=ValidFrom&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd">Date Released </span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=ValidTo&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd"></span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=Insured&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>&home=yes"><span class="xxd"></span></a></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&sort=InsuredVehicleRegistrationNumber&pagex=<?php echo $_REQUEST["pagex"];?>&order=<?php echo $ordering;?>"><span class="xxd"></span></a></td><td width="60">&nbsp;</td>
</tr>
	<?php
	}	
	if(!(!$_REQUEST["lban"] && $numb2b>="1"))
	{
	$groupby = " GROUP BY album ";
	}
	else
	{
	$groupby = " GROUP BY album ";
	}
	
	
	
	if($_REQUEST["lban"])
	{
	$query = "SELECT * FROM tracks  WHERE (album = '".$_REQUEST["lban"]."') ".$groupby." order by ".$sorting." ".$ordering." LIMIT ".$lower_limit.", ".$limit.";";
	}
	else
	{
	$query = "SELECT * FROM albums  WHERE (artist = '".$userID."') order by id ASC LIMIT ".$lower_limit.", ".$limit.";";
	}
	//echo $query;
	$result = mysqli_query($db,$query);
	@$numb = mysqli_num_rows($result);
	$bn = 0;
	for($i=0; $i<$numb; $i++)
	{	
	$row = mysqli_fetch_array($result);
	
	if($_REQUEST["lban"])
	{	
	$id = $row["id"];
	$track_title = $row["track_title"];
	$artist = $row["artist"];
	$contributing_artists = $row["contributing_artists"];
	$album = $row["album"];
	$track_number = $row["track_number"];
	$file_size = $row["file_size"];
	$VideoURL = $row["VideoURL"];
	$genre = $row["genre"];
	$publisher = $row["publisher"];
	$studio = $row["studio"];
	$songwriters = $row["songwriters"];
	$producer = $row["producer"];
	$copyright = $row["copyright"];
	$protected = $row["protected"];
	$date_of_release = $row["date_of_release"];
	$comment = $row["comment"];
	}
	else
	{
	$id = $row["id"];
	$album_title = $row["album"];
	$artist = $row["artist"];
	$contributing_artists = $row["contributing_artists"];
	$url = $row["url"];
	$file_size = $row["file_size"];
	$VideoURL = $row["VideoURL"];
	$genre = $row["genre"];
	$publisher = $row["publisher"];
	$studio = $row["studio"];
	$songwriters = $row["songwriters"];
	$producer = $row["producer"];
	$copyright = $row["copyright"];
	$protected = $row["protected"];
	$date_of_release = $row["date_of_release"];
	$comment = $row["comment"];
	$coverPic = $row["coverPic"];
	
	$UseOfVehicle = $row["UseOfVehicle"];
	$VehicleType = $row["VehicleType"];
	$CountriesCovered = $row["CountriesCovered"];
	$NameAndAddressOfBureau = $row["NameAndAddressOfBureau"];
	$Premium = $row["Premium"];
	$Currency = $row["Currency"];
	$RecordEnteredBy = $row["RecordEnteredBy"];	
	$orgH = $row["org"];
	}
		
	$bn = $bn+1;
	$hj = explode(".",($bn/2));
	$d1 = $hj[0];
	$d2 = $hj[1];
	
	if($d2=="" || $d2=="0")
	{
	$bgcolor = "99FFFF";
	}
	else
	{
	$bgcolor = "ddffff";
	}
	
	$sel_albx = "SELECT * FROM albums WHERE url = '".$album."';";
	$res_albx = mysqli_query($db,$sel_albx);
	$row_albx = mysqli_fetch_array($res_albx);
	$album_titlex = $row_albx["album"];
	$artistx = $row_albx["artist"];
	$coverPicx = $row_albx["coverPic"];
	
	if($_REQUEST["lban"])
	{
	$sel_alb = "SELECT * FROM albums WHERE url = '".$album."';";
	$res_alb = mysqli_query($db,$sel_alb);
	$row_alb = mysqli_fetch_array($res_alb);
	$album_title = $row_alb["album"];
	$artist = $row_alb["artist"];
	$contributing_artists = $row_alb["contributing_artists"];
	$publisher = $row_alb["publisher"];
	$date_of_release = $row_alb["date_of_release"];
	$owner = $row_alb["owner"];
	$protected = $row_alb["protected"];
	$coverPic = $row_alb["coverPic"];
	
	$selArt = "SELECT * FROM _user_acnts WHERE userID = '".$artist."';";
	$resArt = mysqli_query($db,$selArt);
	$rowArt = mysqli_fetch_array($resArt);
	$NickName = $rowArt["NickName"];
	
	
	
	

	$query = "SELECT * FROM tracks  WHERE (album = '".$album."') order by track_number ASC;";
	
	//echo $query;
	$result = mysqli_query($db,$query);
	@$numb = mysqli_num_rows($result);
	$bn = 0;
	
	for($i=0; $i<$numb; $i++)
	{
	$row = mysqli_fetch_array($result);
	$id = $row["id"];
	$track_title = $row["track_title"];
	$artist = $row["artist"];
	$contributing_artists = $row["contributing_artists"];
	$album = $row["album"];
	$track_number = $row["track_number"];
	$file_size = $row["file_size"];
	$VideoURL = $row["VideoURL"];
	$genre = $row["genre"];
	$publisher = $row["publisher"];
	$studio = $row["studio"];
	$songwriters = $row["songwriters"];
	$producer = $row["producer"];
	$copyright = $row["copyright"];
	$protected = $row["protected"];
	$date_of_release = $row["date_of_release"];
	$comment = $row["comment"];
	
	$selGen = "SELECT * FROM genres WHERE id = '".$genre."';";
	$resGen = mysqli_query($db,$selGen);
	$rowGen = mysqli_fetch_array($resGen);
	$genreName = $rowGen["name"];
	?>	
<tr <?php echo "bgcolor='#".$bgcolor."'"; ?>>
<td><span class="xxe"><?php echo ($i+1); ?></span></td><td><span class="xxe"><?php echo $track_title; ?></span></td><td><span class="xxe"><?php echo $genreName; ?></span></td><td><span class="xxe"><?php echo $contributing_artists; ?></span></td><td><span class="xxe"><?php echo $songwriters; ?></span></td><td><span class="xxe"><?php echo $studio; ?></span></td><td><span class="xxe"><a href="?ref=<?php echo $_REQUEST["ref"];?>&segment=<?php echo $_REQUEST["segment"];?>&function=<?php echo $_REQUEST["function"];?>&unit=<?php echo $_REQUEST["unit"];?>&nblu=<?php echo $id;?>" target="_new"><?php $commentx; ?></a></span></td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=Edit&unit=2&lban=<?php echo $album;?>&idx=<?php echo $id;?>"><span class="xxd">Edit</span></a>&nbsp;</td><td><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=Delete&unit=3&lban=<?php echo $album;?>&idx=<?php echo $id;?>"><span class="xxd">Delete</span></a>&nbsp;</td>
</tr>
<?php
		}
	}
	else
	{
	$selArt = "SELECT * FROM _user_acnts WHERE userID = '".$artist."';";
	$resArt = mysqli_query($db,$selArt);
	$rowArt = mysqli_fetch_array($resArt);
	$NickName = $rowArt["NickName"];
	
	if($VideoURL)
	{
	$VideoURLx = "Music Video";
	}
	else
	{
	$VideoURLx = "";
	}
	
	
	if($comment)
	{
	$commentx = "Artist's Comments";
	}
	else
	{
	$commentx = "";
	}	
	
	
	$selGen = "SELECT * FROM genres WHERE id = '".$genre."';";
	$resGen = mysqli_query($db,$selGen);
	$rowGen = mysqli_fetch_array($resGen);
	$genreName = $rowGen["name"];
	
	$selNm = "SELECT * FROM tracks WHERE album = '".$url."';";
	$resNm = mysqli_query($db,$selNm);	
	@$number_tracks = mysqli_num_rows($resNm);
	
	?>	
<tr <?php echo "bgcolor='#".$bgcolor."'"; ?>>
<td><span class="xxe"><a href="?ref=<?php echo $_REQUEST["ref"];?>&segment=<?php echo $_REQUEST["segment"];?>&function=<?php echo $_REQUEST["function"];?>&unit=<?php echo $_REQUEST["unit"];?>&unitx=<?php echo $userID;?>&lban=<?php echo $url;?>"><img src="coverimages/<?php echo $coverPic;?>" width="60" id="profpic"></a></span></td><td><span class="xxe"><a href="?ref=<?php echo $_REQUEST["ref"];?>&segment=<?php echo $_REQUEST["segment"];?>&function=<?php echo $_REQUEST["function"];?>&unit=<?php echo $_REQUEST["unit"];?>&unitx=<?php echo $userID;?>&lban=<?php echo $url;?>"><?php echo $album_title; ?></a></span></td><td><span class="xxe"><?php echo $number_tracks; ?></span></td><td><span class="xxe"><?php echo $contributing_artists; ?></span></td><td><span class="xxe"><?php echo $date_of_release; ?></span></td><td><span class="xxe"><?php echo $studio; ?></span></td><td width='40'><span class="xxe"><a href="?ref=<?php echo $_REQUEST["ref"];?>&segment=<?php echo $_REQUEST["segment"];?>&function=<?php echo $_REQUEST["function"];?>&unit=1&unitx=<?php echo $userID;?>&lban=<?php echo $url;?>">View</a></span></td><td width='40'><span class="xxe"><a href="?ref=<?php echo $_REQUEST["ref"];?>&segment=<?php echo $_REQUEST["segment"];?>&function=<?php echo $_REQUEST["function"];?>&unit=2&unitx=<?php echo $userID;?>&lban=<?php echo $url;?>">Edit</a></span></td><td width='40'><a href="?ref=<?php echo $_REQUEST["ref"];?>&segment=<?php echo $_REQUEST["segment"];?>&function=<?php echo $_REQUEST["function"];?>&unit=5&unitx=<?php echo $userID;?>&lban=<?php echo $url;?>">Delete</a>&nbsp;</td>
</tr>
<?php
	}

}
?>
</table><p>
<?php
echo "Page: ";
	for($e=0; $e<$pages; $e++)
	{
	$x = $e + 1;
	if($x==$page)
	{
	echo "<strong><u><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&pagex=$x&order=$ordering2".$org_filter."'>$x</a></u> &nbsp;&nbsp;</strong>";
	}
	else
	{
	echo "<a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&pagex=$x&order=$ordering2".$org_filter."'>$x</a> &nbsp;&nbsp;";
	}
	}
?>
</p></td></tr></table>
<?php
	}
	}
	elseif($_REQUEST["unit"]=="2")
	{
	$selA = "SELECT * FROM albums WHERE url = '".$_REQUEST["lban"]."';";
	$resA = mysqli_query($db,$selA);
	@$rwA = mysqli_fetch_array($resA);
	$contributing_artists = $rwA["contributing_artists"];
	$album = $rwA["album"];
	$publisher = $rwA["publisher"];
	$date_of_release = $rwA["date_of_release"];
	$coverPic = $rwA["coverPic"];
	$Comments = $rwA["Comments"];
	
		if($_REQUEST["lban"] && !$_REQUEST["idx"])
		{
			if(!$_REQUEST["Submit"] && !$_REQUEST["cropBtn"])
			{
	?>
	<form action="" method="POST" enctype="multipart/form-data">
<table align="center" width="450" align="center" id="tables_css">
<tr>
<td><b>Album</b></td><td><input name="album" type="text" size="35" value="<?php echo $album;?>"></td>
</tr>
<tr>
<td><b>Contributing Artists</b></td><td><input name="contributing_artists" type="text" size="35" value="<?php echo $contributing_artists;?>"></td>
</tr>
<tr>
<td><b>Publisher</b></td><td><input name="publisher" type="text" size="35" value="<?php echo $publisher;?>"></td>
</tr>
<tr>
<td><b>Date of Release</b></td><td><label id="cx_DateOfIssue"><input name="date_of_release" type="text" size="10" value="<?php echo $date_of_release;?>" id="x_DateOfIssue" maxlength="10">
&nbsp;<img src="misc/ew_calendar.gif" id="cx_DateOfIssue" alt="Pick a Date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup(
{
inputField : "x_DateOfIssue", // ID of the input field
ifFormat : "%Y-%m-%d", // the date format
button : "cx_DateOfIssue" // ID of the button
}
);
</script></label></td>
</tr>
<tr>
<td><b>CD/Song Artwork</b></td><td><input name="CoverImage" type="file" size="35"></td>
</tr>
<tr>
<td><b>About The Album (Comments) </b></td><td><textarea name="Comments" rows="5" cols="28"></textarea></td>
</tr>
<tr>
<td><b></b></td><td><input name="Submit" type="submit" value="Submit"></td>
</tr>
</table>
	</form>
	<?php
			}
			elseif($_REQUEST["Submit"]=="Submit" && !$_REQUEST["cropBtn"])
			{
$target = "coverimages/"; 
$statusMsg = "";

				if($_REQUEST["album"]==$album)
				{
			
				}
				else
				{
					$update2 = "UPDATE albums SET album = '".$_REQUEST["album"]."' WHERE url = '".$_REQUEST["lban"]."';";
					$res2 = mysqli_query($db,$update2);
					if($res2)
					{
					$statusMsg .= "<p align='center'>Success! Album Title has been updated.</p>";
					}
					else
					{
					$statusMsg .= "<p align='center'>Error! Album Title could not be updated. Please try again later.</p>";
					}
				}
	
				if($_REQUEST["contributing_artists"]==$contributing_artists)
				{
				
				}
				else
				{
				$update3 = "UPDATE albums SET contributing_artists = '".$_REQUEST["contributing_artists"]."' WHERE url = '".$_REQUEST["lban"]."';";
				$res3 = mysqli_query($db,$update3);
					if($res3)
					{
					$statusMsg .= "<p align='center'>Success! Contributing Artists have been updated.</p>";
					}
					else
					{
					$statusMsg .= "<p align='center'>Error! Contributing Artists could not be updated. Please try again later.</p>";
					}
				}
	
				if($_REQUEST["publisher"]==$publisher)
				{
				
				}
				else
				{
					$update4 = "UPDATE albums SET publisher = '".$_REQUEST["publisher"]."' WHERE url = '".$_REQUEST["lban"]."';";
					$res4 = mysqli_query($db,$update4);
					if($res4)
					{
					$statusMsg .= "<p align='center'>Success! Publisher has been updated.</p>";
					}
					else
					{
					$statusMsg .= "<p align='center'>Error! Publisher could not be updated. Please try again later.</p>";
					}
				}
		
				if($_REQUEST["date_of_release"]==$date_of_release)
				{
				
				}
				else
				{
					$update5 = "UPDATE albums SET date_of_release = '".$_REQUEST["date_of_release"]."' WHERE url = '".$_REQUEST["lban"]."';";
					$res5 = mysqli_query($db,$update5);
					if($res5)
					{
					$statusMsg .= "<p align='center'>Success! Date of Release has been updated.</p>";
					}
					else
					{
					$statusMsg .= "<p align='center'>Error! Date of Release could not be updated. Please try again later.</p>";
					}
				}
		
				if($_REQUEST["Comments"]==$Comments)
				{
				
				}
				else
				{
					$update5 = "UPDATE albums SET Comments = '".$_REQUEST["Comments"]."' WHERE url = '".$_REQUEST["lban"]."';";
					$res5 = mysqli_query($db,$update5);
					if($res5)
					{
					$statusMsg .= "<p align='center'>Success! Comments about the album have been updated.</p>";
					}
					else
					{
					$statusMsg .= "<p align='center'>Error! Comments about the album could not be updated. Please try again later.</p>";
					}
				}
			

				 
				if($_FILES['CoverImage']['name'])
				{
				@$yearx = date(Y);
				@$dayx = date(z);
				@$hourx = date(G);
				@$hour2x = date(h);
				@$minsx = date(i);
				@$secx = date(s);

						$sess_idx = rand(0, 999999999999999999999999);
						$timexx = ($yearx*365*24*60*60)+($dayx*24*60*60)+($hourx*60*60)+($minsx*60)+$secx;
						$cccxA = md5($timexx." || ".$sess_idx." || ".$userID." || ".SesVar()." |D| ");
						$cccxB = md5($timexx." |A| ".$sess_idx." |B| ".$userID." |C| ".SesVar()." |D| ");

				 $target = $target . basename( $_FILES['CoverImage']['name']) ;
					 
					 if(move_uploaded_file($_FILES['CoverImage']['tmp_name'], $target)) 
					 {
					 echo "The file ". basename( $_FILES['CoverImage']['name']). " has been uploaded";
					 $rename = "success"; 
					 
					 $qq = explode(".",$_FILES['CoverImage']['name']);
					 $filetype = $qq[1];
					 
						$name1 = "coverimages/".basename( $_FILES['CoverImage']['name']);	
						$name2 = "coverimages/".$cccxA.".".$filetype;
						$name2x = $cccxA.".".$filetype;

						 //$renameX = rename($name1,$name2);
							if(rename($name1,$name2))
							{

								if(!($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["x2"]=="IMG"))
								{
									// If not a POST request, display page below:
									$content ='<script src="js/jquery.min.js"></script>
												<script src="js/jquery.Jcrop.js"></script>
												<link rel="stylesheet" href="css/demos.css" type="text/css" />
												<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

												<script type="text/javascript">

												  $(function(){

													$(\'#cropbox\').Jcrop({
													  aspectRatio: 1,
													  onSelect: updateCoords
													});

												  });

												  function updateCoords(c)
												  {
													$(\'#x\').val(c.x);
													$(\'#y\').val(c.y);
													$(\'#w\').val(c.w);
													$(\'#h\').val(c.h);
												  };

												  function checkCoords()
												  {
													if (parseInt($(\'#w\').val())) return true;
													alert(\'Please select a crop region then press submit.\');
													return false;
												  };

												</script>
								<style type="text/css">
								  #target {
									background-color: #ccc;
									width: 500px;
									height: 330px;
									font-size: 24px;
									display: block;
								  }


								</style>

										
										<form action="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=2&unitx=3&lban='.$_REQUEST["lban"].'" method="post" onsubmit="return checkCoords();">
											<input type="hidden" name="x2" value="IMG"/>
											<input type="hidden" name="statusMsg" value="'.$statusMsg.'"/>
											<input type="hidden" name="imgsrc" value="'.$name2.'"/>
											<input type="hidden" name="imgname" value="'.$cccxA.'"/>
											<input type="hidden" name="imgtype" value="'.$filetype.'"/>
											<input name="artist" type="hidden" value="'.$userID.'">
											<input name="coverPic" type="hidden" value="'.$name2x.'">
											<input name="contributing_artists" type="hidden" value="'.$_REQUEST["contributing_artists"].'">
											<input name="album" type="hidden" value="'.$_REQUEST["album"].'">
											<input name="publisher" type="hidden" value="'.$_REQUEST["publisher"].'">
											<input name="NumberofTracks" type="hidden" value="'.$_REQUEST["NumberofTracks"].'">
											<input name="date_of_release" type="hidden" value="'.$_REQUEST["date_of_release"].'">
											<input name="Comments" type="hidden" value="'.$_REQUEST["Comments"].'">
											<input type="hidden" id="x" name="x" />
											<input type="hidden" id="y" name="y" />
											<input type="hidden" id="w" name="w" />
											<input type="hidden" id="h" name="h" />
											<input type="submit" value="Crop Image" class="btn btn-large btn-inverse" name="cropBtn"/>
										</form><img src="'.$name2.'" id="cropbox"/>';
								$pre = 1;
								$title = ""; 
								$heading = "Please crop your album artwork.";
								?>
									<div>
									  <h2><?php echo $heading;?></h2>
									  <hr />
									  
									<p>
										<?php if(!isset($pre)) {?>
									  <pre>
										<?php print_r($content); ?>
									  </pre>
									  <?php }else{ ?>
									   <?php print_r($content); ?>
									  <?php } ?>
									</p>

								<?php       
								}

							}
							else
							{
							echo "<p align='center'>Sorry. An error occurred. Please try again later.</p>";
							}

					 }
					 else 
					 {
					 echo "Sorry, there was a problem uploading your file.";
					 $rename = "";
					 }
							
							/* if($rename)
							{
							echo "<p align='center'>Success!</p>";
							}
							else
							{
							echo "<p align='center'>Error!</p>";
							} */
				}
				else
				{

							if(!$statusMsg)
							{
							echo "<p align='center'>No changes have been made.</p>";
							}
							else
							{
							echo $statusMsg;
							}
				}
			
			}
			elseif(!$_REQUEST["Submit"] && $_REQUEST["cropBtn"]=="Crop Image")
			{			
$target = "coverimages/"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["x2"]=="IMG" && $_REQUEST["cropBtn"]=="Crop Image")
{
	$targ_w = $targ_h = 150;
	$jpeg_quality = 90;

	$src = $_REQUEST["imgsrc"];
	if($_REQUEST["imgtype"]=="jpg")
	{
	$img_r = imagecreatefromjpeg($src);
	}
	elseif($_REQUEST["imgtype"]=="png")
	{
	$img_r = imagecreatefrompng($src);
	}
	elseif($_REQUEST["imgtype"]=="gif")
	{
	$img_r = imagecreatefromgif($src);
	}
	
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

	if($_REQUEST["imgtype"]=="jpg")
	{
	imagejpeg($dst_r,$src,$jpeg_quality);
	}
	elseif($_REQUEST["imgtype"]=="png")
	{
	imagepng($dst_r,$src,$jpeg_quality);
	}
	elseif($_REQUEST["imgtype"]=="gif")
	{
	imagegif($dst_r,$src,$jpeg_quality);
	}
// Free up memory
imagedestroy($dst_r);

echo "<img src='".$_REQUEST["imgsrc"]."' align='center'>";
	
			if($_REQUEST["coverPic"]==$coverPic)
			{
			
			}
			else
			{
				$update1 = "UPDATE albums SET coverPic = '".$_REQUEST["coverPic"]."' WHERE url = '".$_REQUEST["lban"]."';";
				$res1 = mysqli_query($db,$update1);
				if($res1)
				{
				$statusMsg .= "<p align='center'>Success! Track Title has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Track Title could not be updated. Please try again later.</p>";
				}
			}
}
			$statusMsg .= $_REQUEST["statusMsg"];
			if(!$statusMsg)
			{
			echo "<p align='center'>No changes have been made.</p>";
			}
			else
			{
			echo $statusMsg;
			}
			}
		}
		elseif($_REQUEST["lban"] && $_REQUEST["idx"])
		{
			if(!$_REQUEST["Submit"])
			{
		echo "<table id='tables_css' align='center'><tr><td><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&unitx=3&lban=".$_REQUEST["lban"]."'>Back to Album</a></td></tr></table>";
	
	$query2v = "SELECT * FROM tracks  WHERE (id = '".$_REQUEST["idx"]."');";
	$result2v = mysqli_query($db,$query2v);
	@$rwv = mysqli_fetch_array($result2v);
	$id = $rwv["id"];
	$track_title = $rwv["track_title"];
	$artist = $rwv["artist"];
	$contributing_artists = $rwv["contributing_artists"];
	$album = $rwv["album"];
	$track_number = $rwv["track_number"];
	$file_size = $rwv["file_size"];
	$VideoURL = $rwv["VideoURL"];
	$genre = $rwv["genre"];
	$publisher = $rwv["publisher"];
	$studio = $rwv["studio"];
	$songwriters = $rwv["songwriters"];
	$producer = $rwv["producer"];
	$copyright = $rwv["copyright"];
	$protected = $rwv["protected"];
	$date_of_release = $rwv["date_of_release"];
	$comment = $rwv["comment"];
	
	if($protected=="Yes")
	{
	$paidDownload = "checked";
	$freeDownload = "";
	}
	else
	{
	$paidDownload = "";
	$freeDownload = "checked";	
	}
	
	$VideoURLx = "http://www.youtube.com".$VideoURL;
	
	$selGen1 = "SELECT * FROM albums WHERE url = '".$album."';";
	$resGen1 = mysqli_query($db,$selGen1);
	$rowGen1 = mysqli_fetch_array($resGen1);
	$albumName = $rowGen1["album"];
	
	$selGen = "SELECT * FROM genres WHERE id = '".$genre."';";
	$resGen = mysqli_query($db,$selGen);
	$rowGen = mysqli_fetch_array($resGen);
	$genreName = $rowGen["name"];
	?>
	<form action="" method="POST">
<input name="artist" type="hidden" value="<?php echo $userID;?>">
<?php
$D_Num = $a +1;
?>
<input name="track_number" type="hidden" value="">
<table align="center" width="98%" align="center" id="tables_css" bgcolor="#cfcfcf">
<tr>
<td><b>Title:</b><br><input name="track_title" type="text" size="30" value="<?php echo $track_title;?>"></td><td><b>Album:</b><br><select name="album">
<?php
echo "<option value='".$album."'>".$albumName."</option>";
$selX1 = "SELECT * FROM albums WHERE artist = '".$userID."';";
$resX1 = mysqli_query($db,$selX1);
@$numX1 = mysqli_num_rows($resX1);
for($y1=0; $y1<$numX1; $y1++)
{
$rwX1 = mysqli_fetch_array($resX1);
$IDX1 = $rwX1["url"];
$genX1 = $rwX1["album"];
if($IDX1==$album)
{

}
else
{
echo '<option value="'.$IDX1.'">'.$genX1.'</option>';
}
}
?></td><td><b>Contributing Artists:</b><br><input name="contributing_artists" type="text" size="30" value="<?php echo $contributing_artists;?>"></td><td><b>Genre:</b><br><select name="genre">
<?php
echo "<option value='".$genre."'>".$genreName."</option>";
$selX = "SELECT * FROM genres;";
$resX = mysqli_query($db,$selX);
@$numX = mysqli_num_rows($resX);
for($y=0; $y<$numX; $y++)
{
$rwX = mysqli_fetch_array($resX);
$IDX = $rwX["id"];
$genX = $rwX["name"];
if($genre==$IDX)
{

}
else
{
echo '<option value="'.$IDX.'">'.$genX.'</option>';
}
}
?></td>
</tr>
<tr>
<td><b>Studio:</b><br><input name="studio" type="text" size="30" value="<?php echo $studio;?>"></td><td><b>Song Writers:<br></b><input name="songwriters" type="text" size="30" value="<?php echo $songwriters;?>"></td><td><b>Producer:</b><br><input name="producer" type="text" size="30" value="<?php echo $producer;?>"></td><td><b>Copyright:</b><br><input name="copyright" type="text" size="30" value="<?php echo $copyright;?>"></td>
</tr>
<tr>
<td><b>Date Released:</b><br><label id="cx_DateOfIssue"><input name="date_of_release" type="text" size="10" value="<?php echo $date_of_release;?>" id="x_DateOfIssue" maxlength="10">
&nbsp;<img src="misc/ew_calendar.gif" id="cx_DateOfIssue" alt="Pick a Date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup(
{
inputField : "x_DateOfIssue", // ID of the input field
ifFormat : "%Y-%m-%d", // the date format
button : "cx_DateOfIssue" // ID of the button
}
);
</script></label><br><br>
<b>Paid Download:</b><input name="protected" type="radio" value="Yes" <?php echo $paidDownload;?>><br>
<b>Free Download:</b><input name="protected" type="radio" value="No" <?php echo $freeDownload;?>></td><td><b>Comment:<br></b><textarea name="comment" rows="3" cols="20"><?php echo $comment;?></textarea></td><td><b>Video Link <br>(YouTube only):</b><br><input name="video_url" type="text" size="30" value="<?php echo $VideoURLx;?>"></td><td></td>
</tr>
</table>
<?php
if($D_Num==$NumberofTracks)
{
echo "";
}
else
{
echo "<br>";
}
?>
<table align="center" width="93%" align="center" id="">
<tr>
<td><b><br><input name="Submit" type="submit" value="Submit"></b></td><td><b></b></td><td><b></b></td><td></td>
</tr>
</table>
	</form>
	<?php
			}
			elseif($_REQUEST["Submit"]=="Submit")
			{
		echo "<table id='tables_css' align='center'><tr><td><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&unitx=3&lban=".$_REQUEST["lban"]."'>Back to Album</a></td><td width='20'></td><td><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=2&unitx=3&lban=".$_REQUEST["lban"]."&idx=".$_REQUEST["idx"]."'>Continue Editing</a></td></tr></table>";
	
	$query2v = "SELECT * FROM tracks  WHERE (id = '".$_REQUEST["idx"]."');";
	$result2v = mysqli_query($db,$query2v);
	@$rwv = mysqli_fetch_array($result2v);
	$id = $rwv["id"];
	$track_title = $rwv["track_title"];
	$artist = $rwv["artist"];
	$contributing_artists = $rwv["contributing_artists"];
	$album = $rwv["album"];
	$track_number = $rwv["track_number"];
	$file_size = $rwv["file_size"];
	$VideoURL = $rwv["VideoURL"];
	$genre = $rwv["genre"];
	$publisher = $rwv["publisher"];
	$studio = $rwv["studio"];
	$songwriters = $rwv["songwriters"];
	$producer = $rwv["producer"];
	$copyright = $rwv["copyright"];
	$protected = $rwv["protected"];
	$date_of_release = $rwv["date_of_release"];
	$comment = $rwv["comment"];	
	
	$statusMsg = "";
	
			if($_REQUEST["track_title"]==$track_title)
			{
			
			}
			else
			{
				$update1 = "UPDATE tracks SET track_title = '".$_REQUEST["track_title"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res1 = mysqli_query($db,$update1);
				if($res1)
				{
				$statusMsg .= "<p align='center'>Success! Track Title has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Track Title could not be updated. Please try again later.</p>";
				}
			}
			
			if($_REQUEST["album"]==$album)
			{
			
			}
			else
			{
				$update2 = "UPDATE tracks SET album = '".$_REQUEST["album"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res2 = mysqli_query($db,$update2);
				if($res2)
				{
				$statusMsg .= "<p align='center'>Success! Album has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Album could not be updated. Please try again later.</p>";
				}
			}
			
			if($_REQUEST["contributing_artists"]==$contributing_artists)
			{
			
			}
			else
			{
				$update3 = "UPDATE tracks SET contributing_artists = '".$_REQUEST["contributing_artists"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res3 = mysqli_query($db,$update3);
				if($res3)
				{
				$statusMsg .= "<p align='center'>Success! Contributing Artists have been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Contributing Artists could not be updated. Please try again later.</p>";
				}
			}
			
			if($_REQUEST["genre"]==$genre)
			{
			
			}
			else
			{
				$update4 = "UPDATE tracks SET genre = '".$_REQUEST["genre"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res4 = mysqli_query($db,$update4);
				if($res4)
				{
				$statusMsg .= "<p align='center'>Success! Track title has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Track title could not be updated. Please try again later.</p>";
				}
			}
			
			if($_REQUEST["studio"]==$studio)
			{
			
			}
			else
			{
				$update5 = "UPDATE tracks SET studio = '".$_REQUEST["studio"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res5 = mysqli_query($db,$update5);
				if($res5)
				{
				$statusMsg .= "<p align='center'>Success! Studio has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Studio could not be updated. Please try again later.</p>";
				}
			}
			
			if($_REQUEST["songwriters"]==$songwriters)
			{
			
			}
			else
			{
				$update6 = "UPDATE tracks SET songwriters = '".$_REQUEST["songwriters"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res6 = mysqli_query($db,$update6);
				if($res6)
				{
				$statusMsg .= "<p align='center'>Success! Song writers have been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error!  Song writers could not be updated. Please try again later.</p>";
				}
			}
			
			if($_REQUEST["producer"]==$producer)
			{
			
			}
			else
			{
				$update7 = "UPDATE tracks SET producer = '".$_REQUEST["producer"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res7 = mysqli_query($db,$update7);
				if($res7)
				{
				$statusMsg .= "<p align='center'>Success! Producer has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Producer could not be updated. Please try again later.</p>";
				}
			}
			
			if($_REQUEST["copyright"]==$copyright)
			{
			
			}
			else
			{
				$update8 = "UPDATE tracks SET copyright = '".$_REQUEST["copyright"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res8 = mysqli_query($db,$update8);
				if($res8)
				{
				$statusMsg .= "<p align='center'>Success! Copyright has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Copyright could not be updated. Please try again later.</p>";
				}
			}
			
			if($_REQUEST["date_of_release"]==$date_of_release)
			{
			
			}
			else
			{
				$update9 = "UPDATE tracks SET date_of_release = '".$_REQUEST["date_of_release"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res9 = mysqli_query($db,$update9);
				if($res9)
				{
				$statusMsg .= "<p align='center'>Success! Date of Release has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Date of Release could not be updated. Please try again later.</p>";
				}
			}
			
			if($_REQUEST["comment"]==$comment)
			{
			
			}
			else
			{
				$update10 = "UPDATE tracks SET comment = '".$_REQUEST["comment"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res10 = mysqli_query($db,$update10);
				if($res10)
				{
				$statusMsg .= "<p align='center'>Success! Comment has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Comment could not be updated. Please try again later.</p>";
				}
			}
	
 $vv = explode ("youtube.com", $_REQUEST["video_url"]);
 $vvv = $vv[1];
 
if(!$vvv=="")
{
$YTubeURL = $vvv;
}
else
{
$YTubeURL = "";
}		
			if($YTubeURL==$VideoURL)
			{
			
			}
			else
			{
				$update11 = "UPDATE tracks SET VideoURL = '".$YTubeURL."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res11 = mysqli_query($db,$update11);
				if($res11)
				{
				$statusMsg .= "<p align='center'>Success! Video URL has been updated.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Video URL could not be updated. Please try again later.</p>";
				}
			}		
			
			if($_REQUEST["protected"]==$protected)
			{
			
			}
			else
			{
				if($_REQUEST["protected"]=="Yes")
				{
				$downloadStatus = $_REQUEST["track_title"]." has been set to be a Paid Download.";
				}
				else
				{
				$downloadStatus = $_REQUEST["track_title"]." has been set to be a Free Download.";
				}
				
				$update11 = "UPDATE tracks SET protected = '".$_REQUEST["protected"]."' WHERE (id = '".$_REQUEST["idx"]."');";
				$res11 = mysqli_query($db,$update11);
				if($res11)
				{
				$statusMsg .= "<p align='center'>Success! ".$downloadStatus."</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! Download Status could not be updated. Please try again later.</p>";
				}
			}
			
			if($statusMsg)
			{
			echo $statusMsg;
			}
			else
			{
			echo "<p align='center'>No changes have been made.</p>";
			}
		  }	
		}
	}
	elseif($_REQUEST["unit"]=="3")
	{
		
		echo "<table id='tables_css' align='center'><tr><td><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&unitx=3&lban=".$_REQUEST["lban"]."'>Back to Album</a></td></tr></table>";
	
	$query2v = "SELECT * FROM tracks  WHERE (id = '".$_REQUEST["idx"]."');";
	$result2v = mysqli_query($db,$query2v);
	@$rwv = mysqli_fetch_array($result2v);
	$id = $rwv["id"];
	$track_title = $rwv["track_title"];
	$artist = $rwv["artist"];
	$contributing_artists = $rwv["contributing_artists"];
	$album = $rwv["album"];
	$track_number = $rwv["track_number"];
	$file_size = $rwv["file_size"];
	$VideoURL = $rwv["VideoURL"];
	$genre = $rwv["genre"];
	$publisher = $rwv["publisher"];
	$studio = $rwv["studio"];
	$songwriters = $rwv["songwriters"];
	$producer = $rwv["producer"];
	$copyright = $rwv["copyright"];
	$protected = $rwv["protected"];
	$date_of_release = $rwv["date_of_release"];
	$comment = $rwv["comment"];
	$file_url = $rwv["file_url"];	
	$file_typeX = $rwv["file_type"];	
	
	$VideoURLx = "http://www.youtube.com".$VideoURL;
	
	$selGen1 = "SELECT * FROM albums WHERE url = '".$album."';";
	$resGen1 = mysqli_query($db,$selGen1);
	$rowGen1 = mysqli_fetch_array($resGen1);
	$albumName = $rowGen1["album"];
	
	$selGen = "SELECT * FROM genres WHERE id = '".$genre."';";
	$resGen = mysqli_query($db,$selGen);
	$rowGen = mysqli_fetch_array($resGen);
	$genreName = $rowGen["name"];
	
	if(!$_REQUEST["deleteBtn"])
	{
	?>
	<form action="" method="post">
	<table id="tables_css3" width="700" align="center">
		<tr>
			<td>Are you sure you want to delete your track <b><?php echo $track_title;?></b> from your album <b><?php echo $albumName;?></b></td><td><input name="deleteBtn" type="submit" value="Delete"></td>
		</tr>
	</table>
	</form>
	<?php
	}
	else
	{
				$statusMsg = "";
				
				$delte = "DELETE FROM tracks WHERE (id = '".$_REQUEST["idx"]."');";
				$resDlt = mysqli_query($db,$delte);
				if($resDlt)
				{
				$statusMsg .= "<p align='center'>Success! ".$track_title." has been deleted.</p>";
	
	$selTr2 = "SELECT * FROM meta WHERE meta_data = '".$file_url."';";
	$resTr2 = mysqli_query($db,$selTr2);
	$rowTr2 = mysqli_fetch_array($resTr2);
	$file_nameX = $rowTr2["data"];
	
	$selTr3 = "SELECT * FROM meta WHERE meta_data = '".$album."';";
	$resTr3 = mysqli_query($db,$selTr3);
	$rowTr3 = mysqli_fetch_array($resTr3);
	$album_nameX = $rowTr3["data"];
	
		$destination_path = $sel2x."".$track_title.".".$file_type;
		$source_path = "uploads/".$moment."/".$album_nameX."/".$file_nameX.".php";
		
		
				$delte2 = "DELETE FROM meta WHERE (meta_data = '".$file_url."');";
				$resDlt2 = mysqli_query($db,$delte2);
				
				unlink($source_path);
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! ".$track_title." could not be deleted. Please try again later.</p>";
				}
			
			if($statusMsg)
			{
			echo $statusMsg;
			}
			else
			{
			echo "<p align='center'>No changes have been made.</p>";
			}
	}
	
	}
	elseif($_REQUEST["unit"]=="4")
	{
		if(!$_REQUEST["insertBtn"])
		{
		echo "<table id='tables_css' align='center'><tr><td><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=e1&function=&unit=1&unitx=3&lban=".$_REQUEST["lban"]."'>Back to Album</a></td></tr></table>";
	
	$query2v = "SELECT * FROM tracks  WHERE (id = '".$_REQUEST["idx"]."');";
	$result2v = mysqli_query($db,$query2v);
	@$rwv = mysqli_fetch_array($result2v);
	$id = $rwv["id"];
	$track_title = $rwv["track_title"];
	$artist = $rwv["artist"];
	$contributing_artists = $rwv["contributing_artists"];
	$album = $rwv["album"];
	$track_number = $rwv["track_number"];
	$file_size = $rwv["file_size"];
	$VideoURL = $rwv["VideoURL"];
	$genre = $rwv["genre"];
	$publisher = $rwv["publisher"];
	$studio = $rwv["studio"];
	$songwriters = $rwv["songwriters"];
	$producer = $rwv["producer"];
	$copyright = $rwv["copyright"];
	$protected = $rwv["protected"];
	$date_of_release = $rwv["date_of_release"];
	$comment = $rwv["comment"];	
	
	$VideoURLx = "http://www.youtube.com".$VideoURL;
	
	$selGen1 = "SELECT * FROM albums WHERE url = '".$_REQUEST["lban"]."';";
	$resGen1 = mysqli_query($db,$selGen1);
	$rowGen1 = mysqli_fetch_array($resGen1);
	$albumName = $rowGen1["album"];
	
	$selGen = "SELECT * FROM genres WHERE id = '".$genre."';";
	$resGen = mysqli_query($db,$selGen);
	$rowGen = mysqli_fetch_array($resGen);
	$genreName = $rowGen["name"];
	?>
	<form action="" method="POST" enctype="multipart/form-data">
<input name="artist" type="hidden" value="<?php echo $userID;?>">
<?php
$D_Num = $a +1;
?>
<input name="track_number" type="hidden" value="">
<table align="center" width="98%" align="center" id="tables_css" bgcolor="#cfcfcf">
<tr>
<td><b>Title:</b><br><input name="track_title" type="text" size="30" value="<?php echo $track_title;?>"></td><td><b>Album:</b><br><select name="album">
<?php
echo "<option value='".$_REQUEST["lban"]."'>".$albumName."</option>";
$selX1 = "SELECT * FROM albums WHERE artist = '".$userID."';";
$resX1 = mysqli_query($db,$selX1);
@$numX1 = mysqli_num_rows($resX1);
for($y1=0; $y1<$numX1; $y1++)
{
$rwX1 = mysqli_fetch_array($resX1);
$IDX1 = $rwX1["url"];
$genX1 = $rwX1["album"];
if($IDX1==$_REQUEST["lban"])
{

}
else
{
echo '<option value="'.$IDX1.'">'.$genX1.'</option>';
}
}
?></td><td><b>Contributing Artists:</b><br><input name="contributing_artists" type="text" size="30" value="<?php echo $contributing_artists;?>"></td><td><b>Genre:</b><br><select name="genre">
<?php
echo "<option value='".$genre."'>".$genreName."</option>";
$selX = "SELECT * FROM genres;";
$resX = mysqli_query($db,$selX);
@$numX = mysqli_num_rows($resX);
for($y=0; $y<$numX; $y++)
{
$rwX = mysqli_fetch_array($resX);
$IDX = $rwX["id"];
$genX = $rwX["name"];
if($genre==$IDX)
{

}
else
{
echo '<option value="'.$IDX.'">'.$genX.'</option>';
}
}
?></td>
</tr>
<tr>
<td><b>Studio:</b><br><input name="studio" type="text" size="30" value="<?php echo $studio;?>"></td><td><b>Song Writers:<br></b><input name="songwriters" type="text" size="30" value="<?php echo $songwriters;?>"></td><td><b>Producer:</b><br><input name="producer" type="text" size="30" value="<?php echo $producer;?>"></td><td><b>Copyright:</b><br><input name="copyright" type="text" size="30" value="<?php echo $copyright;?>"></td>
</tr>
<tr>
<td><b>Date Released:</b><br><input name="date_of_release" type="text" size="10" value="<?php echo $date_of_release;?>"></td><td><b>Comment:<br></b><textarea name="comment" rows="3" cols="20"><?php echo $comment;?></textarea></td><td><b>Video Link <br>(YouTube only):</b><br><input name="VideoURL" type="text" size="30" value="<?php echo $VideoURLx;?>"></td><td><b>Upload File (MP3 only):</b><br><input name="audio_url" type="file" accept="audio/mp3"></td>
</tr>
</table>
<?php
if($D_Num==$NumberofTracks)
{
echo "";
}
else
{
echo "<br>";
}
?>
<table align="center" width="93%" align="center" id="">
<tr>
<td><b><br><input name="insertBtn" type="submit" value="Add Track"></b></td><td><b></b></td><td><b></b></td><td></td>
</tr>
</table>
	</form>
	<?php
		}
		elseif($_REQUEST["insertBtn"]=="Add Track")
		{
@$year = date(Y);
@$day = date(z);
@$hour = date(G);
@$hour2 = date(h);
@$mins = date(i);
@$sec = date(s);

		$sess_id = rand(0, 999999999999999999999);
		$timex = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60)+($mins*60)+$sec;
		$cccA = md5($timex." || ".$sess_id." || ".$userID." || ".SesVar());
		$cccB = md5($timex." |L| ".$sess_id." |M| ".$userID." |N| ".SesVar());
	
	$selTr3 = "SELECT * FROM meta WHERE meta_data = '".$_REQUEST["album"]."';";
	$resTr3 = mysqli_query($db,$selTr3);
	$rowTr3 = mysqli_fetch_array($resTr3);
	$album_nameX = $rowTr3["data"];
	
	$sel2 = $album_nameX;
	$sel2x = "uploads/".$moment."/".$sel2."/";
	$target = $sel2x; 
	
if($_FILES['audio_url'] ['name'])
{
 $target = $target . basename( $_FILES['audio_url'] ['name']) ;
 
 if(move_uploaded_file($_FILES['audio_url'] ['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['audio_url'] ['name']). " has been uploaded";
 $rename = "success"; 
 
@$yearx = date(Y);
@$dayx = date(z);
@$hourx = date(G);
@$hour2x = date(h);
@$minsx = date(i);
@$secx = date(s);

		$sess_idx = rand(0, 999999999999999999999999);
		$timexx = ($yearx*365*24*60*60)+($dayx*24*60*60)+($hourx*60*60)+($minsx*60)+$secx;
		$cccx = md5($timexx." || ".$sess_idx." || ".$userID." || ".SesVar()." |D| 1");
		$cccx2 = md5($timexx." |A| ".$sess_idx." |B| ".$userID." |C| ".SesVar()." |D| 1");

$name1 = $sel2x."/".basename( $_FILES['audio_url'] ['name']);	
$name2 = $sel2x."/".$cccx.".php";

 $renameX = rename($name1,$name2);

 $vv = explode ("youtube.com", $_REQUEST["VideoURL"] );
 $vvv = $vv[1];
 
if(!$vvv=="")
{
$YTubeURL = $vvv;
}
else
{
$YTubeURL = "";
}

$insertX = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".$userID."','".$cccx."','".$cccx2."','');";
@$resINSX = mysqli_query($db,$insertX);

$insert = "INSERT INTO tracks (id,file_type,file_size,file_url,VideoURL,track_title,artist,contributing_artists,album,track_number,genre,publisher,studio,songwriters,producer,copyright,protected,date_of_release,comment,uid,org,town,province,country) VALUES ('','".$_FILES['audio_url'] ['type']."',".($_FILES['audio_url'] ['size'] / 1024).",'".$cccx2."','".$YTubeURL."','".$_REQUEST["track_title"] ."','".$userID."','".$_REQUEST["contributing_artists"] ."','".$_REQUEST["album"]."','".$_REQUEST["track_number"] ."','".$_REQUEST["genre"] ."','".$_REQUEST["publisher"] ."','".$_REQUEST["studio"] ."','".$_REQUEST["songwriters"] ."','".$_REQUEST["producer"] ."','".$_REQUEST["copyright"] ."','Yes','".$_REQUEST["date_of_release"] ."','".$_REQUEST["comment"] ."','".$userID."','".$org."','".$town."','".$province."','".$country."');";
@$resINS = mysqli_query($db,$insert);
 }
 else 
 {
 echo "Sorry, there was a problem uploading your file.";
 $rename = "";
 }
			
			if($rename)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
			
}
else
{
echo "Error! No file uploaded.";
}
		}
	}
	elseif($_REQUEST["unit"]=="5")
	{	
	$selA = "SELECT * FROM albums WHERE url = '".$_REQUEST["lban"]."';";
	$resA = mysqli_query($db,$selA);
	@$rwA = mysqli_fetch_array($resA);
	$contributing_artists = $rwA["contributing_artists"];
	$album = $rwA["album"];
	$publisher = $rwA["publisher"];
	$date_of_release = $rwA["date_of_release"];
	$coverPic = $rwA["coverPic"];
	
	
	if(!$_REQUEST["deleteBtn"])
	{
	?>
	<form action="" method="post">
	<table id="tables_css3" width="700" align="center">
		<tr>
			<td>Are you sure you want to delete your album <b><?php echo $album;?></b>?</td><td><input name="deleteBtn" type="submit" value="Delete"></td>
		</tr>
	</table>
	</form>
	<?php
	}
	else
	{
				$statusMsg = "";
				$alS = "SELECT * FROM tracks WHERE album = '".$_REQUEST["lban"]."';";
				$ralS = mysqli_query($db,$alS);
				@$nalS = mysqli_num_rows($ralS);
				for($r=0; $r<$nalS; $r++)
				{
				$rwS = mysqli_fetch_array($ralS);
				$idx = $rwS["id"];
				$track_title = $rwS["track_title"];
				$file_size = $rwS["file_size"];
				$file_url = $rwS["file_url"];	
				$file_typeX = $rwS["file_type"];
				
	$selTr2 = "SELECT * FROM meta WHERE meta_data = '".$file_url."';";
	$resTr2 = mysqli_query($db,$selTr2);
	$rowTr2 = mysqli_fetch_array($resTr2);
	$file_nameX = $rowTr2["data"];
	
	$selTr3 = "SELECT * FROM meta WHERE meta_data = '".$_REQUEST["lban"]."';";
	$resTr3 = mysqli_query($db,$selTr3);
	$rowTr3 = mysqli_fetch_array($resTr3);
	$album_nameX = $rowTr3["data"];
	
	$sel2 = $album_nameX;
	$sel2x = "uploads/".$moment."/".$sel2."/";
		$destination_path = $sel2x."".$track_title.".".$file_type;
		$source_path = "uploads/".$moment."/".$album_nameX."/".$file_nameX.".php";
		
		
				$delte2 = "DELETE FROM meta WHERE (meta_data = '".$file_url."');";
				$resDlt2 = mysqli_query($db,$delte2);
				
				$delte2x = "DELETE FROM tracks WHERE (id = '".$idx."');";
				$resDlt2x = mysqli_query($db,$delte2x);
				
				unlink($source_path);
				}
				
				$delte = "DELETE FROM albums WHERE (url = '".$_REQUEST["lban"]."');";
				$resDlt = mysqli_query($db,$delte);
				
				unlink("coverimages/".$coverPic);
				rmdir("uploads/".$moment."/".$album_nameX);
				
				if($resDlt)
				{
				$statusMsg .= "<p align='center'>Success! ".$album." has been deleted.</p>";
				}
				else
				{
				$statusMsg .= "<p align='center'>Error! ".$album." could not be deleted. Please try again later.</p>";
				}
			
			if($statusMsg)
			{
			echo $statusMsg;
			}
			else
			{
			echo "<p align='center'>No changes have been made.</p>";
			}
	}
	}
	}
	else
	{
	//Security Breach
	include "mis/access_denied.php";
	//Security Breach
	}
}
?>