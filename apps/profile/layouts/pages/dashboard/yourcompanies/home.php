<?php

	if(chkSes()=="Active")
	{
		$user = userData();
		
		//('userID'=>$userID,'AccountType'=>$AccountType,'UserCode'=>$UserCode,'org'=>$org,'Branch'=>$Branch,'Email'=>$Email,'LoginName'=>$LoginName,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'Password'=>$_idxZx,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Active'=>$Active,'QuasAdmin'=>$QuasAdmin,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'level'=>$level,'Country'=>$userCountry,'productImage'=>$productImage,'sex'=>$sex,'DOB'=>$DOB,
		//'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
		
	?>

    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">YOUR COMPANIES</h3>
			</div>
		</div>
        <div class="row">
			<div class="col-lg-12"><?php
				$catsx = listOrgsForUser($user["userID"]);
				
				// check for empty result
				for($ax=0; $ax<$catsx[0]['num']; $ax++)
				{
					$orgID = orgID($catsx[$ax]["vCode"]);
					$orgArray = orgData($orgID);
					$orgName = $orgArray["name"];
					
					if($_REQUEST["vCode"]==$catsx[$ax]["vCode"])
					{
						$cssStyle = " font-weight: bold; color:#000;";
					}
					else
					{
						$cssStyle = "";
					}
					
					if(($catsx[0]['num']-1)==$ax)
					{
						$termin = "";
					}
					else
					{
						$termin = "";
					}
					?>
					<li><a href="?ref=profile/companiesinfocenter.php&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $catsx[$ax]["vCode"];?>" style="  margin:5px; font-size:11px; <?php echo $cssStyle;?>"><?php echo $orgName."".$termin;?></a></li>
					<?php
				}
			?>
				</div>
			</div>
		</div>
		<?php
	}
	else
	{
		include find_file("login.php");
	}
?>