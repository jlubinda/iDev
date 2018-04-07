	if($_REQUEST["id"]=="1")
	{
		
	$array = $_FILES['galleryStyle']['tmp_name'];
	$typearray = $_FILES['galleryStyle']['type'];
	$namearray = $_FILES['galleryStyle']['name'];
	$fileComp = explode(".",$namearray);
	$gName = $_REQUEST["galleryname"];
	
	$selD = "SELECT * FROM meta WHERE userid = '".$_REQUEST["galleryname"]."' AND meta_data = '".md5("ALBUM-TYPES")."';";
	$resD = mysqli_query($db,$selD);
	@$numD = mysqli_query($db,$resD);
	
		$err = "";
		
		if($_REQUEST["submitBtn"]=="Install Album Style")
		{
			if($gName=="")
			{
			$err .= '<p align="center">You have not indicated a Album Style Name.</p>';
			}
			
			if($gName)
			{
				if(!(strtolower($fileComp[1])=="php"))
				{
				$err .= '<p align="center">This is not a PHP file. Please choose the correct file format and try again.</p>';
				}
			}
			
			if($numD>="1")
			{
			$err .= '<p align="center">This Style Name has already been registered.</p>';
			}
		}
		
		if($_REQUEST["submitBtn"]=="" || ($_REQUEST["submitBtn"]=="Install Album Style" && (!(strtolower($fileComp[1])=="php") || $gName=="" || $numD>="1")))
		{
			echo '<form action="" method="POST" enctype="multipart/form-data">';
			echo '<table align="center" id="tables_css5"width="500">';
			echo '<tr><td align="center"><br><b><u>Album Style Installation (Only PHP files allowed)</u></b><br><br></td></tr>';
			if($err)
			{
			echo '<tr><td align="center"><b>Error</b>'.$err.'<br></td></tr>';
			}
			echo '<tr><td align="center"><b>Style Name (Every entry must be unique)</b><br><input name="galleryname" type="text" size="30"><br><br></td></tr>';	
			echo '<tr><td align="center"><b>Select File (Only PHP files allowed)</b><br><input name="galleryStyle" id="fileToUpload" type="file"><input name="submitBtn" type="submit" value="Install Album Style"></td></tr>';	
			echo '</table>';
		}
		elseif($_REQUEST["submitBtn"]=="Install Album Style" && (strtolower($fileComp[1])=="php"))
		{
			
			$cccxA = md5(md5((date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s))." |A1| ".md5(rand(0, 999999999999999999999999))." |B1| ".md5($userID.$namearray)."".md5($fileComp[1].$array)."|C1| ".$_SESSION[SesUID()]." |D1| ");	
			$cccxB = md5(md5((date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s))." |A2| ".md5(rand(0, 999999999999999999999999))." |B2| ".md5($userID.$namearray)."".md5($fileComp[1].$array)."|C2| ".$_SESSION[SesUID()]." |D2| ");	
			
			$target = "plugins/slider/galleries/".$cccxA.".php";
			
			if(@move_uploaded_file($array, $target))
			{
				$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$gName."','".$cccxA."','".md5("ALBUM-TYPES")."');";
				$resIn = mysqli_query($db,$ins);
				if($resIn)
				{
				echo '<p align="center">Success. Your new Album Style has been uploaded.</p>';
				}
				else
				{
				echo '<p align="center">Error. Your new Album Style has not been uploaded.</p>';
				}
			}			
		}
	}
	elseif($_REQUEST["id"]=="2")
	{
			
	$array = $_FILES['galleryStyle']['tmp_name'];
	$typearray = $_FILES['galleryStyle']['type'];
	$namearray = $_FILES['galleryStyle']['name'];
	$fileComp = explode(".",$namearray);
	$gName = $_REQUEST["galleryname"];
	
	$selD = "SELECT * FROM meta WHERE userid = '".$gName."' AND meta_data = '".md5("GALLERY-TYPES")."';";
	$resD = mysqli_query($db,$selD);
	@$numD = mysqli_query($db,$resD);
	
		$err = "";
		
		if($_REQUEST["submitBtn"]=="Install Gallery Style")
		{
			if($gName=="")
			{
			$err .= '<p align="center">You have not indicated a gallery Style Name.</p>';
			}
			
			if($gName)
			{
				if(!(strtolower($fileComp[1])=="php"))
				{
				$err .= '<p align="center">This is not a PHP file. Please choose the correct file format and try again.</p>';
				}
			}
			
			if($numD>="1")
			{
			$err .= '<p align="center">This Style Name has already been registered.</p>';
			}
		}
		
		if($_REQUEST["submitBtn"]=="" || ($_REQUEST["submitBtn"]=="Install Gallery Style" && (!(strtolower($fileComp[1])=="php") || $gName=="" || $numD>="1")))
		{
			echo '<form action="" method="POST" enctype="multipart/form-data">';
			echo '<table align="center" id="tables_css5"width="500">';
			echo '<tr><td align="center"><br><b><u>Gallery Style Update (Only PHP files allowed)</u></b><br><br></td></tr>';
			if($err)
			{
			echo '<tr><td align="center"><b>Error</b>'.$err.'<br></td></tr>';
			}
			echo '<tr><td align="center"><b>Style Name (Every entry must be unique)</b><br><input name="galleryname" type="text" size="30"><br><br></td></tr>';	
			echo '<tr><td align="center"><b>Select File (Only PHP files allowed)</b><br><input name="galleryStyle" id="fileToUpload" type="file"><input name="submitBtn" type="submit" value="Install Gallery Style"></td></tr>';	
			echo '</table>';
		}
		elseif($_REQUEST["submitBtn"]=="Install Gallery Style" && (strtolower($fileComp[1])=="php"))
		{
			
			$cccxA = md5(md5((date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s))." |A1| ".md5(rand(0, 999999999999999999999999))." |B1| ".md5($userID.$namearray)."".md5($fileComp[1].$array)."|C1| ".$_SESSION[SesUID()]." |D1| ");	
			$cccxB = md5(md5((date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s))." |A2| ".md5(rand(0, 999999999999999999999999))." |B2| ".md5($userID.$namearray)."".md5($fileComp[1].$array)."|C2| ".$_SESSION[SesUID()]." |D2| ");	
			
			$target = "plugins/slider/galleries/".$cccxA.".php";
			
			if(@move_uploaded_file($array, $target))
			{
				$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$gName."','".$cccxA."','".md5("GALLERY-TYPES")."');";
				echo $ins;
				$resIn = mysqli_query($db,$ins);
				if($resIn)
				{
				echo '<p align="center">Success. Your new Gallery Style has been installed.</p>';
				}
				else
				{
				echo '<p align="center">Error. Your new Gallery Style has not been installed.</p>';
				}
			}			
		}
	}