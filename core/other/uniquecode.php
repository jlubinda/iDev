<?php 

if(function_exists('uniqueCode'))
{
	
}
else
{
	function uniqueCode($type="GENERATE ONLY",$userid="",$delimiter="",$sessionID=""){

	include find_file("cnct.php");

		@$year = date(Y);
		@$day = date(z);
		@$hour = date(G);
		@$hour2 = date(h);
		@$mins = date(i);
		@$sec = date(s);

		$sess_id = rand(0, 9999999999998);
		$sess_id2 = rand(9999999999999, 999999999999999999998);
		$sess_id3 = rand(999999999999999999999, 99999999999999999999999999999999999);

		$timex = currentTimeInSeconds();
		
			$cccA = md5($timex." |".$userid."| ".$sess_id." |".$delimiter."| ".$sess_id2." |".$sessionID."| ".$sess_id3);
		
		if($type=="GENERATE ONLY")
		{
			return $cccA;
		}
		elseif($type=="GENERATE AND SAVE")
		{
			$cccA = md5($timex." |".$userid."| ".$sess_id." |".$delimiter."| ".$sess_id2." |".$sessionID."| ".$sess_id3);
		
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($userid)."','".$cccA."','".md5('GENERATED UNIQUE CODE')."');";
			@$res = mysqli_query($db,$ins);
			
			if(@$res)
			{
				return $cccA;
			}
			else
			{
				return 0;
			}
		}
		elseif($type=="RETRIEVE")
		{
			$sel1 = "SELECT * FROM meta WHERE id = (SELECT MAX(id) as maxID FROM meta WHERE meta_data = '".md5('GENERATED UNIQUE CODE')."' AND userid='".$userid."');";
			@$res1 = mysqli_query($db,$sel1);
			@$num1 = mysqli_num_rows(@$res1);
			@$rw1 = mysqli_fetch_array(@$res1);
			
			return $rw1["data"];
		}
		elseif($type=="COMPARE")
		{
			$sel1 = "SELECT * FROM meta WHERE id = (SELECT MAX(id) as maxID FROM meta WHERE meta_data = '".md5('GENERATED UNIQUE CODE')."' AND userid='".$userid."');";
			@$res1 = mysqli_query($db,$sel1);
			@$num1 = mysqli_num_rows(@$res1);
			@$rw1 = mysqli_fetch_array(@$res1);
			
			if($delimiter==$rw1["data"])
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('unique_multidim_array'))
{
	
}
else
{
	function unique_multidim_array($array, $key="") { 
		$temp_array = array(); 
		$i = 0; 
		$key_array = array(); 
		
		if($key=="")
		{
			$key==$i;
		}
		else
		{
			$key = $key;
		}
		
		foreach($array as $val) { 
			if (!in_array($val[$key], $key_array)) { 
				$key_array[$i] = $val[$key]; 
				$temp_array[$i] = $val; 
			} 
			$i++; 
		} 
		return $temp_array; 
	}
}
?>