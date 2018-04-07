<?php

if(function_exists('numType'))
{
	
}
else
{

	function numType($a){
		$x = $a/2;
		
		$xy = explode(".",$x);
		
		if($xy[1]>0)
		{
			return "ODD";
		}
		else
		{
			return "EVEN";
		}
	}
}
?>