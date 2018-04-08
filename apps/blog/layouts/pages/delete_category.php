<?php

if(!isset($_GET['id'])){
    header("Location:./?ref=news/index.php");
    die();
}

$userData = userData();

if(checkPerm('news/deleteCategory.php|||',$userData["level"],'View')=="Yes")
{
blog_delete(categories,$_GET['id']);

header("Location:./?ref=news/listCategories.php");
}
else
{
header("Location:./?ref=news/listCategories.php");
}




die();