<?php
@$year = date(Y);
@$day = date(z);
@$hour = date(G);
@$hour2 = date(h);
@$mins = date(i);
@$sec = date(s);
@$x = ($year*365*24)+($day*24)+($hour);
@$v = ($sec*$x)+55973;

if($hour<11)
{
@$daylight = "AM";
}
else
{
@$daylight = "PM";
}

@$hour3 = $hour2 - 1;

if($hour3=="0")
{
@$hour4 = 12;
}
else
{
@$hour4 = $hour3;
}
@$time = $hour4.":".$mins." ".$daylight;
@$date_day = date(d);
@$date_month = date(m);
@$date_year = date(Y);
@$current_date = "$date_day/$date_month/$date_year";
@$current_date2 = "$date_year-$date_month-$date_day";
?>