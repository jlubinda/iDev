if($_REQUEST["vCode"])
{
viewEvent($_REQUEST["vCode"]);
}
else
{
$a = "full";
$b = "90%";
$c = "15";
calendar($a,$b,$c);
}