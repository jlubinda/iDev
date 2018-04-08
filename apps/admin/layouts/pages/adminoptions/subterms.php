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
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>TERMS - VEHICLE OWNERS:</b> </div><div style="float: right;"><textarea name="terms" rows="5" cols="100"><?php echo getSubTerms();?></textarea></div></div>
			<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(addSubTerms($_REQUEST["terms"])=="1")
			{
				echo "SUCCESS! TERMS HAVE BEEN ADDED.<br><br>";
			}
			else
			{
				echo "ERROR ADDING TERMS.<br><br>";
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
					if(deleteSubTerms($_REQUEST['id'])==1)
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>TERMS DELETED</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ERROR! TERMS NOT DELETED</b></div>
						<?php
					}
				}
				else
				{
					?>
					<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ARE YOU SURE YOU WANT TO DELETE THE TERMS</b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST['id'];?>&function=delete&con=Yes"><div style="margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>"><div style="margin:5px;">NO</div></a></div>
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
				<div style="margin:5px; width:300px;; padding:5px; background-color:#555;"><div style="padding:7px; background-color:#222;"><strong><?php echo getSubTerms();?></strong></div><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo getTerms("ID");?>&function=delete"><div style="margin:5px;">DELETE</div></a></div>
		</div>
	</div>
		</div>
	</div>
	<?php
	}
router(array("FOOTER","website"),"","",'','','file','');
?>