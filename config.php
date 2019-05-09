<?php 
if(function_exists("iDevConfig"))
{
	
}
else
{
	function iDevConfig($ax=""){
		
		$a = strtoupper(trim($ax));
		
		$iDevConfig["ACCESS"] = "http"; //how should visitors access your site: https (only via https), http (either https or http)
		$iDevConfig["API_KEY"] = ""; //your Applodes.com API KEY
		$iDevConfig["URL"] = "localhost/vp4"; //what is yours site's url
		$iDevConfig["BACKGROUND_COLOR"] = "#222";
		$iDevConfig["LOGIN_URL"] = "./?ref=vehicles.php";
		$iDevConfig["TITLE"] = "Vehicle Portal"; //what is yours site's title
		$iDevConfig["DESCRIPTION"] = "Your car sharing service of choice"; //what is yours site's description
		$iDevConfig["ROBOTS_INDEX"] = "YES"; //should search engines index the site?
		$iDevConfig["ROBOTS_FOLLOW"] = "YES"; //should search engines follow the site?
		$iDevConfig["FALCON"] = ""; //the url to the image that should be used as the falcon
		$iDevConfig["TAGLINE"] = ""; //what is yours site's tagline
		$iDevConfig["DASHBOARD_NAME"] = "PROFILE"; //what is yours site's dashboard name
		$iDevConfig["DASHBOARD_URL"] = "profile"; //what is yours site's dashboard url
		$iDevConfig["STORE"] = "VEHICLES"; //what is yours site's store name
		$iDevConfig["STORE_URL"] = "vehicles"; //what is yours site's store url
		$iDevConfig["DASHBOARD_DISPLAY"] = ""; //should your site have a dashboard?
		$iDevConfig["STORE_ACCESS"] = "LOGGED IN"; //how should visitors access your store: LOGGIN IN (only when they are logged in), OPEN (everyone can access the store)
		$iDevConfig["YOUR_STORE"] = ""; //TBA
		$iDevConfig["REDIRECT"] = "YES"; //should redirect be enabled?
		$iDevConfig["DBNAME"] = "project_db"; //specify database name
		$iDevConfig["DBUSER"] = "root"; //specify database username
		$iDevConfig["DBPWD"] = ""; //specify database password
		$iDevConfig["DBHOST"] = "localhost"; //specify database host
		$iDevConfig["DBPORT"] = ""; //specify database port
		
		if($a=="" || !(isset($a)) || $a==null)
		{
			return $iDevConfig[$a]; //specify database port
		}	
		else
		{
			return $iDevConfig;
		}
	}
}
?>
