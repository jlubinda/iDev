<?php 
 

if(function_exists('pagepost'))
{
	
}
else
{
	function pagepost($data){
		return $data;
	}
}
 

if(function_exists('pageDetails'))
{
	
}
else
{
	function pageDetails($type,$ref,$y){
		
		$ex = explode("/",$ref);
		
		$ex2 = explode(".",$ex[0]);
		
		$ex3 = explode(".",$ex[1]);
		
		if($ex[0]=="admin" || $ex2[0]=="admin")
		{
			
		}
		elseif($ex[0]=="profile" || $ex2[0]=="profile")
		{
			
		}
		elseif($ex[0]=="store" || $ex2[0]=="store")
		{
			
		}
	}
}
 

if(function_exists('pages'))
{
	
}
else
{
	function pages($x,$y=""){
	include find_file("cnct.php");

	include "mis/priv.php";

	$pgArray = explode("/", $x);
	$numPages = count($pgArray);


	$pidx = $pgArray[0];
	$pageArray = explode(".",$pidx);
	$a = $pageArray[0];

	//echo "<br><br>test: ".$a."<br>";

	$pidx2 = $pgArray[1];
	$pageArray2 = explode(".",$pidx2);
	$a2 = $pageArray2[0];


		if($y=="" || (!($y=="") && !($y==1)))
		{
			if(chkSes()=="Inactive")
			{
				if($x=="")
				{
					
							//frontPageSlider();
							
							$se = "SELECT * FROM _pages WHERE id = (SELECT max(id) AS maxID FROM _pages WHERE misc = 'SYS INDEX');";
							$re = mysqli_query($db,$se);
							@$nm = mysqli_num_rows($re);
								
							if($nm>=1)
							{
								@$rw = mysqli_fetch_array($re);
								$id = $rw["id"];
								$name = $rw["name"];
								$title = $rw["title"];
								$src = $rw["src"];
								$type = $rw["type"];
								$sidebar = $rw["sidebar"];
								$parent_page = $rw["parent_page"];
								$urly = $rw["url"];
								$mode = $rw["mode"];
								$misc = $rw["misc"];
								$status = $rw["status"];

								$sel = "SELECT * FROM meta WHERE userid = '".$src."';";
								@$res = mysqli_query($db,$sel);
								@$rw = mysqli_fetch_array(@$res);
								$u_id = $rw["userid"];
								$url = $rw["data"]; 
								
								//echo $url;
								
									if($url=="mis/index.php")
									{
										
									}
									else
									{
										if($type=="Master File")
										{
										return (include $url);
										}
										elseif($type=="File")
										{
										return (include $url);
										}
										else
										{
										return (pagepost($url));
										}
									}
							}
							
							if(!(homePageProvider()==""))
							{
								include homePageProvider();
							}
							
							include "themes/".themeurl()."/homepage.php";
						
				}
				else
				{
					if($a=="register")
					{
					return (include "register.php");
					}
					elseif($a=="ourstory" || $a=="ourstory.php")
					{
					return uagroAboutUsPage();
					}
					elseif($a=="corporates" || $a=="corporates.php")
					{
						uagroCorporates();
					}
					elseif($a=="agents" || $a=="agents.php")
					{
						uagroAgents();
					}
					elseif($a=="shops" || $a=="shops.php")
					{
						uagroShops();
					}
					elseif($a=="checkout" || $a=="checkout.php")
					{
						uagroCheckout();
					}
					elseif($a=="resolve")
					{
					return (include "resolve.php");
					}
					elseif($a=="recover")
					{
					return (include "recover.php");
					}
					elseif($a=="login")
					{
					return (include "login.php");
					}
					elseif($a=="admin")
					{
					return (include "login.php");
					}
					elseif($a==iDevSite("DASHBOARD URL"))
					{
						return	uagroDashboard();
					}
					elseif($a==iDevSite("STORE URL"))
					{
						//return	PluginFeatures("STORE ICON");
						
						if(iDevSite("STORE ACCESS")=="LOGGED IN")
						{
							return (include "login.php");
						}
						else
						{
							uagroStore();
						}
						
					}
					elseif($a=="recover")
					{
					return (include "recover.php");
					}
					elseif($a && !($a=="recover" || $a=="resolve" || $a=="register" || $a=="login"))
					{
					$selMn = "SELECT * FROM _pages WHERE status = 'Active' AND (id = '".$a."' OR name = '".$a."');";
					@@$resMn = mysqli_query($db,$selMn);
					@$num = mysqli_num_rows(@$resMn);
					@$rwM = mysqli_fetch_array(@$resMn);
					$u_id = $rwM["src"];
					$type = $rwM["type"];
					$id = $rwM["id"];	
					$sidebar = $rwM["sidebar"];	
					$mode = $rwM["mode"];		
					$misc = $rwM["misc"];		

					$sel = "SELECT * FROM meta WHERE userid = '".$u_id."' AND meta_data = '".md5("IMPORT-PAGES")."';";
					@$res = mysqli_query($db,$sel);
					@$rw = mysqli_fetch_array(@$res);
					$u_id = $rw["userid"];
					$url = $rw["data"]; 

						if($mode=="Secure|Password" || $mode=="Secure|Priv" || $mode=="Secure|Open")
						{		
						return (include "login.php");
						}
						elseif($mode=="Free|Open" || $mode=="")
						{
							if($type=="Master File")
							{
							return (include $url);
							}
							elseif($type=="File")
							{
							return (include $url);
							}
							else
							{
							return (pagepost($url));
							}
						}
							echo '<div style="position: relative; width: 100%; height: 50px; float: left; margin-bottom:50px; margin-top:50px;"></div>';
					}
					elseif(!$a)
					{
						
							//frontPageSlider();
							
							$se = "SELECT * FROM _pages WHERE id = (SELECT max(id) AS maxID FROM _pages WHERE misc = 'SYS INDEX');";
							$re = mysqli_query($db,$se);
							@$nm = mysqli_num_rows($re);
								
							if($nm>=1)
							{
								@$rw = mysqli_fetch_array($re);
								$id = $rw["id"];
								$name = $rw["name"];
								$title = $rw["title"];
								$src = $rw["src"];
								$type = $rw["type"];
								$sidebar = $rw["sidebar"];
								$parent_page = $rw["parent_page"];
								$urly = $rw["url"];
								$mode = $rw["mode"];
								$misc = $rw["misc"];
								$status = $rw["status"];

								$sel = "SELECT * FROM meta WHERE userid = '".$src."';";
								@@$res = mysqli_query($db,$sel);
								@$rw = mysqli_fetch_array(@$res);
								$u_id = $rw["userid"];
								$url = $rw["data"]; 

									if($type=="Master File")
									{
									return (include $url);
									}
									elseif($type=="File")
									{
									return (include $url);
									}
									else
									{
									return (pagepost($url));
									}
							}
							
							if(!(homePageProvider()==""))
							{
								include homePageProvider();
							}
							
							include "themes/".themeurl()."/homepage.php";
						
					}
				}
			}
			else
			{
				if($x=="")
				{
							//frontPageSlider();
						
							$se = "SELECT * FROM _pages WHERE id = (SELECT max(id) AS maxID FROM _pages WHERE misc = 'SYS INDEX');";
							@$re = mysqli_query($db,$se);
							@$nm = mysqli_num_rows($re);
									
							if($nm>=1)
							{
								@$rw = mysqli_fetch_array($re);
								$id = $rw["id"];
								$name = $rw["name"];
								$title = $rw["title"];
								$src = $rw["src"];
								$type = $rw["type"];
								$sidebar = $rw["sidebar"];
								$parent_page = $rw["parent_page"];
								$urly = $rw["url"];
								$mode = $rw["mode"];
								$misc = $rw["misc"];
								$status = $rw["status"];

								$sel = "SELECT * FROM meta WHERE userid = '".$src."';";
								@$res = mysqli_query($db,$sel);
								@$rw = mysqli_fetch_array(@$res);
								$u_id = $rw["userid"];
								$url = $rw["data"]; 

								if($mode=="Secure|Password")
								{		
									if(chkSes()=="Inactive")
									{

									}
									else 
									{
										//if()
										//{
					
										if($url=="mis/index.php")
										{
											
										}
										else
										{
											if($type=="Master File")
											{
											return (include $url);
											}
											elseif($type=="File")
											{
											return (include $url);
											}
											else
											{
											return (pagepost($url));
											}
										}
										//}
									}
								}
								elseif($mode=="Secure|Priv")
								{	
									if(chkSes()=="Inactive")
									{

									}
									else 
									{
										//if()
										//{

						
											if($url=="mis/index.php")
											{
												
											}
											else
											{
												if($type=="Master File")
												{
												return (include $url);
												}
												elseif($type=="File")
												{
												return (include $url);
												}
												else
												{
												return (pagepost($url));
												}
											}
										//}
									}
								}
								elseif($mode=="Secure|Open")
								{
									if(chkSes()=="Inactive")
									{

									}
									else 
									{					
										if($url=="mis/index.php")
										{
											
										}
										else
										{
											if($type=="Master File")
											{
											return (include $url);
											}
											elseif($type=="File")
											{
											return (include $url);
											}
											else
											{
											return (pagepost($url));
											}
										}
									}
								}
								elseif($mode=="Free|Open")
								{		
									if($url=="mis/index.php")
									{
										
									}
									else
									{
										if($type=="Master File")
										{
										return (include $url);
										}
										elseif($type=="File")
										{
										return (include $url);
										}
										else
										{
										return (pagepost($url));
										}
									}
								}
							}
							
							if(!(homePageProvider()==""))
							{
								include homePageProvider();
							}
							
							include "themes/".themeurl()."/homepage.php";
					
				}
				else
				{								
					if($a && ($a=="logout" || $a=="logout.php"))
					{
					//header("Location: ./logout.php");
					}
					elseif($a=="ourstory" || $a=="ourstory.php")
					{
						uagroAboutUsPage();
					}
					elseif($a=="corporates" || $a=="corporates.php")
					{
						uagroCorporates();
					}
					elseif($a=="agents" || $a=="agents.php")
					{
						uagroAgents();
					}
					elseif($a=="shops" || $a=="shops.php")
					{
						uagroShops();
					}
					elseif($a=="checkout" || $a=="checkout.php")
					{
						uagroCheckout();
					}
					elseif($a=="login" || $a=="login.php")
					{
						header("Location:  ./?ref=".strtolower(iDevSite("DASHBOARD URL")).".php");
					}
					elseif($a=="settings")
					{
					 (include "mis/settings.php");
					}
					elseif($a==iDevSite("DASHBOARD URL"))
					{
						iDevSite("DASHBOARD DISPLAY");
					}
					elseif($a==iDevSite("STORE URL"))
					{
						uagroStore();
					}
					elseif($a=="admin")
					{
						if(@ privacy('Secure|Priv')=='Granted')
						{
						?>
						<div class="banner">
							<div class="w3l_banner_nav_right">
							<!-- about -->
									<div class="privacy about">
											<?php
											if($a=="admin" && !$pageArray[1]=="")
											{
												adminHome($y);
											}
											else
											{
												PluginFeatures("ADMIN");
											}
											?>
									</div>
							<!-- //about -->
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="team">&nbsp;</div>
						<?php
						}
					}
					else
					{
						if(!(isset($a)) || $a=="")
						{

							//frontPageSlider();
						
							$se = "SELECT * FROM _pages WHERE id = (SELECT max(id) AS maxID FROM _pages WHERE misc = 'SYS INDEX');";
							$re = mysqli_query($db,$se);
							@$nm = mysqli_num_rows($re);
							if($nm>=1)
							{
								@$rw = mysqli_fetch_array($re);
								$id = $rw["id"];
								$name = $rw["name"];
								$title = $rw["title"];
								$src = $rw["src"];
								$type = $rw["type"];
								$sidebar = $rw["sidebar"];
								$parent_page = $rw["parent_page"];
								$urly = $rw["url"];
								$mode = $rw["mode"];
								$misc = $rw["misc"];
								$status = $rw["status"];

								$sel = "SELECT * FROM meta WHERE userid = '".$src."';";
								@$res = mysqli_query($db,$sel);
								@$rw = mysqli_fetch_array(@$res);
								$u_id = $rw["userid"];
								$url = $rw["data"]; 

								if($mode=="Secure|Password")
								{		
									if(chkSes()=="Inactive")
									{

									}
									else 
									{
										//if()
										//{
											if($type=="Master File")
											{
											return (include $url);	
											}
											elseif($type=="File")
											{
											return (include $url);
											}
											else
											{
											return (pagepost($url));
											}
										//}
									}
								}
								elseif($mode=="Secure|Priv")
								{	
									if(chkSes()=="Inactive")
									{

									}
									else 
									{
										//if()
										//{
											if($type=="Master File")
											{
											return (include $url);
											}
											elseif($type=="File")
											{
											return (include $url);
											}
											else
											{
											return (pagepost($url));
											}
										//}
									}
								}
								elseif($mode=="Secure|Open")
								{
									if(chkSes()=="Inactive")
									{

									}
									else 
									{
										if($type=="Master File")
										{
										return (include $url);
										}
										elseif($type=="File")
										{
										return (include $url);
										}
										else
										{
										return (pagepost($url));
										}
									}
								}
								elseif($mode=="Free|Open")
								{
									if($type=="Master File")
									{
									return (include $url);
									}
									elseif($type=="File")
									{
									return (include $url);
									}
									else
									{
									return (pagepost($url));
									}
								}
							}
							
							if(!(homePageProvider()==""))
							{
								include homePageProvider();
							}
							
							include "themes/".themeurl()."/homepage.php";
					
						}
						else
						{
						
						$selMn = "SELECT * FROM _pages WHERE status = 'Active' AND (id = '".$a."' OR name = '".$a."');";
						@@$resMn = mysqli_query($db,$selMn);
						@$num = mysqli_num_rows(@$resMn);
						@$rwM = mysqli_fetch_array(@$resMn);
						$u_id = $rwM["src"];
						$type = $rwM["type"];
						$id = $rwM["id"];	
						$sidebar = $rwM["sidebar"];	
						$mode = $rwM["mode"];		
						$misc = $rwM["misc"];		

							$sel = "SELECT * FROM meta WHERE userid = '".$u_id."' AND meta_data = '".md5("IMPORT-PAGES")."';";
							@$res = mysqli_query($db,$sel);
							@$rw = mysqli_fetch_array(@$res);
							$u_id = $rw["userid"];
							$url = $rw["data"]; 
							
						if($mode=="Secure|Password")
						{
							if(chkSes()=="Inactive")
							{

							}
							else 
							{
								//if()
								//{
									if($type=="Master File")
									{
									return (include $url);
									}
									elseif($type=="File")
									{
									return (include $url);
									}
									else
									{
									return (pagepost($url));
									}
								//}
							}
						}
						elseif($mode=="Secure|Priv")
						{		
							if(chkSes()=="Inactive")
							{

							}
							else 
							{
								//if()
								//{
									
									if($type=="Master File")
									{
									return (include $url);
									}
									elseif($type=="File")
									{
									return (include $url);
									}
								else
								{
								return (pagepost($url));
								}
							//}
							}
						}
						elseif($mode=="Secure|Open")
						{
							if(chkSes()=="Inactive")
							{

							}
							else 
							{
								if($type=="Master File")
								{
								return (include $url);
								}
								elseif($type=="File")
								{
								return (include $url);
								}
								else
								{
								return (pagepost($url));
								}
							}
						}
						elseif($mode=="Free|Open")
						{
							if($type=="Master File")
							{
							return (include $url);
							}
							elseif($type=="File")
							{
							return (include $url);
							}
							else
							{
							return (pagepost($url));
							}
						}
							echo '<div style="position: relative; width: 100%; height: 50px; float: left; margin-bottom:50px; margin-top:50px;"></div>';
							
						}
			
					}
				}
				

			}
		}
		elseif($y=="1")
		{
			PluginFeatures("PAGE",pluginBinding("PLUGIN",pluginPages("UID",$a)));
			echo '<div style="position: relative; width: 100%; height: 50px; float: left; margin-bottom:50px; margin-top:50px;"></div>';
		}
		
		@mysqli_close($db);
	}
}
?>