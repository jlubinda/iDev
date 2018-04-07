<?php
if(!$_REQUEST["createBtn"] && (!$_REQUEST["SubmitBtn"] && !$_REQUEST["req"] && !$_REQUEST["seq"]))
{
echo "<form action='' method='post'><table align='center' id='tables_css' width='400'>";
echo "<tr>";
	echo "<td>";
		echo "Name:";
	echo "</td>";
	echo "<td>";
		echo "<input name='name' type='text' size='30'>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Menu Type:";
	echo "</td>";
	echo "<td>";
		echo "<select name='MenuType'>";
			echo "<option value='Main'>Main</option>";
			echo "<option value='Other 1'>Other 1</option>";
			echo "<option value='Other 2'>Other 2</option>";
			echo "<option value='Other 3'>Other 3</option>";
			echo "<option value='Other 4'>Other 4</option>";
			echo "<option value='Other 5'>Other 5</option>";
			echo "<option value='Other 6'>Other 6</option>";
			echo "<option value='Other 7'>Other 7</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
		echo "<input type='submit' value='Next' name='createBtn'>";
	echo "</td>";
echo "</tr>";
echo "</table></form>";
}
elseif($_REQUEST["createBtn"]=="Next" || ($_REQUEST["SubmitBtn"]=="Add Resource" || $_REQUEST["SubmitBtn"]=="Remove Resource") || $_REQUEST["req"] || $_REQUEST["seq"])
{		
	if($_REQUEST["MenuType"]=="Main")
	{
	$menu_title = "MAIN MENU";
	}
	elseif($_REQUEST["MenuType"]=="Other 1")
	{
	$menu_title = "MENU2";
	}
	elseif($_REQUEST["MenuType"]=="Other 2")
	{
	$menu_title = "MENU3";
	}
	elseif($_REQUEST["MenuType"]=="Other 3")
	{
	$menu_title = "MENU4";
	}
	elseif($_REQUEST["MenuType"]=="Other 4")
	{
	$menu_title = "MENU5";
	}
	elseif($_REQUEST["MenuType"]=="Other 5")
	{
	$menu_title = "MENU6";
	}
	elseif($_REQUEST["MenuType"]=="Other 6")
	{
	$menu_title = "MENU7";
	}
	elseif($_REQUEST["MenuType"]=="Other 7")
	{
	$menu_title = "MENU8";
	}

 if($numvb>="1" && !($_REQUEST["seq"]) && !($_REQUEST["req"]) && !($_REQUEST["SubmitBtn"]) && !$_REQUEST["nyr"])
 {
 $_REQUEST["nyr"] = $numvb;
 $fgt = "1";
 }
 elseif(!$_REQUEST["nyr"])
 {
 $_REQUEST["nyr"] = 2;
 $fgt = "2";
 }
 
?>
<form action="" method="post">
<input type="hidden" name="name" value="<?php echo $_REQUEST["name"];?>">
<input type="hidden" name="MenuType" value="<?php echo $_REQUEST["MenuType"];?>">

<input type="hidden" value="<?php 
if($_REQUEST["SubmitBtn"]=="Add Resource")
{
echo $_REQUEST["nyr"] + 1; 
}
elseif($_REQUEST["SubmitBtn"]=="Remove Resource")
{
echo $_REQUEST["nyr"] - 1;
}
elseif($_REQUEST["seq"])
{
echo $_REQUEST["nyr"] + 1;
}
elseif($_REQUEST["req"])
{
echo $_REQUEST["nyr"] - 1;
}
else
{
echo $_REQUEST["nyr"];
}
?>" name="nyr" size="30">

<table align="center" id="tables_css7" width="500">
<?php

	if($_REQUEST["SubmitBtn"]=="Add Resource")
	{
	$resoursNum = $_REQUEST["nyr"] + 1; 
	}
	elseif($_REQUEST["seq"])
	{
	$resoursNum = $_REQUEST["nyr"] + 1;
	}
	elseif($_REQUEST["req"])
	{
	$resoursNum = $_REQUEST["nyr"] - 1;
	}
	elseif($_REQUEST["SubmitBtn"]=="Remove Resource")
	{
	$resoursNum = $_REQUEST["nyr"] - 1;
	}
	else
	{
	$resoursNum = $_REQUEST["nyr"];
	}
			
		echo '<input type="hidden" name="resoursNum" value="'.$resoursNum.'">';
		
			$bn = 0;
			for($h=0; $h<$resoursNum; $h++)
			{
			?>
			<tr bgcolor="#dfdfdf"><td bgcolor="#dfdfdf"><?php echo "<b>Link: ".($h+1); ?></b></td><td>
			<?php
			
	$bn = $bn+1;
	$hj = explode(".",($bn/2));
	$d1 = $hj[0];
	$d2 = $hj[1];
	
	if($d2=="" || $d2=="0")
	{
	$bgcolor = "eaeaea";
	}
	else
	{
	$bgcolor = "f0f0f0";
	}	
	
			if($_REQUEST["seq"] && ($h<=($_REQUEST["seq"])))
			{
			$p = $resoursNum-($h+1);
			$ttu = $_REQUEST["LinkName".$p];
			$tyy = $_REQUEST["LinkTitle".$p];
			$tyyn = $_REQUEST["LinkURL".$p];
			$ttumi = $_REQUEST["LinkTarget".$p];
			$tyym = $_REQUEST["Misc".$p];
			$tyyno = $_REQUEST["Order".$p];
			}
			elseif($_REQUEST["seq"] && ($_REQUEST["seq"]+1)==$h)
			{
			$p = $resoursNum-($_REQUEST["seq"]+1);
			$ttu = "";
			$tyy = "";
			$tyyn = "";
			$tyym = "";
			$ttumi = "";
			$tyyno = "";
			$tyyo = "";
			$tyynp = "";
			$tyynoh = "";
			$tyyoh = "";
			$tyynpi = "";
			$tyynpj = "";
			}
			elseif($_REQUEST["seq"] && ($_REQUEST["seq"]+1)>$h)
			{
			$p = $resoursNum-$h;
			$ttu = $_REQUEST["LinkName".$p];
			$tyy = $_REQUEST["LinkTitle".$p];
			$tyyn = $_REQUEST["LinkURL".$p];
			$ttumi = $_REQUEST["LinkTarget".$p];
			$tyym = $_REQUEST["Misc".$p];
			$tyyno = $_REQUEST["Order".$p];
			}
			elseif($_REQUEST["req"] && ($h<($_REQUEST["req"])))
			{
			$p = $resoursNum-($h-1);
			$ttu = $_REQUEST["LinkName".$p];
			$tyy = $_REQUEST["LinkTitle".$p];
			$tyyn = $_REQUEST["LinkURL".$p];
			$ttumi = $_REQUEST["LinkTarget".$p];
			$tyym = $_REQUEST["Misc".$p];
			$tyyno = $_REQUEST["Order".$p];
			}
			elseif($_REQUEST["req"] && ($_REQUEST["req"])==$h)
			{
			$p = $resoursNum-($_REQUEST["req"]);
			$ttu = $_REQUEST["LinkName".$p];
			$tyy = $_REQUEST["LinkTitle".$p];
			$tyyn = $_REQUEST["LinkURL".$p];
			$ttumi = $_REQUEST["LinkTarget".$p];
			$tyym = $_REQUEST["Misc".$p];
			$tyyno = $_REQUEST["Order".$p];
			}
			elseif($_REQUEST["req"] && ($_REQUEST["req"])>$h)
			{
			$p = $resoursNum-$h;
			$ttu = $_REQUEST["LinkName".$p];
			$tyy = $_REQUEST["LinkTitle".$p];
			$tyyn = $_REQUEST["LinkURL".$p];
			$ttumi = $_REQUEST["LinkTarget".$p];
			$tyym = $_REQUEST["Misc".$p];
			$tyyno = $_REQUEST["Order".$p];
			}
			else
			{
			$p = $resoursNum-$h;
			
			if((!$_REQUEST["req"] && !$_REQUEST["seq"]) && ($numvb>="1") && !($_REQUEST["SubmitBtn"]) && ($fgt=="1"))
			{
			$row_Nextv = mysqli_fetch_array($Res_Nextv);
			$ttu = $row_Nextv["LinkName"];//
			$tyy = $row_Nextv["LinkTitle"];
			$tyyn = $row_Nextv["LinkURL"];
			$ttumi = $row_Nextv["LinkTarget"];//
			$tyym = $row_Nextv["Misc"];//
			$tyyno = $row_Nextv["Order"];//
			}
			else
			{
			$ttu = $_REQUEST["LinkName".$p];
			$tyy = $_REQUEST["LinkTitle".$p];
			$tyyn = $_REQUEST["LinkURL".$p];
			$ttumi = $_REQUEST["LinkTarget".$p];
			$tyym = $_REQUEST["Misc".$p];
			$tyyno = $_REQUEST["Order".$p];
			}
			}
			
?>
	<table align="center" id="tables_css3">
	<tr>
		<td><b>Link Name:</b></td><td><input type="text" size="30" name="LinkName<?php echo ($resoursNum-$h);?>" value="<?php echo $ttu;?>"></td>
	</tr>
	<tr>
		<td><b>Link Title:</b></td><td><input type="text" size="30" name="LinkTitle<?php echo ($resoursNum-$h);?>" value="<?php echo $tyy;?>"></td>
	</tr>
	<tr>
		<td><b>Link URL:</b></td><td><input type="text" size="30" name="LinkURL<?php echo ($resoursNum-$h);?>" value="<?php echo $tyyn;?>"></td>
	</tr>
	<tr>
		<td><b>Link Target:</b></td><td><input type="text" size="30" name="LinkTarget<?php echo ($resoursNum-$h);?>" value="<?php echo $ttumi;?>"></td>
	</tr>
	<tr>
		<td><b>Misc:</b></td><td><input type="text" size="30" name="Misc<?php echo ($resoursNum-$h);?>" value="<?php echo $tyym;?>"></td>
	</tr>
	<tr>
		<td><b>Order:</b></td><td><input type="text" size="30" name="Order<?php echo ($resoursNum-$h);?>" value="<?php echo $tyyno;?>"></td>
	</tr>
	</table></td><td align="center">
	<p align="center">
		<?php
		if($h>="1")
		{
		?><input type="submit" value="<?php echo ($h); ?>" name="seq" id="AddBtn"><?php 
		}
		else
		{
		?><input type="submit" value="Add Resource" name="SubmitBtn" id="AddBtn"><?php
		}
		
		echo "&nbsp;&nbsp;&nbsp;";
		 
		if($h>="1")
		{
		?><input type="submit" value="<?php echo ($h); ?>" name="req" id="RemoveBtn"><?php 
		}
		else
		{
		?><input type="submit" value="Remove Resource" name="SubmitBtn" id="RemoveBtn"><?php
		}
		?>
	</p><input type='submit' value='Create Menu' name='createBtn'></td></tr><?php
	}
	?>
</table></form>  
	<?php
}
elseif($_REQUEST["createBtn"]=="Create Menu" && (!$_REQUEST["SubmitBtn"] && !$_REQUEST["req"] && !$_REQUEST["seq"]))
{

	if($_REQUEST["MenuType"]=="Main")
	{
	$menu_title = "MAIN MENU";
	}
	elseif($_REQUEST["MenuType"]=="Other 1")
	{
	$menu_title = "MENU2";
	}
	elseif($_REQUEST["MenuType"]=="Other 2")
	{
	$menu_title = "MENU3";
	}
	elseif($_REQUEST["MenuType"]=="Other 3")
	{
	$menu_title = "MENU4";
	}
	elseif($_REQUEST["MenuType"]=="Other 4")
	{
	$menu_title = "MENU5";
	}
	elseif($_REQUEST["MenuType"]=="Other 5")
	{
	$menu_title = "MENU6";
	}
	elseif($_REQUEST["MenuType"]=="Other 6")
	{
	$menu_title = "MENU7";
	}
	elseif($_REQUEST["MenuType"]=="Other 7")
	{
	$menu_title = "MENU8";
	}
	//
	
@$year = date(Y);
@$day = date(z);
@$hour = date(G);
@$hour2 = date(h);
@$mins = date(i);
@$sec = date(s);
@$x = ($year*365*24)+($day*24)+($hour);
@$v = ($sec*$x)+55973;
$random = rand(0,999999999999999999);
$ses = md5(md5($random)."".md5($v)."".md5(SesVar()));

	
	$ins1 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$ses."','".$_REQUEST["name"]."','".md5($menu_title)."');";
	$res1 = mysqli_query($db,$ins1);
	
	$resoursNum = $_REQUEST["resoursNum"];
	$bb = "";
	$bbx = 0;
	for($h=0; $h<$resoursNum; $h++)
	{
		$lname = $_REQUEST["LinkName".($resoursNum-$h)];
		$ltitle = $_REQUEST["LinkTitle".($resoursNum-$h)];
		$lurl = $_REQUEST["LinkURL".($resoursNum-$h)];
		$lmode = $_REQUEST["LinkTarget".($resoursNum-$h)];
		$lmisc = $_REQUEST["Misc".($resoursNum-$h)];
		$lorder = $_REQUEST["Order".($resoursNum-$h)];
			
		$ins2 = "INSERT INTO _menu (id,pageid,name,title,url,mode,ordering,misc) VALUES ('','".$ses."','".$lname."','".$ltitle."','".$lurl."','".$lmode."','".$lorder."','".$lmisc."');";
		$res2 = mysqli_query($db,$ins2);
		
		if($res2)
		{
		$bb .= "";
		$bbx = $bbx+1;
		}
		else
		{
		$bb .= "<p align='center'>Error! The link ".$lname." Could not be appended to the menu.</p>";
		$bbx = $bbx;
		}
	}
	
	if($res2 && $bbx==$resoursNum)
	{
	$bbm = "<p align='center'>Success! The menu '".$_REQUEST["name"]."' has been created and all ".$resoursNum." links have been appended to it.</p>";
	}
	elseif($res2 && ($bbx<$resoursNum && $bbx>="1"))
	{
	$bbm = "<p align='center'>Success! The menu '".$_REQUEST["name"]."' has been created but only ".$bbx." links have been appended to it.</p>";
	}
	elseif($res2 && $bbx=="0")
	{
	$bbm = "<p align='center'>Success! The menu '".$_REQUEST["name"]."' has been created but no links have been appended to it.</p>";
	}
	elseif(!$res2 && ($bbx=="0" || $bbx==$resoursNum || ($bbx<$resoursNum && $bbx>="1")))
	{
	$bbm = "<p align='center'>Error! The menu '".$_REQUEST["name"]."' could not be created. Please try again later.</p>";
	}
	
	echo $bbm."<br>".$bb;
}
?>