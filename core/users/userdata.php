<?php 
if(function_exists('userIDFromSessID'))
{
	
}
else
{
	function userIDFromSessID($SesVar){
		
		include find_file("cnct.php");
		
		$SesVar = mysqli_real_escape_string($db,trim($SesVar));

		$online = "SELECT * FROM online WHERE _sessid = '".$SesVar."';";
		$online_res = mysqli_query($db,$online);
		$row_online = mysqli_fetch_array($online_res);
		$uid = $row_online["_idcry"];
		
		return $uid;
		
		mysqli_close($db);
	}
}
 

if(function_exists('userDetails1'))
{
	
}
else
{
	function userDetails1($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));
		
		$sel = "SELECT * FROM _user_acnts WHERE (userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'));";
		//echo $sel."<br><br>";
		$res = mysqli_query($db,$sel);
		@$rw = mysqli_fetch_array($res);
		$userID = $rw["userID"];
		$UserCode = $rw["UserCode"];
		$AccountType = $rw["AccountType"];
		$org = $rw["org"];
		$Branch = $rw["Branch"];
		$Email = $rw["Email"];
		$FirstName = $rw["FirstName"];
		$LastName = $rw["LastName"];
		$NickName = $rw["NickName"];
		$LoginName = $rw["LoginName"];
		$Password = $rw["Password"];
		$Address = $rw["Address"];
		$Postal = $rw["Postal"];
		$Fax = $rw["Fax"];
		$Telephone = $rw["Telephone"];
		$Mobile = $rw["Mobile"];
		$MobileVerified = $rw["MobileVerified"];
		$EmailVerified = $rw["EmailVerified"];
		$QuasAdmin = $rw["QuasAdmin"];
		$RecordEntryDate = $rw["RecordEntryDate"];
		$Active = $rw["Active"];
		$level = $rw["level"];
		$sex = $rw["sex"];
		$DOB = $rw["DOB"];
		$houseNo = $rw["houseNo"];
		$street = $rw["street"];
		$area = $rw["area"];
		$nrcNumber = $rw["nrcNumber"];
		$town = $rw["town"];
		$province = $rw["province"];
		$Country = $rw["Country"];
		$vCode = $rw["vCode"];
		$enableStore = $rw["enableStore"];
		
		mysqli_close($db);
		
		
		$array = array('num'=>'1','userID'=>$userID,'vCode'=>$vCode,'AccountType'=>$AccountType,'enableStore'=>$enableStore,'Branch'=>$Branch,'Email'=>$Email,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'LoginName'=>$LoginName,'Password'=>$Password,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Mobile'=>$Mobile,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'QuasAdmin'=>$QuasAdmin,'RecordEntryDate'=>$RecordEntryDate,'Active'=>$Active,'level'=>$level,'Country'=>$Country,'sex'=>$sex,'DOB'=>$DOB,'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
		
		return $array;
	}
}
 

if(function_exists('checkUserHasVCode'))
{
	
}
else
{
	function checkUserHasVCode($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "SELECT vCode FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
		{
			$rw = mysqli_fetch_array($resd);
			
			if($rw["vCode"]=="" || $rw["vCode"]=="NULL" || !(isset($rw["vCode"])))
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('userID'))
{
	
}
else
{
	function userID($userAccount){
		
		//echo "test: |".$id."|".$t."<br>";
		//$id = 3;
			
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));
		
		$query = "SELECT max(userID) AS maxID FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')) OR (userID = '".$userAccount."'));";
		//echo $query."<br>";
		$result = mysqli_query($db,$query);
		@$num = mysqli_num_rows($result);
		// check for empty result
		if ($num>=1) 
		{
			$row = mysqli_fetch_array($result);
			$userID = $row["maxID"];	
			
			return $userID;
		}
		else 
		{
			return $id;
		}
			//echo $query."<br>userID:".$userID."<br>";
		
		mysqli_close($db);
	}
}
 

if(function_exists('getNames'))
{
	
}
else
{
	function getNames($userID,$type=""){
		
			//echo "test: |".userID($userID)."|<br>";
		if(checkAccount("CHECK",$userID)==1)
		{
			$user = userID($userID);
			
			$userArray = userDetails1($user);
			
			if($type=="")
			{
				$Name = $userArray["FirstName"]." ".$userArray["LastName"];
			}
			elseif(strtoupper($type)=="FULL NAMES" || strtoupper($type)=="FULL")
			{
				$Name = $userArray["FirstName"]." ".$userArray["LastName"];
			}
			elseif(strtoupper($type)=="FIRST NAME" || strtoupper($type)=="FIRST")
			{
				$Name = $userArray["FirstName"];
			}
			elseif(strtoupper($type)=="LAST NAME" || strtoupper($type)=="LAST")
			{
				$Name = $userArray["LastName"];
			}		
		}
		else
		{
			$Name = $userID;
		}
		
		return $Name;
	}
}
 

if(function_exists('getMobile'))
{
	
}
else
{
	function getMobile($userID){
		
		if(checkAccount("CHECK",$userID)==1)
		{
			$user = userID($userID);
			$userArray = userDetails1($user);
			
			$Name = $userArray["Mobile"];	
		}
		else
		{
			$Name = standadizesMobile($userID);
		}
		
		return $Name;
	}
}
 

if(function_exists('getEmail'))
{
	
}
else
{
	function getEmail($userID){
		
		if(checkAccount("CHECK",$userID)==1)
		{
			$user = userID($userID);
			$userArray = userDetails1($user);
			
			$Name = $userArray["Email"];	
		}
		else
		{
			$Name = $userID;
		}
		
		return $Name;
	}
}
 

if(function_exists('getUserVCode'))
{
	
}
else
{
	function getUserVCode($userID){

		$user = userID($userID);
		$userArray = userDetails1($user);

		return $userArray["vCode"];
	}
}
 

if(function_exists('genAccountVCode'))
{
	
}
else
{
	function genAccountVCode($userID){

		$numd = userID($userID);
		//echo "test:".$numd;
		if($numd>=1)
		{
			if(checkAccountHasVCode($userID)>=1)
			{
				return "-1";
			}
			else
			{
				$timex = (date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s);
				$vCode = rand_string(2).rand_string(3);
		
		include find_file("cnct.php");
				
				$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user,numdata) VALUES ('','".md5($numd)."','1','".md5("USER ACCOUNT VERIFICATION CODE")."','".$vCode."','".$timex."');";
				//echo $ins."<br>";
				$res = mysqli_query($db,$ins);
				if($res)
				{
					return $vCode;
				}
				else
				{
					return 0;
				}
		
		mysqli_close($db);
			}
		}
		else
		{
			return 0;
		}	
	}
}
 

if(function_exists('setUserVCode'))
{
	
}
else
{
	function setUserVCode($userAccount){
		
		$vCode = md5(uniqueCode()."|".getMobile($userAccount)."|".getEmail($userAccount)."|".userID($userAccount));
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "UPDATE _user_acnts SET vCode = '".$vCode."' WHERE  (userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
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
 

if(function_exists('userData'))
{
	
}
else
{
	function userData(){
		

		if(chkSes()=="Active")
		{
			$SesVar = SesVar();

			include find_file("cnct.php");
			$online = "SELECT * FROM online WHERE _sessid = '".$SesVar."';";
			$online_res = mysqli_query($db,$online);
			$row_online = mysqli_fetch_array($online_res);
			$uid = $row_online["_idcry"];
			
			mysqli_close($db);
			//echo "<br>SesVar Query: ".$online."<br>";
		
			include find_file("cnct.php");
			
			$session_query = "SELECT * FROM _user_acnts WHERE userID = '".$uid."' AND (Active = '1' OR Active = 'Yes');";
			//echo "<br>SesVar Query: ".$session_query."<br>";
			$sess_res = mysqli_query($db,$session_query);
			@$num_sess = mysqli_num_rows($sess_res);
			$row_sess = mysqli_fetch_array($sess_res);
			$userID = $row_sess["userID"];
			$AccountType = $row_sess["AccountType"];
			$UserCode = $row_sess["UserCode"];
			$org = $row_sess["org"];
			$Branch = $row_sess["Branch"];
			$Email = $row_sess["Email"];
			$Mobile = $row_sess["Mobile"];
			$LoginName = $row_sess["LoginName"];
			$FirstName = $row_sess["FirstName"];
			$LastName = $row_sess["LastName"];
			$NickName = $row_sess["NickName"];
			$_idxZx = $row_sess["Password"];
			$Address = $row_sess["Address"];
			$Postal = $row_sess["Postal"];
			$Fax = $row_sess["Fax"];
			$Telephone = $row_sess["Telephone"];
			$Active = $row_sess["Active"];
			$QuasAdmin = $row_sess["QuasAdmin"];
			$MobileVerified = $row_sess["MobileVerified"];
			$EmailVerified = $row_sess["EmailVerified"];
			$level = $row_sess["level"];
			$sex = $row_sess["sex"];
			$DOB = $row_sess["DOB"];
			$houseNo = $row_sess["houseNo"];
			$street = $row_sess["street"];
			$area = $row_sess["area"];
			$nrcNumber = $row_sess["nrcNumber"];
			$town = $row_sess["town"];
			$province = $row_sess["province"];
			$userCountry = $row_sess["Country"];
			$vCode = $row_sess["vCode"];
			$enableStore = $row_sess["enableStore"];
			
			mysqli_close($db);
			
			if($vCode=="")
			{
				setUserVCode($userID);
			}
			include find_file("cnct.php");

			$propictext = "Profile Pic";
			$proq = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$userID."' AND meta_data = '".md5($propictext)."');";
			$respro = mysqli_query($db,$proq);
			@$prow = mysqli_fetch_array($respro);
			$ProfilePic = $prow["data"];	
			
			$array = array('userID'=>$userID,'AccountType'=>$AccountType,'vCode'=>$vCode,'enableStore'=>$enableStore,'Branch'=>$Branch,'Mobile'=>$Mobile,'Email'=>$Email,'LoginName'=>$LoginName,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'Password'=>$_idxZx,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Active'=>$Active,'QuasAdmin'=>$QuasAdmin,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'level'=>$level,'country'=>$userCountry,'ProfilePic'=>$ProfilePic,'sex'=>$sex,'DOB'=>$DOB,'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
			
			return $array;
		}
		else
		{
			return 0;
		}
		
		/*
		$userData = userData();
		$userData['userID']
		$userData['AccountType']
		$userData['org']
		$userData['Branch']
		$userData['Email']
		$userData['LoginName']
		$userData['FirstName']
		$userData['LastName']
		$userData['NickName']
		$userData['Password']
		$userData['Physical']
		$userData['Postal']
		$userData['Fax']
		$userData['Telephone']
		$userData['Active']
		$userData['QuasAdmin']
		$userData['MobileVerified']
		$userData['level']
		$userData['Country']
		$userData['ProfilePic']
		*/
		
		mysqli_close($db);
	}
}
 

if(function_exists('userDetails'))
{
	
}
else
{
	function userDetails($userAccount="",$limiter="",$store="",$product="",$category=""){
		
		if($store=="")
		{
			
		}
		else
		{
			
		}

		if(!($userAccount==""))
		{
			include find_file("cnct.php");
			
			$userAccount = mysqli_real_escape_string($db,trim($userAccount));
			
			$sel = "SELECT * FROM _user_acnts WHERE (userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'));";
			//echo $sel."<br><br>";
			$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array($res);
			$userID = $rw["userID"];
			$UserCode = $rw["UserCode"];
			$AccountType = $rw["AccountType"];
			$org = $rw["org"];
			$Branch = $rw["Branch"];
			$Email = $rw["Email"];
			$FirstName = $rw["FirstName"];
			$LastName = $rw["LastName"];
			$NickName = $rw["NickName"];
			$LoginName = $rw["LoginName"];
			$Password = $rw["Password"];
			$Address = $rw["Address"];
			$Postal = $rw["Postal"];
			$Fax = $rw["Fax"];
			$Telephone = $rw["Telephone"];
			$Mobile = $rw["Mobile"];
			$MobileVerified = $rw["MobileVerified"];
			$EmailVerified = $rw["EmailVerified"];
			$QuasAdmin = $rw["QuasAdmin"];
			$RecordEntryDate = $rw["RecordEntryDate"];
			$Active = $rw["Active"];
			$level = $rw["level"];
			$sex = $rw["sex"];
			$DOB = $rw["DOB"];
			$houseNo = $rw["houseNo"];
			$street = $rw["street"];
			$area = $rw["area"];
			$nrcNumber = $rw["nrcNumber"];
			$town = $rw["town"];
			$province = $rw["province"];
			$Country = $rw["Country"];
			$vCode = $rw["vCode"];
			$enableStore = $rw["enableStore"];
			
			
			mysqli_close($db);
			
			if($vCode=="")
			{
				setUserVCode($userID);
			}
			//
			
			
			$array = array('num'=>'1','userID'=>$userID,'vCode'=>$vCode,'AccountType'=>$AccountType,'enableStore'=>$enableStore,'Branch'=>$Branch,'Email'=>$Email,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'LoginName'=>$LoginName,'Password'=>$Password,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Mobile'=>$Mobile,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'QuasAdmin'=>$QuasAdmin,'RecordEntryDate'=>$RecordEntryDate,'Active'=>$Active,'level'=>$level,'Country'=>$Country,'sex'=>$sex,'DOB'=>$DOB,'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
			
			return $array;
		}
		else
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
					$where = " WHERE";
				}
				
				include find_file('cnct_uagro.php');
				
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
				
				$categoryLimiter = $where." userID IN (".$wlist.")";
				
			}
			else
			{
				$categoryLimiter = "";
			}
				
			if($store=="")
			{
				$storex = "";
			}
			else
			{
				
				if(!($product==""))
				{
					$where2 = " AND";
				}
				else
				{
					if(!($category==""))
					{
						$where2 = " AND";
					}
					else
					{
						$where2 = " WHERE";
					}
				}
				
				//$storex = " ".$where2." (enableStore = '1' OR enableStore = 'Yes')";
				$storex = "";
			}
			
			include find_file("cnct.php");
			
			$sel = "SELECT * FROM _user_acnts ".$productLimiter." ".$categoryLimiter." ".$storex." ".$limiter.";";
			//echo "<br>".$sel."<br><br>";
			$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			//echo "<br>num: ".$num."<br><br>";
			
			if($num<="0")
			{
				$array = array('num'=>'0','userID'=>'','UserCode'=>'','AccountType'=>'','org'=>'','Branch'=>'','Email'=>'','FirstName'=>'','LastName'=>'','NickName'=>'','LoginName'=>'','Password'=>'','Address'=>'','Postal'=>'','Fax'=>'','Telephone'=>'','Mobile'=>'','MobileVerified'=>'','EmailVerified'=>'','QuasAdmin'=>'','EmailVerified'=>'','RecordEntryDate'=>'','Active'=>'','level'=>'','Country'=>'');
				
				return $array; 	
			}
			else
			{
				for($a=0; $a<$num; $a++)
				{
					@$rw = mysqli_fetch_array($res);
					$userID = $rw["userID"];
					$UserCode = $rw["UserCode"];
					$AccountType = $rw["AccountType"];
					$org = $rw["org"];
					$Branch = $rw["Branch"];
					$Email = $rw["Email"];
					$FirstName = $rw["FirstName"];
					$LastName = $rw["LastName"];
					$NickName = $rw["NickName"];
					$LoginName = $rw["LoginName"];
					$Password = $rw["Password"];
					$Address = $rw["Address"];
					$Postal = $rw["Postal"];
					$Fax = $rw["Fax"];
					$Telephone = $rw["Telephone"];
					$Mobile = $rw["Mobile"];
					$MobileVerified = $rw["MobileVerified"];
					$EmailVerified = $rw["EmailVerified"];
					$QuasAdmin = $rw["QuasAdmin"];
					$RecordEntryDate = $rw["RecordEntryDate"];
					$Active = $rw["Active"];
					$level = $rw["level"];
					$sex = $rw["sex"];
					$DOB = $rw["DOB"];
					$houseNo = $rw["houseNo"];
					$street = $rw["street"];
					$area = $rw["area"];
					$nrcNumber = $rw["nrcNumber"];
					$town = $rw["town"];
					$province = $rw["province"];
					$Country = $rw["Country"];
					$vCode = $rw["vCode"];
					$enableStore = $rw["enableStore"];
			
					
					if($vCode=="")
					{
						setUserVCode($userID);
					}
					
					$array[] = array('num'=>$num,'userID'=>$userID,'enableStore'=>$enableStore,'AccountType'=>$AccountType,'vCode'=>$vCode,'Branch'=>$Branch,'Email'=>$Email,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'LoginName'=>$LoginName,'Password'=>$Password,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Mobile'=>$Mobile,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'QuasAdmin'=>$QuasAdmin,'RecordEntryDate'=>$RecordEntryDate,'Active'=>$Active,'level'=>$level,'sex'=>$sex,'DOB'=>$DOB,'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province,'Country'=>$Country);
					
				}
				mysqli_close($db);
				return $array; 
			}
		}
		
		
	}
}
 

if(function_exists('getUserData'))
{
	
}
else
{
	function getUserData($userAccount,$type){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$sel = "SELECT * FROM _user_acnts WHERE userID = (SELECT max(userID) FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'))));";
		//echo "<br><br>getUserData: ".$sel."<br><br>";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		if($num==1)
		{
			$rw = mysqli_fetch_array($res);
			$userIDx = $rw["userID"];
			$UserCode = $rw["UserCode"];
			$AccountType = $rw["AccountType"];
			$org = $rw["org"];
			$Branch = $rw["Branch"];
			$Email = $rw["Email"];
			$FirstName = $rw["FirstName"];
			$LastName = $rw["LastName"];
			$NickName = $rw["NickName"];
			$LoginName = $rw["LoginName"];
			$Password = $rw["Password"];
			$Address = $rw["Address"];
			$Postal = $rw["Postal"];
			$Fax = $rw["Fax"];
			$Telephone = $rw["Telephone"];
			$Mobile = $rw["Mobile"];
			$MobileVerified = $rw["MobileVerified"];
			$EmailVerified = $rw["EmailVerified"];
			$QuasAdmin = $rw["QuasAdmin"];
			$RecordEntryDate = $rw["RecordEntryDate"];
			$Active = $rw["Active"];
			$level = $rw["level"];
			$sex = $rw["sex"];
			$DOB = $rw["DOB"];
			$houseNo = $rw["houseNo"];
			$street = $rw["street"];
			$area = $rw["area"];
			$nrcNumber = $rw["nrcNumber"];
			$town = $rw["town"];
			$province = $rw["province"];
			$Country = $rw["Country"];
			$vCode = $rw["vCode"];

			if($vCode=="")
			{
				setUserVCode($userIDx);
			}
					
			if(strtoupper($type)==strtoupper("USERID"))
			{
				return $userIDx;
			}
			elseif(strtoupper($type)==strtoupper("vCode"))
			{
				return $vCode;
			}
			elseif(strtoupper($type)==strtoupper("Password"))
			{
				return $Password;
			}
			elseif(strtoupper($type)==strtoupper("USERCODE"))
			{
				return $UserCode;
			}
			elseif(strtoupper($type)==strtoupper("Account Type"))
			{
				return $AccountType;
			}
			elseif(strtoupper($type)==strtoupper("org"))
			{
				return $org;
			}
			elseif(strtoupper($type)==strtoupper("Branch"))
			{
				return $Branch;
			}
			elseif(strtoupper($type)==strtoupper("Email"))
			{
				return $Email;
			}
			elseif(strtoupper($type)==strtoupper("FirstName") || strtoupper($type)==strtoupper("First Name"))
			{
				return $FirstName;
			}
			elseif(strtoupper($type)==strtoupper("LastName") || strtoupper($type)==strtoupper("Last Name"))
			{
				return $LastName; 
			}
			elseif(strtoupper($type)==strtoupper("NickName"))
			{
				return $NickName;
			}
			elseif(strtoupper($type)==strtoupper("LoginName") || strtoupper($type)==strtoupper("Login Name"))
			{
				return $LoginName;
			}
			elseif(strtoupper($type)==strtoupper("Address"))
			{
				return $Address;
			}
			elseif(strtoupper($type)==strtoupper("Postal"))
			{
				return $Postal;
			}
			elseif(strtoupper($type)==strtoupper("Fax"))
			{
				return $Fax;
			}
			elseif(strtoupper($type)==strtoupper("Telephone"))
			{
				return $Telephone;
			}
			elseif(strtoupper($type)==strtoupper("Mobile"))
			{
				return $Mobile;
			}
			elseif(strtoupper($type)==strtoupper("MobileVerified") || strtoupper($type)==strtoupper("Mobile Verified"))
			{
				return $MobileVerified;
			}
			elseif(strtoupper($type)==strtoupper("EmailVerified") || strtoupper($type)==strtoupper("Email Verified"))
			{
				return $EmailVerified;
			}
			elseif(strtoupper($type)==strtoupper("QuasAdmin"))
			{
				return $QuasAdmin;
			}
			elseif(strtoupper($type)==strtoupper("RecordEntryDate"))
			{
				return $RecordEntryDate;
			}
			elseif(strtoupper($type)==strtoupper("Active"))
			{
				return $Active;
			}
			elseif(strtoupper($type)==strtoupper("level"))
			{
				return $level;
			}
			elseif(strtoupper($type)==strtoupper("Country"))
			{
				return $Country;
			}
			elseif(strtoupper($type)==strtoupper("sex"))
			{
				return $sex;
			}
			elseif(strtoupper($type)==strtoupper("DOB"))
			{
				return $DOB;
			}
			elseif(strtoupper($type)==strtoupper("houseNo") || strtoupper($type)==strtoupper("house No"))
			{
				return $houseNo;
			}
			elseif(strtoupper($type)==strtoupper("street"))
			{
				return $street;
			}
			elseif(strtoupper($type)==strtoupper("area"))
			{
				return $area;
			}
			elseif(strtoupper($type)==strtoupper("town"))
			{
				return $town;
			}
			elseif(strtoupper($type)==strtoupper("nrcNumber") || strtoupper($type)==strtoupper("nrc Number"))
			{
				return $nrcNumber;
			}
			elseif(strtoupper($type)==strtoupper("province"))
			{
				return $province;
			}
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('userLevelData'))
{
	
}
else
{
	function userLevelData($class,$type=""){

		if($type=="")
		{
			$where = " UserTypeCode = '".$class."'";
		}
		else
		{
			$where = " ".$type." = '".$class."'";
		}
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM refer_users_types WHERE ".$where.";";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		if($num<="0")
		{
			return 0;
		}
		elseif($num=="1")
		{
			@$rw = mysqli_fetch_array($res);
			$level = $rw["UserTypeCode"];
			$UserTypeName = $rw["UserTypeName"];
			$UserTypeCategory = $rw["UserTypeCategory"];
			$LimitedTo = $rw["LimitedTo"];
			$Roaming = $rw["Roaming"];
			
			$array = array('level'=>$level,'name'=>$UserTypeName,'category'=>$UserTypeCategory,'limit'=>$LimitedTo,'roaming'=>$Roaming);
			
			return $array;
		}
		elseif($num>="2")
		{
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array($res);
				$level = $rw["UserTypeCode"];
				$UserTypeName = $rw["UserTypeName"];
				$UserTypeCategory = $rw["UserTypeCategory"];
				$LimitedTo = $rw["LimitedTo"];
				$Roaming = $rw["Roaming"];
				
				$array[] = array('level'=>$level,'name'=>$UserTypeName,'category'=>$UserTypeCategory,'limit'=>$LimitedTo,'roaming'=>$Roaming);
				
			}
			return $array;
		}
		
		print_r($array);
		
		mysqli_close($db);
	}
}
 

if(function_exists('checkAccount'))
{
	
}
else
{
	function checkAccount($type,$userAccount,$password=""){
		
		include find_file("cnct.php");
		$type = strtoupper($type);
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));
		$password = mysqli_real_escape_string($db,trim($password));
		$Mobile = mysqli_real_escape_string($db,trim(standadizesMobile($userAccount)));
			
		if($type=="CHECK")
		{
			// get a customer from customer table
			$query = "SELECT * FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'))) AND (Active = '1' OR Active = 'Active' OR Active = 'Yes');";
		}
		elseif($type=="CHECK ALL")
		{
			// get a customer from customer table
			$query = "SELECT * FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		}
		elseif($type=="CHECK LOGIN")
		{
			$query = "SELECT * FROM _user_acnts WHERE ((Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'))) AND (Active = '1' OR Active = 'Active' OR Active = 'Yes');";
		}
		elseif($type=="LOGIN")
		{
			$query = "SELECT * FROM _user_acnts WHERE ((Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'))) AND (Active = '1' OR Active = 'Active' OR Active = 'Yes');";
		}
		elseif($type=="TEMP")
		{
			$query = "SELECT * FROM _user_acnts WHERE ((Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'))) AND Active = 'Temp';";
		}
		elseif($type=="SUSPENDED")
		{
			$query = "SELECT * FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'))) AND Active = 'Suspended';";
		}
		elseif($type=="STORE")
		{
			$query = "SELECT * FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL'))) AND (Active = '1' OR Active = 'Active' OR Active = 'Yes') AND enableStore = '1';";
		}
			
		$result = mysqli_query($db,$query);
		
		$num = mysqli_num_rows($result);
			
			
		//echo "<br><br><br><br><br><br>test: ".$query."<br>";
		// check for empty result
		if ($num>=1) 
		{
			if($type=="CHECK")
			{
				return 1;
			}
			elseif($type=="CHECK ALL")
			{
				return 1;
			}
			elseif($type=="CHECK LOGIN")
			{
				$row = mysqli_fetch_array($result);
				
				if(password_verify($password,stripslashes($row["Password"])) || md5($password)==stripslashes($row["Password"]))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			elseif($type=="LOGIN")
			{
				$row = mysqli_fetch_array($result);
				
				if(password_verify($password,stripslashes($row["Password"])) || md5($password)==stripslashes($row["Password"]))
				{
					$customercheck = array();
					$customercheck["fName"] = stripslashes($row["FirstName"]);
					$customercheck["lName"] = stripslashes($row["LastName"]);
					$customercheck["gender"] = stripslashes($row["sex"]);
					$customercheck["dob"] = stripslashes($row["DOB"]);
					$customercheck["houseNo"] = stripslashes($row["houseNo"]);
					//$customercheck["username"] = $row["username"];
					$customercheck["street"] = stripslashes($row["street"]);
					$customercheck["area"] = stripslashes($row["area"]);
					$customercheck["phone"] = stripslashes($row["Mobile"]);
					$customercheck["email"] = stripslashes($row["Email"]);
					$customercheck["nrcNumber"] = stripslashes($row["nrcNumber"]);
					$customercheck["town"] = stripslashes($row["town"]);
					$customercheck["province"] = stripslashes($row["province"]);
					$customercheck["country"] = stripslashes($row["Country"]);
					
					return $customercheck;
				}
				else
				{
					return 0;
				}
			}
			elseif($type=="TEMP")
			{
				return 1;
			}
			elseif($type=="SUSPENDED")
			{
				return 1;
			}
		}
		else 
		{
		return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('createUserAccount'))
{
	
}
else
{
	function createUserAccount($FirstName,$LastName,$LoginName,$NickName,$Mobile,$Email,$Password,$Country,$AccountType="User",$UserCode="",$org="",$Active="0",$level="0",$Address="",$Postal="",$Fax="",$Telephone="",$sex="",$DOB="",$houseNo="",$street="",$area="",$nrcNumber="",$town="",$province=""){

		
		
		if(checkAccount("TEMP",$Mobile)==1 || checkAccount("TEMP",$Email)==1)
		{	
		include find_file("cnct.php");
		
		$FirstName = mysqli_real_escape_string($db,trim($FirstName));
		$LastName = mysqli_real_escape_string($db,trim($LastName));
		$LoginName = mysqli_real_escape_string($db,trim($LoginName));
		$NickName = mysqli_real_escape_string($db,trim($NickName));
		$Mobile = mysqli_real_escape_string($db,trim(standadizesMobile($Mobile)));
		$Email = mysqli_real_escape_string($db,trim($Email));
		$Password = password_hash(mysqli_real_escape_string($db, trim($Password)),PASSWORD_BCRYPT,["cost"=>"12"]);
		$Country = mysqli_real_escape_string($db,trim($Country));
		$AccountType = mysqli_real_escape_string($db,trim($AccountType));
		$UserCode = mysqli_real_escape_string($db,trim($UserCode));
		$org = mysqli_real_escape_string($db,trim($org));
		$Active = mysqli_real_escape_string($db,trim($Active));
		$level = mysqli_real_escape_string($db,trim($level));
		$Address = mysqli_real_escape_string($db,trim($Address));
		$Postal = mysqli_real_escape_string($db,trim($Postal));
		$Fax = mysqli_real_escape_string($db,trim($Fax));
		$Telephone = mysqli_real_escape_string($db,trim($Telephone));
		$sex = mysqli_real_escape_string($db,trim($sex));
		$DOB = mysqli_real_escape_string($db,trim($DOB));
		$houseNo = mysqli_real_escape_string($db,trim($houseNo));
		$street = mysqli_real_escape_string($db,trim($street));
		$area = mysqli_real_escape_string($db,trim($area));
		$nrcNumber = mysqli_real_escape_string($db,trim($nrcNumber));
		$town = mysqli_real_escape_string($db,trim($town));
		$province = mysqli_real_escape_string($db,trim($province));
		
			$query = "UPDATE _user_acnts SET UserCode = '".$UserCode."',AccountType='".$AccountType."',org='".$org."',Email='".$Email."',FirstName='".$FirstName."',LastName='".$LastName."',LoginName='".$LoginName."',NickName='".$NickName."',Password='".$Password."',Address='".$Address."',Postal='".$Postal."',Fax='".$Fax."',Telephone='".$Telephone."',Mobile='".$Mobile."',Active='".$Active."',sex='".$sex."',DOB='".$DOB."',houseNo='".$houseNo."',street='".$street."',area='".$area."',nrcNumber='".$nrcNumber."',town='".$town."',province='".$province."',Country='".$Country."' WHERE ((Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR Email = '".$Email."' OR LoginName = '".$LoginName."');";
		}
		else
		{
		include find_file("cnct.php");
		
		$FirstName = mysqli_real_escape_string($db,trim($FirstName));
		$LastName = mysqli_real_escape_string($db,trim($LastName));
		$LoginName = mysqli_real_escape_string($db,trim($LoginName));
		$NickName = mysqli_real_escape_string($db,trim($NickName));
		$Mobile = mysqli_real_escape_string($db,trim(standadizesMobile($Mobile)));
		$Email = mysqli_real_escape_string($db,trim($Email));
		$Password = password_hash(mysqli_real_escape_string($db, trim($Password)),PASSWORD_BCRYPT,["cost"=>"12"]);
		$Country = mysqli_real_escape_string($db,trim($Country));
		$AccountType = mysqli_real_escape_string($db,trim($AccountType));
		$UserCode = mysqli_real_escape_string($db,trim($UserCode));
		$org = mysqli_real_escape_string($db,trim($org));
		$Active = mysqli_real_escape_string($db,trim($Active));
		$level = mysqli_real_escape_string($db,trim($level));
		$Address = mysqli_real_escape_string($db,trim($Address));
		$Postal = mysqli_real_escape_string($db,trim($Postal));
		$Fax = mysqli_real_escape_string($db,trim($Fax));
		$Telephone = mysqli_real_escape_string($db,trim($Telephone));
		$sex = mysqli_real_escape_string($db,trim($sex));
		$DOB = mysqli_real_escape_string($db,trim($DOB));
		$houseNo = mysqli_real_escape_string($db,trim($houseNo));
		$street = mysqli_real_escape_string($db,trim($street));
		$area = mysqli_real_escape_string($db,trim($area));
		$nrcNumber = mysqli_real_escape_string($db,trim($nrcNumber));
		$town = mysqli_real_escape_string($db,trim($town));
		$province = mysqli_real_escape_string($db,trim($province));
		
			$query = "INSERT INTO _user_acnts(userID,UserCode,AccountType,org,Email,FirstName,LastName,LoginName,NickName,Password,Address,Postal,Fax,Telephone,Mobile,MobileVerified,EmailVerified,Active,level,sex,DOB,houseNo,street,area,nrcNumber,town,province,Country) VALUES('','".$UserCode."','".$AccountType."','".$org."','".$Email."','".$FirstName."','".$LastName."','".$LoginName."','".$NickName."','".$Password."','".$Address."','".$Postal."','".$Fax."','".$Telephone."','".$Mobile."','','','".$Active."','".$level."','".$sex."','".$DOB."','".$houseNo."','".$street."','".$area."','".$nrcNumber."','".$town."','".$province."','".$Country."');";
		}
		
		
		$resd = mysqli_query($db,$query);
		
		if($resd)
		{
			if($vCode=="")
			{
				setUserVCode($Mobile);
			}
			
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('createUserAccount2'))
{
	
}
else
{
	function createUserAccount2($FirstName,$LastName,$LoginName,$NickName,$Mobile,$Email,$Password,$Country,$AccountType="User",$UserCode="",$org="",$Active="0",$level="0",$Address="",$Postal="",$Fax="",$Telephone="",$sex="",$DOB="",$houseNo="",$street="",$area="",$nrcNumber="",$town="",$province=""){

		
		
		if(checkAccount("TEMP",$Mobile)==1 || checkAccount("TEMP",$Email)==1)
		{	
		include find_file("cnct.php");
		
		$FirstName = mysqli_real_escape_string($db,trim($FirstName));
		$LastName = mysqli_real_escape_string($db,trim($LastName));
		$LoginName = mysqli_real_escape_string($db,trim($LoginName));
		$NickName = mysqli_real_escape_string($db,trim($NickName));
		$Mobile = mysqli_real_escape_string($db,trim(standadizesMobile($Mobile)));
		$Email = mysqli_real_escape_string($db,trim($Email));
		$Password = password_hash(mysqli_real_escape_string($db, trim($Password)),PASSWORD_BCRYPT,["cost"=>"12"]);
		$Country = mysqli_real_escape_string($db,trim($Country));
		$AccountType = mysqli_real_escape_string($db,trim($AccountType));
		$UserCode = mysqli_real_escape_string($db,trim($UserCode));
		$org = mysqli_real_escape_string($db,trim($org));
		$Active = mysqli_real_escape_string($db,trim($Active));
		$level = mysqli_real_escape_string($db,trim($level));
		$Address = mysqli_real_escape_string($db,trim($Address));
		$Postal = mysqli_real_escape_string($db,trim($Postal));
		$Fax = mysqli_real_escape_string($db,trim($Fax));
		$Telephone = mysqli_real_escape_string($db,trim($Telephone));
		$sex = mysqli_real_escape_string($db,trim($sex));
		$DOB = mysqli_real_escape_string($db,trim($DOB));
		$houseNo = mysqli_real_escape_string($db,trim($houseNo));
		$street = mysqli_real_escape_string($db,trim($street));
		$area = mysqli_real_escape_string($db,trim($area));
		$nrcNumber = mysqli_real_escape_string($db,trim($nrcNumber));
		$town = mysqli_real_escape_string($db,trim($town));
		$province = mysqli_real_escape_string($db,trim($province));
		
			$query = "UPDATE _user_acnts SET UserCode = '".$UserCode."',AccountType='".$AccountType."',org='".$org."',Email='".$Email."',FirstName='".$FirstName."',LastName='".$LastName."',LoginName='".$LoginName."',NickName='".$NickName."',Password='".$Password."',Address='".$Address."',Postal='".$Postal."',Fax='".$Fax."',Telephone='".$Telephone."',Mobile='".$Mobile."',Active='".$Active."',sex='".$sex."',DOB='".$DOB."',houseNo='".$houseNo."',street='".$street."',area='".$area."',nrcNumber='".$nrcNumber."',town='".$town."',province='".$province."',Country='".$Country."' WHERE ((Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR Email = '".$Email."' OR LoginName = '".$LoginName."');";
			$tp = "UPDATE";
		}
		else
		{
		include find_file("cnct.php");
		
		$FirstName = mysqli_real_escape_string($db,trim($FirstName));
		$LastName = mysqli_real_escape_string($db,trim($LastName));
		$LoginName = mysqli_real_escape_string($db,trim($LoginName));
		$NickName = mysqli_real_escape_string($db,trim($NickName));
		$Mobile = mysqli_real_escape_string($db,trim(standadizesMobile($Mobile)));
		$Email = mysqli_real_escape_string($db,trim($Email));
		$Password = password_hash(mysqli_real_escape_string($db, trim($Password)),PASSWORD_BCRYPT,["cost"=>"12"]);
		$Country = mysqli_real_escape_string($db,trim($Country));
		$AccountType = mysqli_real_escape_string($db,trim($AccountType));
		$UserCode = mysqli_real_escape_string($db,trim($UserCode));
		$org = mysqli_real_escape_string($db,trim($org));
		$Active = mysqli_real_escape_string($db,trim($Active));
		$level = mysqli_real_escape_string($db,trim($level));
		$Address = mysqli_real_escape_string($db,trim($Address));
		$Postal = mysqli_real_escape_string($db,trim($Postal));
		$Fax = mysqli_real_escape_string($db,trim($Fax));
		$Telephone = mysqli_real_escape_string($db,trim($Telephone));
		$sex = mysqli_real_escape_string($db,trim($sex));
		$DOB = mysqli_real_escape_string($db,trim($DOB));
		$houseNo = mysqli_real_escape_string($db,trim($houseNo));
		$street = mysqli_real_escape_string($db,trim($street));
		$area = mysqli_real_escape_string($db,trim($area));
		$nrcNumber = mysqli_real_escape_string($db,trim($nrcNumber));
		$town = mysqli_real_escape_string($db,trim($town));
		$province = mysqli_real_escape_string($db,trim($province));
		
			$query = "INSERT INTO _user_acnts(userID,UserCode,AccountType,org,Email,FirstName,LastName,LoginName,NickName,Password,Address,Postal,Fax,Telephone,Mobile,MobileVerified,EmailVerified,Active,level,sex,DOB,houseNo,street,area,nrcNumber,town,province,Country) VALUES('','".$UserCode."','".$AccountType."','".$org."','".$Email."','".$FirstName."','".$LastName."','".$LoginName."','".$NickName."','".$Password."','".$Address."','".$Postal."','".$Fax."','".$Telephone."','".$Mobile."','','','".$Active."','".$level."','".$sex."','".$DOB."','".$houseNo."','".$street."','".$area."','".$nrcNumber."','".$town."','".$province."','".$Country."');";
			$tp = "INSERT";
		}
		
		
		$resd = mysqli_query($db,$query);
		
		if($resd)
		{
			if($vCode=="")
			{
				setUserVCode($Mobile);
			}
			
			if($tp=="UPDATE")
			{
				return userID($Email);
			}
			else
			{
				$id = mysqli_insert_id($db);
				return $id;
			}
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('editUserAccount'))
{
	
}
else
{
	function editUserAccount($userID,$FirstName,$LastName,$Country,$sex="",$DOB="",$houseNo="",$street="",$area="",$nrcNumber="",$town=""){
		
		$loc_array = getLocationDetails($town,$Country);
		
		include find_file("cnct.php");
		
		$query = "UPDATE _user_acnts SET FirstName='".$FirstName."',LastName='".$LastName."',sex='".$sex."',DOB='".$DOB."',houseNo='".$houseNo."',street='".$street."',area='".$area."',nrcNumber='".$nrcNumber."',town='".$loc_array["town"]."',province='".$loc_array["province"]."',Country='".$loc_array["country"]."' WHERE (userID = '".mysqli_real_escape_string($db,$userID)."');";
		
		//echo $query."<br>";
		
		
		$resd = mysqli_query($db,$query);
		
		if($resd)
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
 

if(function_exists('activateUserAccount'))
{
	
}
else
{
	function activateUserAccount($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "UPDATE _user_acnts SET Active = '1' WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
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
 

if(function_exists('enableUserShop'))
{
	
}
else
{
	function enableUserShop($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "UPDATE _user_acnts SET enableStore = '1' WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
		{
			if(checkUserHasVCode($userID)==1)
			{
				return 1;
			}
			else
			{
				return setUserVCode($userID);
			}
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('setAccountMobileVerified'))
{
	
}
else
{
	function setAccountMobileVerified($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "UPDATE _user_acnts SET MobileVerified = '1' WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
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
 

if(function_exists('setAccountEmailVerified'))
{
	
}
else
{
	function setAccountEmailVerified($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "UPDATE _user_acnts SET EmailVerified = '1' WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
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
 

if(function_exists('checkUserAccountStatus'))
{
	
}
else
{
	function checkUserAccountStatus($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "SELECT Active FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
		{
			$rw = mysqli_fetch_array($resd);
			
			if($rw["Active"]==1 || $rw["Active"]=="Yes")
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
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('checkAccountMobileVerified'))
{
	
}
else
{
	function checkAccountMobileVerified($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "SELECT MobileVerified FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
		{
			$rw = mysqli_fetch_array($resd);
			
			if($rw["MobileVerified"]==1)
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
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('checkAccountEmailVerified'))
{
	
}
else
{
	function checkAccountEmailVerified($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "SELECT EmailVerified FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
		{
			$rw = mysqli_fetch_array($resd);
			
			if($rw["EmailVerified"]==1)
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
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('checkLoginNameUsed'))
{
	
}
else
{
	function checkLoginNameUsed($userID){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));

		$insd = "SELECT COUNT(userID) AS numUsed FROM _user_acnts WHERE userID = (SELECT max(userID) FROM _user_acnts WHERE LoginName = '".$userID."' AND (LoginName != '' OR LoginName != 'NULL'));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
		{
			$rw = mysqli_fetch_array($resd);
			
			if($rw["numUsed"]>=1)
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
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('checkAccountMobileUsed'))
{
	
}
else
{
	function checkAccountMobileUsed($userID){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));

		$insd = "SELECT COUNT(userID) AS numUsed FROM _user_acnts WHERE userID = (SELECT max(userID) FROM _user_acnts WHERE Mobile = '".standadizesMobile($userID)."');";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
		{
			$rw = mysqli_fetch_array($resd);
			
			if($rw["numUsed"]==1)
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
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('checkAccountEmailUsed'))
{
	
}
else
{
	function checkAccountEmailUsed($userID){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));

		$insd = "SELECT COUNT(userID) AS numUsed FROM _user_acnts WHERE userID = (SELECT max(userID) FROM _user_acnts WHERE Email = '".$userID."');";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
		{
			$rw = mysqli_fetch_array($resd);
			
			if($rw["numUsed"]>=1)
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
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('deactivateUserAccount'))
{
	
}
else
{
	function deactivateUserAccount($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "UPDATE _user_acnts SET Active = '0' WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
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
 

if(function_exists('deleteUserAccount'))
{
	
}
else
{
	function deleteUserAccount($userAccount){
		
		include find_file("cnct.php");
		
		$userAccount = mysqli_real_escape_string($db,trim($userAccount));

		$insd = "DELETE FROM _user_acnts WHERE ((userID = '".$userAccount."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userAccount."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userAccount."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userAccount."' AND (Email != '' OR Email != 'NULL')));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
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
 

if(function_exists('resetAccount'))
{
	
}
else
{
	function resetAccount($userID){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));

		$insd = "SELECT * FROM _user_acnts WHERE userID = (SELECT max(userID) FROM _user_acnts WHERE ((userID = '".$userID."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userID."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userID."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userID."' AND (Email != '' OR Email != 'NULL'))));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		@$numd = mysqli_num_rows($resd);
		if($numd==1)
		{
			$rw = mysqli_fetch_array($resd);
			$userIDx = $rw["userID"];
			
			$vCode = md5(uniqueCode()."|".$userIDx);
			
			mysqli_close($db);
			
			include find_file('cnct.php');
				
			$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user,syncstate) VALUES ('','".md5($userIDx)."','1','".md5("USER ACCOUNT OPENDED FOR RESET")."','".$vCode."','".$userIDx."');";
			//echo $ins."<br>";
			$res = mysqli_query($db,$ins);
			if($res)
			{
				return $vCode;
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
		
		mysqli_close($db);
	}
}
 

if(function_exists('getAccountFromRecoveryCode'))
{
	
}
else
{
	function getAccountFromRecoveryCode($vCode){

		include find_file("cnct.php");
		
		$vCode = mysqli_real_escape_string($db,trim($vCode));

		$insd = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("USER ACCOUNT OPENDED FOR RESET")."' AND r_user = '".$vCode."');";
		$resd = mysqli_query($db,$insd);
		@$rw = mysqli_fetch_array($resd);
		$sumdata = $rw["syncstate"];
		
		mysqli_close($db);
		
		return $sumdata;
	}
}
 

if(function_exists('resetPassword'))
{
	
}
else
{
	function resetPassword($userID,$Password){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));
		
		$Password = password_hash(mysqli_real_escape_string($db, trim($Password)),PASSWORD_BCRYPT,["cost"=>"12"]);

		$insd = "UPDATE _user_acnts SET Password = '".$Password."' WHERE userID = '".$userID."';";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		
		if($resd)
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
 

if(function_exists('checkOpenRecoveryStatus'))
{
	
}
else
{
	function checkOpenRecoveryStatus($userID){

		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));

		$sel = "SELECT * FROM _user_acnts WHERE userID = (SELECT max(userID) FROM _user_acnts WHERE ((userID = '".$userID."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userID."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userID."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userID."' AND (Email != '' OR Email != 'NULL'))));";
		//echo $insd;
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		if($num==1)
		{
			$rwx = mysqli_fetch_array($res);
			$userIDx = $rwx["userID"];
			
			mysqli_close($db);
			
			include find_file('cnct.php');
			
			$insd = "SELECT sum(data) AS sumdata FROM meta WHERE userid = '".md5($userIDx)."' AND meta_data = '".md5("USER ACCOUNT OPENDED FOR RESET")."';";
			$resd = mysqli_query($db,$insd);
			
			$insd2 = "SELECT sum(data) AS sumdata FROM meta WHERE userid = '".md5($userIDx)."' AND meta_data = '".md5("USER ACCOUNT CLOSED FOR RESET")."';";
			$resd2 = mysqli_query($db,$insd2);
			
			if($resd && $resd2)
			{
				@$rw = mysqli_fetch_array($resd);
				$openStatus = $rw["sumdata"];
				
				@$rw2 = mysqli_fetch_array($resd);
				$closeStatus = $rw2["sumdata"];
				
				return ($openStatus-$closeStatus);
			}
			else
			{
				return "ERROR";
			}
		}
		else
		{
			return "ACCOUNT NOT FOUND";
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('recoveryCodeStatus'))
{
	
}
else
{
	function recoveryCodeStatus($userID,$vCode){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));
		$vCode = mysqli_real_escape_string($db,trim($vCode));

		$sel = "SELECT * FROM _user_acnts WHERE userID = ((userID = '".$userID."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userID."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userID."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userID."' AND (Email != '' OR Email != 'NULL'))));";
		//echo $insd;
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		if($num==1)
		{
			$rwx = mysqli_fetch_array($res);
			$userIDx = $rwx["userID"];
			
			mysqli_close($db);
			
			include find_file('cnct.php');
			
			$insd = "SELECT sum(data) AS sumdata FROM meta WHERE userid = '".md5($userIDx)."' AND meta_data = '".md5("USER ACCOUNT OPENDED FOR RESET")."' AND r_user = '".$vCode."';";
			$resd = mysqli_query($db,$insd);
			@$rw = mysqli_fetch_array($resd);
			$sumdata = $rw["sumdata"];
			
			return $sumdata;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('closeRecovery'))
{
	
}
else
{
	function closeRecovery($userID,$vCode,$newPassword){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));
		$vCode = mysqli_real_escape_string($db,trim($vCode));
		$newPassword = mysqli_real_escape_string($db,trim($newPassword));

		$insd = "SELECT * FROM _user_acnts WHERE userID = (SELECT max(userID) FROM _user_acnts WHERE ((userID = '".$userID."' AND (userID != '' OR userID != 'NULL')) OR (Mobile = '".$userID."' AND (Mobile != '' OR Mobile != 'NULL')) OR (vCode = '".$userID."' AND (vCode != '' OR vCode != 'NULL')) OR (Email = '".$userID."' AND (Email != '' OR Email != 'NULL'))));";
		//echo $insd;
		$resd = mysqli_query($db,$insd);
		@$numd = mysqli_num_rows($resd);
		
		if($numd==1)
		{
			$rw = mysqli_fetch_array($resd);
			$userIDx = $rw["userID"];
			
			mysqli_close($db);
			
			if(recoveryCodeStatus($userID,$vCode)>=1 && !(checkOpenRecoveryStatus($userID)=="ERROR"))
			{
				if(checkOpenRecoveryStatus($userID)>=1)
				{
					if(resetPassword($userIDx,$newPassword)>=1)
					{
						include find_file("cnct.php");
						
						$ins = "INSERT INTO meta (id,userid,data,meta_data,r_user) VALUES ('','".md5($userIDx)."','".checkOpenRecoveryStatus($userID)."','".md5("USER ACCOUNT CLOSED FOR RESET")."','".$vCode."');";
						$res = mysqli_query($db,$ins);
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
					else
					{
						return 0;
					}
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
		}
		else
		{
			return 0;
			mysqli_close($db);
		}
		
		
	}
}

	/*
	function createAccount($fname,$lname,$gender,$dob,$houseNo,$street,$area,$phoneNumber,$emailAdd,$nrcNumber,$town,$province,$country,$username,$password){
		// include db connect class

		include find_file("cnct.php");
		
		if(checkAccount("TEMP",$phoneNumber)==1 || checkAccount("TEMP",$emailAdd)==1)
		{	
			$query = "UPDATE _user_acnts SET fName = '$fname',lName = '$lname',sex = '$gender',DOB = '$dob',houseNo = '$houseNo',street = '$street',area = '$area',phone = '".standadizesMobile($phoneNumber)."',email = '$emailAdd',nrcNumber = '$nrcNumber',town = '$town',province = '$province',country = '$country',username = '$username',password = '".MD5($password)."',status = 'Active';";
		}
		else
		{
			$query = "INSERT INTO _user_acnts(userID,fName,lName,sex,DOB,houseNo,street,area,phone,email,nrcNumber,town,province,country,username,password,status) VALUES('','$fname','$lname','$gender','$dob','$houseNo','$street','$area','".standadizesMobile($phoneNumber)."','$emailAdd','$nrcNumber','$town','$province','$country','$username','".MD5($password)."','Active');";
		}
		
		$result = mysqli_query($db,$query);
		// check if row inserted or not
		if ($result) 
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
	*/
 

if(function_exists('createTempAccount'))
{
	
}
else
{ 
	function createTempAccount($phoneNumber){

		include find_file("cnct.php");
		
		$phoneNumber = mysqli_real_escape_string($db,trim($phoneNumber));
		
		$query = "INSERT INTO _user_acnts (userID,Mobile,Active) VALUES('','".standadizesMobile($phoneNumber)."','Temp');";	
		$result = mysqli_query($db,$query);
		// check if row inserted or not
		if ($result) 
		{
			return 1;
		} 
		else 
		{
			// failed to insert row
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('sendVCode'))
{
	
}
else
{
	function sendVCode($Mobile,$vCode){
			
		$validity = 10;
		
		$message = utf8_encode("Your Verification Code is ".$vCode.".");
		
		//echo $message;
		
		$params = array(
	   "username" => BULK_SMS_USERNAME(),
	   "password" => BULK_SMS_PASSWORD(),
	   "type" => "0",
	   "dlr" => "1",
	   "destination" => standadizesMobile($Mobile),
	   "source" => "UAgro",
	   "message" => $message
		);
	 
		httpGet(BULK_SMS_URL(),$params);
	}
}
 

if(function_exists('verifyAccountVCode'))
{
	
}
else
{
	function verifyAccountVCode($vCode,$userID){

		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));
		$vCode = mysqli_real_escape_string($db,trim($vCode));
		
		$timex = (date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s);

		$insd = "SELECT COUNT(id) AS numData FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("USER ACCOUNT VERIFICATION CODE")."' AND userid = '".md5(userID($userID))."' AND r_user = '".$vCode."' AND numdata >= '".($timex-(10*60))."');";
		//echo $insd."<br>";
		$resd = mysqli_query($db,$insd);
		@$rw = mysqli_fetch_array($resd);
		$numData = $rw["numData"];
		
		return $numData;
		
		mysqli_close($db);
	}
}
 

if(function_exists('checkAccountHasVCode'))
{
	
}
else
{
	function checkAccountHasVCode($userID){

		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));
		
		$timex = (date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s);

		$insd = "SELECT COUNT(id) AS numData FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("USER ACCOUNT VERIFICATION CODE")."' AND userid '".md5(userID($userID))."' AND numdata >= '".($timex-(15*60))."');";
		$resd = mysqli_query($db,$insd);
		@$rw = mysqli_fetch_array($resd);
		$numData = $rw["numData"];
		
		mysqli_close($db);
		
		return $numData;
	}
}
 

if(function_exists('addProfilePicture'))
{
	
}
else
{
	function addProfilePicture($userID,$image){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));
		$image = mysqli_real_escape_string($db,trim($image));
		
		$insertXA = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".md5($userID)."','".$image."','".md5("YOUR PROFILE PICTURE")."','');";
		@$resINSXA = mysqli_query($db,$insertXA);
		if($resINSXA)
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
 

if(function_exists('getProfilePicture'))
{
	
}
else
{
	function getProfilePicture($userIDx){
		
		include find_file("cnct.php");
		
		$userIDx = mysqli_real_escape_string($db,trim($userIDx));
		
		$insertXA = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5($userIDx)."' AND meta_data = '".md5("YOUR PROFILE PICTURE")."');";
		
		//echo $insertXA."<br><br>";
		@$resINSXA = mysqli_query($db,$insertXA);
		if($resINSXA)
		{
			@$num = mysqli_num_rows($resINSXA);
			@$rw = mysqli_fetch_array($resINSXA);
			$profile = $rw["data"];
			
			if($num==1)
			{
				return $profile;
			}
			else
			{
				return "placeholder.png";
			}
			
		}
		else
		{
			return "placeholder.png";
		}
		mysqli_close($db);
	}
}
 

if(function_exists('addCoverImage'))
{
	
}
else
{
	function addCoverImage($userID,$image){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));
		$image = mysqli_real_escape_string($db,trim($image));
		
		$insertXA = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".md5($userID)."','".$image."','".md5("YOUR COVER IMAGE")."','');";
		@$resINSXA = mysqli_query($db,$insertXA);
		if($resINSXA)
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
 

if(function_exists('getCoverImage'))
{
	
}
else
{
	function getCoverImage($userID){
		
		include find_file("cnct.php");
		
		$userID = mysqli_real_escape_string($db,trim($userID));
		
		$insertXA = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid = '".md5($userID)."' AND meta_data = '".md5("YOUR COVER IMAGE")."');";
		@$resINSXA = mysqli_query($db,$insertXA);
		if($resINSXA)
		{
			@$num = mysqli_num_rows($resINSXA);
			@$rw = mysqli_fetch_array($resINSXA);
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
 

if(function_exists('mobileRecovery'))
{
	
}
else
{
	function mobileRecovery($vCode,$userID,$newPassword1,$newPassword2){
		
		//include find_file("cnct.php");
	
		if(verifyAccountVCode($vCode,$userID)==1)
		{
			if(trim($newPassword1) == trim($newPassword2))
			{
			include find_file("cnct.php");
			
			$userID = mysqli_real_escape_string($db,trim($userID));
			$newPassword1 = mysqli_real_escape_string($db,trim($newPassword1));
			
				$insd = "UPDATE _user_acnts SET Password = '".md5(trim($newPassword1))."' WHERE userID = '".$userID."';";
				//echo $insd;
				$resd = mysqli_query($db,$insd);
				
				if($resd)
				{
					return 1;
				}
				else
				{
					return 2;
				}
			
			mysqli_close($db);
			}
			else
			{
				return -1;
			}
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('endActiveSession'))
{
	
}
else
{
	function endActiveSession($vCode,$userID){
		
		$vUserID = userID($userID);
		
		if(verifyAccountVCode($vCode,$userID)==1)
		{

		include find_file("cnct.php");
		
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM online WHERE _idcry = '".$vUserID."');";
			$resd = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array($resd);
			$_sessid = $rw["_sessid"];
			
			$timex = (date(Y)*365*24*60*60)+(date(z)*24*60*60)+(date(G)*60*60)+(date(i)*60)+date(s);
		
			$ins = "INSERT INTO online (_sessid,_idcry,Status,time) VALUES('".$_sessid."','".$vUserID."','Logged Out','$timex');";
			//echo $ins."<br>";
			$res = mysqli_query($db,$ins);
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
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('createSession'))
{
	
}
else
{
	function createSession($userIDx){
		
		$userID = userID($userIDx);
		
		$Mobile =getUserData($userID,"Mobile");
		$Email =getUserData($userID,"EMAIL");
		
		$sess_id = rand(0, 999999999);
		$timex = currentTimeInSeconds();
		$ccc = md5($timex." ".$sess_id."".$userID."".$Mobile);
		$vCodex = md5(md5($timex)."|".$sess_id."|".$userID."|".md5($Mobile."|",$Email));


		include find_file("cnct.php");
		
		$qry = "INSERT INTO online (_sessid,_idcry,Status,vCode,time) VALUES('".$ccc."','".$userID."','Logged On','".$vCodex."','".strtotime(date("Y-m-d H:i:s"))."');";
		//echo "<br><br><br>Session created: ".$qry."<br>";
		$result = mysqli_query($db,$qry);
		if ($result)
		{
			return array('vCode'=>$vCodex,'time'=>$timex,'ccc'=>$ccc);
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('getSessionData'))
{
	
}
else
{
	function getSessionData($users,$type="",$class="Logged On"){
		
		if(strtoupper($class)=="LOGGED OUT")
		{
			$classx = "Logged Out";
		}
		else
		{
			$classx = "Logged On";
		}
		
		$vUserID = userID($users);

		include find_file("cnct.php");

		$selectx = "SELECT * from online where id = (SELECT  max(id) as maxID FROM online WHERE _idcry = '".$vUserID."' AND Status = '".$classx."');";
		@$resultx = mysqli_query($db,$selectx);
		@$numx = mysqli_num_rows($resultx);
		@$rowx = mysqli_fetch_array($resultx);
		$MaxStatus = $rowx["Status"];
		$MaxTime = $rowx["time"];
		$date_set = $rowx["date_set"];
		$sessid = $rowx["_sessid"];
		$vCode = $rowx["vCode"];
		
		//echo "session data:".$selectx."<br>";
		
		if($type=="" || strtoupper($type)=="SESSID")
		{
			return $sessid;
		}
		elseif(strtoupper($type)=="TIME")
		{
			return $MaxTime;
		}
		elseif(strtoupper($type)=="DATE")
		{
			return $date_set;
		}
		elseif(strtoupper($type)=="STATUS")
		{
			return $MaxStatus;
		}
		elseif(strtoupper($type)=="VCODE")
		{
			return $vCode;
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('getSessionSetting'))
{
	
}
else
{
	function getSessionSetting($type=""){

		include find_file("cnct.php");
		
		$multS = "SELECT * FROM _sessions WHERE id = (SELECT max(id) FROM _sessions WHERE 1)";
		$resMlt = mysqli_query($db,$multS);
		@$rwMl = mysqli_fetch_array($resMlt);
		$SessionDuration = $rwMl["session_duration"];
		$multi_log = $rwMl["multi_log"];
			
		
		if($type=="" || strtoupper($type)=="SESSION TYPE")
		{
			return $multi_log;
		}
		elseif(strtoupper($type)=="DURATION")
		{
			return $SessionDuration;
		}
		
		mysqli_close($db);
	}
}
?>