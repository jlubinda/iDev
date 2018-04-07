 <?php
 if(chkSes()=="Inactive")
{

} 
else 
{
?><table id='search_fieldx'><tr>
<td width="450">
	<div id="tier3">
				<?php
				
	$levels = $_REQUEST["level"];
	$levelsx = $_REQUEST["level"]+1;
	$level_urls = '';
	$level_urlsx = '';
	
echo "<div><table id='segment_nav_head'><tr><td align='center'>";

	if(!$_REQUEST["level"])
	{
	$dirxx = "<span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list'>CSS</a></span>/";
	}
	else
	{
		for($ov=0; $ov<($levelsx); $ov++)
		{
		
			
		for($ox=0; $ox<($ov+1); $ox++)
		{
			if($_REQUEST["level".$ox])
			{
			$level_urlsx .='&level'.$ox.'='.$_REQUEST["level".$ox]."";
			}
		}
			if(($ov)==0)
			{
			$rootx = "<span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list'>CSS</a></span>";
			}
			else
			{
			$rootx = "";
			}
			
				if($_REQUEST["level".$ov])
				{
				$dirxx .= $rootx."/<span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&level=".($ov+1)."&".$level_urlsx."'>".$_REQUEST["level".$ov]."</a></span>";
				}
				else
				{
				$dirxx .= "";
				}
		}
	}
		
		
	echo "".$dirxx."<br>";
	
echo "</td></tr></table></div>";
				?>
	</div>
	</td></tr>
</table>
<?php
if($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="e1")
{

	$levels = $_REQUEST["level"];
	$levelsx = $_REQUEST["level"]+1;
	$level_urls = '';
	
	//echo "Levels: ".$levels."<br>";
	//echo "Level URL: ".$level_urls."<br>";
	
	
	//$dirx = ".";
	$root_dir = "site";
	
	if(!$_REQUEST["level"])
	{
	$dirx = $root_dir;
	}
	else
	{
	$dirx = $root_dir;
	
		for($o=0; $o<($levels); $o++)
		{
				if($_REQUEST["level".$o])
				{
				$dirx .= "/".$_REQUEST["level".$o]."";
				}
				else
				{
				$dirx .= "";
				}
		}
	}

	
  if($_REQUEST["function"]=="list")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		include_once "dirlist.php";
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
  }
  elseif($_REQUEST["function"]=="edit")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
	
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
			
			
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				$selurl = $dirx."/";
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				$selurl = $dirx."/";
				}			
				
			echo "<p align='center'>".$sel."</p>";
			
		if(!$_REQUEST["submitBtn"])
		{
			?>
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="left"><textarea name="newName" rows='20' cols='150'><?php
					/*Open handle to file */
$fp = fopen($sel, 'r', TRUE);
/* Read all lines and print them */
while (!feof($fp)) {
$line = trim(fgets($fp, 512));
echo "$line\n";
}
/* Close the stream handle */
fclose($fp);
					?></textarea></td>
				</tr>
				<tr>
					<td align="center"><input name="submitBtn" type="submit" value="Save"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Save")
		{
			/*
				if(!$_REQUEST["unitdir"])
				{
				$sel = "mis/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = "mis/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
				else
				{
				$sel = "mis/".$_REQUEST["unitdir"]."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = "mis/".$_REQUEST["unitdir"]."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}	*/		
				
				$fp = fopen($sel, "w", 1);
$filelock = flock($fp, 2); // lock the file for writing
$rename = fwrite($fp, $_REQUEST["newName"]);
$fileunlock = flock($fp, 3); // release write lock
fclose($fp);
			

			//echo $_REQUEST["type"]." - type<br>";
			
			if($rename)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
			
			echo "<p align='center'><a href=''>Back</a></p>";
		}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
  }
  elseif($_REQUEST["function"]=="unzip")
  {
  
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/";
			
			
			
$zip = new ZipArchive;
if ($zip->open($sel) === TRUE) {
    $zip->extractTo($sel2);
    $zip->close();
    echo '<p align="center">Success!</p>';
} else {
    echo '<p align="center">Error!</p>';
}

  }
  elseif($_REQUEST["function"]=="multidelete")
  {
	$oc = 0;
		for($oc1=0; $oc1<$_REQUEST["numfiles"]; $oc1++)
		{	
		$oc = $oc+1;
		  if($_REQUEST["delete".$oc]=="Yes")
		  {
			if($_REQUEST["type".$oc]=="folder")
			{
				$sel = $dirx."/".$_REQUEST["filename".$oc];
				
				$rename = rmdir($sel);
			}
			else
			{
				$sel = $dirx."/".$_REQUEST["filename".$oc];
				
				$rename = unlink($sel);
			}

			
			if($rename)
			{
			echo "<p align='center'>Successfully deleted ".$_REQUEST["filename".$oc]."!</p>";
			}
			else
			{
			echo "<p align='center'>Error deleting ".$_REQUEST["filename".$oc]."!</p>";
			}
		  }
		}
  }
  elseif($_REQUEST["function"]=="rename")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		if(!$_REQUEST["submitBtn"])
		{
			if($_REQUEST["type"]=="folder")
			{
			$typedis = "folder ";
			$namedis = $_REQUEST["unitclass"];
			}
			else
			{
			$typedis = $_REQUEST["type"]." file ";
			$namedis = $_REQUEST["unitclass"].".".$_REQUEST["type"];
			}
			?>
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center">Provide a new name for the <?php echo $typedis; ?> '<?php echo $namedis; ?>' <input name="newName" type="text" size="25"><input name="submitBtn" type="submit" value="Rename"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Rename")
		{
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
			<form action="" method="POST">
			<input name="newName" type="hidden" value="<?php echo $_REQUEST["newName"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center">Confirm the renaming of the <?php echo $typedis; ?> '<?php echo $namedis; ?>' to '<?php echo $namedis2; ?>' <input name="submitBtn" type="submit" value="Confirm"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm")
		{
			
			if(!$_REQUEST["type"]=="folder")
			{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
			}
			else
			{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
				else
				{
				$sel = $dirx."/";
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}
			}
			
			$rename = rename($sel,$sel2);
			
			if($rename)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
		}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
  }
  elseif($_REQUEST["function"]=="delete")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		if(!$_REQUEST["submitBtn"])
		{
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
			<form action="" method="POST">
			<input name="newName" type="hidden" value="<?php echo $_REQUEST["newName"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center">Confirm the deleting of the <?php echo $typedis; ?> '<?php echo $namedis; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Delete")
		{
			
			if($_REQUEST["type"]=="folder")
			{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}			
				
				$rename = rmdir($sel);
			}
			else
			{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}			
				
				$rename = unlink($sel);
			}

			//echo $_REQUEST["type"]." - type<br>";
			
			if($rename)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
		}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
  }
  elseif($_REQUEST["function"]=="upload")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		//if(!$_REQUEST["submitBtn"])
		//{
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
		//}
		
		if($_REQUEST["submitBtn"]=="Upload")
		{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				$sel2x = $dirx."/";
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				$sel2x = $dirx."/";
				}		

 $target = $sel2x; 
 $target = $target . basename( $_FILES['newName']['name']) ;
 
 if(move_uploaded_file($_FILES['newName']['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded";
 $rename = "success";
 } 
 else 
 {
 echo "Sorry, there was a problem uploading your file.";
 $rename = "";
 }
			
			if($rename)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
		}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
  }
  elseif($_REQUEST["function"]=="create_file")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		if(!$_REQUEST["submitBtn"])
		{
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
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center"><input name="newName" type="text" size="30"> <input name="submitBtn" type="submit" value="Create"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Create")
		{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitdir"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}		
				
				$rename = fopen($sel2,"w", TRUE);
				fclose($rename);

			//echo $_REQUEST["type"]." - type<br>";
			
			if($rename)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
		}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
  }
  elseif($_REQUEST["function"]=="create_folder")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		if(!$_REQUEST["submitBtn"])
		{
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
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center"><input name="newName" type="text" size="30"> <input name="submitBtn" type="submit" value="Create"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Create")
		{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitdir"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}			
				
				$rename = mkdir($sel2);

			//echo $_REQUEST["type"]." - type<br>";
			
			if($rename)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
		}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
  }
}

}
?>