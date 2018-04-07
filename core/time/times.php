<?php 

if(function_exists('days_in_year'))
{
	
}
else
{

	function days_in_year($date){

		if(date("L",strtotime($date))==1)
		{
		return 366;
		}
		else
		{
		return 365;
		}
	}
}


if(function_exists('days_in_month'))
{
	
}
else
{

	function days_in_month($date){

		$pku = explode("@", $date);
		$f_date = trim($pku[0]);
		$f_time = trim($pku[1]);

		$dtxp = explode("-",$f_date);
		$month = $dtxp[1];

		if($month==1 || $month=="01" || strtoupper($month)=="JAN" || strtoupper($month)=="JANUARY" || $month==3 || $month=="03" || strtoupper($month)=="MAR" || strtoupper($month)=="MARCH" || $month==5 || $month=="05" || strtoupper($month)=="MAY"  || $month==7 || $month=="07" || strtoupper($month)=="JUL" || strtoupper($month)=="JULY" || $month==8 || $month=="08" || strtoupper($month)=="AUG" || strtoupper($month)=="AUGUST" || $month==10 || $month=="10" || strtoupper($month)=="OCT" || strtoupper($month)=="OCTOBER" || $month==12 || $month=="12" || strtoupper($month)=="DEC" || strtoupper($month)=="DECEMBER")
		{
		return 31;
		}
		elseif($month==2 || $month=="02" || strtoupper($month)=="FEB" || strtoupper($month)=="FEBRUARY")
		{
			if(date("L",strtotime($date))==1)
			{
			return 29;
			}
			else
			{
			return 28;
			}
		}
		elseif($month==4 || $month=="04" || strtoupper($month)=="APR" || strtoupper($month)=="APRIL" || $month==6 || $month=="06" || strtoupper($month)=="JUN" || strtoupper($month)=="JUNE" || $month==9 || $month=="09" || strtoupper($month)=="AUG" || strtoupper($month)=="AUGUST"  || $month==11 || $month=="11" || strtoupper($month)=="NOV" || strtoupper($month)=="NOVEMBER")
		{
		return 30;
		}
	}


}


if(function_exists('currentTimeInSeconds'))
{
	
}
else
{

	function currentTimeInSeconds(){

		return (date("Y")*365*24*60*60)+(date("z")*24*60*60)+(date("G")*60*60)+(date("i")*60)+date("s");
	}
}
?>