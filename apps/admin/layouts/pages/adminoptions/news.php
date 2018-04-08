<?php
router(array("HEADER","website"),"","",'','','file','');

	if(@ privacy('Secure|Priv')=='Granted')
	{
	?>
	<div class="row">
		<div class="col s12 m4 l5">
		<?php 
			mysidebar();
			include find_file("apps/admin/layouts/pages/adminnav.php");
		?>
		</div>
		<div class="col s12 m4 l5">
	<div style="padding: 5px;">

			<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<form action="" method="POST" enctype="multipart/form-data">
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>TITLE:</b> </div><div style="float: right;"><input name="title" type="text" size="60" style="width:400px;"></div></div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>DESCRIPTION:</b> </div><div style="float: right;"><textarea name="description" rows="5" cols="100"><?php echo getPrivacy();?></textarea></div></div>
			<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(addNewsItem($_REQUEST["title"],$_REQUEST["description"])=="1")
			{
				echo "SUCCESS! NEWS ITEM HAS BEEN ADDED.<br><br>";
			}
			else
			{
				echo "ERROR ADDING NEWS ITEM.<br><br>";
			}
			echo '</div>';
		}
		
		
	?>


	<?php 

	if($_REQUEST["function"]=="delete")
	{
		?>
		<div style="padding: 5px; width:93%;">
			<div style="min-width:280px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
				<?php 
				if($_REQUEST['con']=="Yes")
				{
					if(deleteNewsItem($_REQUEST['id'])==1)
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>NEWS ITEM DELETED</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px; width:500px; padding:5px; background-color:#555;"><b>ERROR! NEWS ITEM NOT DELETED</b></div>
						<?php
					}
				}
				else
				{
					?>
					<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ARE YOU SURE YOU WANT TO DELETE THE NEWS ITEM '<?php echo getJob($_REQUEST['id'],"TITLE");?>'? </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST['id'];?>&function=delete&con=Yes"><div style="margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>"><div style="margin:5px;">NO</div></a></div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}

	?>
	</div>
	<div style="width:60%; min-width: 320px;">
		<div style="min-width:280px; width:100%; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<?php 
			$cats = listNews();
			
			for($a=0; $a<$cats[0]['num']; $a++)
			{
				?>
				<div style="margin:5px; width:300px;; padding:5px; background-color:#555;"><div style="padding:7px; background-color:#222;"><strong><?php echo $cats[$a]["title"];?></strong></div><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cats[$a]['id'];?>&function=delete"><div style="margin:5px;">DELETE</div></a></div>
				<?php
			}
			?>
		</div>
	</div>
		</div>
	</div>
	<?php
	}
router(array("FOOTER","website"),"","",'','','file','');
?>