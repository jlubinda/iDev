<?php 

if(function_exists('password_access'))
{
	
}
else
{
	function password_access($a){
		include find_file("cnct.php");
		$class = md5("User Class");
		$sel = "SELECT * FROM meta WHERE userid = '".$class."' AND data = '".(md5($a))."';";
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows(@$res);
		
		if($num>="1")
		{
		return "Yes";
		}
		else
		{
		return "No";
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('privacy'))
{
	
}
else
{
	function privacy($a,$b=""){

		if($a=="Free|Open")
		{
			return "Granted";
		}
		elseif($a=="Secure|Open")
		{
			if(chkSes()=="Inactive")
			{
				if($b=="LOGIN")
				{
					return (include "login.php");
				}
				else
				{
					return "Denied";
				}
			}
			else
			{
				return "Granted";
			}
		}
		elseif($a=="Secure|Priv")
		{
			if(chkSes()=="Inactive")
			{
				if($b=="LOGIN")
				{
					return (include "login.php");
				}
				else
				{
					return "Denied";
				}
			}
			else
			{
				$userData = userData();	
				
				if(checkPerm(idAccess("PAGE ID"),$userData["level"],'View')=="Yes" || checkPerm(idAccess("PAGE ID"),$userData["level"],'Insert')=="Yes" || checkPerm(idAccess("PAGE ID"),$userData["level"],'Delete')=="Yes" || checkPerm(idAccess("PAGE ID"),$userData["level"],'Edit')=="Yes" || checkPerm(idAccess("PAGE ID"),$userData["level"],'List')=="Yes" || checkPerm(idAccess("PAGE ID"),$userData["level"],'Setup')=="Yes")
				{
				return "Granted";
				}
				else
				{
				echo "<p align='center'>Sorry. You do not have permissions to access this page.</p>";
				return "Denied";
				}
			}
		}
		elseif($a=="Secure|Password")
		{
			if(chkSes()=="Inactive")
			{
				echo "<p align='center'>Sorry. You must be logged in to access this page.</p>";
				return (exit);
			}
			else
			{
				if(password_access($_REQUEST["Password"])=="No")
				{
				echo "<p align='center'>Sorry. You must provide a correct password to access this page.</p>";
				return "Denied";
				}
				else
				{
				return "Granted";
				}
			}
		}
		
		mysqli_close($db);
	}

}
 

if(function_exists('postPassword'))
{
	
}
else
{
	function postPassword(){
	$html = '<form action="" method="POST"><table align="center" width="400">';
	$html .='<tr>';
	$html .='<td>';
	$html .='Post Password: ';
	$html .='</td>';
	$html .='<td>';
	$html .='<input name="Password" type="password">';
	$html .='</td>';
	$html .='<td>';
	$html .='<input name="postPasswordBtn" type="submit" value="Access Post">';
	$html .='</td>';
	$html .='</tr>';
	$html .='</table></form>';

	return $html;
	}
}
?>