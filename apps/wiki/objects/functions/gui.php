<?php 
function dashboardNav($pagex){
	
	if($pagex=="")
	{
		include find_file("layouts/navigators/profilenav.php");
	}
	elseif($pagex=="yourshop.php")
	{
		include find_file("layouts/navigators/accountnav.php");
	}
	elseif($pagex=="yourwallet.php")
	{
		include find_file("layouts/navigators/walletnav.php");
	}
	elseif($pagex=="youragencyportal.php")
	{
		include find_file("layouts/navigators/agencyportalnav.php");
	}
	elseif($pagex=="yourcompanies.php")
	{
		include find_file("layouts/navigators/companynav.php");
	}
	elseif($pagex=="checkout.php")
	{
		include find_file("layouts/navigators/uagrocheckoutnav.php");
	}
}


function acceptAgentTerm($userID){
	
	$version = getTerms("ID","AGENT");
	
	$_REQUEST["cnct"] = "cnct.php";
	return addMeta("ACCEPT AGENCY TERMS",$userID,$version,"","","","");
}


function checkAcceptedAgencyTerms($customer){
	
	$version = getTerms("ID","AGENT");
	
	$_REQUEST["cnct"] = "cnct.php";
	$result = getMeta("ACCEPT AGENCY TERMS","","=|'".$customer."'","=|'".$version."'","","","","",",count(id) AS misc1");
	
	return $result[0]['misc1'];
}


function headerTitle(){
	$ref = explode(".",$_REQUEST["ref"]);
	$ref2 = explode("/",$ref[0]);
	
	if($ref2[0]=="")
	{
		if(chkSes()=="Active")
		{
			return "HOME";
		}
		else
		{
			return "";
		}
	}
	else
	{
		if($ref2[0]==iDevSite("STORE URL"))
		{
			if(chkSes()=="Active")
			{
				return strtoupper(iDevSite("STORE URL"));
			}
			else
			{
				return "";
			}
		}
		else
		{
			if($ref2[0]=="agents")
			{
				if(chkSes()=="Active")
				{
					return "AGENTS";
				}
				else
				{
					return "";
				}
			}
			else
			{
				if($ref2[0]=="ourstory")
				{
					if(chkSes()=="Active")
					{
						return "OUR STORY";
					}
					else
					{
						return "";
					}
				}
				else
				{
					if($ref2[0]=="corporates" && $ref2[1]=="")
					{
						if(chkSes()=="Active")
						{
							return "CORPORATES";
						}
						else
						{
							return "";
						}
					}
					elseif($ref2[0]=="corporates" && !($ref2[1]==""))
					{
						if(chkSes()=="Active")
						{
							return strtoupper(getOrgName(getOrgVCode($ref2[1])));
						}
						else
						{
							return "";
						}
					}
					elseif($ref2[0]=="shops" && ($ref2[1]==""))
					{
						if(chkSes()=="Active")
						{
							return "SHOPS";
						}
						else
						{
							return "";
						}
					}
					elseif($ref2[0]=="shops" && !($ref2[1]==""))
					{
						$userXX = $ref2[1];
						
						if(chkSes()=="Active")
						{
							return strtoupper(getNames($userXX)."'S SHOP");
						}
						else
						{
							return "";
						}
					}
					else
					{
						if($ref2[0]==iDevSite("DASHBOARD URL"))
						{
							if($ref2[1]=="")
							{
								if(chkSes()=="Active")
								{
									return "YOUR PROFILE";
								}
								else
								{
									return "";
								}
							}
							elseif($ref2[1]=="yourshop")
							{
								if(chkSes()=="Active")
								{
									return "YOUR SHOP";
								}
								else
								{
									return "";
								}
							}
							elseif($ref2[1]=="youragencyportal")
							{
								if(chkSes()=="Active")
								{
									return "YOUR AGENCY PORTAL";
								}
								else
								{
									return "";
								}
							}
							elseif($ref2[1]=="yourwallet")
							{
								if(chkSes()=="Active")
								{
									return "YOUR WALLET";
								}
								else
								{
									return "";
								}
							}
							elseif($ref2[1]=="yourcompanies")
							{
								if($_REQUEST["vCode"]=="")
								{
									if(chkSes()=="Active")
									{
										return "YOUR COMPANIES";
									}
									else
									{
										return "";
									}
								}
								else
								{
									if(chkSes()=="Active")
									{
										return strtoupper(getOrgName($_REQUEST["vCode"]));
									}
									else
									{
										return "";
									}
								}
							}
						}
						else
						{
							if($ref2[0]=="admin")
							{
								if(chkSes()=="Active")
								{
									return "ADMINISTRATION";
								}
								else
								{
									return "";
								}
							}
							else
							{
								return "";
							}
						}
					}
				}
			}
		}
	}
}


function uagroDashboard(){
	include find_file("layouts/pages/dashboard.php");
}


function mylikedPages(){
	if(chkSes()=="Active")
	{
		$user = userData();
		$userID = $user["userID"];
		$prods = listShopLikes($userID);
		if($prods[0]['num']>=1)
		{
		?>
		<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" style=" margin:5px; font-size:12px; font-weight:normal;">SHOPS YOU LIKE<span class="caret"></span></a>
			<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
				<div class="w3ls_vegetables">
					<ul id="shops_liked">		
					<?php
					
					$y = "shops";
					if($prods[0]['num']>=1)
					{ 
					// check for empty result
						for($ap=0; $ap<$prods[0]['num']; $ap++)
						{
							?>
							<li><a href="?ref=<?php echo $y; ?>/<?php echo $prods[$ap]["vCode"];?>/" style=" margin:5px; font-size:11px;"><?php echo strtoupper($prods[$ap]["name"]);?>'S SHOP</a></li>
							<?php
						}
					}
					?>
					</ul>
				</div>                  
			</div>	
		</li>
		<?php 
		}
			
			
		$prods2 = listCorpLikes($userID);
		if($prods2[0]['num']>=1)
		{
		?>
		<li class="dropdown">	
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" style=" margin:5px; font-size:12px; font-weight:normal;">CORPORATES YOU LIKE<span class="caret"></span></a>
			<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
				<div class="w3ls_vegetables">
					<ul id="corps_liked">		
					<?php 
					
					$y2 = "corporates";
					if($prods2[0]['num']>=1)
					{ 
					// check for empty result
						for($ap2=0; $ap2<$prods2[0]['num']; $ap2++)
						{
							?>
							<li><a href="?ref=<?php echo $y2; ?>/<?php echo strtolower($prods2[$ap2]["shortname"]);?>/" style=" margin:5px; font-size:11px;"><?php echo strtoupper($prods2[$ap2]["name"]);?></a></li>
							<?php
						}
					}
					?>
					</ul>
				</div>                  
			</div>	
		</li>
		<?php
		}
	}
}


function uagroStore(){
	include find_file("layouts/pages/uagro_store.php");
}


function usgroPages(){
	
	$pagex = explode("/",$_REQUEST["ref"]);
	
	if($pagex[0]=="")
	{
		include find_file("themes/".themeurl()."/homepage.php");
	}
	elseif($pagex[0]=="corporates.php" || $pagex[0]=="corporates")
	{
		include find_file("layouts/pages/corporates.php");
	}
	elseif($pagex[0]=="shops.php" || $pagex[0]=="shops")
	{
		include find_file("layouts/pages/shops.php");
	}
	elseif($pagex[0]=="ourstory.php" || $pagex[0]=="ourstory")
	{
		include find_file("layouts/pages/ourstory.php");
	}
	elseif($pagex[0]=="agents.php" || $pagex[0]=="agents")
	{
		include find_file("layouts/pages/agents.php");
	}
	elseif($pagex[0]=="checkout.php" || $pagex[0]=="checkout")
	{
		include find_file("layouts/pages/uagrocheckout.php");
	}
	elseif($pagex[0]=="terms.php" || $pagex[0]=="terms")
	{
		include find_file("layouts/pages/terms.php");
	}
	elseif($pagex[0]=="privacy.php" || $pagex[0]=="privacy")
	{
		include find_file("layouts/pages/privacy.php");
	}
	elseif($pagex[0]==iDevSite("STORE URL") || $pagex[0]==iDevSite("STORE URL").".php")
	{
		uagroStore();
	}
	elseif($pagex[0]==iDevSite("DASHBOARD URL") || $pagex[0]==iDevSite("DASHBOARD URL").".php")
	{
		uagroDashboard();
	}
	else
	{
		pages($_REQUEST["ref"],$_REQUEST["extn"]);
	}
}

 
function currentDashboardSegment($pagex){
	
	if($pagex=="")
	{
		return "Your Profile";
	}
	elseif($pagex=="yourshop.php")
	{
		return "Your Shop";
	}
	elseif($pagex=="yourwallet.php")
	{
		return "Your Wallet";
	}
	elseif($pagex=="youragencyportal.php")
	{
		return "Your Agency Portal";
	}
	elseif($pagex=="yourcompanies.php")
	{
		return "Your Companies";
	}
	elseif($pagex=="checkout.php")
	{
		return "CHECKOUT";
	}
}


function uagroAboutUsPage(){
	include find_file("layouts/pages/ourstory.php");
}

function uagroCorporates(){
	include find_file("layouts/pages/corporates.php");
}

function uagroCheckout(){
	include find_file("layouts/pages/uagrocheckout.php");
}

function uagroAgents(){
	
}

function uagroShops(){
	
}

function displayProductClasses(){
	
	$pagex = explode("/",$_REQUEST["ref"]);
	
	if($pagex[0]=="" || $pagex[0]=="store" || $pagex[0]=="store.php")
	{
		$x=1;
	}
	else
	{
		if($_GET["class"]=="")
		{
			$x=0;
		}
		else
		{
			$x=1;
		}
	}
	
	return $x;
}

function uagroSideBar(){
	
	$pagex = explode("/",$_REQUEST["ref"]);
	
	if($pagex[0]=="" || $pagex[0]==iDevSite("STORE URL") || $pagex[0]==(iDevSite("STORE URL").".php"))
	{
		$x="CATEGORIES";
		$y=$_REQUEST["ref"];
	}
	else
	{
		$x="CATEGORIES AND CLASSES";
		
		if($pagex[0]=="shops" || $pagex[0]=="shops.php" || $pagex[0]=="corporates" || $pagex[0]=="corporates.php")
		{
			if($pagex[0]=="shops" || $pagex[0]=="shops.php")
			{
				if($pagex[1]=="")
				{
					$rtyp = "PEOPLE SELLING";
					$rtyp2 = "";
				}
				else
				{
					$rtyp = "BUY";
					$rtyp2 = "NOW";
				}
			}
			elseif($pagex[0]=="corporates" || $pagex[0]=="corporates.php")
			{
				if($pagex[1]=="")
				{
					$rtyp = "CORPORATES SELLING";
					$rtyp2 = "";
				}
				else
				{
					$rtyp = "BUY";
					$rtyp2 = "NOW";
				}
			}
			$y=$_REQUEST["ref"];
		}
		else
		{
			$y=iDevSite("STORE URL").".php";
		}
	}
	
	if($x=="CATEGORIES")
	{				
		$prods = listProductCategory($_REQUEST["class"]);
			
		if($prods[0]['num']>=1)
		{ 
		// check for empty result
			for($ap=0; $ap<$prods[0]['num']; $ap++)
			{
				if($_REQUEST["category"]==$prods[$ap]["name"])
				{
					$cssStyle2 = " font-weight: bold; color:#000;";
				}
				else
				{
					$cssStyle2 = "";
				}
				?>
				<li><a href="?ref=<?php echo iDevSite("STORE URL");?>.php&class=<?php echo $_REQUEST["class"];?>&category=<?php echo $prods[$ap]["name"];?>&vCode=<?php echo $_REQUEST["vCode"];?>" style=" margin:5px; font-size:11px; <?php echo $cssStyle2;?>">BUY <?php echo strtoupper($prods[$ap]["name"]);?> NOW</a></li>
				<?php
			}
		}
	}
	elseif($x=="CATEGORIES AND CLASSES")
	{	
		if($_GET["class"]=="")
		{
			//echo "X: ".$x."<br>";
			$catsx = listClassifications();
			
			// check for empty result
			for($ax=0; $ax<$catsx[0]['num']; $ax++)
			{
				if($_REQUEST["class"]==$catsx[$ax]["name"])
				{
					$cssStyle = " font-weight: bold; color:#000;";
				}
				else
				{
					$cssStyle = "";
				}
				?>
				<li><a href="?ref=<?php echo $y; ?>&class=<?php echo $catsx[$ax]["name"];?>&vCode=<?php echo $_REQUEST["vCode"];?>" style="  margin:5px; font-size:11px; <?php echo $cssStyle;?>"><?php echo $catsx[$ax]["name"];?></a></li>
				<?php
			}
		}
		else
		{
			$prods = listProductCategory($_REQUEST["class"]);
				
			if($prods[0]['num']>=1)
			{ 
			// check for empty result
				for($ap=0; $ap<$prods[0]['num']; $ap++)
				{
					if($_REQUEST["category"]==$prods[$ap]["name"])
					{
						$cssStyle2 = " font-weight: bold; color:#000;";
					}
					else
					{
						$cssStyle2 = "";
					}
					?>
					<li><a href="?ref=<?php echo $y; ?>&class=<?php echo $_REQUEST["class"];?>&category=<?php echo $prods[$ap]["name"];?>&vCode=<?php echo $_REQUEST["vCode"];?>" style=" margin:5px; font-size:11px; <?php echo $cssStyle2;?>"><?php echo strtoupper($rtyp." ".$prods[$ap]["name"]." ".$rtyp2);?></a></li>
					<?php
				}
			}
		}
	}
}
?>