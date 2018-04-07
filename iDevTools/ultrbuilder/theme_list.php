<?php

	
	
	$selFunc = ThemeDetails();
	@$num = $selFunc[0]["num"];
	
	$themeData = ThemeDetails($_REQUEST["id"]);
	$theme_num = $themeData['num'];
	$theme_id = $themeData['id'];
	$theme_name = $themeData['name'];
	$theme_version = $themeData['version'];
	$theme_update = $themeData['update'];
	$theme_developer = $themeData['developer'];
	$theme_url = $themeData['url'];
	$theme_DOR = $themeData['DOR'];
	$theme_sidebar = $themeData['sidebar'];
	$theme_menu = $themeData['menu'];
	$theme_post = $themeData['post'];
	$theme_page = $themeData['page'];
	$theme_dashboard = $themeData['dashboard'];
	$theme_admin = $themeData['admin'];
	$theme_status = $themeData['status'];
			
	include find_file("cnct.php");		
		
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
		$target = "./themes/".$theme_url;
		
		//echo $target."<br>";
		
		if(deleteTheme($target)>="1")
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
	echo '<tr><td><b>No.</b></td><td><b>Name</b></td><td><b>Developer</b></td><td><b>Release Date</b></td><td><b>Version</b></td><td><b>Dashboard Insert</b></td><td><b>Admin Insert</b></td><td><b>Page Insert</b></td><td><b>Post Insert</b></td><td><b>Theme URL</b></td><td></td><td></td></tr>';
	for($a=0; $a<$num; $a++)
	{
		//array('num'=>$num,'id'=>$id,'name'=>$theme_name,'version'=>$theme_version,'update'=>$update_url,'developer'=>$theme_developer,'url'=>$theme_url,'DOR'=>$theme_date_of_release,'sidebar'=>$sidebar_feature,'menu'=>$menu_feature,'post'=>$post_feature,'page'=>$page_feature,'dashboard'=>$dashboard_feature,'admin'=>$admin_feature,'status'=>$active);
		$id = $selFunc[$a]["id"];
		$theme_name = $selFunc[$a]["name"];
		$theme_version = $selFunc[$a]["version"];
		$update_url = $selFunc[$a]["update"];
		$theme_url = $selFunc[$a]["url"];
		$active = $selFunc[$a]["status"]; 
		$theme_date_of_release = $selFunc[$a]["DOR"];
		$theme_developer = $selFunc[$a]["developer"];
		$sidebar_feature = $selFunc[$a]["sidebar"];
		$post_feature = $selFunc[$a]["post"];
		$page_feature = $selFunc[$a]["page"];
		$dashboard_feature = $selFunc[$a]["dashboard"];
		$admin_feature = $selFunc[$a]["admin"];
		$menu_feature = $selFunc[$a]["menu"];
		$activeID = $selFunc[$a]["activeID"];
		
		if($active=="Yes")
		{
			$activationLink = "?ref=3&segment=b1&function=deactivate&unit=3&id=".$activeID;
			$activationLinkWord = "Deactivate";
		}
		else
		{
			$activationLink = "?ref=3&segment=b1&function=activate&unit=3&id=".$activeID;
			$activationLinkWord = "Activate";
		}
			$theme_array = ThemeDetails();
			
			echo '<tr><td><b>'.($a+1).'.)</b></td><td>'.$theme_name.'</td><td>'.$theme_developer.'</td><td>'.$theme_date_of_release.'</td><td>'.$theme_version.'</td><td>'.$dashboard_feature.'</td><td>'.$admin_feature.'</td><td>'.$page_feature.'</td><td>'.$post_feature.'</td><td>'.$theme_url.'</td><td><a href="'.$activationLink.'">'.$activationLinkWord.'</a></td><td><a href="?ref=3&segment=b1&function=delete&unit=3&id='.$data.'">Delete</a></td></tr>';
	}
	echo '</table>'
	?>