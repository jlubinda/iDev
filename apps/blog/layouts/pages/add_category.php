<?php

router(array("HEADER","website"),"","",'','','file','');

if(isset($_POST['name'])){
    $name = trim($_POST['name']);
    
    if(empty($name)){
        $error = 'You must submit the category name';
    }
    else if(blog_category_exists('name',$name)){
        $error = 'That category already exists';
    } else if(strlen($name)> 24){
        $error = 'The category name only be up to 24 characters only';
    }

    if(!isset($error)){
        add_blog_category($name);
        header("Location:./?ref=news/addPost.php");
        die();
    }
}

include find_file("apps/blog/layouts/pages/nav.php");
?>
     <h2>Add Category</h2>
	 <?php 
	 
$userData = userData();

if(checkPerm('news/addCategory.php|||',$userData["level"],'View')=="Yes")
{
	?>
     <p>
        <?php if(isset($error)){
            echo $error;
            } ?>
     </p>
     <div>
      <form action='' method='post'>
        <label for='name'>Name </label>
        <input type='text' name='name' />
        <input type='submit' value='Add Category' />
      </form>
      </div>
<?php
}
else
{
	echo "ACCESS DENIED!";
}
router(array("FOOTER","website"),"","",'','','file','');
?>