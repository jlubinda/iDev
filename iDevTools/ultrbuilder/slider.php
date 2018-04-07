?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<style>
body{
background-color: #ffffff;
text-decoration: none;
font-family: Tahoma, Verdana, Arial, sans-serif;
font-size: 11px;
}

#galleryIMG{
position:relative; 
height:193px; 
float:left; 
background-color: #bbbbbb; 
border-top:#000069 solid 1px; 
border-left:#000069 solid 1px; 
border-bottom:#000069 solid 1px; 
border-right:#000069 solid 1px;
}

#galleryIMG table{
position:relative; 
top:-2px; 
}

#galleryIMG table:hover{
background-color: #0F0F1F; 
border-top:#0000dd solid 1px; 
border-left:#0000dd solid 1px; 
border-bottom:#0000dd solid 1px; 
border-right:#0000dd solid 1px;
}



#galleryIMG2{
position:relative; 
height:230px; 
float:left; 
background-color: #bbbbbb; 
border-top:#000069 solid 1px; 
border-left:#000069 solid 1px; 
border-bottom:#000069 solid 1px; 
border-right:#000069 solid 1px;
}

#galleryIMG2 table{
position:relative; 
top:-2px; 
}

#galleryIMG2 table:hover{
background-color: #0F0F1F; 
border-top:#0000dd solid 1px; 
border-left:#0000dd solid 1px; 
border-bottom:#0000dd solid 1px; 
border-right:#0000dd solid 1px;
}
</style>
<?php
if($_REQUEST["function"]=="")
{
?>
 <!-- use jssor.slider.mini.js (39KB) or jssor.sliderc.mini.js (31KB, with caption, no slideshow) or jssor.sliders.mini.js (26KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
    <script type="text/javascript" src="plugins/slider/js/jquery-1.9.1.min.js"></script>
    <!-- use jssor.slider.mini.js (39KB) or jssor.sliderc.mini.js (31KB, with caption, no slideshow) or jssor.sliders.mini.js (26KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
    <script type="text/javascript" src="plugins/slider/js/jssor.utils.js"></script>
    <script>
        jQuery(document).ready(function ($) {

            var nestedSliders = [];

            $.each(["sliderh1_container", "sliderh2_container", "sliderh3_container"], function (index, containerId) {
                var nestedSliderOptions = {
                    $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 1
                    $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                    $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                    //$SlideWidth: 200,                                   //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                    //$SlideHeight: 150,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                    $SlideSpacing: 3, 					                //[Optional] Space between each slide in pixels, default value is 0
                    $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                    $ParkingPosition: 0,                              //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                    $UISearchMode: 0,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).

                    $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                        $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                        $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 0,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                        $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                        $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                        $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                        $SpacingY: 0,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                        $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                    }
                };

                nestedSliders.push(new $JssorSlider$(containerId, nestedSliderOptions));
            });

            var options = {
                $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 2000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 300,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 80,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 150,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 3, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 0,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 2,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 0,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0),
                
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $AutoCenter: 3,                                 //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 0,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 0,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 3,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 0,                          //[Optional] The offset position to park thumbnail
                    $Orientation: 1,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                    $DisableDrag: false                            //[Optional] Disable drag or not, default value is false
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            function OnMainSliderPark(currentIndex, fromIndex) {
                $.each(nestedSliders, function (index, nestedSlider) {
                    nestedSlider.$Pause();
                });

                setTimeout(function () {
                    nestedSliders[currentIndex].$Play();
                }, 2000);
            }

            jssor_slider1.$On($JssorSlider$.$EVT_PARK, OnMainSliderPark);
            OnMainSliderPark(0, 0);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$SetScaleWidth(Math.min(bodyWidth, 600));
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
        });
    </script>
    <!-- sliderh style begin -->
    <style>
        /* jssor slider bullet navigator skin 03 css */
        /*
        .jssorb03 div           (normal)
        .jssorb03 div:hover     (normal mouseover)
        .jssorb03 .av           (active)
        .jssorb03 .av:hover     (active mouseover)
        .jssorb03 .dn           (mousedown)
        */
        .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av
        {
            background: url(images/gallery/b03.png) no-repeat;
            overflow:hidden;
            cursor: pointer;
        }
        .jssorb03 div { background-position: -5px -4px; }
        .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
        .jssorb03 .av { background-position: -65px -4px; }
        .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }
    </style>
<?php

$limit = 120;

	$pagex = $_REQUEST["pagex"];
	
	if(!$pagex)
	{
	$page = 1;
	}
	else
	{
	$page = $pagex;
	}
	$upper_limit = ($page*$limit);
	$lower_limit = ($page*$limit)-$limit;

	@$pagesx = $numAlb/$limit;
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
		
$pagexg = $_REQUEST["pagex"]-1;
$pagexg2 = $_REQUEST["pagex"]+1;

$itemStartNum = ((($page*$limit)+1)-$limit);
$rows = 2;
$cols = 5;
$itemsperpage = $rows*$cols;

echo "<div align='center'>";
	if(!($_REQUEST["gid"]) && !($_REQUEST["id"]))
	{	
		$sel = "SELECT * FROM _galleries ORDER BY id DESC LIMIT ".$lower_limit." , ".$limit.";";
		$res = mysqli_query($db,$sel);
		@$countd = mysqli_num_rows($res);
		if($countd<="0")
		{
		$count = 1;
		}
		else
		{
		$count = $countd;
		}
		$sel2 = "SELECT * FROM _galleries;";
		$res2 = mysqli_query($db,$sel2);
		@$countx = mysqli_num_rows($res2);
		
		$selGt = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".md5($_REQUEST["ref"])."' AND meta_data = '"."GALLERY-TYPE"."');";
		$resGt = mysqli_query($db,$selGt);
		@$numGt = mysqli_num_rows($resGt);
		@$rwGt = mysqli_fetch_array($resGt);
		$dataGt = $rwGt["data"];
		
		if($numGt>="1")
		{
		@ include_once "plugins/slider/galleries/".$dataGt.".php";
		}
		else
		{
		@ include_once "plugins/slider/galleries/tiled-menu-slider.php";
		}
	
	}
	elseif(!($_REQUEST["gid"]=="") && ($_REQUEST["id"]==""))
	{ 
		$sel = "SELECT * FROM _galleries WHERE id = '".$_REQUEST["gid"]."';";
		$res = mysqli_query($db,$sel);
		@$count = mysqli_num_rows($res);	
		@$rw = mysqli_fetch_array($res);
		$Gtype = $rw["Gtype"];
		
		if($Gtype=="Default-Horizontal")
		{
		@ include_once "plugins/slider/galleries/image-gallery.php";
		}
		elseif($Gtype=="Default-Vertical")
		{
		@ include_once "plugins/slider/galleries/image-gallery-vertical-thumb.php";
		}
		else
		{
			$selGt = "SELECT * FROM meta WHERE userid = '".$Gtype."' AND meta_data = '"."ALBUM-TYPES"."';";
			$resGt = mysqli_query($db,$selGt);
			@$numGt = mysqli_num_rows($resGt);
			@$rwGt = mysqli_fetch_array($resGt);
			$dataGt = $rwGt["data"];
			if($numGt>="1")
			{
			@ include_once "plugins/slider/galleries/".$dataGt.".php";
			}
			else
			{
			@ include_once "plugins/slider/galleries/image-gallery.php";
			}
		}
	}
	elseif(!($_REQUEST["id"]=="") && !($_REQUEST["gid"]==""))
	{ 
		$sel = "SELECT * FROM _galleries WHERE id = '".$_REQUEST["gid"]."';";
		$res = mysqli_query($db,$sel);
		@$count = mysqli_num_rows($res);				
		@ include_once "plugins/slider/galleries/singleimage.php";
	}
echo "</div>";
?>
<!-- Jssor Slider End -->
<?php
}
elseif($_REQUEST["function"]=="add")
{

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
		$cccxC = md5(md5($timexx1)." |A1| ".md5($sess_idx1)." |B1| ".md5($userID)."".md5($gallery)."|C1| ".$_SESSION[SesUID()]." |D1| ");	
		$cccxD = md5(md5($timexx1)." |A2| ".md5($sess_idx1)." |B2| ".md5($userID)."".md5($gallery)."|C2| ".$_SESSION[SesUID()]." |D2| ");	
		
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
					$cccxA = md5(md5($timexx)." || ".md5($sess_idx)." || ".md5($userID)." |".md5($a.$gallery)."| ".$_SESSION[SesUID()]." |D| ");
					$cccxB = md5(md5($timexx)." |A| ".md5($sess_idx)." |B| ".md5($userID)." |".md5($a.$gallery)."|C| ".$_SESSION[SesUID()]." |D| ");	
					
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

}
elseif($_REQUEST["function"]=="list")
{
	echo '<a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function=edit">Update Gallery Style For This Page</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function=setup&id=2">Install New Gallery Style</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function=setup&id=1">Install New Album Style</a><br><table align="center" width="99%" id="tables_css">';
	echo '<tr><td width="30"><b>No.</b></td><td width="51"><b></b></td><td><b>Title</b></td><td><b>Privacy</b></td><td><b>Misc.</b></td><td><b>Status</b></td><td><b></b></td><td><b></b></td><td><b></b></td></tr>';
	$sel = "SELECT * FROM _galleries;";
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
}
elseif($_REQUEST["function"]=="edit")
{

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
}
elseif($_REQUEST["function"]=="delete")
{
	$sel = "SELECT * FROM _galleries WHERE id = '".$_REQUEST["gid"]."'";
	$res = mysqli_query($db,$sel);
	@$rw = mysqli_fetch_array($res);
	$id = $rw["id"];
	$name = $rw["name"];
	$title = $rw["title"];
	$src = $rw["src"];
	//echo "<b>".$title."</b>";
	
		$selI = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$src."' AND meta_data = '".md5("USER-ALBUM")."');";
		$resI = mysqli_query($db,$selI);
		@$rwI = mysqli_fetch_array($resI);
		$uidI = $rwI["userid"];
		$targetI = $rwI["data"];
				
	if(!($_REQUEST["deleteBtn"]))
	{
	echo '<form action="" method="POST">';
		echo '<table width="700" align="center">';
			echo '<tr>';
				echo '<td>Are you sure you want to delete the gallery <b><i>'.$title.'</i></b> with all its contents? </td><td><input name="deleteBtn" value="Delete" type="submit"></td>';
			echo '</tr>';
		echo '</table>';
	echo '</form>';
	}
	elseif($_REQUEST["deleteBtn"]=="Delete")
	{
		
		$selI2 = "SELECT * FROM meta WHERE userid = '".$uidI."' AND meta_data = '".md5("ALBUM-IMAGE")."';";
		//echo $selI2."<br>";
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
		$target3 = "galleries/".$targetI."/thumb";
		$target4 = "galleries/".$targetI;
		
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
		
		@rmdir($target3);
		@rmdir($target4);
		
		if($numI2==$d)
		{
		
		$del2 = "DELETE FROM meta WHERE userid = '".$src."' AND meta_data = '".md5("USER-ALBUM")."';";
		$res2 = mysqli_query($db,$del2);
		
		$del3 = "DELETE FROM _galleries WHERE id = '".$_REQUEST["gid"]."';";
		$res3 = mysqli_query($db,$del3);
		
			if($res2 && $res3)
			{
			echo '<p align="center">Success! The album <b><i>'.$title.'</i></b> has been deleted.</p>';
			}
			else
			{
			echo '<p align="center">Sorry. There was an error while deleting the album.</p>';
			}
		}
		else
		{
		echo '<p align="center">Sorry. There was an error while deleting the album.</p>';
		}
		
		
	}
}
elseif($_REQUEST["function"]=="setup")
{
	if($_REQUEST["id"]=="1")
	{
		
	$array = $_FILES['galleryStyle']['tmp_name'];
	$typearray = $_FILES['galleryStyle']['type'];
	$namearray = $_FILES['galleryStyle']['name'];
	$fileComp = explode(".",$namearray);
	$gName = $_REQUEST["galleryname"];
	
	$selD = "SELECT * FROM meta WHERE userid = '".$_REQUEST["galleryname"]."' AND meta_data = '".md5("ALBUM-TYPES")."';";
	$resD = mysqli_query($db,$selD);
	@$numD = mysqli_query($db,$resD);
	
		$err = "";
		
		if($_REQUEST["submitBtn"]=="Install Album Style")
		{
			if($gName=="")
			{
			$err .= '<p align="center">You have not indicated a Album Style Name.</p>';
			}
			
			if($gName)
			{
				if(!(strtolower($fileComp[1])=="php"))
				{
				$err .= '<p align="center">This is not a PHP file. Please choose the correct file format and try again.</p>';
				}
			}
			
			if($numD>="1")
			{
			$err .= '<p align="center">This Style Name has already been registered.</p>';
			}
		}
		
		if($_REQUEST["submitBtn"]=="" || ($_REQUEST["submitBtn"]=="Install Album Style" && (!(strtolower($fileComp[1])=="php") || $gName=="" || $numD>="1")))
		{
			echo '<form action="" method="POST" enctype="multipart/form-data">';
			echo '<table align="center" id="tables_css5"width="500">';
			echo '<tr><td align="center"><br><b><u>Album Style Installation (Only PHP files allowed)</u></b><br><br></td></tr>';
			if($err)
			{
			echo '<tr><td align="center"><b>Error</b>'.$err.'<br></td></tr>';
			}
			echo '<tr><td align="center"><b>Style Name (Every entry must be unique)</b><br><input name="galleryname" type="text" size="30"><br><br></td></tr>';	
			echo '<tr><td align="center"><b>Select File (Only PHP files allowed)</b><br><input name="galleryStyle" id="fileToUpload" type="file"><input name="submitBtn" type="submit" value="Install Album Style"></td></tr>';	
			echo '</table>';
		}
		elseif($_REQUEST["submitBtn"]=="Install Album Style" && (strtolower($fileComp[1])=="php"))
		{
			
			$cccxA = md5(md5((date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s))." |A1| ".md5(rand(0, 999999999999999999999999))." |B1| ".md5($userID.$namearray)."".md5($fileComp[1].$array)."|C1| ".$_SESSION[SesUID()]." |D1| ");	
			$cccxB = md5(md5((date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s))." |A2| ".md5(rand(0, 999999999999999999999999))." |B2| ".md5($userID.$namearray)."".md5($fileComp[1].$array)."|C2| ".$_SESSION[SesUID()]." |D2| ");	
			
			$target = "plugins/slider/galleries/".$cccxA.".php";
			
			if(@move_uploaded_file($array, $target))
			{
				$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$gName."','".$cccxA."','".md5("ALBUM-TYPES")."');";
				$resIn = mysqli_query($db,$ins);
				if($resIn)
				{
				echo '<p align="center">Success. Your new Album Style has been uploaded.</p>';
				}
				else
				{
				echo '<p align="center">Error. Your new Album Style has not been uploaded.</p>';
				}
			}			
		}
	}
	elseif($_REQUEST["id"]=="2")
	{
			
	$array = $_FILES['galleryStyle']['tmp_name'];
	$typearray = $_FILES['galleryStyle']['type'];
	$namearray = $_FILES['galleryStyle']['name'];
	$fileComp = explode(".",$namearray);
	$gName = $_REQUEST["galleryname"];
	
	$selD = "SELECT * FROM meta WHERE userid = '".$gName."' AND meta_data = '".md5("GALLERY-TYPES")."';";
	$resD = mysqli_query($db,$selD);
	@$numD = mysqli_query($db,$resD);
	
		$err = "";
		
		if($_REQUEST["submitBtn"]=="Install Gallery Style")
		{
			if($gName=="")
			{
			$err .= '<p align="center">You have not indicated a gallery Style Name.</p>';
			}
			
			if($gName)
			{
				if(!(strtolower($fileComp[1])=="php"))
				{
				$err .= '<p align="center">This is not a PHP file. Please choose the correct file format and try again.</p>';
				}
			}
			
			if($numD>="1")
			{
			$err .= '<p align="center">This Style Name has already been registered.</p>';
			}
		}
		
		if($_REQUEST["submitBtn"]=="" || ($_REQUEST["submitBtn"]=="Install Gallery Style" && (!(strtolower($fileComp[1])=="php") || $gName=="" || $numD>="1")))
		{
			echo '<form action="" method="POST" enctype="multipart/form-data">';
			echo '<table align="center" id="tables_css5"width="500">';
			echo '<tr><td align="center"><br><b><u>Gallery Style Update (Only PHP files allowed)</u></b><br><br></td></tr>';
			if($err)
			{
			echo '<tr><td align="center"><b>Error</b>'.$err.'<br></td></tr>';
			}
			echo '<tr><td align="center"><b>Style Name (Every entry must be unique)</b><br><input name="galleryname" type="text" size="30"><br><br></td></tr>';	
			echo '<tr><td align="center"><b>Select File (Only PHP files allowed)</b><br><input name="galleryStyle" id="fileToUpload" type="file"><input name="submitBtn" type="submit" value="Install Gallery Style"></td></tr>';	
			echo '</table>';
		}
		elseif($_REQUEST["submitBtn"]=="Install Gallery Style" && (strtolower($fileComp[1])=="php"))
		{
			
			$cccxA = md5(md5((date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s))." |A1| ".md5(rand(0, 999999999999999999999999))." |B1| ".md5($userID.$namearray)."".md5($fileComp[1].$array)."|C1| ".$_SESSION[SesUID()]." |D1| ");	
			$cccxB = md5(md5((date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s))." |A2| ".md5(rand(0, 999999999999999999999999))." |B2| ".md5($userID.$namearray)."".md5($fileComp[1].$array)."|C2| ".$_SESSION[SesUID()]." |D2| ");	
			
			$target = "plugins/slider/galleries/".$cccxA.".php";
			
			if(@move_uploaded_file($array, $target))
			{
				$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$gName."','".$cccxA."','".md5("GALLERY-TYPES")."');";
				echo $ins;
				$resIn = mysqli_query($db,$ins);
				if($resIn)
				{
				echo '<p align="center">Success. Your new Gallery Style has been installed.</p>';
				}
				else
				{
				echo '<p align="center">Error. Your new Gallery Style has not been installed.</p>';
				}
			}			
		}
	}
}
echo "<br><br>";