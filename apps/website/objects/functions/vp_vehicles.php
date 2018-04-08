<?php 

	function VehicleStatus($vehicleID,$status){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "UPDATE meta SET syncstate = '".$status."' WHERE id = '".$vehicleID."';";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function addVIDtoREG($vreg,$vid){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($vreg)."','".$vid."','".md5("PORTAL VEHICLE VID TO REG")."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function getVehicleStatus($vid){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE id = '".$vid."';";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$syncstate = $rw["syncstate"];
		
		if($syncstate=="" || $syncstate=="0" || $syncstate=="INACTIVE")
		{
			return "INACTIVE";
		}
		else
		{
			if($syncstate=="ACTIVE")
			{
				return "ACTIVE";
			}
			else
			{
				return "INACTIVE";
			}
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function registerVehicle($user,$vehicletype,$vehiclemake,$modelyear,$registrationNumber,$location,$country,$conrate="",$fueltype=""){
		
		include find_file("apps/website/cnct_w.php");
		
		$vCode = uniqueCode();
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$user."','".$vehicletype."|".$vehiclemake."|".$modelyear."|".cleanupData($registrationNumber)."|".$location."|".$country."|".$conrate."|".$fueltype."','".md5("REGISTERED VEHICLE")."','".$vCode."','INACTIVE');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND r_user = '".$vCode."');";
			$resx = mysqli_query($db,$selx);
			@$numx = mysqli_num_rows($resx);
			@$rw = mysqli_fetch_array($resx);
			$id = $rw["id"];
			
			addVIDtoREG(cleanupData($registrationNumber),$id);
			
			return $id;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_free_result($resx);
			mysqli_close($db);
	}


	function getVIDfromREG($vreg){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5(cleanupData($vreg))."' AND meta_data = '".md5("PORTAL VEHICLE VID TO REG")."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		return $data;
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function viewVehicle($vid,$type=""){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND id = '".$vid."';";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		$status = $rw["syncstate"];
		$dateset = $rw["dateset"];
		
		$ex = explode("|",$data);
		$vehicletype = $ex[0];
		$vehiclemake = $ex[1];
		$year = $ex[2];
		$regnumber = $ex[3];
		$country = $ex[4];
		$location = $ex[5];
		$conrate = $ex[6];
		$fueltype = $ex[7];
		
		
		if($type=="")
		{
			$array = array('num'=>$num,'id'=>$id,'owner'=>$userid,'type'=>$vehicletype,'make'=>$vehiclemake,'year'=>$year,'reg'=>$regnumber,'location'=>$location,'country'=>$country,'conrate'=>$conrate,'fueltype'=>$fueltype);
			
			return $array;
		}
		else
		{
			if($type=="ID")
			{
				return $id;
			}
			elseif($type=="OWNER")
			{
				return $userid;
			}
			elseif($type=="VEHICLE TYPE")
			{
				return $vehicletype;
			}
			elseif($type=="TYPE")
			{
				return $vehicletype;
			}
			elseif($type=="MAKE")
			{
				return $vehiclemake;
			}
			elseif($type=="YEAR")
			{
				return $year;
			}
			elseif($type=="REG NUMBER")
			{
				return $regnumber;
			}
			elseif($type=="LOCATION")
			{
				return $location;
			}
			elseif($type=="COUNTRY")
			{
				return $country;
			}
			elseif($type=="FUEL CONSUMPTION RATE")
			{
				return $conrate;
			}
			elseif($type=="FUEL TYPE")
			{
				return $fueltype;
			}
			elseif($type=="STATUS")
			{
				return $status;
			}
			elseif($type=="DATESET")
			{
				return $dateset;
			}
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function listVehicles($user="",$class="",$location_group="",$status="ACTIVE"){
		
		$userLimiter = " AND userid IN (SELECT userID FROM _user_acnts WHERE (_user_acnts.Active = 'Yes' OR _user_acnts.Active = '1'))";
		
		if($status=="ACTIVE")
		{
			
			if($user=="")
			{
				if($class=="")
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND (syncstate = 'ACTIVE' OR syncstate = '1') ".$userLimiter.";";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '%|".$location_group."%' AND (syncstate = 'ACTIVE' OR syncstate = '1') ".$userLimiter.";";
					}
				}
				else
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND (syncstate = 'ACTIVE' OR syncstate = '1') ".$userLimiter.";";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND data like '%|".$location_group."%' AND (syncstate = 'ACTIVE' OR syncstate = '1') ".$userLimiter.";";
					}
				}
			}
			else
			{
				if($class=="")
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = 'ACTIVE' OR syncstate = '1');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '%|".$location_group."%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = 'ACTIVE' OR syncstate = '1');";
					}
				}
				else
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = 'ACTIVE' OR syncstate = '1');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND data like '%|".$location_group."%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = 'ACTIVE' OR syncstate = '1');";
					}
				}
			}
		}
		elseif($status=="INACTIVE")
		{
			
			if($user=="")
			{
				if($class=="")
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND (syncstate = 'INACTIVE' OR syncstate = '0' OR syncstate = '') ".$userLimiter.";";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '%|".$location_group."%' AND (syncstate = 'INACTIVE' OR syncstate = '0' OR syncstate = '') ".$userLimiter.";";
					}
				}
				else
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND (syncstate = 'INACTIVE' OR syncstate = '0' OR syncstate = '') ".$userLimiter.";";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND data like '%|".$location_group."%' AND (syncstate = 'INACTIVE' OR syncstate = '0' OR syncstate = '') ".$userLimiter.";";
					}
				}
			}
			else
			{
				if($class=="")
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = 'INACTIVE' OR syncstate = '0' OR syncstate = '');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '%|".$location_group."%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = 'INACTIVE' OR syncstate = '0' OR syncstate = '');";
					}
				}
				else
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = 'INACTIVE' OR syncstate = '0' OR syncstate = '');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND data like '%|".$location_group."%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = 'INACTIVE' OR syncstate = '0' OR syncstate = '');";
					}
				}
			}
		}
		elseif($status=="ALL")
		{
			
			if($user=="")
			{
				if($class=="")
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' ".$userLimiter.";";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '%|".$location_group."%' ".$userLimiter.";";
					}
				}
				else
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' ".$userLimiter.";";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND data like '%|".$location_group."%' ".$userLimiter.";";
					}
				}
			}
			else
			{
				if($class=="")
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '%|".$location_group."%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."');";
					}
				}
				else
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND data like '%|".$location_group."%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."');";
					}
				}
			}
		}
		else
		{
			
			if($user=="")
			{
				if($class=="")
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND (syncstate = '".$status."') ".$userLimiter.";";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '%|".$location_group."%' AND (syncstate = '".$status."') ".$userLimiter.";";
					}
				}
				else
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND (syncstate = '".$status."') ".$userLimiter.";";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND data like '%|".$location_group."%' AND (syncstate = '".$status."') ".$userLimiter.";";
					}
				}
			}
			else
			{
				if($class=="")
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = '".$status."');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '%|".$location_group."%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = '".$status."');";
					}
				}
				else
				{
					if($location_group=="")
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = '".$status."');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$class."|%' AND data like '%|".$location_group."%' AND userid = (SELECT max(userID) FROM _user_acnts WHERE userID = '".$user."' OR Email = '".$user."' OR LoginName = '".$user."' OR Mobile = '".$user."') AND (syncstate = '".$status."');";
					}
				}
			}
		}
		
		//echo "<br>".$sel."<br>";
		include find_file("apps/website/cnct_w.php");
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			
			$ex = explode("|",$data);
			$vehicletype = $ex[0];
			$vehiclemake = $ex[1];
			$year = $ex[2];
			$regnumber = $ex[3];
			$country = $ex[4];
			$location = $ex[5];
			$conrate = $ex[6];
			$fueltype = $ex[7];
			
			$array[] = array('num'=>$num,'id'=>$id,'owner'=>$userid,'type'=>$vehicletype,'make'=>$vehiclemake,'year'=>$year,'reg'=>$regnumber,'location'=>$location,'country'=>$country,'conrate'=>$conrate,'fueltype'=>$fueltype);
		}
		
		return $array;
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function editVehicle($vid,$vehicletype="",$vehiclemake="",$modelyear="",$registrationNumber="",$location="",$conrate="",$fueltype=""){
		
		
		
		$OWNERx = viewVehicle($vid,"OWNER");
		$VEHICLETYPEx = viewVehicle($vid,"VEHICLE TYPE");
		$MAKEx = viewVehicle($vid,"MAKE");
		$YEARx = viewVehicle($vid,"YEAR");
		$REGx = viewVehicle($vid,"REG NUMBER");
		$LOCATIONx = viewVehicle($vid,"LOCATION");
		$CONRATEx = viewVehicle($vid,"FUEL CONSUMPTION RATE");
		$fFUELTYPEx = viewVehicle($vid,"FUEL TYPE");
		
		if(!($vehicletype==""))
		{
			$vehicletypey = $vehicletype;
		}
		else
		{
			$vehicletypey = $VEHICLETYPEx;
		}
		
		if(!($location==""))
		{
			$locationy = $location;
		}
		else
		{
			$locationy = $LOCATIONx;
		}
		
		if(!($vehiclemake==""))
		{
			$vehiclemakey = $vehiclemake;
		}
		else
		{
			$vehiclemakey = $MAKEx;
		}
		
		if(!($modelyear==""))
		{
			$modelyeary = $modelyear;
		}
		else
		{
			$modelyeary = $YEARx;
		}
		
		if(!($registrationNumber==""))
		{
			$registrationNumbery = $registrationNumber;
			addVIDtoREG(cleanupData($registrationNumber),$vid);
		}
		else
		{
			$registrationNumbery = $REGx;
		}
		
		if(!($fueltype==""))
		{
			$fueltypey = $fueltype;
		}
		else
		{
			$fueltypey = $fFUELTYPEx;
		}
		
		if(!($conrate==""))
		{
			$conratey = $conrate;
		}
		else
		{
			$conratey = $CONRATEx;
		}
		
		include find_file("apps/website/cnct_w.php");
		$update = "UPDATE meta SET data = '".$vehicletypey."|".$vehiclemakey."|".$modelyeary."|".$registrationNumbery."|".getTown($locationy,"COUNTRY")."|".$locationy."|".$conratey."|".$fueltypey."' WHERE id = '".$vid."';";
		$res = mysqli_query($db,$update);
		
		//echo "<br>".$update."<br>";
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function deleteVehicle($vid){
		
		include find_file("apps/website/cnct_w.php");
		
		$del = "DELETE FROM meta WHERE id = '".$vid."';";
		$res = mysqli_query($db,$del);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function addVehicleMilage($vid,$milage){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,meta_data) VALUES ('','".md5($vid)."','".$milage."','".md5("REGISTERED VEHICLE MILAGE")."');";
		$res = mysqli_query($db,$ins);
		
		//echo $ins." ";
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function viewVehicleMilage($vid){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE MILAGE")."' AND userid = '".md5($vid)."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["numdata"];
		
		//echo $sel." ";
		
		return $data;
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function addVehicleImage($vehicleID,$imageUrl){
		
		include find_file("apps/website/cnct_w.php");
		
		$vCode = uniqueCode();
		
		if(!($imageUrl==""))
		{			
			rescaleImageByWidth("images/".$imageUrl,600);
			
			if(file_exists("images/thumb_".$imageUrl))
			{
				
			}
			else
			{
				copy("images/".$imageUrl,"images/thumb_".$imageUrl);
				
				rescaleImageByWidth("images/thumb_".$imageUrl,120);
			}
			
			$ins = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".md5($vehicleID)."','".$imageUrl."','".md5("REGISTERED VEHICLE IMAGE")."','".$vCode."');";
			$res = mysqli_query($db,$ins);
			
			if($res)
			{
				$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE IMAGE")."' AND syncstate = '".$vCode."' AND userid = '".md5($vehicleID)."');";
				$resx = mysqli_query($db,$selx);
				@$rwx = mysqli_fetch_array($resx);
				$id = $rwx["id"];
				
				return $id;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_free_result($resx);
			mysqli_close($db);
	}
	
	
	function getThumNail($imageUrl){
		
		if($imageUrl=="")
		{
			return "thumb_banner_1.jpg";
		}
		else
		{
			if(file_exists("images/thumb_".$imageUrl))
			{
				return "thumb_".$imageUrl;
			}
			else
			{
				if(file_exists("images/".$imageUrl))
				{
					@ copy("images/".$imageUrl,"images/thumb_".$imageUrl);
					
					rescaleImageByWidth("images/thumb_".$imageUrl,120);
					
					return "thumb_".$imageUrl;
				}
				else
				{
					return "thumb_banner_1.jpg";
				}
			}
		}
	}


	function setVehicleCoverImage($vehicleID,$imgID){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($vehicleID)."','".$imgID."','".md5("REGISTERED VEHICLE COVER IMAGE")."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function viewVehicleImage($imageId){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE IMAGE")."' AND id = '".$imageId."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		rescaleImageByWidth("images/".$data,600);
		
		return $data;
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function listImages($vid,$count=""){
		
		include find_file("apps/website/cnct_w.php");
		
		if($count=="")
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE IMAGE")."' AND (userid = '".md5($vid)."');";
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE IMAGE")."' AND (userid = '".md5($vid)."') LIMIT 0,".$count.";";
		}
		
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		if($num>=1)
		{			
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array($res);
				$id = $rw["id"];
				$userid = $rw["userid"];
				$data = $rw["data"];
				
				$array[] = array('num'=>$num,'id'=>$id,'img'=>viewVehicleImage($id));
			}
		}
		else
		{		
			$array[] = array('num'=>0,'id'=>"",'img'=>"");
		}
		
		return $array;
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function getImage($vid,$rand="",$int='0'){
		
		$imgs = listImages($vid);
		
		if($rand=="RANDOM")
		{
			$randx = rand($int, ($imgs[0]['num']-1));
		}
		else
		{
			if($rand<=($imgs[0]['num']-1))
			{
				$randx = $rand;
			}
			else
			{
				$randx = ($imgs[0]['num']-1);
			}
		}
		
		//echo "rad test: ".$randx;
		
		return $imgs[$randx]['img'];
	}



	function checkVehicleCoverImageExists($vehicleID){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT COUNT(id) AS numID,data FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE COVER IMAGE")."' AND userid = '".md5($vehicleID)."');";
		$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array($res);
		@$num = $rw["numID"];
		
		if($num<=0)
		{
			return 0;
		}
		else
		{
			$data = $rw["data"];
			
			$imgFile = "images/".viewVehicleImage($data);
			
			if($data=="" || !(file_exists($imgFile)))
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}



	function getVehicleCoverImage($vehicleID){
		
		
		
		if(checkVehicleCoverImageExists($vehicleID)==1)
		{		
			include find_file("apps/website/cnct_w.php");
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE COVER IMAGE")."' AND userid = '".md5($vehicleID)."');";
			//echo $sel."<br>";
			$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			
			return viewVehicleImage($data);
			mysqli_free_result($res);
			mysqli_close($db);
		}
		else
		{
			$imgs = listImages($vehicleID);
			
			if($imgs[0]['num']>=1)
			{

				$imgFile = "";
				$c = 0;
				$s = 0;
				$l = 0;
				$st = 0;
				while($st==0)
				{
					$imgFile = "images/".$imgs[$c]['img'];
					if(file_exists($imgFile))
					{
						$s = 1;
					}
					else
					{
						$s = 0;
					}
					
					if(($c+1)==$imgs[0]['num'])
					{
						$l = 1;
					}
					else
					{
						$l = 0;
					}
					
					if($l==1 || $s==1)
					{
						$st = 1;
					}
					else
					{
						$st = 0;
					}
					
					$c = $c+1;
				}
				
				//echo "ss: ".$s."<br>";
				
				if($s<=0)
				{
					$carimage = image_placeholder(viewVehicle($vehicleID,"VEHICLE TYPE"));
				}
				else
				{
					$carimage = $imgs[($c-1)]['img'];
				}
			}
			else
			{
				$carimage = image_placeholder(viewVehicle($vehicleID,"VEHICLE TYPE"));
			}
						
			return $carimage;
		}
	}



	function getVehicleCoverImageWidth($vehicleID,$maxheight){
		
		include find_file("apps/website/cnct_w.php");
		
		$imgw = getVehicleCoverImage($vehicleID);

		$heightX3 = imageSize("images/".$imgw,"HEIGHT");
		$widthX3 = imageSize("images/".$imgw,"WIDTH"); 
		
		$width = $maxheight*$widthX3/$heightX3;
		
		return $width;
	}
	

	function getImageWidth($imgw,$maxheight){

		if(file_exists("images/".$imgw))
		{
			$heightX3 = imageSize("images/".$imgw,"HEIGHT");
			$widthX3 = imageSize("images/".$imgw,"WIDTH"); 
			
			$width = $maxheight*$widthX3/$heightX3;
			
			return $width;
		}
		else
		{
			return "";
		}
	}
	

	function getImageHeight($imgw,$maxwidth){
		
		if(file_exists("images/".$imgw))
		{
			$heightX3 = imageSize("images/".$imgw,"HEIGHT");
			$widthX3 = imageSize("images/".$imgw,"WIDTH"); 
			$heightY3 = $maxwidth*$heightX3/$widthX3;
			
			return $heightY3;
		}
		else
		{
			return "";
		}
	}



	function getVehicleCoverImageHeight($vehicleID,$maxwidth){
		
		$imgh = getVehicleCoverImage($vehicleID);
		
		$heightX3 = imageSize("images/".$imgh,"HEIGHT");
		$widthX3 = imageSize("images/".$imgh,"WIDTH"); 
		
		$heightY3 = $maxwidth*$heightX3/$widthX3;
		
		return $heightY3;
	}


	function image_placeholder($cats){
		
		return "banner_1.jpg";
	}


	function listVehicleImages($vehicleID){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE IMAGE")."' AND userid = '".md5($vehicleID)."';";
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
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function deleteVehicleImage($imageId){
		
		include find_file("apps/website/cnct_w.php");
		
		$del = "DELETE FROM meta WHERE id = '".$imageId."';";
		$res = mysqli_query($db,$del);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function deleteVehicleImages($imageId){
		
		include find_file("apps/website/cnct_w.php");
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE IMAGE")."' AND userid = '".md5($vehicleID)."';";
		$res = mysqli_query($db,$del);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
			mysqli_free_result($res);
			mysqli_close($db);
	}




	function addCommisionLocal($CatID,$price_within,$location){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,meta_data,syncstate,r_user) VALUES ('','".md5($CatID)."|".md5($location)."','".$price_within."','".md5("PORTAL VEHICLE CATEGORY COMMISION LOCAL")."','".$location."','".$CatID."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}




	function addCommisionOOT($CatID,$price_out,$location){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,meta_data,syncstate,r_user) VALUES ('','".md5($CatID)."|".md5($location)."','".$price_out."','".md5("PORTAL VEHICLE CATEGORY COMMISION OUT OF TOWN")."','".$location."','".$CatID."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}




	function addCommision($CatID,$price_within,$price_out,$location){
		
		if(addCommisionLocal($CatID,$price_within,$location)==1 && addCommisionOOT($CatID,$price_out,$location)==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}


	function getCommision($CatID,$location="",$type="LOCAL"){
		
		include find_file("apps/website/cnct_w.php");
		
		if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
		{
			if($location=="")
			{
				$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION LOCAL")."' AND userid like '".md5($CatID)."|%');";
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION LOCAL")."' AND userid = '".md5($CatID)."|".md5($location)."');";
			}
		}
		else
		{
			if($location=="")
			{
				$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION OUT OF TOWN")."' AND userid like '".md5($CatID)."|%');";
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION OUT OF TOWN")."' AND userid = '".md5($CatID)."|".md5($location)."');";
			}
		}
		
		//echo $sel;
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["numdata"];
		$location = $rw["syncstate"];
		$category = $rw["r_user"];
		
		if($num<=0)
		{
			return 0;
		}
		else
		{
			return $data;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function listLocalCommissions($CatID=""){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION LOCAL")."' GROUP BY r_user);";
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["numdata"];
			$location = $rw["syncstate"];
			$category = $rw["r_user"];
			
			$array[] = array('num'=>$num,'id'=>$id,'name'=>$data,'location'=>$location,'category'=>$category);
		}
		
		return $array;
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function listOutsideCommissions(){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION OUT OF TOWN")."' GROUP BY r_user);";
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["numdata"];
			$location = $rw["syncstate"];
			$category = $rw["r_user"];
			
			$array[] = array('num'=>$num,'id'=>$id,'name'=>$data,'location'=>$location,'category'=>$category);
		}
		
		return $array;
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function listCommissions($CatID=""){
		
		$res = listLocalCommissions($CatID);
		@$num = $res[0]["num"];
		
		$res2 = listOutsideCommissions($CatID);
		@$num2 = $res2[0]["num"];
		
		for($a=0; $a<$num; $a++)
		{
			$id = $res[$a]["id"];
			$data = $res[$a]["name"];
			$location = $res[$a]["location"];
			$category = $res[$a]["category"];
			
			$array[] = array('num'=>($num+$num2),'id'=>$id,'type'=>'WITHIN','name'=>$data,'location'=>$location,'category'=>$category);
		}
		
		for($a2=0; $a2<$num2; $a2++)
		{
			$id2 = $res2[$a2]["id"];
			$data2 = $res2[$a2]["name"];
			$location2 = $res2[$a2]["location"];
			$category2 = $res2[$a2]["category"];
			
			$array[] = array('num'=>($num+$num2),'id'=>$id2,'type'=>'OUTSIDE','name'=>$data2,'location'=>$location2,'category'=>$category2);
		}
		
		return $array;
	}


	function deleteCommision($CatID,$location="",$type="LOCAL"){
		
		if($location=="")
		{
			$del = "DELETE FROM meta WHERE (meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION OUT OF TOWN")."' || meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION LOCAL")."') AND userid like '".md5($CatID)."%';";
		}
		else
		{
			$del = "DELETE FROM meta WHERE (meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION OUT OF TOWN")."' || meta_data = '".md5("PORTAL VEHICLE CATEGORY COMMISION LOCAL")."') AND userid = '".md5($CatID)."|".md5($location)."';";
		}
		
		include find_file("apps/website/cnct_w.php");
		$res = mysqli_query($db,$del);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}	
			mysqli_free_result($res);
			mysqli_close($db);
	}




	function addFeesPayableLocal($vid,$price_within){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,meta_data,r_user) VALUES ('','".md5($vid)."','".$price_within."','".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."','".$vid."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}




	function addFeesPayableOOT($vid,$price_out){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,meta_data,r_user) VALUES ('','".md5($vid)."','".$price_out."','".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."','".$vid."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}




	function addFeesPayable($vid,$price_within,$price_out,$location){
		
		if(addFeesPayableLocal($vid,$price_within)==1 && addFeesPayableOOT($vid,$price_out)==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}


	function getFeesPayable($vid,$type="WITHIN"){
		
		
		
		if(is_numeric($type))
		{
			if(viewVehicle($vid,"LOCATION")==$type)
			{
				$type="WITHIN";
			}
			else
			{
				$type="OUT OF TOWN";
			}
		}
		else
		{
			$type = $type;
		}
		
		if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
		{
			$sel = "SELECT id,userid,numdata,count(id) AS numItems FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND userid like '".md5($vid)."');";
		}
		else
		{
			$sel = "SELECT id,userid,numdata,count(id) AS numItems FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND userid like '".md5($vid)."');";
		}
		
		//echo $sel;
		include find_file("apps/website/cnct_w.php");
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["numdata"];
		$numItems = $rw["numItems"];

		
		if($numItems>=1)
		{
			$payable = $data;
		}
		else
		{
		
			$CatID = viewVehicle($vid,"TYPE");
		
			$location = viewVehicle($vid,"LOCATION");
			
			$catPrice = getCategoryPrice($CatID,$location,strtoupper($type));
			
			$commission = getCommision($CatID,$location,strtoupper($type));
			
			$payable = $catPrice-$commission;
		}
		
		
		
		return $payable;
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function deleteFeesPayable($CatID){
		
		include find_file("apps/website/cnct_w.php");
		
		$del = "DELETE FROM meta WHERE (meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' || meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."') AND userid like '".md5($CatID)."';";
		
		
		$res = mysqli_query($db,$del);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);	
	}


	function getActualPrice($vid,$type="LOCAL"){
		
		$CatID = viewVehicle($vid,"TYPE");
		
		if(is_numeric($type))
		{
			if(viewVehicle($vid,"LOCATION")==$type)
			{
				$type="WITHIN";
			}
			else
			{
				$type="OUT OF TOWN";
			}
		}
		else
		{
			$type = $type;
		}
		
		$price = getFeesPayable($vid,$type)+getCommision($CatID,viewVehicle($vid,"LOCATION"),$type);
		
		return $price;
	}


	function vehicleInspection($vid,$status,$engine,$engine_comments,$drive_experience,$drive_experience_comments,$interior_appearance,$interior_appearance_comments,$exterior_appearance,$exterior_appearance_comments,$road_tax_license,$road_tax_license_comments,$road_fitness_license,$road_fitness_license_comments,$insurance_type,$insurance_type_comments,$condition_of_tyres,$condition_of_tyres_comments,$tools_jack,$tools_wheel_spanner,$tools_winder,$tools_lockernut,$tools_sparewheel,$tools_comments,$tools,$triangles){

		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($vid)."','".$engine."|".$engine_comments."|".$drive_experience."|".$drive_experience_comments."|".$interior_appearance."|".$interior_appearance_comments."|".$exterior_appearance."|".$exterior_appearance_comments."|".$road_tax_license."|".$road_tax_license_comments."|".$road_fitness_license."|".$road_fitness_license_comments."|".$insurance_type."|".$insurance_type_comments."|".$condition_of_tyres."|".$condition_of_tyres_comments."|".$tools_jack."|".$tools_wheel_spanner."|".$tools_winder."|".$tools_lockernut."|".$tools_sparewheel."|".$tools_comments."|".$tools."|".$triangles."','".md5("PORTAL VEHICLE INSPECTION REPORT")."');";
		$res = mysqli_query($db,$ins);
		
		if(VehicleStatus($vid,$status)==1 && $res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function getInspectionReport($vid,$type){
				
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5($vid)."' AND meta_data = '".md5("PORTAL VEHICLE INSPECTION REPORT")."');";
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		if($num>=1)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			
			$ex = explode("|",$data);
			$engine = $ex[0];
			$engine_comments = $ex[1];
			$drive_experience = $ex[2];
			$drive_experience_comments = $ex[3];
			$interior_appearance = $ex[4];
			$interior_appearance_comments = $ex[5];
			$exterior_appearance = $ex[6];
			$exterior_appearance_comments = $ex[7];
			$road_tax_license = $ex[8];
			$road_tax_license_comments = $ex[9];
			$road_fitness_license = $ex[10];
			$road_fitness_license_comments = $ex[11];
			$insurance_type = $ex[12];
			$insurance_type_comments = $ex[13];
			$condition_of_tyres = $ex[14];
			$condition_of_tyres_comments = $ex[15];
			$tools_jack = $ex[16];
			$tools_wheel_spanner = $ex[17];
			$tools_winder = $ex[18];
			$tools_lockernut = $ex[19];
			$tools_sparewheel = $ex[20];
			$tools_comments = $ex[21];
			$tools = $ex[22];
			$triangles = $ex[23];
			
			if($type=="")
			{
				$array = array('num'=>$num,'id'=>$id,'engine'=>$engine,'engine_comments'=>$engine_comments,'category'=>$category);
			}
			elseif(strtolower($type)=="num")
			{
				$array = $num;
			}
			elseif(strtolower($type)=="engine")
			{
				$array = $engine;
			}
			elseif(strtolower($type)=="engine comments")
			{
				$array = $engine_comments;
			}
			elseif(strtolower($type)=="drive experience")
			{
				$array = $drive_experience;
			}
			elseif(strtolower($type)=="drive experience comments")
			{
				$array = $drive_experience_comments;
			}
			elseif(strtolower($type)=="interior appearance")
			{
				$array = $interior_appearance;
			}
			elseif(strtolower($type)=="interior appearance comments")
			{
				$array = $interior_appearance_comments;
			}
			elseif(strtolower($type)=="exterior appearance")
			{
				$array = $exterior_appearance;
			}
			elseif(strtolower($type)=="exterior appearance comments")
			{
				$array = $exterior_appearance_comments;
			}
			elseif(strtolower($type)=="road tax license")
			{
				$array = $road_tax_license;
			}
			elseif(strtolower($type)=="road tax license comments")
			{
				$array = $road_tax_license_comments;
			}
			elseif(strtolower($type)=="road fitness license")
			{
				$array = $road_fitness_license;
			}
			elseif(strtolower($type)=="road fitness license comments")
			{
				$array = $road_fitness_license_comments;
			}
			elseif(strtolower($type)=="insurance type")
			{
				$array = $insurance_type;
			}
			elseif(strtolower($type)=="insurance type comments")
			{
				$array = $insurance_type_comments;
			}
			elseif(strtolower($type)=="condition of tyres")
			{
				$array = $condition_of_tyres;
			}
			elseif(strtolower($type)=="condition of tyres comments")
			{
				$array = $condition_of_tyres_comments;
			}
			elseif(strtolower($type)=="jack")
			{
				$array = $tools_jack;
			}
			elseif(strtolower($type)=="wheel spanner")
			{
				$array = $tools_wheel_spanner;
			}
			elseif(strtolower($type)=="winder")
			{
				$array = $tools_winder;
			}
			elseif(strtolower($type)=="lockernut")
			{
				$array = $tools_lockernut;
			}
			elseif(strtolower($type)=="sparewheel")
			{
				$array = $tools_sparewheel;
			}
			elseif(strtolower($type)=="tools comments")
			{
				$array = $tools_comments;
			}
			elseif(strtolower($type)=="tools")
			{
				$array = $tools;
			}
			elseif(strtolower($type)=="triangles")
			{
				$array = $triangles;
			}
		}
		else
		{
			$array = 0;
		}
		
		return $array;
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function lowestPrice($CatID="",$location="",$type="LOCAL"){
		
		if($CatID=="")
		{
			if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
			{
				if($location=="")
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' GROUP BY userid );";
				}
				else
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND userid like '%|".md5($location)."' GROUP BY userid );";
				}
			}
			else
			{
				if($location=="")
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' GROUP BY userid );";
				}
				else
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND userid like '%|".md5($location)."' GROUP BY userid );";
				}
			}
		}
		else
		{
			if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
			{
				if($location=="")
				{ 
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
				else
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND userid like '%|".md5($location)."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
			}
			else
			{
				if($location=="")
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
				else
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND userid like '%|".md5($location)."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
			}
		}
		
		include find_file("apps/website/cnct_w.php");
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$minPrice = $rw["minPrice"];
		
		
		
		
		

			
		
		if($CatID=="")
		{
			if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
			{
				if($location=="")
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' GROUP BY userid );";
				}
				else
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND userid like '%|".md5($location)."' GROUP BY userid );";
				}
			}
			else
			{
				if($location=="")
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' GROUP BY userid );";
				}
				else
				{
					$sel3 = "SELECT * FROM id IN (SELECT max(id) FROM meta WHERE meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND userid like '%|".md5($location)."' GROUP BY userid );";
				}
			}
		}
		else
		{
			if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
			{
				if($location=="")
				{ 
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
				else
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND userid like '%|".md5($location)."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
			}
			else
			{
				if($location=="")
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
				else
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND userid like '%|".md5($location)."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
			}
		}
		
		$res3 = mysqli_query($db,$sel3);
		@$num3 = mysqli_num_rows($res3);
		@$rw3 = mysqli_fetch_array($res3);
		$vid = $rw3["r_user"];
		
		
		
		$ctd = explode("|",$userid);
		
		$CatIDx = viewVehicle($vid,"TYPE");
		
		if($num<=0)
		{
			if($CatID=="")
			{
				if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
				{
					if($location=="")
					{
						$sel2 = "SELECT min(numdata) AS minPrice FROM meta WHERE numdata > '0' AND id IN (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."' GROUP BY userid);";
					}
					else
					{
						$sel2 = "SELECT min(numdata) AS minPrice FROM meta WHERE numdata > '0' AND id IN (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."' AND userid like '%|".md5($location)."' GROUP BY userid);";
					}
				}
				else
				{
					if($location=="")
					{
						$sel2 = "SELECT min(numdata) AS minPrice FROM meta WHERE numdata > '0' AND id IN (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' GROUP BY userid);";
					}
					else
					{
						$sel2 = "SELECT min(numdata) AS minPrice FROM meta WHERE numdata > '0' AND id IN (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' AND userid like '%|".md5($location)."' GROUP BY userid);";
					}
				}
				
				$res2 = mysqli_query($db,$sel2);
				@$num2 = mysqli_num_rows($res2);
				@$rw2 = mysqli_fetch_array($res2);
				$minPrice = $rw2["minPrice"];
				
				if($num2<=0)
				{
					return 0;
				}
				else
				{
					return $minPrice;
				}
			}
			else
			{
				return getCategoryPrice($CatID,$location,$type);
			}
		}
		else
		{
			return $minPrice+getCommision($CatIDx,$location,$type);
		}
			mysqli_free_result($res);
			mysqli_free_result($res2);
			mysqli_free_result($res3);
			mysqli_free_result($res4);
			mysqli_close($db);
	}


	function lowestCategory($location="",$type="LOCAL"){
		
		if($CatID=="")
		{
			if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
			{
				if($location=="")
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' GROUP BY userid );";
				}
				else
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND userid like '%|".md5($location)."' GROUP BY userid );";
				}
			}
			else
			{
				if($location=="")
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' GROUP BY userid );";
				}
				else
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND userid like '%|".md5($location)."' GROUP BY userid );";
				}
			}
		}
		else
		{
			if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
			{
				if($location=="")
				{ 
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
				else
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND userid like '%|".md5($location)."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
			}
			else
			{
				if($location=="")
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
				else
				{
					$sel = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND userid like '%|".md5($location)."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
			}
		}
		include find_file("apps/website/cnct_w.php");
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$minPrice = $rw["minPrice"];
		
		if($CatID=="")
		{
			if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
			{
				if($location=="")
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' GROUP BY userid );";
				}
				else
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND userid like '%|".md5($location)."' GROUP BY userid );";
				}
			}
			else
			{
				if($location=="")
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' GROUP BY userid );";
				}
				else
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND userid like '%|".md5($location)."' GROUP BY userid );";
				}
			}
		}
		else
		{
			if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
			{
				if($location=="")
				{ 
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
				else
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE LOCAL")."' AND userid like '%|".md5($location)."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
			}
			else
			{
				if($location=="")
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
				else
				{
					$sel3 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY FEES PAYABLE OUT OF TOWN")."' AND userid like '%|".md5($location)."' AND r_user IN (SELECT id FROM meta WHERE meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$CatID."|%' AND  syncstate = 'ACTIVE') GROUP BY userid );";
				}
			}
		}
		
		$res3 = mysqli_query($db,$sel3);
		@$num3 = mysqli_num_rows($res3);
		@$rw3 = mysqli_fetch_array($res3);
		$vid = $rw3["r_user"];
		
		
		
		$ctd = explode("|",$userid);
		
		$CatIDx = viewVehicle($vid,"TYPE");
		
		if($num<=0)
		{
			if($CatID=="")
			{
				if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
				{
					if($location=="")
					{
						$sel2 = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."' GROUP BY userid);";
					}
					else
					{
						$sel2 = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."' AND userid like '%|".md5($location)."' GROUP BY userid);";
					}
				}
				else
				{
					if($location=="")
					{
						$sel2 = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' GROUP BY userid);";
					}
					else
					{
						$sel2 = "SELECT min(numdata) AS minPrice FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' AND userid like '%|".md5($location)."' GROUP BY userid);";
					}
				}
				
				$res2 = mysqli_query($db,$sel2);
				@$num2 = mysqli_num_rows($res2);
				@$rw2 = mysqli_fetch_array($res2);
				$minPrice2 = $rw2["minPrice"];
				
				
				
				if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
				{
					if($location=="")
					{
						$sel4 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice2."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."' GROUP BY userid);";
					}
					else
					{
						$sel4 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice2."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."' AND userid like '%|".md5($location)."' GROUP BY userid);";
					}
				}
				else
				{
					if($location=="")
					{
						$sel4 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice2."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' GROUP BY userid);";
					}
					else
					{
						$sel4 = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE numdata = '".$minPrice2."' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' AND userid like '%|".md5($location)."' GROUP BY userid);";
					}
				}
				
				$res4 = mysqli_query($db,$sel4);
				@$num4 = mysqli_num_rows($res4);
				@$rw4 = mysqli_fetch_array($res4);
				$vid2 = $rw4["r_user"];
				
				if($num2<=0)
				{
					return 0;
				}
				else
				{
					return viewVehicle($vid2,"TYPE");
				}
			}
			else
			{
				return $CatID;
			}
		}
		else
		{
			return $CatIDx;
		}
			mysqli_free_result($res);
			mysqli_free_result($res2);
			mysqli_free_result($res3);
			mysqli_free_result($res4);
			mysqli_close($db);
	}


	function quoteForVehicle($vid,$names,$email,$phone,$numDays,$priceperDay,$vehicleType,$mileage_charge,$distance,$driver_rate,$currency,$rental_fee,$startDate){
		
		include find_file("apps/website/cnct_w.php");
		
		$vCode = uniqueCode();
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".md5($vid)."','".$email."|".$phone."','".md5("PORTAL VEHICLE - QUOTATION")."','".$vid."','".$vCode."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			quotationDetails($vCode,$vid,$names,$numDays,$priceperDay,$vehicleType,$mileage_charge,$distance,$driver_rate,$currency,$rental_fee,$startDate);
			
			$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE - QUOTATION")."' AND syncstate = '".$vCode."');";
			$resx = mysqli_query($db,$selx);
			@$numx = mysqli_num_rows($resx);
			@$rw = mysqli_fetch_array($resx);
			$id = $rw["id"];
		
			return $id;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res);
			mysqli_free_result($resx);
			mysqli_close($db);
	}



	function quotationDetails($vCode,$vid,$names,$numDays,$priceperDay,$vehicleType,$mileage_charge,$distance,$driver_rate,$currency,$rental_fee,$startDate){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins1 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$names."','".md5("PORTAL VEHICLE - QUOTATION: NAMES")."','".$vid."','".$vCode."');";
		
		$ins2 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$numDays."','".md5("PORTAL VEHICLE - QUOTATION: NUM DAYS")."','".$vid."','".$vCode."');";
		
		$ins3 = "INSERT INTO meta (id,userid,numdata,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$priceperDay."','".md5("PORTAL VEHICLE - QUOTATION: PRICE PER DAY")."','".$vid."','".$vCode."');";
		
		$ins4 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$vehicleType."','".md5("PORTAL VEHICLE - QUOTATION: VEHICLE TYPE")."','".$vid."','".$vCode."');";
		
		$ins5 = "INSERT INTO meta (id,userid,numdata,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$mileage_charge."','".md5("PORTAL VEHICLE - QUOTATION: MILEAGE CHARGE")."','".$vid."','".$vCode."');";
		
		$ins6 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$distance."','".md5("PORTAL VEHICLE - QUOTATION: DISTANCE")."','".$vid."','".$vCode."');";
		
		$ins7 = "INSERT INTO meta (id,userid,numdata,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$driver_rate."','".md5("PORTAL VEHICLE - QUOTATION: DRIVER RATE")."','".$vid."','".$vCode."');";
		
		$ins8 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$currency."','".md5("PORTAL VEHICLE - QUOTATION: CURRENCY")."','".$vid."','".$vCode."');";
		
		$ins9 = "INSERT INTO meta (id,userid,numdata,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$rental_fee."','".md5("PORTAL VEHICLE - QUOTATION: RENTAL FEE")."','".$vid."','".$vCode."');";
		
		$ins10 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$startDate."','".md5("PORTAL VEHICLE - QUOTATION: START DATE")."','".$vid."','".$vCode."');";
		
		$res1 = mysqli_query($db,$ins1);
		$res2 = mysqli_query($db,$ins2);
		$res3 = mysqli_query($db,$ins3);
		$res4 = mysqli_query($db,$ins4);
		$res5 = mysqli_query($db,$ins5);
		$res6 = mysqli_query($db,$ins6);
		$res7 = mysqli_query($db,$ins7);
		$res8 = mysqli_query($db,$ins8);
		$res9 = mysqli_query($db,$ins9);
		$res10 = mysqli_query($db,$ins10);
		
		if($res1 && $res2 && $res3 && $res4 && $res5 && $res6 && $res7 && $res8 && $res9 && $res10)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res1);
			mysqli_free_result($res2);
			mysqli_free_result($res3);
			mysqli_free_result($res4);
			mysqli_free_result($res5);
			mysqli_free_result($res6);
			mysqli_free_result($res7);
			mysqli_free_result($res8);
			mysqli_free_result($res9);
			mysqli_free_result($res10);
			mysqli_close($db);
	}


	function getQuoteData($order_id,$type){
		
		if($type=="VID")
		{
			$meta = "PORTAL VEHICLE - QUOTATION";
			$sel = "SELECT * FROM meta WHERE (id = '".$order_id."');";
		}
		elseif($type=="NAMES")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: NAMES";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="PHONE")
		{
			$meta = "PORTAL VEHICLE - QUOTATION";
			$sel = "SELECT * FROM meta WHERE id = '".$order_id."');";
		}
		elseif($type=="VCODE")
		{
			$meta = "PORTAL VEHICLE - QUOTATION";
			$sel = "SELECT * FROM meta WHERE (id = '".$order_id."');";
		}
		elseif($type=="EMAIL")
		{
			$meta = "PORTAL VEHICLE - QUOTATION";
			$sel = "SELECT * FROM meta WHERE (id = '".$order_id."');";
		}
		elseif($type=="NUM DAYS")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: NUM DAYS";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="PRICE PER DAY")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: PRICE PER DAY";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="VEHICLE TYPE")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: VEHICLE TYPE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="MILEAGE CHARGE")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: MILEAGE CHARGE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="DISTANCE")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: DISTANCE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="DRIVER RATE")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: DRIVER RATE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="RENTAL FEE")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: RENTAL FEE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="CURRENCY")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: CURRENCY";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="FROM")
		{
			$meta = "PORTAL VEHICLE - QUOTATION: START DATE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		
		//echo "<br>".$type.": ".$sel."<br><br>";
		include find_file("apps/website/cnct_w.php");
		$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$data = $rw["data"];
		$numdata = $rw["numdata"];
		$r_user = $rw["r_user"];
		$syncstate = $rw["syncstate"];
		
		if($type=="VID")
		{
			return $r_user;
		}
		elseif($type=="PHONE")
		{
			$dt = explode("|",$data);
			
			return $dt[1];
		}
		elseif($type=="EMAIL")
		{
			$dt = explode("|",$data);
			
			return $dt[0];
		}
		elseif($type=="VCODE")
		{
			return $syncstate;
		}
		elseif($type=="PRICE PER DAY")         
		{
			return $numdata;
		}
		elseif($type=="MILEAGE CHARGE")
		{
			return $numdata;
		}
		elseif($type=="DRIVER RATE")
		{
			return $numdata;
		}
		elseif($type=="RENTAL FEE")
		{
			return $numdata;
		}
		else
		{
			return $data;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}



	function invoiceForVehicle($vid,$names,$email,$phone,$numDays,$priceperDay,$vehicleType,$mileage_charge,$distance,$driver_rate,$currency,$rental_fee,$startDate){
		
		include find_file("apps/website/cnct_w.php");
		
		$vCode = uniqueCode();
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".md5($vid)."','".$email."|".$phone."','".md5("PORTAL VEHICLE - INVOICE")."','".$vid."','".$vCode."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			quotationDetails($vCode,$vid,$names,$numDays,$priceperDay,$vehicleType,$mileage_charge,$distance,$driver_rate,$currency,$rental_fee,$startDate);
			
			$ss = 1;
		}
		else
		{
			return 0;
			
			$ss = 0;
		}
		
		if($ss==1)
		{
			$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE - INVOICE")."' AND syncstate = '".$vCode."');";
			$resx = mysqli_query($db,$selx);
			@$numx = mysqli_num_rows($resx);
			@$rw = mysqli_fetch_array($resx);
			$id = $rw["id"];
		
			return $id;
		}
			mysqli_free_result($res);
			mysqli_free_result($resx);
			mysqli_close($db);
	}


		

	function bookingDetails($vCode,$vid,$names,$numDays,$priceperDay,$vehicleType,$mileage_charge,$distance,$driver_rate,$currency,$rental_fee,$startDate){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins1 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$names."','".md5("PORTAL VEHICLE - BOOKING: NAMES")."','".$vid."','".$vCode."');";
		
		$ins2 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$numDays."','".md5("PORTAL VEHICLE - BOOKING: NUM DAYS")."','".$vid."','".$vCode."');";
		
		$ins3 = "INSERT INTO meta (id,userid,numdata,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$priceperDay."','".md5("PORTAL VEHICLE - BOOKING: PRICE PER DAY")."','".$vid."','".$vCode."');";
		
		$ins4 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$vehicleType."','".md5("PORTAL VEHICLE - BOOKING: VEHICLE TYPE")."','".$vid."','".$vCode."');";
		
		$ins5 = "INSERT INTO meta (id,userid,numdata,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$mileage_charge."','".md5("PORTAL VEHICLE - BOOKING: MILEAGE CHARGE")."','".$vid."','".$vCode."');";
		
		$ins6 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$distance."','".md5("PORTAL VEHICLE - BOOKING: DISTANCE")."','".$vid."','".$vCode."');";
		
		$ins7 = "INSERT INTO meta (id,userid,numdata,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$driver_rate."','".md5("PORTAL VEHICLE - BOOKING: DRIVER RATE")."','".$vid."','".$vCode."');";
		
		$ins8 = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$currency."','".md5("PORTAL VEHICLE - BOOKING: CURRENCY")."','".$vid."','".$vCode."');";
		
		$ins9 = "INSERT INTO meta (id,userid,numdata,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$rental_fee."','".md5("PORTAL VEHICLE - BOOKING: RENTAL FEE")."','".$vid."','".$vCode."');";

		$ins10 = "INSERT INTO meta (id,userid,numdata,meta_data,r_user,syncstate) VALUES ('','".$vCode."','".$startDate."','".md5("PORTAL VEHICLE - BOOKING: START DATE")."','".$vid."','".$vCode."');";
		//echo "<br>".$ins7;
		$res1 = mysqli_query($db,$ins1);
		$res2 = mysqli_query($db,$ins2);
		$res3 = mysqli_query($db,$ins3);
		$res4 = mysqli_query($db,$ins4);
		$res5 = mysqli_query($db,$ins5);
		$res6 = mysqli_query($db,$ins6);
		$res7 = mysqli_query($db,$ins7);
		$res8 = mysqli_query($db,$ins8);
		$res9 = mysqli_query($db,$ins9);
		$res10 = mysqli_query($db,$ins10);
		
		if($res1 && $res2 && $res3 && $res4 && $res5 && $res6 && $res7 && $res8 && $res9 && $res10)
		{
			return 1;
		}
		else
		{
			return 0;
		}
			mysqli_free_result($res1);
			mysqli_free_result($res2);
			mysqli_free_result($res3);
			mysqli_free_result($res4);
			mysqli_free_result($res5);
			mysqli_free_result($res6);
			mysqli_free_result($res7);
			mysqli_free_result($res8);
			mysqli_free_result($res9);
			mysqli_free_result($res10);
			mysqli_close($db);
	}
		
		
		function getBookingData($order_id,$type){
		
		if($type=="VID")
		{
			$meta = "PORTAL VEHICLE - BOOKING";
			$sel = "SELECT * FROM meta WHERE (id = '".$order_id."');";
		}
		elseif($type=="NAMES")
		{
			$meta = "PORTAL VEHICLE - BOOKING: NAMES";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="PHONE")
		{
			$meta = "PORTAL VEHICLE - BOOKING";
			$sel = "SELECT * FROM meta WHERE id = '".$order_id."');";
		}
		elseif($type=="VCODE")
		{
			$meta = "PORTAL VEHICLE - BOOKING";
			$sel = "SELECT * FROM meta WHERE (id = '".$order_id."');";
		}
		elseif($type=="EMAIL")
		{
			$meta = "PORTAL VEHICLE - BOOKING";
			$sel = "SELECT * FROM meta WHERE (id = '".$order_id."');";
		}
		elseif($type=="NUM DAYS")
		{
			$meta = "PORTAL VEHICLE - BOOKING: NUM DAYS";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="PRICE PER DAY")
		{
			$meta = "PORTAL VEHICLE - BOOKING: PRICE PER DAY";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="VEHICLE TYPE")
		{
			$meta = "PORTAL VEHICLE - BOOKING: VEHICLE TYPE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="MILEAGE CHARGE")
		{
			$meta = "PORTAL VEHICLE - BOOKING: MILEAGE CHARGE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="DISTANCE")
		{
			$meta = "PORTAL VEHICLE - BOOKING: DISTANCE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="DRIVER RATE")
		{
			$meta = "PORTAL VEHICLE - BOOKING: DRIVER RATE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="RENTAL FEE")
		{
			$meta = "PORTAL VEHICLE - BOOKING: RENTAL FEE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="CURRENCY")
		{
			$meta = "PORTAL VEHICLE - BOOKING: CURRENCY";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		elseif($type=="FROM")
		{
			$meta = "PORTAL VEHICLE - BOOKING: START DATE";
			$sel = "SELECT * FROM meta WHERE meta_data = '".md5($meta)."' AND (userid = '".$order_id."' OR id = '".$order_id."');";
		}
		
		//echo "<br>".$type.": ".$sel."<br><br>";
		include find_file("apps/website/cnct_w.php");
		$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$data = $rw["data"];
		$numdata = $rw["numdata"];
		$r_user = $rw["r_user"];
		$syncstate = $rw["syncstate"];
		
		if($type=="VID")
		{
			return $r_user;
		}
		elseif($type=="PHONE")
		{
			$dt = explode("|",$data);
			
			return $dt[1];
		}
		elseif($type=="EMAIL")
		{
			$dt = explode("|",$data);
			
			return $dt[0];
		}
		elseif($type=="VCODE")
		{
			return $syncstate;
		}
		elseif($type=="PRICE PER DAY")         
		{
			return $numdata;
		}
		elseif($type=="MILEAGE CHARGE")
		{
			return $numdata;
		}
		elseif($type=="DRIVER RATE")
		{
			return $numdata;
		}
		elseif($type=="RENTAL FEE")
		{
			return $numdata;
		}
		else
		{
			return $data;
		}
			mysqli_free_result($res);
			mysqli_close($db);
	}


	function bookingStatus($bID,$type="",$details="",$vid=""){
		
		include find_file("apps/website/cnct_w.php");
		
		if($type=="ADD")
		{
			if(strtoupper($details)=="VEHICLE SECURED")
			{
				$vidx = $vid;
			}
			else
			{
				$vidx = "";
			}
			
			$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user) VALUES ('','".$bID."','".$details."','".md5("PORTAL VEHICLE - BOOKING STATUS")."','".$vidx."');";
			$res = mysqli_query($db,$ins);
			
			if($res)
			{
				return 1;
			}
			else
			{
				return 0;
			}
			mysqli_free_result($res);
			mysqli_close($db);
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".$bID."' AND meta_data = '".md5("PORTAL VEHICLE - BOOKING STATUS")."');";
			$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			$numdata = $rw["numdata"];
			$vidz = $rw["r_user"];
			
			if(getBooking($bID,"NUM")>=1)
			{
				if($data=="" || $data==0 || $data=="VEHICLE NOT YET SECURED" || !(isset($data)))
				{
					return "VEHICLE NOT YET SECURED";
				}
				else
				{
					if($type=="VEHICLE")
					{
						return $vidz;
					}
					else
					{
						return $data;
					}
				}
			}
			else
			{
				return 0;
			}
			mysqli_free_result($res);
			mysqli_close($db);
		}
	}



	function bookVehicle($order_id){
		
		$VVCODE = getQuoteData($order_id,"VCODE");
		$vid = getQuoteData($order_id,"VID");
		$names = getQuoteData($VVCODE,"NAMES");	
		$email = getQuoteData($order_id,"EMAIL");
		$phone = getQuoteData($order_id,"PHONE");
		$numDays = getQuoteData($VVCODE,"NUM DAYS");
		$priceperDay = getQuoteData($VVCODE,"PRICE PER DAY");
		$vehicleType = getQuoteData($VVCODE,"VEHICLE TYPE");
		$mileage_charge = getQuoteData($VVCODE,"MILEAGE CHARGE");
		$distance = getQuoteData($VVCODE,"DISTANCE");
		$driver_rate = getQuoteData($VVCODE,"DRIVER RATE");
		$rental_fee = getQuoteData($VVCODE,"RENTAL FEE");
		$currency = getQuoteData($VVCODE,"CURRENCY");
		
		$vCode = uniqueCode();
		include find_file("apps/website/cnct_w.php");
		$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".$order_id."','".$email."|".$phone."','".md5("PORTAL VEHICLE - BOOKING")."','".$vid."','".$vCode."');";
		$res = mysqli_query($db,$ins);
		//echo $ins;
		if($res)
		{
			bookingDetails($vCode,$vid,$names,$numDays,$priceperDay,$vehicleType,$mileage_charge,$distance,$driver_rate,$currency,$startDate,$rental_fee);

			bookingStatus($order_id,"ADD","VEHICLE NOT YET SECURED");
		
			$ss = 1;
		}
		else
		{
			return 0;
			$ss = 0;
		}
		
			
		if($ss==1)
		{
			$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE - BOOKING")."' AND syncstate = '".$vCode."');";
			$resx = mysqli_query($db,$selx);
			@$numx = mysqli_num_rows($resx);
			@$rw = mysqli_fetch_array($resx);
			$id = $rw["id"];
			
			return $id;
			
		}
			mysqli_free_result($res);
			mysqli_free_result($resx);
			mysqli_close($db);
	}


	function listBookingStatuses($type=""){
		
		if(strtoupper($type)=="VEHICLE NOT YET SECURED")
		{
			$search = "VEHICLE NOT YET SECURED";
		}
		elseif(strtoupper($type)=="VEHICLE SECURED")
		{
			$search = "VEHICLE SECURED";
		}
		elseif(strtoupper($type)=="VEHICLE DELIVERED")
		{
			$search = "VEHICLE DELIVERED";
		}
		else
		{
			$search = "VEHICLE NOT YET SECURED";
		}
		
		include find_file("apps/website/cnct_w.php");
		$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE data = '".$search."' AND meta_data = '".md5("PORTAL VEHICLE - BOOKING STATUS")."' GROUP BY userid);";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			
			$array[] = array('num'=>$num,'id'=>$id,'userid'=>$userid,'data'=>$data);
		}
		
		mysqli_free_result($res);
		mysqli_close($db);
		return $array;
	}



	function listBookings($user_id="",$user_id2=""){
		
		include find_file("apps/website/cnct_w.php");

		if($user_id=="")
		{
			if($user_id2=="")
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE - BOOKING")."';";
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE - BOOKING")."' AND (data like '%|".$user_id2."' OR data like '".$user_id2."|%');";
			}
		}
		else
		{
			if($user_id2=="")
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE - BOOKING")."' AND (data like '%|".$user_id."' OR data like '".$user_id."|%');";
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE - BOOKING")."' AND (data like '%|".$user_id."' OR data like '".$user_id."|%' OR data like '%|".$user_id2."' OR data like '".$user_id2."|%');";
			}
		}
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$order_id = $rw["userid"];
			$data = $rw["data"];
			$r_user = $rw["r_user"];
			$vCode = $rw["syncstate"];
			
			$VVCODE = getQuoteData($order_id,"VCODE");
			$vid = getQuoteData($order_id,"VID");
			$names = getQuoteData($VVCODE,"NAMES");	
			$email = getQuoteData($order_id,"EMAIL");
			$phone = getQuoteData($order_id,"PHONE");
			$numDays = getQuoteData($VVCODE,"NUM DAYS");
			$priceperDay = getQuoteData($VVCODE,"PRICE PER DAY");
			$vehicleType = getQuoteData($VVCODE,"VEHICLE TYPE");
			$mileage_charge = getQuoteData($VVCODE,"MILEAGE CHARGE");
			$distance = getQuoteData($VVCODE,"DISTANCE");
			$driver_rate = getQuoteData($VVCODE,"DRIVER RATE");
			$rental_fee = getQuoteData($VVCODE,"RENTAL FEE");
			$currency = getQuoteData($VVCODE,"CURRENCY");
			
			$array[] = array('num'=>$num,'id'=>$id,'order_id'=>$order_id,'name'=>$data,'vid'=>$vid,'vCode'=>$vCode,'names'=>$names,'email'=>$email,'phone'=>$phone,'numdays'=>$numDays,'dailyrate'=>$priceperDay,'vehicleType'=>$vehicleType,'mileage'=>$mileage_charge,'distance'=>$distance,'driver_rate'=>$driver_rate,'rental_fee'=>$rental_fee,'currency'=>$currency);
		}
		
		mysqli_free_result($res);
		mysqli_close($db);
		return $array;
	}


	function getBooking($bID,$type=""){
		
		include find_file("apps/website/cnct_w.php");

		$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".$bID."' AND meta_data = '".md5("PORTAL VEHICLE - BOOKING")."');";
		$resx = mysqli_query($db,$selx);
		@$numx = mysqli_num_rows($resx);
		@$rw = mysqli_fetch_array($resx);
		$id = $rw["id"];
		$data = $rw["data"];
		$vid = $rw["r_user"];
		
		$email = getQuoteData($bID,"EMAIL");
		$phone = getQuoteData($bID,"PHONE");
		
		if($data=="")
		{
			return 0;
		}
		else
		{
			if($type=="NUM")
			{
				return $numx;
			}
			else
			{
				if($type=="CLIENT EMAIL")
				{
					return $email;
				}
				elseif($type=="CLIENT PHONE")
				{
					return $phone;
				}
				elseif($type=="VEHICLE ID")
				{
					return $vid;
				}
			}
		}
		mysqli_free_result($resx);
		mysqli_close($db);
	}



	function addDriverRate($price_within,$price_out){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user) VALUES ('','".uniqueCode()."','".$price_within."|".$price_out."','".md5("PORTAL VEHICLE - DRIVER RATE")."','".$vid."');";
		//echo $ins;
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		mysqli_free_result($res);
		mysqli_close($db);
	}


	function getDriverRate($type){
		
		include find_file("apps/website/cnct_w.php");

		$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE - DRIVER RATE")."');";
		//echo $selx;
		$resx = mysqli_query($db,$selx);
		@$numx = mysqli_num_rows($resx);
		@$rw = mysqli_fetch_array($resx);
		$id = $rw["id"];
		$data = $rw["data"];
		
		$dt = explode("|",$data);
		
		if(strtoupper($type)=="ID")
		{
			return $id;
		}
		else
		{
			if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
			{
				if($dt[0]=="")
				{
					return 0;
				}
				else
				{
					return $dt[0];
				}
			}
			else
			{
				if($dt[1]=="")
				{
					return 0;
				}
				else
				{
					return $dt[1];
				}
			}	
		}
		mysqli_free_result($resx);
		mysqli_close($db);
	}




	function addMileageCharge($price_within,$vehicleCat){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (userid,data,numdata,meta_data,r_user) VALUES ('".md5($vehicleCat)."','0','".$price_within."','".md5("PORTAL VEHICLE - MILEAGE RATE")."','".$vehicleCat."');";
		$res = mysqli_query($db,$ins);
		//echo $ins."<br>";
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		mysqli_free_result($res);
		mysqli_close($db);
	}


	function getMileageCharge($type){
		
		include find_file("apps/website/cnct_w.php");

		$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE - MILEAGE RATE")."' AND userid = '".md5($type)."');";
		$resx = mysqli_query($db,$selx);
		@$numx = mysqli_num_rows($resx);
		@$rw = mysqli_fetch_array($resx);
		$id = $rw["id"];
		$data = $rw["numdata"];
		
		if($data=="")
		{
			return 0;
		}
		else
		{
			return $data;
		}	
		mysqli_free_result($resx);
		mysqli_close($db);
	}


	function bookingCard($vid){
		
		//$message = "Car Reg ".viewVehicle($vid,"REG NUMBER")." has been booked. To confirm its availability reply to this message within 15 minutes with 'AVAIL ".viewVehicle($vid,"REG NUMBER")."'";
	$message = "VP B-Card: ".viewVehicle($vid,"REG NUMBER")."\n
	start: dd/mm/yy\n
	end: dd/mm/yy\n
	to: destination......\n
	income:k00000.00\n
	To confirm reply within 15 mins with 'AVAIL ".viewVehicle($vid,"REG NUMBER")."'";

		$userV = userDetails(viewVehicle($vid,"OWNER"));
		$receiver = $userV["Mobile"];
		$receiverFirstName = $userV["FirstName"];
		$receiverLastName = $userV["LastName"];
		
		$params = array(
	"username" => BULK_SMS_USERNAME(),
	"password" => BULK_SMS_PASSWORD(),
	"type" => "0",
	"dlr" => "1",
	"destination" => $receiver,
	"source" => RETURN_SMS_NUMBER($receiver),
	"message" => $message
		);
	
		httpPost(BULK_SMS_URL(),$params);
		
		@mail();
	}



	function addOneWayRenatalFee($data,$CatID="DEFAULT"){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,meta_data) VALUES ('','".md5($CatID)."','".$data."','".md5("PORTAL VEHICLE ONE WAY RENTAL FEE")."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		mysqli_free_result($res);
		mysqli_close($db);
	}


	function getOneWayRenatalFee(){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE ONE WAY RENTAL FEE")."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["numdata"];
		
		mysqli_free_result($res);
		mysqli_close($db);
		return $data;
	}


	function listOneWayRenatalFees($CatID=""){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE ONE WAY RENTAL FEE")."';";
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["numdata"];
			
			$array[] = array('num'=>$num,'id'=>$id,'name'=>$data);
		}
		
		mysqli_free_result($res);
		mysqli_close($db);
		return $array;
	}


	function deleteOneWayRenatalFee($CatClass){
		
		include find_file("apps/website/cnct_w.php");
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE ONE WAY RENTAL FEE")."';";
		$res = mysqli_query($db,$del);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}	
		mysqli_free_result($res);
		mysqli_close($db);
	}


	function vSearchTime($bID,$type=""){
		
		include find_file("apps/website/cnct_w.php");
		
		$year = date("Y");
		$yearDay = date("z");
		$hour = date("H");
		$min = date("i");
		
		if(date("L")==1)
		{
			$numdays = 366;
		}
		else
		{
			$numdays = 365;
		}
		
		$yearMins = $year*$numdays*24*60;
		$yearDayMins = $yearDay*24*60;
		$hourMins = $hour*60;
		
		$currentMin = $yearMins+$yearDayMins+$hourMins+$min;
		
		if($type=="ADD")
		{
			
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($bID)."','".$currentMin."','".md5("PORTAL VEHICLE MATCHING VEHICLE SEARCH ROUTINE START TIME")."');";
			$res = mysqli_query($db,$ins);
			
			if($res)
			{
				return 1;
			}
			else
			{
				return 0;
			}
			mysqli_free_result($res);
			mysqli_close($db);
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5($bID)."' AND meta_data = '".md5("PORTAL VEHICLE MATCHING VEHICLE SEARCH ROUTINE START TIME")."');";
			$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["data"];
			
			if($data=="" || $data==0 || !(isset($data)))
			{
				return 0;
			}
			else
			{
				return $data;
			}
			mysqli_free_result($res);
			mysqli_close($db);
		}
	}


	function vSearches($bID,$type=""){
		
		include find_file("apps/website/cnct_w.php");
		
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($bID)."','1','".md5("PORTAL VEHICLE MATCHING VEHICLE SEARCH ROUTINE")."');";
			$res = mysqli_query($db,$ins);
			
			if($res)
			{
				return 1;
			}
			else
			{
				return 0;
			}
			mysqli_free_result($res);
			mysqli_close($db);
		}
		else
		{
			$sel = "SELECT sum(data) AS sumSearches FROM meta WHERE userid = '".md5($bID)."' AND meta_data = '".md5("PORTAL VEHICLE MATCHING VEHICLE SEARCH ROUTINE")."';";
			$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			@$rw = mysqli_fetch_array($res);
			$data = $rw["sumSearches"];
			
			mysqli_free_result($res);
			mysqli_close($db);
			return $data;
		}
	}


	function contactCityDrive($order_id){

	
	// EDIT THE 2 LINES BELOW AS REQUIRED
	$from = "reservations@vehicleportal.co.zm";
	$subject = "Vehicle Portal Booking Card";
	$no_reply = "no-reply@vehicleportal.co.zm";
	
	$VVCODE = getQuoteData($order_id,"VCODE");
	$vid = getQuoteData($order_id,"VID");
	$names = getQuoteData($VVCODE,"NAMES");	
	$email = getQuoteData($order_id,"EMAIL");
	$phone = getQuoteData($order_id,"PHONE");
	$numDays = getQuoteData($VVCODE,"NUM DAYS");
	$priceperDay = getQuoteData($VVCODE,"PRICE PER DAY");
	$vehicleTypeName = getQuoteData($VVCODE,"VEHICLE TYPE");
	$mileage_charge = getQuoteData($VVCODE,"MILEAGE CHARGE");
	$distance = getQuoteData($VVCODE,"DISTANCE");
	$driver_rate = getQuoteData($VVCODE,"DRIVER RATE");
	$rental_fee = getQuoteData($VVCODE,"RENTAL FEE");
	$currency = getQuoteData($VVCODE,"CURRENCY");
	$first_name = getUserData(viewVehicle($vid,"OWNER"),"FirstName"); // required
	$last_name = getUserData(viewVehicle($vid,"OWNER"),"LastName"); // required
	$owner_email = getUserData(viewVehicle($vid,"OWNER"),"Email"); // required
	$owner_mobile = getUserData(viewVehicle($vid,"OWNER"),"Mobile"); // required
	
	$location = viewVehicle($vid,"LOCATION");
	$vehicleType = viewVehicle($vid,"VEHICLE TYPE");
	$make = viewVehicle($vid,"MAKE");
	$yearMake = viewVehicle($vid,"YEAR");
	$consumptionRate = viewVehicle($vid,"FUEL CONSUMPTION RATE");
	$fuelType = viewVehicle($vid,"FUEL TYPE");
		
	$email_message = "<b><u>Booking Card</u></b><br>";
	$email_message .= "Vehicle Registration Number: ".viewVehicle($vid,"REG NUMBER")." has been booked. Location is ".getTown(viewVehicle($vid,"LOCATION")).". Confirmation of availability is required from ".$first_name." ".$last_name.", Mobile Number ".$owner_mobile." and Email Address ".$owner_email.".<br><br>\n\n";
	
	
	$limit = 10;
	
	$count = showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType,$make,$yearMake,$consumptionRate,$fuelType);
	$array = showSimilarVehicles("DATA",$vid,$limit,$location,$vehicleType,$make,$yearMake,$consumptionRate,$fuelType);
	if($count<$limit)
	{
		$limit = $limit-$count;
		$count = showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType,$make,$yearMake,$consumptionRate,$fuelType);
		$array = showSimilarVehicles("DATA",$vid,$limit,$location,$vehicleType,$make,$yearMake,$consumptionRate,$fuelType);
		if($count<$limit)
		{
			//$limit = $limit-$count;
			$count = showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType,$make,$yearMake,"",$fuelType);
			$array = showSimilarVehicles("DATA",$vid,$limit,$location,$vehicleType,$make,$yearMake,"",$fuelType);
			if($count<$limit)
			{
				//$limit = $limit-$count;
				$count = showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType,$make,$yearMake);
				$array = showSimilarVehicles("DATA",$vid,$limit,$location,$vehicleType,$make,$yearMake);
				if($count<$limit)
				{
					//$limit = $limit-$count;
					$count = showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType,$make);
					$array = showSimilarVehicles("DATA",$vid,$limit,$location,$vehicleType,$make);
					if($count<$limit)
					{
						//$limit = $limit-$count;
						$count = showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType);
						$array = showSimilarVehicles("DATA",$vid,$limit,$location,$vehicleType);
					}
				}
			}
		}
	}

	if($count>=1)
	{
		$email_message .= "Similar Vehicles are listed below: <br><br>\n\n";
		
		for($x=0; $x<$count; $x++)
		{
			$email_message .= "Vehicle ".($x+1).":<br>\n";
			//$email_message .= "VID. ".$array[$x]["id"]."<br>\n";
			$email_message .= "REG No. ".viewVehicle($array[$x]["id"],"REG NUMBER")."<br>\n";
			$email_message .= "OWNER NAME ".getUserData(viewVehicle($array[$x]["id"],"OWNER"),"FirstName")." ".getUserData(viewVehicle($array[$x]["id"],"OWNER"),"LastName")."<br>\n";
			$email_message .= "OWNER MOBILE ".getUserData(viewVehicle($array[$x]["id"],"OWNER"),"Mobile")."<br>\n";
			$email_message .= "OWNER EMAIL ".getUserData(viewVehicle($array[$x]["id"],"OWNER"),"Email")."<br><br>\n\n";
		}
	}
	else
	{
		$email_message .= "There are not similar Vehicles available in ".getTown(viewVehicle($vid,"LOCATION"))." <br><br>\n\n";
	}
	
		//echo $email_message;
		
		if(email($subject,$email_message,$no_reply,$from))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	
		//////////////////////MAILER////////////////////////////////////////////
	}


	function showSimilarVehicles($type="DATA",$vid,$limit,$location,$vehicleType,$make="",$yearMake="",$consumptionRate="",$fuelType=""){
		
		include find_file("apps/website/cnct_w.php");
		
		$search_par = "";
		
		if($make=="")
		{
			
		}
		else
		{
			$search_par .= " AND data like '%|".$make."|%'";
		}	
		
		if($fuelType=="")
		{
			
		}
		else
		{
			$search_par .= " AND data like '%|".$fuelType."'";
		}	
		
		if($yearMake=="")
		{
			
		}
		else
		{
			$search_par .= " AND data like '%|".$yearMake."|%'";
		}
		
		if($consumptionRate=="")
		{
			
		}
		else
		{
			$search_par .= " AND data like '%|".$consumptionRate."|%'";
		}
		
		if($type=="NUM")
		{
			$sel = "SELECT count(id) AS maxNum FROM meta WHERE id != '".$vid."' AND meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$vehicleType."|%' AND data like '%|".$location."|%' AND syncstate = 'ACTIVE' ".$search_par." LIMIT 0,".$limit.";";
			//echo $sel."<br><br>";
			$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array($res);
			$num = $rw["maxNum"];
			
			mysqli_free_result($res);
			mysqli_close($db);
			return $num;
		}
		else
		{
			$sel = "SELECT * FROM meta WHERE id != '".$vid."' AND meta_data = '".md5("REGISTERED VEHICLE")."' AND data like '".$vehicleType."|%' AND data like '%|".$location."|%' AND syncstate = 'ACTIVE' ".$search_par." LIMIT 0,".$limit.";";
			$res = mysqli_query($db,$sel);
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array($res);
				$id = $rw["id"];
				$userid = $rw["userid"];
				$data = $rw["data"];
				
				$ex = explode("|",$data);
				$vehicletype = $ex[0];
				$vehiclemake = $ex[1];
				$year = $ex[2];
				$regnumber = $ex[3];
				$location = $ex[4];
				$conrate = $ex[5];
			
				$userV = userDetails(viewVehicle($vid,"OWNER"));
				$Mobile = $userV["Mobile"];
				
				$array[] = array('num'=>$num,'id'=>$id,'owner'=>$userid,'type'=>$vehicletype,'make'=>$vehiclemake,'year'=>$year,'reg'=>$regnumber,'location'=>$location,'conrate'=>$conrate);
			}
				
			mysqli_free_result($res);
			mysqli_close($db);
			return $array;
		}
	}


	function listSimilarVehicles($vid,$limit){
		
		$vehicleType = viewVehicle($vid,"VEHICLE TYPE");
		$OWNERx = viewVehicle($vid,"OWNER");
		$make = viewVehicle($vid,"MAKE");
		$yearMake = viewVehicle($vid,"YEAR");
		$REGx = viewVehicle($vid,"REG NUMBER");
		$location = viewVehicle($vid,"LOCATION");
		$consumptionRate = viewVehicle($vid,"FUEL CONSUMPTION RATE");
		
		$list = showSimilarVehicles($vid,$limit,$location,$vehicleType,$make="",$yearMake="",$consumptionRate="");
		
		if(showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType,$make,$yearMake,$consumptionRate)>=$limit)
		{
			$num = showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType,$make,$yearMake,$consumptionRate);
			
			for($a=0; $a<$num; $a++)
			{
				$array[] = array('num'=>$num,'vid'=>$list[$a]['id']);
			}
			
			return $array;
		}
		else
		{
			if(showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType,$make,$yearMake,$consumptionRate)<=0)
			{
				contactCityDrive($bID,"NO VEHICLES FOUND");
				$num = 0;
				return 0;
			}
			else
			{
				$num = showSimilarVehicles("NUM",$vid,$limit,$location,$vehicleType,$make,$yearMake,$consumptionRate);
				
				for($a=0; $a<$num; $a++)
				{
					$array[] = array('num'=>$num,'vid'=>$list[$a]['id']);
				}
				
				return $array;
			}
		}
	}


	function searchVehicle($bID,$limit="1"){
		
		$vid = getQuoteData($order_id,"VID");
		
		if($limit=="1")
		{
			bookingCard($vid);
		}
		else
		{
			$similarVehicles = listSimilarVehicles($vid,$limit);
			for($a=0; $a<$similarVehicles[0]['num']; $a++)
			{
				bookingCard($similarVehicles[$a]['vid']);
			}
		}
	}


	function searchRoutine($bID){
		
		$year = date("Y");
		$yearDay = date("z");
		$hour = date("H");
		$min = date("i");
		
		if(date("L")==1)
		{
			$numdays = 366;
		}
		else
		{
			$numdays = 365;
		}
		
		$yearMins = $year*$numdays*24*60;
		$yearDayMins = $yearDay*24*60;
		$hourMins = $hour*60;
		
		$currentMin = $yearMins+$yearDayMins+$hourMins+$min;
		
		if(bookingStatus($bID)=="VEHICLE NOT YET SECURED")
		{
			if(vSearches($bID)==0 && ($currentMin-vSearchTime($bID))>=15)
			{
				if(vSearches($bID,"ADD") && searchVehicle($bID,"1"))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			elseif(vSearches($bID)==1 && ($currentMin-vSearchTime($bID))>=30)
			{
				if(vSearches($bID,"ADD") && searchVehicle($bID,"3"))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			elseif(vSearches($bID)==2 && ($currentMin-vSearchTime($bID))>=45)
			{
				if(vSearches($bID,"ADD") && searchVehicle($bID,"6"))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			elseif(vSearches($bID)==3 && ($currentMin-vSearchTime($bID))>=60)
			{
				if(vSearches($bID,"ADD") && searchVehicle($bID,"16"))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			elseif(vSearches($bID)==4 && ($currentMin-vSearchTime($bID))>=75)
			{
				if(vSearches($bID,"ADD") && contactCityDrive($bID))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		else
		{
			return 0;
		}
	}


	function addBIDtoREG($vreg,$bID){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5(cleanupData($vreg))."','".$bID."','".md5("PORTAL VEHICLE BID TO REG")."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}	
		mysqli_free_result($res);
		mysqli_close($db);
	}


	function getBIDfromREG($vreg){
		
		include find_file("apps/website/cnct_w.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5(cleanupData($vreg))."' AND meta_data = '".md5("PORTAL VEHICLE BID TO REG")."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		mysqli_free_result($res);
		mysqli_close($db);
		return $data;
	}


	function SMS_RECORD_DATA($type,$class="",$datax=""){
		
		include find_file("apps/website/cnct_w.php");
		
		if($type=="LIST")
		{

			$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("SMS DATA RECORD")."' AND id = '".$type."');";
			$resx = mysqli_query($db,$selx);
			@$numx = mysqli_num_rows($resx);
			for($a=0; $a<$numx; $a++)
			{
				@$rw = mysqli_fetch_array($resx);
				$id = $rw["id"];
				$userid = $rw["userid"];
				$data = $rw["data"];
				
				$ex = explode("|",$data);
				
				$array[] = array('num'=>$numx,'id'=>$id,'userid'=>$userid,'from'=>$ex[0],'text'=>$ex[1],'status'=>$ex[2],'date'=>$ex[3],'dtype'=>$ex[4],'type'=>$ex[5]);
			}
			
			mysqli_free_result($resx);
			mysqli_close($db);
			return $array;
		}
		else
		{
			$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("SMS DATA RECORD")."' AND id = '".$type."');";
			$resx = mysqli_query($db,$selx);
			@$numx = mysqli_num_rows($resx);
			@$rw = mysqli_fetch_array($resx);
			$id = $rw["id"];
			$data = $rw["data"];
			
			mysqli_free_result($resx);
			mysqli_close($db);
		
			if($data=="")
			{
				return 0;
			}
			else
			{
				$ex = explode("|",$data);
				
				if($class=="FROM")
				{
					return $ex[0];
				}
				elseif($class=="TEXT")
				{
					return $ex[1];
				}
				elseif($class=="STATUS")
				{
					return $ex[2];
				}
				elseif($class=="DATE")
				{
					return $ex[3];
				}
				elseif($class=="DTYPE")
				{
					return $ex[4];
				}
				elseif($class=="TYPE")
				{
					return $ex[5];
				}
			}	
		}
	}


	function add_booking_to_board($vreg){
		
		$bID = getBIDfromREG($vreg);
		$vid = getVIDfromREG($vreg);
		
		if(bookingStatus($bID,"ADD","VEHICLE SECURED",$vid)==1)
		{		
			return 1;
		}
		else
		{
			return 0;
		}
	}


	function INBOUND_SMS($from,$text,$status,$date,$dtype,$type){
		
		include find_file("apps/website/cnct_w.php");
		
		$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user) VALUES ('','".$from."','".$from."|".$status."|".$date."|".$dtype."|".$type."','".md5("SMS DATA RECORD")."','".$vid."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			$vreg = str_replace(cleanupData($text),"AVAIL","");
			
			add_booking_to_board($vreg);
			
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_free_result($res);
		mysqli_close($db);
	}
?>