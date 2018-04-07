<?php
if(chkSes()=="Inactive")
{


if(isset ($_POST['login']) && ($_POST['login'] == 'Login'))
{
	//check_auth("USER_PASS",$_POST['searchterm'],"MD5","USER_ID",$_POST['users'],"users")
	
	$uidx = check_auth();
	$uid = $uidx[0];
	$lockout = $uidx[1];
	$activeSess = $uidx[2];
	$maxtime = $uidx[3];
	$vCode = $uidx[4];
	
	//print_r($uidx);
	
	//echo "test: ".$lockout."<br>";

	/** Validate captcha 
	if (!empty($_REQUEST['captcha'])) 
	{
		if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) 
		{
			$captcha_message = "Invalid captcha";
			$style = "background-color: #FF606C";
		}
		else
		{
			$captcha_message = "Valid captcha";
			$style = "background-color: #CCFF99";
		}
		
		$request_captcha = htmlspecialchars($_REQUEST['captcha']);
		unset($_SESSION['captcha']);
	}
*/
	$statusMsg = "";

	if($activeSess=="-1")
	{
	$statusMsg .= "<p align='center'>Sorry. Wrong Log-In Details. Try again using correct details or <a href='?ref=recover'>click here for password recovery.</a></p>";
	}

	//if($_REQUEST['captcha']=="")
	//{
	//$statusMsg .= "<p align='center'>You have left the captcha field empty. Try again using correct details</p>";
	//}

	//if($captcha_message=="Invalid captcha")
	//{
	//$statusMsg .= "<p align='center'>Sorry. Wrong captcha. Try again using correct details.</a></p>";
	//}

	if($activeSess=="0" || $activeSess=="")
	{
	$statusMsg .= "<p align='center'>Sorry. Your session could not be started. Please try again later.</p>";
	}

	if($lockout=="1")
	{
	$statusMsg .= "<p align='center'>You currently have an active session running. <a class='button' href='?ref=resolve&vCode=".$vCode."'>CLICK HERE</a> to end it and log in again.</p>";
	}

	if($_POST["firsttimelogin"])
	{
		$ftlarray = createAccount("Administrator Superuser","MAIL AND SHOW PASSWORD",$_POST["adminEmail"],"","FIRST TIME LOGIN");
		
		if($ftlarray['status']=="Account Created")
		{
			$statusMsg .= "<p align='center'>You have successfully configured your database. Now login as the Super User using the following details<br><b>Username:</b> 'com.admin' <br><b>Password:</b> ".$ftlarray['password']."</p>";
		}
		else
		{
			$statusMsg .= "<p align='center'>You have successfully configured your database. Now login as the Super User using the following details<br><b>Username:</b> 'com.admin' <br><b>Password:</b> ".$ftlarray['password']."</p>";
		}			
	}
}

echo $statusMsg;
			
	if ($_POST['login'] == 'Login' && ($activeSess=="1")/* && $captcha_message=="Valid captcha"*/ )
	{
		/* User successfully logged in, setting cookie */
		
		 
		if($_REQUEST["ref"]=="login")
		{
			//$URLx = "?ref=".iDevSite("DASHBOARD URL");  
			
			if($_POST['u_type']==strtolower(iDevSite("DASHBOARD URL")))
			{
				$URLx = "?ref=".iDevSite("DASHBOARD URL");  
			}
			elseif($_POST['u_type']==strtolower(iDevSite("STORE URL")))
			{
				$URLx = "?ref=".iDevSite("STORE URL").".php"; 
			}
			else
			{
				$URLx = "?ref=".iDevSite("STORE URL").".php"; 
			}
		}
		else
		{
			$URLx = "?ref=".$_REQUEST["ref"];
		}
		$URL="./".$URLx;
		echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
		echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
		?>

		<?php
	}
	else 
	{
?>
<!-- login -->

<div class="container">
	
	<div class="row">
		<div class="col s12 m10 offset-m1 l9 offset-l1">	

			
	 <div class="section"></div>
  <main>
    <center>
     
      <div class="section"></div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" method="post" action="?ref=<?php echo $_REQUEST["ref"];?>">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='Username' id='email' />
                <label for='email'>Enter your email</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='Password' id='password' />
                <label for='password'>Enter your password</label>
              </div>
              <label style='float: right;'>
								<a class='pink-text' href='?ref=recover'><b>Forgot Password?</b></a>
							</label>
            </div>

            <br />
            <center>
              <div class='row'>
				<input class="waves-effect waves-light btn" type="submit" value="Login" name="login">
				<a href="?ref=register" class="waves-effect waves-light btn">Create Account</a>
              </div>
            </center>
          </form>
        </div>
      </div>
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>	
			
		</div>
	</div>
</div>
<!-- //login -->
<?php
	}
}
else
{
//header("Location:  $link/a_index.php");
}
?>