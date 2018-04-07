<table id="main_content">
<tr>
	<td>
<?php
 if(chkSes()=="Inactive")
{

} 
else 
{


if($_REQUEST["ref"]=="profile" && !$_REQUEST["segment"])
{
include_once "profile/profile_index.php";
}
else
{

}
}
?></td>
</tr></table>