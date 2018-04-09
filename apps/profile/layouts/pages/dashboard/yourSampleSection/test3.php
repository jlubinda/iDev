<?php 
router(array("HEADER","profile"),"","",'','','file','');
if(chkSes()=="Active")
{
?>
<article class="container">
	<p>Aliquam id cursus nisi, a feugiat magna. Duis eu pulvinar libero. Fusce non tempus elit. Cras nec sem sodales, imperdiet lacus vitae, tristique tellus. Etiam vehicula iaculis finibus. In hac habitasse platea dictumst. Quisque neque sem, porta et lectus eu, aliquam vulputate lectus.</p>
</article>
<hr><?php 
}
else
{
	include find_file("login.php");
}
router(array("FOOTER","profile"),"","",'','','file','');
?>