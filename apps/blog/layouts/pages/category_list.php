<?php
router(array("HEADER","website"),"","",'','','file','');
include find_file("apps/blog/layouts/pages/nav.php");
?>
	 <h2>Categories</h2>
     <?php
$userData = userData();

//if(checkPerm('news/listCategories.php|||',$userData["level"],'View')=="Yes")
//{
     foreach(get_blog_categories() as $category){
     ?>
      <p><a href="?ref=news/category.php&id=<?php echo $category['id'];?>"><?php echo $category['name']; ?></a> - <?php
		if(checkPerm('news/deleteCategory.php|||',$userData["level"],'View')=="Yes")
		{
		 ?>
            <li><a href='?ref=news/deleteCategory.php&id=<?php echo $category['id']; ?>' >Delete</a></li>
		<?php 
		}
		?>
     <?php  
     }
//}
//else
//{
//	echo "ACCESS DENIED!";
//}
     ?>
<?php
router(array("FOOTER","website"),"","",'','','file','');
?>