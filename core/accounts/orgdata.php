<?php 

if(function_exists('listOrgs'))
{
	
}
else
{
	function listOrgs($type="",$limiter="",$product="",$category=""){
		
		
			
		if($type=="ACTIVE")
		{
			$query = "SELECT * FROM _organization WHERE status = 'Active' ".$limiter.";";
		}
		elseif($type=="INACTIVE")
		{
			$query = "SELECT * FROM _organization WHERE status = 'Inactive' ".$limiter.";";
		}
		elseif($type=="ALL")
		{
			$query = "SELECT * FROM _organization ".$limiter.";";
		}
		elseif($type=="SUSPENDED")
		{
			$query = "SELECT * FROM _organization WHERE status = 'Suspended' ".$limiter.";";
		}
		elseif($type=="STORE")
		{
			if(!($product==""))
			{
				
				include find_file('cnct_uagro.php');
				
				$wsel2 = "SELECT userid FROM meta WHERE meta_data = '".md5("PRODUCT LISTED FOR SALE")."';";
				//echo $wsel2."<br><br>";
				$wres2 = mysqli_query($db,$wsel2);
				@$wnum2 = mysqli_num_rows($wres2);
				$wlistx = "";
				for($b2=0; $b2<$wnum2; $b2++)
				{
					@$wrw2 = mysqli_fetch_array($wres2);
					
					if($b2==0)
					{
						$wlistx .= "'".$wrw2["userid"]."'";
					}
					else
					{
						$wlistx .= ",'".$wrw2["userid"]."'";
					}
				}
				mysqli_close($db);
				
				//echo "test: ".$wlistx."<br><br>";
				$productLimiter = " WHERE userID IN (".$wlistx.")";
			}
			else
			{
				$productLimiter = "";
			}
			
			if(!($category=="") || !($store==""))
			{
				if(!($product==""))
				{
					$where = " AND";
				}
				else
				{
					$where = " AND";
				}
				
				
				if(!($store==""))
				{
					if(!($category==""))
					{
						$wsel = "SELECT userid FROM meta WHERE meta_data = '".md5("PRODUCT LISTED FOR SALE")."' AND data IN (SELECT pID FROM product WHERE pCategory IN (SELECT catID FROM productcategories WHERE catName = '".$category."' OR catType = '".$category."' OR catID = '".$category."' OR classification = '".$category."'));";
					}
					else
					{
						$wsel = "SELECT userid FROM meta WHERE meta_data = '".md5("PRODUCT LISTED FOR SALE")."';";
					}
				}
				else
				{
					$wsel = "SELECT userid FROM meta WHERE meta_data = '".md5("PRODUCT LISTED FOR SALE")."' AND data IN (SELECT pID FROM product WHERE pCategory IN (SELECT catID FROM productcategories WHERE catName = '".$category."' OR catType = '".$category."' OR catID = '".$category."' OR classification = '".$category."'));";
				}
				
				include find_file('cnct_uagro.php');
				
				//echo $wsel."<br><br>";
				$wres = mysqli_query($db,$wsel);
				@$wnum = mysqli_num_rows($wres);
				$wlist = "";
				for($b=0; $b<$wnum; $b++)
				{
					@$wrw = mysqli_fetch_array($wres);
					
					if($b==0)
					{
						$wlist .= "'".$wrw["userid"]."'";
					}
					else
					{
						$wlist .= ",'".$wrw["userid"]."'";
					}
				}
				mysqli_close($db);
				
				//echo "test: ".$wlist."<br><br>";
				
				$categoryLimiter = $where." vCode IN (".$wlist.")";
			}
			else
			{
				$categoryLimiter = "";
			}
			
			$query = "SELECT * FROM _organization WHERE status = 'Active' AND (enableStore = '1' OR enableStore = 'Yes') ".$productLimiter." ".$categoryLimiter." ".$limiter.";";
		}
		
		//echo "test: ".$query."<br><br>";
		
		include find_file("cnct.php");
		
		@$result = mysqli_query($db,$query);
		@$num = mysqli_num_rows(@$result);
		
		// check for empty result
		if ($num>=1) 
		{
			for($a=0; $a<$num; $a++)
			{	
				$row = mysqli_fetch_array(@$result);	
				$orgID = $row["id"];
				$name = $row["name"];
				$shortname = $row["shortname"];
				$TPIN = $row["TPIN"];
				$reg_number = $row["reg_number"];
				$postal = $row["postal"];
				$physical = $row["physical"];
				$phone = $row["phone"];
				$email = $row["email"];
				$vCode = $row["vCode"];
				$enableStore = $row["enableStore"];
				$status = $row["status"];
				$town = $row["town"];
				$province = $row["province"];
				$country = $row["country"];
				$enableStore = $row["enableStore"];
				
				$proq = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$orgID."' AND meta_data = '".md5("COMPANY LOGO")."');";
				@$respro = mysqli_query($db,$proq);
				@$prow = mysqli_fetch_array(@$respro);
				$logo = $prow["data"];	
				
				$array[] = array('num'=>$num,'orgID'=>$orgID,'name'=>$name,'shortname'=>$shortname,'TPIN'=>$TPIN,'reg_number'=>$reg_number,'postal'=>$postal,'physical'=>$physical,'phone'=>$phone,'email'=>$email,'vCode'=>$vCode,'enableStore'=>$enableStore,'status'=>$status,'town'=>$town,'province'=>$province,'country'=>$country,'enableStore'=>$enableStore,'logo'=>$logo);
			}
			
			return $array;
		}
		else 
		{
		return 0;
		}
		mysqli_close($db);
	}
}
 

if(function_exists('addUserToOrg'))
{
	
}
else
{
	function addUserToOrg($vCode,$userID,$userLevel){
		include find_file("cnct.php");
		
		$query = "INSERT INTO meta(id,userid,data,meta_data,r_user) VALUES('','".$vCode."','".$userID."','".md5("ORGANIZATION USER")."','".$userLevel."');";

		@$result = mysqli_query($db,$query);
		// check if row inserted or not
		if (@$result) 
		{
			return 1;
		}
		else 
		{
			return 0;
		}
		mysqli_close($db);
	}
}
 

if(function_exists('listOrgsForUser'))
{
	
}
else
{
	function listOrgsForUser($userID){
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE data = '".$userID."' AND meta_data = '".md5("ORGANIZATION USER")."' GROUP BY userid);";
		//echo $sel."<br><br>";
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		for($a=0; $a<$num; $a++)
		{
			@$rw = mysqli_fetch_array(@$res);
			$org_vCode = $rw["userid"];
			$user = $rw["data"];
			$level = $rw["r_user"];
			
			$array[] = array('num'=>$num,'vCode'=>$org_vCode,'userID'=>$user,'level'=>$level);
		}
		return $array;
		
		mysqli_close($db);
	}
}
 

if(function_exists('getOrgUserLevel'))
{
	
}
else
{
	function getOrgUserLevel($vCode,$userID){
		include find_file("cnct.php");	
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".$vCode."' AND data = '".$userID."' AND meta_data = '".md5("ORGANIZATION USER")."');";
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		if($num>=1)
		{
			@$rw = mysqli_fetch_array(@$res);
			$org_vCode = $rw["userid"];
			$user = $rw["data"];
			$level = $rw["r_user"];
			
			return $level;
		}
		else
		{
			return "";
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('removeUserFromOrg'))
{
	
}
else
{
	function removeUserFromOrg($vCode,$userID){
		include find_file("cnct.php");	
		
		$sel = "SELECT FROM meta WHERE userid = '".$vCode."' AND data = '".$userID."' AND meta_data = '".md5("ORGANIZATION USER")."';";
		@$res = mysqli_query($db,$sel);
		if(@$res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('createOrgAccount'))
{
	
}
else
{
	function createOrgAccount($userID,$orgname,$shortname,$regNumber,$TPIN,$emailAdd,$phoneNumber,$Address,$postal){
		// include db connect class

		
		
		if(checkOrgAccount("ALL",$phoneNumber)==1 || checkOrgAccount("ALL",$shortname)==1 || checkOrgAccount("ALL",$emailAdd)==1 || checkOrgAccount("ALL",$regNumber)==1 || checkOrgAccount("ALL",$TPIN)==1 || checkOrgAccount("ALL",$orgname)==1)
		{	
			return 2;
		}
		else
		{
			$userx = userDetails($userID);
			
			include find_file("cnct.php");
			
			$vCode = uniqueCode();
			
			$query = "INSERT INTO _organization(id,name,shortname,reg_number,TPIN,postal,physical,phone,email,town,province,country,status,vCode) VALUES('','".$orgname."','".strtolower($shortname)."','".$regNumber."','".$TPIN."','".$postal."','".$Address."','".standadizesMobile($phoneNumber)."','".$emailAdd."','".$userx["town"]."','".$userx["province"]."','".$userx["Country"]."','Inactive','".$vCode."');";

			//echo $query."<br><br>";
			@$result = mysqli_query($db,$query);
			// check if row inserted or not
			if (@$result) 
			{
				addUserToOrg($vCode,$userID,"-1");
				return 1;
			}
			else 
			{
				return 0;
			}
			mysqli_close($db);
		}
	}
}
 

if(function_exists('editOrgAccount'))
{
	
}
else
{
	function editOrgAccount($vCode,$orgname,$shortname,$regNumber,$TPIN,$emailAdd,$phoneNumber,$Address,$postal,$town,$province,$country){
		// include db connect class

		include find_file("cnct.php");
		
		$vCode = uniqueCode();
		
		$query = "UPDATE _organization SET (name='".$orgname."',shortname='".strtolower($shortname)."',reg_number='".$regNumber."',TPIN='".$TPIN."',postal='".$postal."',physical='".$Address."',phone='".standadizesMobile($phoneNumber)."',email='".$emailAdd."',town='".$town."',province='".$province."',country='".$country."') WHERE vCode = '".$vCode."';";

		//echo $query."<br><br>";
		@$result = mysqli_query($db,$query);
		// check if row inserted or not
		if (@$result) 
		{
			return 1;
		}
		else 
		{
			return 0;
		}
		mysqli_close($db);

	}
}
 

if(function_exists('checkOrgAccount'))
{
	
}
else
{
	function checkOrgAccount($type,$userAccount){
		
		include find_file("cnct.php");
			
		if($type=="ACTIVE")
		{
			$query = "SELECT COUNT(id) AS NUM FROM _organization WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."') AND status = 'Active';";
		}
		elseif($type=="INACTIVE")
		{
			$query = "SELECT COUNT(id) AS NUM FROM _organization WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."') AND status = 'Inactive';";
		}
		elseif($type=="ALL")
		{
			$query = "SELECT COUNT(id) AS NUM FROM _organization WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."');";
		}
		elseif($type=="SUSPENDED")
		{
			$query = "SELECT COUNT(id) AS NUM FROM _organization WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."') AND status = 'Suspended';";
		}
		elseif($type=="STORE")
		{
			$query = "SELECT COUNT(id) AS NUM FROM _organization WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."') AND status = 'Active' AND (enableStore = '1' OR enableStore = 'Yes');";
		}
		elseif($type=="UNIQUE")
		{
			$query = "SELECT COUNT(id) AS NUM FROM _organization WHERE (shortname = '".strtolower($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."');";
		}
		
		//echo "test: ".$query."<br><br>";
		
		@$result = mysqli_query($db,$query);
		$row = mysqli_fetch_array(@$result);
		$num = $row["NUM"];
		
		
		// check for empty result
		if ($num>=1) 
		{
			return 1;
		}
		else 
		{
		return 0;
		}
		mysqli_close($db);
	}
}
 

if(function_exists('activateOrg'))
{
	
}
else
{
	function activateOrg($userAccount){
			
		include find_file("cnct.php");

		$insd = "UPDATE _organization SET status = 'Active' WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."');";
		//echo $insd;
		@$resd = mysqli_query($db,$insd);
		
		if(@$resd)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('deactivateOrg'))
{
	
}
else
{
	function deactivateOrg($userAccount){
			
		include find_file("cnct.php");

		$insd = "UPDATE _organization SET status = 'Inactive' WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."');";
		//echo $insd;
		@$resd = mysqli_query($db,$insd);
		
		if(@$resd)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('suspendOrg'))
{
	
}
else
{
	function suspendOrg($userAccount){
			
		include find_file("cnct.php");

		$insd = "UPDATE _organization SET status = 'Suspended' WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."');";
		//echo $insd;
		@$resd = mysqli_query($db,$insd);
		
		if(@$resd)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('enableOrgStore'))
{
	
}
else
{
	function enableOrgStore($userAccount){
			
		include find_file("cnct.php");

		$insd = "UPDATE _organization SET enableStore = '1' WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."');";
		//echo $insd;
		@$resd = mysqli_query($db,$insd);
		
		if(@$resd)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('disableOrgStore'))
{
	
}
else
{
	function disableOrgStore($userAccount){
			
		include find_file("cnct.php");

		$insd = "UPDATE _organization SET enableStore = '0' WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."');";
		//echo $insd;
		@$resd = mysqli_query($db,$insd);
		
		if(@$resd)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('orgID'))
{
	
}
else
{
	function orgID($userAccount){
			
		include find_file("cnct.php");
		
		$query = "SELECT max(id) AS maxID FROM _organization WHERE (id = '".$userAccount."' OR shortname = '".strtolower($userAccount)."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."' OR vCode = '".$userAccount."');";
		//echo $query."<br>";
		@$result = mysqli_query($db,$query);
		$num = mysqli_num_rows(@$result);
		// check for empty result
		if ($num>=1) 
		{
			$row = mysqli_fetch_array(@$result);
			$userID = $row["maxID"];	
			
			return $userID;
		}
		else 
		{
		return 0;
		}
		mysqli_close($db);
	}
}
 

if(function_exists('orgData'))
{
	
}
else
{
	function orgData($orgID){
		
		include find_file("cnct.php");

		$session_query = "SELECT * FROM _organization WHERE id = '".$orgID."';";
		
		//echo $session_query."<br>";
		$sess_res = mysqli_query($db,$session_query);
		@$num_sess = mysqli_num_rows($sess_res);
		$row_sess = mysqli_fetch_array($sess_res);
		$orgID = $row_sess["id"];
		$name = $row_sess["name"];
		$shortname = $row_sess["shortname"];
		$TPIN = $row_sess["TPIN"];
		$reg_number = $row_sess["reg_number"];
		$postal = $row_sess["postal"];
		$physical = $row_sess["physical"];
		$phone = $row_sess["phone"];
		$email = $row_sess["email"];
		$vCode = $row_sess["vCode"];
		$enableStore = $row_sess["enableStore"];
		$status = $row_sess["status"];
		$town = $row_sess["town"];
		$province = $row_sess["province"];
		$country = $row_sess["country"];
		$enableStore = $row_sess["enableStore"];
		
		$proq = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$orgID."' AND meta_data = '".md5("COMPANY LOGO")."');";
		@$respro = mysqli_query($db,$proq);
		@$prow = mysqli_fetch_array(@$respro);
		$logo = $prow["data"];	
		
		mysqli_close($db);
		
		$array = array('orgID'=>$orgID,'name'=>$name,'shortname'=>$shortname,'TPIN'=>$TPIN,'reg_number'=>$reg_number,'postal'=>$postal,'physical'=>$physical,'phone'=>$phone,'email'=>$email,'vCode'=>$vCode,'enableStore'=>$enableStore,'status'=>$status,'town'=>$town,'province'=>$province,'country'=>$country,'enableStore'=>$enableStore,'logo'=>$logo);
		
		return $array;
		
	}
}
 

if(function_exists('getOrgName'))
{
	
}
else
{
	function getOrgName($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["name"];	
		}
		else
		{
			$Name = $orgID;
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgVCode'))
{
	
}
else
{
	function getOrgVCode($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["vCode"];	
		}
		else
		{
			$Name = $orgID;
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgShortName'))
{
	
}
else
{
	function getOrgShortName($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["shortname"];	
		}
		else
		{
			$Name = $orgID;
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgphone'))
{
	
}
else
{
	function getOrgphone($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["phone"];	
		}
		else
		{
			$Name = standadizesMobile($orgID);
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgEmail'))
{
	
}
else
{
	function getOrgEmail($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["email"];	
		}
		else
		{
			$Name = $orgID;
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgRegNumber'))
{
	
}
else
{
	function getOrgRegNumber($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["reg_number"];	
		}
		else
		{
			$Name = "";
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgTaxNumber'))
{
	
}
else
{
	function getOrgTaxNumber($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["TPIN"];	
		}
		else
		{
			$Name = "";
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgPhysicalAddress'))
{
	
}
else
{
	function getOrgPhysicalAddress($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["physical"];	
		}
		else
		{
			$Name = "";
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgPostalAddress'))
{
	
}
else
{
	function getOrgPostalAddress($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["postal"];	
		}
		else
		{
			$Name = "";
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgTown'))
{
	
}
else
{
	function getOrgTown($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["town"];	
		}
		else
		{
			$Name = "";
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgProvince'))
{
	
}
else
{
	function getOrgProvince($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["province"];	
		}
		else
		{
			$Name = "";
		}
		
		return $Name;
	}
}
 

if(function_exists('getOrgCountry'))
{
	
}
else
{
	function getOrgCountry($orgID,$type=""){
		
		if(checkOrgAccount("ALL",$orgID)==1)
		{
			$orgID = orgID($orgID);
			
			$userArray = orgData($orgID);
			
			$Name = $userArray["country"];	
		}
		else
		{
			$Name = "";
		}
		
		return $Name;
	}
}
 

if(function_exists('addOrgProfilePicture'))
{
	
}
else
{
	function addOrgProfilePicture($userID,$image){
		
		include find_file("cnct.php");
		
		$insertXA = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".md5($userID)."','".$image."','".md5("ORGANIZATION PROFILE PICTURE")."','');";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		mysqli_close($db);
	}
}
 

if(function_exists('getOrgProfilePicture'))
{
	
}
else
{
	function getOrgProfilePicture($userID){
		
		include find_file("cnct.php");
		
		$insertXA = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5($userID)."' AND meta_data = '".md5("ORGANIZATION PROFILE PICTURE")."');";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			@$num = mysqli_num_rows(@$resINSXA);
			@$rw = mysqli_fetch_array(@$resINSXA);
			$profile = $rw["data"];
			
			if($num==1)
			{
				return $profile;
			}
			else
			{
				return "corp_profile_pic.png";
			}
			
		}
		else
		{
			return "corp_profile_pic.png";
		}
		mysqli_close($db);
	}
}
 

if(function_exists('addOrgCoverImage'))
{
	
}
else
{
	function addOrgCoverImage($userID,$image){
		
		include find_file("cnct.php");
		
		$insertXA = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".md5($userID)."','".$image."','".md5("ORGANIZATION COVER IMAGE")."','');";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		mysqli_close($db);
	}
}
 

if(function_exists('getOrgCoverImage'))
{
	
}
else
{
	function getOrgCoverImage($orgID){
		
		include find_file("cnct.php");
		
		$insertXA = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5($orgID)."' AND meta_data = '".md5("ORGANIZATION COVER IMAGE")."');";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			@$num = mysqli_num_rows(@$resINSXA);
			@$rw = mysqli_fetch_array(@$resINSXA);
			$profile = $rw["data"];
			
			if($num==1)
			{
				return $profile;
			}
			else
			{
				return "corp_cover.jpg";
			}
			
		}
		else
		{
			return "corp_cover.jpg";
		}
		mysqli_close($db);
	}
}
 

if(function_exists('getUserShopLike'))
{
	
}
else
{
	function getUserShopLike($userID,$vCode){
		
		include find_file("cnct.php");
		
		$insertXA = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5($userID)."' AND syncstate = '".$vCode."' AND meta_data = '".md5("SHOP LIKE")."');";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			@$num = mysqli_num_rows(@$resINSXA);
			@$rw = mysqli_fetch_array(@$resINSXA);
			$data = $rw["data"];
			
			if($num==1)
			{
				return $data;
			}
			else
			{
				return "NOT LIKED";
			}
			
		}
		else
		{
			return "NOT LIKED";
		}
		mysqli_close($db);
	}
}
 

if(function_exists('getUserCorporateLike'))
{
	
}
else
{
	function getUserCorporateLike($userID,$vCode){
		
		include find_file("cnct.php");
		
		$insertXA = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5($userID)."' AND syncstate = '".$vCode."' AND meta_data = '".md5("CORPORATE LIKE")."');";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			@$num = mysqli_num_rows(@$resINSXA);
			@$rw = mysqli_fetch_array(@$resINSXA);
			$data = $rw["data"];
			
			if($num==1)
			{
				return $data;
			}
			else
			{
				return "NOT LIKED";
			}
			
		}
		else
		{
			return "NOT LIKED";
		}
		mysqli_close($db);
	}
}
 

if(function_exists('addShopLike'))
{
	
}
else
{
	function addShopLike($userID,$vCode,$func){
		
		include find_file("cnct.php");
		
		if(strtoupper(trim($func))=="LIKE")
		{
			$data = "LIKED";
		}
		else
		{
			$data = "NOT LIKED";
		}
		
		$insertXA = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".md5(trim($userID))."','".trim($data)."','".md5("SHOP LIKE")."','".trim($vCode)."');";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		mysqli_close($db);
	}
}
 

if(function_exists('addCorporateLike'))
{
	
}
else
{
	function addCorporateLike($userID,$vCode,$func){
		
		include find_file("cnct.php");
		
		if(strtoupper(trim($func))=="LIKE")
		{
			$data = "LIKED";
		}
		else
		{
			$data = "NOT LIKED";
		}
		
		$insertXA = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".md5(trim($userID))."','".trim($data)."','".md5("CORPORATE LIKE")."','".trim($vCode)."');";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		mysqli_close($db);
	}
}
 

if(function_exists('likeShop'))
{
	
}
else
{
	function likeShop($userID,$vCode,$func){
		
		addShopLike($userID,$vCode,$func);
		
		if(trim(getUserShopLike($userID,$vCode))=="NOT LIKED")
		{
			return "LIKE";
		}
		else
		{
			return "UNLIKE";
		}
	}
}
 

if(function_exists('likeCorp'))
{
	
}
else
{
	function likeCorp($userID,$vCode,$func){
		
		addCorporateLike($userID,$vCode,$func);
		
		if(trim(getUserCorporateLike($userID,$vCode))=="NOT LIKED")
		{
			return "LIKE";
		}
		else
		{
			return "UNLIKE";
		}
	}
}
 

if(function_exists('listShopLikes'))
{
	
}
else
{
	function listShopLikes($userID){
			
		include find_file("cnct.php");
		
		$insertXA = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE userid = '".md5($userID)."' AND meta_data = '".md5("SHOP LIKE")."' GROUP BY syncstate) AND data = 'LIKED';";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			@$num = mysqli_num_rows(@$resINSXA);
			
			for($a=0; $a<$num; $a++)
			{			
				@$rw = mysqli_fetch_array(@$resINSXA);
				$likeState = $rw["data"];
				$vCode = $rw["syncstate"];
				$array[] = array('num'=>$num,'name'=>getNames($vCode),'vCode'=>$vCode);
			}
			return $array;
		}
		else
		{
			return 0;
		}
		mysqli_close($db);
	}
}
 

if(function_exists('listCorpLikes'))
{
	
}
else
{
	function listCorpLikes($userID){
			
		include find_file("cnct.php");
		
		$insertXA = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE userid = '".md5($userID)."' AND meta_data = '".md5("CORPORATE LIKE")."' GROUP BY syncstate) AND data = 'LIKED';";
		@@$resINSXA = mysqli_query($db,$insertXA);
		if(@$resINSXA)
		{
			@$num = mysqli_num_rows(@$resINSXA);
			
			for($a=0; $a<$num; $a++)
			{			
				@$rw = mysqli_fetch_array(@$resINSXA);
				$likeState = $rw["data"];
				$vCode = $rw["syncstate"];
				$array[] = array('num'=>$num,'shortname'=>getOrgShortName($vCode),'name'=>getOrgName($vCode),'vCode'=>$vCode);
			}
			return $array;
		}
		else
		{
			return 0;
		}
		mysqli_close($db);
	}
}
?>