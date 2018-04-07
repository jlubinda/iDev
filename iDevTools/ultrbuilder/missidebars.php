<?php
$sel = "SELECT * FROM _pages WHERE id = '".$_REQUEST["typeID"]."' AND sidebar = 'On';";
$res = mysqli_query($db,$sel);
@$rw = mysqli_fetch_array($res);
$id = $rw["src"];
$src = $rw["src"];


if(!$_REQUEST["sidebar"] && !$_REQUEST["submitBtn"])
{
?>
<form action="" method="post"><table align="center" width="500">
<tr>
	<td>
	<b>Select Sidebar:</b>
	</td>
	<td>
	<select name="sidebar"><?php
	$sl = "SELECT * FROM _sidebars;";
	$rs = mysqli_query($db,$sl);
	@$nm = mysqli_num_rows($rs);
	for($a=0; $a<$nm; $a++)
	{
	$re = mysqli_fetch_array($rs);
	$id = $re["id"];
	$title = $re["title"];
	echo "<option value='".$id."'>".$title."</option>";
	}
	?></select>
	</td>
	<td>
	<input name="submitBtn" value="Submit" type="submit">
	</td>
</tr>
</table></form><?php
}
elseif($_REQUEST["sidebar"] && $_REQUEST["submitBtn"]=="Submit")
{

	@$year = date(Y);
	@$day = date(z);
	@$hour = date(G);
	@$hour2 = date(h);
	@$mins = date(i);
	@$sec = date(s);
	@$x = ($year*365*24)+($day*24)+($hour);
	@$v = ($sec*$x)+55973;
	$random = rand(0,9999999999998);
	$random2 = rand(9999999999999,99999999999999999999);
	$ses = md5(md5($random)."".md5($v)."".md5(SesVar()));
	$ses2 = md5(md5($random2)."".md5($v)."".md5(SesVar()));
	$menu_title = "IMPORT-SIDEBAR";
	
	
		$sl = "SELECT * FROM _pages WHERE id = '".$_REQUEST["typeID"]."';";
		$rl = mysqli_query($db,$sl);
		@$nl = mysqli_num_rows($rl);
		@$rwl = mysqli_fetch_array($rl);
		$id = $rwl["id"];
		$src = $rwl["src"];
	
			
			$in2 = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$_REQUEST["sidebar"]."', '".md5((md5($id))."".(md5($src)))."');";
			$rez2 = mysqli_query($db,$in2);
			
			if($rez2)
			{
			echo "<p><strong>Success!</p>";
			}
			else
			{
			echo "<p><strong>Error while assigning sidebar.</p>";
			}
}
?>