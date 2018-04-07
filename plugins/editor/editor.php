<?php

include "dbu.php";
include "cnct.php";
$dirF = "./plugins/editor";
$dirF2 = "plugins/editor";
if(!($_REQUEST["postdata"]==""))
{
@$yearxx = date(Y);
@$dayxx = date(z);
@$hourxx = date(G);
@$hour2xx = date(h);
@$minsxx = date(i);
@$secxx = date(s);

$sess_idxx = rand(0, 999999999999999999999999);
$timexxx = ($yearxx*365*24*60*60)+($dayxx*24*60*60)+($hourxx*60*60)+($minsxx*60)+$secxx;
$cccxAx = md5($timexx." || ".$sess_idxx." || ".$userID." || ".SesVar()." |D| ");

$DateTime = $_REQUEST["datePosted"]." ".$_REQUEST["timePosted"];


$count = count($_REQUEST["category"]);

	$y = 0;
	$cat = "";
	if($count==0)
	{
	
	}
	else
	{
		foreach($_REQUEST['category'] as $Category)
		{	
			$y = $y+1;
			
			if($y==$count)
			{
			$deli = "";
			}
			else
			{
			$deli = ",";
			}
			
			$cat .= $Category."".$deli;
		}
	}
	
	
	if(!($_REQUEST["cropBtn"]=="Crop Image"))
	{
	$delx = "DELETE FROM _posts WHERE vCode = '".$_REQUEST["vCode"]."';";
	$redel = mysqli_query($db,$delx);

		$ins = "INSERT INTO _posts (id,title,src,category,DatePublished,url,mode,PType,style,misc,status,vCode,uid) VALUES ('','".$_REQUEST["title"]."','".$cccxAx."','".$cat."','".$DateTime."','".$_REQUEST["url"]."','".$_REQUEST["mode"]."','".$_REQUEST["PType"]."','".$_REQUEST["style"]."','".$_REQUEST["misc"]."','Active','".$_REQUEST["vCode"]."','".$userID."');";
		$resd = mysqli_query($db,$ins);
			
			if($resd)
			{
			$ins2 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccxAx."','".$_REQUEST["postdata"]."','".md5("POST DATA")."');";
			//echo $ins2;
			$resd2 = mysqli_query($db,$ins2);
			
				if(!($_REQUEST["imgHidd"]=="") && ($_FILES['featureImg']['name']==""))
				{
				$ins3 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccxAx."','".$_REQUEST["imgHidd"]."','".md5("POST FEATURE")."');";
				//echo $ins3;
				$resd3 = mysqli_query($db,$ins3);
				}
			}
			else
			{
			echo '<p align="center">Error! Your post could not be created.</p>';
			}
	}
	
}

	
		///////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
 
if($_FILES['FileUpload']['name'])
{

@$yearx = date(Y);
@$dayx = date(z);
@$hourx = date(G);
@$hour2x = date(h);
@$minsx = date(i);
@$secx = date(s);

$target = "myuploads/fileUploads/";

		$sess_idx = rand(0, 999999999999999999999999);
		$timexx = ($yearx*365*24*60*60)+($dayx*24*60*60)+($hourx*60*60)+($minsx*60)+$secx;
		$cccxA = md5($timexx." || ".$sess_idx." || ".$userID." || ".SesVar()." |D| ");
		$cccxB = md5($timexx." |A| ".$sess_idx." |B| ".$userID." |C| ".SesVar()." |D| ");

 $target = $target . basename( $_FILES['FileUpload']['name']) ;
 $target2 = $target2 . basename( $_FILES['FileUpload']['name']) ;

 if(move_uploaded_file($_FILES['FileUpload']['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['FileUpload']['name']). " has been uploaded";
 $rename = "success"; 
 
 $qq = explode(".",$_FILES['FileUpload']['name']);
 $filetype = $qq[1];
 
$name1 = "myuploads/fileUploads/".basename( $_FILES['FileUpload']['name']);	
$name2 = "myuploads/fileUploads/".$cccxA.".".$filetype;
$name2x = $cccxA.".".$filetype;

 if(rename($name1,$name2))
 {
	if(!($_REQUEST["fileHidd"]=="") && ($_FILES['FileUpload']['name']==""))
	{
	$ins3 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccxAx."','".$_REQUEST["fileHidd"]."','".md5("FILE FEATURE")."');";
	//echo $ins3;
	$resd3 = mysqli_query($db,$ins3);
	}
	else
	{
	$ins3 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccxAx."','".$name2x."','".md5("FILE FEATURE")."');";
	//echo $ins3;
	$resd3 = mysqli_query($db,$ins3);
	}
 echo "<p align='center'>Success! Your file has been uploaded.</p>";
 }
 else
 {
 echo "<p align='center'>Error! Your file could not be updated. Please try again later.</p>";
 }


 }
 else 
 {
 echo "Sorry, there was a problem uploading your file.";
 $rename = "";
 }
}


if($_FILES['featureImg']['name'])
{
@$yearx = date(Y);
@$dayx = date(z);
@$hourx = date(G);
@$hour2x = date(h);
@$minsx = date(i);
@$secx = date(s);

		$target = "myuploads/featureImgs/"; 

		$sess_idx = rand(0, 999999999999999999999999);
		$timexx = ($yearx*365*24*60*60)+($dayx*24*60*60)+($hourx*60*60)+($minsx*60)+$secx;
		$cccxA = md5($timexx." || ".$sess_idx." || ".$userID." || ".SesVar()." |D| ");
		$cccxB = md5($timexx." |A| ".$sess_idx." |B| ".$userID." |C| ".SesVar()." |D| ");

 $target = $target . basename( $_FILES['featureImg']['name']) ;
 
 if(move_uploaded_file($_FILES['featureImg']['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['featureImg']['name']). " has been uploaded";
 $rename = "success"; 
 
 $qq = explode(".",$_FILES['featureImg']['name']);
 $filetype = $qq[1];
 
$name1 = "myuploads/featureImgs/".basename( $_FILES['featureImg']['name']);	
$name2 = "myuploads/featureImgs/".$cccxA.".".$filetype;
$name2x = $cccxA.".".$filetype;

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

		
		<form action="" method="post" onsubmit="return checkCoords();">
			<input type="hidden" name="x2" value="IMG"/>
			<input type="hidden" name="imgsrc" value="'.$name2.'"/>
			<input type="hidden" name="imgname" value="'.$cccxA.'"/>
			<input type="hidden" name="imgtype" value="'.$filetype.'"/>
			<input name="dtasrc" type="hidden" value="'.$cccxAx.'"/>
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="submit" value="Crop Image" class="btn btn-large btn-inverse" name="cropBtn"/>
		</form><img src="'.$name2.'" id="cropbox"/>';
$pre = 1;
$title = ""; 
$heading = "Please crop your profile picture.";
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
 echo "<p align='center'>Error! Your profile picture could not be updated. Please try again later.</p>";
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
	$targ_w = 278;
	$targ_h = 200;
	$jpeg_quality = 90;

	$src = $_REQUEST["imgsrc"];
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);


imagejpeg($dst_r,$src,$jpeg_quality);
// Free up memory
imagedestroy($dst_r);

			
  if($_REQUEST["x2"]=="IMG")
  {		
	$ins3 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$_REQUEST["dtasrc"]."','".$_REQUEST["imgname"].".".$_REQUEST["imgtype"]."','".md5("POST FEATURE")."');";
	//echo $ins3;
	$resd3 = mysqli_query($db,$ins3);
	
	if($resd3)
	{
//echo "<img src='".$_REQUEST["imgsrc"]."' align='center'>";
	//echo "<p align='center'>Success! Your Feature Image has been set.</p>";
	}
	else
	{
	//echo "<p align='center'>Error! Your Feature Image has not been set. Please try again later.</p>";
	}
   }
	//exit;
}
		
		///////////////////////////////////////////////////////////////////////////////////////////////////
	

if($_REQUEST["vCode"])
{
$sel = "SELECT * FROM _posts WHERE id = (SELECT max(id) AS maxID FROM _posts WHERE vCode = '".$_REQUEST["vCode"]."');";
//echo $sel;
$res = mysqli_query($db,$sel);
@$rw = mysqli_fetch_array($res);
$src = $rw["src"];
$vCode = $rw["vCode"];
$postTitle = $rw["title"];
$mode = $rw["mode"];
$DatePublished = $rw["DatePublished"];
		
		$dt = explode(" ",$DatePublished);
		$ps_date = $dt[0];
		$ps_time = $dt[1];
		
		$datePosted = $ps_date;
		$timePosted = $ps_time;
	
		$selq = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$src."' AND meta_data = '".md5("POST DATA")."');";
		//echo $selq;
		$resq = mysqli_query($db,$selq);
		@$rwq = mysqli_fetch_array($resq);
		$u_id = $rwq["userid"];
		$post_data = $rwq["data"]; 
		
		$sel2q = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$src."' AND meta_data = '".md5("POST FEATURE")."');";
		//echo $sel2q;
		$res2q = mysqli_query($db,$sel2q);
		@$imnum = mysqli_num_rows($res2q);
		@$rw2q = mysqli_fetch_array($res2q);
		$u_id2 = $rw2q["userid"];
		$url2 = $rw2q["data"]; 
		
		$sel3q = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$src."' AND meta_data = '".md5("FILE FEATURE")."');";
		//echo $sel2q;
		$res3q = mysqli_query($db,$sel3q);
		@$imnum3 = mysqli_num_rows($res3q);
		@$rw3q = mysqli_fetch_array($res3q);
		$u_id3 = $rw3q["userid"];
		$url3 = $rw3q["data"];
		
		if($imnum>=1 && !($url2==""))
		{
		$imagewidth = "150";
		$ps_image = "<img src='myuploads/featureImgs/".$url2."' width='".$imagewidth."'>";
		$imgHidd = "<input name='imgHidd' type='hidden' value='".$url2."'>";
		}
		else
		{
		$ps_image = '';
		$imgHidd = "";
		$fileHidd = "";
		}	
		
		if($imnum3>=1 && !($url3==""))
		{
		$ps_download = "<a href='myuploads/fileUploads/".$url3."' target='_new'>Download</a>";
		$fileHidd = "<input name='fileHidd' type='hidden' value='".$url3."'>";
		}
		else
		{
		$ps_download = '';
		$fileHidd = "";
		}	

$DisplayPostData = $post_data;
}
else
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
		
$DisplayPostData = "";
$vCode = $cccxA;
$postTitle = "";
}
?>
<script src="<?php echo $dirF2;?>/ckeditor.js"></script>
<link href="<?php echo $dirF2;?>/sample.css" rel="stylesheet">
<form method="post" action="#" id="form1" enctype="multipart/form-data">
<?php echo $imgHidd;?>
<?php echo $fileHidd;?>
<input name="PType" type="hidden" value="<?php echo $PType;?>">
<input name="vCode" type="hidden" value="<?php echo $vCode;?>">
<b>Title: </b><input name="title" type="text" size="80" value="<?php echo $postTitle;?>"><br>
<textarea id="editor1" name="postdata" rows="200" cols="75"><?php
echo $DisplayPostData;
?></textarea>
		<script>

			// This call can be placed at any point after the
			// <textarea>, or inside a <head><script> in a
			// window.onload event handler.

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.

			CKEDITOR.replace( 'editor1',{
        filebrowserBrowseUrl : '<?php echo $dirF;?>/kcfinder/browse.php?opener=ckeditor&type=files',
        filebrowserImageBrowseUrl : '<?php echo $dirF;?>/kcfinder/browse.php?opener=ckeditor&type=images',
        filebrowserFlashBrowseUrl : '<?php echo $dirF;?>/kcfinder/browse.php?opener=ckeditor&type=flash',
        filebrowserUploadUrl : '<?php echo $dirF;?>/kcfinder/upload.php?opener=ckeditor&type=files',
        filebrowserImageUploadUrl : '<?php echo $dirF;?>/kcfinder/upload.php?opener=ckeditor&type=images',
        filebrowserFlashUploadUrl : '<?php echo $dirF;?>/kcfinder/upload.php?opener=ckeditor&type=flash'}); 

		</script>
<br><u><b>Privacy:</b></u> <select name="mode"><option value="<?php echo $mode;?>"><?php echo $mode;?></option><option value='Free|Open'>Available To All</option><option value='Secure|Open'>Available to Logged In Users</option><option value='Secure|Priv'>Available To Specific User Group</option><option value='Secure|Password'>Password Access Only</option></select>
<?php
if($PType=="POST")
{
?>
	<BR><u><b>When To Appear:</b></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Date </b> <input name="datePosted" type="text" size="10" value="<?php if($datePosted){echo $datePosted;}else{echo date("Y-m-j");}?>"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Time </b> <input name="timePosted" type="text" size="10" value="<?php if($timePosted){echo $timePosted;}else{echo date("H:i:s");}?>"><br><b><u>Feature Image:</u></b> <input name="featureImg" type="file" value="<?php echo $url2;?>"><br><?php echo $ps_image;?><br><?php
	$selC = "SELECT * FROM meta WHERE meta_data = '".md5("POST-CATEGORIES")."';";
	$resC = mysqli_query($db,$selC);
	@$numC = mysqli_num_rows($resC);
	echo '<u><b>Categories:</b></u> &nbsp;&nbsp;&nbsp;';
	for($d=0; $d<$numC; $d++)
	{
	$rwC = mysqli_fetch_array($resC);
	$CatC = $rwC["data"];
	echo '<b>'.$CatC.'</b><input name="category[]" value="'.$CatC.'" type="checkbox" checked="true"> &nbsp;&nbsp;&nbsp;&nbsp;';
	}
}
?><br><u><b>File Upload:</b></u> <input name="FileUpload" type="file" value="<?php echo $url2;?>"><br><?php echo $ps_download;?><br><br><input name="submitBtn" type="submit" value="Post">
</form>

<?php

?>