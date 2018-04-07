if($_REQUEST["vCode"])
{
echo viewPost($_REQUEST["vCode"]);
}
else
{
$limit = 15;
$Show = "News";
echo listposts($limit,$Show);
}