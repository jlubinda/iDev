<table align="center" width="100%" bgcolor="007fbf" border="0" height="100%">
<tr>
	<td>
<?php
 if(chkSes()=="Inactive")
{

} 
else 
{


if($_REQUEST["ref"]=="help" && !$_REQUEST["segment"])
{
include_once "help/help_index.php";
}
elseif($_REQUEST["ref"]=="help" && $_REQUEST["segment"]=="a1")
{
include_once "help/supplies_to_comesa.php";
}
else
{

}
}
?></td>
</tr></table>