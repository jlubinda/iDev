<?php
 if(chkSes()=="Inactive")
{

} 
else 
{

		
		$backlink = "?ref=1&segment=a1&function=list&unit=1";
		
		if(!$_REQUEST["component"] && $_REQUEST["newName"])
		{
		$_REQUEST["component"] = $_REQUEST["newName"];
		}
		else
		{
		$_REQUEST["component"] = $_REQUEST["component"];
		}
		
	 echo "<p align='center'><a href='?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."'>Structure</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=1&segment=a1&function=view&unit=1&component=".$_REQUEST["component"]."'>Browse</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$backlink."'>Back</a></p>";
echo "<br>";
echo "<table align='center' width='300' id='tables_css'><tr><td align='left'><a href='?ref=1&segment=f1&function=edit&unit=1&component=".$_REQUEST["component"]."'>Rename Table</a></td><td align='right'><a href='?ref=1&segment=f1&function=view&unit=2&component=".$_REQUEST["component"]."'>Create Table Copy</a></td></tr></table><br>";

	if($_REQUEST["unit"]=="1")
	{
	
	if(!$bx_permissions=="Yes")
	{	
		if(!$_REQUEST["submitBtn"]=="Confirm")
		{
		?>
		<form action="" method="GET">
<input type="hidden" name="ref" size="25" value="<?php echo $_REQUEST["ref"]; ?>">
<input type="hidden" name="segment" size="25" value="<?php echo $_REQUEST["segment"]; ?>">
<input type="hidden" name="function" size="25" value="<?php echo $_REQUEST["function"]; ?>">
<input type="hidden" name="unit" size="25" value="<?php echo $_REQUEST["unit"]; ?>">
<input type="hidden" name="component2" size="25" value="<?php echo $_REQUEST["component"]; ?>">
<input type="hidden" name="component" size="25" value="<?php echo $_REQUEST["newName"]; ?>">
			<table align="center">
				<tr>
					<td><b>Name: </b><input name="newName" type="text" value="<?php echo $_REQUEST["component"];?>" size="25"> <input name="submitBtn" type="submit" value="Confirm"></td>
				</tr>
			</table>
		</form>
		<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm")
		{
$create_table = "RENAME TABLE ".$_REQUEST["component2"]." TO ".$_REQUEST["newName"].";";
echo "<br><p align='center'>".$create_table."</p><br>";
$res_alter = mysqli_query($db,$create_table);
if($res_alter)
{
echo "<p align='center'>Success!</p>";
}
else
{
echo "<p align='center'>Error!</p>";
}
		}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
	}
	elseif($_REQUEST["unit"]=="2")
	{
	
	if(!$bx_permissions=="Yes")
	{	
		
		if(!$_REQUEST["submitBtn"]=="Confirm")
		{
		?>
		<form action="" method="GET">
<input type="hidden" name="ref" size="25" value="<?php echo $_REQUEST["ref"]; ?>">
<input type="hidden" name="segment" size="25" value="<?php echo $_REQUEST["segment"]; ?>">
<input type="hidden" name="function" size="25" value="<?php echo $_REQUEST["function"]; ?>">
<input type="hidden" name="unit" size="25" value="<?php echo $_REQUEST["unit"]; ?>">
<input type="hidden" name="component2" size="25" value="<?php echo $_REQUEST["component"]; ?>">
<input type="hidden" name="component" size="25" value="<?php echo $_REQUEST["newName"]; ?>">
			<table align="center">
				<tr>
					<td><b>Name: </b><input name="newName" type="text" value="<?php echo $_REQUEST["component"];?>" size="25"> <input name="submitBtn" type="submit" value="Confirm"></td>
				</tr>
			</table>
		</form>
		<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm")
		{
//$create_table = "RENAME TABLE ".$_REQUEST["component2"]." TO ".$_REQUEST["newName"].";";


		//$sql = "CREATE  TABLE  mdl_assign2 (  id bigint( 10  )  NOT  NULL  AUTO_INCREMENT , course bigint( 10  )  NOT  NULL DEFAULT  '0', name varchar( 255  )  COLLATE utf8_unicode_ci NOT  NULL DEFAULT  '', intro longtext COLLATE utf8_unicode_ci NOT  NULL , introformat smallint( 4  )  NOT  NULL DEFAULT  '0', alwaysshowdescription tinyint( 2  )  NOT  NULL DEFAULT  '0', nosubmissions tinyint( 2  )  NOT  NULL DEFAULT  '0', submissiondrafts tinyint( 2  )  NOT  NULL DEFAULT  '0', sendnotifications tinyint( 2  )  NOT  NULL DEFAULT  '0', sendlatenotifications tinyint( 2  )  NOT  NULL DEFAULT  '0', duedate bigint( 10  )  NOT  NULL DEFAULT  '0', allowsubmissionsfromdate bigint( 10  )  NOT  NULL DEFAULT  '0', grade bigint( 10  )  NOT  NULL DEFAULT  '0', timemodified bigint( 10  )  NOT  NULL DEFAULT  '0', requiresubmissionstatement tinyint( 2  )  NOT  NULL DEFAULT  '0', completionsubmit tinyint( 2  )  NOT  NULL DEFAULT  '0', cutoffdate bigint( 10  )  NOT  NULL DEFAULT  '0', teamsubmission tinyint( 2  )  NOT  NULL DEFAULT  '0', requireallteammemberssubmit tinyint( 2  )  NOT  NULL DEFAULT  '0', teamsubmissiongroupingid bigint( 10  )  NOT  NULL DEFAULT  '0', blindmarking tinyint( 2  )  NOT  NULL DEFAULT  '0', revealidentities tinyint( 2  )  NOT  NULL DEFAULT  '0', PRIMARY  KEY (  id  ) );";

	$sql3 = "SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';";
	$sql2 = "INSERT INTO ".$_REQUEST["component"]." SELECT * FROM ".$_REQUEST["component2"].";";
	$sql = "CREATE TABLE ".$_REQUEST["component"]." (";
		
$r = mysqli_fetch_array(mysqli_query($db,"SHOW KEYS FROM ".$_REQUEST["component2"]." WHERE Key_name = 'PRIMARY'")); 
$iColName = $r['Column_name'];

	$culumns1x = "SHOW COLUMNS FROM ".$_REQUEST["component2"]." WHERE Field = '".$iColName."';";
	$resColumns1x = mysqli_query($db,$culumns1x);
	$rwColumns1x = mysqli_fetch_array($resColumns1x);
	$numColumns1x = mysqli_num_rows($resColumns1x);
$iColType = "{$rwColumns1x['Type']}";
		

$ex = explode("(",$iColType);
$keyType = $ex[0];

if($keyType=="int" || $keyType=="INT" || $keyType=="Int")
{
$sql .= $iColName." ".$iColType."  NOT  NULL  AUTO_INCREMENT PRIMARY KEY, ";
}
else
{
$sql .= $iColName." ".$iColType."  NOT  NULL DEFAULT  '0' PRIMARY KEY, ";
}


	$culumns1 = "SHOW COLUMNS FROM ".$_REQUEST["component2"].";";
	$resColumns1 = mysqli_query($db,$culumns1);
	$rwColumns1 = mysqli_fetch_array($resColumns1);
	$numColumns1 = mysqli_num_rows($resColumns1);
		
for($k=0; $k<$numColumns1; $k++) {		
$rwColumns1 = mysqli_fetch_array($resColumns1);
$colType = "{$rwColumns1['Type']}";
$colName = "{$rwColumns1['Field']}";

	if($k<$numColumns1-2)
	{
		if($colType=="text" || $colType=="date" || $colType=="datetime")
		{
		$sql .= $colName." ".$colType."  NOT  NULL, ";
		}
		elseif($colType=="timestamp")
		{
		$sql .= $colName." ".$colType."  NOT  NULL DEFAULT CURRENT_TIMESTAMP, ";
		}
		else
		{
		$sql .= $colName." ".$colType."  NOT  NULL DEFAULT  '0', ";
		}
	}
	elseif($k==$numColumns1-2)
	{
		if($colType=="text" || $colType=="date" || $colType=="datetime")
		{
		$sql .= $colName." ".$colType."  NOT  NULL)";
		}
		elseif($colType=="timestamp")
		{
		$sql .= $colName." ".$colType."  NOT  NULL DEFAULT CURRENT_TIMESTAMP)";
		}
		else
		{
		$sql .= $colName." ".$colType."  NOT  NULL DEFAULT  '0')";
		}
	}
	else
	{/*
		if($colType=="text" || $colType=="date" || $colType=="datetime")
		{
		$sql .= $colName." ".$colType."  NOT  NULL)";
		}
		elseif($colType=="timestamp")
		{
		$sql .= $colName." ".$colType."  NOT  NULL DEFAULT CURRENT_TIMESTAMP)";
		}
		else
		{
		$sql .= $colName." ".$colType."  NOT  NULL DEFAULT  '0')";
		}
	*/}
}


echo "<br><br><br><br><p align='center'>".$sql."</p><br>";
echo "<br><p align='center'>".$sql2."</p><br>";

$res_alter = mysqli_query($db,$sql);
$res_alter3 = mysqli_query($db,$sql3);
$res_alter2 = mysqli_query($db,$sql2);

if($res_alter)
{
echo "<p align='center'>Successfully created table copy!</p>";
}
else
{
echo "<p align='center'>Error creating table copy!</p>";
}

if($res_alter2)
{
echo "<p align='center'>Successfully copied all table data to table copy!</p>";
}
else
{
echo "<p align='center'>Error copying table data to table copy!</p>";
}
		}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
	}
}

?>