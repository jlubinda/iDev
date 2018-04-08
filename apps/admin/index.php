<?php 
$appName = "myadmin";
$GLOBALS[$appName."appAccessURL"] = "myadmin/"; //$appAccessURL = "website/";
include find_file("apps/admin/layouts/index.php");
include find_file("apps/admin/services/index.php");
?>