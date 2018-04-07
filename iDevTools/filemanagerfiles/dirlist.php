<?php

 if(chkSes()=="Inactive")
{

} 
else 
{	
		
	$uploadlink = "<a href='?ref=2&segment=&function=edit&unit=".$_REQUEST["unit"]."&unitclass=".$_REQUEST["unitclass"]."&mode=php'>Edit</a>";
		
	$level_urls = "";
	
		for($o=0; $o<($_REQUEST["level"]+1); $o++)
		{
			if($_REQUEST["level".$o])
			{
			$level_urls .='&level'.$o.'='.$_REQUEST["level".$o]."";
			}
		}
		
		echo "<form action ='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=multidelete' method='post'><table align='center' width='900' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td><u><b>Name</b></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=2&segment=&function=upload&unit=".$_REQUEST["unit"]."&unitdir=".$_REQUEST["unitdir"]."&unitclass=".$_REQUEST["unitclass"]."&type=".$_REQUEST["type"]."&level=".$levels."".$level_urls."'>Upload File</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=2&segment=&function=create_file&unit=".$_REQUEST["unit"]."&unitdir=".$_REQUEST["unitdir"]."&unitclass=".$_REQUEST["unitclass"]."&type=".$_REQUEST["type"]."&level=".$levels."".$level_urls."'>Create File</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=2&segment=&function=create_folder&unit=".$_REQUEST["unit"]."&unitdir=".$_REQUEST["unitdir"]."&unitclass=".$_REQUEST["unitclass"]."&type=".$_REQUEST["type"]."&level=".$levels."".$level_urls."'>Create Folder</a></td><td width='80'><u><b></b></u></td><td width='80'><u><b></b></u></td><td width='80'><u><b></b></u></td><td><b><u><input type='submit' name='deleteBtn' value='Delete'></u></b></td></tr>";
			
			
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
		
			//$objDir = opendir($res);
			include_once "recdir.php";
			include_once "recfile.php";
			echo '<input name="numfiles" value="'.($tf2).'" type="hidden">';
			echo "</table><br></form>";
}
?>