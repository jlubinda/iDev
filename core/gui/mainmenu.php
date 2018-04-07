<?php

if(function_exists('main_menu'))
{
	
}
else
{
	function main_menu($bor1,$bor2,$misc){
		
	include find_file("cnct.php");
	$selMn = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("MAIN MENU")."');";
	@@$resMn = mysqli_query($db,$selMn);
	@$num = mysqli_num_rows(@$resMn);
		if($num>="1")
		{
		@$rwM = mysqli_fetch_array(@$resMn);
		$menu_id = $rwM["userid"];
		$menu_title = $rwM["data"];

			$menu_items = "";
			$sel = "SELECT * FROM _menu WHERE pageid = '".$menu_id."' ORDER BY ordering ASC;";
			@$res = mysqli_query($db,$sel);
			@$nm = mysqli_num_rows(@$res);
			for($i=0; $i<$nm; $i++)
			{
				@$rw = mysqli_fetch_array(@$res);
				$id = $rw["id"];
				$name = $rw["name"];
				$title = $rw["title"];
				$url = $rw["url"];
				$mode = $rw["mode"];
				$order = $rw["order"];
				$misc = $rw["misc"];			
					if($mode)
					{
					$modex = "target='".$mode."'";
					}
					else
					{
					$modex = "";
					}
				$menu_items .= $bor1."<a href='".$url."' title='".$title."' ".$modex.">".$name."</a>".$bor2;
			}
			return $menu_items;
		}
		else
		{
			return "";
		}
		
		mysqli_close($db);
	}
}
?>