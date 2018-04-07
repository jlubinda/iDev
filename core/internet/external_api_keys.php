<?php

if(function_exists('GoogleAPIKeys'))
{
	
}
else
{
	function GoogleAPIKeys($type,$class="",$datax=""){
		
		include find_file("cnct.php");
		
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (userid,data,meta_data) VALUES ('".uniqueCode()."','".$datax."|".$class."','".md5("GOOGLE API KEYS")."');";
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
		else
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id)  FROM meta WHERE meta_data = '".md5("GOOGLE API KEYS")."');";
			$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array($res);
			$data = $rw["data"];
			$x = explode("|",$data);
			if($type=="SERVER KEY")
			{
			  return $x[0];
			}
			elseif($type=="BROWSER KEY")
			{
			  return $x[1];
			}
		}
		
		mysqli_close($db);	
	}
}
?>