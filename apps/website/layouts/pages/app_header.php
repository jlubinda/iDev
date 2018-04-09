<?php 
if(isset($_REQUEST["changeCurrency"]) && $_REQUEST["changeCurrency"]=="CHANGE TO USD")
{
	$_SESSION["currency"] = "USD";
}


if(isset($_REQUEST["changeCurrency"]) && $_REQUEST["changeCurrency"]=="CHANGE TO ZMW")
{
	$_SESSION["currency"] = "ZMW";
}

if(chkSes()=="Inactive")
{
	
}
else
{
	$userData = userData();
	$priv = priv();
}

$refs = explode("/",$_REQUEST["ref"]);
$refu = explode(".",$refs[0]);
$refx = $refu[0];
?>
<div class="navbar-fixed">
	<nav class="grey darken-3 nav-extended">
		<div class="nav-content">
			<p style="color:#fff; padding:5px;" align="right">Praesent rhoncus consectetur lacus id finibus <a href="<?php echo startListing();?>" class="amber darken-4 btn-Small btn ">Vestibulum Praesent</a></p>
		</div>
		<div class="nav-wrapper grey darken-4  z-depth-5">
		  <a href="./" class="brand-logo"><img src="apps/website/resources/images/logosmall.png"></a>
		  <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
		  <ul class="right hide-on-med-and-down">
					 
			 <li><a href="./">Home</a></li>
			 <li><a href="?ref=aboutus.html">About Us</a></li>
			<?php
			
			if(chkSes()=="Inactive")
			{
				?>
				<li><a href="?ref=login">Login</a></li>
				<li><a href="?ref=register">Register</a></li>
				<?php 
			}
			else
			{
				?>
				<li><a href="?ref=logout">Logout </a></li>
				<?php
			}
			?>
			<li><a href="?ref=contactus.php">Contact</a></li> 
			<li><a href="?ref=faqs.php">FAQS</a></li>
			<li><?php cartIcon(); ?></li>
		  </ul>
	  </nav>


</div>



		  <ul class="side-nav" id="slide-out">
			<li class="no-padding">
			  <ul class="collapsible collapsible-accordion">
			 <div class="row grey darken-3" align="center">
			  <?php
				if(chkSes()=="Inctive")
				{
					echo "<img class='circle left' src='apps/website/resources/images/logosmall.png' width='90' style='margin:10px;'> "; 
				  ?>
				  <span class="center white-text name"><b>iDev</b></span><br>
				  <span class="white-text name">Create great projects, the easily...</span>
				  <?php 
				}
				else
				{
					$user = userData();
					echo "<img class='circle left' src='apps/website/resources/images/logosmall.png' width='90' style='margin:10px;'> ";
				  ?>
				  <span class="center white-text name"><b>iDev</b></span><br>
				  <span class="white-text name">Create great projects, the easily...</span>
				  <?php 
				}
				
			  ?>
			  
			</div>
			 <li><a href="?ref=aboutus.html">About Us</a></li>
			<?php
			
			if(chkSes()=="Inactive")
			{
				?>
				<li><a href="?ref=login">Login</a></li>
				<li><a href="?ref=register">Register</a></li>
				<?php 
			}
			else
			{
				?><li><a href="?ref=logout">Logout </a></li>
				<?php
			}
			?>
			<li><a href="?ref=contactus.php">Contact</a></li> 
			<li><a href="?ref=faqs.php">FAQS</a></li>
			<li><?php cartIcon2(); ?></li>
			
			<li><form action='?ref=<?php echo $_REQUEST["ref"];?>' method='post'>
		<input name='ref' value='<?php echo $_REQUEST["ref"];?>' type='hidden'>
		<p>
			<label style= "font-size:11px; color:#000000 ;"><b>CURRENCY</b></label>
			<input type="button" id="currency" value="" style="background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;">
			<span id="currencyChangeForm"></span>
		</p>
		</form>
		</li>
		</ul>
		</li>
			 
	   </ul>


<br><br>
    <div class="hide-on-med-and-down">
  <div id='currency1' style="position:fixed; width:70px; top:180px; left:5px; z-index:999; background-color:transparent; border-radius:8px; padding:5px;">
	<form action='?ref=<?php echo $_REQUEST["ref"];?>' method='post'>
	<input name='ref' value='<?php echo $_REQUEST["ref"];?>' type='hidden'>
	<p>
		<label style= "font-size:11px; color:#000000 ;"><b>CURRENCY</b></label>
		<input type="button" id="currency2" value="" style="background-color:#FA1818; width:14px height:16px; font-size:11px; color:#fff; border-radius:5px;">
		<span id="currencyChangeForm2"></span>
	</p>
	</form>
  </div>
	</div>
  <?php cartDiv("390px");?>	
  
  <?php 
  
			if(chkSes()=="Active")
			{
  ?>
    <div class="right" style="z-index:102; position:fixed; top:180px; right:0px; width:300px; margin:0px; padding:0px;">
	<?php
		
		$int = 10;
		?>
		<a href="#" title="Your Profile" data-activates="nav-mobile" class="right button-collapse" style="position:relative; right:<?php echo $int;?>px;"> <?php echo "<img class='circle right' src='profilepics/".getProfilePicture($user["userID"])."' width='50'> "; ?></a>
		<a href="#" title="You Vehicles" data-activates="nav-vehicles" class="btn-floating blue right button-collapse top-nav full" style="position:relative; top:5px; right:<?php $int = dashboardIconSpacer(10,$int); echo $int;?>px;"> <i class="material-icons">directions_car</i></a>
		<?php
		if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
		{
		?>
		<a href="#" title="SMS Express" data-activates="nav-mail" class="btn-floating red right button-collapse" style="position:relative; top:5px; right:<?php $int = dashboardIconSpacer(10,$int); echo $int;?>px;"> <i class="material-icons">mail</i></a>
		<?php
		}
		/*?><a href="#" title="Your Organization" data-activates="nav-org" class="btn-floating green right button-collapse" style="position:relative; top:5px; right:<?php $int = dashboardIconSpacer(10,$int); echo $int;?>px;"> <i class="material-icons">business</i></a><?php */?>
		<?php
		if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
		{
		?>
		<a href="?ref=myadmin/" title="Admin Options" data-activates="nav-admin" class="btn-floating orange right button-collapse" style="position:relative; top:5px; right:<?php $int = dashboardIconSpacer(10,$int); echo $int;?>px;"> <i class="material-icons">settings</i></a>
		<?php 
		}
		?>
	</div>
    <!--
	<div class="fixed-action-btn">
	  <a class="btn-floating btn-large red">
		<i class="large material-icons">apps</i>
	  </a>
	  <ul>
		<li><a class="btn-floating red"><i class="material-icons">mail</i></a></li>
		<li><a class="btn-floating yellow darken-1"><i class="material-icons">directions_car</i></a></li>
		<li><a class="btn-floating green"><i class="material-icons">business</i></a></li>
		<li><a class="btn-floating blue"><i class="material-icons">settings</i></a></li>
	  </ul>
	</div>
	-->
	  <ul id="nav-mobile" class="side-nav ">
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
			 <div class="row grey darken-3" align="center">
			  <?php echo "<img class='circle left' src='profilepics/".getProfilePicture($user["userID"])."' width='90' style='margin:10px;'> "; ?>
			  <a href="#!name"><span class="white-text name"> <?php echo $user["FirstName"];?> <?php echo $user["LastName"];?></span></a><br>
			  <span class="center white-text name"><b>YOUR PROFILE</b></span>
			</div>
			<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/" style="">&nbsp;&nbsp;<i class="fa fa-home fa-fw"></i>&nbsp;You Details</a></li>
			<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/edit_profile.php" style="">&nbsp;&nbsp;<i class="fa fa-pencil fa-fw"></i>&nbsp;Edit Details</a></li>
			<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/password_change.php" style="">&nbsp;&nbsp;<i class="fa fa-unlock fa-fw"></i>&nbsp;Change Password</a></li>
			<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/profile_picture.php" style="">&nbsp;&nbsp;<i class="fa fa-photo fa-fw"></i>&nbsp;Profile Picture</a></li>
			<!--<li><a href="?ref=<?php //echo iDevSite("DASHBOARD URL");?>/cover_image.php" style="">&nbsp;&nbsp;<i class="fa fa-file-photo-o fa-fw"></i>&nbsp;Cover Photo</a></li>-->
          </ul>
        </li>
      </ul>
	  
	  <ul id="nav-org" class="side-nav ">
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
			 <div class="row grey darken-3" align="center">
			  <?php echo "<img class='circle left' src='profilepics/".getProfilePicture($user["userID"])."' width='90' style='margin:10px;'> "; ?>
			  <a href="#!name"><span class="white-text name"> <?php echo $user["FirstName"];?> <?php echo $user["LastName"];?></span></a><br>
			  
			  <span class="center white-text name"><b>YOUR ORGANIZATION</b></span>
			</div>
			<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/" style="">&nbsp;&nbsp;<i class="fa fa-home fa-fw"></i>&nbsp;You Details</a></li>
			<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/edit_profile.php" style="">&nbsp;&nbsp;<i class="fa fa-pencil fa-fw"></i>&nbsp;Edit Details</a></li>
			<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/password_change.php" style="">&nbsp;&nbsp;<i class="fa fa-unlock fa-fw"></i>&nbsp;Change Password</a></li>
			<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/profile_picture.php" style="">&nbsp;&nbsp;<i class="fa fa-photo fa-fw"></i>&nbsp;Profile Picture</a></li>
			<!--<li><a href="?ref=<?php // echo iDevSite("DASHBOARD URL");?>/cover_image.php" style="">&nbsp;&nbsp;<i class="fa fa-file-photo-o fa-fw"></i>&nbsp;Cover Photo</a></li>-->
          </ul>
        </li>
      </ul>
	  
	  <ul id="nav-vehicles" class="side-nav ">
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
		 <div class="row grey darken-3" align="center">
		  <?php echo "<img class='circle left' src='profilepics/".getProfilePicture($user["userID"])."' width='90' style='margin:10px;'> "; ?>
		  <a href="#!name"><span class="white-text name"> <?php echo $user["FirstName"];?> <?php echo $user["LastName"];?></span></a><br>

		  <span class="center white-text name"><b>YOUR SAMPLE SECTION</b></span>
		</div>
		<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/test1.php" style="">&nbsp;&nbsp;<i class="fa fa-home fa-fw"></i>&nbsp;Your Test 1</a></li>
		<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/test2.php" style="">&nbsp;&nbsp;<i class="fa fa-home fa-fw"></i>&nbsp;Your Test 2</a></li>
		<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/test2.php" style="">&nbsp;&nbsp;<i class="fa fa-home fa-fw"></i>&nbsp;Your Test 3</a></li>
		<li><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/test3.php" style="">&nbsp;&nbsp;<i class="fa fa-home fa-fw"></i>&nbsp;Your Test 4</a></li>	
          </ul>
        </li>
      </ul>
	  
	<ul id="nav-admin" class="side-nav ">
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
			 <div class="row grey darken-3" align="center">
			  <?php echo "<img class='circle left' src='profilepics/".getProfilePicture($user["userID"])."' width='90' style='margin:10px;'> "; ?>
			  <a href="#!name"><span class="white-text name"> <?php echo $user["FirstName"];?> <?php echo $user["LastName"];?></span></a><br>
			  <!--<a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>-->
			  <span class="center white-text name"><b>ADMIN OPTIONS</b></span>
			</div>
			<?php
		if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
		{
		?>
		<li><a href="?ref=myadmin/jobs.php">Jobs</a></li>
		<li><a href="?ref=myadmin/privacy.php">Privacy</a></li>
		<li><a href="?ref=myadmin/terms.php">Rental Terms</a></li>
		<!--<li><a href="?ref=myadmin/password_reset.php">User Password Reset</a></li>-->
		<?php 
		}
		?>
          </ul>
        </li>
      </ul>
	  
	  
	  <ul id="nav-mail" class="side-nav ">
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
			 <div class="row grey darken-3" align="center">
			  <?php echo "<img class='circle left' src='profilepics/".getProfilePicture($user["userID"])."' width='90' style='margin:10px;'> "; ?>
			  <a href="#!name"><span class="white-text name"> <?php echo $user["FirstName"];?> <?php echo $user["LastName"];?></span></a><br>
			  
			  <span class="center white-text name"><b>SMS EXPRESS</b></span>
			</div>
			<?php
			if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
			{
			?>
			  <!--<li><a href="buttons.html">Inbox</a></li>-->
			  <li><a href="?ref=sms/sendSingle.php">Send Single</a></li>
			  <li><a href="?ref=sms/sendBulk.php">Send Bulk</a></li>
			  <li><a href="?ref=sms/checkBalance.php">Check Balance</a></li>
			  <li><a href="?ref=sms/statistics.php">Statistics</a></li>
			  <li><a href="?ref=sms/loadCredit.php">Load Credit</a></li>
		    <?php 
			}
		    ?>
          </ul>
        </li>
      </ul>
	  <?php 
	  }
	  ?>
