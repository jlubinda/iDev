<?php 
if($width=="")
{
	$widthx = '350px';
}
else
{
	$widthx = $width;
}


if($bgcolor=="")
{
	$bgcolorx = '#ccc';
}
else
{
	$bgcolorx = $bgcolor;
}


if($color=="")
{
	$colorx = '#000';
}
else
{
	$colorx = $color;
}
?>
<div id="id01" class="w3-modal" style="display: none;">
  <!-- Modal content -->
	<div class="modal-body" style="margin-right:auto; margin-left:auto; background-color:<?php echo $bgcolorx;?>; color:<?php echo $colorx;?>; width:<?php echo $widthx;?>;">
	<div id="mycart" style=" "></div>
	</div>
</div>
<div id="id02" class="w3-modal" style="display: none;">
  <!-- Modal content -->
	<div class="modal-body" style="margin-right:auto; margin-left:auto; background-color:#ccc; color:#000; width:350px;">
	<div id="mycart" style=" "></div>
	</div>
</div>