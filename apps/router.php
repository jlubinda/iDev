<?php
	$GLOBALS["THEME"] = 0;
	
	include find_file("apps/website/router.php");
	include find_file("apps/blog/router.php");
	include find_file("apps/cart/router.php");
	include find_file("apps/chat/router.php");
	include find_file("apps/support/router.php");
	include find_file("apps/wiki/router.php");
	include find_file("apps/profile/router.php");
	include find_file("apps/admin/router.php");
?>