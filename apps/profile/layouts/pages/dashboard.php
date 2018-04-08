<?php
	if(chkSes()=="Active")
	{
		$px = explode("/",$_REQUEST["ref"]);
		
		
		if($px[1]=="")
		{
			if($_REQUEST["unit"]=="")
			{
				include find_file("dashboard/profile/generalinfo.php");
			}
			elseif($_REQUEST["unit"]=="2")
			{
				include find_file("dashboard/profile/your_profile.php");
			}
			elseif($_REQUEST["unit"]=="2")
			{
				include find_file("dashboard/profile/edit_profile.php");
			}
			elseif($_REQUEST["unit"]=="3")
			{
				include find_file("dashboard/profile/profile_picture.php");
			}
			elseif($_REQUEST["unit"]=="4")
			{
				include find_file("dashboard/profile/password_change.php");
			}
			elseif($_REQUEST["unit"]=="5")
			{
				include find_file("dashboard/profile/cover_image.php");
			}
		}
		elseif($px[1]=="yourshop.php")
		{
			if($_REQUEST["unit"]=="")
			{
				include find_file("dashboard/yourshop/home.php");
			}
			elseif($_REQUEST["unit"]=="2")
			{
				include find_file("dashboard/yourshop/manage.php");
			}
			elseif($_REQUEST["unit"]=="3")
			{
				include find_file("dashboard/yourshop/statistics.php");
			}
			elseif($_REQUEST["unit"]=="4")
			{
				include find_file("dashboard/yourshop/infocenter.php");
			}
			elseif($_REQUEST["unit"]=="5")
			{
				include find_file("dashboard/yourshop/join.php");
			}
		}
		elseif($px[1]=="favouriteshops.php")
		{
			if($_REQUEST["unit"]=="")
			{
				include find_file("dashboard/favouriteshops/home.php");
			}
			elseif($_REQUEST["unit"]=="2")
			{
				include find_file("dashboard/favouriteshops/manage.php");
			}
			elseif($_REQUEST["unit"]=="3")
			{
				include find_file("dashboard/favouriteshops/statistics.php");
			}
			elseif($_REQUEST["unit"]=="4")
			{
				include find_file("dashboard/favouriteshops/infocenter.php");
			}
			elseif($_REQUEST["unit"]=="5")
			{
				include find_file("dashboard/favouriteshops/join.php");
			}
		}
		elseif($px[1]=="youragencyportal.php")
		{
			
			$user = userData();
			$userID = $user["userID"];
		
			if(checkAcceptedAgencyTerms($userID)>=1)
			{
				if($_REQUEST["unit"]=="")
				{
					include find_file("dashboard/youragencyportal/home.php");
				}
				elseif($_REQUEST["unit"]=="2")
				{
					include find_file("dashboard/youragencyportal/manage.php");
				}
				elseif($_REQUEST["unit"]=="3")
				{
					include find_file("dashboard/youragencyportal/statistics.php");
				}
				elseif($_REQUEST["unit"]=="4")
				{
					//include find_file("dashboard/youragencyportal/join.php");
				}
				elseif($_REQUEST["unit"]=="5")
				{
					include find_file("dashboard/youragencyportal/infocenter.php");
				}
			}
			else
			{
				include find_file("dashboard/youragencyportal/join.php");
			}
		}
		elseif($px[1]=="yourcompanies.php")
		{
			if($_REQUEST["unit"]=="")
			{
				include find_file("dashboard/yourcompanies/home.php");
			}
			elseif($_REQUEST["unit"]=="1")
			{
				include find_file("dashboard/yourcompanies/manage.php");
			}
			elseif($_REQUEST["unit"]=="2")
			{
				include find_file("dashboard/yourcompanies/statistics.php");
			}
			elseif($_REQUEST["unit"]=="3")
			{
				include find_file("dashboard/yourcompanies/infocenter.php");
			}
			elseif($_REQUEST["unit"]=="4")
			{
				include find_file("dashboard/yourcompanies/join.php");
			}
		}
		elseif($px[1]=="favouritecompanies.php")
		{
			if($_REQUEST["unit"]=="")
			{
				include find_file("dashboard/favouritecompanies/home.php");
			}
			elseif($_REQUEST["unit"]=="2")
			{
				include find_file("dashboard/favouritecompanies/manage.php");
			}
			elseif($_REQUEST["unit"]=="3")
			{
				include find_file("dashboard/favouritecompanies/statistics.php");
			}
			elseif($_REQUEST["unit"]=="4")
			{
				include find_file("dashboard/favouritecompanies/infocenter.php");
			}
			elseif($_REQUEST["unit"]=="5")
			{
				include find_file("dashboard/favouritecompanies/join.php");
			}
		}
		elseif($px[1]=="yourwallet.php")
		{
			if($_REQUEST["unit"]=="")
			{
				include find_file("dashboard/yourwallet/home.php");
			}
			elseif($_REQUEST["unit"]=="2")
			{
				include find_file("dashboard/yourwallet/manage.php");
			}
			elseif($_REQUEST["unit"]=="3")
			{
				include find_file("dashboard/yourwallet/statistics.php");
			}
			elseif($_REQUEST["unit"]=="4")
			{
				include find_file("dashboard/yourwallet/infocenter.php");
			}
			elseif($_REQUEST["unit"]=="5")
			{
				include find_file("dashboard/yourwallet/join.php");
			}
		}
	}
	else
	{
		include find_file("login.php");
	}
?>