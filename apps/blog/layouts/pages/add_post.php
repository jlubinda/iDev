<?php

router(array("HEADER","website"),"","",'','','file','');
include find_file("apps/blog/layouts/pages/nav.php");

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
        add_blog_post($title,$contents,$_POST['category']);
        
        $id = mysql_insert_id();
        
        header("Location:./?ref=news/index.php&id={$id}");
        die();
    }
}
?>
        <h2>Add a Post</h2>
        <?php
$userData = userData();

if(checkPerm('news/addPost.php|||',$userData["level"],'View')=="Yes")
{
        if(isset($errors) && !empty($errors)){
            echo"<ul><li>",implode("</li><li>",$errors),"</li></ul>";
        }
        ?>
        <form action='' method='post'>
     <div>
        <label for='title'>Title</label>
         <input type='text' name='title' value='<?php if(isset($_POST['title'])) echo $_POST['title']; ?>' />
     </div>
     <div>
         <label for='contents'>Content</label>
         <textarea name='contents' cols=20 rows=10><?php if(isset($_POST['contents'])) echo $_POST['contents']; ?></textarea>
      </div>
     <div>
       <label for='category'>Category</label>
       <select name='category'>
        <?php
        foreach(get_blog_categories() as $category){
         ?>
         <option value='<?php echo $category['id'] ?>'><?php echo $category['name'] ?></option>
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