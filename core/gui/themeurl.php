<?php
 

if(function_exists('themeurl'))
{
	
}
else
{
	function themeurl(){
		
	include find_file("cnct.php");

	$selMn = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("THEME INSTALLATION")."' AND data IN (SELECT meta_data FROM meta WHERE meta_data = '".md5("THEME-ACTIVE-STATUS")."' AND data = 'Yes'));";
	@@$resMn = mysqli_query($db,$selMn);
	@$num = mysqli_num_rows(@$resMn);

		if($num>="1")
		{
		@$rwM = mysqli_fetch_array(@$resMn);
		
		$url = $rwM["userid"];
		return $url;
		}
		else
		{
		return "default";
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('installTheme'))
{
	
}
else
{
	function installTheme($theme_name,$theme_url,$theme_developer,$theme_active_status,$theme_date_of_release,$theme_version,$theme_update_url,$theme_dashboard,$theme_admin,$theme_codex=""){
		
		include find_file("cnct.php");
		
		$e = array();
		
		if($theme_codex=="")
		{
			$theme_code = uniqueCode();
		}
		else
		{
			$theme_code = $theme_codex;
		}
		//$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("THEME INSTALLATION")."';";


		$ins_PCode = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-TYPE-CODE")."','".$theme_code."','".md5("THEME-ID-CODE")."');";
		@$res_PCode = mysqli_query($db,$ins_PCode);
		//echo $ins_PCode."<br>";
		
		if(@$res_PCode)
		{
			$e["code"] = 1;
		}
		else
		{
			$e["code"] = 0;
		}

		$ins_name = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-NAME")."','".$theme_name."','".$theme_code."');";
		@$res_name = mysqli_query($db,$ins_name);
		//echo $ins_name."<br>";
		
		if(@$res_name)
		{
			$e["name"] = 1;
		}
		else
		{
			$e["name"] = 0;
		}

		$ins_url = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-URL")."','".$theme_url."','".$theme_code."');";
		@$res_url = mysqli_query($db,$ins_url);
		//echo $ins_url."<br>";
		
		if(@$res_url)
		{
			$e["url"] = 1;
		}
		else
		{
			$e["url"] = 0;
		}

		$ins_developer = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-DEVELOPER")."','".$theme_developer."','".$theme_code."');";
		@$res_developer = mysqli_query($db,$ins_developer);
		//echo $ins_developer."<br>";
		
		if(@$res_developer)
		{
			$e["developer"] = 1;
		}
		else
		{
			$e["developer"] = 0;
		}

		$ins_active_status = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-ACTIVE-STATUS")."','".$theme_active_status."','".$theme_code."');";
		@$res_active_status = mysqli_query($db,$ins_active_status);
		//echo $ins_active_status."<br>";
		
		if(@$res_active_status)
		{
			$e["status"] = 1;
		}
		else
		{
			$e["status"] = 0;
		}

		$ins_date_of_release = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-DATE-OF-RELEASE")."','".$theme_date_of_release."','".$theme_code."');";
		@$res_date_of_release = mysqli_query($db,$ins_date_of_release);
		//echo $ins_date_of_release."<br>";
		
		if(@$res_date_of_release)
		{
			$e["release_date"] = 1;
		}
		else
		{
			$e["release_date"] = 0;
		}

		$ins_version = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-VERSION")."','".$theme_version."','".$theme_code."');";
		@$res_version = mysqli_query($db,$ins_version);
		//echo $ins_version."<br>";
		
		if(@$res_version)
		{
			$e["version"] = 1;
		}
		else
		{
			$e["version"] = 0;
		}

		$ins_update_url = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-UPDATE-URL")."','".$theme_update_url."','".$theme_code."');";
		@$res_update_url = mysqli_query($db,$ins_update_url);
		//echo $ins_update_url."<br>";
		
		if(@$res_update_url)
		{
			$e["update"] = 1;
		}
		else
		{
			$e["update"] = 0;
		}

		if($theme_dashboard=="Yes")
		{
		$ins_dashboard_data = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-DASHBOARD-FEATURE")."','".$theme_dashboard."','".$theme_code."');";
		@$res_dashboard_data = mysqli_query($db,$ins_dashboard_data);
		//echo $ins_dashboard_data."<br>";
			
			if(@$res_dashboard_data)
			{
				$e["dashboard"] = 1;
			}
			else
			{
				$e["dashboard"] = 0;
			}
		}
		else
		{
			$e["dashboard"] = 1;
		}

		if($theme_admin=="Yes")
		{
		$ins_admin_data = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("THEME-ADMIN-FEATURE")."','".$theme_admin."','".$theme_code."');";
		@$res_admin_data = mysqli_query($db,$ins_admin_data);
		//echo $ins_admin_data."<br>";
			
			if(@$res_admin_data)
			{
				$e["admin"] = 1;
			}
			else
			{
				$e["admin"] = 0;
			}
		}
		else
		{
			$e["admin"] = 1;
		}
		
		if($e["admin"]==1 && $e["dashboard"]==1 && $e["update"]==1 && $e["version"]==1 && $e["release_date"]==1 && $e["status"]==1 && $e["developer"]==1 && $e["url"]==1 && $e["name"]==1 && $e["code"]==1)
		{
			$ins_x = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$theme_url."','".$theme_code."','".md5("THEME INSTALLATION")."');";
			@$res_x = mysqli_query($db,$ins_x);
			//echo $ins_PCode."<br>";
			
			if(@$res_x)
			{
				$e["install"] = 1;
			}
			else
			{
				$e["install"] = 0;
			}
		}
		
		return $e;
	}
}
 

if(function_exists('uploadTheme'))
{
	
}
else
{
	function uploadTheme(){
		
		//include find_file("cnct.php");
		//include find_file("mis/priv.php");
		
		$varx = "newthemex";

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
					<td align="center"><input type="file" name="<?php echo $varx;?>" id="file"> &nbsp;&nbsp;<input name="submitBtn" type="submit" value="Upload"></td>
				</tr>
			</table>
			</form>
			<?php
			
		if($_REQUEST["submitBtn"]=="Upload" && $_FILES[$varx]['name'])
		{
			$themes_dir = "themes";
			$theme_url = uniqueCode();
			
			
			$theme_install_folder = $themes_dir."/".$theme_url;
			$mdir = mkdir($theme_install_folder);
			$newNamexx = upload("$varx",$theme_install_folder,"zip");
			$target = $theme_install_folder."/".$newNamexx;
			//echo "<br>test nem upload: ".$newNamexx."<br>";
			if($newNamexx=="0")
			{
			?>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;">
					<div style="margin:5px; float: left; width:300px; padding:5px; background-color:#333;">
						ERROR UPLOADING FILEc. PLEASE TRY AGAIN LATER.
					</div>
				</div>
			<?php
			}
			else
			{
			
				if($mdir)
				{

				$myuploadx = $_FILES[$varx]['tmp_name'];
				
				
					if($newNamexx) 
					{	
					$typeZipxx = explode(".",$_FILES[$varx]['name']);
					$typeZip = strtolower($typeZipxx[1]);	
					
								
						if($typeZip=="zip")
						{
							$zip = new ZipArchive;
							
							if($zip->open($target) === TRUE) 
							{
								$zip->extractTo($theme_install_folder);
								$zip->close();

								
								include find_file($theme_install_folder."/install.php");
								
								echo "theme_code: ".$theme_code."<br>";
								echo "theme_name: ".$theme_name."<br>";
								echo "theme_url: ".$theme_url."<br>";
								echo "theme_developer: ".$theme_developer."<br>";
								echo "theme_active_status: ".$theme_active_status."<br>";
								echo "theme_date_of_release: ".$theme_date_of_release."<br>";
								echo "theme_version: ".$theme_version."<br>";
								echo "theme_update_url: ".$theme_update_url."<br>";
								echo "theme_dashboard: ".$theme_dashboard."<br>";
								echo "theme_admin: ".$theme_admin."<br>";
														
								$inst = installTheme($theme_name,$theme_url,$theme_developer,$theme_active_status,$theme_date_of_release,$theme_version,$theme_update_url,$theme_dashboard,$theme_admin);
								//var_dump($inst);
								
								unlink($target);
								unlink(find_file($theme_install_folder."/install.php"));
								
								return $inst;
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
					$rename = "";
					}			
				}
				else
				{
					echo "Error installing plug-in.";
				}
			}
		}
	}
}
 

if(function_exists('ThemeDetails'))
{
	
}
else
{
	function ThemeDetails($a=""){
		
		if(!($a==""))
		{	
			include find_file("cnct.php");

			$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("THEME-ID-CODE")."' AND data = '".$a."';";
			@$res = mysqli_query($db,$selFunc);
			@$num = mysqli_num_rows(@$res);
			$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$meta_data = $rw["meta_data"];
			$dateset = $rw["dateset"];
			$syncstate = $rw["syncstate"];
			
				if($num>="1")
				{
					$selX = "SELECT * FROM meta WHERE userid = '".md5("THEME-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
					//echo $selX;
					@$resX = mysqli_query($db,$selX);
					$rwX = mysqli_fetch_array(@$resX);
					$active = $rwX["data"];
					$activeID = $rwX["id"];
					
						$selX1 = "SELECT * FROM meta WHERE userid = '".md5("THEME-URL")."' AND meta_data = '".$data."';";
						@$resX1 = mysqli_query($db,$selX1);
						$rwX1 = mysqli_fetch_array(@$resX1);	
						$theme_url = $rwX1["data"];
						
						$selX2 = "SELECT * FROM meta WHERE userid = '".md5("THEME-NAME")."' AND meta_data = '".$data."';";
						@$resX2 = mysqli_query($db,$selX2);
						$rwX2 = mysqli_fetch_array(@$resX2);
						$theme_name = $rwX2["data"];
						
						$selX3 = "SELECT * FROM meta WHERE userid = '".md5("THEME-DEVELOPER")."' AND meta_data = '".$data."';";
						@$resX3 = mysqli_query($db,$selX3);
						$rwX3 = mysqli_fetch_array(@$resX3);
						$theme_developer = $rwX3["data"];
						
						$selX4 = "SELECT * FROM meta WHERE userid = '".md5("THEME-DATE-OF-RELEASE")."' AND meta_data = '".$data."';";
						@$resX4 = mysqli_query($db,$selX4);
						$rwX4 = mysqli_fetch_array(@$resX4);
						$theme_date_of_release = $rwX4["data"];
						
						$selX5 = "SELECT * FROM meta WHERE userid = '".md5("THEME-VERSION")."' AND meta_data = '".$data."';";
						@$resX5 = mysqli_query($db,$selX5);
						$rwX5 = mysqli_fetch_array(@$resX5);
						$theme_version = $rwX5["data"];
						
						$selX6 = "SELECT * FROM meta WHERE userid = '".md5("THEME-UPDATE-URL")."' AND meta_data = '".$data."';";
						@$resX6 = mysqli_query($db,$selX6);
						$rwX6 = mysqli_fetch_array(@$resX6);
						$update_url = $rwX6["data"];
						
						$selX7 = "SELECT * FROM meta WHERE userid = '".md5("THEME-SIDEBAR")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX7 = mysqli_query($db,$selX7);
						$rwX7 = mysqli_fetch_array(@$resX7);
						$sidebar_feature = $rwX7["data"];
					
						$selX8 = "SELECT * FROM meta WHERE userid = '".md5("THEME-MENU")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX8 = mysqli_query($db,$selX8);
						$rwX8 = mysqli_fetch_array(@$resX8);
						$menu_feature = $rwX8["data"];
									
						$selX9 = "SELECT * FROM meta WHERE userid = '".md5("THEME-POST-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX9 = mysqli_query($db,$selX9);
						$rwX9 = mysqli_fetch_array(@$resX9);
						$post_feature = $rwX9["data"];
						
						$selX10 = "SELECT * FROM meta WHERE userid = '".md5("THEME-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX10 = mysqli_query($db,$selX10);
						$rwX10 = mysqli_fetch_array(@$resX10);
						$page_feature = $rwX10["data"];
						
						$selX11 = "SELECT * FROM meta WHERE userid = '".md5("THEME-DASHBOARD-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX11 = mysqli_query($db,$selX11);
						$rwX11 = mysqli_fetch_array(@$resX11);
						$dashboard_feature = $rwX11["data"];
						
						$selX12 = "SELECT * FROM meta WHERE userid = '".md5("THEME-ADMIN-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX12 = mysqli_query($db,$selX12);
						$rwX12 = mysqli_fetch_array(@$resX12);
						$admin_feature = $rwX12["data"];
						
						$array = array('activeID'=>$activeID,'num'=>$num,'id'=>$id,'name'=>$theme_name,'version'=>$theme_version,'update'=>$update_url,'developer'=>$theme_developer,'url'=>$theme_url,'DOR'=>$theme_date_of_release,'sidebar'=>$sidebar_feature,'menu'=>$menu_feature,'post'=>$post_feature,'page'=>$page_feature,'dashboard'=>$dashboard_feature,'admin'=>$admin_feature,'status'=>$active);
						
						return $array;
				}
		}
		else
		{
			include find_file("cnct.php");

			$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("THEME INSTALLATION")."';";
			//echo $selFunc;
			@$res = mysqli_query($db,$selFunc);
			$num = mysqli_num_rows(@$res);
			
			if($num>="1")
			{
				for($ax=0; $ax<$num; $ax++){
					$rw = mysqli_fetch_array(@$res);
					$id = $rw["id"];
					$userid = $rw["userid"];
					$data = $rw["data"];
					$meta_data = $rw["meta_data"];
					$dateset = $rw["dateset"];
					$syncstate = $rw["syncstate"];
					
					$selX = "SELECT * FROM meta WHERE userid = '".md5("THEME-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
					//echo $selX;
					@$resX = mysqli_query($db,$selX);
					$rwX = mysqli_fetch_array(@$resX);
					$active = $rwX["data"];
					$activeID = $rwX["id"];
					
						$selX1 = "SELECT * FROM meta WHERE userid = '".md5("THEME-URL")."' AND meta_data = '".$data."';";
						@$resX1 = mysqli_query($db,$selX1);
						$rwX1 = mysqli_fetch_array(@$resX1);	
						$theme_url = $rwX1["data"];
						
						$selX2 = "SELECT * FROM meta WHERE userid = '".md5("THEME-NAME")."' AND meta_data = '".$data."';";
						@$resX2 = mysqli_query($db,$selX2);
						$rwX2 = mysqli_fetch_array(@$resX2);
						$theme_name = $rwX2["data"];
						
						$selX3 = "SELECT * FROM meta WHERE userid = '".md5("THEME-DEVELOPER")."' AND meta_data = '".$data."';";
						@$resX3 = mysqli_query($db,$selX3);
						$rwX3 = mysqli_fetch_array(@$resX3);
						$theme_developer = $rwX3["data"];
						
						$selX4 = "SELECT * FROM meta WHERE userid = '".md5("THEME-DATE-OF-RELEASE")."' AND meta_data = '".$data."';";
						@$resX4 = mysqli_query($db,$selX4);
						$rwX4 = mysqli_fetch_array(@$resX4);
						$theme_date_of_release = $rwX4["data"];
						
						$selX5 = "SELECT * FROM meta WHERE userid = '".md5("THEME-VERSION")."' AND meta_data = '".$data."';";
						@$resX5 = mysqli_query($db,$selX5);
						$rwX5 = mysqli_fetch_array(@$resX5);
						$theme_version = $rwX5["data"];
						
						$selX6 = "SELECT * FROM meta WHERE userid = '".md5("THEME-UPDATE-URL")."' AND meta_data = '".$data."';";
						@$resX6 = mysqli_query($db,$selX6);
						$rwX6 = mysqli_fetch_array(@$resX6);
						$update_url = $rwX6["data"];
						
						$selX7 = "SELECT * FROM meta WHERE userid = '".md5("THEME-SIDEBAR")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX7 = mysqli_query($db,$selX7);
						$rwX7 = mysqli_fetch_array(@$resX7);
						$sidebar_feature = $rwX7["data"];
					
						$selX8 = "SELECT * FROM meta WHERE userid = '".md5("THEME-MENU")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX8 = mysqli_query($db,$selX8);
						$rwX8 = mysqli_fetch_array(@$resX8);
						$menu_feature = $rwX8["data"];
									
						$selX9 = "SELECT * FROM meta WHERE userid = '".md5("THEME-POST-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX9 = mysqli_query($db,$selX9);
						$rwX9 = mysqli_fetch_array(@$resX9);
						$post_feature = $rwX9["data"];
						
						$selX10 = "SELECT * FROM meta WHERE userid = '".md5("THEME-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX10 = mysqli_query($db,$selX10);
						$rwX10 = mysqli_fetch_array(@$resX10);
						$page_feature = $rwX10["data"];
						
						$selX11 = "SELECT * FROM meta WHERE userid = '".md5("THEME-DASHBOARD-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX11 = mysqli_query($db,$selX11);
						$rwX11 = mysqli_fetch_array(@$resX11);
						$dashboard_feature = $rwX11["data"];
						
						$selX12 = "SELECT * FROM meta WHERE userid = '".md5("THEME-ADMIN-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
						@$resX12 = mysqli_query($db,$selX12);
						$rwX12 = mysqli_fetch_array(@$resX12);
						$admin_feature = $rwX12["data"];
						
					$array[] = array('activeID'=>$activeID,'num'=>$num,'id'=>$id,'name'=>$theme_name,'version'=>$theme_version,'update'=>$update_url,'developer'=>$theme_developer,'url'=>$theme_url,'DOR'=>$theme_date_of_release,'sidebar'=>$sidebar_feature,'menu'=>$menu_feature,'post'=>$post_feature,'page'=>$page_feature,'dashboard'=>$dashboard_feature,'admin'=>$admin_feature,'status'=>$active);
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
?>