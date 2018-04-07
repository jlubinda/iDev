<?php 



if(function_exists("PluginFunctions"))
{
	
}
else
{
	function PluginFunctions(){
		
		include find_file("cnct.php");
		
		$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("PLUGIN-ID-CODE")."';";
		//ECHO $selFunc;
		@$res = mysqli_query($db,$selFunc);
		@$num = mysqli_num_rows($res);
		for($a=0; $a<$num; $a++){
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$meta_data = $rw["meta_data"];
			$dateset = $rw["dateset"];
			$syncstate = $rw["syncstate"];
			
			$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
			//ECHO $selX;
			@$resX = mysqli_query($db,$selX);
			@$rwX = mysqli_fetch_array($resX);
			$active = $rwX["data"];
			
			if($active=="Yes")
			{
				$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$data."';";
				@$resX1 = mysqli_query($db,$selX1);
				@$rwX1 = mysqli_fetch_array($resX1);	
				$plugin_url = $rwX1["data"];
				
				include find_file("plugins/".$plugin_url."/function.php");
			}
		}
		
		//echo "test: fsdfsdf: ".$dbhost."<br>";
		
		mysqli_close($db);	
	}
}




if(function_exists("installPlugin"))
{
	
}
else
{
	function installPlugin($plugin_code,$plugin_name,$plugin_url,$plugin_developer,$plugin_active_status,$plugin_date_of_release,$plugin_version,$plugin_update_url,$plugin_sidebar,$plugin_menu,$plugin_post,$plugin_page,$plugin_dashboard,$plugin_admin){
		
		include find_file("cnct.php");

		$ins_PCode = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-TYPE-CODE")."','".$plugin_code."','".md5("PLUGIN-ID-CODE")."');";
		@$res_PCode = mysqli_query($db,$ins_PCode);
		//echo $ins_PCode;

		$ins_name = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-NAME")."','".$plugin_name."','".$plugin_code."')";
		@$res_name = mysqli_query($db,$ins_name);

		$ins_url = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-URL")."','".$plugin_url."','".$plugin_code."')";
		@$res_url = mysqli_query($db,$ins_url);

		$ins_developer = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-DEVELOPER")."','".$plugin_developer."','".$plugin_code."')";
		@$res_developer = mysqli_query($db,$ins_developer);

		$ins_active_status = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-ACTIVE-STATUS")."','".$plugin_active_status."','".$plugin_code."')";
		@$res_active_status = mysqli_query($db,$ins_active_status);

		$ins_date_of_release = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-DATE-OF-RELEASE")."','".$plugin_date_of_release."','".$plugin_code."')";
		@$res_date_of_release = mysqli_query($db,$ins_date_of_release);

		$ins_version = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-VERSION")."','".$plugin_version."','".$plugin_code."')";
		@$res_version = mysqli_query($db,$ins_version);

		$ins_update_url = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-UPDATE-URL")."','".$plugin_update_url."','".$plugin_code."')";
		@$res_update_url = mysqli_query($db,$ins_update_url);
		
		if($plugin_sidebar=="Yes")
		{
		$ins_sidebar_data = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-SIDEBAR")."','".$plugin_sidebar."','".$plugin_code."')";
		@$res_sidebar_data = mysqli_query($db,$ins_sidebar_data);
		}

		if($plugin_sidebar=="Yes")
		{
		$ins_menu_data = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-MENU")."','".$plugin_menu."','".$plugin_code."')";
		@$res_menu_data = mysqli_query($db,$ins_menu_data);
		}

		if($plugin_post=="Yes")
		{
		$ins_post_data = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-POST-FEATURE")."','".$plugin_post."','".$plugin_code."')";
		@$res_post_data = mysqli_query($db,$ins_post_data);
		}

		if($plugin_page=="Yes")
		{
		$ins_page_data = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-PAGE-FEATURE")."','".$plugin_page."','".$plugin_code."')";
		@$res_page_data = mysqli_query($db,$ins_page_data);
		}

		if($plugin_dashboard=="Yes")
		{
		$ins_dashboard_data = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-DASHBOARD-FEATURE")."','".$plugin_dashboard."','".$plugin_code."')";
		@$res_dashboard_data = mysqli_query($db,$ins_dashboard_data);
		}

		if($plugin_admin=="Yes")
		{
		$ins_admin_data = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("PLUGIN-ADMIN-FEATURE")."','".$plugin_admin."','".$plugin_code."')";
		@$res_admin_data = mysqli_query($db,$ins_admin_data);
		}
		
		mysqli_close($db);
	}
}



if(function_exists("uploadPlugin"))
{
	
}
else
{
	function uploadPlugin(){
		
		include find_file("cnct.php");
		include_once find_file("mis/priv.php");

			if($_REQUEST["type"]=="folder")
			{
			$typedis = "folder ";
			$namedis = $_REQUEST["unitclass"];
			$namedis2 = $_REQUEST["newName"];
			}
			else
			{
			$typedis = $_REQUEST["type"]." file ";
			$namedis = $_REQUEST["unitclass"].".".$_REQUEST["type"];
			$namedis2 = $_REQUEST["newName"].".".$_REQUEST["type"];
			}
			?>
			<form action="" method="POST" enctype="multipart/form-data">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center"><input type="file" name="newName" id="file"> &nbsp;&nbsp;<input name="submitBtn" type="submit" value="Upload"></td>
				</tr>
			</table>
			</form>
			<?php
			
		if($_REQUEST["submitBtn"]=="Upload")
		{
		@$year = date(Y);
		@$day = date(z);
		@$hour = date(G);
		@$hour2 = date(h);
		@$mins = date(i);
		@$sec = date(s);

			$sess_id = rand(0, 999999999999999999999);
			$timex = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60)+($mins*60)+$sec;
			$plugin_url = md5($timex." |L| ".$sess_id." |M| ".$userID." |N| ".SesVar());		
			
			$dirx = "plugins";
			$plugin_install_folder = $dirx."/".$plugin_url;
			

			if(mkdir($plugin_install_folder))
			{	
			$sel2x = "plugins/";		
			$target = $sel2x; 
			$target = $target . basename( $_FILES['newName']['name']) ;		

				if(move_uploaded_file($_FILES['newName']['tmp_name'], $target)) 
				{	
				$typeZipxx = explode(".",$_FILES['newName']['name']);
				$typeZip = strtolower($typeZipxx[1]);	
				
							
					if($typeZip=="zip")
					{
						$zip = new ZipArchive;
						
						if($zip->open($target) === TRUE) 
						{
							$zip->extractTo($plugin_install_folder);
							$zip->close();
							include find_file($plugin_install_folder."/install.php");
												
							@$yearV = date(Y);
							@$dayV = date(z);
							@$hourV = date(G);
							@$hour2V = date(h);
							@$minsV = date(i);
							@$secV = date(s);

								$sess_idV = rand(0, 999999999999999999999);
								$timexV = ($yearV*365*24*60*60)+($dayV*24*60*60)+($hourV*60*60)+($minsV*60)+$secV;
								$plugin_code = md5($timexV." || ".$sess_idV." || ".$userID." || ".SesVar());
												
							installPlugin($plugin_code,$plugin_name,$plugin_url,$plugin_developer,$plugin_active_status,$plugin_date_of_release,$plugin_version,$plugin_update_url,$plugin_sidebar,$plugin_menu,$plugin_post,$plugin_page,$plugin_dashboard,$plugin_admin);
							
						}
						else 
						{
							echo '<p align="center">Error extracting the plug-in!</p>';
						}
					}
					else
					{
					echo "<p align='center'>Error! Your upload is not a Zip archive.</p>";
					}			
				}
				else 
				{
				echo "Sorry, there was a problem uploading your plug-in.";
				@$rename = "";
				}			
			}
			else
			{
				echo "Error installing plug-in.";
			}
		}
	}
}



if(function_exists("installMyPlugin"))
{
	
}
else
{
	function installMyPlugin($userid,$PluginID){
		
		include find_file("cnct.php");
		include_once find_file("mis/priv.php");
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($userid)."','".$PluginID."','".md5("INSTALLED APP")."');";
		@$res = mysqli_query($db,$ins);
		
		//echo $ins."<br>";
		
		if($res)
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



if(function_exists("uninstallMyPlugin"))
{
	
}
else
{
	function uninstallMyPlugin($userid,$PluginID){
		
		include find_file("cnct.php");
		include_once find_file("mis/priv.php");
		
		$ins = "DELETE FROM meta WHERE userid = '".md5($userid)."' AND meta_data = '".md5("INSTALLED APP")."' AND data = '".$PluginID."';";
		@$res = mysqli_query($db,$ins);
		
		//echo $ins."<br>";
		
		if($res)
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


if(function_exists("PluginFeatures"))
{
	
}
else
{
	function PluginFeatures($a,$b=""){
		
		include find_file("cnct.php");
		include_once find_file("mis/priv.php");
		if($b=="")
		{
			$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("PLUGIN-ID-CODE")."';";
			//echo $selFunc;
			@$res = mysqli_query($db,$selFunc);
			@$num = mysqli_num_rows($res);
			for($ax=0; $ax<$num; $ax++)
			{
				@$rw = mysqli_fetch_array($res);
				$id = $rw["id"];
				$userid = $rw["userid"];
				$data = $rw["data"];
				$meta_data = $rw["meta_data"];
				$dateset = $rw["dateset"];
				$syncstate = $rw["syncstate"];
				$plugin_id_code = $data;
				
				$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
				//echo $selX;
				@$resX = mysqli_query($db,$selX);
				@$rwX = mysqli_fetch_array($resX);
				$active = $rwX["data"];
				
				if($active=="Yes")
				{
					$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$data."';";
					@$resX1 = mysqli_query($db,$selX1);
					@$rwX1 = mysqli_fetch_array($resX1);	
					$plugin_url = $rwX1["data"];
					
					$selX2 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-NAME")."' AND meta_data = '".$data."';";
					@$resX2 = mysqli_query($db,$selX2);
					@$rwX2 = mysqli_fetch_array($resX2);
					$plugin_name = $rwX2["data"];
					
					$selX3 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DEVELOPER")."' AND meta_data = '".$data."';";
					@$resX3 = mysqli_query($db,$selX3);
					@$rwX3 = mysqli_fetch_array($resX3);
					$plugin_developer = $rwX3["data"];
					
					$selX4 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DATE-OF-RELEASE")."' AND meta_data = '".$data."';";
					@$resX4 = mysqli_query($db,$selX4);
					@$rwX4 = mysqli_fetch_array($resX4);
					$plugin_date_of_release = $rwX4["data"];
					
					$selX5 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-VERSION")."' AND meta_data = '".$data."';";
					@$resX5 = mysqli_query($db,$selX5);
					@$rwX5 = mysqli_fetch_array($resX5);
					$plugin_version = $rwX5["data"];
					
					$selX6 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-UPDATE-URL")."' AND meta_data = '".$data."';";
					@$resX6 = mysqli_query($db,$selX6);
					@$rwX6 = mysqli_fetch_array($resX6);
					$update_url = $rwX6["data"];
					
					$selX7 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-SIDEBAR")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX7 = mysqli_query($db,$selX7);
					@$rwX7 = mysqli_fetch_array($resX7);
					$sidebar_feature = $rwX7["data"];
				
					$selX8 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-MENU")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX8 = mysqli_query($db,$selX8);
					@$rwX8 = mysqli_fetch_array($resX8);
					$menu_feature = $rwX8["data"];
								
					$selX9 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-POST-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX9 = mysqli_query($db,$selX9);
					@$rwX9 = mysqli_fetch_array($resX9);
					$post_feature = $rwX9["data"];
					
					$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX10 = mysqli_query($db,$selX10);
					@$rwX10 = mysqli_fetch_array($resX10);
					$page_feature = $rwX10["data"];
					
					$selX11 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DASHBOARD-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX11 = mysqli_query($db,$selX11);
					@$rwX11 = mysqli_fetch_array($resX11);
					$dashboard_feature = $rwX11["data"];
					
					$selX12 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ADMIN-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX12 = mysqli_query($db,$selX12);
					@$rwX12 = mysqli_fetch_array($resX12);
					$admin_feature = $rwX12["data"];
					
					$udata = userData();
					
					$selX13 = "SELECT count(DISTINCT data) AS countApps FROM meta WHERE userid = '".md5($udata['userID'])."' AND meta_data = '".md5("INSTALLED APP")."' AND data = '".$data."';";
					@$resX13 = mysqli_query($db,$selX13);
					@$rwX13 = mysqli_fetch_array($resX13);
					$countApps = $rwX13["countApps"];
					
					$selX14 = "SELECT * FROM meta WHERE userid = '".md5($udata['userID'])."' AND meta_data = '".md5("INSTALLED APP")."' AND data = '".$data."';";
					@$resX14 = mysqli_query($db,$selX14);
					@$rwX14 = mysqli_fetch_array($resX14);
					$installed_app = $rwX14["data"];
					
					
					$GLOBALS['plugin_signature'] = $data;
					
						
					if($a=="SIDEBAR" && $sidebar_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/sidebar.php");
					}
					
					if($a=="MENU" && $menu_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/menu.php");
					}
					
					if($a=="POST" && $post_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/post.php");
					}
					
					
					if($a=="DASHBOARD MENU" && $dashboard_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/dashboardnav.php");
					}
					
					
					if($a=="APP FOLDER" && $dashboard_feature=="Yes")
					{
						return $plugin_url;
					}
					
					
					if($a=="ABOUT APP" && $dashboard_feature=="Yes")
					{
						if(file_exists("plugins/".$plugin_url."/about.php"))
						{
							include_once find_file("plugins/".$plugin_url."/about.php");
						}
						else
						{
							$about_plugin = "";
						}
						
						return $about_plugin;
					}
					
					
					if($a=="DASHBOARD ICON" && $dashboard_feature=="Yes" && $countApps>="1")
					{
						?>
						<div align="center" style="float: left; width:100px; height:100px; margin-bottom:10px; margin:0px; font-size:10px; padding:2px;">
							<a href="?ref=<?php echo iDevSite("DASHBOARD URL"); ?>/<?php echo PluginFeatures("DASHBOARD HREF",$plugin_id_code); ?>.php&id=<?php echo $data;?>">
							<img src="<?php echo find_file("plugins/".$plugin_url."/images/icon.png")?>" width="100%" height="100%"><br>
							<?php echo $plugin_name; ?>
							</a>
						</div>
						<?php
					}
					
					
					if($a=="STORE ICON" && $dashboard_feature=="Yes")
					{
						?>
						<div align="center" style="float: left; width:100px; height:100px; margin-bottom:10px; margin:0px; font-size:10px; padding:2px;">
							<a href="?ref=<?php echo iDevSite("STORE URL"); ?>/<?php echo PluginFeatures("DASHBOARD HREF",$plugin_id_code); ?>.php&id=<?php echo $data;?>">
							<img src="<?php echo find_file("plugins/".$plugin_url."/images/icon.png")?>" width="100%" height="100%"><br>
							<?php echo $plugin_name; ?>
							</a>
						</div>
						<?php
					}
					
					
					if($a=="STORE FEATURES" && $dashboard_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/storefeatures.php");
					}
					
					
					if($a=="DASHBOARD HREF" && $dashboard_feature=="Yes")
					{
						return str_replace(" ","",strtolower($plugin_name));
					}
					
					
					if($a=="PLUGIN NAME")
					{
						return $plugin_name;
					}

					
					if($a=="PLUGIN BODY")
					{
						include_once find_file("plugins/".$plugin_url."/body.php");
					}

					
					if($a=="PLUGIN MISC")
					{
						include_once find_file("plugins/".$plugin_url."/misc.php");
					}
					
					
					if($a=="PLUGIN URL")
					{
						return $plugin_url;
					}
					
					if($a=="DASHBOARD ITEM" && $dashboard_feature=="Yes")
					{
						//echo "test:".$plugin_url."<br>";
						include_once find_file("plugins/".$plugin_url."/dashboard.php");
					}
					
					if($a=="ADMIN MENU" && $admin_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/adminnav.php");
					}
					
					if($a=="ADMIN" && $admin_feature=="Yes")
					{				
						include_once find_file("plugins/".$plugin_url."/admin.php");
					}
					
					if($a=="PAGE" && $page_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/page.php");
					}
				}
			}
		}
		else
		{

			$selFunc = "SELECT * FROM meta WHERE data = '".$b."' AND meta_data = '".md5("PLUGIN-ID-CODE")."';";
			//echo "plugin: ".$selFunc;
			@$res = mysqli_query($db,$selFunc);
			@$num = mysqli_num_rows($res);
			//echo "plugin:".$num;
			for($ax=0; $ax<$num; $ax++)
			{
				@$rw = mysqli_fetch_array($res);
				$id = $rw["id"];
				$userid = $rw["userid"];
				$data = $rw["data"];
				$meta_data = $rw["meta_data"];
				$dateset = $rw["dateset"];
				$syncstate = $rw["syncstate"];
				
				$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
				//echo $selX;
				@$resX = mysqli_query($db,$selX);
				@$rwX = mysqli_fetch_array($resX);
				$active = $rwX["data"];
				
				if($active=="Yes")
				{
					$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$data."';";
					@$resX1 = mysqli_query($db,$selX1);
					@$rwX1 = mysqli_fetch_array($resX1);	
					$plugin_url = $rwX1["data"];
					
					$selX2 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-NAME")."' AND meta_data = '".$data."';";
					@$resX2 = mysqli_query($db,$selX2);
					@$rwX2 = mysqli_fetch_array($resX2);
					$plugin_name = $rwX2["data"];
					
					$selX3 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DEVELOPER")."' AND meta_data = '".$data."';";
					@$resX3 = mysqli_query($db,$selX3);
					@$rwX3 = mysqli_fetch_array($resX3);
					$plugin_developer = $rwX3["data"];
					
					$selX4 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DATE-OF-RELEASE")."' AND meta_data = '".$data."';";
					@$resX4 = mysqli_query($db,$selX4);
					@$rwX4 = mysqli_fetch_array($resX4);
					$plugin_date_of_release = $rwX4["data"];
					
					$selX5 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-VERSION")."' AND meta_data = '".$data."';";
					@$resX5 = mysqli_query($db,$selX5);
					@$rwX5 = mysqli_fetch_array($resX5);
					$plugin_version = $rwX5["data"];
					
					$selX6 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-UPDATE-URL")."' AND meta_data = '".$data."';";
					@$resX6 = mysqli_query($db,$selX6);
					@$rwX6 = mysqli_fetch_array($resX6);
					$update_url = $rwX6["data"];
					
					$selX7 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-SIDEBAR")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX7 = mysqli_query($db,$selX7);
					@$rwX7 = mysqli_fetch_array($resX7);
					$sidebar_feature = $rwX7["data"];
				
					$selX8 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-MENU")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX8 = mysqli_query($db,$selX8);
					@$rwX8 = mysqli_fetch_array($resX8);
					$menu_feature = $rwX8["data"];
								
					$selX9 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-POST-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX9 = mysqli_query($db,$selX9);
					@$rwX9 = mysqli_fetch_array($resX9);
					$post_feature = $rwX9["data"];
					
					$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX10 = mysqli_query($db,$selX10);
					@$rwX10 = mysqli_fetch_array($resX10);
					$page_feature = $rwX10["data"];
					
					$selX11 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DASHBOARD-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX11 = mysqli_query($db,$selX11);
					@$rwX11 = mysqli_fetch_array($resX11);
					$dashboard_feature = $rwX11["data"];
					
					$selX12 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ADMIN-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
					@$resX12 = mysqli_query($db,$selX12);
					@$rwX12 = mysqli_fetch_array($resX12);
					$admin_feature = $rwX12["data"];
					
					$udata = userData();
					
					$selX13 = "SELECT count(DISTINCT data) AS countApps FROM meta WHERE userid = '".md5($udata['userID'])."' AND meta_data = '".md5("INSTALLED APP")."' AND data = '".$data."';";
					@$resX13 = mysqli_query($db,$selX13);
					@$rwX13 = mysqli_fetch_array($resX13);
					$countApps = $rwX13["countApps"];
					
					$selX14 = "SELECT * FROM meta WHERE userid = '".md5($udata['userID'])."' AND meta_data = '".md5("INSTALLED APP")."' AND data = '".$data."';";
					@$resX14 = mysqli_query($db,$selX14);
					@$rwX14 = mysqli_fetch_array($resX14);
					$installed_app = $rwX14["data"];
					
						if($countApps>="1")
						{
							$paction = "uninstall";
							
							if($_REQUEST["paction"]=="uninstall")
							{
								uninstallMyPlugin($udata['userID'],$data);
							}
						}
						else
						{
							$paction = "install";
							
							if($_REQUEST["paction"]=="install")
							{
								installMyPlugin($udata['userID'],$data);
							}
						}
					
					$GLOBALS['plugin_signature'] = $data;
					
						
					if($a=="SIDEBAR" && $sidebar_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/sidebar.php");
					}
					
					if($a=="MENU" && $menu_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/menu.php");
					}
					
					if($a=="POST" && $post_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/post.php");
					}
					
					
					if($a=="DASHBOARD ICON" && $dashboard_feature=="Yes" && $countApps>="1")
					{
						/*
						?>
						<div style="float: left; width:60px; height:60px; margin-bottom:10px; margin:0px; font-size:10px; padding:2px;">
							<a href="?ref=<?php echo iDevSite("DASHBOARD URL"); ?>/<?php echo PluginFeatures("DASHBOARD HREF",$plugin_id_code); ?>.php&id=<?php echo $data;?>">
							<img src="plugins/<?php echo $plugin_url?>/images/icon.png" width="100%" height="100%">
							</a>
						</div>
						<?php
						*/
					}
					
					
					if($a=="ABOUT APP" && $dashboard_feature=="Yes")
					{
						if(file_exists("plugins/".$plugin_url."/about.php"))
						{
							include_once find_file("plugins/".$plugin_url."/about.php");
						}
						else
						{
							$about_plugin = "NIL";
						}
						
						return $about_plugin;
					}
					
					
					if($a=="STORE ICON" && $dashboard_feature=="Yes")
					{
						?>
						<div>
							<div align="center" style="float: left; width:150px; margin-bottom:10px; margin:0px; font-size:10px; padding:2px;">
								<a href="?ref=<?php echo iDevSite("STORE URL"); ?>/<?php echo PluginFeatures("DASHBOARD HREF",$plugin_id_code); ?>.php&id=<?php echo $data;?>&paction=<?php echo $paction;?>">
								<img src="<?php echo find_file("plugins/".$plugin_url."/images/icon.png")?>" width="148" height="148"><br>
								<?php echo strtoupper($paction." ".$plugin_name); ?>
								</a>
							</div>
							<div style="float: left; max-width:800px; min-width: 300px; margin-bottom:10px; margin:0px; font-size:12px; font-weight:normal; padding:2px;">
								<b>ABOUT <?php echo strtoupper($plugin_name); ?></b>
								<br>
								<?php echo PluginFeatures("ABOUT APP",$plugin_id_code);?>
							</div>
						</div>
						<?php
					}
					
					
					if($a=="STORE FEATURES" && $dashboard_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/storefeatures.php");
					}
					
					
					if($a=="DASHBOARD HREF" && $dashboard_feature=="Yes")
					{
						return str_replace(" ","",strtolower($plugin_name));
					}

					
					if($a=="PLUGIN BODY")
					{
						include_once find_file("plugins/".$plugin_url."/body.php");
					}

					
					if($a=="PLUGIN MISC")
					{
						include_once find_file("plugins/".$plugin_url."/misc.php");
					}
					
					
					if($a=="PLUGIN NAME")
					{
						return $plugin_name;
					}
					
					
					if($a=="PLUGIN URL")
					{
						return $plugin_url;
					}
					
					
					if($a=="DASHBOARD MENU" && $dashboard_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/dashboardnav.php");
					}
					
					if($a=="DASHBOARD ITEM" && $dashboard_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/dashboard.php");
					}
					
					if($a=="ADMIN MENU" && $admin_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/adminnav.php");
					}
					
					
					if($a=="ADMIN" && $admin_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/admin.php");
					}
					
					if($a=="PAGE" && $page_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/page.php");
					}
					
					if($a=="META" && $page_feature=="Yes")
					{
						include_once find_file("plugins/".$plugin_url."/meta.php");
					}
				}
			}
		}
		
		@mysqli_close($db);
	}
}



if(function_exists("PluginDetails"))
{
	
}
else
{
	function PluginDetails($a=""){
		
		include find_file("cnct.php");
		include_once find_file("mis/priv.php");
		
		if(!($a==""))
		{
			$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("PLUGIN-ID-CODE")."' AND data = '".$a."';";
			@$res = mysqli_query($db,$selFunc);
			@$num = mysqli_num_rows($res);
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$meta_data = $rw["meta_data"];
			$dateset = $rw["dateset"];
			$syncstate = $rw["syncstate"];
			
				if($num>="1")
				{
					$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
					//echo $selX;
					@$resX = mysqli_query($db,$selX);
					@$rwX = mysqli_fetch_array($resX);
					$active = $rwX["data"];
					
						$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$data."';";
						@$resX1 = mysqli_query($db,$selX1);
						@$rwX1 = mysqli_fetch_array($resX1);	
						$plugin_url = $rwX1["data"];
						
						$selX2 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-NAME")."' AND meta_data = '".$data."';";
						@$resX2 = mysqli_query($db,$selX2);
						@$rwX2 = mysqli_fetch_array($resX2);
						$plugin_name = $rwX2["data"];
						
						$selX3 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DEVELOPER")."' AND meta_data = '".$data."';";
						@$resX3 = mysqli_query($db,$selX3);
						@$rwX3 = mysqli_fetch_array($resX3);
						$plugin_developer = $rwX3["data"];
						
						$selX4 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DATE-OF-RELEASE")."' AND meta_data = '".$data."';";
						@$resX4 = mysqli_query($db,$selX4);
						@$rwX4 = mysqli_fetch_array($resX4);
						$plugin_date_of_release = $rwX4["data"];
						
						$selX5 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-VERSION")."' AND meta_data = '".$data."';";
						@$resX5 = mysqli_query($db,$selX5);
						@$rwX5 = mysqli_fetch_array($resX5);
						$plugin_version = $rwX5["data"];
						
						$selX6 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-UPDATE-URL")."' AND meta_data = '".$data."';";
						@$resX6 = mysqli_query($db,$selX6);
						@$rwX6 = mysqli_fetch_array($resX6);
						$update_url = $rwX6["data"];
						
						$selX7 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-SIDEBAR")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX7 = mysqli_query($db,$selX7);
						@$rwX7 = mysqli_fetch_array($resX7);
						$sidebar_feature = $rwX7["data"];
					
						$selX8 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-MENU")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX8 = mysqli_query($db,$selX8);
						@$rwX8 = mysqli_fetch_array($resX8);
						$menu_feature = $rwX8["data"];
									
						$selX9 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-POST-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX9 = mysqli_query($db,$selX9);
						@$rwX9 = mysqli_fetch_array($resX9);
						$post_feature = $rwX9["data"];
						
						$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX10 = mysqli_query($db,$selX10);
						@$rwX10 = mysqli_fetch_array($resX10);
						$page_feature = $rwX10["data"];
						
						$selX11 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DASHBOARD-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX11 = mysqli_query($db,$selX11);
						@$rwX11 = mysqli_fetch_array($resX11);
						$dashboard_feature = $rwX11["data"];
						
						$selX12 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ADMIN-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX12 = mysqli_query($db,$selX12);
						@$rwX12 = mysqli_fetch_array($resX12);
						$admin_feature = $rwX12["data"];
						
						$array = array('num'=>$num,'id'=>$id,'name'=>$plugin_name,'version'=>$plugin_version,'update'=>$update_url,'developer'=>$plugin_developer,'url'=>$plugin_url,'DOR'=>$plugin_date_of_release,'sidebar'=>$sidebar_feature,'menu'=>$menu_feature,'post'=>$post_feature,'page'=>$page_feature,'dashboard'=>$dashboard_feature,'admin'=>$admin_feature,'status'=>$active);
						
						return $array;
				}
		}
		else
		{
			$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("PLUGIN-ID-CODE")."';";
			@$res = mysqli_query($db,$selFunc);
			@$num = mysqli_num_rows($res);
			
			if($num>="1")
			{
				for($ax=0; $ax<$num; $ax++){
					@$rw = mysqli_fetch_array($res);
					$id = $rw["id"];
					$userid = $rw["userid"];
					$data = $rw["data"];
					$meta_data = $rw["meta_data"];
					$dateset = $rw["dateset"];
					$syncstate = $rw["syncstate"];
					
					$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
					//echo $selX;
					@$resX = mysqli_query($db,$selX);
					@$rwX = mysqli_fetch_array($resX);
					$active = $rwX["data"];
					
						$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$data."';";
						@$resX1 = mysqli_query($db,$selX1);
						@$rwX1 = mysqli_fetch_array($resX1);	
						$plugin_url = $rwX1["data"];
						
						$selX2 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-NAME")."' AND meta_data = '".$data."';";
						@$resX2 = mysqli_query($db,$selX2);
						@$rwX2 = mysqli_fetch_array($resX2);
						$plugin_name = $rwX2["data"];
						
						$selX3 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DEVELOPER")."' AND meta_data = '".$data."';";
						@$resX3 = mysqli_query($db,$selX3);
						@$rwX3 = mysqli_fetch_array($resX3);
						$plugin_developer = $rwX3["data"];
						
						$selX4 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DATE-OF-RELEASE")."' AND meta_data = '".$data."';";
						@$resX4 = mysqli_query($db,$selX4);
						@$rwX4 = mysqli_fetch_array($resX4);
						$plugin_date_of_release = $rwX4["data"];
						
						$selX5 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-VERSION")."' AND meta_data = '".$data."';";
						@$resX5 = mysqli_query($db,$selX5);
						@$rwX5 = mysqli_fetch_array($resX5);
						$plugin_version = $rwX5["data"];
						
						$selX6 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-UPDATE-URL")."' AND meta_data = '".$data."';";
						@$resX6 = mysqli_query($db,$selX6);
						@$rwX6 = mysqli_fetch_array($resX6);
						$update_url = $rwX6["data"];
						
						$selX7 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-SIDEBAR")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX7 = mysqli_query($db,$selX7);
						@$rwX7 = mysqli_fetch_array($resX7);
						$sidebar_feature = $rwX7["data"];
					
						$selX8 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-MENU")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX8 = mysqli_query($db,$selX8);
						@$rwX8 = mysqli_fetch_array($resX8);
						$menu_feature = $rwX8["data"];
									
						$selX9 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-POST-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX9 = mysqli_query($db,$selX9);
						@$rwX9 = mysqli_fetch_array($resX9);
						$post_feature = $rwX9["data"];
						
						$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX10 = mysqli_query($db,$selX10);
						@$rwX10 = mysqli_fetch_array($resX10);
						$page_feature = $rwX10["data"];
						
						$selX11 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DASHBOARD-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX11 = mysqli_query($db,$selX11);
						@$rwX11 = mysqli_fetch_array($resX11);
						$dashboard_feature = $rwX11["data"];
						
						$selX12 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ADMIN-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX12 = mysqli_query($db,$selX12);
						@$rwX12 = mysqli_fetch_array($resX12);
						$admin_feature = $rwX12["data"];
						
					$array[] = array('num'=>$num,'id'=>$id,'name'=>$plugin_name,'version'=>$plugin_version,'update'=>$update_url,'developer'=>$plugin_developer,'url'=>$plugin_url,'DOR'=>$plugin_date_of_release,'sidebar'=>$sidebar_feature,'menu'=>$menu_feature,'post'=>$post_feature,'page'=>$page_feature,'dashboard'=>$dashboard_feature,'admin'=>$admin_feature,'status'=>$active);
				}
				
				return $array;
			}
			else
			{
				$array = array('num'=>0);		
				return $array;
			}
		}
		
		mysqli_close($db);
	}
}


if(function_exists("deletePlugin"))
{
	
}
else
{
	function deletePlugin($entry){
		$a=0;
		if(file_exists($entry."/view/view.php"))
		{
			if(unlink($entry."/view/view.php"))
			{
				$a=$a+1;
				rmdir($entry."/view/");
			}
			else
			{
				$a=$a;
			}
		}
		
		if(file_exists($entry."/edit/edit.php"))
		{
			if(unlink($entry."/edit/edit.php"))
			{
				$a=$a+1;
				rmdir($entry."/edit/");
			}
			else
			{
				$a=$a;
			}
		}
		
		if(file_exists($entry."/setup/setup.php"))
		{
			if(unlink($entry."/setup/setup.php"))
			{
				$a=$a+1;
				rmdir($entry."/setup/");
			}
			else
			{
				$a=$a;
			}
		}
		
		if(file_exists($entry."/list/list.php"))
		{
			if(unlink($entry."/list/list.php"))
			{
				$a=$a+1;
				rmdir($entry."/list/");
			}
			else
			{
				$a=$a;
			}
		}
		
		if(file_exists($entry."/delete/delete.php"))
		{
			if(unlink($entry."/delete/delete.php"))
			{
				$a=$a+1;
				rmdir($entry."/delete/");
			}
			else
			{
				$a=$a;
			}
		}
		
		if(file_exists($entry."/add/add.php"))
		{
			if(unlink($entry."/add/add.php"))
			{
				$a=$a+1;
				rmdir($entry."/add/");
			}
			else
			{
				$a=$a;
			}
		}
		
		$entryx = $entry."/";
		
		$files = glob( $entry . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
		
		foreach( $files as $file )
		{
			/*if(@unlink($file))
			{
				$a=$a+1;
			}	
			else
			{
				$a=$a;
			}*/
			echo $file."<br>";
		}
		
		return $a;
	}
}



if(function_exists("pluginPages"))
{
	
}
else
{
	function pluginPages($type="",$item="",$class=""){
		
		
		include find_file("cnct.php");
		include_once find_file("mis/priv.php");
		
		$short = "";
		
		$sh = explode(" ",$item);
		$csh = count($sh);
		
		for($r=0; $r<$csh; $r++)
		{
			$short .= $sh[$r];
		}
		
		$short .= ".php";
		
		if($type=="" || $type=="LIST")
		{
			
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("MY PLUGIN PAGES")."' ORDER BY syncstate ASC;";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			for($a=0; $a<$num; $a++)
			{			
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			
				$array[] = array('num'=>$num,'id'=>$id,'userid'=>$userid,'data'=>$data);
			}
			
			return $array;
		}
		elseif($type=="ADD")
		{
			pluginPages("DELETE",$short,"~");

				$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$class."','".strtolower($short)."','".md5("MY PLUGIN PAGES")."');";
				//echo $ins;
				@$res = mysqli_query($db,$ins);
				
				if($res)
				{
					return 1;
				}
				else
				{
					return 0;
				}
		}
		elseif($type=="ORDER")
		{
			$ins = "UPDATE meta SET syncstate = '".$class."' WHERE meta_data = '".md5("MY PLUGIN PAGES")."' AND (data = '".$item."' OR userid = '".$item."' OR id = '".$item."');";
			//echo $ins;
			@$res = mysqli_query($db,$ins); 
			
			if($res)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		elseif($type=="DELETE")
		{
			if($class=="~")
			{
				$ins = "DELETE FROM meta WHERE meta_data = '".md5("MY PLUGIN PAGES")."' AND (data like '%".$item."%' OR userid = '%".$item."%' OR id = '%".$item."%');";
				//echo $ins;
			}
			else
			{
				$ins = "DELETE FROM meta WHERE meta_data = '".md5("MY PLUGIN PAGES")."' AND (data = '".$item."' OR userid = '".$item."' OR id = '".$item."');";
				//echo $ins;
			}
				@$res = mysqli_query($db,$ins);
			
			if($res)
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
			
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("MY PLUGIN PAGES")."' AND (data = '".$item."'  OR userid = '".$item."' OR id = '".$item."'));";
			@$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
		
			if($type=="ID")
			{
				return $id;
			}
			elseif($type=="UID")
			{
				return $userid;
			}
			elseif($type=="PAGE")
			{
				return $data;
			}
			elseif($type=="BINDING")
			{
				return $data;
			}
		}
		
		mysqli_close($db);
	}
}



if(function_exists("pluginBinding"))
{
	
}
else
{
	function pluginBinding($type,$a,$b=""){
		
		
		include find_file("cnct.php");
		include_once find_file("mis/priv.php");
		
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$GLOBALS['plugin_signature']."','".$a."','".md5("PLUGIN-BINGINGS")."');";
			//echo $ins;
			@$res = mysqli_query($db,$ins);
			
			if($res)
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

			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("PLUGIN-BINGINGS")."' AND (data = '".$a."'  OR userid = '".$a."' OR id = '".$a."'));";
			//echo "".$sel;
			@$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];			
				
			if($type=="ID")
			{
				return $id;
			}
			elseif($type=="PLUGIN")
			{
				return $userid;
			}
			elseif($type=="IID")
			{
				return $data;
			}
		}
		
		mysqli_close($db);
	}
}
?>