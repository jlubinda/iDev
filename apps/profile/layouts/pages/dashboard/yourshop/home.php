<?php
	if(chkSes()=="Active")
	{
		$user = userData();
		
		
		if(!checkUserHasShop($user["userID"])==1)
		{
				//('userID'=>$userID,'AccountType'=>$AccountType,'UserCode'=>$UserCode,'org'=>$org,'Branch'=>$Branch,'Email'=>$Email,'LoginName'=>$LoginName,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'Password'=>$_idxZx,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Active'=>$Active,'QuasAdmin'=>$QuasAdmin,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'level'=>$level,'Country'=>$userCountry,'productImage'=>$productImage,'sex'=>$sex,'DOB'=>$DOB,
				//'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
				
				?>
		<div class="banner">
				<div class="w3l_banner_nav_right">
		<!-- about -->
					<div class="agile_about_grids">
						<div class="col-md-6 agile_about_grid_right" style="max-width:250px;">
						
								<?php 
								
									$catsx = listClassifications();
									
									echo "<ul>";
									
									// check for empty result
									for($ax=0; $ax<$catsx[0]['num']; $ax++)
									{
										if($_REQUEST["class"]==$catsx[$ax]["name"])
										{
											$cssStyle = " font-weight: bold; color:#000;";
										}
										else
										{
											$cssStyle = "";
										}
										?>
										<li><a href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $catsx[$ax]["name"];?>&vCode=<?php echo $_REQUEST["vCode"];?>" style="  margin:5px; font-size:13px; <?php echo $cssStyle;?>"><?php echo $catsx[$ax]["name"];?></a>
											<ul style="margin-left:20px; margin-bottom:15px;">
											<?php 
										
												//if($_REQUEST["class"]==$catsx[$ax]["name"])
												//{
													$prods = listProductProgramme($catsx[$ax]["name"]);
													
													if($prods[0]['num']>=1)
													{ 
													// check for empty result
														for($ap=0; $ap<$prods[0]['num']; $ap++)
														{
															if($_REQUEST["Programme"]==$prods[$ap]["name"])
															{
																$cssStyle2 = " font-weight: bold; color:#000;";
															}
															else
															{
																$cssStyle2 = "";
															}
															?>
															<li><a href="?ref=<?php echo $_REQUEST["ref"];?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $catsx[$ax]["name"];?>&Programme=<?php echo $prods[$ap]["name"];?>&vCode=<?php echo $_REQUEST["vCode"];?>" style=" margin:5px; font-size:11px; <?php echo $cssStyle2;?>">YOUR <?php echo strtoupper($prods[$ap]["name"]);?></a></li>
															<?php
														}
													}
												//}
											?>
											</ul>
										</li>
										<?php
									}
									
									echo "</ul>";
									
								?>
						</div>
						<div class="col-md-6 agile_about_grid_left">

		<?php 	

		if($_REQUEST["product"]=="")
		{

			if($_REQUEST["Programme"]=="")
			{
				$limiter = "";
			}
			else
			{
				$limiter = "AND catID = (SELECT max(catID) FROM productcategories WHERE catName = '".$_REQUEST["Programme"]."')";
			}

			$cats = listProductProgramme($_REQUEST["class"],$limiter);
			// check for empty result
			for($a=0; $a<$cats[0]['num']; $a++)
			{
				$limiter = "";
				$_REQUEST["products".$a] = productDList($cats[$a]['id'],"Programme",$limiter);
				
				if($_REQUEST["products".$a][0]["num"]>=1)
				{	
					if(($cats[0]['num']-1)==$a)
					{
						$xx = 5;
					}
					else
					{
						$xx = 85;
					}
					
				?>
					<div class="container" style="margin-bottom:<?php echo $xx;?>px;">
					<?php 
					for(${"a".$e."_".$a}=0; ${"a".$e."_".$a}<$_REQUEST["products".$a][0]["num"]; ${"a".$e."_".$a}++)
					{
						$productsOnSell = getProductsOnSell($_REQUEST["products".$a][${"a".$e."_".$a}]["id"],"PRICE ASC");
						
						//if(!($productsOnSell)==0)
						//{
						?>
							<div class="col-md-3 top_brand_left" style="margin-bottom:5px; min-width:200px;">
								<a href="?ref=<?php echo $_REQUEST["ref"];?>&class=<?php echo $cats[$a]['class'];?>&Programme=<?php echo $cats[$a]['name'];?>&product=<?php echo $_REQUEST["products".$a][${"a".$e."_".$a}]["id"];?>">
								<div class="hover14 column">
									<div class="agile_top_brand_left_grid">
										<div class="agile_top_brand_left_grid1">
											<figure>
												<div class="snipcart-item block" >
													<div class="snipcart-thumb" style="min-height:100px;">
														<?php 
														$qtyx = checkProductInUserStore($_REQUEST["products".$a][${"a".$e."_".$a}]["id"],$user["userID"],"QUANTITY");
														
														if($qtyx>=1)
														{
															$unitIDx = checkProductInUserStore($_REQUEST["products".$a][${"a".$e."_".$a}]["id"],$user["userID"],"UNIT");
															
															echo "<p>You have ".$qtyx." ".getUnit($unitIDx)." of ".$_REQUEST["products".$a][${"a".$e."_".$a}]["name"]." @ K".checkProductInUserStore($_REQUEST["products".$a][${"a".$e."_".$a}]["id"],$user["userID"],"PRICE")." each in your shop.</p>";
															$funcx = "Update";
															$fx = "in";
														}
														else
														{
															echo "<p>No ".$_REQUEST["products".$a][${"a".$e."_".$a}]["name"]." in your shop</p>";
															$funcx = "Add";
															$fx = "to";
														}
														?>
															<p><strong><?php echo $funcx." ".$_REQUEST["products".$a][${"a".$e."_".$a}]["name"]." ".$fx." your shop.";?></strong></p>
															
													</div>
												</div>
											</figure>
										</div>
									</div>
								</div>
								</a>
							</div>
						<?php
						//}
					}
					?>
						<div class="clearfix"> </div>
						<div class="clearfix"> </div>
					</div>
			<?php 
				}
			}
		}
		else
		{

			if($_REQUEST["submitBtn"]=="" && !($_REQUEST["x2"]=="IMG" && $_REQUEST["cropBtn"]=="Crop Image"))
			{

				if($_REQUEST["Programme"]=="")
				{
					$limiter = "";
				}
				else
				{
					$limiter = "AND catID = (SELECT max(catID) FROM productcategories WHERE catName = '".$_REQUEST["Programme"]."')";
				}

				$cats = listProductProgramme($_REQUEST["class"],$limiter);
				// check for empty result
				for($a=0; $a<$cats[0]['num']; $a++)
				{
					?>
					<div class="container">
						<div class="agile_top_brands_grids">
							<div class="col-md-3 top_brand_left" style="margin-bottom:15px;">
								<div class="hover14 column">
									<div class="agile_top_brand_left_grid">
										<div class="agile_top_brand_left_grid1">
											<figure>
												<form action="" method="POST" enctype='multipart/form-data'>
													<div class="snipcart-item block" >
														<div class="snipcart-thumb">
															<strong><?php echo strtoupper(getProduct($_REQUEST["product"],"NAME"));?></strong>
															<p>Price K <input name="price" size="10" type="text"></p>
															<p>Quantity <input name="qty" size="10" type="text"></p>
															<p>Unit: 
																<select name="pUnit">
																<?php 
																	$units = unitsBList();
																	for($c=0; $c<$units[0]["num"]; $c++)
																	{
																		echo '<option value="'.$units[$c]["unitID"].'">'.$units[$c]["name"].'</option>';
																	}
																?>
																</select>
															</p>
															<p><input name="productImage" type="file" accept="image/jpeg,image/png"></p>
															<p>Transporter Mobile <input name="transporter" size="15" type="text"></p>
															<p><input name="submitBtn" value="SUBMIT" type="submit"></p>
														</div>
													</div>
												</form>
											</figure>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
							<div class="clearfix"> </div>
						</div>
					</div>
				<?php 
				}
			}
			else
			{
				?>
				<div class="container">
				<?php
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
<script type="text/javascript" src="js/cropsetup.js"></script>
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
  width: 250px;
  height: 170px;
  overflow: hidden;
}

</style>
<div id="wrapper">
  <div class="jc-demo-box">
    <header>
      <h1><span>Jcrop Live Avatar Demo</span></h1>
    </header>
<?php 

$name3 = resizeImage($name2, 600, 400,$name2);

echo '<img src="'.$name3.'" id="target" alt="[Jcrop Example]" />
  <div id="preview-pane">
	<div class="preview-container">
	  <img src="'.$name3.'" class="jcrop-preview" alt="Preview" />
	</div>
  </div>';
  ?><!-- @end #preview-pane -->
    
    <div id="form-container">
	<form id="cropimg" name="cropimg" action="<?php echo '?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&unit='.$_REQUEST["unit"].'&class='.$_REQUEST["class"].'&Programme='.$_REQUEST["Programme"].'&product='.$_REQUEST["product"].'&vCode='.$_REQUEST["vCode"].'&task=Enter_Data';?>" method="post" onsubmit="return checkCoords();">
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

						}
						else
						{
						echo "<p align='center'>Error! Your product picture could not be uploading. Please try again later.</p>";
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
					$targ_h = 400;
					$targ_w = 600;
					$jpeg_quality = 72;
					$x = $_POST['x'];
					$y = $_POST['y'];
					$w = $_POST['w'];
					$h = $_POST['h'];
					
					
					$ft = explode("images/",$src);
					$thumb = $ft[0]."images/thumb_".$ft[1];
					
					copy($src,$thumb);
					
					$targ_h_thumb = round(200/(3/2));
					$targ_w_thumb = round(300/(3/2));
						
					createCroppedImage($src,$targ_h,$targ_w,$jpeg_quality,$x,$y,$w,$h);

					createCroppedImage($thumb,$targ_h_thumb,$targ_w_thumb,$jpeg_quality,$x,$y,$w,$h);
					
					if($_REQUEST["x2"]=="IMG")
					{
						$user = userData();
						
						$image = $_REQUEST["imgname"].".".$_REQUEST["imgtype"];
						$array = addProductForSale($user["userID"],$_REQUEST["product"],$_REQUEST["price"],$_REQUEST["qty"],$_REQUEST["pUnit"],$transporter,$image);
						if($array["success"]==1)
						{
						echo "<img src='".$_REQUEST["imgsrc"]."' align='center'>";
						echo "<p align='center'>Success! Your product has been listed for sale.</p>";
						}
						else
						{
						echo "<p align='center'>Error! Your product could not be listed for sale. Please try again later.</p>";
						}
					}
					//exit;
				}
				?>
				</div>
				<?php
			}

						

		}

		?>	
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
		<!-- //about -->
				<div class="clearfix"></div>
		</div>

		<?php
		}
		else
		{
			
		}
	}
	else
	{
		include find_file("login.php");
	}
?>