<?php
router(array("HEADER","website"),"","",'','','file','');
include find_file("apps/blog/layouts/pages/nav.php");

$posts = get_blog_posts(null,$_GET['id']);

     foreach($posts as $post){

     ?>
     <h2><a href='?ref=news/index.php&id=<?php echo $post['post_id']; ?>' ><?php echo $post['title']; ?></a></h2>
     <p>
        Posted on <?php echo date('d-m-y h:i:s',strtotime($post['date_posted'])); ?>
        In <a href='?ref=news/category.php&id=<?php echo $post['category_id']; ?>' ><?php echo $post['name']; ?></a>
     </p>
     <div><?php echo nl2br($post['contents']); ?></div>
	 <?php 

		$userData = userData();
	 ?>
     <menu>
        <ul>
		 <?php 
		if(checkPerm('news/deletePost.php|||',$userData["level"],'View')=="Yes")
		{
		 ?>
            <li><a href='?ref=news/deletePost.php&id=<?php echo $post['post_id']; ?>' >Delete This Post</a></li>
		<?php 
		}
		
		if(checkPerm('news/editPost.php|||',$userData["level"],'View')=="Yes")
		{
		 ?>
            <li><a href='?ref=news/editPost.php&id=<?php echo $post['post_id']; ?>' >Edit This Post</a></li>
		<?php 
		}
		?>
        </ul>
     </menu>
     <?php 
}
router(array("FOOTER","website"),"","",'','','file','');
?>