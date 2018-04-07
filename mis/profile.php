<table id="main_content">
<tr>
	<td>
<?php
 if(!SesVar())
{

} 
else 
{


if($_REQUEST["ref"]=="profile" && !$_REQUEST["segment"])
{
include "profile/profile_index.php";
}
elseif($_REQUEST["ref"]=="profile" && $_REQUEST["segment"]=="a1")
{
include "profile/addcontent.php";
}
elseif($_REQUEST["ref"]=="profile" && $_REQUEST["segment"]=="e1")
{
include "profile/mymusic.php";
}
elseif($_REQUEST["ref"]=="profile" && $_REQUEST["segment"]=="b1")
{
include "profile/myvideos.php";
}
elseif($_REQUEST["ref"]=="profile" && $_REQUEST["segment"]=="c1")
{
include "profile/mystats.php";
}
elseif($_REQUEST["ref"]=="profile" && $_REQUEST["segment"]=="d1")
{
include "profile/myprofile.php";
}
else
{

}
}
?></td>
</tr></table>