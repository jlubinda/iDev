<style>
	#intro {
	position: relative;
	//top: -30px;
	width: 99.4%;
	//height: 58px;
	margin-bottom:3px;
	background-color: #000;
	color:#ff0000;
	border-top:#5F9D00 solid 3px;
	border-left:#5F9D00 solid 3px;
	border-bottom:#5F9D00 solid 3px;
	border-right:#5F9D00 solid 3px;
	//padding: 3px;
	border-radius: 3px;
	text-align: left;
	font-size: 18px;
	float: left;
	}
	
	#ownholiday{
		background-color: #F1FFD9;
		color: #000;
		//height: 48px;
		min-width: 250px;
		width: 98%;
		font-size: 13px;
		padding-top: 3px;
		padding-bottom: 3px;
		padding-left: 1%;
		padding-right: 1%;
		float: left;
		text-align: center;
		font-weight: bonormalld;
		//background: -prefix-linear-gradient(top, blue, white);
		//background: linear-gradient(top bottom right, #1C3300, rgba(255,0,0,0));
		font-family: Century Gothic, sans-serif;
	}
	
	#ownholiday:hover{
		background-color: #000;
		color: #ff9000;
		font-size: 13px;
		font-weight: bold;
		//background: linear-gradient(to bottom right, #006600, rgba(255,110,100,0));
	}
		
		#show1{
		position: relative;
		top: 5px;
		left:0px;
		min-width: 200px;
		min-height: 718px;
		width: 300px;
		margin-top: 3px;
		margin-bottom: 10px;
		margin-left: 3px;
		margin-right: 3px;
		background-color: #5F9D00;
		//border-top:#5F9D00 solid 3px;
		border-left:#5F9D00 solid 0.3%;
		//border-bottom:#5F9D00 solid 3px;
		border-right:#5F9D00 solid 0.3%;
		padding: 0px;
		border-radius: 0px;
		float:left;
		}
		
		#imgshow{
		min-width: 170px;
		width: 98%;
		float: left;
		padding: 1%;
		}
</style>
			
	
<?php 


		if($_REQUEST["function"]=="delete" && !($_REQUEST["type"]=="image"))
		{
			if(deleteTour($_REQUEST["unitx"])==1)
			{
				echo "Tour package removed.";
			}
			else
			{
				echo "Error. Tour package not removed.";
			}
		}
		
		
		if($_REQUEST["unitx2"]=="")
		{

			$mytourscat = tourCategory();
			$numcat = count($mytourscat);

			for($p=0; $p<$numcat; $p++)
			{
				$useridx = $mytourscat[$p]["userid"];
				
				$d = explode(" ",tourCategory("NAME",$useridx));
				$linkx = "";
				
				for($t=0; $t<count($d); $t++)
				{
					$linkx .= $d[$t];
				}
				
				$linkx .= ".php";
				?>
				<div style="float: left; width: 65%; min-width:300px; margin: 0.7%; border-radius: 5px; background-color: #cfcfcf; padding:8px;">
					<div align="left" style="float: left; font-size: 12px; color: #000; min-width: 300px; width: 99%; font-weight:normal;">
						<?php 
						echo "<b>CATEGORY NAME: </b>".tourCategory("NAME",$useridx);
						?>
					</div>
					<div align="left" style="float: left; font-size: 12px; color: #000; min-width: 300px; width: 99%; font-weight:normal;">
						<?php 
						echo "<b>DESCRIPTION: </b>".tourCategory("DESCRIPTION",$useridx);
						?>
					</div>
					<div align="left" style="float: left; font-size: 12px; color: #000; min-width: 300px; width: 99%; font-weight:normal;">
						<?php 
						echo "<b>FOCUS AREA: </b>".tourCategory("FOCUS",$useridx);
						?>
					</div>
					<div align="left" style="float: right; font-size: 12px; color: #000; min-width: 300px; width: 99%; font-weight:normal;">
						<?php 
						echo "<a href='?ref=admin/listtours.php&unitx2=".strtolower($linkx)."'>View Tours</a>";
						?>
					</div>
				</div>
				<?php
			}

		}
		else
		{
			if($_REQUEST["function"]=="view")
			{
			$fimage = getImages($_REQUEST["unitx"],"ID");
			$fimageTitle = explode(",",myTours("MORE IMAGES TITLE",$_REQUEST["unitx"]));
			$fimageAlt = explode(",",myTours("MORE IMAGES ALT",$_REQUEST["unitx"]));
			$height = 0;
			
			$maxwidth = 600;
			$minheight = 400;
				
			$bcntx = 0;
			for($d2xx=0; $d2xx<getImages($_REQUEST["unitx"],"NUM"); $d2xx++)
			{
				if(file_exists("images/".getImages($_REQUEST["unitx"],"URL",$fimage[$d2xx])))
				{
					$bcntx = $bcntx+1;
				}
				else
				{
					$bcntx = $bcntx;
				}
			}
				
				echo "test:".$bcntx;
							
				if($bcntx>0)
				{
				?>
				<div style="float: left; width: 100%; border-radius: 0px;">
					<div style="float: left; width: 100%; border-radius: 0px; background-color: #5F9D00;">
					<?php
						for($x=0; $x<($bcntx); $x++)
						{
							if(file_exists("images/".getImages($_REQUEST["unitx"],"URL",$fimage[$x])))
							{
								?>
									<div style="float: left; margin:5px; width: 310px; background-color:#fff; padding:4px;">
										<?php echo "<img src='images/".getImages($_REQUEST["unitx"],"URL",$fimage[$x])."' id='imgshow2' title='".getImages($_REQUEST["unitx"],"TITLE",$fimage[$x])."' alt='".getImages($_REQUEST["unitx"],"ALT",$fimage[$x])."' style='float:left; width:300px; margin-top: 5px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px;'>"?>
										<div style="float: bottom; margin:5px;"><?php echo getImages($_REQUEST["unitx"],"TITLE",$fimage[$x]);?></div>
										<div style="float: bottom; margin:5px;"><a href="?ref=admin/listtours.php&function=delete&unitx2=<?php echo $_REQUEST["unitx2"];?>&unitx=<?php echo getImages($_REQUEST["unitx"],"ID",$fimage[$x]);?>&type=image&idx=<?php echo $userid;?>">Delete</a></div>
									</div>
								<?php
							}
						}
					?>
					</div>
					<div align="center" style="position: relative; float: left; margin-bottom:100px;"><a href="?ref=<?php echo $_REQUEST["ref"];?>&unitx=<?php echo $_REQUEST["unitx"];?>&action=Book Tour&title=<?php echo myTours("TITLE",$_REQUEST["unitx"]);?>&extn=1" title="BOOK NOW: <?php echo myTours("TITLE",$_REQUEST["unitx"]);?>"><img src="themes/<?php echo themeurl()?>/images/booknow.png" style="min-width: 80px; width: 120px; margin:5px; float: left;"></a></div>
				</div>
				<?php 
				}
			}
			elseif($_REQUEST["function"]=="add")
			{
				$imagename = "imageUpload";
				
				if($_REQUEST["type"]=="image")
				{
					if($_REQUEST["unitx"]=="")
					{
						
					}
					else
					{
						?>
						<div style="float: left; min-width:300px; width:65%; background-color:#333; padding:5px; margin:5px; color:#fff; margin-bottom:100px;">
							<form action="" method="POST" enctype="multipart/form-data">
								<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>IMAGE</b> <br>';?></b><?php echo '<input name='.$imagename.' type="file" accept="image/jpg,image,png,image/gif,image/jpeg,image/bmp">';?><br> <b>TITLE:</b> <input name=<?php echo 'title'?> type="text" size="20" value="<?php echo $_REQUEST['title'];?>"> <br><b>ALTANATIVE TEXT:</b> <input name=<?php echo 'alt'?> type="text" size="20" value="<?php echo $_REQUEST['alt'];?>"></div>
								<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
							</form>
						</div>
						<?php
							
						if($_REQUEST["submitBtn"]=="Submit")
						{
							if(addTourImage(upload($imagename,"images/","","AUTO",""),$_REQUEST["title"],$_REQUEST["alt"],$_REQUEST["unitx"])==1)
							{
								echo "Image has been added.";
							}
							else
							{
								echo "Error adding image.";
							}
						}
					}
				}
			}
			elseif($_REQUEST["function"]=="delete")
			{
				if($_REQUEST["type"]=="image")
				{
					if($_REQUEST["unitx"]=="")
					{
						
					}
					else
					{
						if(deleteTourImage($_REQUEST["idx"])==1)
						{
							echo "Image has been deleted.";
						}
						else
						{
							echo "Error deleting image.";
						}
					}
				}
			}
			elseif($_REQUEST["function"]=="")
			{
				$tours = myTours("","","",$_REQUEST["unitx2"]);
				$num = $tours[0]['num'];			
				
				for($n=0; $n<$num; $n++)
				{
					$userid = $tours[$n]['userid'];
				?>
				<div id="show1">
					<div style="float: left; width: 98%; margin: 1%; border-radius: 5px;">
						<div align="center" style="font-size: 20px; color: #fff;"><b><?php echo myTours("TITLE",$userid,"",$_REQUEST["unitx2"]); ?></b></div>
					</div><br>
					<img src="images/<?php echo myTours("COVER IMAGE",$userid,"",$_REQUEST["unitx2"]); ?>" id="imgshow" height="200"><br>
					<div style="float: left; width: 98%; min-height: 420px; background-color: #fff; margin: 1%; border-radius: 0px; background-color: #E4FFB9;">
						<div style="float: left; width: 99%; font-size: 14px; color: #005500; padding: 5px; line-height: 30px;">
							<u><b><?php echo myTours("NIGHTS",$userid,"",$_REQUEST["unitx2"]); ?> NIGHTS <?php echo myTours("DAYS",$userid,"",$_REQUEST["unitx2"]); ?> DAYS TOUR PACKAGE</b></u><br><br>
							 <b>Rate:</b> <?php echo tourSetUp("CURRENCYSYMBOL")."".myTours("SHARING PRICE",$userid,"",$_REQUEST["unitx2"]); ?> per person sharing & <?php echo tourSetUp("CURRENCYSYMBOL")."".myTours("SINGLE SUPPLEMENT PRICE",$userid,"",$_REQUEST["unitx2"]); ?> per person single supplement<br>
							 <u><b>ACTIVITIES</b></u><br>
							 <?php 
								$mytours = myTours("ACTIVITIES",$userid,"",$_REQUEST["unitx2"]);
								$acmax = tourSetUp("ACTIVITIES");
								
								
								$tourParagraphs = explode("\n", $mytours);
								$numPara = count($tourParagraphs);
								
								$toursX = "";
								$toursX2 = "";
								
								$nu = 0;
								
								for($p=0; $p<$numPara; $p++)
								{
									$tourInLine = explode(",",$tourParagraphs[$p]);
									$numtourInLine = count($tourInLine);
									
									
									for($l=0; $l<$numtourInLine; $l++)
									{
										
										$nu = $nu+1;
										
										if($nu<=$acmax)
										{
											if($l==0)
											{
												
											}
											else
											{
												$toursX .= ", ";
											}
											
											$toursX .= $tourInLine[$l];
										}
										
										
										if($nu>$acmax)
										{
											$toursX2 .= $tourInLine[$l];
										}
									}
								}
								
								
								
								if($nu<=$acmax)
								{
									echo $toursX;
								}
								else
								{								
									echo $toursX." and ".($nu-$acmax)." others";
								}
								
							 ?>
							 <br><br>
							  
							 <?php 
							 $mytours = myTours("EXTRAS",$userid,"",$_REQUEST["unitx2"]);
							 $count = $mytours[0]['num'];
							 
							 if($count<=0)
							 {
								 
							 }
							 else
							 {
								 echo "<u><b>EXTRAS</b></u><br>";
								 
								 $countX = tourSetUp("EXTRAS");
								 
								 
								 for($f=0; $f<$countX; $f++)
								 {
									 if($f==0)
									 {
										 
									 }
									 else
									 {
										 echo ", ";
									 }
									 
									 echo $mytours[$f]['name'];
								 }
								 
								 if($count>$countX)
								 {
									 if($count-$countX<=5)
									 {
										 if(($count-$countX==1))
										 {
											 $plural = "y";
											 $ender = ".";
										 }
										 else
										 {
											 $plural = "ies";
											 $ender = " from.";
										 }
										 echo " and ".($count-$countX)." more activit".$plural." to choose".$ender;
									 }
									 else
									 {
										 echo " and many more activities to choose from.";
									 }
								 }
							 }
							 ?>
							 </span>
						</div>
						<div align="center" style=""><a href="?ref=admin/listtours.php&function=view&unitx2=<?php echo $_REQUEST["unitx2"];?>&unitx=<?php echo $userid;?>&type=image">VIEW IMAGES</a></div>
						<div align="center" style=""><a href="?ref=admin/listtours.php&function=add&unitx2=<?php echo $_REQUEST["unitx2"];?>&unitx=<?php echo $userid;?>&type=image">ADD IMAGES</a></div>
						<div align="center" style=""><a href="?ref=admin/listtours.php&function=delete&unitx=<?php echo $userid;?>">DELETE TOUR</a></div>
					</div>
				</div>
				<?php 
				}
			}
		}

?>
<div style="float: left; margin-bottom:200px; margin-top:50px; width: 98%;">&nbsp;</div>