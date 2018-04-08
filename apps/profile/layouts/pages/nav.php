<?php

if(chkSes()=="Inactive")
{
	?>
	<nav>
		<ul>
			<li><a href='?ref=news/index.php' >HOME</a></li>
			<li><a href='?ref=news/listCategories.php' >Programme List</a></li>
			<!--li><a href='' ></a></li-->
		</ul>
	</nav>
	<?php
}
else
{
	$userData = userData();
	?>
	<nav>
		<ul>
			<li><a href='?ref=news/index.php' >HOME</a></li>
			<?php
			if(checkPerm('news/addPost.php|||',$userData["level"],'View')=="Yes")
			{
			?>
				<li><a href='?ref=news/addPost.php' >Add a Post</a></li>	 
			<?php 
			}

			if(checkPerm('news/addProgramme.php|||',$userData["level"],'View')=="Yes")
			{
			?>
				<li><a href='?ref=news/addProgramme.php' >Add Programme</a></li>	 
			<?php  
			}
			?>
				<li><a href='?ref=news/listCategories.php' >Programme List</a></li>
			<!--li><a href='' ></a></li-->
		</ul>
	</nav>
	<?php
}
?>
     <h1>City Drive News</h1>