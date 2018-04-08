			<div style="width:98%; background-color:#e0e0e0; padding:5px;">
			<?php 
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
					<a href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $catsx[$ax]["vCode"];?>" style="  margin:5px; font-size:11px; <?php echo $cssStyle;?>"><?php echo $orgName."".$termin;?></a>
					<?php
				}
				
				//echo "</ul>";
				?>
			</div>
			<?php 
			if($catsx[0]['num']>=1)
			{
			?>
			<div style="float:left; width:98%; padding:5px;font-size:11px;">
				<?php
				if($_REQUEST["id"]=="")
				{
					$stry1 = "background-color:#84C639; font-weight:bold; color:#fff;";
					$stry2 = "background-color:#e0e0e0; ";
					$stry3 = "background-color:#e0e0e0; ";
					$stry4 = "background-color:#e0e0e0; ";
					$stry5 = "background-color:#e0e0e0; ";
					$stry6 = "background-color:#e0e0e0; ";
					$stry7 = "background-color:#e0e0e0; ";
				}
				elseif($_REQUEST["id"]=="1")
				{
					$stry1 = "background-color:#e0e0e0; ";
					$stry2 = "background-color:#84C639; font-weight:bold; color:#fff;";
					$stry3 = "background-color:#e0e0e0; ";
					$stry4 = "background-color:#e0e0e0; ";
					$stry5 = "background-color:#e0e0e0; ";
					$stry6 = "background-color:#e0e0e0; ";
					$stry7 = "background-color:#e0e0e0; ";
				}
				elseif($_REQUEST["id"]=="2")
				{
					$stry1 = "background-color:#e0e0e0; ";
					$stry2 = "background-color:#e0e0e0; ";
					$stry3 = "background-color:#84C639; font-weight:bold; color:#fff;";
					$stry4 = "background-color:#e0e0e0; ";
					$stry5 = "background-color:#e0e0e0; ";
					$stry6 = "background-color:#e0e0e0; ";
					$stry7 = "background-color:#e0e0e0; ";
				}
				elseif($_REQUEST["id"]=="3")
				{
					$stry1 = " background-color:#e0e0e0;";
					$stry2 = " background-color:#e0e0e0;";
					$stry3 = " background-color:#e0e0e0;";
					$stry4 = " background-color:#84C639; font-weight:bold; color:#fff;";
					$stry5 = " background-color:#e0e0e0;";
					$stry6 = "background-color:#e0e0e0; ";
					$stry7 = "background-color:#e0e0e0; ";
				}
				elseif($_REQUEST["id"]=="4" || $_REQUEST["id"]=="7" || $_REQUEST["id"]=="8")
				{
					$stry1 = " background-color:#e0e0e0;";
					$stry2 = " background-color:#e0e0e0;";
					$stry3 = " background-color:#e0e0e0;";
					$stry4 = " background-color:#e0e0e0;";
					$stry5 = " background-color:#84C639; font-weight:bold; color:#fff;";
					$stry6 = "background-color:#e0e0e0; ";
					$stry7 = "background-color:#e0e0e0; ";
				}
				elseif($_REQUEST["id"]=="5")
				{
					$stry1 = " background-color:#e0e0e0;";
					$stry2 = " background-color:#e0e0e0;";
					$stry3 = " background-color:#e0e0e0;";
					$stry4 = " background-color:#e0e0e0;";
					$stry5 = "background-color:#e0e0e0; ";
					$stry6 = " background-color:#84C639; font-weight:bold; color:#fff;";
					$stry7 = "background-color:#e0e0e0; ";
				}
				elseif($_REQUEST["id"]=="6")
				{
					$stry1 = " background-color:#e0e0e0;";
					$stry2 = " background-color:#e0e0e0;";
					$stry3 = " background-color:#e0e0e0;";
					$stry4 = " background-color:#e0e0e0;";
					$stry5 = "background-color:#e0e0e0; ";
					$stry6 = "background-color:#e0e0e0; ";
					$stry7 = " background-color:#84C639; font-weight:bold; color:#fff;";
				}
				?>
				<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id="><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stry1; ?>">MANAGE STOCK</span></a>
				<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=4"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stry5; ?>">CASHBOX</span></a>
				<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=5"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stry6; ?>">LOGO</span></a>
				<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=6"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stry7; ?>">COVER IMAGE</span></a>
				<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=2"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stry3; ?>">EDIT DETAILS</span></a>
				<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=1"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stry2; ?>">ADD PERSONNEL</span></a>
				<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=1"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stry2; ?>">SETTINGS</span></a>
				<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=3"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stry4; ?>">STATUS</span></a>
			</div>
			<?php 
				if($_REQUEST["id"]=="4" || $_REQUEST["id"]=="7" || $_REQUEST["id"]=="8")
				{
					?>
					<div style="float:left; width:98%; padding:5px;font-size:11px;">
						<?php
						if($_REQUEST["id"]=="4")
						{
							$stryx1 = "background-color:#84C639; font-weight:bold; color:#fff;";
							$stryx2 = "background-color:#e0e0e0; ";
							$stryx3 = "background-color:#e0e0e0; ";
						}
						elseif($_REQUEST["id"]=="7")
						{
							$stryx1 = "background-color:#e0e0e0; ";
							$stryx2 = "background-color:#84C639; font-weight:bold; color:#fff;";
							$stryx3 = "background-color:#e0e0e0; ";
						}
						elseif($_REQUEST["id"]=="8")
						{
							$stryx1 = "background-color:#e0e0e0; ";
							$stryx2 = "background-color:#e0e0e0; ";
							$stryx3 = "background-color:#84C639; font-weight:bold; color:#fff;";
						}
						?>
						<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=4"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stryx1; ?>">BALANCE INQUIRY</span></a>
						<a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=7"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stryx2; ?>">PAYOUT</span></a>
						<?php /*?><a class="agile_about_grids" href="?ref=<?php echo $_REQUEST["ref"]; ?>&unit=<?php echo $_REQUEST["unit"];?>&class=<?php echo $_REQUEST["class"];?>&vCode=<?php echo $_REQUEST["vCode"];?>&id=8"><span style="float: left; padding:10px; margin:5px; border-radius:5px; <?php echo $stryx3; ?>">NOTICES</span></a><?php */?>
					</div>
					<?php
				}
			}
			?>