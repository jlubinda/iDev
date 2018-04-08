<?php 
$appName = "blog";
$GLOBALS[$appName."appAccessURL"] = "news/"; //$appAccessURL = "website/";
include find_file("apps/blog/layouts/index.php");
include find_file("apps/blog/services/index.php");
?>