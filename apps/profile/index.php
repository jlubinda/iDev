<?php 
$appName = "profile";
$GLOBALS[$appName."appAccessURL"] = iDevSite("DASHBOARD URL")."/"; //$appAccessURL = "website/";
include find_file("apps/profile/layouts/index.php");
include find_file("apps/profile/services/index.php");
?>