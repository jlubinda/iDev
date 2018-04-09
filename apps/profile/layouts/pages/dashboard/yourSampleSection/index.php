<?php 
router(array("HEADER","profile"),"","",'','','file','');
if(chkSes()=="Active")
{
?>
<article class="container">
	<p>Sed pulvinar erat et molestie eleifend. Duis tincidunt sollicitudin rutrum. Aenean et ex sodales nibh laoreet semper. Nullam tincidunt varius leo ac ullamcorper. Phasellus non eleifend massa. Proin pellentesque nulla elit, nec suscipit nibh blandit vel. Nulla vel nulla a augue pulvinar molestie.</p>
</article>
<hr><?php 
}
else
{
	include find_file("login.php");
}
router(array("FOOTER","profile"),"","",'','','file','');
?>
