<?php

if(isset($_GET['pid']) && isset($_GET['statusx']))
{
	if($_GET['statusx']=="DELETE")
	{
		blog_delete(posts,$_GET['id']);
	}
	else
	{
		edit_post_post_status($_GET['id'],$_GET['statusx']);
	}
}

//$posts = (isset($_GET['id'])) ? get_posts($_GET['id']) : get_posts();$GLOBALS["THEME"]
$posts = get_blog_posts((isset($_GET['id']))? $_GET['id'] : null); 


router(array("HEADER","website"),"","",'','','file','');
include find_file("apps/blog/layouts/pages/nav.php");

$userData = userData();
$priv = priv();

$z = 0;
foreach($posts as $post){
$z = $z+1;

if(checkRemoteFile("https://citydriverentacar.com/profilepics/".getProfilePicture($post['userid']))==1)
{
    $profilePicURL = "https://citydriverentacar.com/profilepics/".getProfilePicture($post['userid']);
}
elseif(checkRemoteFile("https://citydriverentacar.com/test/profilepics/".getProfilePicture($post['userid']))==1)
{
    $profilePicURL = "https://citydriverentacar.com/test/profilepics/".getProfilePicture($post['userid']);
}
elseif(checkRemoteFile("https://vehicleportal.co.zm/profilepics/".getProfilePicture($post['userid']))==1)
{
    $profilePicURL = "https://vehicleportal.co.zm//profilepics/".getProfilePicture($post['userid']);
}
elseif(checkRemoteFile("https://vehicleportal.co.zm/test/profilepics/".getProfilePicture($post['userid']))==1)
{
    $profilePicURL = "https://vehicleportal.co.zm/test/profilepics/".getProfilePicture($post['userid']);
} 
else
{
    $profilePicURL = "profilepics/placeholder.png";
}

      ?>
     <h2><a href='?ref=news/index.php&id=<?php echo $post['post_id']; ?>' ><?php echo $post['title']; ?></a></h2>
     <p><b><img width="100" src="profilepics/<?php echo getProfilePicture($post['userid']);?>"><br><span>Story By <?php echo getNames($post['userid'])?></span><br>
        Posted on <?php echo date('d-m-Y @ h:i',strtotime($post['date_posted'])).'hrs'; ?>
        In <a href='?ref=news/category.php&id=<?php echo $post['category_id']; ?>' ><?php echo $post['name']; ?></a></b>
		<?php 
			if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
			{
				?>
				<br><b>Status:</b> <?php echo $post['status']; ?>
				<?php
				if($post['status']=="PENDING" || $post['status']=="DISAPPROVED")
				{
					$adminLnkx = '<li><a href="?ref=news/index.php&id='.$post['post_id'].'&pid='.$z.'&statusx=ACTIVE">Approve Post</a></li>';
				}
				else
				{
					$adminLnkx = '<li><a href="?ref=news/index.php&id='.$post['post_id'].'&pid='.$z.'&statusx=DISAPPROVED">Disapprove Post</a></li>';
				}
			}
			elseif($userData["userID"]==$post['userid'])
			{
				?>
				<br><b>Status:</b> <?php echo $post['status']; ?>
				<?php
			}
			 ?>
			 <menu>
				<ul>
				 <?php 
				
				if(checkPerm('news/editPost.php|||',$userData["level"],'View')=="Yes" || $userData["userID"]==$post['userid'])
				{
				 ?>
					<li><a href='?ref=news/editPost.php&id=<?php echo $post['post_id']; ?>' >Edit This Post</a></li>
				<?php 
				}
			
				echo $adminLnkx;
			
				if(checkPerm('news/deletePost.php|||',$userData["level"],'View')=="Yes" || $userData["userID"]==$post['userid'])
				{
				 ?>
					<li><a href='?ref=news/deletePost.php&id=<?php echo $post['post_id']; ?>' >Delete This Post</a></li>
				<?php 
				}
				?>
				</ul>
			 </menu>
			 <?php   
		?>
     </p>
     <div>
		<?php 
		
		if(isset($_GET['id']))
		{
			echo nl2br($post['contents']); 
		}
		else
		{
			echo nl2br(substr($post['contents'],0,180));
			
			echo " &nbsp;&nbsp;<a href='?ref=news/index.php&id=".$post['post_id']."'>More</a>";
		}
		
		if(isset($_GET['id']))
		{
			if(isset($_GET['cid']) && isset($_GET['status']))
			{
				if($_GET['status']=="DELETE")
				{
					blog_delete(comments,$_GET['cid']);
				}
				else
				{
					edit_post_post_comment_status($_GET['cid'],$_GET['status']);
				}
			}
				
			if($_POST["sudmitBtn"]=="ADD COMMENT")
			{
				add_blog_post_comment($post['post_id'],$_POST["mycomment"]);
			}
			
			$comments = get_blog_post_comments($post['post_id']);
			?>
			<div align=""style="margin:5px; padding:5px; backgound-color:#ccc;">
			<?php
				if(count($comments)>=1 && isset($comments[0]["post_id"]))
				{
					
					for($a=0; $a<count($comments); $a++)
					{
						if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
						{
							if($comments[$a]['status']=="PENDING" || $comments[$a]['status']=="DISAPPROVED")
							{
								$adminLnk = '<br><a href="?ref=news/index.php&id='.$post['post_id'].'&cid='.$comments[$a]['id'].'&status=ACTIVE">Approve Comment</a>';
							}
							else
							{
								$adminLnk = '<br><a href="?ref=news/index.php&id='.$post['post_id'].'&cid='.$comments[$a]['id'].'&status=DISAPPROVED">Disapprove Comment</a>';
							}
							
							$adminLnk2 = '<br><a href="?ref=news/index.php&id='.$post['post_id'].'&cid='.$comments[$a]['id'].'&status=DELETE">Delete Comment</a>';
						
						}
						else
						{
							if($comments[$a]['userid']==$userData["userID"])
							{
								if($comments[$a]['status']=="PENDING")
								{
									$adminLnk = '<br><span style="font-size:12px;"><i>Comment awaiting moderation.</i></span>';
								}
								elseif($comments[$a]['status']=="DISAPPROVED")
								{
									$adminLnk = '<br><span style="font-size:12px;"><i>Comment Disapproved.</i></span>';
								}
								elseif($comments[$a]['status']=="ACTIVE")
								{
									$adminLnk = '<br><span style="font-size:12px;"><i>Comment Active</i></span>';
								}
							}
							else
							{
								$adminLnk = '';
							}
						}
					?>
						<div align="left" style="padding:5px; backgound-color:#fff; color:#000; width:400px;"><table><tr><td width="150"><img width="80" src="profilepics/<?php echo getProfilePicture($comments[$a]['userid']);?>"><br><span style="font-size:12px;"><i><?php echo getNames($comments[$a]['userid'])?></i></span></td><td width="350"><span style="font-size:13px;"><?php echo nl2br($comments[$a]['comment']); echo $adminLnk; echo $adminLnk2;?></span></td></tr></table></div>
					<?php 
					}
				}
				
				if(chkSes()=="Inactive")
				{
				?>
					<a href="?ref=login">LOGIN</a> or <a href="?ref=login">REGISTER</a> to comment.
				<?php 
				}
				else
				{
				?>
					<div align=""style="padding:5px; backgound-color:#ccc; color:#000;">
						<form action="" method="POST">
							<textarea name="mycomment" rows="4" cols="40"></textarea><br>
							<input name="sudmitBtn" type="submit" value="ADD COMMENT">
						</form>
					</div>
				<?php 
				}
			?>
			</div>
			<?php
		}
		?>
	 </div>
	 <?php
}

router(array("FOOTER","website"),"","",'','','file','');
?>