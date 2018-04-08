<?php
$post = get_blog_posts($_GET['id']);
if(isset($_POST['title'],$_POST['contents'],$_POST['category'])){
    
    $errors = array();
    
    $title      = trim($_POST['title']);
    $contents   = trim($_POST['contents']);
    
    if(empty($title)){
     $errors[] = 'You need to supply a title';
    }
    else if(strlen($title)>255){
     $errors[] = 'The title can not be longer than 255 characters';   
    }
    
    if(empty($contents)){
     $errors[] = 'You need to supply some text';   
    }
    if(!blog_category_exists('id',$_POST['category'])){
    $errors[] = 'That category does not exists';   
    }
    
    if(empty($errors)){
        edit_blog_post($_GET['id'],$title,$contents,$_POST['category']);
       
        header("Location:./?ref=news/index.php&id={$post[0]['post_id']}");
        die();
    }
}

router(array("HEADER","website"),"","",'','','file','');
include find_file("apps/blog/layouts/pages/nav.php");

$userData = userData();

$bdata = get_blog_post_details($_GET['id']);

if(checkPerm('news/editPost.php|||',$userData["level"],'View')=="Yes")
{
	$permz = 1;
}
else
{
	if($userData["userID"]==$bdata[0]['userid'])
	{
		if($bdata[0]['status']=="ACTIVE")
		{
			$permz = 0;
		}
		else
		{
			$permz = 1;
		}
	}
	else
	{
		$permz = 0;
	}
}

if($permz==1)
{
?>
        <h2>Edit Post</h2>
        <?php
        if(isset($errors) && !empty($errors)){
            echo"<ul><li>",implode("</li><li>",$errors),"</li></ul>";
        }
        ?>
        <form action='' method='post'>
     <div>
        <label for='title'>Title</label>
         <input type='text' name='title' value='<?php echo $post[0]['title']; ?>' />
     </div>
     <div>
         <label for='contents'>Content</label>
         <textarea name='contents' cols=20 rows=10><?php echo $post[0]['contents']; ?></textarea>
      </div>
     <div>
       <label for='category'>Category</label>
       <select name='category'>
        <?php
        foreach(get_blog_categories() as $category){
         $selected = ($category['name'] == $post[0]['name']) ? 'selected' : '';   
         ?>
         <option value='<?php echo $category['id'] ?>' <?php echo $selected; ?> ><?php echo $category['name'] ?></option>
         <?php
        }
        ?>
       </select>
     </div>
     <p><input type='submit' value='Add Post' /></p>
     </form>
<?php
}
else
{
	echo "ACCESS DENIED!";
}
router(array("FOOTER","website"),"","",'','','file','');
?>