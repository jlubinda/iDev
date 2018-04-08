<?php
	if(chkSes()=="Active")
	{
	$user = userData();
		
		$target = "images/"; 
		
		?>
		  <div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header">YOUR COMPANIES | COVER IMAGE</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" style="margin:15px;">
					<nav>
						<ul class="nav navbar-top-links navbar-right">
							<?php companiesNav();?>
						</ul>
					</nav>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
			  <!-- start course content -->
				<div class="col-lg-12 col-md-12 col-sm-12">
		<?php
				if(getOrgUserLevel($_REQUEST["vCode"],$user["userID"])=="-1")
				{
					
		echo "<form action='' method='post' class='motion' enctype='multipart/form-data'>Cover Image: <input type='file' name='productImage' size='20' accept='image/jpeg'><input type='Submit' name='submitBtn' size='20' value='UPLOAD'></form>";
		 
		$user = userData();
			
			$target = "images/"; 

			if($_FILES['productImage']['name'])
			{
		
				$cccxA = md5(uniqueCode().$_SESSION[SesUID()]." |D| ".rand(0, 999998));
				$cccxB = md5(uniqueCode()."|C|".$_SESSION[SesUID()]."|D|".rand(999999, 999999999999));
				
				$target = $target . basename( $_FILES['productImage']['name']) ;
				
				if(move_uploaded_file($_FILES['productImage']['tmp_name'], $target)) 
				{
				echo "The file ". basename( $_FILES['productImage']['name']). " has been uploaded";
				$rename = "success"; 

				$qq = explode(".",$_FILES['productImage']['name']);
				$filetype = $qq[1];

				$name1 = "images/".basename( $_FILES['productImage']['name']);	
				$name2 = "images/".$cccxA.".".$filetype;
				$name2x = $cccxA.".".$filetype;

					if(rename($name1,$name2))
					{

						if(!($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["x2"]=="IMG"))
						{
							?>
<script src="apps/website/resources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/rcrop.min.js"></script>
<script type="text/javascript">
$(function($){
  // Create variables (in this scope) to hold the API and image size
  var jcrop_api,
      boundx,
      boundy,
      // Grab some information about the preview pane
      $preview = $('#preview-pane'),
      $pcnt = $('#preview-pane .preview-container'),
      $pimg = $('#preview-pane .preview-container img'),
      xsize = $pcnt.width(),
      ysize = $pcnt.height();
    
   
  $('#target').Jcrop({
    onChange: updatePreview,
    onSelect: updatePreview,
    bgOpacity: 0.5,
    aspectRatio: 4 / 2
  },function(){
    // Use the API to get the real image size
    var bounds = this.getBounds();
    boundx = bounds[0];
    boundy = bounds[1];

    jcrop_api = this; // Store the API in the jcrop_api variable

    // Move the preview into the jcrop container for css positioning
    $preview.appendTo(jcrop_api.ui.holder);
  });

  function updatePreview(c) {
    if (parseInt(c.w) > 0) {
      var rx = xsize / c.w;
      var ry = ysize / c.h;
        
      $('#x').val(c.x);
      $('#y').val(c.y);
      $('#w').val(c.w);
      $('#h').val(c.h);

      $pimg.css({
        width: Math.round(rx * boundx) + 'px',
        height: Math.round(ry * boundy) + 'px',
        marginLeft: '-' + Math.round(rx * c.x) + 'px',
        marginTop: '-' + Math.round(ry * c.y) + 'px'
      });
    }
  }

});
</script>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<link rel="stylesheet" href="apps/website/resources/css/rcrop.min.css" type="text/css" />
<style type="text/css">

/* Apply these styles only when #preview-pane has
   been placed within the Jcrop widget */
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}

/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width: 175px;
  height: 50px;
  overflow: hidden;
}

</style>
<div id="wrapper">
  <div class="jc-demo-box">
    <header>
      <h1><span>Cover Image</span></h1>
    </header>
<?php //2160,

$name3 = resizeImage($name2, 1200, 600,$name2);

echo '<img src="'.$name3.'" id="target" alt="[Jcrop Example]" />
  <div id="preview-pane">
	<div class="preview-container">
	  <img src="'.$name3.'" class="jcrop-preview" alt="Preview" />
	</div>
  </div>';
  ?><!-- @end #preview-pane -->
    
    <div id="form-container">
	<form id="cropimg" name="cropimg" action="<?php echo '?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&unit='.$_REQUEST["unit"].'&class='.$_REQUEST["class"].'&Programme='.$_REQUEST["Programme"].'&product='.$_REQUEST["product"].'&vCode='.$_REQUEST["vCode"].'&id='.$_REQUEST["id"].'&task=Enter_Data';?>" method="post" onsubmit="return checkCoords();">
		<input type="hidden" name="x2" value="IMG"/>
		<input type="hidden" name="imgsrc" value="<?php echo $name3;?>"/>
		<input type="hidden" name="imgname" value="<?php echo $cccxA;?>"/>
		<input type="hidden" name="imgtype" value="<?php echo $filetype;?>"/>
		<input type="hidden" name="imgtype" value="<?php echo $filetype;?>"/>
		<input type="hidden" name="pUnit" value="<?php echo $_REQUEST["pUnit"];?>"/>
		<input type="hidden" name="qty" value="<?php echo $_REQUEST["qty"];?>"/>
		<input type="hidden" name="price" value="<?php echo $_REQUEST["price"];?>"/>
		<input type="hidden" name="transporter" value="<?php echo $_REQUEST["transporter"];?>"/>
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
		<input type="submit" value="Crop Image" class="btn btn-large btn-inverse" name="cropBtn"/>
	</form>
    </div><!-- @end #form-container -->
  </div><!-- @end .jc-demo-box -->
</div><!-- @end #wrapper -->
						<?php       
						}
						else
						{
							echo "<p align='center'>Error processing your resquest. Please try again later.</p>";
						}

					}
					else
					{
					echo "<p align='center'>Error! Your Cover Image could not be uploaded. Please try again later.</p>";
					}
				}
				else 
				{
				echo "Sorry, there was a problem uploading your file.";
				$rename = "";
				}
			}

			
			if ($_REQUEST["x2"]=="IMG" && $_REQUEST["cropBtn"]=="Crop Image")
			{		
				$src = $_REQUEST["imgsrc"];
				$targ_h = 600;
				$targ_w = 1200;
				$jpeg_quality = 92;
				$x = $_POST['x'];
				$y = $_POST['y'];
				$w = $_POST['w'];
				$h = $_POST['h'];
				
				
				$ft = explode("images/",$src);
				$thumb = $ft[0]."images/thumb_".$ft[1];
				
				copy($src,$thumb);
				
				$targ_h_thumb = 170;
				$targ_w_thumb = 340;
					
				createCroppedImage($src,$targ_h,$targ_w,$jpeg_quality,$x,$y,$w,$h);

				createCroppedImage($thumb,$targ_h_thumb,$targ_w_thumb,$jpeg_quality,$x,$y,$w,$h);
						
				if($_REQUEST["x2"]=="IMG")
				{
					$user = userData();
					
					$image = $_REQUEST["imgname"].".".$_REQUEST["imgtype"];
					
					$array = addOrgCoverImage($_REQUEST["vCode"],$image);
					if($array==1)
					{
					echo "<img src='".$thumb."' align='center'>";
					echo "<p align='center'>Success! Your Cover Image has been updated.</p>";
					}
					else
					{
					echo "<p align='center'>Error! Your Cover Image was not updated. Please try again later.</p>";
					}
				}
				//exit;
			}
				}
				else
				{
					echo "You do not have permission to access this component.";
				}
		?>
					</div>
				</div>
			</div>
		<?php
	}
	else
	{
		include find_file("login.php");
	}
?>