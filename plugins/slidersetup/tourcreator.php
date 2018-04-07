<?php 

	$covervarname = "coverimage";
	$imgN = tourSetUp("PACKAGEIMAGES");
	
	
	
	if($_REQUEST["submitBtn"]=="")
	{
	?>
	<div style="float: left; min-width:300px; width:65%; background-color:#333; padding:5px; margin:5px; color:#fff; margin-bottom:100px;">
		<form action="" method="POST" enctype="multipart/form-data">
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>TOUR CATEGORY</b> <br>';?></b>
			<?php 
			echo '<select name="category">';
			
				$mytours = tourCategory();
				$num = count($mytours);

				for($p=0; $p<$num; $p++)
				{
					$userid = $mytours[$p]["userid"];
					?>
					<option value='<?php echo $userid; ?>'><?php echo tourCategory("NAME",$userid); ?></option>
					<?php
				}			
			echo '</select>';?></div>
			
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>PIN TO CATEGORY</b> <br>';?></b><?php echo '<input name="pin" type="checkbox" value="Yes">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>TITLE</b> <br>';?></b><?php echo '<input name="title" type="text" size="40">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>DAYS</b> <br>';?></b><?php echo '<input name="days" type="text" size="40">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>NIGHTS</b> <br>';?></b><?php echo '<input name="nights" type="text" size="40">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>SHARING PRICE</b> <br>';?></b><?php echo '<input name="sharingprice" type="text" placeholder="eg DOMESTIC TAX" size="40">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>SINGLE SUPPLIMENT PRICE</b> <br>';?></b><?php echo '<input name="singlesupplimentprice" type="text" value="'.$percentage.'" size="40">';?></div>
						
			<script type="text/javascript">
			bkLib.onDomLoaded(function() {
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area1');
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area2');
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area3');
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area4');
				new nicEditor({maxHeight : 300,
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
				}).panelInstance('area5');
			});
			</script>
			
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%; font-size: 12px; font-weight: normal;"><b><?php echo '<b>INCLUDED IN PACKAGE</b> <br>';?></b><?php echo '<textarea name="activities" style="width: 98%; height:100px; min-width:300px;" id="area1"></textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%; font-size: 12px; font-weight: normal;"><b><?php echo '<b>EXCLUDED FROM PACKAGE</b> <br>';?></b><?php echo '<textarea name="excluded" style="width: 98%; height:100px; min-width:300px;" id="area2"></textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%; font-size: 12px; font-weight: normal;"><b><?php echo '<b>EXTRAS</b> <br>';?></b><?php echo '<textarea name="extras" id="area3" style="width: 98%; height:100px; min-width:300px;" placeholder="EXTRA ID:EXTRA NAME:EXTRA DESTINATION,EXTRA ID:EXTRA NAME:EXTRA DESTINATION,EXTRA ID:EXTRA NAME:EXTRA DESTINATION"></textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%; font-size: 12px; font-weight: normal;"><b><?php echo '<b>ITENARARY</b> <br>';?></b><?php echo '<textarea name="itenarary" id="area4" style="width: 98%; height:300px; min-width:300px;"></textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%; font-size: 12px; font-weight: normal;"><b><?php echo '<b>ABOUT DESTINATION</b> <br>';?></b><?php echo '<textarea name="aboutDestination" id="area5" style="width: 98%; height:200px; min-width:300px;"></textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>COVER IMAGE</b> <br>';?></b><?php echo '<input name='.$covervarname.' type="file" accept="image/jpg,image,png,image/gif,image/jpeg,image/bmp">';?><br> <b>TITLE:</b> <input name=<?php echo $covervarname.'title'?> type="text" size="20"> <br><b>ALTANATIVE TEXT:</b> <input name=<?php echo $covervarname.'alt'?> type="text" size="20"></div>
			<?php 
			for($u=0; $u<$imgN; $u++)
			{
				$_REQUEST[$u."file"] = $u."file";
				?>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>OTHER IMAGE '.($u+1).'</b> <br>';?></b><?php echo '<input name='.$_REQUEST[$u."file"].' type="file" accept="image/jpg,image,png,image/gif,image/jpeg,image/bmp">';?><br> <b>TITLE:</b> <input name=<?php echo $u.'title'?> type="text" size="20"> <br><b>ALTANATIVE TEXT:</b> <input name=<?php echo $u.'alt'?> type="text" size="20"></div>
				<?php 
			}
			?>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
		</form>
	</div>
	<?php
	}
	
	if($_REQUEST["submitBtn"]=='Submit' && !($_REQUEST["category"]=='' || $_REQUEST["title"]=='' || $_REQUEST["days"]=='' || $_REQUEST["nights"]=='' || ($_REQUEST["sharingprice"]=='' && $_REQUEST["singlesupplimentprice"]=='') || $_REQUEST["activities"]==''))
	{
		if(tourExists($_REQUEST["title"])>=1)
		{
			echo "You already have a tour with the title <i>".$_REQUEST["title"]."</i>. Please use another title for this tour package.";
	?>
	<div style="float: left; min-width:300px; width:65%; background-color:#333; padding:5px; margin:5px; color:#fff; margin-bottom:100px;">
		<form action="" method="POST" enctype="multipart/form-data">
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>TOUR CATEGORY</b> <br>';?></b>
			<?php 
			echo '<select name="category">';
			
				$mytours = tourCategory();
				$num = count($mytours);

				for($p=0; $p<$num; $p++)
				{
					$userid = $mytours[$p]["userid"];
					?>
					<option value='<?php echo $userid; ?>'><?php echo tourCategory("NAME",$userid); ?></option>
					<?php
				}			
			echo '</select>';?></div>
			
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>PIN TO CATEGORY</b> <br>';?></b><?php echo '<input name="pin" type="checkbox" value="Yes">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>TITLE</b> <br>';?></b><?php echo '<input name="title" type="text" size="40">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>DAYS</b> <br>';?></b><?php echo '<input name="days" type="text" size="40" value="'.$_REQUEST["days"].'">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>NIGHTS</b> <br>';?></b><?php echo '<input name="nights" type="text" size="40" value="'.$_REQUEST["nights"].'">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>SHARING PRICE</b> <br>';?></b><?php echo '<input name="sharingprice" type="text" placeholder="eg DOMESTIC TAX" size="40" value="'.$_REQUEST["sharingprice"].'">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>SINGLE SUPPLIMENT PRICE</b> <br>';?></b><?php echo '<input name="singlesupplimentprice" type="text" value="'.$_REQUEST["singlesupplimentprice"].'" size="40">';?></div>
						
			<script type="text/javascript">
			bkLib.onDomLoaded(function() {
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area1');
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area2');
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area3');
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area4');
				new nicEditor({maxHeight : 300,
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
				}).panelInstance('area5');
			});
			</script>
			
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>INCLUDED IN PACKAGE</b> <br>';?></b><?php echo '<textarea name="activities" style="width: 98%; height:100px; min-width:300px;" id="area1">'.$_REQUEST["activities"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>EXCLUDED FROM PACKAGE</b> <br>';?></b><?php echo '<textarea name="excluded" style="width: 98%; height:100px; min-width:300px;" id="area2">'.$_REQUEST["excluded"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>EXTRAS</b> <br>';?></b><?php echo '<textarea name="extras" id="area3" style="width: 98%; height:100px; min-width:300px;" placeholder="EXTRA ID:EXTRA NAME:EXTRA DESTINATION,EXTRA ID:EXTRA NAME:EXTRA DESTINATION,EXTRA ID:EXTRA NAME:EXTRA DESTINATION">'.$_REQUEST["extras"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>ITENARARY</b> <br>';?></b><?php echo '<textarea name="itenarary" id="area4" style="width: 98%; height:300px; min-width:300px;">'.$_REQUEST["itenarary"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>ABOUT DESTINATION</b> <br>';?></b><?php echo '<textarea name="aboutDestination" id="area5" style="width: 98%; height:200px; min-width:300px;">'.$_REQUEST["aboutDestination"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>COVER IMAGE</b> <br>';?></b><?php echo '<input name='.$covervarname.' type="file" accept="image/jpg,image,png,image/gif,image/jpeg,image/bmp">';?><br> <b>TITLE:</b> <input name=<?php echo $covervarname.'title'?> type="text" size="20" value="<?php echo $_REQUEST[$covervarname.'title'];?>"> <br><b>ALTANATIVE TEXT:</b> <input name=<?php echo $covervarname.'alt'?> type="text" size="20" value="<?php echo $_REQUEST[$covervarname.'title'];?>"></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
		</form>
	</div>
		<?php
		}
		else
		{
			$moreimages = "";
			for($s=0; $s<$imgN; $s++)
			{
				if($s==0)
				{
					$moreimages .= upload($_REQUEST[$s."file"],"images/","","AUTO","").";".$_REQUEST[$s."title"].";".$_REQUEST[$s."alt"];
				}
				else
				{
					$moreimages .= ",".upload($_REQUEST[$s."file"],"images/","","AUTO","").";".$_REQUEST[$s."title"].";".$_REQUEST[$s."alt"];
				}
			}
		
			if(addTour($_REQUEST["title"],$_REQUEST["days"],$_REQUEST["nights"],$_REQUEST["activities"],preg_replace('~[\r\n]+~','',nl2br($_REQUEST["itenarary"])),preg_replace('~[\r\n]+~','',nl2br($_REQUEST["aboutDestination"])),$_REQUEST["sharingprice"],$_REQUEST["singlesupplimentprice"],upload($covervarname,"images/","","AUTO","").";".$_REQUEST[$covervarname."title"].";".$_REQUEST[$covervarname."alt"],$_REQUEST["extras"],$_REQUEST["excluded"],$_REQUEST["category"],$_REQUEST["pin"])=="1")
			{
				echo "Success!<br> <a href='?ref=".$_REQUEST["ref"]."'>Click here to add another tour package.</a><br>";
			}
			else
			{
?>
	<div style="float: left; min-width:300px; width:65%; background-color:#333; padding:5px; margin:5px; color:#fff; margin-bottom:100px;">
				Error! <br>
		<form action="" method="POST" enctype="multipart/form-data">
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>TOUR CATEGORY</b> <br>';?></b>
			<?php 
			echo '<select name="category">';
			
				$mytours = tourCategory();
				$num = count($mytours);

				for($p=0; $p<$num; $p++)
				{
					$userid = $mytours[$p]["userid"];
					?>
					<option value='<?php echo $userid; ?>'><?php echo tourCategory("NAME",$userid); ?></option>
					<?php
				}			
			echo '</select>';?></div>
			
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>PIN TO CATEGORY</b> <br>';?></b><?php echo '<input name="pin" type="checkbox" value="Yes">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>TITLE</b> <br>';?></b><?php echo '<input name="title" type="text" size="40" value="'.$_REQUEST["title"].'">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>DAYS</b> <br>';?></b><?php echo '<input name="days" type="text" size="40" value="'.$_REQUEST["days"].'">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>NIGHTS</b> <br>';?></b><?php echo '<input name="nights" type="text" size="40" value="'.$_REQUEST["nights"].'">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>SHARING PRICE</b> <br>';?></b><?php echo '<input name="sharingprice" type="text" placeholder="eg DOMESTIC TAX" size="40" value="'.$_REQUEST["sharingprice"].'">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>SINGLE SUPPLIMENT PRICE</b> <br>';?></b><?php echo '<input name="singlesupplimentprice" type="text" value="'.$_REQUEST["singlesupplimentprice"].'" size="40">';?></div>
						
			<script type="text/javascript">
			bkLib.onDomLoaded(function() {
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area1');
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area2');
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area3');
				new nicEditor({
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
					}).panelInstance('area4');
				new nicEditor({maxHeight : 300,
					iconsPath : 'resources/nicEdit/nicEditorIcons.gif',
					fullPanel : true
				}).panelInstance('area5');
			});
			</script>
			
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>INCLUDED IN PACKAGE</b> <br>';?></b><?php echo '<textarea name="activities" style="width: 98%; height:100px; min-width:300px;" id="area1">'.$_REQUEST["activities"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>EXCLUDED FROM PACKAGE</b> <br>';?></b><?php echo '<textarea name="excluded" style="width: 98%; height:100px; min-width:300px;" id="area2">'.$_REQUEST["excluded"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>EXTRAS</b> <br>';?></b><?php echo '<textarea name="extras" id="area3" style="width: 98%; height:100px; min-width:300px;" placeholder="EXTRA ID:EXTRA NAME:EXTRA DESTINATION,EXTRA ID:EXTRA NAME:EXTRA DESTINATION,EXTRA ID:EXTRA NAME:EXTRA DESTINATION">'.$_REQUEST["extras"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>ITENARARY</b> <br>';?></b><?php echo '<textarea name="itenarary" id="area4" style="width: 98%; height:300px; min-width:300px;">'.$_REQUEST["itenarary"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555; width:98%;"><b><?php echo '<b>ABOUT DESTINATION</b> <br>';?></b><?php echo '<textarea name="aboutDestination" id="area5" style="width: 98%; height:200px; min-width:300px;">'.$_REQUEST["aboutDestination"].'</textarea>';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>COVER IMAGE</b> <br>';?></b><?php echo '<input name='.$covervarname.' type="file" accept="image/jpg,image,png,image/gif,image/jpeg,image/bmp">';?><br> <b>TITLE:</b> <input name=<?php echo $covervarname.'title'?> type="text" size="20" value="<?php echo $_REQUEST[$covervarname.'title'];?>"> <br><b>ALTANATIVE TEXT:</b> <input name=<?php echo $covervarname.'alt'?> type="text" size="20" value="<?php echo $_REQUEST[$covervarname.'title'];?>"></div>
			<?php 
			for($u=0; $u<$imgN; $u++)
			{
				$_REQUEST[$u."file"] = $u."file";
				?>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>OTHER IMAGE '.($u+1).'</b> <br>';?></b><?php echo '<input name='.$_REQUEST[$u."file"].' type="file" accept="image/jpg,image,png,image/gif,image/jpeg,image/bmp">';?><br> <b>TITLE:</b> <input name=<?php echo $u.'title'?> type="text" size="20"> <br><b>ALTANATIVE TEXT:</b> <input name=<?php echo $u.'alt'?> type="text" size="20"></div>
				<?php 
			}
			?>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
		</form>
	</div>
	<?php
			}
		}		
	}
	
?>