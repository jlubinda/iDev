<table align="center" width="100%" bgcolor="#ffffff" border="0" height="100%">
<tr>
	<td>
<?php
 if(chkSes()=="Active")
{

if($_REQUEST["ref"]=="1" && !$_REQUEST["segment"])
{
include_once "iDevToolsfiles/bx_index.php";
}
elseif($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="a1")
{
include_once "iDevToolsfiles/structure.php";
}
elseif($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="b1")
{
include_once "iDevToolsfiles/sql.php";
}
elseif($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="c1" && !$_REQUEST["unit"])
{
include_once "iDevToolsfiles/b_confirmation.php";
}
elseif($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="c1" && $_REQUEST["unit"])
{
include_once "iDevToolsfiles/bigdump.php";
}
elseif($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="d1")
{
include_once "iDevToolsfiles/c_confirmation.php";
}
elseif($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="e1")
{
include_once "iDevToolsfiles/d_confirmation.php";
}
elseif($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="f1")
{
include_once "iDevToolsfiles/operations.php";
}
else
{

}
}
?><br><br><br></td>
</tr></table>