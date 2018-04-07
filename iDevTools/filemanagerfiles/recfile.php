<?php

$bn2 = 0;
$tf2 = $tf;

@$res2 = opendir($dirx);
while(false !== ($en2try2 = readdir($res2)))
{

	$en2 = explode(".",$en2try2);
	$countx = count($en2);


	if($countx>1)
	{
		$filename = "";
		for($f=0; $f<($countx-1); $f++)
		{
			if($f<$countx-2)
			{
			$filename .= $en2[$f].".";
			}
			else
			{
			$filename .= $en2[$f]."";
			}
		}

		$filetype = $en2[($countx-1)];
	}
	else
	{
	$filename = $en2[0];
	$filetype = $en2[1];
	}



	if(@opendir($dirx."/".$en2try2))
	{
	$file_dir = "folder";
	$tf2 = $tf2;
	}
	else
	{
		if(is_dir($en2try2))
		{
		$file_dir = "folder";
		$tf2 = $tf2;
		}
		else
		{
		$file_dir = "file";
		$tf2 = $tf2+1;

	echo '<input name="filename'.$tf2.'" value="'.$en2try2.'" type="hidden">';
	echo '<input name="type'.$tf2.'" value="'.$file_dir.'" type="hidden">';
		}
	}

	include_once "iDevTools/icons.php";

	if($file_dir == "file")
	{
		$en2try2x =  "<table><tr><td><img src='iDevTools/icons/".$icon."' width='20'></td><td>".$en2try2."</td></tr></table>";
		$bn2 = $bn2+1;
		$bnv2 = 1;

		if($_REQUEST["unitdir"])
		{
		$unitdir2 = $_REQUEST["unitdir"];
		}
		else
		{
		$unitdir2 = "";
		}

		$level_urls2 = "";

		for($o2=0; $o2<($_REQUEST["level"]+1); $o2++)
		{
			if($_REQUEST["level".$o2])
			{
			$level_urls2 .='&level'.$o2.'='.$_REQUEST["level".$o2]."";
			}
		}

		$editlink = "<a href='?ref=2&segment=&function=edit&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir2."&unitclass=".$filename."&type=".$filetype."&level=".$levels."".$level_urls2."&mode=php'>Edit</a>";
		$unziplink = "<a href='?ref=2&segment=&function=unzip&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir2."&unitclass=".$filename."&type=".$filetype."&level=".$levels."".$level_urls2."'>Unzip</a>";
		
		$renamelink = "<a href='?ref=2&segment=&function=rename&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir2."&unitclass=".$filename."&type=".$filetype."&level=".$levels."".$level_urls2."'>Rename</a>";
		$deletelink = "<a href='?ref=2&segment=&function=delete&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir2."&unitclass=".$filename."&type=".$filetype."&level=".$levels."".$level_urls2."'>Delete</a>";

		$gg = 0;	$hj = explode(".",($bn2/2));
		$d1 = $hj[0];
		$d2 = $hj[1];

		if($d2=="" || $d2=="0")
		{
		$bgcolor = "ffffff";
		}
		else
		{
		$bgcolor = "ffffff";
		}

		if($gg == 1)
		{
		$editlink = "";
		$deletelink = "";
		$renamelink = "";
		}


		if($filedownloadable=="Yes")
		{
		$imglink = "<a href='".$dirx."".$filename.".".$filetype."' target='_new'>";
		$imglink2 = "</a>";
		}
		else
		{
		$imglink = "";
		$imglink2 = "";
		}

		if($fileeditable=="Yes")
		{
		$editlink = $editlink;
		}
		else
		{
		$editlink = "";
		}

		if($fileunzipable=="Yes")
		{
		$unziplink = $unziplink;
		}
		else
		{
		$unziplink = "";
		}

		if($bnv2==1)
		{
		echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($bn2).") </td><td><span class='dir'>".$imglink."".$en2try2x."".$imglink2."</span></td><td align='center'>".$editlink." &nbsp;&nbsp;&nbsp;".$unziplink."</td><td align='center'>".$renamelink."</td><td align='center'>".$deletelink."</td><td><input name='delete".$tf2."' value='Yes' type='checkbox'></td></tr>";
		}
	}


}
closedir($res2);
?>