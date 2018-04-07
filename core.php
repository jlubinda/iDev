<?php 

if(function_exists('r_url'))
{
	
}
else
{
	function r_url($levels){
		
		$level_url = "";
		$append = "../";
		$url = "";
		for($a=0; $a<$levels; $a++)
		{
			if($a==0)
			{
				$url .= $level_url;
			}
			else
			{
				$url .= $append;
			}
		}
		
		return $url;
	}
}

if(function_exists('find_file'))
{
	
}
else
{

	function find_file($file,$levels=10,$start=0,$test=""){
		$next = 0;
		$level_url = "";
		
		$lev = 0;
		while($next<$levels)
		{
			if($start<=$next)
			{
				if(file_exists(r_url($next).$file))
				{
					$lev = $next;
					$next = $levels;
				}
				else
				{
					$lev = 0-1;
					$next = $next+1;
				}
			}
			else
			{
				$lev = 0-1;
				$next = $next+1;
			}
		}
		
		$rFile = r_url($lev).$file;
		
		if($test=="1" || strtoupper($test)=="YES")
		{
			echo "FILE URL: ".$rFile."<br>";
		}
		
		return $rFile;
	}
}

if(function_exists('standadizesMobile'))
{
	
}
else
{


	function standadizesMobile($sender){

	$senderv = stripslashes($sender);
	$senderv = str_replace(" ","",$senderv);
	$senderv = str_replace("-","",$senderv);
	$senderv = str_replace("*","",$senderv);
	$senderv = str_replace(".","",$senderv);
	$senderv = str_replace(",","",$senderv);
	$senderv = str_replace("|","",$senderv);
	$senderv = str_replace("(","",$senderv);
	$senderv = str_replace(")","",$senderv);
	$senderv = str_replace("[","",$senderv);
	$senderv = str_replace("]","",$senderv);
	$senderv = str_replace("{","",$senderv);
	$senderv = str_replace("}","",$senderv);
	$senderv = str_replace('"','',$senderv);
	$senderv = str_replace("'","",$senderv);
	$senderv = str_replace("/","",$senderv);
	$senderv = str_replace("\n","",$senderv);
	$senderv = str_replace("\t","",$senderv);
	$senderv = str_replace("#","",$senderv);
	$senderv = str_replace("@","",$senderv);
	$senderv = str_replace("!","",$senderv);
	$senderv = str_replace("$","",$senderv);
	$senderv = str_replace("%","",$senderv);
	$senderv = str_replace("^","",$senderv);
	$senderv = str_replace("&","",$senderv);
	$senderv = str_replace("=","",$senderv);
	$senderv = str_replace("`","",$senderv);
	$senderv = str_replace("~","",$senderv);
	$senderv = str_replace("?","",$senderv);
	$senderv = str_replace(":","",$senderv);
	$senderv = str_replace(";","",$senderv);
	$senderv = str_replace(">","",$senderv);
	$senderv = str_replace("<","",$senderv);
		
		$q1 = explode("097",$senderv);
		$q2 = explode("096",$senderv);
		$q3 = explode("095",$senderv);
		
		@$check1 = mb_strlen($q1[1], "UTF-8");
		@$check2 = mb_strlen($q2[1], "UTF-8");
		@$check3 = mb_strlen($q3[1], "UTF-8");
		
		if($check1==7)
		{
			$senderx = "26097".$q1[1];
		}
		else
		{
			if($check2==7)
			{
				$senderx = "26096".$q2[1];
			}
			else
			{
				if($check3==7)
				{
					$senderx = "26095".$q3[1];
				}
				else
				{
					$senderx = $sender;
				}
			}
		}
		
		return $senderx;
	}

}


if(function_exists('sksort'))
{
	
}
else
{


	function sksort(&$array, $subkey="id", $sort_ascending=false) {

		if (count($array))
			$temp_array[key($array)] = array_shift($array);

		foreach($array as $key => $val){
			$offset = 0;
			$found = false;
			foreach($temp_array as $tmp_key => $tmp_val)
			{
				if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
				{
					$temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
												array($key => $val),
												array_slice($temp_array,$offset)
											  );
					$found = true;
				}
				$offset++;
			}
			if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
		}

		if ($sort_ascending) $array = array_reverse($temp_array);

		else $array = $temp_array;
	}
}


if(function_exists("chkSes"))
{
	
}
else
{
	function chkSes(){
		if(isset($_SESSION["UID"]))
		{
			return "Active";
		}
		else
		{
			return "Inactive";
		}
	}
}


//CORE FUNCTIONS 
	include find_file("core/apis/api_keys.php");
	include find_file("core/apis/api_key_privs.php");
//CORE FUNCTIONS
	//NO DEPENDENCIES
	include find_file("core/math/oddeven.php");
	include find_file("core/time/times.php");
	include find_file("core/file_system/dirname.php");
	include find_file("core/file_system/delete_files.php");
	include find_file("core/internet/getip.php");
	include find_file("core/security/crypt.php");
	include find_file("core/db/meta.php");
	include find_file("core/internet/email.php");
	include find_file("core/internet/mobile_network_settings.php");
	include find_file("core/structure/router.php");
	//NO DEPENDENCIES
	
	//HAVING DEPENDENCIES
	include find_file("core/other/uniquecode.php");
	include find_file("core/internet/external_api_keys.php");
	include find_file("core/geo/countries.php");
	include find_file("core/file_system/fileuploader.php");
	include find_file("core/internet/curlpost.php");
	include find_file("core/other/vouchergen.php");
	//HAVING DEPENDENCIES
//CORE FUNCTIONS

//SYSTEM
	include_once find_file("core/users/userdata.php");
	include_once find_file("core/users/userpriv.php");
	include_once find_file("core/users/orgdata.php");
	include_once find_file("core/users/checkperm.php");
	include_once find_file("mis/priv.php");

	//GUI FUNCTIONS
	include_once find_file("core/gui/mainmenu.php");
	include_once find_file("core/gui/metadata.php");
	include_once find_file("core/gui/pagetitle.php");
	include_once find_file("core/gui/themeurl.php");
	include_once find_file("core/gui/mysidebar.php");
	include_once find_file("core/gui/adminsidebar.php");

	//SYSTEM STRUCTURE FUNCTIONS
	include_once find_file("core/structure/privacy.php");
	include_once find_file("core/structure/adminoptions.php");
	include_once find_file("core/structure/mypages.php");
	include_once find_file("core/structure/subpages.php");
	include_once find_file("core/structure/userbar.php");
	include_once find_file("core/structure/pagenavigator.php");
	include_once find_file("core/structure/sitedata.php");
	include_once find_file("core/structure/slider.php");


?>