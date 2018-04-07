<?php 

if(function_exists('MOBILE_NETWORKS'))
{
	
}
else
{
	function MOBILE_NETWORKS($type="",$datax="",$class="",$rnumb=""){
		
		include find_file("cnct.php");
		
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (userid,data,meta_data,r_user) VALUES ('".$class."','".$datax."','".md5("MOBILE NETWORK")."','".$rnumb."');";
			$res = mysqli_query($db,$ins);
			
			//echo $ins;
			
			if($res)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		elseif($type=="DELETE")
		{
			$del = "DELETE FROM meta WHERE data = '".$datax."' AND meta_data = '".md5("MOBILE NETWORK")."';";
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
		else
		{
			if($type=="")
			{
				$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id)  FROM meta WHERE meta_data = '".md5("MOBILE NETWORK")."' GROUP BY userid);";
				//echo $sel;
				$res = mysqli_query($db,$sel);
				@$num = mysqli_num_rows($res);
				for($a=0; $a<$num; $a++)
				{
					@$rw = mysqli_fetch_array($res);
					$userid = $rw["userid"];
					$data = $rw["data"];
					$r_user = $rw["r_user"];

					$array[] = array('num'=>$num,'prefix'=>$userid,'name'=>$data,'resnumb'=>$r_user);
				}
				
				return $array;
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE id = (SELECT max(id)  FROM meta WHERE meta_data = '".md5("MOBILE NETWORK")."');";
				$res = mysqli_query($db,$sel);
				@$rw = mysqli_fetch_array($res);
				$data = $rw["data"];
				
				return $data;
			}
		}
		
		mysqli_close($db);	
	}

}
 

if(function_exists('MOBILE_NETWORK'))
{
	
}
else
{
	function MOBILE_NETWORK($type="",$datax=""){
		
		include find_file("cnct.php");

		if($datax=="")
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id)  FROM meta WHERE meta_data = '".md5("MOBILE NETWORK")."');";
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id)  FROM meta WHERE meta_data = '".md5("MOBILE NETWORK")."' AND userid = '".$datax."');";
		}
		
		$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array($res);
		$userid = $rw["userid"];
		$data = $rw["data"];
		$r_user = $rw["r_user"];
		
		if($type=="PREFIX")
		{
			return $userid;
		}
		elseif($type=="NAME")
		{
			return $data;
		}
		elseif($type=="RESPONSE NUMBER")
		{
			return $r_user;
		}
		
		mysqli_close($db);	
	}
}
?>