<?php 

if(function_exists('UserBar'))
{
	
}
else
{
	function UserBar($a)
	{

	include find_file("cnct.php");
	include "mis/priv.php";

		$t = explode("|",$a);
		$count = count($t);
		for($r=1; $r<$count+1; $r++)
		{
			if($t[$r]=="AdminBar0001")
			{
			
			}
			else
			{			
				$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$t[$r]."';";
				@$resX = mysqli_query($db,$selX);
				$rwX = mysqli_fetch_array(@$resX);
				$activeID = $rwX["id"];
				$active = $rwX["data"];
				
				if($active=="Yes")
				{
					$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$t[$r]."';";
					@$resX1 = mysqli_query($db,$selX1);
					$rwX1 = mysqli_fetch_array(@$resX1);	
					$plugin_url = $rwX1["data"];
					
					$selX2 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-NAME")."' AND meta_data = '".$t[$r]."';";
					@$resX2 = mysqli_query($db,$selX2);
					$rwX2 = mysqli_fetch_array(@$resX2);
					$plugin_name = $rwX2["data"];
					
					$selX3 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DEVELOPER")."' AND meta_data = '".$t[$r]."';";
					@$resX3 = mysqli_query($db,$selX3);
					$rwX3 = mysqli_fetch_array(@$resX3);
					$plugin_developer = $rwX3["data"];
					
					$selX4 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DATE-OF-RELEASE")."' AND meta_data = '".$t[$r]."';";
					@$resX4 = mysqli_query($db,$selX4);
					$rwX4 = mysqli_fetch_array(@$resX4);
					$plugin_date_of_release = $rwX4["data"];
					
					$selX5 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-VERSION")."' AND meta_data = '".$t[$r]."';";
					@$resX5 = mysqli_query($db,$selX5);
					$rwX5 = mysqli_fetch_array(@$resX5);
					$plugin_version = $rwX5["data"];
					
					$selX6 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-UPDATE-URL")."' AND meta_data = '".$t[$r]."';";
					@$resX6 = mysqli_query($db,$selX6);
					$rwX6 = mysqli_fetch_array(@$resX6);
					$update_url = $rwX6["data"];
					
					$selX7 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-SIDEBAR")."' AND meta_data = '".$t[$r]."' AND data = 'Yes';";
					@$resX7 = mysqli_query($db,$selX7);
					$rwX7 = mysqli_fetch_array(@$resX7);
					$sidebar_feature = $rwX7["data"];
				
					$selX8 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-MENU")."' AND meta_data = '".$t[$r]."' AND data = 'Yes';";
					@$resX8 = mysqli_query($db,$selX8);
					$rwX8 = mysqli_fetch_array(@$resX8);
					$menu_feature = $rwX8["data"];
								
					$selX9 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-POST-FEATURE")."' AND meta_data = '".$t[$r]."' AND data = 'Yes';";
					@$resX9 = mysqli_query($db,$selX9);
					$rwX9 = mysqli_fetch_array(@$resX9);
					$post_feature = $rwX9["data"];
					
					$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$t[$r]."' AND data = 'Yes';";
					@$resX10 = mysqli_query($db,$selX10);
					$rwX10 = mysqli_fetch_array(@$resX10);
					$page_feature = $rwX10["data"];
						
					
					if($sidebar_feature=="Yes")
					{
					echo "<tr>";
						echo "<td><b>".$plugin_name.":</b></td>";
					echo "</tr>";
					}
				}
			}
		}
		
		mysqli_close($db);
	}
}
?>