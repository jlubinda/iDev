<?php

if(@privacy('Free|Open')=='Granted')
{
//START YOUR CODE BELOW THIS LINE



if($_REQUEST["function"]=='' || $_REQUEST["function"]=='view')
{
//START YOUR CODE BELOW THIS LINE
	if($_REQUEST["unitx"]=="mytour")
	{
	createMyTour();
	}
	elseif(!($_REQUEST["unitx"]=="mytour") && !($_REQUEST["unitx"]=="") && ($_REQUEST["action"]=="View Tour"))
	{
?>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="resources/slider/demo/css/demostyles.css">
        <link rel="stylesheet" href="resources/slider/css/simple-slideshow-styles.css">
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
		min-width: 300px;
		width: 100%;
		margin-top: 3px;
		margin-bottom: 50px;
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
		float: left;
		padding: 1%;
		}
		
		//#imgshow2{
		//float: left;
		//padding: 5px;
		}
		
		#itparagraph{
		float: left;
		min-width: 300px;
		}
		
		#parspan{
		float: left;
		min-width: 300px;
		}
</style>
		
		<div id="show1">
			<div style="float: left; width: 99%; font-size:20px; padding: 5px;">
			<?php echo myTours("TITLE",$_REQUEST["unitx"]);?>
			</div>
			<?php 
			
			$fimage = explode(",",myTours("MORE IMAGES",$_REQUEST["unitx"]));
			$fimageTitle = explode(",",myTours("MORE IMAGES TITLE",$_REQUEST["unitx"]));
			$fimageAlt = explode(",",myTours("MORE IMAGES ALT",$_REQUEST["unitx"]));
			$height = 0;
			
			$maxwidth = 600;
			$minheight = 400;
				
			$bcntx = 0;
			for($d2xx=0; $d2xx<count($fimage); $d2xx++)
			{
				if(file_exists("images/".$fimage[$d2xx]))
				{
					$bcntx = $bcntx+1;
				}
				else
				{
					$bcntx = $bcntx;
				}
			}
			
				$heightY2 = $maxwidth*imageSize("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),"HEIGHT")/imageSize("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),"WIDTH");
				
				if($heightY2>$height)
				{
					$height = $heightY2;
				}
				else
				{
					$height = $height;
				}
				
				
			for($d2=0; $d2<$bcntx; $d2++)
			{
				if(file_exists("images/".$fimage[$d2]))
				{
					$heightX = imageSize("images/".$fimage[$d2],"HEIGHT");
					$widthX = imageSize("images/".$fimage[$d2],"WIDTH"); 
					
					$heightY = $maxwidth*$heightX/$widthX;
					
					if($heightY>$height)
					{
						$height = $heightY;
					}
					else
					{
						$height = $height;
					}
				}
			}
			$height = $height+15;
			
			if($height>$minheight)
			{
				$minheight = $height;
			}
			else
			{
				$minheight = $minheight;
			}
			
			
				$heightX4 = imageSize("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),"HEIGHT");
				$widthX4 = imageSize("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),"WIDTH"); 
					
				$heightY4 = $maxwidth*$heightX4/$widthX4;
				
				
					if($heightY4==($height-15))
					{
						$topmargin4 = 5;
					}
					else
					{
						$topmargin4 = number_format((($height-$heightY4)/2),0);
					}
			?>
						   
				<div class="bss-slides num1" tabindex="1" autofocus="autofocus" style="float: left; height:<?php echo $height;?>px; width:<?php echo $maxwidth+10;?>px; min-height:<?php echo $minheight;?>px; background-color: #eee; margin:5px;">
						<figure>
							<?php echo "<img src='images/".myTours("COVER IMAGE",$_REQUEST["unitx"])."' id='imgshow2' ".imgSname("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),$_REQUEST["unitx"])."='".$maxwidth."' title='".myTours("COVER IMAGE TITLE",$_REQUEST["unitx"])."' alt='".myTours("COVER IMAGE ALT",$_REQUEST["unitx"])."' style='float:left; margin-top: ".$topmargin4."px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px;'>"?>
							<figcaption><?php echo myTours("COVER IMAGE TITLE",$_REQUEST["unitx"]);?></figcaption>
						</figure>
					<?php
				if($bcntx<=4)
				{
					$imgNum = $bcntx;
				}
				else
				{
					$imgNum = 4;
				}
				
				for($d=0; $d<$imgNum; $d++)
				{
					if(file_exists("images/".$fimage[$d]))
					{
						$heightX3 = imageSize("images/".$fimage[$d],"HEIGHT");
						$widthX3 = imageSize("images/".$fimage[$d],"WIDTH"); 
						
						$heightY3 = $maxwidth*$heightX3/$widthX3;
					
					
						if($heightY3==($height-15))
						{
							$topmargin = 5;
						}
						else
						{
							$topmargin = number_format((($height-$heightY3)/2),0);
						}
						?>
							<figure>
								<?php echo "<img src='images/".$fimage[$d]."' id='imgshow2' ".imgSname("images/".$fimage[$d],$_REQUEST["unitx"])."='".$maxwidth."' title='".$fimageTitle[$d]."' alt='".$fimageAlt[$d]."' style='float:left; margin-top: ".$topmargin."px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px;'>"?>
								<figcaption><?php echo $fimageTitle[$d];?></figcaption>
							</figure>
						<?php
					}						
				}
				
				?>
				</div> <!-- // bss-slides -->
				<div style="float: left; width: 98%; max-width:540px; min-height: 200px; background-color: #fff; margin: 5px; border-radius: 3px; ">
					<div style="float: left; width: 99%; font-size: 13px; font-weight: normal; color: #005500; padding: 5px; line-height: 20px;">
						<u><b><?php echo myTours("NIGHTS",$_REQUEST["unitx"]); ?> NIGHTS <?php echo myTours("DAYS",$_REQUEST["unitx"]); ?> DAYS TOUR PACKAGE</b></u><br>
						 <b>Rate:</b> <?php echo tourSetUp("CURRENCYSYMBOL")."".myTours("SHARING PRICE",$_REQUEST["unitx"]); ?> per person sharing & <?php echo tourSetUp("CURRENCYSYMBOL")."".myTours("SINGLE SUPPLEMENT PRICE",$_REQUEST["unitx"]); ?> per person single supplement<br><br>
						 <u><b>INCLUDED IN PACKAGE</b></u><br>
						 <?php 
							$mytours = myTours("ACTIVITIES",$_REQUEST["unitx"]);
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
									
									if($l==0)
									{
										
									}
									else
									{
										$toursX .= ", ";
									}
									
									$toursX .= $tourInLine[$l];
								}
							}
							
							
							
								echo $toursX;
							
						 ?><br><br>
						 <?php 
							
						 $mytours = myTours("EXTRAS",$_REQUEST["unitx"]);
						 $count = $mytours[0]['num'];
						 
						 if($count<=0)
						 {
							 
						 }
						 else
						 {
							 echo "<u><b>EXTRAS</b></u><br>";
							 
						
							 $countX = $count;
							 
							 echo '<div style="float: left; width:98%; background-color:#DFFFD7;">';
								// echo '<div style="float: left; padding-left:1%; padding-right:1%; padding-top:5px;  padding-bottom:5px; width: 48%;">';
								 for($f=0; $f<$countX; $f++)
								 {								 
									 echo '<div style="float: left; padding-left:1%; padding-right:1%; padding-top:5px;  padding-bottom:5px; width: 48%; font-weight:normal; margin-top:3px; margin-bottom:3px; font-size:12px; background-color:#fff;"> '.($f+1).') '.$mytours[$f]['name'].'</div>';
								 }
								 echo '</div>';
							 echo '</div>';
						 }
						 ?>
						 </span>
					</div>

				</div>
				<?php 
				$extraImgs = $bcntx - $imgNum;
				
				if($extraImgs>0)
				{
				?>
				<div style="float: left; width: 100%; border-radius: 0px;">
					<div style="float: left; width: 100%; border-radius: 0px; background-color: #5F9D00;">
					<?php
						for($x=5; $x<($extraImgs+4); $x++)
						{
							if(file_exists("images/".$fimage[$x]))
							{
								$heightX3 = imageSize("images/".$fimage[$d],"HEIGHT");
								$widthX3 = imageSize("images/".$fimage[$d],"WIDTH"); 
								
								$heightY3 = $maxwidth*$heightX3/$widthX3;
							
							
								if($heightY3==($height-15))
								{
									$topmargin = 5;
								}
								else
								{
									$topmargin = number_format((($height-$heightY3)/2),0);
								}
								?>
									<div style="float: left; margin:5px; width: 310px; background-color:#fff; padding:4px;">
										<?php echo "<img src='images/".$fimage[$x]."' id='imgshow2' title='".$fimageTitle[$x]."' alt='".$fimageAlt[$x]."' style='float:left; width:300px; margin-top: 5px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px;'>"?>
										<div style="float: left; margin:5px;"><?php echo $fimageTitle[$x];?></div>
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
				?>
			</div>
			
		<script src="resources/hammer/hammer.min.js"></script><!-- for swipe support on touch interfaces -->
		<script src="resources/slider/better-simple-slideshow.min.js"></script>
		<script>
		var opts = {
			auto : {
				speed : 3500, 
				pauseOnHover : true
			},
			fullScreen : false, 
			swipe : true
		};
		makeBSS('.num1', opts);

		var opts2 = {
			auto : false,
			fullScreen : true,
			swipe : true
		};
		makeBSS('.num2', opts2);
		</script>
		<?php 
	}
	elseif(!($_REQUEST["unitx"]=="mytour") && !($_REQUEST["unitx"]=="") && ($_REQUEST["action"]=="Book Tour"))
	{
		if($_REQUEST["submitBtn"]=="")
		{
		?>
		<style>
		#show1{
		position: relative;
		top: 5px;
		left:0px;
		min-width: 200px;
		width: 98%;
		margin-top: 3px;
		margin-bottom: 50px;
		margin-left: 1%;
		margin-right: 1%;
		background-color: #5F9D00;
		//border-top:#5F9D00 solid 3px;
		border-left:#5F9D00 solid 0.3%;
		//border-bottom:#5F9D00 solid 3px;
		border-right:#5F9D00 solid 0.3%;
		padding: 0px;
		border-radius: 0px;
		float:left;
		}
</style>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="resources/slider/demo/css/demostyles.css">
        <link rel="stylesheet" href="resources/slider/css/simple-slideshow-styles.css">
		
		<div id="show1">
			<div style="float: left; width: 99%; font-size:20px; padding: 5px;">
			<?php echo myTours("TITLE",$_REQUEST["unitx"]);?>
			</div>
			<?php 
			
			$fimage = explode(",",myTours("MORE IMAGES",$_REQUEST["unitx"]));
			$fimageTitle = explode(",",myTours("MORE IMAGES TITLE",$_REQUEST["unitx"]));
			$fimageAlt = explode(",",myTours("MORE IMAGES ALT",$_REQUEST["unitx"]));
			$height = 0;
			
			$bcnt = 0;
			for($d2x=0; $d2x<count($fimage); $d2x++)
			{
				if(file_exists("images/".$fimage[$d2x]))
				{
					$bcnt = $bcnt+1;
				}
				else
				{
					$bcnt = $bcnt;
				}
			}
				
				$heightY2 = 400*imageSize("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),"HEIGHT")/imageSize("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),"WIDTH");
				
				if($heightY2>$height)
				{
					$height = $heightY2;
				}
				else
				{
					$height = $height;
				}
				
				
			for($d2=0; $d2<$bcnt; $d2++)
			{
				if(file_exists("images/".$fimage[$d2]))
				{
					$heightX = imageSize("images/".$fimage[$d2],"HEIGHT");
					$widthX = imageSize("images/".$fimage[$d2],"WIDTH"); 
					
					$heightY = 400*$heightX/$widthX;
					
					if($heightY>$height)
					{
						$height = $heightY;
					}
					else
					{
						$height = $height;
					}
				}
			}
			$height = $height+15;
			
			$minheight = 340;
			
			if($height>$minheight)
			{
				$minheight = $height;
			}
			else
			{
				$minheight = $minheight;
			}
			
			
				$heightX4 = imageSize("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),"HEIGHT");
				$widthX4 = imageSize("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),"WIDTH"); 
					
				$heightY4 = 400*$heightX4/$widthX4;
				
				
					if($heightY4==($height-15))
					{
						$topmargin4 = 5;
					}
					else
					{
						$topmargin4 = number_format((($height-$heightY4)/2),0);
					}
			?>
						   
				<div class="bss-slides num1" tabindex="1" autofocus="autofocus" style="float: left; height:<?php echo $height;?>px; width:410px; min-height:<?php echo $minheight;?>px; background-color: #eee; margin:5px;">

						<figure>
							<?php echo "<img src='images/".myTours("COVER IMAGE",$_REQUEST["unitx"])."' id='imgshow2' ".imgSname("images/".myTours("COVER IMAGE",$_REQUEST["unitx"]),$_REQUEST["unitx"])."='400' title='".myTours("COVER IMAGE TITLE",$_REQUEST["unitx"])."' alt='".myTours("COVER IMAGE ALT",$_REQUEST["unitx"])."' style='float:left; margin-top: ".$topmargin4."px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px;'>"?>
						</figure>
					<?php
					
				for($d=0; $d<$bcnt; $d++)
				{
					if(file_exists("images/".$fimage[$d]))
					{
						$heightX3 = imageSize("images/".$fimage[$d],"HEIGHT");
						$widthX3 = imageSize("images/".$fimage[$d],"WIDTH"); 
						
						$heightY3 = 400*$heightX3/$widthX3;
					
					
						if($heightY3==($height-15))
						{
							$topmargin = 5;
						}
						else
						{
							$topmargin = number_format((($height-$heightY3)/2),0);
						}
						?>
							<figure>
								<?php echo "<img src='images/".$fimage[$d]."' id='imgshow2' ".imgSname("images/".$fimage[$d],$_REQUEST["unitx"])."='400' title='".$fimageTitle[$d]."' alt='".$fimageAlt[$d]."' style='float:left; margin-top: ".$topmargin."px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px;'>"?>
							</figure>
						<?php
					}						
				}
				?>
				</div> <!-- // bss-slides -->  
						
			<form action="?ref=tours.php&unitx=mytour" method="POST">
				<div style="float: left; width: 305px; min-height:<?php echo $minheight;?>px; background-color: #fff; margin: 5px; border-radius: 0px; background-color: #E4FFB9;">
					<div style="float: left; width: 300px; font-size: 13px; font-weight: normal; color: #005500; padding: 5px; line-height: 20px;">
					<?php echo myTours("ACTIVITIES",$_REQUEST["unitx"]);?>
					</div>
				</div>
				<div style="float: left; width: 305px; min-height: <?php echo $minheight;?>px; background-color: #fff; margin: 5px; border-radius: 0px; background-color: #E4FFB9;">
					<div style="float: left; width: 300px; font-size: 13px; font-weight: normal; color: #005500; padding: 5px; line-height: 20px;">
						<b style="float: right; margin-right:5px; margin-left: 5px;">Names: <input name="names" type="text" size="30" placeholder="YOUR NAMES"></b><br>
						 <b style="float: right; margin-right:5px; margin-left: 5px;">Email: <input name="email" type="text" size="30" placeholder="YOUR EMAIL"></b><br>
						 <b style="float: right; margin-right:5px; margin-left: 5px;">Phone: <input name="phone" type="text" size="30" placeholder="YOUR PHONE NUMBER"></b><br>
						 <b style="float: right; margin-right:5px; margin-left: 5px;">Start Date: <input name="phone" type="text" size="30" placeholder="WHEN DO YOU WANT TO COME"></b><br>
						 <b style="float: right; margin-right:5px; margin-left: 5px;">End Date: <input name="phone" type="text" size="30" placeholder="WHEN DO YOU WANT TO DEPART"></b><br>
						 <b style="float: right; margin-right:5px; margin-left: 5px;">Activities:<br><textarea name="phone" cols="32" rows="5" placeholder="WHAT DOW YOUR WANT TO DO WHILE IN ZAMBIA?"></textarea></b><br>
						 <b><input name="submitBtn" type="submit" value="Proceed" style='width: 120px; float: left; margin-right: auto; height: 50px; font-size: 0px; border-radius:15px; font-weight: normal; text-decoration: none; background-image: url("themes/<?php echo themeurl(); ?>/images/booknow.png"); background-size: 120px; background-repeat: no-repeat; border:#FFFFFF solid 0px;'><br>
					</div>
				</div>				

			</form>
		</div>
		<script src="resources/hammer/hammer.min.js"></script><!-- for swipe support on touch interfaces -->
		<script src="resources/slider/better-simple-slideshow.min.js"></script>
		<script>
		var opts = {
			auto : {
				speed : 3500, 
				pauseOnHover : true
			},
			fullScreen : false, 
			swipe : true
		};
		makeBSS('.num1', opts);

		var opts2 = {
			auto : false,
			fullScreen : true,
			swipe : true
		};
		makeBSS('.num2', opts2);
		</script>
<?php
		}
		elseif($_REQUEST["submitBtn"]=="Proceed")
		{
			if(bookTour($userid,$firstname,$lastname,$email,$phone,$startdate,$enddate,$extras)==1)
			{
				echo "Success!";
			}
			else
			{
				echo "Error!";
			}
		}
	}
	else
	{
?>
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
		min-height: 518px;
		width: 300px;
		margin-top: 3px;
		margin-bottom: 3px;
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


			$toursv = myTours();
			$numv = $toursv[0]['num'];
			
			$tourPin = "";
			
			for($v=0; $v<$numv; $v++)
			{
				$useridv = $toursv[$v]['userid'];
				
				if(myTours("PIN TO CATEGORY",$useridv)=="Yes")
				{
					$tourPin = $useridv;
				}
			}
			
			
		if($tourPin=="")
		{
?>
			<div id="show1">
				<form action="?ref=tours.php&unitx=mytour" method="POST">
					<div style="float: left; width: 98%; margin: 1%; border-radius: 5px; height: 80px;">
						<div align="center" style="font-size: 20px; color: #fff;"><b>CREATE YOUR OWN MEMORABLE ZAMBIAN EXPERIENCE</b></div>
					</div><br>
					<img src="images/victoriafalls5.jpg" id="imgshow"><br>
					<div style="float: left; width: 98%; min-height: 340px; background-color: #fff; margin: 1%; border-radius: 0px; background-color: #E4FFB9;">
						<div style="float: left; width: 99%; font-size: 13px; font-weight: normal; color: #005500; padding: 5px; line-height: 20px;">
							<b style="float: right; margin-right:5px; margin-left: 5px;">Names: <input name="names" type="text" size="30" placeholder="YOUR NAMES"></b><br>
							 <b style="float: right; margin-right:5px; margin-left: 5px;">Email: <input name="email" type="text" size="30" placeholder="YOUR EMAIL"></b><br>
							 <b style="float: right; margin-right:5px; margin-left: 5px;">Phone: <input name="phone" type="text" size="30" placeholder="YOUR PHONE NUMBER"></b><br>
							 <b style="float: right; margin-right:5px; margin-left: 5px;">Start Date: <input name="phone" type="text" size="30" placeholder="WHEN DO YOU WANT TO COME"></b><br>
							 <b style="float: right; margin-right:5px; margin-left: 5px;">End Date: <input name="phone" type="text" size="30" placeholder="WHEN DO YOU WANT TO DEPART"></b><br>
							 <b style="float: right; margin-right:5px; margin-left: 5px;">Activities:<br><textarea name="phone" cols="32" rows="5" placeholder="WHAT DOW YOUR WANT TO DO WHILE IN ZAMBIA?"></textarea></b><br>
							 <b><input name="submitBtn" type="submit" value="Book Now" style='width: 120px; float: left; margin-right: auto; height: 50px; font-size: 0px; border-radius:15px; font-weight: normal; text-decoration: none; background-image: url("themes/<?php echo themeurl(); ?>/images/booknow.png"); background-size: 120px; background-repeat: no-repeat; border:#FFFFFF solid 0px;'><br>
						</div>
					</div>
				</form>
			</div>
			<?php
			
			$tours = myTours();
			$num = $tours[0]['num'];
			
			
			for($n=0; $n<$num; $n++)
			{
				$userid = $tours[$n]['userid'];
			?>
			<div id="show1">
				<div style="float: left; width: 98%; margin: 1%; border-radius: 5px; height: 80px;">
					<div align="center" style="font-size: 20px; color: #fff;"><b><?php echo myTours("TITLE",$userid); ?></b></div>
				</div><br>
				<img src="images/<?php echo myTours("COVER IMAGE",$userid); ?>" id="imgshow" height="200"><br>
				<div style="float: left; width: 98%; min-height: 340px; background-color: #fff; margin: 1%; border-radius: 0px; background-color: #E4FFB9;">
					<div style="float: left; width: 99%; font-size: 13px; font-weight: normal; color: #005500; padding: 5px; line-height: 20px;">
						<u><b><?php echo myTours("NIGHTS",$userid); ?> NIGHTS <?php echo myTours("DAYS",$userid); ?> DAYS TOUR PACKAGE</b></u><br>
						 <b>Rate:</b>
						 <?php 
						 
						 if(!(myTours("SHARING PRICE",$userid)=="") && !(strtolower(myTours("SHARING PRICE",$userid))=="n/a"))
						 {
							 echo tourSetUp("CURRENCYSYMBOL")."".myTours("SHARING PRICE",$userid); ?> per person sharing<?php 
						 }
						 
						 
						 
						 if((!(myTours("SHARING PRICE",$userid)=="") && !(strtolower(myTours("SHARING PRICE",$userid))=="n/a")) && (!(myTours("SINGLE SUPPLEMENT PRICE",$userid)=="") && !(strtolower(myTours("SINGLE SUPPLEMENT PRICE",$userid))=="n/a")))
						 {
							 ?> & <?php 
						 }
						 
						 
						  
						 if(!(myTours("SINGLE SUPPLEMENT PRICE",$userid)=="") && !(strtolower(myTours("SINGLE SUPPLEMENT PRICE",$userid))=="n/a"))
						 {
							 echo tourSetUp("CURRENCYSYMBOL")."".myTours("SINGLE SUPPLEMENT PRICE",$userid); ?> per person single supplement <?php 
						 } 
						 
						 ?>
						 <br>
						 <u><b>INCLUDED</b></u><br>
						 <?php 
							$mytours = myTours("ACTIVITIES",$userid);
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
						 <br>
						  
						 <?php 
						 $mytours = myTours("EXTRAS",$userid);
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
					<div align="center" style="position: relative;"><a href="?ref=<?php echo $_REQUEST["ref"];?>&unitx=<?php echo $userid;?>&action=Book Tour&title=<?php echo myTours("TITLE",$userid);?>&extn=1" title="BOOK NOW: <?php echo myTours("TITLE",$userid);?> "><img src="themes/<?php echo themeurl()?>/images/booknow.png" style="min-width: 80px; width: 120px; margin:5px; float: left;"></a><a href="?ref=<?php echo $_REQUEST["ref"];?>&unitx=<?php echo $userid;?>&action=View Tour&title=<?php echo myTours("TITLE",$userid);?>&extn=1" title="READ MORE: <?php echo myTours("TITLE",$userid);?> "><img src="themes/<?php echo themeurl()?>/images/read-more.png" style="width: 110px; margin:5px; float: right;"></a></div>
				</div>
			</div>
			<?php 
			}
?>

				
		<div style="padding: 10px; background-color: #fff; border-radius: 10px; color: #000; font-weight: normal; float: left; margin-bottom: 50px; font-size: 13px;">
			<?php 
			
				$tours2 = myTours();
				$numc = $tours2[0]['num'];
				
			for($a=0; $a<$numc; $a++)
			{
				$userid2 = $tours2[$a]['userid'];
				
				?>
				<div style="padding:5px; background-color: #eee; border-radius: 5px; margin-bottom: 20px; font-weight: normal; float: left; font-size: 13px;">
				<br><b style="font-size: 15px;">Victoria Falls Tour</b><br>
				<img src="images/victoriafalls1.jpg" width="400" style="margin: 10px; float: left;">You have not been to Africa if you haven't had the ultimate Victoria Falls Experience. Packed with numerous activities, the Victoria Falls Tour brings to you a exhilarating  combo of unforgetable experiences. Book now and find out why the Victoria Falls is listed as one of the seven wonders of the world.

				<br><br><b>The Victoria Falls</b><br>While it is neither the highest nor the widest waterfall in the world, it is classified as the largest, based on its width of 1,708 metres (5,604 ft)[7] and height of 108 metres (354 ft),[8] resulting in the world's largest sheet of falling water. Victoria Falls is roughly twice the height of North America's Niagara Falls and well over twice the width of its Horseshoe Falls. In height and width Victoria Falls is rivalled only by Argentina and Brazil's Iguazu Falls. <a href="http://en.wikipedia.org/wiki/Victoria_Falls" target="_new"><span style="color:#00dd99;"><b>Read More About The Victoria Falls</b></span></a> <br><br><a href="https://www.google.com/maps/place/Victoria+Falls/@-17.924353,25.855894,15z/data=!4m2!3m1!1s0x0:0x8b054663df18d568" target="_new"><span style="color:#00dd99;"><b>View on Google Maps</b></span></a><br><br><a href="?ref=<?php echo $_REQUEST["ref"];?>&type=alendotour&id=victoriafalls"><img src="themes/<?php echo themeurl(); ?>/images/booknow.png" width="120" alt="Book Now"></a> <br><a href="?ref=tours/victoriafalls.php"><span style="color:#00dd99;"><b>Click Here To View Itenarary</b></span></a> 
				</div>
				<?php
			}
			?>
			
			
		</div>
		<?php
	
		}
		else
		{
			?>
			 <link href='http://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
							<link rel="stylesheet" href="resources/slider/demo/css/demostyles.css">
							<link rel="stylesheet" href="resources/slider/css/simple-slideshow-styles.css">
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
							min-width: 300px;
							width: 100%;
							margin-top: 3px;
							margin-bottom: 50px;
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
							float: left;
							padding: 1%;
							}
							
							//#imgshow2{
							//float: left;
							//padding: 5px;
							}
							
							#itparagraph{
							float: left;
							min-width: 300px;
							}
							
							#parspan{
							float: left;
							min-width: 300px;
							}
					</style>
							
							<div id="show1">
								<div style="float: left; width: 99%; font-size:20px; padding: 5px;">
								<?php echo myTours("TITLE",$tourPin);?>
								</div>
								<?php 
								
								$fimage = explode(",",myTours("MORE IMAGES",$tourPin));
								$fimageTitle = explode(",",myTours("MORE IMAGES TITLE",$tourPin));
								$fimageAlt = explode(",",myTours("MORE IMAGES ALT",$tourPin));
								$height = 0;
								
								$maxwidth = 600;
								$minheight = 400;
									
									$heightY2 = $maxwidth*imageSize("images/".myTours("COVER IMAGE",$tourPin),"HEIGHT")/imageSize("images/".myTours("COVER IMAGE",$tourPin),"WIDTH");
									
									if($heightY2>$height)
									{
										$height = $heightY2;
									}
									else
									{
										$height = $height;
									}
									
									
								for($d2=0; $d2<4; $d2++)
								{
									if(file_exists("images/".$fimage[$d2]))
									{
										$heightX = imageSize("images/".$fimage[$d2],"HEIGHT");
										$widthX = imageSize("images/".$fimage[$d2],"WIDTH"); 
										
										$heightY = $maxwidth*$heightX/$widthX;
										
										if($heightY>$height)
										{
											$height = $heightY;
										}
										else
										{
											$height = $height;
										}

									}
								}
								$height = $height+15;
								
								if($height>$minheight)
								{
									$minheight = $height;
								}
								else
								{
									$minheight = $minheight;
								}
								
								
									$heightX4 = imageSize("images/".myTours("COVER IMAGE",$tourPin),"HEIGHT");
									$widthX4 = imageSize("images/".myTours("COVER IMAGE",$tourPin),"WIDTH"); 
										
									$heightY4 = $maxwidth*$heightX4/$widthX4;
									
									
										if($heightY4==($height-15))
										{
											$topmargin4 = 5;
										}
										else
										{
											$topmargin4 = number_format((($height-$heightY4)/2),0);
										}
								?>
											   
									<div class="bss-slides num1" tabindex="1" autofocus="autofocus" style="float: left; height:<?php echo $height;?>px; width:<?php echo $maxwidth+10;?>px; min-height:<?php echo $minheight;?>px; background-color: #eee; margin:5px;">

											<figure>
												<?php echo "<img src='images/".myTours("COVER IMAGE",$tourPin)."' id='imgshow2' ".imgSname("images/".myTours("COVER IMAGE",$tourPin),$tourPin)."='".$maxwidth."' title='".myTours("COVER IMAGE TITLE",$tourPin)."' alt='".myTours("COVER IMAGE ALT",$tourPin)."' style='float:left; margin-top: ".$topmargin4."px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px;'>"?>
											</figure>
										<?php
										
									for($d=0; $d<4; $d++)
									{
										if(file_exists("images/".$fimage[$d]))	
										{
											$heightX3 = imageSize("images/".$fimage[$d],"HEIGHT");
											$widthX3 = imageSize("images/".$fimage[$d],"WIDTH"); 
											
										$heightY3 = $maxwidth*$heightX3/$widthX3;
										
										
											if($heightY3==($height-15))
											{
												$topmargin = 5;
											}
											else
											{
												$topmargin = number_format((($height-$heightY3)/2),0);
											}
											?>
												<figure>
													<?php echo "<img src='images/".$fimage[$d]."' id='imgshow2' ".imgSname("images/".$fimage[$d],$tourPin)."='".$maxwidth."' title='".$fimageTitle[$d]."' alt='".$fimageAlt[$d]."' style='float:left; margin-top: ".$topmargin."px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px;'>"?>
												</figure>
											<?php
										}											
									}
									?>
									</div> <!-- // bss-slides -->  
										
									<div style="float: right; width: 98%; max-width:400px; min-height: 200px; background-color: #fff; margin: 10px; border-radius: 0px; background-color: #E4FFB9;">
										<div style="float: left; width: 99%; font-size: 13px; font-weight: normal; color: #005500; padding: 5px; line-height: 20px;">
											<u><b><?php echo myTours("NIGHTS",$tourPin); ?> NIGHTS <?php echo myTours("DAYS",$tourPin); ?> DAYS TOUR PACKAGE</b></u><br>
											 <b>Rate:</b> <?php echo tourSetUp("CURRENCYSYMBOL")."".myTours("SHARING PRICE",$tourPin); ?> per person sharing & <?php echo tourSetUp("CURRENCYSYMBOL")."".myTours("SINGLE SUPPLEMENT PRICE",$tourPin); ?> per person single supplement<br><br>
											 <u><b>INCLUDED IN PACKAGE</b></u><br>
											 <?php 
												$mytours = myTours("ACTIVITIES",$tourPin);
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
														
														if($l==0)
														{
															
														}
														else
														{
															$toursX .= ", ";
														}
														
														$toursX .= $tourInLine[$l];
													}
												}
												
												
												
													echo $toursX;
												
											 ?><br><br>
											 <?php 
												if(!(myTours("EXCLUDED",$tourPin)==""))
												{
											 ?>
											 <u><b>EXCLUDED FROM PACKAGE</b></u><br>
											 <?php
												$mytours3 = myTours("EXCLUDED",$tourPin);
												$acmax = tourSetUp("EXCLUDED");
												
												
												$tourParagraphs3 = explode("\n", $mytours3);
												$numPara3 = count($tourParagraphs3);
												
												$toursX3 = "";
												$toursX23 = "";
												
												$nu3 = 0;
												
												for($p3=0; $p3<$numPara3; $p3++)
												{
													$tourInLine3 = explode(",",$tourParagraphs3[$p3]);
													$numtourInLine3 = count($tourInLine3);
													
													
													for($l3=0; $l3<$numtourInLine3; $l3++)
													{
														
														$nu3 = $nu3+1;
														
														if($l3==0)
														{
															
														}
														else
														{
															$toursX3 .= ", ";
														}
														
														$toursX3 .= $tourInLine3[$l];
													}
												}
												
												
												
													echo $toursX3;
												
											 ?>
											 <br><br>
											  
											 <?php 
												}
												
												
											 $mytours = myTours("EXTRAS",$tourPin);
											 $count = $mytours[0]['num'];
											 
											 if($count<=0)
											 {
												 
											 }
											 else
											 {
												 echo "<u><b>EXTRAS</b></u><br>";
												 
												 $countX = $count;
												 
												 
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
										<div align="center" style="position: relative;"><a href="?ref=<?php echo $_REQUEST["ref"];?>&unitx=<?php echo $tourPin;?>&action=Book Tour&title=<?php echo myTours("TITLE",$tourPin);?>&extn=1" title="BOOK NOW: <?php echo myTours("TITLE",$tourPin);?> "><img src="themes/<?php echo themeurl()?>/images/booknow.png" style="min-width: 80px; width: 120px; margin:5px; float: left;"></a></div>

									</div><br>
									<div style="float: left; width: 98%; background-color: #fff; margin: 1%; border-radius: 0px; background-color: #E4FFB9;">
										<div style="float: left; width: 99%; font-size: 13px; font-weight: normal; color: #005500; padding: 5px; line-height: 20px;">
											 <u><b>ABOUT DESTINATION</b></u><br>
												<?php echo myTours("ABOUT DESTINATION",$tourPin); ?>
											 </span>
											 <?php 
											 if(tourSetUp("SHOW ITENARARY")=="Yes")
											 {
												 ?>
												 <br>
												 <u><b>ITENARARY</b></u><br>
													<?php echo myTours("ITENARARY",$tourPin); ?>
												 </span>
												 <?php 
											 }
											 ?>
										</div>
										<div align="center" style="position: relative;"><a href="?ref=<?php echo $_REQUEST["ref"];?>&unitx=<?php echo $tourPin;?>&action=Book Tour&title=<?php echo myTours("TITLE",$tourPin);?>&extn=1" title="BOOK NOW: <?php echo myTours("TITLE",$tourPin);?>"><img src="themes/<?php echo themeurl()?>/images/booknow.png" style="min-width: 80px; width: 120px; margin:5px; float: left;"></a></div>
									</div>
								</div>
							<script src="resources/hammer/hammer.min.js"></script><!-- for swipe support on touch interfaces -->
							<script src="resources/slider/better-simple-slideshow.min.js"></script>
							<script>
							var opts = {
								auto : {
									speed : 3500, 
									pauseOnHover : true
								},
								fullScreen : false, 
								swipe : true
							};
							makeBSS('.num1', opts);

							var opts2 = {
								auto : false,
								fullScreen : true,
								swipe : true
							};
							makeBSS('.num2', opts2);
							</script>
							<?php 
		}
	}
//END YOUR CODE ABOVE THIS LINE
}
elseif($_REQUEST["function"]=='add')
{
//START YOUR CODE BELOW THIS LINE



//END YOUR CODE ABOVE THIS LINE
}
elseif($_REQUEST["function"]=='edit')
{
//START YOUR CODE BELOW THIS LINE



//END YOUR CODE ABOVE THIS LINE
}
elseif($_REQUEST["function"]=='list')
{
//START YOUR CODE BELOW THIS LINE



//END YOUR CODE ABOVE THIS LINE
}
elseif($_REQUEST["function"]=='delete')
{
//START YOUR CODE BELOW THIS LINE



//END YOUR CODE ABOVE THIS LINE
}
elseif($_REQUEST["function"]=='setup')
{
//START YOUR CODE BELOW THIS LINE

 echo setupCarBook();

//END YOUR CODE ABOVE THIS LINE
}


//END YOUR CODE ABOVE THIS LINE

}


?>