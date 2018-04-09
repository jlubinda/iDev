<?php

if(function_exists("checkRemoteFile"))
{

}
else
{
	function checkRemoteFile($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		// don't download content
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if(curl_exec($ch)!==FALSE)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

if(function_exists('API_URL'))
{
	
}
else
{
	function API_URL(){
		return 'https://api.applodes.com';
		//return 'http://localhost/api';
	}
}

if(function_exists('API_VERSION'))
{
	
}
else
{
	function API_VERSION(){
		return 'v1';
	}
}

if(function_exists('API_KEY'))
{
	
}
else
{
	function API_KEY($x=""){
		if((isset($_SESSION[SesUID()]) && !($_SESSION[SesUID()]=="")) && $x=="")
		{
			return '9FB8666C084AB33FB4DCF9CD035161C6';
		}
		elseif($x=="provider")
		{
			return '9FB8666C084AB33FB4DCF9CD035161C6';
		}
		elseif($x=="login")
		{
			return '9FB8666C084AB33FB4DCF9CD035161C6';
		}
		else
		{
			return '9FB8666C084AB33FB4DCF9CD035161C6';
		}
	}
}

if(function_exists('API_OUTPUT_FORMAT'))
{
	
}
else
{
	function API_OUTPUT_FORMAT(){
		return 'json';
	}
}

if(function_exists('API_DATA_CENTRE'))
{
	
}
else
{
	function API_DATA_CENTRE(){
		return 'test';
	}
}

if(function_exists('API_ENVIRONMENT'))
{
	
}
else
{
	function API_ENVIRONMENT(){
		return 'deployment';
	}
}

if(function_exists('SHOW_API_ERROR_MESSAGES'))
{
	
}
else
{
	function SHOW_API_ERROR_MESSAGES(){
		//return 1;
		return 0;
	}
}


if(function_exists('httpPostXML'))
{
	
}
else
{
	function httpPostXML($url,$xml){
		
		$headers = array(
			"Content-type: text/xml;charset=\"utf-8\"",
			"Accept: text/xml",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			"SOAPAction: \"run\""
		 );
		
			/*
		        //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);

            // send xml request to a server

            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

            curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			*/
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_ENCODING , "gzip");
			@curl_setopt($ch, CURLOPT_MUTE, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$server_output = curl_exec($ch);
		curl_close($ch);

		return xmlrpc_decode($server_output);
		exit;
	}
}


if(function_exists('httpGetXML'))
{
	
}
else
{
	function httpGetXML($url){
		
		$headers = array(
			"Content-type: text/xml;charset=\"utf-8\"",
			"Accept: text/xml",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			"SOAPAction: \"run\""
		 );
		
			/*
		        //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);

            // send xml request to a server

            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

            curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			*/
			
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_ENCODING , "gzip");
		@curl_setopt($ch, CURLOPT_MUTE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$server_output = curl_exec($ch);
		curl_close($ch);
		$return = xmlrpc_decode($server_output);
		//echo "testing curl: ".($json);
		return $return;
		exit;
	}
}



if(function_exists('httpPostJSON'))
{
	
}
else
{
	function httpPostJSON($url,$params){
		
		$headers = array(
			"Content-Type: application/x-www-form-urlencoded;charset=\"utf-8\"",
			"accept: application/json",
			"accept-encoding: gzip, deflate",
			"content-type: application/json",
			"user-agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36",
			"accept-language: en-US,en;q=0.8",
			"Cache-Control: no-cache",
			"Pragma: no-cache"
		 );
		
	   //create name value pairs seperated by &
		foreach($params as $k => $v) 
		{ 
			$json .= $k . '='.$v.'&'; 
		}
		
		$json = rtrim($json, '&');
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_FAILONERROR , 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
		curl_setopt($ch, CURLOPT_ENCODING , "gzip");
		@curl_setopt($ch, CURLOPT_MUTE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36");
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		$cookie = "cookie.txt";
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
		
		$server_output = curl_exec($ch);
		curl_close($ch);
		$return = xmlrpc_decode(xmlrpc_encode(json_decode($server_output)));
		//echo "testing curl: ".($server_output);
		return $return;
		exit;
	}
}



if(function_exists('httpGetJSON'))
{
	
}
else
{
	function httpGetJSON($url){
		
		$headers = array(
			"Content-Type: application/x-www-form-urlencoded;charset=\"utf-8\"",
			"accept: application/json",
			"accept-encoding: gzip, deflate",
			"content-type: application/json",
			"user-agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36",
			"accept-language: en-US,en;q=0.8",
			"Cache-Control: no-cache",
			"Pragma: no-cache"
		 );
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_ENCODING , "gzip");
		@curl_setopt($ch, CURLOPT_MUTE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$server_output = curl_exec($ch);
		curl_close($ch);
		$return = xmlrpc_decode(xmlrpc_encode(json_decode($server_output)));
		//echo "testing curl: ".($json);
		return $return;
		exit;
	}
}


if(function_exists('httpPost'))
{
	
}
else
{
	function httpPost($url,$params){
		$postData = '';
	   //create name value pairs seperated by &
		foreach($params as $k => $v) 
		{ 
			$postData .= $k . '='.$v.'&'; 
		}
	   
		$postData = rtrim($postData, '&');
	 
		$ch = curl_init();  
	 
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false); 
		curl_setopt($ch, CURLOPT_POST, count($postData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
	 
		$output=curl_exec($ch);
	 
		curl_close($ch);
		
		return $output;
		exit;
	}
}
 

if(function_exists('httpGet'))
{
	
}
else
{
	function httpGet($url,$params=""){
		
		if($params=="")
		{
			$url = $url;
		}
		else
		{
			$url = $url.''.http_build_query($params, '', '&');
		}
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
		@$response = curl_exec($ch);
		
		curl_close($ch);
		
		//echo "CURL: ".$url."<br>";
		
		return @$response;
		exit;
	}
}

if(function_exists('APPLODES_GET_REQUEST'))
{
	
}
else
{
	function APPLODES_GET_REQUEST($endpoint,$x=""){
		
		$url = API_URL()."/".API_VERSION()."/".API_KEY($x)."/".API_OUTPUT_FORMAT()."/".API_DATA_CENTRE()."/".API_ENVIRONMENT()."/".$endpoint;
		
		if(strtolower(API_OUTPUT_FORMAT())=='json')
		{
			@$response = httpGetJSON($url);
		}
		elseif(strtolower(API_OUTPUT_FORMAT())=='xml')
		{
			@$response = httpGetXML($url);
		}
		else
		{
			@$response = httpGet($url);
		}
		
		if(strtolower(API_OUTPUT_FORMAT())=='json' || strtolower(API_OUTPUT_FORMAT())=='xml')
		{
			if(SHOW_API_ERROR_MESSAGES()==1)
			{
				echo '<script type="text/javascript">alert("'.@$response["message"].' Code:'.@$response["status_code"].'");</script>';
			}
			
			return @$response;
		}
		else
		{
			return @$response;
		}
	}
}

if(function_exists('APPLODES_POST_REQUEST'))
{
	
}
else
{
	function APPLODES_POST_REQUEST($endpoint,$data,$login=""){
		
		$url = API_URL()."/".API_VERSION()."/".API_KEY($login)."/".API_OUTPUT_FORMAT()."/".API_DATA_CENTRE()."/".API_ENVIRONMENT()."/".$endpoint;
		
		@$response = httpPostJSON($url,$data);
		
		if(strtolower(API_OUTPUT_FORMAT())=='json')
		{
			@$response = httpPostJSON($url,$data);
		}
		elseif(strtolower(API_OUTPUT_FORMAT())=='xml')
		{
			@$response = httpPostXML($url,$data);
		}
		else
		{
			@$response = httpPost($url,$data);
		}
		
		if(strtolower(API_OUTPUT_FORMAT())=='json' || strtolower(API_OUTPUT_FORMAT())=='xml')
		{
			if(SHOW_API_ERROR_MESSAGES()==1)
			{
				echo '<script type="text/javascript">alert("'.@$response["message"].' Code:'.@$response["status_code"].'");</script>';
			}
			
			return @$response;
		}
		else
		{
			return @$response;
		}
	}
}
 

if(function_exists('BULK_SMS_USERNAME'))
{
	
}
else
{

	function BULK_SMS_USERNAME($type="",$datax=""){
		
		include find_file("cnct.php");
		
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (userid,data,meta_data) VALUES ('".uniqueCode()."','".$datax."','".md5("BULK SMS USERNAME")."');";
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
		else
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id)  FROM meta WHERE meta_data = '".md5("BULK SMS USERNAME")."');";
			@$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array(@$res);
			$data = $rw["data"];
			return $data;
		}
		
		mysqli_close($db);	
	}

}
 

if(function_exists('BULK_SMS_PASSWORD'))
{
	
}
else
{
	function BULK_SMS_PASSWORD($type="",$datax=""){
		
		include find_file("cnct.php");
		
		if($type=="ADD")
		{
			$ins = "INSERT INTO meta (userid,data,meta_data) VALUES ('".uniqueCode()."','".$datax."','".md5("BULK SMS PASSWORD")."');";
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
		else
		{
			$sel = "SELECT * FROM meta WHERE id = (SELECT max(id)  FROM meta WHERE meta_data = '".md5("BULK SMS PASSWORD")."');";
			@$res = mysqli_query($db,$sel);
			@$rw = mysqli_fetch_array(@$res);
			$data = $rw["data"];
			return $data;
		}
		
		mysqli_close($db);	
	}

}
 

if(function_exists('BULK_SMS_URL'))
{
	
}
else
{

	function BULK_SMS_URL(){
		return "http://121.241.242.114:8080/bulksms/bulksms?";
	}

}
 

if(function_exists('RETURN_SMS_NUMBER'))
{
	
}
else
{
	function RETURN_SMS_NUMBER($data){
		
		return MOBILE_NETWORK("RESPONSE NUMBER",substr($data, 0, 6));
	}

}
 

if(function_exists('sendSMS'))
{
	
}
else
{
	function sendSMS($receiver,$messagex){
		
		$message = utf8_encode($messagex);
		
		$params = array(
		"username" => BULK_SMS_USERNAME(),
		"password" => BULK_SMS_PASSWORD(),
		"type" => "0",
		"dlr" => "1",
		"destination" => standadizesMobile($receiver),
		"source" => "uAgro",
		"message" => $message
			  );
			  
		@$result = httpGet(BULK_SMS_URL(),$params);
		
		$ex = explode("|",@$result);
		
		//echo "username: ".BULK_SMS_USERNAME()."<br>";
		//echo "password: ".BULK_SMS_PASSWORD()."<br>";
		//echo "test: ".$ex[0]."<br>";
		  
		  if($ex[0]=="1701")
		  {
			return 1;
		  }
		  else
		  {
			return $ex[0];
		  }
	}
}
?>
