<?php 
router(array("HEADER","profile"),"","",'','','file','');
if(chkSes()=="Active")
{
?>
<article class="container">
	<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque eget eros et odio ullamcorper auctor nec id felis. Nulla facilisi. Praesent rhoncus consectetur lacus id finibus.</p>
</article>
<hr><?php 
}
else
{
	include find_file("login.php");
}
router(array("FOOTER","profile"),"","",'','','file','');
?>