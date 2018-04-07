<?php

if(function_exists('upload'))
{
	
}
else
{

	function upload($var,$target_folder,$allowednew="",$newName="",$new_extension=""){

		$target = $target_folder."/";
		$target = $target . basename( $_FILES[$var]['name']) ;
		
		// A list of permitted file extensions
		
		$userData = userData();
		
		if($allowednew=="")
		{
			$allowed = array('jpeg', 'jpg', 'png', 'gif');
		}
		else
		{
			$allowed = array($allowednew);
		}
		
		$extension = pathinfo($_FILES[$var]['name'], PATHINFO_EXTENSION);
		

		if(!in_array(strtolower($extension), $allowed))
		{
			return 'Unsupported file format';
		}
		else
		{
			$myUploadx = $_FILES[$var]['tmp_name'];
			//echo "Temp: ".$myUploadx." <br>";
			//echo "Perm: ".$target."<br>";
			
			$move_upload = move_uploaded_file($myUploadx, $target);
			
			if($move_upload)
			{

			$cccx = uniqueCode();

			$name1 = $target_folder."/".basename( $_FILES[$var]['name']);
			
			//echo "testing name: ".$name1;
			
			
			$ext = strtolower($extension);
				
				
				if($newName=="AUTO")
				{
					$newnamez = $cccx.".".$ext;
					$name2 = $target_folder."/".$newnamez;
					$renameX = rename($name1,$name2);
					
					$im = explode(".",$newnamez);
					
					//echo "newName1: ".$newName;
					
					if($newnamez && !($im[1]==""))
					{
						return $newnamez;
					}
				}
				elseif($newName=="")
				{				
					$im = explode(".",basename( $_FILES[$var]['name']));
					
					//echo "newName2: ".$_FILES[$var]['name'];
					//echo "<br>filename2: ".$im[0];
					//echo "<br>ext2: ".$im[1];
			
					if(!($im[0]=="") && !($im[1]==""))
					{
						return $im[0].".".$im[1];
					}
				}
				elseif(!($newName=="AUTO") && !($newName==""))
				{
					
					$im = explode(".",$newName);
					
					//echo "newName3: ".$newName;
					//echo "<br>filename3: ".$im[0];
					//echo "<br>ext3: ".$im[1];
					
					if($newName && !($im[1]==""))
					{
						if($new_extension=="")
						{
							return $newName;
						}
						else
						{
							return $im[0].$ext;
						}
					}
				}
			}
			else
			{
				return 0;
			}
		}
	}

}


if(function_exists('imageSize'))
{
	
}
else
{

	function imageSize($a,$type){
		$im = explode(".",$a);
		
		if($a && !($im[1]==""))
		{
			$data = getimagesize($a);
			$width = $data[0];
			$height = $data[1];
			$typeA = $data[2];
			$attr = $data[3];
			
			if($type=="WIDTH")
			{
				return $width;
			}
			elseif($type=="HEIGHT")
			{
				return $height;
			}
			elseif($type=="TYPE")
			{
				return $typeA;
			}
			elseif($type=="ATTR")
			{
				return $attr;
			}
		}
		else
		{
			return "";
		}
	}

}


if(function_exists('imageOrientation'))
{
	
}
else
{

	function imageOrientation($a){
		
		if(imageSize($a,"HEIGHT")>imageSize($a,"WIDTH"))
		{
			return "PORTRAIT";
		}
		else
		{
			return "LANDSCAPE";
		}
	}

}


if(function_exists('imgSname'))
{
	
}
else
{

	function imgSname($a){
		
		if(imageOrientation($a)=="LANDSCAPE")
		{
			return 'width';
		}
		elseif(imageOrientation($a)=="PORTRAIT")
		{
			return 'height';
		}
	}
	
}


if(function_exists('resize_image'))
{
	
}
else
{

	function resize_image($file, $w, $h, $crop=FALSE) {
		
		$im = new imagick($file);
		$imageprops = $im->getImageGeometry();
		$width = $imageprops['width'];
		$height = $imageprops['height'];
		if($width > $height){
		$newHeight = $h;
		$newWidth = ($h / $height) * $width;
		}else{
		$newWidth = $w;
		$newHeight = ($w / $width) * $height;
		}
		$im->resizeImage($newWidth,$newHeight, imagick::FILTER_LANCZOS, 0.9, true);
		$im->cropImage ($w,$h,0,0);
		unlink($file);
		$im->writeImage( $file );
	}
	
}


if(function_exists('rescaleImageByWidth'))
{
	
}
else
{
			
	function rescaleImageByWidth($imgx,$width){

		$heightX3 = imageSize($imgx,"HEIGHT");
		$widthX3 = imageSize($imgx,"WIDTH"); 

		// Check if file exists
		if ( ! file_exists($imgx))
		{
		die('Unable to process the requested file.');
		}

		
		if($widthX3>$width)
		{
			
			$heightY3 = $width*$heightX3/$widthX3;
			
			$img = resize_image($imgx, $width, $heightY3);
		}
	}

}


if(function_exists('rescaleImageByHeight'))
{
	
}
else
{
			
	function rescaleImageByHeight($img,$height){

		$heightX3 = imageSize($img,"HEIGHT");
		$widthX3 = imageSize($img,"WIDTH"); 
		
		if($heightX3>$height)
		{
			$width = $height*$widthX3/$heightX3;
			
			$img = resize_image($imgx, $width, $height);
		}
	}

}


if(function_exists('resizeImage'))
{
	
}
else
{

	function resizeImage($filename, $max_width, $max_height,$destination)
	{
		list($orig_width, $orig_height) = getimagesize($filename);

		$width = $orig_width;
		$height = $orig_height;

		# taller
		if ($height > $max_height) {
			$width = ($max_height / $height) * $width;
			$height = $max_height;
		}

		# wider
		if ($width > $max_width) {
			$height = ($max_width / $width) * $height;
			$width = $max_width;
		}

		$image_p = imagecreatetruecolor($width, $height);

		$image = imagecreatefromjpeg($filename);

		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);


	imagejpeg($image_p,$destination,80); 

		return $destination;
	}

}


if(function_exists('createCroppedImage'))
{
	
}
else
{

	function createCroppedImage($src,$targ_h,$targ_w,$jpeg_quality,$x,$y,$w,$h,$destination=""){
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

		imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
		
		if($destination=="")
		{
			$target = $src;
		}
		else
		{
			$target = $destination;
		}

		imagejpeg($dst_r,$target,$jpeg_quality);
		// Free up memory
		imagedestroy($dst_r);
	}
}
?>