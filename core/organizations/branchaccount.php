<?php 

function createBranchAccount($orgname,$dob,$houseNo,$street,$area,$phoneNumber,$emailAdd,$nrcNumber,$town,$province,$country){
	// include db connect class

	include_once 'db_connect.php';
	
	if(checkBranchAccount("TEMP",$phoneNumber)==1 || checkBranchAccount("TEMP",$emailAdd)==1)
	{	
		$query = "UPDATE _org_branches SET Name = '$orgname',DateOfBirth = '$dob',houseNo = '$houseNo',street = '$street',area = '$area',phone = '".standadizesMobile($phoneNumber)."',email = '$emailAdd',nrcNumber = '$nrcNumber',town = '$town',province = '$province',country = '$country',username = '$username',password = '".MD5($password)."',status = 'Active';";
	}
	else
	{
		$query = "INSERT INTO _org_branches(userID,Name,lName,sex,DateOfBirth,houseNo,street,area,phone,email,nrcNumber,town,province,country,username,password,status) VALUES('','$fname','$orgname','$gender','$dob','$houseNo','$street','$area','".standadizesMobile($phoneNumber)."','$emailAdd','$nrcNumber','$town','$province','$country','$username','".MD5($password)."','Active');";
	}
	
	@$result = mysqli_query($db,$query);
	// check if row inserted or not
	if (@$result) 
	{
		return 1;
	} 
	else
	{
		// failed to insert row
		return 0;
	}
	// mysql insertion of a new row
}


function createTempBranchAccount($phoneNumber){

	include_once 'db_connect.php';
	
	$query = "INSERT INTO _org_branches (userID,phone,status) VALUES('','".standadizesMobile($phoneNumber)."','Temp');";	
	@$result = mysqli_query($db,$query);
	// check if row inserted or not
	if (@$result) 
	{
		return 1;
	} 
	else 
	{
		// failed to insert row
		return 0;
	}
}


function checkBranchAccount($type,$userAccount){
	
	include_once 'db_connect.php';
		
	if($type=="CHECK")
	{
		// get a customer from customer table
		$query = "SELECT COUNT(id) AS NUM FROM _org_branches WHERE (userID = '".$userAccount."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."') AND status = 'Active';";
	}
	elseif($type=="TEMP")
	{
		$query = "SELECT COUNT(id) AS NUM FROM _org_branches WHERE (phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."') AND status = 'Temp';";
	}
	elseif($type=="SUSPENDED")
	{
		$query = "SELECT COUNT(id) AS NUM FROM _org_branches WHERE (userID = '".$userAccount."' OR phone = '".standadizesMobile($userAccount)."' OR email = '".$userAccount."') AND status = 'Suspended';";
	}
	
	
	@$result = mysqli_query($db,$query);
	$row = mysqli_fetch_array(@$result);
	
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
}


function branchID($id){
		
	include_once 'db_connect.php';
	
	$query = "SELECT max(userID) AS maxID FROM _org_branches WHERE (phone = '".standadizesMobile($id)."' OR email = '".$id."' OR userID = '".$id."' );";
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
}


function branchData($userID){
	
	include_once 'db_connect.php';

	$session_query = "SELECT * FROM _org_branches WHERE userID = '".$userID."';";
	$sess_res = mysqli_query($db,$session_query);
	@$num_sess = mysqli_num_rows($sess_res);
	$row_sess = mysqli_fetch_array($sess_res);
	$userID = $row_sess["userID"];
	$username = $row_sess["username"];
	$FirstName = $row_sess["fName"];
	$LastName = $row_sess["lName"];
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
	
	$proq = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$userID."' AND meta_data = '".md5("PROFILE PICTURES")."');";
	@$respro = mysqli_query($db,$proq);
	@$prow = mysqli_fetch_array(@$respro);
	$ProfilePic = $prow["data"];	
	
	$array = array('userID'=>$userID,'username'=>$username,'FirstName'=>$FirstName,'LastName'=>$LastName,'sex'=>$sex,'DateOfBirth'=>$DateOfBirth,'houseNo'=>$houseNo,'password'=>$password,'street'=>$street,'email'=>$email,'nrcNumber'=>$nrcNumber,'area'=>$area,'town'=>$town,'province'=>$province,'country'=>$country,'phone'=>$phone,'org'=>$org,'ProfilePic'=>$ProfilePic);
	
	return $array;
}


function getBranchName($userID,$type=""){
	
	if(checkBranchAccount("CHECK",$userID)==1)
	{
		$user = branchID($userID);
		
		$userArray = branchData($user);
		
		$Name = $userArray["Name"];	
	}
	else
	{
		$Name = $userID;
	}
	
	return $Name;
}


function getBranchMobile($userID,$type=""){
	
	if(checkBranchAccount("CHECK",$userID)==1)
	{
		$user = branchID($userID);
		$userArray = branchData($user);
		
		$Name = $userArray["phone"];	
	}
	else
	{
		$Name = standadizesMobile($userID);
	}
	
	return $Name;
}


function getBranchEmail($userID,$type=""){
	
	if(checkBranchAccount("CHECK",$userID)==1)
	{
		$user = branchID($userID);
		$userArray = branchData($user);
		
		$Name = $userArray["email"];	
	}
	else
	{
		$Name = $userID;
	}
	
	return $Name;
}
?>