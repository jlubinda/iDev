<?php
 if(chkSes()=="Active")
{
?>
<table bgcolor="#0000bb" align="right" id="mainnav"><tr><td id="mainnav_td" align="center" width="110" <?php if($_REQUEST["ref"]=="1"){ echo "bgcolor='#000000'";}?>><?php if(chkSes()=="Active"){ ?><a href="?ref=1">D-BASE X<span class="main_menu_sub"></span></a><?php } ?></td><td id="mainnav_td" align="center" width="160" <?php if($_REQUEST["ref"]=="2"){ echo "bgcolor='#000000'";}?>><?php if(chkSes()=="Active"){ ?><a href="?ref=2&segment=&function=list">FILE MANGER X<span class="main_menu_sub"></span></a><?php } ?></td><td id="mainnav_td" align="center" width="160" <?php if($_REQUEST["ref"]=="3"){ echo "bgcolor='#000000'";}?>><?php if(chkSes()=="Active"){ ?><a href="?ref=3&segment=&function=list">ULTRA BUILDER X<span class="main_menu_sub"></span></a><?php } ?></td><td id="mainnav_td" align="center" width="150" <?php if($_REQUEST["ref"]=="settings"){ echo "bgcolor='#000000'";}?>><?php if(chkSes()=="Active"){ ?><a href="?ref=settings"><I>i</I> Dev SETTINGS<span class="main_menu_sub"></span></a><?php } ?></td></tr></table>
<?php
}
?>