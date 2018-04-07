<?php

if(function_exists("SesUID"))
{
	
}
else
{
	function SesUID($a=""){
		if($a=="UNSET")
		{
			unset($_SESSION['uidx']);
		}
		else
		{
			if($_SESSION['uidx']=="")
			{
				@$year = date(Y);
				@$day = date(z);
				@$hour = date(G);
				@$hour2 = date(h);
				@$mins = date(i);
				@$sec = date(s);
				@$x = ((($year*365*24)+($day*24)+($hour))*60)+$mins;
				@$v = ($sec*$x)+55973;

				$_SESSION['uidx'] = md5(rand(0,9999999999)."|".$v);
				
				return $_SESSION['uidx'];
			}
			else
			{
				return $_SESSION['uidx'];
			}
		}
	}
}
?>