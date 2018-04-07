<?php

$bn = 0;
$tf = 0;

@$res = opendir($dirx);
while(false !== ($entry = readdir($res)))
{

	$en = explode(".",$entry);
	$countx = count($en);


	if($countx>1)
	{
		$filename = "";
		for($f=0; $f<($countx-1); $f++)
		{
			if($f<$countx-2)
			{
			$filename .= $en[$f].".";
			}
			else
			{
			$filename .= $en[$f]."";
			}
		}

		$filetype = $en[($countx-1)];
	}
	else
	{
	$filename = $en[0];
	$filetype = $en[1];
	}



	if(@opendir($dirx."/".$entry))
	{
	$file_dir = "folder";
	$tf = $tf+1;

	echo '<input name="filename'.$tf.'" value="'.$entry.'" type="hidden">';
	echo '<input name="type'.$tf.'" value="'.$file_dir.'" type="hidden">';
	}
	else
	{
		if(is_dir($entry))
		{
		$tf = $tf+1;
		$file_dir = "folder";

	echo '<input name="filename'.$tf.'" value="'.$entry.'" type="hidden">';
	echo '<input name="type'.$tf.'" value="'.$file_dir.'" type="hidden">';
		}
		else
		{
		$tf = $tf;
		$file_dir = "file";
		}
	}

	include_once "iDevTools/icons.php";

	if($file_dir == "folder")
	{
		$bn = $bn+1;
		$bnv = 1;

		if($_REQUEST["unitdir"])
		{
		$unitdir = $_REQUEST["unitdir"];
		}
		else
		{
		$unitdir = $entry;
		}


		$level_urls = "";

		for($o=0; $o<($_REQUEST["level"]+1); $o++)
		{
			if($_REQUEST["level".$o])
			{
			$level_urls .='&level'.$o.'='.$_REQUEST["level".$o]."";
			}
		}

		$editlink = "";
		$unziplink = "";
		
		$renamelink = "<a href='?ref=2&segment=&function=rename&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$filename."&type=folder&level=".$levels."".$level_urls."'>Rename</a>";
		$deletelink = "<a href='?ref=2&segment=&function=delete&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$filename."&type=folder&level=".$levels."".$level_urls."'>Delete</a>";

		if(!$_REQUEST["unitclass"] && ($entry == ".." || $entry == "."))
		{
		$bnv = 0;
		$gg = 1;
		}
		else
		{
			if($entry == "..")
			{
				$level_urls = "";

				for($o=0; $o<($_REQUEST["level"]+1); $o++)
				{
					if($_REQUEST["level".$o])
					{
					$level_urls .='&level'.$o.'='.$_REQUEST["level".$o]."";
					}
				}

				$bnv = 0;
				$entryx = "<table><tr><td><a href='?ref=2&segment=&function=list&unit=".$_REQUEST["unit"]."&unitdir=&unitclass=&level=".($levels-1)."".$level_urls."'><img src='iDevTools/icons/".$icon."' width='20'></a></td><td><a href='?ref=2&segment=&function=list&unit=".$_REQUEST["unit"]."&unitdir=&unitclass=&level=".($levels-1)."".$level_urls."'>".$entry."</a></td></tr></table>";
				$gg = 1;
			}
			else
			{
				if($entry == ".")
				{
				$bnv = 0;
				}
				else
				{
				$bnv = 1;

					for($o=0; $o<$levelsx; $o++)
					{
						if($o==0)
						{
							if(!$_REQUEST["level".$o])
							{
							$level_urls = '&level'.$o.'='.$entry."";
							}
							else
							{
							$level_urls = '&level'.$o.'='.$_REQUEST["level".$o]."";
							}
						}
						else
						{
							if($_REQUEST["level".($o-1)])
							{
								if(!$_REQUEST["level".$o])
								{
								$level_urls .='&level'.$o.'='.$entry."";
								}
								else
								{
								$level_urls .= '&level'.$o.'='.$_REQUEST["level".$o]."";
								}
							}
						}
					}
					$entryx = "<table><tr><td><a href='?ref=2&segment=&function=list&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$entry."&level=".($levels+1)."".$level_urls."'><img src='iDevTools/icons/".$icon."' width='20'></a></td><td><a href='?ref=2&segment=&function=list&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$entry."&level=".($levels+1)."".$level_urls."'><span class='dir2'>".$entry."</span></a></td></tr></table>";
				}
				$gg = 0;
			}
		}
		
		$hj = explode(".",($bn/2));
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

		if($bnv==1)
		{
		echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'> </td><td><span class='dir'>".$imglink."".$entryx."".$imglink2."</span></td><td align='center'>".$editlink." &nbsp;&nbsp;&nbsp;".$unziplink."</td><td align='center'>".$renamelink."</td><td align='center'>".$deletelink."</td><td><input name='delete".$tf."' value='Yes' type='checkbox'></td></tr>";
		}
	}

	
}
closedir($res);
?>