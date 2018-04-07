<?php 
function addUserToOrg($vCode,$userID,$userLevel){
	include find_file("cnct.php");
	
	$vCode = uniqueCode();
	
	$query = "INSERT INTO meta(id,userid,data,meta_data,r_user) VALUES('','".$vCode."','".$userID."','".md5("ORGANIZATION USER")."','".$userLevel."');";

	$result = mysqli_query($db,$query);
	// check if row inserted or not
	if ($result) 
	{
		return 1;
	}
	else 
	{
		return 0;
	}
	mysqli_close($db);
}


function listOrgUsers($vCode){
	include find_file("cnct.php");
	
	$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE userid = '".$vCode."' AND meta_data = '".md5("ORGANIZATION USER")."' GROUP BY userid);";
	$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows($res);
	for($a=0; $a<$num; $a++)
	{
		@$rw = mysqli_fetch_array($res);
		$org_vCode = $rw["userid"];
		$user = $rw["data"];
		$level = $rw["r_user"];
		
		$array[] = array('vCode'=>$org_vCode,'userID'=>$user,'level'=>$level);
	}
	return $array;
	
	mysqli_close($db);
}


function getOrgUserLevel($vCode,$userID){
	include find_file("cnct.php");	
	
	$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".$vCode."' AND data = '".$userID."' AND meta_data = '".md5("ORGANIZATION USER")."');";
	$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows($res);
	if($num>=1)
	{
		@$rw = mysqli_fetch_array($res);
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


function removeUserFromOrg($vCode,$userID){
	include find_file("cnct.php");	
	
	$sel = "SELECT FROM meta WHERE userid = '".$vCode."' AND data = '".$userID."' AND meta_data = '".md5("ORGANIZATION USER")."';";
	$res = mysqli_query($db,$sel);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysqli_close($db);
}


function createOrgAccount($userID,$orgname,$regNumber,$TPIN,$emailAdd,$phoneNumber,$Address,$postal){
	// include db connect class

	
	
	if(checkOrgAccount("ALL",$phoneNumber)==1 || checkOrgAccount("ALL",$emailAdd)==1 || checkOrgAccount("ALL",$regNumber)==1 || checkOrgAccount("ALL",$TPIN)==1 || checkOrgAccount("ALL",$orgname)==1)
	{	
		return 2;
	}
	else
	{
		$userx = userDetails($userID);
		
		include find_file("cnct.php");
		
		$vCode = uniqueCode();
		
		$query = "INSERT INTO _organizations(id,name,reg_number,TPIN,postal,physical,town,province,country,status,vCode) VALUES('','".$orgname."','".$regNumber."','".$TPIN."','".$postal."','".$Address."','".standadizesphone($phoneNumber)."','".$emailAdd."','".$userx["town"]."','".$userx["province"]."','".$userx["Country"]."','Inactive','".$vCode."');";

		$result = mysqli_query($db,$query);
		// check if row inserted or not
		if ($result) 
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


function checkOrgAccount($type,$userAccount){
	
	include find_file("cnct.php");
		
	if($type=="ACTIVE")
	{
		$query = "SELECT COUNT(id) AS NUM FROM _organizations WHERE (id = '".$userAccount."' OR phone = '".standadizesphone($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."') AND status = 'Active';";
	}
	elseif($type=="INACTIVE")
	{
		$query = "SELECT COUNT(id) AS NUM FROM _organizations WHERE (id = '".$userAccount."' OR phone = '".standadizesphone($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."') AND status = 'Inactive';";
	}
	elseif($type=="ALL")
	{
		$query = "SELECT COUNT(id) AS NUM FROM _organizations WHERE (id = '".$userAccount."' OR phone = '".standadizesphone($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."');";
	}
	elseif($type=="SUSPENDED")
	{
		$query = "SELECT COUNT(id) AS NUM FROM _organizations WHERE (id = '".$userAccount."' OR phone = '".standadizesphone($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."') AND status = 'Suspended';";
	}
	
	
	$result = mysqli_query($db,$query);
	$row = mysqli_fetch_array($result);
	$num = $row["NUM"];
	
	
	//echo $query;
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


function orgID($userAccount){
		
	include find_file("cnct.php");
	
	$query = "SELECT max(userID) AS maxID FROM _organizations WHERE (id = '".$userAccount."' OR phone = '".standadizesphone($userAccount)."' OR email = '".$userAccount."' OR name like '".$userAccount."' OR reg_number = '".$userAccount."' OR TPIN = '".$userAccount."');";
	//echo $query."<br>";
	$result = mysqli_query($db,$query);
	$num = mysqli_num_rows($result);
	// check for empty result
	if ($num>=1) 
	{
		$row = mysqli_fetch_array($result);
		$userID = $row["maxID"];	
		
		return $userID;
	}
	else 
	{
	return 0;
	}
	mysqli_close($db);
}


function orgData($orgID){
	
	include find_file("cnct.php");

	$session_query = "SELECT * FROM _organizations WHERE id = '".$orgID."';";
	$sess_res = mysqli_query($db,$session_query);
	@$num_sess = mysqli_num_rows($sess_res);
	$row_sess = mysqli_fetch_array($sess_res);
	$orgID = $row_sess["id"];
	$name = $row_sess["name"];
	$TPIN = $row_sess["TPIN"];
	$reg_number = $row_sess["reg_number"];
	$sex = $row_sess["sex"];
	$DateOfBirth = $row_sess["DateOfBirth"];
	$houseNo = $row_sess["houseNo"];
	$password = $row_sess["password"];
	$street = $row_sess["street"];
	$email = $row_sess["email"];
	$nrcNumber = $row_sess["nrcNumber"];
	$area = $row_sess["area"];
	$town = $row_sess["town"];
	$province = $row_sess["province"];
	$country = $row_sess["country"];
	$phone = $row_sess["phone"];
	$org = $row_sess["org"];
	
	$proq = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$orgID."' AND meta_data = '".md5("PROFILE PICTURES")."');";
	$respro = mysqli_query($db,$proq);
	@$prow = mysqli_fetch_array($respro);
	$ProfilePic = $prow["data"];	
	
	mysqli_close($db);
	
	$array = array('orgID'=>$orgID,'name'=>$name,'TPIN'=>$TPIN,'reg_number'=>$reg_number,'sex'=>$sex,'DateOfBirth'=>$DateOfBirth,'houseNo'=>$houseNo,'password'=>$password,'street'=>$street,'email'=>$email,'nrcNumber'=>$nrcNumber,'area'=>$area,'town'=>$town,'province'=>$province,'country'=>$country,'phone'=>$phone,'org'=>$org,'ProfilePic'=>$ProfilePic);
	
	return $array;
	
}


function getOrgName($orgID,$type=""){
	
	if(checkOrgAccount("CHECK",$orgID)==1)
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


function getOrgphone($orgID,$type=""){
	
	if(checkOrgAccount("CHECK",$orgID)==1)
	{
		$user = orgID($orgID);
		$userArray = orgData($orgID);
		
		$Name = $userArray["phone"];	
	}
	else
	{
		$Name = standadizesphone($orgID));
	}
	
	return $Name;
}


function getOrgEmail($orgID,$type=""){
	
	if(checkOrgAccount("CHECK",$orgID)==1)
	{
		$user = orgID($orgID);
		$userArray = orgData($orgID);
		
		$Name = $userArray["email"];	
	}
	else
	{
		$Name = $orgID;
	}
	
	return $Name;
}
?>