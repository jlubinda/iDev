<?php

function add_blog_post($title,$contents,$category){
	
	include find_file("apps/blog/cnct_blog.php");
	
    $title      = mysqli_real_escape_string($db,$title);
    $contents   = mysqli_real_escape_string($db,$contents);
    $category   = (int)$category;
	$userData = userData();
	$userid = $userData["userID"];
	$priv = priv();
	$vCode = $_SESSION["API_KEY"];
	
	if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
	{
		$status = mysqli_real_escape_string($db,'ACTIVE');
	}
	else
	{
		$status = mysqli_real_escape_string($db,'PENDING');
	}
	
	
    mysqli_query($db,"INSERT INTO `posts` SET
                `vCode`     = '{$vCode}',
                `cat_id`     = '{$category}',
                `title`      = '{$title}',
                `contents`   = '{$contents}',
                `userid`   = '{$userid}',
                `status`   = '{$status}',
                `date_posted`= NOW()");
				
   mysqli_close(DB_NAME);
}

function edit_post_post_status($id,$status){
    $id         = (int)$id;
    
	include find_file("apps/blog/cnct_blog.php");
	
    $status   = mysqli_real_escape_string($db,$status);
	
    mysqli_query($db,"UPDATE `posts` SET
                `status` = '{$status}'
                WHERE `id` = {$id}"); 

   mysqli_close(DB_NAME);
}

function edit_blog_post($id,$title,$contents,$category){
    
	include find_file("apps/blog/cnct_blog.php");
	
    $id         = (int)$id;
    $title      = mysqli_real_escape_string($db,$title);
    $contents   = mysqli_real_escape_string($db,$contents);
    $category   = (int)$category;
	
    mysqli_query($db,"UPDATE `posts` SET
                `cat_id`     = {$category},
                `title`      = '{$title}',
                `contents`   = '{$contents}'
                WHERE `id` = {$id}"); 

   mysqli_close(DB_NAME);
}

function get_blog_post_details($id){
   $posts = array();
	$priv = priv();
   
	include find_file("apps/blog/cnct_blog.php");
	
	if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
	{
		$statusQry = "";
	}
	else
	{
		$status = mysqli_real_escape_string($db,'ACTIVE');
		$statusQry = " AND `status` = '{$status}' ";
	}
	
	$id = (int)$id;
	$vCode = $_SESSION["API_KEY"];
	
   $query = mysqli_query($db,"SELECT `cat_id`,`title`,`contents`,`userid`,`date_posted` FROM `posts` WHERE `id` = {$id} AND vCOde = {$vCode} ".$statusQry);
   
   while($row = mysqli_fetch_assoc($query)){
    $posts[] = $row;
   }
   
   mysqli_close(DB_NAME);
   
   return $posts;
}

function edit_post_post_comment_status($id,$status){
    
	include find_file("apps/blog/cnct_blog.php");
	
    $id         = (int)$id;
    $status   = mysqli_real_escape_string($db,$status);
    mysqli_query($db,"UPDATE `comments` SET
                `status` = '{$status}'
                WHERE `id` = {$id}"); 

   mysqli_close(DB_NAME);
}

function add_blog_post_comment($post_id,$comment){
	
	$userData = userData();
	$priv = priv();
	
	include find_file("apps/blog/cnct_blog.php");
	
    $post_id      = (int)$post_id;
    $comment   = mysqli_real_escape_string($db,$comment);
	$post_details = get_blog_post_details($post_id);
    $category   = (int)$post_details[0]["cat_id"];
	$vCode = $_SESSION["API_KEY"];
	
	if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
	{
		$status = mysqli_real_escape_string($db,'ACTIVE');
	}
	else
	{
		$status = mysqli_real_escape_string($db,'PENDING');
	}
	
	$userid = $userData["userID"];
	$ins = "INSERT INTO `comments` SET
                `vCode`     = '{$vCode}',
                `cat_id`     = {$category},
                `post_id`      = '{$post_id}',
                `comment`   = '{$comment}',
                `status`   = '{$status}',
                `userid`   = '{$userid}',
                `date_commented`= NOW()";
				
				//echo $ins."<br>";
    mysqli_query($db,$ins);
				
   mysqli_close(DB_NAME);
}

function edit_post_post_comment($id,$contents){
    
	include find_file("apps/blog/cnct_blog.php");
	
    $id         = (int)$id;
    $contents   = mysqli_real_escape_string($db,$contents);
    mysqli_query($db,"UPDATE `comments` SET
                `contents` = '{$contents}'
                WHERE `id` = {$id}"); 

   mysqli_close(DB_NAME);
}

function get_blog_post_comments($post_id, $status = null){
    
	include find_file("apps/blog/cnct_blog.php");
	
    $post_id = (int)$post_id;
    $comments = array();
	$vCode = $_SESSION["API_KEY"];
	
    $query = "SELECT `id`,`post_id`,`cat_id`,`comment`,`status`,`userid`,`date_commented` FROM `comments` WHERE `post_id` = '{$post_id}' AND `vCode` = '{$vCode}'" ;
    if(isset($status)){
			$status   = mysqli_real_escape_string($db,$status);
			$query .= " AND `status` = '{$status}' ";
            }
			else
			{
				if($status=="ALL")
				{
					
				}
				else
				{
					$priv = priv();
					
					if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
					{
						
					}
					else
					{
						$status   = mysqli_real_escape_string($db,'ACTIVE');
						$query .= " AND `status` = '{$status}' ";
					}
							
				}
			}
        
    $query .= "ORDER BY `id` ASC";
	
	//echo $query;
    $query = mysqli_query($db,$query);
    
    while($row = mysqli_fetch_assoc($query)){
    $comments[] = $row;
   }
   
   mysqli_close(DB_NAME);
   
   return $comments;
}

function add_blog_category($name){
  
	include find_file("apps/blog/cnct_blog.php");
	
  $name = mysqli_real_escape_string($db,$name);
  $vCode = $_SESSION["API_KEY"];
  mysqli_query($db,"INSERT INTO `categories` SET 
  `vCode`     = '{$vCode}',
  `name` = '{$name}'");
  
   mysqli_close(DB_NAME);
}

function blog_delete($table, $id){
    
	include find_file("apps/blog/cnct_blog.php");
	
    $table = mysqli_real_escape_string($db,$table);
    $id    = (int)$id;
	$vCode = $_SESSION["API_KEY"];
    mysqli_query($db,"DELETE FROM `{$table}` WHERE `id`= {$id} AND `vCode`= {$vCode} ");
    
   mysqli_close(DB_NAME);
}

function get_blog_posts($id = null, $cat_id = null){
    $posts = array();
			
	$priv = priv();
    
	include find_file("apps/blog/cnct_blog.php");
	
	if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
	{
		$statusQry = "";
	}
	else
	{
		$status = mysqli_real_escape_string($db,'ACTIVE');
		$statusQry = " AND `posts`.`status` = '{$status}' ";
	}
   
   $vCode = $_SESSION["API_KEY"];

    $query = "SELECT
              `posts`.`id` AS `post_id` ,
               `categories`.`id` AS `category_id`,
               `title`,`contents`,`status`,`userid`,`date_posted`,
               `categories`.`name`
               FROM `posts`
               INNER JOIN `categories` ON `categories`.`id` = `posts`.`cat_id` " ;
    if(isset($id)){
        $id = (int)$id;
        $query .= " WHERE `posts`.`id` = {$id} AND `posts`.`vCode` = {$vCode} ";
             }
    if(isset($cat_id)){
        $cat_id = (int)$cat_id;
        $query .= " WHERE `cat_id` = {$cat_id} AND `vCode` = {$vCode} ";
             }         
        
        $query .= $statusQry;
    $query .= "ORDER BY `post_id` DESC";
	
	//echo $query;
    $query = mysqli_query($db,$query);
    
    while($row = mysqli_fetch_assoc($query)){
    $posts[] = $row;
   }
   
   mysqli_close(DB_NAME);
   
   return $posts;
}

function get_blog_categories($id = null){
   $categories = array();
   $vCode = $_SESSION["API_KEY"];
   
	include find_file("apps/blog/cnct_blog.php");
	
   $query = mysqli_query($db,"SELECT `id`,`name` FROM `categories` WHERE `vCode` = {$vCode} ");
   
   while($row = mysqli_fetch_assoc($query)){
    $categories[] = $row;
   }
   
   mysqli_close(DB_NAME);
   
   return $categories;
}

function blog_category_exists($field,$name){
    
	include find_file("apps/blog/cnct_blog.php");
	
    $name = mysqli_real_escape_string($db,$name);
    $field = mysqli_real_escape_string($db,$field);
	$vCode = $_SESSION["API_KEY"];
    $query = mysqli_query($db,"SELECT COUNT(1) AS numID FROM categories WHERE `{$field}` = '{$name}' AND `vCode` = {$vCode} ");
    if($query)
	{
		$rw = mysqli_fetch_array($query);
		if($rw["numID"]>=1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
	
   mysqli_close(DB_NAME);
}

?>