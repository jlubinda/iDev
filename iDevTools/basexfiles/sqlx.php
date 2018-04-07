<?php

include_once "../cnct.php";


if($_REQUEST["segment"]=="b1")
{
?>
<form action="" method="POST">
<table align="center">
	<tr>
		<td><textarea name="sqlquery" rows="10" cols="100"><?php
if($_REQUEST["sqlquery"])
{
	echo $_REQUEST["sqlquery"];
}
else
{	
	if($_REQUEST["component"])
	{
	echo "SELECT * FROM ".$_REQUEST["component"];
	}
	else
	{
	
	}
}	
		?></textarea></td>
	</tr>
	<tr>
		<td><input type="submit" name="Submit" value="Go"></td>
	</tr>
</table>
</form>
<?php

if($_REQUEST["sqlquery"] && $_REQUEST["Submit"]=="Go")
{

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
$matchSQL = "/;/i";

  if(!preg_match($matchSQL,$_REQUEST["sqlquery"])) 
  {
  $orderby = "ORDER BY ".$iColName.";";
  }
  else
  {
    $orderby = "";
  }

$create_table = $_REQUEST["sqlquery"]." ".$orderby."";
echo "<p align='center'>".$create_table."</p>";
$res_alter = mysqli_query($db,$create_table);
if($res_alter)
{
echo "<p align='center'>Success!</p>";

	echo "<table  id='tables_css' align='center'>";
	echo "<tr bgcolor='#cfcfcf'>";

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
}
?>