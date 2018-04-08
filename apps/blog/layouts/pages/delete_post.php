<?php

if(!isset($_GET['id'])){
    header("Location:./?ref=news/index.php");
    die();
}

$userData = userData();
$bdata = get_blog_post_details($_GET['id']);

if(checkPerm('news/deletePost.php|||',$userData["level"],'View')=="Yes" || $userData["userID"]==$bdata[0]['userid'])
{
	if(checkPerm('news/deletePost.php|||',$userData["level"],'View')=="Yes")
	{
		blog_delete(posts,$_GET['id']);
		header("Location:./?ref=news/index.php");
	}
	else
	{
		if($bdata[0]['userid']=="ACTIVE")
		{
			header("Location:./?ref=news/index.php");
		}
		else
		{
			blog_delete(posts,$_GET['id']);
			header("Location:./?ref=news/index.php");
		}
	}
}
else
{
	header("Location:./?ref=news/index.php");
}
die();