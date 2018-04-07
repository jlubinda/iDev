<table align="center" width="100%" bgcolor="#ffffff" border="0" height="100%">
<tr>
	<td>
<?php
 if(chkSes()=="Active")
{
//echo "<form action='' method='get'><div id='search_field'><input type='hidden' size='25' name='page' value='".$_REQUEST["ref"]."'><input type='hidden' size='25' name='segment' value='d1'><input type='text' size='25' name='search'><input type='submit' value='Search' name='searchBtn'></div></form>";

if($_REQUEST["ref"]=="2" && !$_REQUEST["segment"])
{
include_once "filemanagerfiles/mis.php";
}
elseif($_REQUEST["ref"]=="2")
{
include_once "filemanagerfiles/mis.php";
}
//elseif($_REQUEST["ref"]=="2" && $_REQUEST["segment"]=="e4")
//{
//include_once "filemanagerfiles/financialstatusX.php";
//}
//else
//{

//}
}
?></td>
</tr></table>