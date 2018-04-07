<?php
if(($_REQUEST["segment"]=="a1" && $_REQUEST["unit"]=="1" && !$_REQUEST["function"]) || (($_REQUEST["segment"]=="a1" && $_REQUEST["unit"]=="1" && $_REQUEST["function"]=="Upload") && $_REQUEST["NumberofTracks"]<="0"))
{
?>
<form action="?ref=<?php echo $_REQUEST["ref"];?>&segment=<?php echo $_REQUEST["segment"];?>&function=Upload&unit=<?php echo $_REQUEST["unit"];?>" method ="post" id="form1" enctype="multipart/form-data">
<input name="artist" type="hidden" value="<?php echo $userID;?>">
<table align="center" width="500" align="center" id="tables_css">
<tr>
<td><b>Album</b></td><td><input name="album" type="text" size="35"></td>
</tr>
<tr>
<td><b>Contributing Artists</b></td><td><input name="contributing_artists" type="text" size="35"></td>
</tr>
<tr>
<td><b>Publisher</b></td><td><input name="publisher" type="text" size="35"></td>
</tr>
<tr>
<td><b>Number of Tracks</b></td><td><input name="NumberofTracks" type="text" size="35"></td>
</tr>
<tr>
<td><b>Date of Release</b></td><td><label id="cx_DateOfIssue"><input name="date_of_release" type="text" size="35" id="x_DateOfIssue" maxlength="10">
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
<td><b>CD/Song Artwork </b></td><td><input name="CoverImage" type="file" size="35" accept="image/jpeg"></td>
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
elseif(($_REQUEST["segment"]=="a1" && $_REQUEST["unit"]=="1" && $_REQUEST["function"]=="Upload") && $_REQUEST["NumberofTracks"]>="1")
{
 
$target = "coverimages/"; 
 
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

		
		<form action="?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=a1&function=Upload&unit=1&task=Enter_Data" method="post" onsubmit="return checkCoords();">
			<input type="hidden" name="x2" value="IMG"/>
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
 
}
?>
<form action="?ref=<?php echo $_REQUEST["ref"];?>&segment=<?php echo $_REQUEST["segment"];?>&function=Upload&unit=2" method ="post" id="form1" enctype="multipart/form-data">
<input name="artist" type="hidden" value="<?php echo $userID;?>">
<input name="coverPic" type="hidden" value="<?php echo $_REQUEST["coverPic"];?>">
<input name="contributing_artists" type="hidden" value="<?php echo $_REQUEST["contributing_artists"];?>">
<input name="album" type="hidden" value="<?php echo $_REQUEST["album"];?>">
<input name="publisher" type="hidden" value="<?php echo $_REQUEST["publisher"];?>">
<input name="NumberofTracks" type="hidden" value="<?php echo $_REQUEST["NumberofTracks"];?>">
<input name="date_of_release" type="hidden" value="<?php echo $_REQUEST["date_of_release"];?>">
<input name="Comments" type="hidden" value="<?php echo $_REQUEST["Comments"];?>">
<?php
$NumberofTracks = $_REQUEST["NumberofTracks"];
for($a=0; $a<$NumberofTracks; $a++)
{
$D_Num = $a +1;
?>
<input name="track_number<?php echo $D_Num;?>" type="hidden" value="<?php echo $D_Num;?>">
<table align="center" width="98%" align="center" id="tables_css" bgcolor="#cfcfcf">
<tr>
<td><b>Track Number <?php echo $D_Num;?></b></td><td><b>Title:</b><br><input name="track_title<?php echo $D_Num;?>" type="text" size="20"></td><td><b>Contributing Artists:</b><br><input name="contributing_artists<?php echo $D_Num;?>" type="text" size="20" value="<?php echo $_REQUEST["contributing_artists"];?>"></td><td><b>Genre:</b><br><select name="genre<?php echo $D_Num;?>">
<?php
$selX = "SELECT * FROM genres;";
$resX = mysqli_query($db,$selX);
@$numX = mysqli_num_rows($resX);
for($y=0; $y<$numX; $y++)
{
$rwX = mysqli_fetch_array($resX);
$IDX = $rwX["id"];
$genX = $rwX["name"];
echo '<option value="'.$IDX.'">'.$genX.'</option>';
}
?></td>
</tr>
<tr>
<td><b>Studio:</b><br><input name="studio<?php echo $D_Num;?>" type="text" size="20"></td><td><b>Song Writers:<br></b><input name="songwriters<?php echo $D_Num;?>" type="text" size="20"></td><td><b>Producer:</b><br><input name="producer<?php echo $D_Num;?>" type="text" size="20"></td><td><b>Copyright:</b><br><input name="copyright<?php echo $D_Num;?>" type="text" size="20"></td>
</tr>
<tr>
<td><b>Date Released:</b><br><label id="cx_DateOfIssue<?php echo $D_Num;?>"><input name="date_of_release<?php echo $D_Num;?>" type="text" size="10" value="<?php echo $_REQUEST["date_of_release"];?>" id="x_DateOfIssue<?php echo $D_Num;?>" maxlength="10">
&nbsp;<img src="misc/ew_calendar.gif" id="cx_DateOfIssue<?php echo $D_Num;?>" alt="Pick a Date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup(
{
inputField : "x_DateOfIssue<?php echo $D_Num;?>", // ID of the input field
ifFormat : "%Y-%m-%d", // the date format
button : "cx_DateOfIssue<?php echo $D_Num;?>" // ID of the button
}
);
</script></label><br><br>
<b>Paid Download:</b><input name="protected<?php echo $D_Num;?>" type="radio" value="Yes" checked><br>
<b>Free Download:</b><input name="protected<?php echo $D_Num;?>" type="radio" value="No">
</td><td><b>Comment:<br></b><textarea name="comment<?php echo $D_Num;?>" rows="3" cols="20"></textarea></td><td><b>Video Link <br>(YouTube only):</b><br><input name="video_url<?php echo $D_Num;?>" type="text" size="20"></td><td><b>Upload File (MP3 only)</b><br><input name="audio_url<?php echo $D_Num;?>" type="file" size="20" accept="audio/mp3"></td>
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
elseif(($_REQUEST["segment"]=="a1" && $_REQUEST["unit"]=="2" && $_REQUEST["function"]=="Upload") && $_REQUEST["NumberofTracks"]>="1")
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
		
$sel2 = $cccA;
$create = mkdir("uploads/".$moment."/".$sel2);
$sel2x = "uploads/".$moment."/".$sel2."/";

$insertXA = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".$userID."','".$cccA."','".$cccB."','');";
@$resINSXA = mysqli_query($db,$insertXA);

$insert = "INSERT INTO albums (id,artist,contributing_artists,album,number_tracks,publisher,copyright,protected,date_created,date_of_release,url,coverPic,Comments,uid,org,town,province,country) VALUES ('','".$userID."','".$_REQUEST["contributing_artists"]."','".$_REQUEST["album"]."','".$_REQUEST["NumberofTracks"]."','".$_REQUEST["publisher"]."','".$_REQUEST["copyright"]."','Yes','".$_REQUEST["date_created"]."','".$_REQUEST["date_of_release"]."','".$cccB."','".$_REQUEST["coverPic"]."','".$_REQUEST["Comments"]."','".$userID."','".$org."','".$town."','".$province."','".$country."');";
@$resINS = mysqli_query($db,$insert);

if($resINS)
{
$NumberofTracks = $_REQUEST["NumberofTracks"];
for($a=0; $a<$NumberofTracks; $a++)
{
$D_Num = $a +1;
$target = $sel2x; 
 
if($_FILES['audio_url'.$D_Num]['name'])
{
 $target = $target . basename( $_FILES['audio_url'.$D_Num]['name']) ;
 
 if(move_uploaded_file($_FILES['audio_url'.$D_Num]['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['audio_url'.$D_Num]['name']). " has been uploaded";
 $rename = "success"; 
 
@$yearx = date(Y);
@$dayx = date(z);
@$hourx = date(G);
@$hour2x = date(h);
@$minsx = date(i);
@$secx = date(s);

		$sess_idx = rand(0, 999999999999999999999999);
		$timexx = ($yearx*365*24*60*60)+($dayx*24*60*60)+($hourx*60*60)+($minsx*60)+$secx;
		$cccx = md5($timexx." || ".$sess_idx." || ".$userID." || ".SesVar()." |D| ".$D_Num);
		$cccx2 = md5($timexx." |A| ".$sess_idx." |B| ".$userID." |C| ".SesVar()." |D| ".$D_Num);
		$cccx4 = md5($timexx." |".(rand(0, 9999999999999998))."| ".$sess_idx." |B| ".$userID." |".(rand(9999999999999999, 999999999999999999999999))."| ".SesVar()." |D| ".$D_Num);
		$cccx5 = md5($timexx." |".(rand(0, 9999999999999998))."A| ".$sess_idx." |B| ".$userID." |".(rand(9999999999999999, 999999999999999999999999))."B| ".SesVar()." |D| ".$D_Num);
		$cccx6 = md5($timexx." |B".(rand(0, 9999999999999998))."A| ".$sess_idx." |B| ".$userID." |C".(rand(9999999999999999, 999999999999999999999999))."B| ".SesVar()." |D| ".$D_Num);
		
$name1 = $sel2x."/".basename( $_FILES['audio_url'.$D_Num]['name']);	
$name2 = $sel2x."/".$cccx.".php";

 $renameX = rename($name1,$name2);

 $vv = explode ("youtube.com", $_REQUEST["VideoURL".$D_Num]);
 $vvv = $vv[1];
 
if(!$vvv=="")
{
$YTubeURL = $vvv;
}
else
{
$YTubeURL = "";
}


$file_name = $cccx.".php";
	
$NCrypt = crypt_my_file($sel2x,$file_name,$cccx6,$cccx4);
$gth = explode("|",$NCrypt);
$cccx3 = $gth[0];
$bitrate = $gth[1];

 if(unlink($name2))
 {
 $tempFiles = "<p>Temporary files removed successfully</p>";
 }
 else
 {
 $tempFiles = "<p>Error removing temporary files.</p>";
 }

 echo $tempFiles;
 
 
${$D_Num."insertX"} = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".$cccx5."','".$cccx3."','".$cccx2."','');";
@${$D_Num."resINSX"} = mysqli_query($db,${$D_Num."insertX"});

${$D_Num."insertX2"} = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".$cccx6."','".$cccx4."','".$cccx5."','');";
@${$D_Num."resINSX2"} = mysqli_query($db,${$D_Num."insertX2"});

${$D_Num."insert"} = "INSERT INTO tracks (id,file_type,bitrate,file_size,file_url,VideoURL,track_title,artist,contributing_artists,album,track_number,genre,publisher,studio,songwriters,producer,copyright,protected,date_of_release,comment,uid,org,town,province,country) VALUES ('','".$_FILES['audio_url'.$D_Num]['type']."','".$bitrate."',".($_FILES['audio_url'.$D_Num]['size'] / 1024).",'".$cccx2."','".$YTubeURL."','".$_REQUEST["track_title".$D_Num]."','".$userID."','".$_REQUEST["contributing_artists".$D_Num]."','".$cccB."','".$_REQUEST["track_number".$D_Num]."','".$_REQUEST["genre".$D_Num]."','".$_REQUEST["publisher".$D_Num]."','".$_REQUEST["studio".$D_Num]."','".$_REQUEST["songwriters".$D_Num]."','".$_REQUEST["producer".$D_Num]."','".$_REQUEST["copyright".$D_Num]."','".$_REQUEST["protected".$D_Num]."','".$_REQUEST["date_of_release".$D_Num]."','".$_REQUEST["comment".$D_Num]."','".$userID."','".$org."','".$town."','".$province."','".$country."');";
@${$D_Num."resINS"} = mysqli_query($db,${$D_Num."insert"});
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
else
{
echo "Error creating album!";
}
}
?>