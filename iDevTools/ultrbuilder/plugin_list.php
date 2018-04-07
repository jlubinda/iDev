<?php

	include_once "plugins/includes/vars.php";
	include_once "mis/priv.php";
	$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("PLUGIN-ID-CODE")."';";
	//echo $selFunc;
	$res = mysqli_query($db,$selFunc);
	@$num = mysqli_num_rows($res);
	
	$pluginData = PluginDetails($_REQUEST["id"]);
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
					
		
	if($_REQUEST["function"]=="deactivate")
	{
		$update = "UPDATE meta SET data = 'No' WHERE id = '".$_REQUEST["id"]."';";
		$res = mysqli_query($db,$update);
	}
	
	if($_REQUEST["function"]=="activate")
	{
		$update2 = "UPDATE meta SET data = 'Yes' WHERE id = '".$_REQUEST["id"]."';";
		$res2 = mysqli_query($db,$update2);
	}
	
	if($_REQUEST["function"]=="delete")
	{
		$target = "./plugins/".$plugin_url;
		
		//echo $target."<br>";
		
		if(deletePlugin($target)>="1")
		{
		$update3 = "DELETE FROM meta WHERE data = '".$_REQUEST["id"]."' OR meta_data = '".$_REQUEST["id"]."';";
		$res3 = mysqli_query($db,$update3);
		}
		else
		{
			echo "Error!";
		}
	}
	
	echo '<table width="98%" id="tables_css">';
	echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Developer</b></td><td><b>Release Date</b></td><td><b>Version</b></td><td><b>Sidebar Insert</b></td><td><b>Menu Insert</b></td><td><b>Page Insert</b></td><td><b>Post Insert</b></td><td><b>Plugin URL</b></td><td></td><td></td></tr>';
	for($a=0; $a<$num; $a++)
	{
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		$meta_data = $rw["meta_data"];
		$dateset = $rw["dateset"];
		$syncstate = $rw["syncstate"];
		
		$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
		
		//echo $selX."<br>";
		$resX = mysqli_query($db,$selX);
		@$rwX = mysqli_fetch_array($resX);
		$activeID = $rwX["id"];
		$active = $rwX["data"];
		
		if($active=="Yes")
		{
			$activationLink = "?ref=3&segment=d1&function=deactivate&unit=3&id=".$activeID;
			$activationLinkWord = "Deactivate";
		}
		else
		{
			$activationLink = "?ref=3&segment=d1&function=activate&unit=3&id=".$activeID;
			$activationLinkWord = "Activate";
		}
		
	
		
			
			$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$data."';";
			$resX1 = mysqli_query($db,$selX1);
			$rwX1 = mysqli_fetch_array($resX1);	
			$plugin_url = $rwX1["data"];
			
			$selX2 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-NAME")."' AND meta_data = '".$data."';";
			$resX2 = mysqli_query($db,$selX2);
			$rwX2 = mysqli_fetch_array($resX2);
			$plugin_name = $rwX2["data"];
			
			$selX3 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DEVELOPER")."' AND meta_data = '".$data."';";
			$resX3 = mysqli_query($db,$selX3);
			$rwX3 = mysqli_fetch_array($resX3);
			$plugin_developer = $rwX3["data"];
			
			$selX4 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DATE-OF-RELEASE")."' AND meta_data = '".$data."';";
			$resX4 = mysqli_query($db,$selX4);
			$rwX4 = mysqli_fetch_array($resX4);
			$plugin_date_of_release = $rwX4["data"];
			
			$selX5 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-VERSION")."' AND meta_data = '".$data."';";
			$resX5 = mysqli_query($db,$selX5);
			$rwX5 = mysqli_fetch_array($resX5);
			$plugin_version = $rwX5["data"];
			
			$selX6 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-UPDATE-URL")."' AND meta_data = '".$data."';";
			$resX6 = mysqli_query($db,$selX6);
			$rwX6 = mysqli_fetch_array($resX6);
			$update_url = $rwX6["data"];
			
			$selX7 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-SIDEBAR")."' AND meta_data = '".$data."' AND data = 'Yes';";
			$resX7 = mysqli_query($db,$selX7);
			$rwX7 = mysqli_fetch_array($resX7);
			$sidebar_feature = $rwX7["data"];
		
			$selX8 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-MENU")."' AND meta_data = '".$data."' AND data = 'Yes';";
			$resX8 = mysqli_query($db,$selX8);
			$rwX8 = mysqli_fetch_array($resX8);
			$menu_feature = $rwX8["data"];
						
			$selX9 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-POST-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
			$resX9 = mysqli_query($db,$selX9);
			$rwX9 = mysqli_fetch_array($resX9);
			$post_feature = $rwX9["data"];
			
			$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
			$resX10 = mysqli_query($db,$selX10);
			$rwX10 = mysqli_fetch_array($resX10);
			$page_feature = $rwX10["data"];
			
			$plugin_array = PluginDetails();
			
			echo '<tr><td><b>'.($a+1).'.)</b></td><td>'.$plugin_name.'</td><td>'.$plugin_developer.'</td><td>'.$plugin_date_of_release.'</td><td>'.$plugin_version.'</td><td>';if($a=="SIDEBAR" && $sidebar_feature=="Yes"){echo "Yes";} echo '</td><td>';if($a=="MENU" && $menu_feature=="Yes"){echo "Yes";} echo '</td><td>';if($a=="PAGE" && $page_feature=="Yes"){echo "Yes";} echo '</td><td>';if($a=="POST" && $post_feature=="Yes"){echo "Yes";} echo '</td><td>'.$plugin_url.'</td><td><a href="'.$activationLink.'">'.$activationLinkWord.'</a></td><td><a href="?ref=3&segment=d1&function=delete&unit=3&id='.$data.'">Delete</a></td></tr>';
	}
	echo '</table>'
	?>