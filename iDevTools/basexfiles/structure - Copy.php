<?php
 if(chkSes()=="Inactive")
{

} 
else 
{

	//echo "<div><table id='segment_nav_head'><td width='140' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&unit=1&funx=".$_REQUEST["funx"]."&CID=".$_REQUEST["CID"]."&ID=".$_REQUEST["ID"]."&ORGNAME=".$_REQUEST["ORGNAME"]."&BID=".$_REQUEST["BID"]."&BRNCNAME=".$_REQUEST["BRNCNAME"]."'>CANCELATION LIST</a></span></td><td width='150' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=2&funx=".$_REQUEST["funx"]."&CID=".$_REQUEST["CID"]."&ID=".$_REQUEST["ID"]."&ORGNAME=".$_REQUEST["ORGNAME"]."&BID=".$_REQUEST["BID"]."&BRNCNAME=".$_REQUEST["BRNCNAME"]."'>CANCEL YELLOW CARD</a></span></td><td width='150' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=2&funx=".$_REQUEST["funx"]."&CID=".$_REQUEST["CID"]."&ID=".$_REQUEST["ID"]."&ORGNAME=".$_REQUEST["ORGNAME"]."&BID=".$_REQUEST["BID"]."&BRNCNAME=".$_REQUEST["BRNCNAME"]."'></a></span></td></tr></table></div>";
if($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="a1")
{

if($_REQUEST["unit"]=="1")
{

if($_REQUEST["function"]=="list")
{
	if(!$bx_permissions=="Yes")
	{
?>
<table bgcolor="#cfcfcf" width="800" id='tables_css' align='center'>
<tr>
	<td><b>Tables</b></td><td width="110"><b>No. Records</b></td><td width="80"><b></b></td><td width="40"><b></b></td><td width="40"><b></b></td><td width="50"><b></b></td><td width="80"><b></b></td><td width="80"><b></b></td>
</tr>
<?php
$q_tables = "SHOW TABLES FROM ".$db2.";";
$res = mysqli_query($db,$q_tables);
while($rowD = mysqli_fetch_array($res, MYSQL_NUM)) {
$bsql = "SELECT * FROM ".$rowD[0].";";
$bres = mysqli_query($db,$bsql);
$bnum = mysqli_num_rows($bres);
echo "<tr bgcolor='#fcfcf'><td><b>".$rowD[0]."</b></td><td><b>".@number_format($bnum)."</b></td><td align='center'><b><a href='?ref=1&segment=a1&function=edit&unit=1&component=".$rowD[0]."'>Structure</a></b></td><td align='center'><b><a href='?ref=1&segment=a1&function=view&unit=1&component=".$rowD[0]."'>View</a></b></td><td align='center'><b><a href='?ref=1&segment=a1&function=empty&unit=1&component=".$rowD[0]."'>Empy</a></b></td><td align='center'><b><b><a href='?ref=1&segment=a1&function=delete&unit=1&component=".$rowD[0]."'>Delete</a></td><td align='center'><b><b><a href='?ref=1&segment=b1&function=add&unit=1&component=".$rowD[0]."'>SQL Query</a></td><td align='center'><b><b><a href='?ref=1&segment=f1&component=".$rowD[0]."'>Operations</a></td></tr>";
}
?>
</table><br>
<?php
 echo "<form action='' method='GET'>";
 ?>
<input type="hidden" name="ref" size="25" value="<?php echo $_REQUEST["ref"]; ?>">
<input type="hidden" name="segment" size="25" value="<?php echo $_REQUEST["segment"]; ?>">
<input type="hidden" name="function" size="25" value="create">
<input type="hidden" name="unit" size="25" value="2">
 <?php
 
 echo "<table align='center' width='600'>";
echo "<tr>";
echo "<td><b>ADD NEW TABLE -</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><b>No. of Columns:</b><input type='text' size='3' name='numAdded' value='1'></td><td><label id='endof'><b>Name:</b><input type='text' size='25' name='component' id='endof'></label></td><td>&nbsp;&nbsp;<input type='submit' size='3' name='alterBtn' value='Go'></td>";
echo "</tr>";
echo "</table></form>";
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
}
elseif($_REQUEST["function"]=="view")
{
	if(!$bx_permissions=="Yes")
	{
		
		if(!$_REQUEST["alterBtn"])
		{
		$backlink = "?ref=1&segment=a1&function=list&unit=1";
		}
		elseif($_REQUEST["alterBtn"]=="Go")
		{
		$backlink = "?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."";
		}
		elseif($_REQUEST["alterBtn"]=="Submit")
		{
		$backlink = "?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."";
		}
		
	 echo "<p align='center'><a href='?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."'>Structure</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$backlink."'>Back</a></p>";

if($_REQUEST["component"])
{
	$r = mysqli_fetch_array(mysqli_query($db,"SHOW KEYS FROM ".$_REQUEST["component"]." WHERE Key_name = 'PRIMARY'")); 
$iColName = $r['Column_name'];

$orderby = "ORDER BY ".$iColName."";
$tableck = $_REQUEST["component"];
}
else
{
$ck = explode(" ",$_REQUEST["sqlquery"]);
$nmck = count($ck);

for($c=0; $c<$nmck; $c++)
{

$qck = "SELECT * FROM ".$ck[$c].";";
@$rck = mysqli_query($db,$qck);
@$numck = mysqli_num_rows($rck);

if($numck>="1")
{
$tableck = $ck[$c];
}
}


$r = mysqli_fetch_array(mysqli_query($db,"SHOW KEYS FROM ".$tableck." WHERE Key_name = 'PRIMARY'")); 
$iColName = $r['Column_name'];

$orderby = "ORDER BY ".$iColName."";
}


$create_table = "SELECT * FROM ".$_REQUEST["component"]." ".$orderby.";";
echo "<p align='center'>".$create_table."</p>";
$res_alter = mysqli_query($db,$create_table);
if($res_alter)
{
echo "<p align='center'>Success!</p>";

	echo "<table  id='tables_css' align='center'>";
	echo "<tr bgcolor='#cfcfcf'>";
	@$row = mysqli_fetch_array($res_alter);

echo "<td>".$iColName." </td>";
	
	$culumns1 = "SHOW COLUMNS FROM ".$tableck.";";
	$resColumns1 = mysqli_query($db,$culumns1);
	$rwColumns1 = mysqli_fetch_array($resColumns1);
	$numColumns1 = mysqli_num_rows($resColumns1);
		
while($rwColumns1 = mysqli_fetch_array($resColumns1)) {
		echo "<td>{$rwColumns1['Field']} - {$rwColumns1['Type']} </td>";
}
	echo "</tr>";
	$reZ = mysqli_query($db,$create_table);
@$NumRows = mysqli_num_rows($res_alter);
	for($g=0; $g<$NumRows; $g++)
	{	
	echo "<tr>";
	$row = mysqli_fetch_array($reZ);
	
	$culumns = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '".$db2."' AND table_name = '".$tableck."'";
	$resColumns = mysqli_query($db,$culumns);
	$rwColumns = mysqli_fetch_array($resColumns);
	
	$numColumns = $rwColumns[0];
		for($h=0; $h<$numColumns; $h++)
		{
		$columnx = $row[$h];
		echo "<td>".$columnx."</td>";
		}
	echo "</tr>";
	}
	echo "</table>";
}
else
{
echo "<p>Error!</p>";
}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
}
elseif($_REQUEST["function"]=="edit")
{
	if(!$bx_permissions=="Yes")
	{
	
		if(!$_REQUEST["alterBtn"])
		{
		$backlink = "?ref=1&segment=a1&function=list&unit=1";
		}
		elseif($_REQUEST["alterBtn"]=="Go")
		{
		$backlink = "?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."";
		}
		elseif($_REQUEST["alterBtn"]=="Submit")
		{
		$backlink = "?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."";
		}
		
	 echo "<p align='center'><a href='?ref=1&segment=a1&function=view&unit=1&component=".$_REQUEST["component"]."'>Browse</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$backlink."'>Back</a></p>";

		if(!$_REQUEST["alterBtn"])
		{
//DESCRIBE TABLE///////////////////////////////////
 $queryg = "DESCRIBE ".$_REQUEST["component"].";";
 $q = mysqli_query($db,$queryg);

 
 echo "<table align='center' width='700' id='tables_css' bgcolor='#cfcfcf'>";
echo "<tr bgcolor='#cfcfcf'>";
echo "<td><b>Name</b></td><td><b>Type</b></td><td width='60'><b></b></td><td width='40'><b></b></td>";
echo "</tr>";

while($row = mysqli_fetch_array($q)) {
echo "<tr bgcolor='#fcfcfc'>";
	echo "<td>{$row['Field']}</td><td>{$row['Type']}</td><td><a href='?ref=1&segment=a1&function=edit&unit=2&component=".$_REQUEST["component"]."&field={$row['Field']}'>Change</a></td><td><a href='?ref=1&segment=a1&function=drop&unit=2&component=".$_REQUEST["component"]."&field={$row['Field']}'>Drop</a></td>";
	// 
echo "</tr>";
}
echo "</table><br>";
 echo "<form action='' method='POST'><table align='center' width='900'>";
echo "<tr>";
echo "<td><b>Add</b><input type='text' size='3' name='numAdded' value='1'></td><td><label id='endof'><input type='radio' size='3' name='position' id='endof' value='End'><b>At End of Table</b></label></td><td><label id='endof'><input type='radio' size='3' name='position' id='endof' value='Beginning'><b>At Beginning of Table</b></label></td><td><label id='endof'><input type='radio' size='3' name='position' id='endof' value='After'><b>After</b><select name='Aftercolumn' id='endof'>";

 $queryg2 = "DESCRIBE ".$_REQUEST["component"].";";
 $q2 = mysqli_query($db,$queryg2);
while($row2 = mysqli_fetch_array($q2)) {
	echo "<option value='{$row2['Field']}'>{$row2['Field']}</option>";
}
echo "</select></label> &nbsp;&nbsp;<input type='submit' size='3' name='alterBtn' value='Go'></td>";
echo "</tr>";
echo "</table></form>";
//DESCRIBE TABLE///////////////////////////////////
		}
		elseif($_REQUEST["alterBtn"]=="Go")
		{
		?>
		<form action="" method="POST">
		<input name="numAdded" type="hidden" value="<?php echo $_REQUEST["numAdded"];?>">
		<input name="position" type="hidden" value="<?php echo $_REQUEST["position"];?>">
		<input name="Aftercolumn" type="hidden" value="<?php echo $_REQUEST["Aftercolumn"];?>">
			<table align="center" ID='tables_css' width="600">
				<tr>
					<td><b>Name</b></td><td><b>Type</b></td><td><b>Length</b></td><td><b>Default</b></td><td><b>Default (User Defined)</b></td><td><b>Null</b></td>
				</tr>
			<?php
			for($d=0; $d<$_REQUEST["numAdded"]; $d++)
			{
			?>
				<tr>
					<td><input name="column<?php echo $d;?>" type="text" size="20"></td><td><select name='columntype<?php echo $d;?>'><option value='INT'>INT</option><option value='VARCHAR'>VARCHAR</option><option value='TEXT'>TEXT</option><option value='DATE'>DATE</option><option value='TINYINT'>TINYINT</option><option value='SMALLINT'>SMALLINT</option><option value='MEDIUMINT'>MEDIUMINT</option><option value='INT'>INT</option><option value='BIGINT'>BIGINT</option><option value='DECIMAL'>DECIMAL</option><option value='FLOAT'>FLOAT</option><option value='DOUBLE'>DOUBLE</option><option value='REAL'>REAL</option><option value='BIT'>BIT</option><option value='BOOLEAN'>BOOLEAN</option><option value='SERIAL'>SERIAL</option><option value='DATE'>DATE</option><option value='DATETIME'>DATETIME</option><option value='TIMESTAMP'>TIMESTAMP</option><option value='TIME'>TIME</option><option value='YEAR'>YEAR</option><option value='CHAR'>CHAR</option><option value='VARCHAR'>VARCHAR</option><option value='TINYTEXT'>TINYTEXT</option><option value='TEXT'>TEXT</option><option value='MEDIUMTEXT'>MEDIUMTEXT</option><option value='LONGTEXT'>LONGTEXT</option><option value='BINARY'>BINARY</option><option value='VARBINARY'>VARBINARY</option><option value='TINYBLOB'>TINYBLOB</option><option value='MEDIUMBLOB'>MEDIUMBLOB</option><option value='BLOB'>BLOB</option><option value='LONGBLOB'>LONGBLOB</option><option value='ENUM'>ENUM</option><option value='SET'>SET</option><option value='GEOMETRY'>GEOMETRY</option><option value='POINT'>POINT</option><option value='LINESTRING'>LINESTRING</option><option value='POLYGON'>POLYGON</option><option value='MULTIPOINT'>MULTIPOINT</option><option value='MULTILINESTRING'>MULTILINESTRING</option><option value='MULTIPOLYGON'>MULTIPOLYGON</option><option value='GEOMETRYCOLLECTION'>GEOMETRYCOLLECTION</option></select></td>
					<td><input name="length<?php echo $d;?>" type="text" size="20"></td><td><select name="defualt<?php echo $d;?>"><option value="None">None</option><option value="User Defined">User Defined</option><option value="NULL">NULL</option><option value="CURRENT_TIMESTAMP">CURRENT_TIMESTAMP</option></select></td><td><input name="defualtUserDefined<?php echo $d;?>" type="text" size="20"></td><td><input name="null<?php echo $d;?>" type="checkbox" value="NULL"></td>
				</tr>
			<?php
			}
			?>
				<tr>
					<td><input name="alterBtn" type="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
		<?php
		}
		elseif($_REQUEST["alterBtn"]=="Submit")
		{
		//Add after selected column After
		//$sql = "ALTER TABLE mdl_assign ADD test1 INT(11) NOT NULL AFTER name, ADD test2 TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER test1, ADD test3 VARCHAR(10) NOT NULL DEFAULT \'15\' AFTER test2";
		
		//Add at begining of table
		//$sql = "ALTER TABLE `mdl_assign` ADD `test1` INT(11) NOT NULL FIRST, ADD `test2` VARCHAR(14) NOT NULL DEFAULT \'New\' AFTER `test1`, ADD `test3` TEXT NULL AFTER `test2`, ADD `test4` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `test3`";
		
		//Add at end of table
		//$sql = "ALTER TABLE `mdl_assign` ADD `test1` INT NOT NULL";
		
		$sql = "ALTER TABLE ".$_REQUEST["component"];
		
			for($d=0; $d<$_REQUEST["numAdded"]; $d++){
			
			$sql .= " ADD ".$_REQUEST["column".$d];
			
				
			
				if($_REQUEST["length".$d])
				{
				$sql .= " ".$_REQUEST["columntype".$d]."(".$_REQUEST["length".$d].")";
				}
				else
				{
				$sql .= " ".$_REQUEST["columntype".$d];
				}
				
			
				if($_REQUEST["null".$d]=="NULL")
				{
				$sql .= " NULL";
				}
				else
				{
				$sql .= " NOT NULL";
				}
				
			
				if($_REQUEST["defualt".$d]=="User Defined")
				{
				$sql .= " DEFAULT '".$_REQUEST["defualtUserDefined".$d]."'";
				}
				elseif($_REQUEST["defualt".$d]=="NULL")
				{
				$sql .= " DEFAULT NULL";
				}
				elseif($_REQUEST["defualt".$d]=="CURRENT_TIMESTAMP")
				{
				$sql .= " ";
				}
				elseif($_REQUEST["defualt".$d]=="None")
				{
				$sql .= "";
				}
				
				
				if($d>="1")
				{
				$sql .= " AFTER ".$_REQUEST["column".($d-1)]." ";
				}
				elseif($d=="0")
				{
					if($_REQUEST["position"]=="After")
					{
					$sql .= " AFTER ".$_REQUEST["Aftercolumn"]." ";
					}
					elseif($_REQUEST["position"]=="Beginning")
					{
					$sql .= " FIRST ";
					}
					elseif($_REQUEST["position"]=="End")
					{
					$sql .= " ";
					}
				}
				
				if($d<($_REQUEST["numAdded"]-1))
				{
				$sql .= ", ";
				}
			}
			
			echo "<p align='center'>".$sql."</p><br>";
			
			$resSQL = mysqli_query($db,$sql);
			
			if($resSQL)
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
elseif($_REQUEST["function"]=="empty")
{
	if(!$bx_permissions=="Yes")
	{
		if(!$_REQUEST["submitBtn"]=="Confirm")
		{
		?>
		<form action="" method="POST">
			<table align="center">
				<tr>
					<td>Are you sure you want to empty the table '<?php echo $_REQUEST["component"];?>' <input name="submitBtn" type="submit" value="Confirm"></td>
				</tr>
			</table>
		</form>
		<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm")
		{
	
$create_table = "TRUNCATE ".$_REQUEST["component"].";";
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
elseif($_REQUEST["function"]=="delete")
{
	if(!$bx_permissions=="Yes")
	{
		if(!$_REQUEST["submitBtn"]=="Confirm")
		{
		?>
		<form action="" method="POST">
			<table align="center">
				<tr>
					<td>Are you sure you want to delete the table '<?php echo $_REQUEST["component"];?>' <input name="submitBtn" type="submit" value="Confirm"></td>
				</tr>
			</table>
		</form>
		<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm")
		{
$create_table = "DROP TABLE ".$_REQUEST["component"].";";
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
}
elseif($_REQUEST["unit"]=="2")
{
if($_REQUEST["function"]=="edit")
{

	if(!$bx_permissions=="Yes")
	{
		if(!$_REQUEST["alterBtn"])
		{
		$backlink = "?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."";
		}
		elseif($_REQUEST["alterBtn"]=="Submit")
		{
		$backlink = "?ref=1&segment=a1&function=edit&unit=2&component=".$_REQUEST["component"]."&field=".$_REQUEST["field"]."";
		}
		
	 echo "<p align='center'><a href='?ref=1&segment=a1&function=view&unit=1&component=".$_REQUEST["component"]."'>Browse</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."'>Structure</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$backlink."'>Back</a></p>";

		if(!$_REQUEST["alterBtn"])
		{
		?>
		<form action="" method="POST">
			<table align="center" ID='tables_css' width="600">
				<tr>
					<td><b>Name</b></td><td><b>Type</b></td><td><b>Length</b></td><td><b>Default</b></td><td><b>Default (User Defined)</b></td><td><b>Null</b></td>
				</tr>
				<tr>
					<td><input name="column" type="text" size="20" value="<?php echo $_REQUEST["field"]; ?>"></td><td><select name='columntype'><option value='INT'>INT</option><option value='VARCHAR'>VARCHAR</option><option value='TEXT'>TEXT</option><option value='DATE'>DATE</option><option value='TINYINT'>TINYINT</option><option value='SMALLINT'>SMALLINT</option><option value='MEDIUMINT'>MEDIUMINT</option><option value='INT'>INT</option><option value='BIGINT'>BIGINT</option><option value='DECIMAL'>DECIMAL</option><option value='FLOAT'>FLOAT</option><option value='DOUBLE'>DOUBLE</option><option value='REAL'>REAL</option><option value='BIT'>BIT</option><option value='BOOLEAN'>BOOLEAN</option><option value='SERIAL'>SERIAL</option><option value='DATE'>DATE</option><option value='DATETIME'>DATETIME</option><option value='TIMESTAMP'>TIMESTAMP</option><option value='TIME'>TIME</option><option value='YEAR'>YEAR</option><option value='CHAR'>CHAR</option><option value='VARCHAR'>VARCHAR</option><option value='TINYTEXT'>TINYTEXT</option><option value='TEXT'>TEXT</option><option value='MEDIUMTEXT'>MEDIUMTEXT</option><option value='LONGTEXT'>LONGTEXT</option><option value='BINARY'>BINARY</option><option value='VARBINARY'>VARBINARY</option><option value='TINYBLOB'>TINYBLOB</option><option value='MEDIUMBLOB'>MEDIUMBLOB</option><option value='BLOB'>BLOB</option><option value='LONGBLOB'>LONGBLOB</option><option value='ENUM'>ENUM</option><option value='SET'>SET</option><option value='GEOMETRY'>GEOMETRY</option><option value='POINT'>POINT</option><option value='LINESTRING'>LINESTRING</option><option value='POLYGON'>POLYGON</option><option value='MULTIPOINT'>MULTIPOINT</option><option value='MULTILINESTRING'>MULTILINESTRING</option><option value='MULTIPOLYGON'>MULTIPOLYGON</option><option value='GEOMETRYCOLLECTION'>GEOMETRYCOLLECTION</option></select></td>
					<td><input name="length" type="text" size="20"></td><td><select name="defualt"><option value="None">None</option><option value="User Defined">User Defined</option><option value="NULL">NULL</option><option value="CURRENT_TIMESTAMP">CURRENT_TIMESTAMP</option></select></td><td><input name="defualtUserDefined" type="text" size="20"></td><td><input name="null" type="checkbox" value="NULL"></td>
				</tr>
				<tr>
					<td><input name="alterBtn" type="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
		<?php
		}
		elseif($_REQUEST["alterBtn"]=="Submit")
		{
		//Add after selected column After
		//$sql = "ALTER TABLE mdl_assign ADD test1 INT(11) NOT NULL AFTER name, ADD test2 TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER test1, ADD test3 VARCHAR(10) NOT NULL DEFAULT \'15\' AFTER test2";
		
		//Add at begining of table
		//$sql = "ALTER TABLE `mdl_assign` ADD `test1` INT(11) NOT NULL FIRST, ADD `test2` VARCHAR(14) NOT NULL DEFAULT \'New\' AFTER `test1`, ADD `test3` TEXT NULL AFTER `test2`, ADD `test4` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `test3`";
		
		//Add at end of table
		//$sql = "ALTER TABLE `mdl_assign` ADD `test1` INT NOT NULL";
		
		$sql = "ALTER TABLE ".$_REQUEST["component"];
			
			$sql .= " CHANGE ".$_REQUEST["field"]." ".$_REQUEST["column"];
			
				if($_REQUEST["length"])
				{
				$sql .= " ".$_REQUEST["columntype"]."(".$_REQUEST["length"].")";
				}
				else
				{
				$sql .= " ".$_REQUEST["columntype"];
				}
				
			
				if($_REQUEST["null"]=="NULL")
				{
				$sql .= " NULL";
				}
				else
				{
				$sql .= " NOT NULL";
				}
				
			
				if($_REQUEST["defualt"]=="User Defined")
				{
				$sql .= " DEFAULT '".$_REQUEST["defualtUserDefined"]."'";
				}
				elseif($_REQUEST["defualt"]=="NULL")
				{
				$sql .= " DEFAULT NULL";
				}
				elseif($_REQUEST["defualt"]=="CURRENT_TIMESTAMP")
				{
				$sql .= " ";
				}
				elseif($_REQUEST["defualt"]=="None")
				{
				$sql .= "";
				}
				
				
				$sql .= "";
				
			
			echo "<p align='center'>".$sql."</p><br>";
			
			$resSQL = mysqli_query($db,$sql);
			
			if($resSQL)
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
elseif($_REQUEST["function"]=="drop")
{

	if(!$bx_permissions=="Yes")
	{	
		
		$backlink = "?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."";
		
		
	 echo "<p align='center'><a href='?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."'>Structure</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=1&segment=a1&function=view&unit=1&component=".$_REQUEST["component"]."'>Browser</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$backlink."'>Back</a></p>";

		if(!$_REQUEST["submitBtn"]=="Confirm")
		{
		?>
		<form action="" method="POST">
			<table align="center">
				<tr>
					<td>Are you sure you want to drop the column '<?php echo $_REQUEST["field"];?>' <input name="submitBtn" type="submit" value="Confirm"></td>
				</tr>
			</table>
		</form>
		<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm")
		{
$create_table = "ALTER TABLE ".$_REQUEST["component"]." DROP ".$_REQUEST["field"].";";
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
elseif($_REQUEST["function"]=="create")
{

	if(!$bx_permissions=="Yes")
	{	
		
		$backlink = "?ref=1&segment=a1&function=list&unit=1";
		
		
	 echo "<p align='center'><a href='?ref=1&segment=a1&function=edit&unit=1&component=".$_REQUEST["component"]."'>Structure</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=1&segment=a1&function=view&unit=1&component=".$_REQUEST["component"]."'>Browser</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$backlink."'>Back</a></p>";


		if(!$_REQUEST["alterBtn2"])
		{
		?>
		<form action="" method="POST">
		<input name="numAdded" type="hidden" value="<?php echo $_REQUEST["numAdded"];?>">
		<input name="position" type="hidden" value="<?php echo $_REQUEST["position"];?>">
		<input name="Aftercolumn" type="hidden" value="<?php echo $_REQUEST["Aftercolumn"];?>">
			<table align="center" ID='tables_css' width="600">
				<tr>
					<td><b>Name</b></td><td><b>Type</b></td><td><b>Length</b></td><td><b>Default</b></td><td><b>Default (User Defined)</b></td><td><b>Null</b></td><td><b>AI</b></td><td><b>Index</b></td>
				</tr>
			<?php
			for($d=0; $d<$_REQUEST["numAdded"]; $d++)
			{
			?>
				<tr>
					<td><input name="column<?php echo $d;?>" type="text" size="20"></td><td><select name='columntype<?php echo $d;?>'><option value='INT'>INT</option><option value='VARCHAR'>VARCHAR</option><option value='TEXT'>TEXT</option><option value='DATE'>DATE</option><option value='TINYINT'>TINYINT</option><option value='SMALLINT'>SMALLINT</option><option value='MEDIUMINT'>MEDIUMINT</option><option value='INT'>INT</option><option value='BIGINT'>BIGINT</option><option value='DECIMAL'>DECIMAL</option><option value='FLOAT'>FLOAT</option><option value='DOUBLE'>DOUBLE</option><option value='REAL'>REAL</option><option value='BIT'>BIT</option><option value='BOOLEAN'>BOOLEAN</option><option value='SERIAL'>SERIAL</option><option value='DATE'>DATE</option><option value='DATETIME'>DATETIME</option><option value='TIMESTAMP'>TIMESTAMP</option><option value='TIME'>TIME</option><option value='YEAR'>YEAR</option><option value='CHAR'>CHAR</option><option value='VARCHAR'>VARCHAR</option><option value='TINYTEXT'>TINYTEXT</option><option value='TEXT'>TEXT</option><option value='MEDIUMTEXT'>MEDIUMTEXT</option><option value='LONGTEXT'>LONGTEXT</option><option value='BINARY'>BINARY</option><option value='VARBINARY'>VARBINARY</option><option value='TINYBLOB'>TINYBLOB</option><option value='MEDIUMBLOB'>MEDIUMBLOB</option><option value='BLOB'>BLOB</option><option value='LONGBLOB'>LONGBLOB</option><option value='ENUM'>ENUM</option><option value='SET'>SET</option><option value='GEOMETRY'>GEOMETRY</option><option value='POINT'>POINT</option><option value='LINESTRING'>LINESTRING</option><option value='POLYGON'>POLYGON</option><option value='MULTIPOINT'>MULTIPOINT</option><option value='MULTILINESTRING'>MULTILINESTRING</option><option value='MULTIPOLYGON'>MULTIPOLYGON</option><option value='GEOMETRYCOLLECTION'>GEOMETRYCOLLECTION</option></select></td>
					<td><input name="length<?php echo $d;?>" type="text" size="20"></td><td><select name="defualt<?php echo $d;?>"><option value="None">None</option><option value="User Defined">User Defined</option><option value="NULL">NULL</option><option value="CURRENT_TIMESTAMP">CURRENT_TIMESTAMP</option></select></td><td><input name="defualtUserDefined<?php echo $d;?>" type="text" size="20"></td><td><input name="null<?php echo $d;?>" type="checkbox" value="NULL"></td><td><input name="AI<?php echo $d;?>" type="checkbox" value="AUTO_INCREMENT"></td><td><select name="Index<?php echo $d;?>"><option value="">---</option><option value="PRIMARY KEY">PRIMARY</option><option value="UNIQUE">UNIQUE</option><option value="INDEX">INDEX</option><option value="FULLTEXT">FULLTEXT</option></select></td>
				</tr>
			<?php
			}
			?>
				<tr>
					<td><input name="alterBtn2" type="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
		<?php
		}
		elseif($_REQUEST["alterBtn2"]=="Submit")
		{
		//Add after selected column After
		//$sql = "ALTER TABLE mdl_assign ADD test1 INT(11) NOT NULL AFTER name, ADD test2 TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER test1, ADD test3 VARCHAR(10) NOT NULL DEFAULT \'15\' AFTER test2";
		
		//Add at begining of table
		//$sql = "ALTER TABLE `mdl_assign` ADD `test1` INT(11) NOT NULL FIRST, ADD `test2` VARCHAR(14) NOT NULL DEFAULT \'New\' AFTER `test1`, ADD `test3` TEXT NULL AFTER `test2`, ADD `test4` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `test3`";
		
		//Add at end of table
		//$sql = "ALTER TABLE `mdl_assign` ADD `test1` INT NOT NULL";
		
		$sql = "CREATE TABLE ".$_REQUEST["component"]." (";
		
			for($d=0; $d<$_REQUEST["numAdded"]; $d++){
			
			$sql .= " ".$_REQUEST["column".$d];
			
				
			
				if($_REQUEST["length".$d])
				{
				$sql .= " ".$_REQUEST["columntype".$d]."(".$_REQUEST["length".$d].")";
				}
				else
				{
				$sql .= " ".$_REQUEST["columntype".$d];
				}
				
			
				if($_REQUEST["null".$d]=="NULL")
				{
				$sql .= " NULL";
				}
				else
				{
				$sql .= " NOT NULL";
				}
				
			
				if($_REQUEST["defualt".$d]=="User Defined")
				{
				$sql .= " DEFAULT '".$_REQUEST["defualtUserDefined".$d]."'";
				}
				elseif($_REQUEST["defualt".$d]=="NULL")
				{
				$sql .= " DEFAULT NULL";
				}
				elseif($_REQUEST["defualt".$d]=="CURRENT_TIMESTAMP")
				{
				$sql .= " ";
				}
				elseif($_REQUEST["defualt".$d]=="None")
				{
				$sql .= "";
				}
				
			
				if($_REQUEST["AI".$d])
				{
				$sql .= " ".$_REQUEST["AI".$d];
				}
				else
				{
				$sql .= "";
				}
				
			
				if($_REQUEST["Index".$d]=="PRIMARY KEY")
				{
				$sql .= " ".$_REQUEST["Index".$d]."";
				}
				elseif($_REQUEST["Index".$d]=="UNIQUE")
				{
				$sql .= " ".$_REQUEST["Index".$d]."";
				}
				elseif($_REQUEST["Index".$d]=="INDEX")
				{
				$sql .= " ".$_REQUEST["Index".$d]."";
				}
				elseif($_REQUEST["Index".$d]=="FULLTEXT")
				{
				$sql .= " ".$_REQUEST["Index".$d]."";
				}
				elseif($_REQUEST["Index".$d]=="---")
				{
				$sql .= "";
				}
				
				
				
				if($d<($_REQUEST["numAdded"]-1))
				{
				$sql .= ", ";
				}
			}
			
				$sql .= ");";
			echo "<p align='center'>".$sql."</p><br>";
			
			$resSQL = mysqli_query($db,$sql);
			
			if($resSQL)
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
}
}
}
?>