<?php 

if(function_exists('homePageProvider'))
{
	
}
else
{
	function homePageProvider($type="",$value=""){

		include find_file("cnct.php");
		
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".uniqueCode()."','".$value."','".md5("HOME PAGE PROVIDER")."');";
			@@$res = mysqli_query($db,$ins);
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
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("HOME PAGE PROVIDER")."');";
			@@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			
			if($num>=1)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$userid = $rw["userid"];
				$data = $rw["data"];
				$meta_data = $rw["meta_data"];
				$dateset = $rw["dateset"];
				$syncstate = $rw["syncstate"];
				
				
				$pluginData = PluginDetails($data);
				$plugin_num = $pluginData['num'];
				$plugin_id = $pluginData['id'];
				$plugin_name = $pluginData['name'];
				$plugin_version = $pluginData['version'];
				$plugin_update = $pluginData['update'];
				$plugin_developer = $pluginData['developer'];
				$plugin_url = $pluginData['url'];
				$plugin_DOR = $pluginData['DOR'];
				$plugin_sidebar = $pluginData['sidebar'];
				$plugin_menu = $pluginData['menu'];
				$plugin_post = $pluginData['post'];
				$plugin_page = $pluginData['page'];
				$plugin_dashboard = $pluginData['dashboard'];
				$plugin_admin = $pluginData['admin'];
				$plugin_status = $pluginData['status'];
				
				
				if($plugin_status=="Yes")
				{
					
					$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@@$resX10 = mysqli_query($db,$selX10);
					@$rwX10 = mysqli_fetch_array(@$resX10);
					$page_feature = $rwX10["data"];
					
					
					if($page_feature=="Yes")
					{						
						if($type=="HOME PAGE" || $type=="")
						{
							return 	find_file("plugins/".$plugin_url."/homepage.php");
						}
						elseif($type=="PROVIDER URL")
						{
							return $plugin_url;
						}
						elseif($type=="PROVIDER ID")
						{
							return 	$data;
						}
						elseif($type=="PROVIDER NAME")
						{
							return $plugin_name;
						}
					}
					else
					{
						return "";
					}

				}
				else
				{
					return "";
				}
			}
			else
			{
				return "";
			}		
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('adminHome'))
{
	
}
else
{
	function adminHome($s_page=""){

		//include find_file("themes/".themeurl()."/sidebar.php");

		
		if($s_page=="")
		{
			
			if($_REQUEST["submitBtn"]=='')
			{
			$items = '';
			$value = '';
			$input = '';
			
				?>
				<div  style="min-width:280px; max-width: 500px; background-color:#548734; padding:5px; margin-top:5px; margin-right:auto; margin-left:auto; margin-bottom:50px; color:#5A8927;" align="center">
					<form action="" method="POST" enctype="multipart/form-data">
					<div style="margin:5px; position: relative; left:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#283E11;" align="right"><?php echo '<b>Website URL</b> ';?><?php echo '<input name="item" type="text" value="'.iDevSite().'" size="25">';?></div>
					<div style="margin:5px; position: relative; right:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#283E11;" align="right"><?php echo '<b>Dashboard Name</b> ';?><?php echo '<input name="item5" type="text" value="'.iDevSite("DASHBOARD NAME").'" size="25">';?></div>
					<div style="margin:5px; position: relative; left:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#283E11;" align="right"><?php echo '<b>Admin Contact Email</b> ';?><?php echo '<input name="siteemail" type="text" value="'.iDevSite("EMAIL ADDRESS").'" size="25">';?></div>
					<div style="margin:5px; position: relative; right:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#283E11;" align="right"><?php echo '<b>Page to open after login</b> ';?><?php echo '<input name="loginurl" type="text" value="'.iDevSite("LOGIN URL").'" size="25">';?></div>
					<div style="margin:5px; position: relative; left:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#283E11;" align="right"><?php echo '<b>Site Background</b> ';?><?php echo '<input name="sitebackground" type="text" value="'.iDevSite("BACKGROUND COLOR").'" size="25">';?></div>
					<div style="margin:5px; position: relative; right:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#283E11;" align="right"><?php echo '<b>Website Store Name</b> ';?><?php echo '<input name="store" type="text" value="'.iDevSite("STORE").'" size="25">';?></div>
					<div style="margin:5px; position: relative; left:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#283E11;" align="right"><?php echo '<b>Website Store Access</b> ';?> <?php echo '<label>USER MUST BE LOGGED IN: <input name="storeaccess" type="radio" value="LOGGED IN"></label>';?><br><?php echo '<label>OPEN ACCESS (NO NEED TO BE LOGGED IN): <input name="storeaccess" type="radio" value="OPEN ACCESS"></label>';?></div>
					<div style="margin:5px; position: relative; left:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#283E11;" align="right"><?php echo '<b>Website Dashboard Provider</b> ';?><?php
						$selFuncz = "SELECT * FROM meta WHERE meta_data = '".md5("PLUGIN-ID-CODE")."';";
						//echo $selFunc;
						@$resz = mysqli_query($db,$selFuncz);
						@$numz = mysqli_num_rows(@$resz);
						
						echo '<select name="dashboardprovider">';
						
						if(!($dashboardPlugin==""))
						{
							echo '<option value="'.$dashboardPlugin.'">'.$dashboardPluginFeature.'</option>';
						}
							
						for($az=0; $az<$numz; $az++)
						{
							@$rwz = mysqli_fetch_array(@$resz);
							$id = $rwz["id"];
							$userid = $rwz["userid"];
							$data = $rwz["data"];
							$meta_data = $rwz["meta_data"];
							$dateset = $rwz["dateset"];
							$syncstate = $rwz["syncstate"];
							
							$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
							
							//echo $selX."<br>";
							@$resX = mysqli_query($db,$selX);
							@$rwX = mysqli_fetch_array(@$resX);
							$activeID = $rwX["id"];
							$active = $rwX["data"];
							
							//echo $selX."<br>";
							
							if($active=="Yes")
							{
								
								$selX2 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-NAME")."' AND meta_data = '".$data."';";
								@$resX2 = mysqli_query($db,$selX2);
								$rwX2 = mysqli_fetch_array(@$resX2);
								$plugin_name = $rwX2["data"];
								
								$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
								@$resX10 = mysqli_query($db,$selX10);
								$rwX10 = mysqli_fetch_array(@$resX10);
								$page_feature = $rwX10["data"];
								
								
								if($page_feature=="Yes")
								{
									echo '<option value="'.$data.'">'.$plugin_name.'</option>';
								}
							}
						}
						
						echo '</select>';
						
					@mysqli_close($db);
					?></div>
					<div style="margin:5px; position: relative; right:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#283E11;" align="right"><?php echo '<b>Website Contact Email</b> ';?><?php echo '<input name="siteemail" type="text" value="'.iDevSite("EMAIL ADDRESS").'" size="25">';?></div>
					<div style="margin:5px; position: relative; right:0px; padding:5px; background-color:#93C86F; width:99%; min-width:280px; color:#000;"><input type="submit" name="submitBtn" value="Submit"></div>
					</form>
					</div>
				<?php
				
			}
			elseif($_REQUEST["submitBtn"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px; margin-bottom:50px; color:#000;">';

				if(iDevSite("URL","ADD",$_REQUEST["item"])=="1")
				{
					echo "Site URL updated.<br><br>";
				}
				else
				{
					echo "Error updating site URL.<br><br>";
				}
				
				
				if(iDevSite("STORE PLUGIN","ADD",$_REQUEST["storeprovider"])=="1")
				{
					echo "Store Plugin provider updated.<br><br>";
				}
				else
				{
					echo "Error updating Store Plugin Provider.<br><br>";
				}
				
				
				if(iDevSite("STORE ACCESS","ADD",$_REQUEST["storeaccess"])=="1")
				{
					echo "Store Access Parameters has been updated.<br><br>";
				}
				else
				{
					echo "Error updating Store Access Parameters.<br><br>";
				}
				
				
				if(iDevSite("DASHBOARD PLUGIN","ADD",$_REQUEST["dashboardprovider"])=="1")
				{
					echo "Dashboard Plugin provider updated.<br><br>";
				}
				else
				{
					echo "Error updating Dashboard Plugin Provider.<br><br>";
				}
				
				
				if(iDevSite("DASHBOARD NAME","ADD",$_REQUEST["item5"])=="1")
				{
					echo "Site dashboard name updated.<br><br>";
				}
				else
				{
					echo "Error updating dashboard name.<br><br>";
				}
				
				
				if(iDevSite("STORE","ADD",$_REQUEST["store"])=="1")
				{
					echo "Site Store name updated.<br><br>";
				}
				else
				{
					echo "Error updating Store name.<br><br>";
				}
				
				
				if(iDevSite("EMAIL ADDRESS","ADD",$_REQUEST["siteemail"])=="1")
				{
					echo "Site email updated.<br><br>";
				}
				else
				{
					echo "Error updating site email.<br><br>";
				}
				
				
				if(iDevSite("LOGIN URL","ADD",$_REQUEST["loginurl"])=="1")
				{
					echo "Page to open after login has been updated.<br><br>";
				}
				else
				{
					echo "Error updating the Page to open after login.<br><br>";
				}
				
				
				if(iDevSite("BACKGROUND COLOR","ADD",$_REQUEST["sitebackground"])=="1")
				{
					echo "Site background colour has been updated.<br><br>";
				}
				else
				{
					echo "Error updating the Site background colour.<br><br>";
				}
				
				
				echo '</div>';
			}
		}
		elseif($s_page=="ACCOUNT SETTINGS")
		{
			
			if($_REQUEST["submitBtn"]=='')
			{
			$items = '';
			$value = '';
			$input = '';

				?>
				<div  style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px; margin-bottom:50px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><b>Account Creation Message:</b> <textarea rows="3" cols="50" name="passwordmessage"><?php echo createAccount("PASSWORD EMAIL MESSAGE RETRIEVE"); ?></textarea></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><input type="submit" name="submitBtn" value="Submit"></div>
				</form>
				</div>
				<?php
			}
			elseif($_REQUEST["submitBtn"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px; margin-bottom:50px; color:#000;">';
				
				
				if(createAccount("PASSWORD EMAIL MESSAGE CREATE",$_REQUEST["passwordmessage"])=="1")
				{
					echo "Account Creation message updated.<br><br>";
				}
				else
				{
					echo "Error updating Account Creation message.<br><br>";
				}
				echo '</div>';
			}
		}
		elseif($s_page=="HOME PAGE")
		{
			
			if($_REQUEST["submitBtn"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">';
				
				
				if(homePageProvider("ADD",$_REQUEST["homepage_plugin"])=="1")
				{
					echo "Home Page Provider has been set.<br><br>";
				}
				else
				{
					echo "Error setting Home Page Provider.<br><br>";
				}
				echo '</div>';
			}
					echo "<br><br><b>CURRENT HOME PAGE PROVIDER:</b> ".homePageProvider()."<br><br>";
					
			if($_REQUEST["submitBtn"]=='')
			{
			$items = '';
			$value = '';
			$input = '';
			include find_file("cnct.php");
				?>
				<div  style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><b>HOME PAGE PROVIDER</b><br>
				<?php 

					
					include find_file("cnct.php");
					
					$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("PLUGIN-ID-CODE")."';";
					//echo $selFunc;
					@$res = mysqli_query($db,$selFunc);
					@$num = mysqli_num_rows(@$res);
					
					echo '<select name="homepage_plugin">';
						echo '<option value="THEME">THEME</option>';
						
					for($a=0; $a<$num; $a++)
					{
						@$rw = mysqli_fetch_array(@$res);
						$id = $rw["id"];
						$userid = $rw["userid"];
						$data = $rw["data"];
						$meta_data = $rw["meta_data"];
						$dateset = $rw["dateset"];
						$syncstate = $rw["syncstate"];
						
						$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
						
						//echo $selX."<br>";
						@$resX = mysqli_query($db,$selX);
						@$rwX = mysqli_fetch_array(@$resX);
						$activeID = $rwX["id"];
						$active = $rwX["data"];
						
						//echo $selX."<br>";
						
						if($active=="Yes")
						{
							
							$selX2 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-NAME")."' AND meta_data = '".$data."';";
							@$resX2 = mysqli_query($db,$selX2);
							$rwX2 = mysqli_fetch_array(@$resX2);
							$plugin_name = $rwX2["data"];
							
							$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
							@$resX10 = mysqli_query($db,$selX10);
							$rwX10 = mysqli_fetch_array(@$resX10);
							$page_feature = $rwX10["data"];
							
							
							if($page_feature=="Yes")
							{
								echo '<option value="'.$data.'">'.$plugin_name.'</option>';
							}
						}
					}
					
					echo '</select>';
				?>
				</div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><input type="submit" name="submitBtn" value="Submit"></div>
				</form>
				</div>
				<?php
				mysqli_close($db);
			}
			
		}
		elseif($s_page=="SLIDER")
		{
			if(!(isset($_REQUEST["func"]) && isset($_REQUEST["idx"])))
			{		
				if(sliderStatus()==1)
				{
					$checknoindex = '';
					$checkindex = 'checked="true"';
				}
				else
				{
					$checknoindex = 'checked="true"';
					$checkindex = '';
				}

				?>
				<div  style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:5px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>Enable home page slider? <br>NO:</b> <input name="status" type="radio" value="0" '.$checknoindex.'> &nbsp;&nbsp;&nbsp;</label><br><label><b>YES:</b> <input name="status" type="radio" value="1" '.$checkindex.'></label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><input type="submit" name="submitBtn2" value="Submit"></div>
				</form>
				</div>
				<?php
				
			
			if($_REQUEST["submitBtn2"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px; margin-bottom:50px; color:#000;">';
				
				if(sliderStatus("ADD",$_REQUEST["status"])=="1")
				{
					echo "Account Creation message updated.<br><br>";
				}
				else
				{
					echo "Error updating Account Creation message.<br><br>";
				}
				echo '</div>';
			}
		}	
		
			if(sliderStatus()==1)
			{
				updateSliderImageDetails();
			}
		}
		elseif($s_page=="SEARCH ENGINES")
		{
			if($_REQUEST["submitBtn"]=='')
			{
			$items = '';
			$value = '';
			$input = '';
				
				
				if(iDevSite("ROBOTS","INDEX")=="NOT-INDEX")
				{
					$checknoindex = 'checked="true"';
					$checkindex = '';
				}
				else
				{
					$checknoindex = '';
					$checkindex = 'checked="true"';
				}
				
				
				if(iDevSite("ROBOTS","INDEX")=="NOT-FOLLOW")
				{
					$checknofollow = 'checked="true"';
					$checkfollow = '';
				}
				else
				{
					$checknofollow = '';
					$checkfollow = 'checked="true"';
				}

				?>
				<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>Should Search Engines Index Your Website? <br>NO:</b> <input name="index" type="radio" value="NOT-INDEX" '.$checknoindex.'> &nbsp;&nbsp;&nbsp;</label><br><label><b>YES:</b> <input name="index" type="radio" value="INDEX" '.$checkindex.'></label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>Should Search Engines Follow Your Website? <br>NO:</b> <input name="follow" type="radio" value="NOT-FOLLOW" '.$checknofollow.'> &nbsp;&nbsp;&nbsp;</label><br><label><b>YES:</b> <input name="follow" type="radio" value="FOLLOW" '.$checkfollow.'></label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><input type="submit" name="submitBtn" value="Submit"></div>
				</form>
				</div>
				<?php
			}
			elseif($_REQUEST["submitBtn"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">';
				
				if(iDevSite("ROBOTS","ADD",$_REQUEST["index"]."|".$_REQUEST["follow"])=="1")
				{
					echo "Site robots updated.<br><br>";
				}
				else
				{
					echo "Error updating site robots.<br><br>";
				}
				echo '</div>';
			}
		}
		elseif($s_page=="SITE DETAILS")
		{
			if($_REQUEST["submitBtn"]=='')
			{
			$items = '';
			$value = '';
			$input = '';
				
				if(iDevSite("ACCESS")=="https")
				{
					$checkhttp = '';
					$checkhttps = 'checked="true"';
				}
				else
				{
					$checkhttp = 'checked="true"';
					$checkhttps = '';
				}
				
				
				if(iDevSite("ROBOTS","INDEX")=="NOT-INDEX")
				{
					$checknoindex = 'checked="true"';
					$checkindex = '';
				}
				else
				{
					$checknoindex = '';
					$checkindex = 'checked="true"';
				}
				
				
				if(iDevSite("ROBOTS","INDEX")=="NOT-FOLLOW")
				{
					$checknofollow = 'checked="true"';
					$checkfollow = '';
				}
				else
				{
					$checknofollow = '';
					$checkfollow = 'checked="true"';
				}

				?>
				<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<b>Website Title</b> ';?><?php echo '<input name="item2" type="text" value="'.iDevSite("TITLE").'" size="25">';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<b>Website Tag-line</b> ';?><?php echo '<input name="item4" type="text" value="'.iDevSite("TAGLINE").'" size="25">';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<b>Website Falcon Image</b> ';?><?php echo '<input name="item3" type="file" size="25">';  
				if(iDevSite("FALCON")=="")
				{
					
				}
				else
				{
					echo '<img src="images/'.iDevSite("FALCON").'" width="60">';
				}
				?> </div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><b>Site Description:</b> <textarea rows="3" cols="50" name="description"><?php echo iDevSite("DESCRIPTION"); ?></textarea></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><input type="submit" name="submitBtn" value="Submit"></div>
				</form>
				</div>
				<?php
			}
			elseif($_REQUEST["submitBtn"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">';
				
				
				if(iDevSite("TITLE","ADD",$_REQUEST["item2"])=="1")
				{
					echo "Site title updated.<br><br>";
				}
				else
				{
					echo "Error updating site title.<br><br>";
				}
		
				
				if(iDevSite("TAGLINE","ADD",$_REQUEST["item4"])=="1")
				{
					echo "Site tag-line updated.<br><br>";
				}
				else
				{
					echo "Error updating site tag-line.<br><br>";
				}
				
				
				
				$sel2x = "images/";
				$target = $sel2x;
				$target = $target . basename( $_FILES['item3']['name']) ;
				
				// A list of permitted file extensions
				$allowed = array('jpeg', 'jpg', 'png', 'gif');
				
				$extension = pathinfo($_FILES['item3']['name'], PATHINFO_EXTENSION);

				if(!in_array(strtolower($extension), $allowed))
				{
					echo 'Unsupported file format.';
				}
				else
				{
					
					if(move_uploaded_file($_FILES['item3']['tmp_name'], $target))
					{

					@$yearx = date(Y);
					@$dayx = date(z);
					@$hourx = date(G);
					@$hour2x = date(h);
					@$minsx = date(i);
					@$secx = date(s);

					$sess_idx = rand(0, 999999999999999999999999);
					$timexx = ($yearx*365*24*60*60)+($dayx*24*60*60)+($hourx*60*60)+($minsx*60)+$secx;
					$cccx = md5($timexx." |B".(rand(0, 9999999999999998))."A| ".$sess_idx." |B| ".$userID." |C".(rand(9999999999999999, 999999999999999999999999))."B| ".$_SESSION['procurement_uid']." |D| ");

					$name1 = $sel2x."/".basename( $_FILES['item3']['name']);
					
					$ext = strtolower($extension);
					
					$newname = $cccx.".".$ext;
					
					$name2 = $sel2x."/".$newname;

					$renameX = rename($name1,$name2);
					
					
						if(iDevSite("FALCON","ADD",$newname)=="1")
						{
							echo "Site falcon updated.<br><br>";
						}
						else
						{
							echo "Error updating site falcon.<br><br>";
						}
						
					}

				}
				
				
				if(iDevSite("DESCRIPTION","ADD",$_REQUEST["description"])=="1")
				{
					echo "Site description updated.<br><br>";
				}
				else
				{
					echo "Error updating site description.<br><br>";
				}
				echo '</div>';
			}
		}
		elseif($s_page=="SECURITY")
		{
			if($_REQUEST["submitBtn"]=='')
			{
			$items = '';
			$value = '';
			$input = '';
				
				if(iDevSite("ACCESS")=="https")
				{
					$checkhttp = '';
					$checkhttps = 'selected="selected"';
				}
				else
				{
					$checkhttp = 'selected="selected"';
					$checkhttps = '';
				}
				

				?>
				<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>CURRENT SITE ACCESS TYPE:'.iDevSite("ACCESS").'</b><br>NEW SETTING: <select name="access"><option value="http" '.$checkhttp.'>HTTP</option><option value="https" '.$checkhttps.'>HTTPS</option></select>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><input type="submit" name="submitBtn" value="Submit"></div>
				</form>
				</div>
				<?php
			}
			elseif($_REQUEST["submitBtn"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">';
				if(iDevSite("ACCESS","ADD",$_REQUEST["access"])=="1")
				{
					echo "Site Access updated.<br><br>";
				}
				else
				{
					echo "Error updating site access.<br><br>";
				}
				echo '</div>';
			}
		}
		elseif($s_page=="SMS SETTINGS")
		{
			if($_REQUEST["submitBtn"]=='')
			{
			$items = '';
			$value = '';
			$input = '';
				
				if(iDevSite("ACCESS")=="https")
				{
					$checkhttp = '';
					$checkhttps = 'checked="true"';
				}
				else
				{
					$checkhttp = 'checked="true"';
					$checkhttps = '';
				}
				

				?>
				<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>SMS SERVICE USERNAME:</b> <input name="sms_username" type="text" value="'.BULK_SMS_USERNAME().'" size="30"> &nbsp;&nbsp;&nbsp;</label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>SMS SERVICE PASSWORD:</b> <input name="sms_password" type="password" size="30" > &nbsp;&nbsp;&nbsp;</label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><input type="submit" name="submitBtn" value="Submit"></div>
				</form>
				</div>
				<?php
			}
			elseif($_REQUEST["submitBtn"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">';
				if(BULK_SMS_USERNAME("ADD",$_REQUEST["sms_username"])=="1" && BULK_SMS_PASSWORD("ADD",$_REQUEST["sms_password"])=="1")
				{
					echo "SMS Settings Updated.<br><br>";
				}
				else
				{
					echo "Error updating SMS Settings.<br><br>";
				}
				echo '</div>';
			}
		}
		elseif($s_page=="MOBILE NETWORKS")
		{
			if($_REQUEST["submitBtn"]=='')
			{
			$items = '';
			$value = '';
			$input = '';
				
				if(iDevSite("ACCESS")=="https")
				{
					$checkhttp = '';
					$checkhttps = 'checked="true"';
				}
				else
				{
					$checkhttp = 'checked="true"';
					$checkhttps = '';
				}
				

				?>
				<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>NETWORK NAME:</b> <input name="net_name" type="text" placeholder="eg MTN,Airtel, Zamtel" size="30"> &nbsp;&nbsp;&nbsp;</label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>NETWORK PREFIX:</b> <input name="prefix" type="text" placeholder="eg 26097, 26096, 26095" size="30" > &nbsp;&nbsp;&nbsp;</label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>RESPONSE LINE FOR NETWORK:</b> <input name="res_line" type="text" size="30" > &nbsp;&nbsp;&nbsp;</label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><input type="submit" name="submitBtn" value="Submit"></div>
				</form>
				</div>
				<?php
			}
			elseif($_REQUEST["submitBtn"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">';
				if(MOBILE_NETWORKS("ADD",$_REQUEST["net_name"],$_REQUEST["prefix"],$_REQUEST["res_line"])=="1")
				{
					echo "SMS Settings Updated.<br><br>";
				}
				else
				{
					echo "Error updating SMS Settings.<br><br>";
				}
				echo '</div>';
			}			
			
			?>
			<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">
			<?php 
			$cats = MOBILE_NETWORKS();
			for($a=0; $a<$cats[0]["num"]; $a++)
			{
			?>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;">
					<div style="margin:5px;  padding:5px; background-color:#93C86F;"><strong>NAME:</strong> <?php echo $cats[$a]["name"];?></div>
					<div style="margin:5px;  padding:5px; background-color:#93C86F;"><strong>PREFIX:</strong> <?php echo $cats[$a]["prefix"];?></div>
					<div style="margin:5px;  padding:5px; background-color:#93C86F;"><strong>RESPONSE NUMBER:</strong> <?php echo $cats[$a]["resnumb"];?></div>
				</div>
			<?php 
			}
			?>
			</div>
			<?php
		}
		elseif($s_page=="GOOGLE API KEYS")
		{
			if($_REQUEST["submitBtn"]=='')
			{
			$items = '';
			$value = '';
			$input = '';
				
				if(iDevSite("ACCESS")=="https")
				{
					$checkhttp = '';
					$checkhttps = 'checked="true"';
				}
				else
				{
					$checkhttp = 'checked="true"';
					$checkhttps = '';
				}
				

				?>
				<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>BROWSER KEY:</b> <input name="browserkey" type="text" placeholder="PROVIDED BY GOOGLE" size="30"> &nbsp;&nbsp;&nbsp;</label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><?php echo '<label><b>SERVER KEY:</b> <input name="serverkey" type="text" placeholder="PROVIDED BY GOOGLE" size="30" > &nbsp;&nbsp;&nbsp;</label>';?></div>
				<div style="margin:5px;  padding:5px; background-color:#93C86F;"><input type="submit" name="submitBtn" value="Submit"></div>
				</form>
				</div>
				<?php
			}
			elseif($_REQUEST["submitBtn"]=='Submit')
			{
				echo '<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">';
				if(GoogleAPIKeys("ADD",$_REQUEST["browserkey"],$_REQUEST["serverkey"])=="1")
				{
					echo "Google API Keys Updated.<br><br>";
				}
				else
				{
					echo "Error updating Google API Keys .<br><br>";
				}
				echo '</div>';
			}			
			
			?>
			<div style=" min-width:280px; max-width: 800px; background-color:#548734; padding:5px; margin-left:auto; margin-right:auto; margin-top:5px;  margin-bottom:50px; color:#000;">
				<div style="margin:5px;  padding:5px; background-color:#93C86F;">
					<div style="margin:5px;  padding:5px; background-color:#93C86F;"><strong>BROWSER KEY:</strong> <?php echo GoogleAPIKeys("BROWSER KEY");?></div>
					<div style="margin:5px;  padding:5px; background-color:#93C86F;"><strong>SERVER KEY:</strong> <?php echo GoogleAPIKeys("SERVER KEY");?></div>
				</div>
			</div>
			<?php
		}
		
	?>
		</div>
	<?php
	}
}


if(function_exists('componentReg'))
{
	
}
else
{
	function componentReg(){
		if(chkSes()=="Active")
		{
			$userData = userData();
			$priv = priv($userData["level"]);

			if(checkPerm('settings|h1|add|',$userData["level"],'View')=="Yes" || (trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED"))
			{
			$PageIDx = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
									
						
				//echo "<span class='xxd'><b>".$FirstName." ".$LastName."</b></span> &nbsp;&nbsp;&nbsp;&nbsp;";
				include find_file("cnct.php");
				$select_sys_comp = "SELECT * FROM sys_pages WHERE PageID = '".$PageIDx."';";
				@@$res_sys_pages = mysqli_query($db,$select_sys_comp);
				@$num_sys_pages = mysqli_num_rows(@$res_sys_pages);
				
				//echo "Number of Page Details: ".$num_sys_pages."<br>";
				
				for($f=0;$f<$num_sys_pages; $f++)
				{
				$row_f = mysqli_fetch_array(@$res_sys_pages);
				$page_ID = "Page ID: ".$row_f["PageID"]."<br>";
				$page_name = $row_f["name"]." ";
				$page_description = "Page Description: ".$row_f["description"]."<br>";
				
				//echo "Current Page: ".$page_name."";
				}


				
				if($num_sys_pages>="1")
				{
				$registerdX = "2";
				}
				else
				{
					$registerdX = "1";
					echo "<div style='width:100%; height:20px; margin-left: 20px; margin-top: 10px; margin-bottom: 3px;'><a href='?ref=settings&segment=h1&function=add&regid=".$PageIDx."'>Click here to register this component.</a></div>";
				}
				
				mysqli_close($db);
			}
		}
	}
}
?>