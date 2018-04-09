<?php 
router(array("HEADER","profile"),"","",'','','file','');
if(chkSes()=="Active")
{
?>
<article class="container">
	<p>Aenean gravida quis felis nec efficitur. Donec vulputate mauris at lacus mollis scelerisque. Quisque tristique ac eros ut fermentum. Nulla convallis arcu eget tortor hendrerit vulputate. Vestibulum euismod consequat sagittis.</p>
</article>
<hr><?php 
}
else
{
	include find_file("login.php");
}
router(array("FOOTER","profile"),"","",'','','file','');
?>