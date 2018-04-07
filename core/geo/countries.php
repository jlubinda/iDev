<?php

if(function_exists("getLocationDetails"))
{
	
}
else
{
	function getLocationDetails($town,$country="Zambia"){
		
	$formattedAddrFrom = str_replace(' ','+',$town.", ".$country);
	$gmaps_search = 'https://maps.google.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.GoogleAPIKeys("BROWSER KEY");

	//echo "G-Maps Seach: ".$gmaps_search."<br><br>";
		
		$array = array();
		//Send request and receive json data
		$geocodeFrom = file_get_contents($gmaps_search);
		//echo "JSON: ".$geocodeFrom."<br><br>";
		$outputFrom = json_decode($geocodeFrom);
		
	//echo "G-Maps latitude: ".$outputFrom->results[0]->geometry->location->lat;
	//echo "<br><br>";

		//Get latitude and longitude from geo data
		$array['latitude'] = $outputFrom->results[0]->geometry->location->lat;
		$array['longitude'] = $outputFrom->results[0]->geometry->location->lng;
		$array['formatted_address'] = $outputFrom->results[0]->formatted_address;

		$b=0;
		while(isset($outputFrom->results[0]->address_components[$b]->types[0]))
		{
			$b = $b+1;
			$a = $b-1;
			
			if($outputFrom->results[0]->address_components[$a]->types[0]=="country" && $outputFrom->results[0]->address_components[$a]->types[1]=="political")
			{
				$array['country'] = $outputFrom->results[0]->address_components[$a]->long_name;
			}
			elseif($outputFrom->results[0]->address_components[$a]->types[0]=="administrative_area_level_1" && $outputFrom->results[0]->address_components[$a]->types[1]=="political")
			{
				$array['province'] = $outputFrom->results[0]->address_components[$a]->long_name;
			}
			elseif($outputFrom->results[0]->address_components[$a]->types[0]=="locality" && $outputFrom->results[0]->address_components[$a]->types[1]=="political")
			{
				$array['town'] = $outputFrom->results[0]->address_components[$a]->long_name;
			}
			elseif($outputFrom->results[0]->address_components[$a]->types[0]=="political" && $outputFrom->results[0]->address_components[$a]->types[1]=="sublocality")
			{
				$array['sublocality'] = $outputFrom->results[0]->address_components[$a]->long_name;
			}
			elseif($outputFrom->results[0]->address_components[$a]->types[0]=="establishment" && $outputFrom->results[0]->address_components[$a]->types[1]=="point_of_interest")
			{
				$array['establishment'] = $outputFrom->results[0]->address_components[$a]->long_name;
			}
			elseif($outputFrom->results[0]->address_components[$a]->types[0]=="neighborhood" && $outputFrom->results[0]->address_components[$a]->types[1]=="political")
			{
				$array['neighborhood'] = $outputFrom->results[0]->address_components[$a]->long_name;
			}
			elseif($outputFrom->results[0]->address_components[$a]->types[0]=="route" && !(isset($outputFrom->results[0]->address_components[$a]->types[1])))
			{
				$array['route'] = $outputFrom->results[0]->address_components[$a]->long_name;
			}
		}
		
		return $array;
	}
}
 

if(function_exists('country'))
{
	
}
else
{
	function country($country,$sect,$type="",$data=""){
		
		include find_file("cnct.php");
			
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5(strtolower($country))."','".$data."','".md5("COUNTRY SETTINGS ".strtoupper($sect))."');";
			@@$res = mysqli_query($db,$ins);
			
			if(@$res)
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
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".md5(strtolower($country))."' AND meta_data = '".md5("COUNTRY SETTINGS ".strtoupper($sect))."');";
			@$res = mysqli_query($db,$sel);
			if(@$res)
			{
				@$rw = mysqli_fetch_array(@$res);
				return $rw["data"];
			}
			else
			{
				return "";
			}
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('currentCurrency'))
{
	
}
else
{
	function currentCurrency(){
		if(isset($_SESSION['currency']) && !($_SESSION['currency']==""))
		{
			return $_SESSION['currency'];
		}
		else
		{
			return "USD";
		}
	}
}
 

if(function_exists('currency'))
{
	
}
else
{
	function currency($country="",$sect="",$type="",$data="",$name="",$symbol="",$exchangerate=""){
		
		include find_file("cnct.php");
			
		if(strtolower($type)=="add")
		{
			$ins = "INSERT INTO meta (id,userid,data,r_user,syncstate,numdata,meta_data) VALUES ('','".trim(ucwords($country))."','".trim(strtoupper($data))."','".trim($name)."','".trim($symbol)."','".trim($exchangerate)."','".md5("CURRENCY SETTINGS ".trim(strtoupper($sect)))."');";
			@@$res = mysqli_query($db,$ins);
			
			if(@$res)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		elseif(strtolower($type)=="delete")
		{
			$del = "DELETE FROM meta WHERE id = '".$country."';";
			//echo $del;
			@$res = mysqli_query($db,$del);
			
			if(@$res)
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
			if(strtolower($type)=="list")
			{
				$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5("CURRENCY SETTINGS ".strtoupper($sect))."' group by userid);";
				@$res = mysqli_query($db,$sel);
				if(@$res)
				{
					@$num = mysqli_num_rows(@$res);
					for($a=0; $a<$num; $a++)
					{
						@$rw = mysqli_fetch_array(@$res);
						$array[] = array('id'=>$rw["id"],'num'=>$num,'code'=>$rw["data"],'name'=>$rw["r_user"],'exchangerate'=>$rw["numdata"],'symbol'=>$rw["syncstate"],'country'=>$rw["userid"]);
					}
					return $array;
				}
				else
				{
					return "";
				}
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE (userid = '".trim(ucwords($country))."' OR id='".trim($country)."' OR data='".trim(strtoupper($country))."') AND meta_data = '".md5("CURRENCY SETTINGS ".trim(strtoupper($sect)))."');";
				@$res = mysqli_query($db,$sel);
				if(@$res)
				{
					@$rw = mysqli_fetch_array(@$res);  
					
					if(strtolower($type)=="currency code" || strtolower($type)=="code")
					{
						return $rw["data"];
					}
					elseif(strtolower($type)=="currency symbol" || strtolower($type)=="symbol")
					{
						return $rw["syncstate"];
					}
					elseif(strtolower($type)=="currency name" || strtolower($type)=="name")
					{
						return $rw["r_user"];
					}
					elseif(strtolower($type)=="exchange rate" || strtolower($type)=="rate")
					{
						return $rw["numdata"];
					}
					elseif(strtolower($type)=="country")
					{
						return $rw["userid"];
					}
					else
					{
						return $rw["data"];
					}
				}
				else
				{
					return "";
				}
			}
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('phoneCode'))
{
	
}
else
{
	function phoneCode($country,$sect,$type="",$data=""){
		
		include find_file("cnct.php");
			
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5(strtolower($country))."','".$data."','".md5("PHONE SETTINGS ".strtoupper($sect))."');";
			@@$res = mysqli_query($db,$ins);
			
			if(@$res)
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
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".md5(strtolower($country))."' AND meta_data = '".md5("PHONE SETTINGS ".strtoupper($sect))."');";
			@$res = mysqli_query($db,$sel);
			if(@$res)
			{
				@$rw = mysqli_fetch_array(@$res);
				return $rw["data"];
			}
			else
			{
				return "";
			}
		}
		
		mysqli_close($db);
	}
}



 



if(function_exists("addProvince"))
{
	
}
else
{
	function addProvince($province,$country,$price_setting){
		
		$array = getLocationDetails($province,$country);
		
		include find_file("cnct.php");
		
		//echo "Data Entry Province: ".$province."<br>";
		//echo "G-MAPS Province: ".$array['town']."<br>";
		//echo "G-MAPS country: ".$array['country']."<br>";
		//echo "G-MAPS province: ".$array['province']."<br>";
			
		$ins = "INSERT INTO meta (id,userid,data,r_user,meta_data) VALUES ('','".md5($array['country'])."','".$array['province']."|".$array['country']."|".$array['longitude']."|".$array['latitude']."|".getCountry($country,"COUNTINENT")."|".$array['province']."','".$price_setting."','".md5("PORTAL COUNTRY PROVINCES")."');";
		@$res = mysqli_query($db,$ins);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}


if(function_exists("getProvince"))
{
	
}
else
{
	function getProvince($CatID,$type=""){
		
		if(strtolower($CatID)=="other")
		{
			return "Other";
		}
		else
		{
			include find_file("cnct.php");
			
			$sel = "SELECT * FROM meta WHERE id = '".$CatID."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			@$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$status = $rw["syncstate"];
			$price_setting = $rw["r_user"];
			
			$ex = explode("|",$data);
			
			if($type=="" || $type=="NAME")
			{
				return $ex[0];
			}
			elseif($type=="COUNTRY")
			{
				return $ex[1];
			}
			elseif($type=="LONGITUDE")
			{
				return $ex[2];
			}
			elseif($type=="LATITUDE")
			{
				return $ex[3];
			}
			elseif($type=="COUNTINENT")
			{
				return $ex[4];
			}
			elseif($type=="PRICE SETTING")
			{
				return $price_setting;
			}
			elseif($type=="STATUS")
			{
				if($status=="")
				{
					return "INACTIVE";
				}
				else
				{
					return $status;
				}
			}
		}
	}
}


if(function_exists("activateProvince"))
{
	
}
else
{
	function activateProvince($CatID){
		
		include find_file("cnct.php");
		
		$sel = "UPDATE meta SET syncstate = 'ACTIVE' WHERE id = '".$CatID."';";
		@$res = mysqli_query($db,$sel);
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

if(function_exists("deactivateProvince"))
{
	
}
else
{
	function deactivateProvince($CatID){
		
		include find_file("cnct.php");
		
		$sel = "UPDATE meta SET syncstate = 'INACTIVE' WHERE id = '".$CatID."';";
		@$res = mysqli_query($db,$sel);
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}


if(function_exists("searchProvince"))
{
	
}
else
{
	function searchProvince($CatID="",$country="",$status="ACTIVE"){
		
		include find_file("cnct.php");
		
			if($status=="ALL")
			{
				$statusQ = "";
			}
			else
			{
				$statusQ = " AND syncstate = '".$status."'";
			}
			
		if($country=="")
		{
			if($CatID=="")
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY PROVINCES")."' ".$statusQ.";";
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY PROVINCES")."' AND data like '".$CatID."|%' ".$statusQ.";";
			}
		}
		else
		{
			if($CatID=="")
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY PROVINCES")."' AND userid = '".md5($country)."' ".$statusQ.";";
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY PROVINCES")."' AND userid = '".md5($country)."' AND data like '".$CatID."|%' ".$statusQ.";";
			}
		}
		
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$price_setting = $rw["r_user"];
		
			$ex = explode("|",$data);
			
			$array[] = array('num'=>$num,'id'=>$id,'name'=>$ex[0],'country'=>$ex[1],'longitude'=>$ex[2],'latitude'=>$ex[3],'countinent'=>$ex[4],'price_setting'=>$price_setting);
		}
		
		return $array;
	}
}


if(function_exists("getProvinceID"))
{
	
}
else
{
	function getProvinceID($input,$type=""){
		
		include find_file("cnct.php");
		$array = getLocationDetails($province,$country);
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY PROVINCES")."' AND userid = '".md5($array['country'])."' AND data like '".$array['town']."|%') OR id = '".$input."';";
		
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		@$rw = mysqli_fetch_array(@$res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		$price_setting = $rw["r_user"];

		$ex = explode("|",$data);
		
		if($type=="" || $type=="ID")
		{
		  return $id;
		}
		elseif($type=="PROVINCE")
		{
		  return $ex[0];
		}
		elseif($type=="COUNTRY")
		{
		  return $ex[1];
		}
		elseif($type=="LONGITUDE")
		{
		  return $longitude;
		}
		elseif($type=="LATITUDE")
		{
		  return $latitude;
		}
		elseif($type=="PRICE SETTING")
		{
		  return $price_setting;
		}
		elseif($type=="CONTINENT")
		{
		  return $ex[4];
		}
		
	}
}


if(function_exists("listProvinces"))
{
	
}
else
{
	function listProvinces($country="",$status="ACTIVE"){
		
		include find_file("cnct.php");
		
			if($status=="ALL")
			{
				$statusQ = "";
			}
			else
			{
				$statusQ = " AND syncstate = '".$status."'";
			}
		
		if($country=="")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY PROVINCES")."' ".$statusQ.";";
		}
		else
		{
			$larray = getLocationDetails($country);
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY PROVINCES")."' AND userid = '".md5($larray['country'])."' ".$statusQ.";";
		}
		
		
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$price_setting = $rw["r_user"];
		
			$ex = explode("|",$data);
			
			$array[] = array('num'=>$num,'id'=>$id,'name'=>$ex[0],'country'=>$ex[1],'longitude'=>$ex[2],'latitude'=>$ex[3],'countinent'=>$ex[4],'price_setting'=>$price_setting);
		}
		
		return $array;
	}
}


if(function_exists("deleteProvince"))
{
	
}
else
{
	function deleteProvince($CatID){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE id = '".$CatID."';";
		//echo $del;
		@$res = mysqli_query($db,$del);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}


if(function_exists("deleteProvinces"))
{
	
}
else
{
	function deleteProvinces($CatClass){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY PROVINCES")."';";
		@$res = mysqli_query($db,$del);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}	
	}
}
 



if(function_exists("addTown"))
{
	
}
else
{
	function addTown($town,$country){
		
		$array = getLocationDetails($town,$country);
		
		include find_file("cnct.php");
		
		//echo "Data Entry Town: ".$town."<br>";
		//echo "G-MAPS Town: ".$array['town']."<br>";
		//echo "G-MAPS country: ".$array['country']."<br>";
		//echo "G-MAPS province: ".$array['province']."<br>";
			
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($array['country'])."','".$array['town']."|".$array['country']."|".$array['longitude']."|".$array['latitude']."|".getCountry($country,"COUNTINENT")."|".$array['province']."','".md5("PORTAL COUNTRY TOWNS")."');";
		@$res = mysqli_query($db,$ins);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}


if(function_exists("getTown"))
{
	
}
else
{
	function getTown($CatID,$type=""){
		
		if(strtolower($CatID)=="other")
		{
			return "Other";
		}
		else
		{
			include find_file("cnct.php");
			
			$sel = "SELECT * FROM meta WHERE id = '".$CatID."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows(@$res);
			@$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$status = $rw["syncstate"];
			
			$ex = explode("|",$data);
			
			if($type=="" || $type=="NAME")
			{
				return $ex[0];
			}
			elseif($type=="COUNTRY")
			{
				return $ex[1];
			}
			elseif($type=="LONGITUDE")
			{
				return $ex[2];
			}
			elseif($type=="LATITUDE")
			{
				return $ex[3];
			}
			elseif($type=="COUNTINENT")
			{
				return $ex[4];
			}
			elseif($type=="STATUS")
			{
				if($status=="")
				{
					return "INACTIVE";
				}
				else
				{
					return $status;
				}
			}
		}
	}
}


if(function_exists("activateTown"))
{
	
}
else
{
	function activateTown($CatID){
		
		include find_file("cnct.php");
		
		$sel = "UPDATE meta SET syncstate = 'ACTIVE' WHERE id = '".$CatID."';";
		@$res = mysqli_query($db,$sel);
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

if(function_exists("deactivateTown"))
{
	
}
else
{
	function deactivateTown($CatID){
		
		include find_file("cnct.php");
		
		$sel = "UPDATE meta SET syncstate = 'INACTIVE' WHERE id = '".$CatID."';";
		@$res = mysqli_query($db,$sel);
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}


if(function_exists("searchTown"))
{
	
}
else
{
	function searchTown($CatID="",$country="",$status="ACTIVE"){
		
		include find_file("cnct.php");
		
			if($status=="ALL")
			{
				$statusQ = "";
			}
			else
			{
				$statusQ = " AND syncstate = '".$status."'";
			}
			
		if($country=="")
		{
			if($CatID=="")
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY TOWNS")."' ".$statusQ.";";
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY TOWNS")."' AND data like '".$CatID."|%' ".$statusQ.";";
			}
		}
		else
		{
			if($CatID=="")
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY TOWNS")."' AND userid = '".md5($country)."' ".$statusQ.";";
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY TOWNS")."' AND userid = '".md5($country)."' AND data like '".$CatID."|%' ".$statusQ.";";
			}
		}
		
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
		
			$ex = explode("|",$data);
			
			$array[] = array('num'=>$num,'id'=>$id,'name'=>$ex[0],'country'=>$ex[1],'longitude'=>$ex[2],'latitude'=>$ex[3],'countinent'=>$ex[4]);
		}
		
		return $array;
	}
}


if(function_exists("getTownID"))
{
	
}
else
{
	function getTownID($input,$type=""){
		
		include find_file("cnct.php");
		$array = getLocationDetails($town,$country);
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY TOWNS")."' AND userid = '".md5($array['country'])."' AND data like '".$array['town']."|%') OR id = '".$input."';";
		
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		@$rw = mysqli_fetch_array(@$res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];

		$ex = explode("|",$data);
		
		if($type=="" || $type=="ID")
		{
		  return $id;
		}
		elseif($type=="TOWN")
		{
		  return $ex[0];
		}
		elseif($type=="COUNTRY")
		{
		  return $ex[1];
		}
		elseif($type=="LONGITUDE")
		{
		  return $longitude;
		}
		elseif($type=="LATITUDE")
		{
		  return $latitude;
		}
		elseif($type=="CONTINENT")
		{
		  return $ex[4];
		}
		
	}
}


if(function_exists("listTowns"))
{
	
}
else
{
	function listTowns($country="",$status="ACTIVE"){
		
		include find_file("cnct.php");
		
			if($status=="ALL")
			{
				$statusQ = "";
			}
			else
			{
				$statusQ = " AND syncstate = '".$status."'";
			}
		
		if($country=="")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY TOWNS")."' ".$statusQ.";";
		}
		else
		{
			$larray = getLocationDetails($country);
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY TOWNS")."' AND userid = '".md5($larray['country'])."' ".$statusQ.";";
		}
		
		
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
		
			$ex = explode("|",$data);
			
			$array[] = array('num'=>$num,'id'=>$id,'name'=>$ex[0],'country'=>$ex[1],'longitude'=>$ex[2],'latitude'=>$ex[3],'countinent'=>$ex[4]);
		}
		
		return $array;
	}
}


if(function_exists("deleteTown"))
{
	
}
else
{
	function deleteTown($CatID){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE id = '".$CatID."';";
		//echo $del;
		@$res = mysqli_query($db,$del);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}


if(function_exists("deleteTowns"))
{
	
}
else
{
	function deleteTowns($CatClass){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY TOWNS")."';";
		@$res = mysqli_query($db,$del);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}	
	}
}


if(function_exists("addCountry"))
{
	
}
else
{
	function addCountry($data,$CatID="AFRICA"){
		
		include find_file("cnct.php");
		$larray = getLocationDetails($data);
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5(strtoupper($CatID))."','".$larray['country']."|".$larray['longitude']."|".$larray['latitude']."|".$CatID."','".md5("PORTAL COUNTRIES")."');";
		@$res = mysqli_query($db,$ins);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

if(function_exists("getCountry"))
{
	
}
else
{
	function getCountry($CatID,$type=""){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL COUNTRIES")."' AND id = '".$CatID."');";
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		@$rw = mysqli_fetch_array(@$res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		$ex = explode("|",$data);
		
		if($type=="" || $type=="NAME")
		{
			return $ex[0];
		}
		elseif($type=="LONGITUDE")
		{
			return $ex[1];
		}
		elseif($type=="LATITUDE")
		{
			return $ex[2];
		}
		elseif($type=="COUNTINENT")
		{
			return $ex[3];
		}
	}
}

if(function_exists("listCountries"))
{
	
}
else
{
	function listCountries($contID=""){
		
		include find_file("cnct.php");
		
		if($contID=="")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRIES")."';";
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRIES")."' AND userid = '".md5(strtoupper($contID))."';";
		}
		
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
		
			$ex = explode("|",$data);
			
			$array[] = array('num'=>$num,'id'=>$id,'name'=>$ex[0],'longitude'=>$ex[1],'latitude'=>$ex[2],'continent'=>$ex[3]);
		}
		
		return $array;
	}
}

if(function_exists("deleteCountry"))
{
	
}
else
{
	function deleteCountry($CatID){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE id = '".$CatID."';";
		//echo $del;
		@$res = mysqli_query($db,$del);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

if(function_exists("deleteCountries"))
{
	
}
else
{
	function deleteCountries($CatClass){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5("PORTAL COUNTRIES")."';";
		@$res = mysqli_query($db,$del);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}	
	}
}

if(function_exists("addCountinent"))
{
	
}
else
{
	function addCountinent($data,$longitude="",$latitude=""){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5("DEFAULT COUNTINENTS")."','".$data."|".$longitude."|".$latitude."','".md5("PORTAL COUNTRY COUNTINENTS")."');";
		@$res = mysqli_query($db,$ins);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

if(function_exists("getCountinent"))
{
	
}
else
{
	function getCountinent($CatID,$type=""){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY COUNTINENTS")."' AND id = '".$CatID."');";
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		@$rw = mysqli_fetch_array(@$res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		$ex = explode("|",$data);
		
		if($type=="" || $type=="NAME")
		{
			return $ex[0];
		}
		elseif($type=="LONGITUDE")
		{
			return $ex[1];
		}
		elseif($type=="LATITUDE")
		{
			return $ex[2];
		}
	}
}

if(function_exists("listCountinents"))
{
	
}
else
{
	function listCountinents($country=""){
		
		include find_file("cnct.php");
		
		if($country=="")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY COUNTINENTS")."';";
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY COUNTINENTS")."' AND userid = '".md5($country)."';";
		}
		
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array(@$res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
		
			$ex = explode("|",$data);
			
			$array[] = array('num'=>$num,'id'=>$id,'name'=>$ex[0],'longitude'=>$ex[1],'latitude'=>$ex[2]);
		}
		
		return $array;
	}
}

if(function_exists("deleteCountinent"))
{
	
}
else
{
	function deleteCountinent($CatID){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE id = '".$CatID."';";
		//echo $del;
		@$res = mysqli_query($db,$del);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

if(function_exists("deleteCountinents"))
{
	
}
else
{
	function deleteCountinents(){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5("PORTAL COUNTRY COUNTINENTS")."';";
		@$res = mysqli_query($db,$del);
		
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}	
	}
}

if(function_exists("getDistance"))
{
	
}
else
{
	function getDistance($addressFrom, $addressTo,$mode="driving", $units="metric", $language="en-EN"){
		//Change address format
		$formattedAddrFrom = str_replace(' ','+',$addressFrom);
		$formattedAddrTo = str_replace(' ','+',$addressTo);
		
		//Send request and receive json data

		$url = str_replace(' ', '%20', "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$formattedAddrFrom."&destinations=".$formattedAddrTo."&mode=".strtolower($mode)."&units=".$units."&language=en-EN&key=".GoogleAPIKeys("SERVER KEY"));

		@$result = file_get_contents($url);
		$data = json_decode(utf8_encode(@$result), true);
		  
		$array = array('from'=>$data["origin_addresses"][0],
				'to'=>$data["destination_addresses"][0],
				'distance_text'=>$data["rows"][0]["elements"][0]["distance"]["text"],
				'distance_value'=>$data["rows"][0]["elements"][0]["distance"]["value"],
				'duration_text'=>$data["rows"][0]["elements"][0]["duration"]["text"],
				'duration_value'=>$data["rows"][0]["elements"][0]["duration"]["value"],
				'distance_time_status'=>$data["rows"][0]["elements"][0]["status"],
				'status'=>$data["status"]);
				
		return $array;
	}
}
?>