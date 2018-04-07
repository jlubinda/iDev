<?php

 if(chkSes()=="Inactive")
{

} 
else 
{	
	@$res = opendir($dirx);		
	$uploadlink = "<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=edit&unit=".$_REQUEST["unit"]."&unitclass=".$_REQUEST["unitclass"]."'>Edit</a>";
	$level_urls = "";
	
		for($o=0; $o<($_REQUEST["level"]+1); $o++)
		{
			if($_REQUEST["level".$o])
			{
			$level_urls .='&level'.$o.'='.$_REQUEST["level".$o]."";
			}
		}
		
		echo "<form action ='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=multidelete' method='post'><table align='center' width='900' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td><u><b>Name</b></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=upload&unit=".$_REQUEST["unit"]."&unitdir=".$_REQUEST["unitdir"]."&unitclass=".$_REQUEST["unitclass"]."&type=".$_REQUEST["type"]."&level=".$levels."".$level_urls."'>Upload File</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=create_file&unit=".$_REQUEST["unit"]."&unitdir=".$_REQUEST["unitdir"]."&unitclass=".$_REQUEST["unitclass"]."&type=".$_REQUEST["type"]."&level=".$levels."".$level_urls."'>Create Page</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=create_folder&unit=".$_REQUEST["unit"]."&unitdir=".$_REQUEST["unitdir"]."&unitclass=".$_REQUEST["unitclass"]."&type=".$_REQUEST["type"]."&level=".$levels."".$level_urls."'>Create Folder</a></td><td width='80'><u><b></b></u></td><td width='80'><u><b></b></u></td><td width='80'><u><b></b></u></td><td><b><u><input type='submit' name='deleteBtn' value='Delete'></u></b></td></tr>";
			
			
			echo '<input name="level" value="'.$_REQUEST["level"].'" type="hidden">';
			
			
	$level_urlsx = "";
	
		for($oc=0; $oc<($_REQUEST["level"]+1); $oc++)
		{
			if($_REQUEST["level".$oc])
			{
			$level_urlsx .='<input name="level'.$oc.'" value="'.$_REQUEST["level".$oc].'" type="hidden">';
			}
		}
		
		echo $level_urlsx;
		
			$bn = 0;
			$tf = 0;
			//$objDir = opendir($res);
			while(false !== ($entry = readdir($res)))
			{
			$tf = $tf+1;
			
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
			}
			else
			{
				if(is_dir($entry))
				{
				$file_dir = "folder";
				}
				else
				{
				$file_dir = "file";
				}
			}
			
			echo '<input name="filename'.$tf.'" value="'.$entry.'" type="hidden">';
			echo '<input name="type'.$tf.'" value="'.$file_dir.'" type="hidden">';
			
			include_once "iDevTools/icons.php";
		
				if($file_dir == "file")
				{
				$entryx =  "<table><tr><td><img src='iDevTools/icons/".$icon."' width='20'></td><td>".$entry."</td></tr></table>";
				$bn = $bn+1;
				$bnv = 1;
			
			if($_REQUEST["unitdir"])
			{
			$unitdir = $_REQUEST["unitdir"];
			}
			else
			{
			$unitdir = "";
			}
					
	$level_urls = "";
	
		for($o=0; $o<($_REQUEST["level"]+1); $o++)
		{
			if($_REQUEST["level".$o])
			{
			$level_urls .='&level'.$o.'='.$_REQUEST["level".$o]."";
			}
		}
		
				$editlink = "<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=edit&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$filename."&type=".$filetype."&level=".$levels."".$level_urls."'>Edit</a>";
				$unziplink = "<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=unzip&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$filename."&type=".$filetype."&level=".$levels."".$level_urls."'>Unzip</a>";
				$renamelink = "<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=rename&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$filename."&type=".$filetype."&level=".$levels."".$level_urls."'>Rename</a>";
				$deletelink = "<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=delete&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$filename."&type=".$filetype."&level=".$levels."".$level_urls."'>Delete</a>";
				
				$gg = 0;
				}
				else
				{
			
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
				$renamelink = "<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=rename&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$filename."&type=folder&level=".$levels."".$level_urls."'>Rename</a>";
				$deletelink = "<a href='?ref=3&segment=".$_REQUEST["segment"]."&function=delete&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$filename."&type=folder&level=".$levels."".$level_urls."'>Delete</a>";
				
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
						$entryx = "<table><tr><td><a href='?ref=3&segment=".$_REQUEST["segment"]."&function=list&unit=".$_REQUEST["unit"]."&unitdir=&unitclass=&level=".($levels-1)."".$level_urls."'><img src='iDevTools/icons/".$icon."' width='20'></a></td><td><a href='?ref=3&segment=".$_REQUEST["segment"]."&function=list&unit=".$_REQUEST["unit"]."&unitdir=&unitclass=&level=".($levels-1)."".$level_urls."'>".$entry."</a></td></tr></table>";
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
							$bn = $bn+1;
							$bnv = 1;
							$entryx = "<table><tr><td><a href='?ref=3&segment=".$_REQUEST["segment"]."&function=list&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$entry."&level=".($levels+1)."".$level_urls."'><img src='iDevTools/icons/".$icon."' width='20'></a></td><td><a href='?ref=3&segment=".$_REQUEST["segment"]."&function=list&unit=".$_REQUEST["unit"]."&unitdir=".$unitdir."&unitclass=".$entry."&level=".($levels+1)."".$level_urls."'><span class='dir2'>".$entry."</span></a></td></tr></table>";
							}
						$gg = 0;
						}
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
		$imglink = "<a href='".$dirx."/".$filename.".".$filetype."' target='_new'>";
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
				echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($bn).") </td><td><span class='dir'>".$imglink."".$entryx."".$imglink2."</span></td><td align='center'>".$editlink." &nbsp;&nbsp;&nbsp;".$unziplink."</td><td align='center'>".$renamelink."</td><td align='center'>".$deletelink."</td><td><input name='delete".$tf."' value='Yes' type='checkbox'></td></tr>";
				}
			}
			echo '<input name="numfiles" value="'.$tf.'" type="hidden">';
			echo "</table><br></form>";
			closedir($res);
}
?>