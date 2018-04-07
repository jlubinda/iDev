<?php 

if(function_exists('SliderTransition'))
{
	
}
else
{
	function SliderTransition($type="",$value=""){
		
		include find_file("cnct.php");
		
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".uniqueCode()."','".$value."','".md5("MY CURRENT HOME PAGE SLIDER EFFECT")."');";
			@$res = mysqli_query($db,$ins);
			if(@$res)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("MY CURRENT HOME PAGE SLIDER EFFECT")."');";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			@$rw = mysqli_fetch_array(@$res);
			$data = $rw["data"];
			
			if($num>=1)
			{
				return 	$data;
			}
			else
			{
				return 	0;
			}		
		}
		
		mysqli_close($db);
	}

}
 

if(function_exists('sliderStatus'))
{
	
}
else
{
	function sliderStatus($type="",$value=""){
		
	include find_file("cnct.php");

		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".uniqueCode()."','".$value."','".md5("MY HOME PAGE SLIDER STATUS")."');";
			@$res = mysqli_query($db,$ins);
			if(@$res)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("MY HOME PAGE SLIDER STATUS")."');";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			@$rw = mysqli_fetch_array(@$res);
			$data = $rw["data"];
			
			if($num>=1)
			{
				return 	$data;
			}
			else
			{
				return 	0;
			}		
		}
		
		mysqli_close($db);
	}

}
 

if(function_exists('getSliderImages'))
{
	
}
else
{
	function getSliderImages($id,$type=""){
		
	include find_file("cnct.php");

		$sel = "SELECT * FROM meta WHERE userid = '".$id."' AND meta_data = '".md5("HOME PAGE SLIDER IMAGE")."';";
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		
		if($num<0)
		{
			return 0;
		}
		else
		{
			@$rw = mysqli_fetch_array(@$res);
			$userid = $rw["userid"];
			$xid = $rw["id"];
			$data = htmlspecialchars_decode($rw["data"]);
			
			$dt = explode("|",$data);
				
			if($type=="" || $type=="URL")
			{
				return $dt[0];
			}
			elseif($type=="TITLE")
			{
				return $dt[1];
			}
			elseif($type=="ALT")
			{
				return $dt[2];
			}
			elseif($type=="ID")
			{
				return $xid;
			}
			elseif($type=="USERID")
			{
				return $userid;
			}
		}
		
		mysqli_close($db);
	}

}
 

if(function_exists('ImagesDetails'))
{
	
}
else
{
	function ImagesDetails($userid,$type){
		
	include find_file("cnct.php");

		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5($type." MY HOME PAGE SLIDER IMAGE DETAILS")."' AND userid = '".$userid."');";
		
		@$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array(@$res);
		$data = $rw["data"];
		
		//echo $data."<br>";
		
		mysqli_close($db);
		
		return 	stripslashes($data);
	}

}
 

if(function_exists('ListSliderImages'))
{
	
}
else
{
	function ListSliderImages(){
		
	include find_file("cnct.php");

		$sel = "SELECT * FROM meta WHERE meta_data = '".md5("NEW - MY HOME PAGE SLIDER")."';";
		//echo $sel;
		@$res = mysqli_query($db,$sel);
		$num = mysqli_num_rows(@$res);
		for($a=0; $a<$num; $a++)
		{
		@$rw = mysqli_fetch_array(@$res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
			$textL = explode('<br />',ImagesDetails($userid,"TEXT"));
			$mnum = count($textL);
			
			for($x=0; $x<$mnum; $x++)
			{
				if($x==0)
				{
					$maxLength = strlen($textL[$x]);
				}
				else
				{
					if(strlen($textL[$x])>strlen($textL[$x-1]))
					{
						$maxLength = strlen($textL[$x]);
					}
					else
					{
						$maxLength = strlen($textL[$x-1]);
					}
				}
			}
			
			$tlx = explode(".",(($maxLength*(ImagesDetails($userid,"fontsize")+0))/1.5));
			$thx = explode(".",(($mnum*((ImagesDetails($userid,"fontsize")*ImagesDetails($userid,"textline_height"))+0))/15.5));
			$textLength = $tlx[0];
			$textHeight = $thx[0];
			//$textLength = ($maxLength*(1));
		
		$array[] = array('id'=>$id,'userid'=>$userid,'img'=>getSliderImages($userid),'text'=>ImagesDetails($userid,"TEXT"),'textline_height'=>ImagesDetails($userid,"textline_height"),'textwidth'=>$textLength,'textheight'=>$textHeight,'v_orientation'=>ImagesDetails($userid,"v_orientation"),'h_orientation'=>ImagesDetails($userid,"h_orientation"),'v_orientation_value'=>ImagesDetails($userid,"v_orientation_value"),'h_orientation_value'=>ImagesDetails($userid,"h_orientation_value"),'bookingstatus'=>ImagesDetails($userid,"bookingstatus"),'url'=>ImagesDetails($userid,"URL"),'fontsize'=>ImagesDetails($userid,"fontsize"),'fontcolor'=>ImagesDetails($userid,"fontcolor"));
		}
		
		mysqli_close($db);

		return 	$array;
	}

}
 

if(function_exists('CountSliderImages'))
{
	
}
else
{
	function CountSliderImages(){
		
	include find_file("cnct.php");

		$sel = "SELECT count(id) AS maxCount FROM meta WHERE meta_data = '".md5("NEW - MY HOME PAGE SLIDER")."';";
		@$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array(@$res);
		$maxCount = $rw["maxCount"];
		
		mysqli_close($db);
		
		return 	$maxCount;
	}

}
 

if(function_exists('addSliderImage'))
{
	
}
else
{
	function addSliderImage($image,$title,$alt){
		
	include find_file("cnct.php");
		
		$classx = $class." ";
		
		@$year = date(Y);
		@$day = date(z);
		@$hour = date(G);
		@$hour2 = date(h);
		@$mins = date(i);
		@$sec = date(s);
		
		$sess_id = rand(0, 9999999999998);
		$sess_id2 = rand(9999999999999, 999999999999999999998);
		$sess_id3 = rand(999999999999999999999, 99999999999999999999999999999999999);
		
		$timex = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60)+($mins*60)+$sec;
		$cccA = md5($timex." || ".$sess_id." || ".$sess_id2." || ".$sess_id3." || ".$title." || ".$alt." || ".$image." || ");
		
		$array = htmlspecialchars($image."|".$title."|".$alt);
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccA."','".$image."','".md5("NEW - MY HOME PAGE SLIDER")."');";
		@$res = mysqli_query($db,$ins);
		if(@$res)
		{
			$ins2 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccA."','".mysqli_real_escape_string($db,$array)."','".md5("HOME PAGE SLIDER IMAGE")."');";
			@$res2 = mysqli_query($db,$ins2);
			
			if(@$res2)
			{
				return 1;
			}
			else
			{
				return 2;
			}
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}

}
 

if(function_exists('deleteSliderImage'))
{
	
}
else
{
	function deleteSliderImage($id){
		
	include find_file("cnct.php");
		
		$delete = "DELETE FROM meta WHERE userid = '".$id."';";
		@$res = mysqli_query($db,$delete);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}

}
 

if(function_exists('addImageDetails'))
{
	
}
else
{
	function addImageDetails($type,$userid,$value){
		
	include find_file("cnct.php");

		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$userid."','".addslashes($value)."','".md5($type." MY HOME PAGE SLIDER IMAGE DETAILS")."');";
		//echo $ins."<br><br><br>";
		@$res = mysqli_query($db,$ins);
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}

}
 

if(function_exists('AddImageToSlider'))
{
	
}
else
{
	function AddImageToSlider(){

		$covervarname = "coverimage";
			?>
		<div style="float: left; min-width:300px; width:65%; background-color:#333; padding:5px; margin:5px; color:#fff; margin-bottom:5px;">
			<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px; float: left; padding:5px; background-color:#888;">
					<select name="transition">
						<option value="Swing Outside in Stairs">Swing Outside in Stairs</option>
						<option value="Dodge Dance Outside out Stairs">Dodge Dance Outside out Stairs</option>
						<option value="Dodge Pet Outside in Stairs">Dodge Pet Outside in Stairs</option>
						<option value="Dodge Dance Outside in Random">Dodge Dance Outside in Random</option>
						<option value="Flutter out Wind">Flutter out Wind</option>
						<option value="Collapse Stairs">Collapse Stairs</option>
						<option value="Collapse Random">Collapse Random</option>
						<option value="Vertical Chess Stripe">Vertical Chess Stripe</option>
						<option value="Extrude out Stripe">Extrude out Stripe</option>
						<option value="Dominoes Stripe">Dominoes Stripe</option>
					</select>
				</div>
				<div style="margin:5px; float: left; padding:5px; background-color:#888;"><input type="submit" name="submitBtn3" value="Submit"></div>
			</form>
		</div>
		<?php
		
		
		if($_REQUEST["submitBtn3"]=='Submit')
		{
			
			if(SliderTransition("ADD",$_REQUEST["transition"])==1)
			{
				echo "Success! Transition Effect has been set.";
			}
			else
			{
				echo "Error setting Transition Effect.";
			}
		}
		

		?>
		<div style="float: left; min-width:300px; width:65%; background-color:#333; padding:5px; margin:5px; color:#fff; margin-bottom:5px;">
			<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px; float: left; padding:5px; background-color:#888;"><b><?php echo '<b>ADD SLIDER IMAGE</b> <br>';?></b><?php echo '<input name='.$covervarname.' type="file" accept="image/jpg,image,png,image/gif,image/jpeg,image/bmp">';?><br> <b>TITLE:</b> <input name=<?php echo $covervarname.'title'?> type="text" size="20"></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#888;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
		</div>
		<?php
		
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			$addImage = addSliderImage(upload($covervarname,"images/","","AUTO",""),$_REQUEST[$covervarname.'title'],$_REQUEST[$covervarname.'title']);
			
			if($addImage==1)
			{
				echo "Success!";
			}
			elseif($addImage==2)
			{
				echo "Image uploaded with some errors. Delete and try again.";
			}
			elseif($addImage==0)
			{
				echo "Error!";
			}
		}
	}

}
 

if(function_exists('updateSliderImageDetails'))
{
	
}
else
{
	function updateSliderImageDetails(){
		
		if(isset($_REQUEST["func"]) && isset($_REQUEST["idx"]))
		{
			?>
			<div u="slides" style="float: left; position: relative; left: 3px; top: 3px; margin-bottom:100px; background-color:#333; padding:3px;">
				<div style="width: 600px; float:left;">
					<a href="?ref=admin.php&extn=<?php echo $_REQUEST["extn"];?>"><div style="float: left; margin:2px; padding:5px; color:#000; background-color:#00ff00;">BACK</div></a>
					<img src="images/<?php echo getSliderImages($_REQUEST["idx"]);?>" style="width: 100%; float:left;"/>
				<?php 
				
					if($_REQUEST["submitBtn"]=="")
					{
						?>
					<form action="" method="POST" enctype="multipart/form-data">
						<?php 
						if($_REQUEST["func"]=="SET CAPTION DETAILS")
						{
						?>
							<div style="float: left; position: relative; left: 3px; top: 3px; margin:2px; background-color:#555; padding:5px;">
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><b>ADD CAPTION TEXT:</b> <textarea rows="3" cols="68" name="captiontext"><?php echo str_replace("<br />", "\n", ImagesDetails($_REQUEST["idx"],"TEXT")); ?></textarea></div>
							</div>
							<div style="float: left; position: relative; left: 3px; top: 3px; margin:2px; background-color:#555; padding:5px;">
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><?php echo '<b>CAPTION TEXT AREA VERTICAL ORIENTATION</b> <br><label>TOP: <input name="v_orientation" type="radio" value="top" '.$checknoindex.'> &nbsp;&nbsp;&nbsp;</label><br><label><b>BOTTOM:</b> <input name="v_orientation" type="radio" value="bottom" '.$checkindex.'></label>';?></div>
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><b>SPACE BETWEEN SELECTED BORDER & CAPTION TEXT AREA:</b> <input size="20" name="v_orientation_value" value="<?php echo ImagesDetails($_REQUEST["idx"],"v_orientation_value"); ?>"></div>
							</div>
							<div style="float: left; position: relative; left: 3px; top: 3px; margin:2px; background-color:#555; padding:5px;">
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><?php echo '<b>CAPTION TEXT AREA HORIZONTAL ORIENTATION</b> <br><label>LEFT: <input name="h_orientation" type="radio" value="left" '.$checknoindex.'> &nbsp;&nbsp;&nbsp;</label><br><label><b>RIGHT:</b> <input name="h_orientation" type="radio" value="right" '.$checkindex.'></label>';?></div>
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><b>SPACE BETWEEN SELECTED BORDER & CAPTION TEXT AREA:</b> <input size="20" name="h_orientation_value" value="<?php echo ImagesDetails($_REQUEST["idx"],"h_orientation_value"); ?>"></div>
							</div>
							<div style="float: left; position: relative; left: 3px; top: 3px; margin:2px; background-color:#555; padding:5px;">
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><b>CAPTION TEXT AREA LINE HEIGHT:</b> <input size="20" name="textline_height" value="<?php echo ImagesDetails($_REQUEST["idx"],"textline_height"); ?>"></div>
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><b>FONT SIZE:</b><br> <input size="20" name="fontsize" value="<?php echo ImagesDetails($_REQUEST["idx"],"fontsize"); ?>"></div>
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><b>FONT COLOR:</b><br> <input size="20" name="fontcolor" value="<?php echo ImagesDetails($_REQUEST["idx"],"fontcolor"); ?>"></div>
							</div>
						<?php 
						}
						?>
						
						<?php 
						if($_REQUEST["func"]=="SET BOOKING DETAILS")
						{
						?>
							<div style="float: left; position: relative; left: 3px; top: 3px; margin:2px; background-color:#555; padding:5px;">
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><?php echo '<b>ENABLE `BOOK NOW` BUTTON?</b> <br><label>NO: <input name="bookingstatus" type="radio" value="0" '.$checknoindex.'> &nbsp;&nbsp;&nbsp;</label><br><label><b>YES:</b> <input name="bookingstatus" type="radio" value="1" '.$checkindex.'></label>';?></div>
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><b>BOOKING URL:</b><br> <input size="45" name="booknowurl" value="<?php echo ImagesDetails($_REQUEST["idx"],"URL"); ?>"></div>
							</div>
						<?php 
						}
						?>
						
						<?php 
						if($_REQUEST["func"]=="DELETE IMAGE")
						{
						?>
							<div style="float: left; position: relative; left: 3px; top: 3px; margin:2px; background-color:#555; padding:5px;">
								<div style="margin:5px; float: left; padding:5px; background-color:#ccc;"><?php echo '<b>YOU ARE ABOUT TO DELETE THIS IMAGE. CLICK <I>`PROCEED`</I> TO COMPLETE THIS ACTION OR <I>`BACK`</I> TO CANCEL THE OPERATION. <input name="deleteimage" type="HIDDEN" value="DELETE">';?></div>
							</div>
						<?php 
						}
						?>
							<div style="float: left; position: relative; left: 3px; top: 3px; margin:2px; background-color:#555; padding:5px;">
								<input type="submit" value="PROCEED" name="submitBtn" style="font-size:18px; font-weight:bold;">
							</div>
					</form>
					<?php 
					}
					
					
					if($_REQUEST["submitBtn"]=="PROCEED")
					{
						echo '<div style="float: left; position: relative; left: 3px; top: 3px; margin:2px; color:#fff; padding:5px;">';
						///////////////////////////////////////////////////////////////////////////////////
						if($_REQUEST["func"]=="SET CAPTION DETAILS")
						{
							if(addImageDetails("TEXT",$_REQUEST["idx"],nl2br($_REQUEST["captiontext"]))==1)
							{
								echo "CAPTION TEXT SUCCESSFULLY SET TO IMAGE.<br><br>";
							}
							else
							{
								echo "ERROR SETTING CAPTION TEXT TO IMAGE.<br><br>";
							}
							
							
							
							
							if(addImageDetails("v_orientation",$_REQUEST["idx"],$_REQUEST["v_orientation"])==1)
							{
								echo "CAPTION TEXT VERTICAL ORIENTATION SUCCESSFULLY SET.<br><br>";
							}
							else
							{
								echo "ERROR SETTING CAPTION TEXT VERTICAL ORIENTATION.<br><br>";
							}
							
							
							
							
							if(addImageDetails("v_orientation_value",$_REQUEST["idx"],$_REQUEST["v_orientation_value"])==1)
							{
								echo "CAPTION TEXT VERTICAL BORDER SUCCESSFULLY SET.<br><br>";
							}
							else
							{
								echo "ERROR SETTING CAPTION TEXT VERTICAL BORDER.<br><br>";
							}
							
							
							
							
							if(addImageDetails("h_orientation",$_REQUEST["idx"],$_REQUEST["h_orientation"])==1)
							{
								echo "CAPTION TEXT HORIZONTAL ORIENTATION SUCCESSFULLY SET.<br><br>";
							}
							else
							{
								echo "ERROR SETTING CAPTION TEXT HORIZONTAL ORIENTATION.<br><br>";
							}
							
							
							
							
							if(addImageDetails("h_orientation_value",$_REQUEST["idx"],$_REQUEST["h_orientation_value"])==1)
							{
								echo "CAPTION TEXT HORIZONTAL BORDER SUCCESSFULLY SET.<br><br>";
							}
							else
							{
								echo "ERROR SETTING CAPTION TEXT HORIZONTAL BORDER.<br><br>";
							}
							
							
							
							
							if(addImageDetails("textline_height",$_REQUEST["idx"],$_REQUEST["textline_height"])==1)
							{
								echo "CAPTION TEXT LINE HEIGHT SUCCESSFULLY SET.<br><br>";
							}
							else
							{
								echo "ERROR SETTING CAPTION TEXT LINE HEIGHT.<br><br>";
							}
							
							
							
							
							if(addImageDetails("fontsize",$_REQUEST["idx"],$_REQUEST["fontsize"])==1)
							{
								echo "CAPTION TEXT FONT SIZE SET.<br><br>";
							}
							else
							{
								echo "ERROR SETTING CAPTION TEXT FONT SIZE.<br><br>";
							}
							
							
							
							
							if(addImageDetails("fontcolor",$_REQUEST["idx"],$_REQUEST["fontcolor"])==1)
							{
								echo "CAPTION TEXT FONT COLOUR SET.<br><br>";
							}
							else
							{
								echo "ERROR SETTING CAPTION TEXT FONT COLOUR.<br><br>";
							}
							
							
						}
						///////////////////////////////////////////////////////////////////////////////////
						
						
						
						///////////////////////////////////////////////////////////////////////////////////					
						if($_REQUEST["func"]=="SET BOOKING DETAILS")
						{
							if(addImageDetails("bookingstatus",$_REQUEST["idx"],$_REQUEST["bookingstatus"])==1)
							{
								echo "<i>`BOOK NOW`</i> BOTTON STATUS SUCCESSFULLY CHANGED.<br><br>";
							}
							else
							{
								echo "ERROR SETTING <i>`BOOK NOW`</i> BOTTON STATUS.<br><br>";
							}
							
							
							if(addImageDetails("URL",$_REQUEST["idx"],$_REQUEST["booknowurl"])==1)
							{
								echo "<i>`BOOK NOW`</i> URL SUCCESSFULLY SET.<br><br>";
							}
							else
							{
								echo "ERROR SETTING <i>`BOOK NOW`</i> URL.<br><br>";
							}
						}
						/////////////////////////////////////////////////////////////////////////////////
						
						
						/////////////////////////////////////////////////////////////////////////////////
						if($_REQUEST["func"]=="DELETE IMAGE")
						{
							if(deleteSliderImage($_REQUEST["idx"])==1)
							{
								echo "SLIDER IMAGE REMOVED SUCCESSFULLY.<br><br>";
							}
							else
							{
								echo "ERROR SLIDER IMAGE.<br><br>";
							}
						}
						/////////////////////////////////////////////////////////////////////////////////
						echo "</div>";
					}
					?>
				</div>
			</div>
			<?php
		}
		else
		{
			AddImageToSlider();
			?>
			<div u="slides" style="float: left; position: relative; left: 3px; top: 3px; width: 800px; overflow: hidden; margin-bottom:100px; background-color:#eee; padding:5px;">
				<?php 
				$imgArray = ListSliderImages();
				
				for($a=0; $a<CountSliderImages(); $a++)
				{
					?>
					<div style="width: 98%; float:left; margin-top:15px; background-color:#333; padding:5px;">
						<img src="images/<?php echo $imgArray[$a]['img'];?>" style="width: 100%; float:left;"/>
						<div class="captionBlack" style="float: left; position: relative; width: <?php echo $imgArray[$a]['textwidth'];?>px; height: <?php echo $imgArray[$a]['textheight'];?>px; padding: 5px;
							text-align: left; font-size: <?php echo $imgArray[$a]['fontsize'];?>px;
								color: <?php echo $imgArray[$a]['fontcolor'];?>;">
								<?php echo $imgArray[$a]['text'];?>
						</div>
						
						<div style="width:98%; float: left;">
							<a href="?ref=admin.php&extn=<?php echo $_REQUEST["extn"];?>&idx=<?php echo $imgArray[$a]['userid'];?>&func=SET CAPTION DETAILS"><div style="float: left; margin:2px; padding:5px; color:#000; background-color:#bbb;">SET CAPTION DETAILS</div></a>
							<a href="?ref=admin.php&extn=<?php echo $_REQUEST["extn"];?>&idx=<?php echo $imgArray[$a]['userid'];?>&func=SET BOOKING DETAILS"><div style="float: left; margin:2px; padding:5px; color:#000; background-color:#bbb;">SET BOOKING DETAILS</div></a>
							<a href="?ref=admin.php&extn=<?php echo $_REQUEST["extn"];?>&idx=<?php echo $imgArray[$a]['userid'];?>&func=DELETE IMAGE"><div style="float: left; margin:2px; padding:5px; color:#000; background-color:#ff0000;">DELETE IMAGE</div></a>
						</div>
					</div>
					<?php 
				}
				?>
			</div>
		<?php
		}
	}

}
 

if(function_exists('TransitionEffect'))
{
	
}
else
{
	function TransitionEffect(){
		
		if(SliderTransition()=="Swing Outside in Stairs")
		{
		?>
		   //Swing Outside in Stairs
		  {$Duration: 1200, $Delay: 20, $Cols: 8, $Rows: 4, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 9, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseInWave, $Clip: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.2, $ScaleVertical: 0.1, $Outside: true, $Round: { $Left: 1.3, $Top: 2.5} }
		<?php 
		}
		elseif(SliderTransition()=="Dodge Dance Outside out Stairs")
		{
		?>
			//Dodge Dance Outside out Stairs
		   { $Duration: 1500, $Delay: 20, $Cols: 8, $Rows: 4, $Clip: 15, $During: { $Left: [0.1, 0.9], $Top: [0.1, 0.9] }, $SlideOut: true, $FlyDirection: 9, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump, $Clip: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Outside: true, $Round: { $Left: 0.8, $Top: 2.5} }
		<?php 
		}
		elseif(SliderTransition()=="Dodge Pet Outside in Stairs")
		{
		?>
			//Dodge Pet Outside in Stairs
		   { $Duration: 1500, $Delay: 20, $Cols: 8, $Rows: 4, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 9, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseInWave, $Clip: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.2, $ScaleVertical: 0.1, $Outside: true, $Round: { $Left: 0.8, $Top: 2.5} }
		<?php 
		}
		elseif(SliderTransition()=="Dodge Dance Outside in Random")
		{
		?>
			//Dodge Dance Outside in Random
		   { $Duration: 1500, $Delay: 20, $Cols: 8, $Rows: 4, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 9, $Easing: { $Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump, $Clip: $JssorEasing$.$EaseOutQuad }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Outside: true, $Round: { $Left: 0.8, $Top: 2.5} }
		<?php 
		}
		elseif(SliderTransition()=="Flutter out Wind")
		{
		?>
			//Flutter out Wind
		   { $Duration: 1800, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $FlyDirection: 5, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $ScaleHorizontal: 1, $ScaleVertical: 0.2, $Outside: true, $Round: { $Top: 1.3} }
		<?php 
		}
		elseif(SliderTransition()=="Collapse Stairs")
		{
		?>
			//Collapse Stairs
		   { $Duration: 1200, $Delay: 30, $Cols: 8, $Rows: 4, $Clip: 15, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2049, $Easing: $JssorEasing$.$EaseOutQuad }
		<?php 
		}
		elseif(SliderTransition()=="Collapse Random")
		{
		?>
			//Collapse Random
		   { $Duration: 1000, $Delay: 80, $Cols: 8, $Rows: 4, $Clip: 15, $SlideOut: true, $Easing: $JssorEasing$.$EaseOutQuad }
		<?php  
		}
		elseif(SliderTransition()=="Vertical Chess Stripe")
		{
		?>
			//Vertical Chess Stripe
		   { $Duration: 1000, $Cols: 12, $FlyDirection: 8, $Formation: $JssorSlideshowFormations$.$FormationStraight, $ChessMode: { $Column: 12} }
		<?php 
		}
		elseif(SliderTransition()=="Extrude out Stripe")
		{
		?>
			//Extrude out Stripe
		   { $Duration: 1000, $Delay: 40, $Cols: 12, $SlideOut: true, $FlyDirection: 2, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Opacity: $JssorEasing$.$EaseInOutQuad }, $ScaleHorizontal: 0.2, $Opacity: 2, $Outside: true, $Round: { $Top: 0.5} }
		<?php 
		}
		elseif(SliderTransition()=="Dominoes Stripe")
		{
		?>
			//Dominoes Stripe
			{ $Duration: 2000, $Delay: 60, $Cols: 15, $SlideOut: true, $FlyDirection: 8, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Easing: $JssorEasing$.$EaseOutJump, $Round: { $Top: 1.5} }
	<?php
		}
		else
		{
		?>
			//Collapse Stairs
		   { $Duration: 1200, $Delay: 30, $Cols: 8, $Rows: 4, $Clip: 15, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2049, $Easing: $JssorEasing$.$EaseOutQuad }
	<?php
		}
	}

}
 

if(function_exists('frontPageSlider'))
{
	
}
else
{
	function frontPageSlider(){

		if(sliderStatus()==1)
		{
		//START YOUR CODE BELOW THIS LINE

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
			.jssorb03 div { background-position: -3px -4px; }
			.jssorb03 div:hover, .jssorb03 .av:hover { background-position: -33px -4px; }
			.jssorb03 .av { background-position: -63px -4px; }
			.jssorb03 .dn, .jssorb03 .dn:hover { background-position: -93px -4px; }
		</style>
		<?php
		echo "<div style='position: relative; top: 0px; float: left; width: 100%;'>";
		include "plugins/slider/galleries/banner-rotator.php";
		echo '</div>';
		}
	}
}
?>