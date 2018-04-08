<?php 

if(function_exists("addTerms"))
{
	
}
else
{
	function addTerms($value,$type="TERMS"){
		
		include_once "cnct.php";
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($type)."','".$value."','".md5("TERMS STATEMENT")."');";
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

if(function_exists("listTerms"))
{
	
}
else
{
	function listTerms($class=""){
		
		include_once "cnct.php";
		
		if($class=="")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("TERMS STATEMENT")."';";
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("TERMS STATEMENT")."' AND userid = '".md5($class)."';";
		}
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			
			$array[] = array('num'=>$num,'id'=>$id,'image'=>$data);
		}
		
		return $array;
		
	}
}

if(function_exists("deleteTerms"))
{
	
}
else
{
	function deleteTerms($type){
		
		include_once "cnct.php";
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5("TERMS STATEMENT")."' AND (userid = '".md5($type)."' OR id = '".$type."') ;";
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

if(function_exists("getTerms"))
{
	
}
else
{
	function getTerms($type=""){
		
		include_once "cnct.php";
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("TERMS STATEMENT")."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		if($type=="" || $type=="VIEW")
		{
			return $data;
		}
		elseif($type=="ID")
		{
			return $id;
		}
		return $data;
		
	}
}
	?>