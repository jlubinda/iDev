	$sel = "SELECT * FROM _sliders WHERE id = '".$_REQUEST["gid"]."'";
	$res = mysqli_query($db,$sel);
	@$rw = mysqli_fetch_array($res);
	$id = $rw["id"];
	$name = $rw["name"];
	$title = $rw["title"];
	$src = $rw["src"];
	//echo "<b>".$title."</b>";
	
		$selI = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$src."' AND meta_data = '".md5("USER-ALBUM")."');";
		$resI = mysqli_query($db,$selI);
		@$rwI = mysqli_fetch_array($resI);
		$uidI = $rwI["userid"];
		$targetI = $rwI["data"];
				
	if(!($_REQUEST["deleteBtn"]))
	{
	echo '<form action="" method="POST">';
		echo '<table width="700" align="center">';
			echo '<tr>';
				echo '<td>Are you sure you want to delete the gallery <b><i>'.$title.'</i></b> with all its contents? </td><td><input name="deleteBtn" value="Delete" type="submit"></td>';
			echo '</tr>';
		echo '</table>';
	echo '</form>';
	}
	elseif($_REQUEST["deleteBtn"]=="Delete")
	{
		
		$selI2 = "SELECT * FROM meta WHERE userid = '".$uidI."' AND meta_data = '".md5("ALBUM-IMAGE")."';";
		//echo $selI2."<br>";
		$resI2 = mysqli_query($db,$selI2);
		@$numI2 = mysqli_num_rows($resI2);
		$d=0;
		for($v=0; $v<$numI2; $v++)
		{
		@$rwI2 = mysqli_fetch_array($resI2);
		$imgx = $rwI2["data"];
		$idx = $rwI2["id"];	
		
		$target1 = "galleries/".$targetI."/thumb/".$imgx;
		$target2 = "galleries/".$targetI."/".$imgx;
		$target3 = "galleries/".$targetI."/thumb";
		$target4 = "galleries/".$targetI;
		
		if(file_exists($target1))
		{
			if(unlink($target1))
			{
			$delf1 = "OK";
			}
			else
			{
			$delf1 = "Error";
			}
		}
		else
		{
		$delf1 = "OK";
		}
		
		if(file_exists($target2))
		{
			if(unlink($target2))
			{
			$delf2 = "OK";
			}
			else
			{
			$delf2 = "Error";
			}
		}
		else
		{
		$delf2 = "OK";
		}
		
			if($delf1=="OK" && $delf2=="OK")
			{			
				$del1 = "DELETE FROM meta WHERE id = '".$idx."';";
				$res1 = mysqli_query($db,$del1);
				
				if($res1)
				{
				$d=$d+1;
				}
				else
				{
				$d=$d;
				}
			}
			else
			{
			$d=$d;
			}
		}
		
		@rmdir($target3);
		@rmdir($target4);
		
		if($numI2==$d)
		{
		
		$del2 = "DELETE FROM meta WHERE userid = '".$src."' AND meta_data = '".md5("USER-ALBUM")."';";
		$res2 = mysqli_query($db,$del2);
		
		$del3 = "DELETE FROM _sliders WHERE id = '".$_REQUEST["gid"]."';";
		$res3 = mysqli_query($db,$del3);
		
			if($res2 && $res3)
			{
			echo '<p align="center">Success! The album <b><i>'.$title.'</i></b> has been deleted.</p>';
			}
			else
			{
			echo '<p align="center">Sorry. There was an error while deleting the album.</p>';
			}
		}
		else
		{
		echo '<p align="center">Sorry. There was an error while deleting the album.</p>';
		}
		
		
	}