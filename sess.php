<?php

include("uid.php");

if(function_exists("idAccess"))
{
	
}
else
{
	function idAccess($type=""){
				
		if($type=="")
		{
			return 1;
		}
		elseif($type=="PAGE ID")
		{
			return $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
		}
		elseif($type=="SESSION")
		{
			 include "session.php";
		}
		elseif($type=="UI")
		{
			 include "apps/router.php";
		}
		elseif($type=="PRIV")
		{
			 include "mis/priv.php";
		}
		elseif($type=="FUNCTIONS")
		{
			 include "apps/objects.php";
		}
		elseif($type=="REDIRECT")
		{
			 iDevSite("REDIRECT");
		}
		elseif($type=="ORG FILTER")
		{
			 include "mis/orgfiltermodule.php";
		}
	}
}



if(function_exists("SesVar"))
{
	
}
else
{
	function SesVar(){
		return $_SESSION[SesUID()];
	}

	$SesVar = SesVar();

}



if(function_exists("chkSes"))
{
	
}
else
{
	function chkSes(){
		$SesVar = SesVar();
		
		if(!isset ($SesVar) || !$SesVar)
		{
		return "Inactive";
		}
		else
		{
		return "Active";
		}
	}

}



if(function_exists("pageLoggedInStats"))
{
	
}
else
{
	function pageLoggedInStats($type=""){
		
		if($type=="ADD")
		{
			//echo "test2:".chkSes();
			if(chkSes()=="Active")
			{
				$_SESSION["visited"][] = array("ref"=>$_REQUEST["ref"],"segment"=>$_REQUEST["segment"],"function"=>$_REQUEST["function"],"unit"=>$_REQUEST["unit"],"vCode"=>$_REQUEST["vCode"],"id"=>$_REQUEST["id"],"class"=>$_REQUEST["class"],"category"=>$_REQUEST["category"],"product"=>$_REQUEST["product"]);
			}
			else
			{
				$_SESSION["visited"] = "";
				unset($_SESSION["visited"]);
			}
		}
		elseif($type=="VISITED")
		{
			return $_SESSION["visited"];
		}
		elseif($type=="")
		{
			if(chkSes()=="Active")
			{
				return count($_SESSION["visited"]);
			}
			else
			{
				return -1;
			}
			
		}
	}

}



if(function_exists("check_auth"))
{
	
}
else
{
	function check_auth()
	{
	include find_file("cnct.php");
	//"USER_PASS",$_POST['Password'],"","USER_ID",$_POST['Username'],"users"
	$searchtype = "Password";

	trim($_REQUEST["searchterm"]);

	$searchtype = trim($searchtype);
	$searchtrm = trim($_REQUEST["Password"]);
	$searchterm = md5($searchtrm);
	$users = trim($_REQUEST["Username"]);		
		
		//echo $query."<br>";
		echo "<br><br><br>checkAccount Login: ";
		echo "<br>".$users;
		echo "<br>";
		echo "<br>";
		echo "<br>";
		print_r (checkAccount("LOGIN",$users,$searchtrm));
		echo "<br>";
			
		include "hours.php";

		if(checkAccount("LOGIN",$users,$searchtrm)==0)
		{
			return explode("|~|","|~||~|0|~|0|~|");
		}
		else
		{
			
			//echo "Login Test: <br>";
			
			$Password = getUserData($users,"PASSWORD");
			//echo "Password: ".$Password."<br>";
			
			$LoginNames = getUserData($users,"LoginName");
			//echo "LoginNames: ".$LoginNames."<br>";
			
			$Email = getUserData($users,"Email");
			//echo "Email: ".$Email."<br>";
			
			$Mobile = getUserData($users,"Mobile");
			//echo "Mobile: ".$Mobile."<br>";
			
			$MaxStatus = getSessionData($users,"STATUS","Logged On");
			$MaxTime = getSessionData($users,"TIME","Logged On");
			$date_set = getSessionData($users,"DATE","Logged On");
			$vCode = getSessionData($users,"VCODE","Logged On");


			$MaxStatus2 = getSessionData($users,"STATUS","Logged Out");
			$MaxTime2 = getSessionData($users,"TIME","Logged Out");
			$date_set2 = getSessionData($users,"DATE","Logged Out");
			
			$current = strtotime(date("Y-m-d H:i"));
			$sessionTime = (getSessionSetting("DURATION")*60*60);
			
			
			if(($current-$MaxTime)>=$sessionTime)
			{
				$lockoutx="0";
			}
			else
			{
				if($MaxTime2>=$MaxTime)
				{
				$lockoutx="0";
				}
				else
				{
					echo "<p align='center'>Last Logged on at: ".$date_set."<br>";
					echo "Your session will automatically be reset in ".getSessionSetting("DURATION")." hours time.<br></p>";
					$lockoutx="1";
				}
			}

			$y = explode(" ", $date_set);
			@$datexx = trim($y[0]);

			$y = explode("-", $datexx);
			@$Yearxx = trim($y[0]);
			@$Monthxx = trim($y[1]);
			@$Dayxx = trim($y[2]);
			@$timexx = trim($y[1]);

			$TimeCheck = currentTimeInSeconds();

			$SessionDuration = getSessionSetting("DURATION");
			$multi_log = getSessionSetting("SESSION TYPE");

			$sessDurHour = $SessionDuration*60*60;
			
			//echo "Multilog".$multi_log."<br>";

			if($multi_log=="No")
			{
				 if(($lockoutx=="1")&&($sessDurHour<=$MaxTime))
				 {
				 $lockout="1";
				 $ccc = "";
				 return array($ccc,$lockout,$sessStart,$MaxTime,$vCode);
				 }
				 else
				 {
				 $lockout="0";
				 
					if (($searchterm==$Password)&&($users==$LoginNames || $users==$Email || standadizesMobile($users)==$Mobile))
					{
						$userSess = createSession($users);
						
						if ($userSess==0)
						{
							$sessStart = 0;
						}
						else
						{
						$name = $level;
						$sestrue = 7;
						$sessStart = 1;
						
						$ccc = $userSess['ccc'];
						$MaxTimex = $userSess['time'];
						$vCodex = $userSess['vCode'];
						
						//set session cookie
						$_SESSION[SesUID()] = $ccc;
					
						//$sql21 = "INSERT INTO system_log (id,PageID,userID) VALUES ('','Login','".$userID."');";
						//$res21 = mysqli_query($db,$sql21);
						}
					}
					else
					{
						$ccc = "";
						$sessStart = "-1";
						$MaxTimex = 0;
						$vCodex = "";
					}
					
					return array($ccc,$lockout,$sessStart,$MaxTimex,$vCodex);
				 }
			 
			}
			else
			{
				 $lockout="0";
				 
					if (($searchterm==$Password)&&($users==$LoginNames || $users==$Email || standadizesMobile($users)==$Mobile))
					{
						$userSess = createSession($users);
						
						if ($userSess==0)
						{
							$sessStart = 0;
						}
						else
						{
						$name = $level;
						$sestrue = 7;
						$sessStart = 1;
						
						$ccc = $userSess['ccc'];
						$MaxTimex = $userSess['time'];
						$vCodex = $userSess['vCode'];
						
						//set session cookie
						$_SESSION[SesUID()] = $ccc;
					
						//$sql21 = "INSERT INTO system_log (id,PageID,userID) VALUES ('','Login','".$userID."');";
						//$res21 = mysqli_query($db,$sql21);
						}
					}
					else
					{
						$ccc = "";
						$sessStart = "-1";
						$MaxTimex = 0;
						$vCodex = "";
					}
				return array($ccc,$lockout,$sessStart,$MaxTimex,$vCodex);
			}
		}
	}

}



if(function_exists("randChars"))
{
	
}
else
{
	function randChars($chars,$length){
		
		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		
		return $str;
	}

}



if(function_exists("genPassword"))
{
	
}
else
{
	function genPassword($min,$max) {
		
		$length = rand($min,$max);
		$nums = randChars("0123456789",7);
		$smallletters = randChars("abcdefghijklmnopqrstuvwxyz",20);	
		$capitalletters = randChars("ABCDEFGHIJKLMNOPQRSTUVWXYZ",20);
		$symbols = randChars("!@#$^*|?~+-_:",4);
		
		$chars = randChars("!@#$^*|?~+-_",4).$nums.randChars("*|?~+",4).$smallletters.randChars("!@#$^",4).$capitalletters.$symbols;
		
		return randChars($chars,$length);
	}

}



if(function_exists("createAccount"))
{
	
}
else
{
	function createAccount($names,$mailpassword="",$email="",$mobile=""){
		
	include find_file("cnct.php");

		if($names=="PASSWORD EMAIL MESSAGE CREATE")
		{
			$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5(genPassword(6,20))."','".$email."','".md5('PASSWORD EMAIL MESSAGE CREATE')."');";
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
		elseif($names=="PASSWORD EMAIL MESSAGE RETRIEVE")
		{
			$sel1 = "SELECT * FROM meta WHERE id = (SELECT MAX(id) as maxID FROM meta WHERE meta_data = '".md5('PASSWORD EMAIL MESSAGE')."');";
			$res1 = mysqli_query($db,$sel1);
			@$num1 = mysqli_num_rows($res1);
			@$rw1 = mysqli_fetch_array($res1);
			
			return $rw1["data"];
		}
		else
		{

			$sel1 = "SELECT count(userID) AS maxCount FROM _user_acnts WHERE Email = '".$email."' OR Mobile = '".$mobile."' OR LoginName = 'com.admin';";
			$res1 = mysqli_query($db,$sel1);
			@$num1 = mysqli_num_rows($res1);
			@$rw1 = mysqli_fetch_array($res1);

			$sel1b = "SELECT * FROM _user_acnts WHERE LoginName = 'com.admin';";
			$res1b = mysqli_query($db,$sel1b);
			@$num1b = mysqli_num_rows($res1b);
			@$rw1b = mysqli_fetch_array($res1b);
			$adminEmail = $rw1["Email"];
			$adminLoginName = $rw1["LoginName"];
			$adminMobile = $rw1["Mobile"];
			
			
			$maxCount = $rw1["maxCount"];
			
			if($maxCount>=1)
			{
				$array = array('status'=>'Account Exists','email'=>$adminEmail,'phone'=>$adminMobile,'password'=>$password);
				return $array;
			}
			else
			{
			$nm = explode(" ",$names);
				
				$firstname = $nm[0];
				$lastname = $nm[1];
				
				$password = genPassword(6,15);
				
				$message = str_replace("[PASSWORD]",$password,$mailpassword);
				
				if($level=="FIRST TIME LOGIN")
				{
					$userlevel = "-1";
					$suCode = "";
					
				}
				else
				{
					$userlevel = "0";
				}
				
				$ins = "INSERT INTO _user_acnts (userID,UserCode,FirstName,LastName,Email,Mobile,Password,level) VALUES ('','".$suCode."','".$firstname."','".$lastname."','".$email."','".$mobile."','".md5($password)."'),'".$userlevel."';";
				$res = mysqli_query($db,$ins);
				
				if($mailpassword=="MAIL PASSWORD")
				{
					$FromEmailz = iDevSite("TITLE")."<".iDevSite("EMAIL ADDRESS").">";
					$subject = 'YOUR '.iDevSite("TITLE").' AUTO GENERATED PASSWORD';
					$headers = "From: " . strip_tags($FromEmailz) . "\r\n";
					$headers .= "Reply-To: ". strip_tags($FromEmailz) . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					$mailcontent = $message;
					
					if($res) 
					{
						if(mail($email,$subject,$mailcontent,$headers))
						{
							$array = array('status'=>'Account Created| Email Sent','email'=>$email,'phone'=>$mobile,'password'=>'');
							return $array;
						}
						else
						{
							$array = array('status'=>'Account Created| Email Not Sent','email'=>$email,'phone'=>$mobile,'password'=>$password);
							return $array;
						}
					}
					else
					{
						$array = array('status'=>'Account Not Created','email'=>'','phone'=>'','password'=>'');
						return $array;
					}
				}
				elseif($mailpassword=="MAIL AND SHOW PASSWORD")
				{
					$FromEmailz = iDevSite("TITLE")."<".iDevSite("EMAIL ADDRESS").">";
					$subject = 'YOUR '.iDevSite("TITLE").' AUTO GENERATED PASSWORD';
					$headers = "From: " . strip_tags($FromEmailz) . "\r\n";
					$headers .= "Reply-To: ". strip_tags($FromEmailz) . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					$mailcontent = $message;
					
					if($res) 
					{
						if(mail($email,$subject,$mailcontent,$headers))
						{
							$array = array('status'=>'Account Created| Email Sent','email'=>$email,'phone'=>$mobile,'password'=>$password);
							return $array;
						}
						else
						{
							$array = array('status'=>'Account Created| Email Not Sent','email'=>$email,'phone'=>$mobile,'password'=>$password);
							return $array;
						}
					}
					else
					{
						return 0;
					}
				}
				elseif($mailpassword=="SHOW PASSWORD")
				{
					$FromEmailz = iDevSite("TITLE")."<".iDevSite("EMAIL ADDRESS").">";
					$subject = 'YOUR '.iDevSite("TITLE").' AUTO GENERATED PASSWORD';
					$headers = "From: " . strip_tags($FromEmailz) . "\r\n";
					$headers .= "Reply-To: ". strip_tags($FromEmailz) . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					$mailcontent = $message;
					
					if($res) 
					{
						$array = array('status'=>'Account Created','email'=>$email,'phone'=>$mobile,'password'=>$password);
						return $array;
					}
					else
					{
						$array = array('status'=>'Account Created','email'=>$email,'phone'=>$mobile,'password'=>$password);
						return $array;
					}
				}
				else
				{
					if($res) 
					{
						$array = array('status'=>'Account Created','email'=>$email,'phone'=>$mobile,'password'=>$password);
						return $array;
					}
					else
					{
						$array = array('status'=>'Account Created','email'=>$email,'phone'=>$mobile,'password'=>$password);
						return $array;
					}
				}
			}
		}
		
		mysqli_close($db);
	}
}

if(function_exists('iDevSite'))
{
	
}
else
{
	function logout(){
		
	check_login();

	$SesVar = $_SESSION[SesUID()];

	$dd=$SesVar;
	include "links.php";
	include "cnct.php";
	include "hours.php";
	
	$timex = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60)+($mins*60)+$sec;
	
	$selectx = "SELECT * from online where id = (SELECT  max(id) as maxID FROM online WHERE _sessid = '".$SesVar."' AND Status = 'Logged On');";
	//echo $selectx;
	@ $resultx = mysqli_query($db,$selectx);
	@ $numx = mysqli_num_rows($resultx);
	@ $rowx = mysqli_fetch_array($resultx);
	$_idcry = $rowx["_idcry"];
		
		$sql21 = "INSERT INTO system_log (id,PageID,userID) VALUES ('','Logout','".$_idcry."');";
		$res21 = mysqli_query($db,$sql21);

	$querym = "INSERT INTO online (_sessid,_idcry,Status,time) VALUES('".$SesVar."','".$_idcry."','Logged Out','$timex');";
	$resultm = mysqli_query($db,$querym);

	 if($resultm)
	 {
		header("Location: $link/logout2.php");
	 }
	 else
	 {
		header("Location: $link/");
	 }
	
	mysqli_close($db);
	}
}
?>