<?php
$fppre = fopen("iDevTools/ultrbuilder/blog/pre.php", "r");
$sizepre = filesize("iDevTools/ultrbuilder/blog/pre.php");
$arraypre = fread($fppre, ($sizepre+1));
$precodepre = htmlentities($arraypre);
	
$defualt_text_pre = "\n";
$precodepre = "\n";
$defualt_text_pre = "\n";
?>