<?php
echo "<table align='center' id='tables_css' width='99%'>";
echo "<tr>";
	echo "<td>";
		echo "<b>No.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Menu Name.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Links.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b></b>";
	echo "</td>";
	echo "<td>";
		echo "<b></b>";
	echo "</td>";
	echo "<td>";
		echo "<b></b>";
	echo "</td>";
	echo "<td>";
		echo "<b></b>";
	echo "</td>";
echo "</tr>";

	$menu_title1 = "MAIN MENU";
	$menu_title2 = "MENU2";
	$menu_title3 = "MENU3";
	$menu_title4 = "MENU4";
	$menu_title5 = "MENU5";
	$menu_title6 = "MENU6";
	$menu_title7 = "MENU7";
	$menu_title8 = "MENU8";
	
	$selTr3z = "SELECT * FROM meta WHERE (meta_data = '".md5($menu_title1)."') OR (meta_data = '".md5($menu_title2)."') OR (meta_data = '".md5($menu_title3)."') OR (meta_data = '".md5($menu_title4)."') OR (meta_data = '".md5($menu_title5)."') OR (meta_data = '".md5($menu_title6)."') OR (meta_data = '".md5($menu_title7)."') OR (meta_data = '".md5($menu_title8)."');";
	$resTr3z = mysqli_query($db,$selTr3z);
	@$numTr3z = mysqli_num_rows($resTr3z);
	for($f=0; $f<$numTr3z; $f++)
	{
	@$rowTr3z = mysqli_fetch_array($resTr3z);
	$id_nameXz = $rowTr3z["id"];
	$album_nameXz = $rowTr3z["data"];
	$menu_id = $rowTr3z["userid"];
	$menu_title = $rowTr3z["data"];	
	$menu_titleX = $rowTr3z["meta_data"];
	
	$selTr3z2 = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".$menu_titleX."');";
	$resTr3z2 = mysqli_query($db,$selTr3z2);
	$rowTr3z2 = mysqli_fetch_array($resTr3z2);
	$id_nameXz2 = $rowTr3z2["id"];
	$album_nameXz2 = $rowTr3z2["data"];
	$menu_id2 = $rowTr3z2["userid"];
	$menu_title2 = $rowTr3z2["data"];
	
		if($id_nameXz==$id_nameXz2)
		{
		$status = "Active";
		}
		else
		{
		$status = "<a href='?'>Click Here To Activate</a>";
		}

				
	echo "<tr>";
	echo "<td>";
		echo "";
	echo "</td>";
	echo "<td>";
		echo "";
	echo "</td>";
	echo "<td>";
	echo "<table width='600' id='tables_css3'><tr>";		
	echo "<td>";
		echo "<b></b>";
	echo "</td>";	
	echo "<td>";
		echo "<b>Link Name.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Link Title.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>URL.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Order.</b>";
	echo "</td>";
	echo "<td>";
		echo "<b>Misc.</b>";
	echo "</td><tr>";
		
		
		$menu_items = "";
		$sel = "SELECT * FROM _menu WHERE pageid = '".$menu_id."';";
		$res = mysqli_query($db,$sel);
		@$nm = mysqli_num_rows($res);
		for($i=0; $i<$nm; $i++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$name = $rw["name"];
			$title = $rw["title"];
			$url = $rw["url"];
			$mode = $rw["mode"];
			$order = $rw["order"];
			$misc = $rw["misc"];			
			$menu_items .= $bor1."<a href='?".$url."' title='".$title."'>".$name."</a>".$bor2;
			
		echo "<tr>";
			echo "<td>";
				echo (1+$i).")";
			echo "</td>";
			echo "<td>";
				echo $name;
			echo "</td>";
			echo "<td>";
				echo $title;
			echo "</td>";
			echo "<td>";
				echo $url;
			echo "</td>";
			echo "<td>";
				echo $order;
			echo "</td>";
			echo "<td>";
				echo $misc;
			echo "</td>";
		echo "</tr>";
		}
		echo "</table></td>";
		echo "<td>";
			echo $status;
		echo "</td>";
		echo "<td>";
			echo "<a href='?'>View</a>";
		echo "</td>";
		echo "<td>";
			echo "<a href='".$edit_url."'>Edit</a>";
		echo "</td>";
		echo "<td>";
			echo "<a href='?'>Delete</a>";
		echo "</td>";
	echo "</tr>";
	}
echo "</table>";
?>