<?php 
router(array("HEADER","profile"),"","",'','','file','');
if(chkSes()=="Active")
{
?>
<article class="container">
	<p>When you list your vehicle for hiring out on Vehicle Portal website the following terms and condition will apply.</p>
	<?php echo getSubTerms();?>
</article>
<hr><?php 
}
else
{
	include find_file("login.php");
}
router(array("FOOTER","profile"),"","",'','','file','');
?>