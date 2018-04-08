<?php

if(function_exists("addNewsItem"))
{
	
}
else
{
	function addNewsItem($jtitle,$data,$longitude="",$latitude=""){
		
		include_once "cnct.php";
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$jtitle."','".$data."|".$longitude."|".$latitude."|".$jtitle."','".md5("PORTAL NEWS")."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

if(function_exists("getNewsItem"))
{
	
}
else
{
	function getNewsItem($JID,$type=""){
		
		include_once "cnct.php";
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL NEWS")."' AND id = '".$JID."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		$ex = explode("|",$data);
		
		if($type=="" || $type=="TITLE")
		{
			return $userid;
		}
		elseif($type=="DESCRIPTION")
		{
			return $ex[0];
		}
		elseif($type=="ID")
		{
			return $id;
		}
		elseif($type=="ITEM 1")
		{
			return $ex[1];
		}
		elseif($type=="ITEM 2")
		{
			return $ex[2];
		}
		elseif($type=="ITEM 3")
		{
			return $ex[3];
		}
	}
}

if(function_exists("listNews"))
{
	
}
else
{
	function listNews($contID=""){
		
		include_once "cnct.php";
		
		if($contID=="")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL NEWS")."';";
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL NEWS")."' AND id = '".$contID."';";
		}
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
		
			$ex = explode("|",$data);
			
			$array[] = array('num'=>$num,'id'=>$id,'title'=>$userid,'data'=>$ex[0],'item1'=>$ex[0],'item2'=>$ex[1],'item3'=>$ex[2],'item4'=>$ex[3]);
		}
		
		return $array;
	}
}

if(function_exists("deleteNewsItem"))
{
	
}
else
{
	function deleteNewsItem($CatID){
		
		include_once "cnct.php";
		
		$del = "DELETE FROM meta WHERE id = '".$CatID."';";
		//echo $del;
		$res = mysqli_query($db,$del);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

if(function_exists("deleteNews"))
{
	
}
else
{
	function deleteNews($CatClass){
		
		include_once "cnct.php";
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5("PORTAL NEWS")."';";
		$res = mysqli_query($db,$del);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}	
	}
}
?>