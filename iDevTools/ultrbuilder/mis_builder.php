<?php

$pagesIMP = "IMPORT-PAGES";
$dirIMP = "IMPORT-DIR";
include_once "pmodes.php";

	if($_REQUEST["PageName"]=="")
	{
	$ff = explode(" ",$_REQUEST["title"]);
	}
	else
	{
	$ff = explode(" ",$_REQUEST["PageName"]);
	}
	
	$c = count($ff);
	$FileNamex = "";
	for($t=0; $t<$c+1; $t++)
	{
	$FileNamex .= strtolower($ff[$t]);
	}
	
	$ffx = explode(".",$FileNamex);
	$FileName = $ffx[0];
	
	$slf = "SELECT * FROM _pages WHERE name = '".$FileName."';";
	$ref = mysqli_query($db,$slf);
	@$numf = mysqli_num_rows($ref);
	
	if($numf>="1")
	{
	echo "The file <b>".$FileName.".".$extn."</b> already exists. Please choose another file name.";
	}
	else
	{
	
	}
		
if(!$_REQUEST["createBtn"] && !$_REQUEST["mode"])
{
echo "<form action='' method='post'><table align='center' id='tables_css' width='400'>";
echo "<tr>";
	echo "<td>";
		echo "Title:";
	echo "</td>";
	echo "<td>";
		echo "<input name='title' type='text' size='30'>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Page Type:";
	echo "</td>";
	echo "<td>";
		echo "<select name='PageType'>";
			echo "<option value='Home Page'>Home Page</option>";
			echo "<option value='Master File'>Master File</option>";
			echo "<option value='File'>File</option>";
			echo "<option value='DB Page'>DB Page</option>";
			echo "<option value='Gallery'>Gallery</option>";
			echo "<option value='Slider'>Slider</option>";
			echo "<option value='Blog'>Blog</option>";
			echo "<option value='MySQL Data Form'>MySQL Data Form</option>";
			echo "<option value='CSV Data Form'>CSV Data Form</option>";
			
	$selFunc = "SELECT * FROM meta WHERE meta_data = '".md5("PLUGIN-ID-CODE")."';";
	$res = mysqli_query($db,$selFunc);
	@$num = mysqli_num_rows($res);
	for($a=0; $a<$num; $a++){
		$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		$meta_data = $rw["meta_data"];
		$dateset = $rw["dateset"];
		$syncstate = $rw["syncstate"];
		
		$selX = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-ACTIVE-STATUS")."' AND meta_data = '".$data."';";
		$resX = mysqli_query($db,$selX);
		$rwX = mysqli_fetch_array($resX);
		$activeID = $rwX["id"];
		$active = $rwX["data"];
		
		if($active=="Yes")
		{
			$selX1 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-URL")."' AND meta_data = '".$data."';";
			$resX1 = mysqli_query($db,$selX1);
			$rwX1 = mysqli_fetch_array($resX1);	
			$plugin_url = $rwX1["data"];
			
			$selX2 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-NAME")."' AND meta_data = '".$data."';";
			$resX2 = mysqli_query($db,$selX2);
			$rwX2 = mysqli_fetch_array($resX2);
			$plugin_name = $rwX2["data"];
			
			$selX3 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DEVELOPER")."' AND meta_data = '".$data."';";
			$resX3 = mysqli_query($db,$selX3);
			$rwX3 = mysqli_fetch_array($resX3);
			$plugin_developer = $rwX3["data"];
			
			$selX4 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-DATE-OF-RELEASE")."' AND meta_data = '".$data."';";
			$resX4 = mysqli_query($db,$selX4);
			$rwX4 = mysqli_fetch_array($resX4);
			$plugin_date_of_release = $rwX4["data"];
			
			$selX5 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-VERSION")."' AND meta_data = '".$data."';";
			$resX5 = mysqli_query($db,$selX5);
			$rwX5 = mysqli_fetch_array($resX5);
			$plugin_version = $rwX5["data"];
			
			$selX6 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-UPDATE-URL")."' AND meta_data = '".$data."';";
			$resX6 = mysqli_query($db,$selX6);
			$rwX6 = mysqli_fetch_array($resX6);
			$update_url = $rwX6["data"];
			
			$selX7 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-SIDEBAR")."' AND meta_data = '".$data."' AND data = 'Yes';";
			$resX7 = mysqli_query($db,$selX7);
			$rwX7 = mysqli_fetch_array($resX7);
			$sidebar_feature = $rwX7["data"];
		
			$selX8 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-MENU")."' AND meta_data = '".$data."' AND data = 'Yes';";
			$resX8 = mysqli_query($db,$selX8);
			$rwX8 = mysqli_fetch_array($resX8);
			$menu_feature = $rwX8["data"];
						
			$selX9 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-POST-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
			$resX9 = mysqli_query($db,$selX9);
			$rwX9 = mysqli_fetch_array($resX9);
			$post_feature = $rwX9["data"];
			
			$selX10 = "SELECT * FROM meta WHERE userid = '".md5("PLUGIN-PAGE-FEATURE")."' AND meta_data = '".$data."' AND data = 'Yes';";
			$resX10 = mysqli_query($db,$selX10);
			$rwX10 = mysqli_fetch_array($resX10);
			$page_feature = $rwX10["data"];
				
			
			if($page_feature=="Yes")
			{
			echo "<option value='".$data."'>".$plugin_name."</option>";
			}
		}
	}
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Privacy Level:";
	echo "</td>";
	echo "<td>";	
		echo "<select name='Privacy'>";
			echo "<option value='Free|Open'>Available To All</option>";
			echo "<option value='Secure|Open'>Available to Logged In Users</option>";
			echo "<option value='Secure|Priv'>Available To Specific User Group</option>";
			echo "<option value='Secure|Password'>Password Access Only</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "View Privacy Level:";
	echo "</td>";
	echo "<td>";	
		echo "<select name='ViewPrivacy'>";
			echo "<option value='Free|Open'>Available To All</option>";
			echo "<option value='Secure|Open'>Available to Logged In Users</option>";
			echo "<option value='Secure|Priv'>Available To Specific User Group</option>";
			echo "<option value='Secure|Password'>Password Access Only</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Add Privacy Level:";
	echo "</td>";
	echo "<td>";	
		echo "<select name='AddPrivacy'>";
			echo "<option value='Free|Open'>Available To All</option>";
			echo "<option value='Secure|Open'>Available to Logged In Users</option>";
			echo "<option value='Secure|Priv'>Available To Specific User Group</option>";
			echo "<option value='Secure|Password'>Password Access Only</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Edit Privacy Level:";
	echo "</td>";
	echo "<td>";	
		echo "<select name='EditPrivacy'>";
			echo "<option value='Free|Open'>Available To All</option>";
			echo "<option value='Secure|Open'>Available to Logged In Users</option>";
			echo "<option value='Secure|Priv'>Available To Specific User Group</option>";
			echo "<option value='Secure|Password'>Password Access Only</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "List Privacy Level:";
	echo "</td>";
	echo "<td>";	
		echo "<select name='ListPrivacy'>";
			echo "<option value='Free|Open'>Available To All</option>";
			echo "<option value='Secure|Open'>Available to Logged In Users</option>";
			echo "<option value='Secure|Priv'>Available To Specific User Group</option>";
			echo "<option value='Secure|Password'>Password Access Only</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Delete Privacy Level:";
	echo "</td>";
	echo "<td>";	
		echo "<select name='DeletePrivacy'>";
			echo "<option value='Free|Open'>Available To All</option>";
			echo "<option value='Secure|Open'>Available to Logged In Users</option>";
			echo "<option value='Secure|Priv'>Available To Specific User Group</option>";
			echo "<option value='Secure|Password'>Password Access Only</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Setup Privacy Level:";
	echo "</td>";
	echo "<td>";	
		echo "<select name='SetupPrivacy'>";
			echo "<option value='Free|Open'>Available To All</option>";
			echo "<option value='Secure|Open'>Available to Logged In Users</option>";
			echo "<option value='Secure|Priv'>Available To Specific User Group</option>";
			echo "<option value='Secure|Password'>Password Access Only</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Side Bar:";
	echo "</td>";
	echo "<td>";
		echo "<select name='sidebar'>";
			echo "<option value='Nil'>Nil</option>";
			echo "<option value='On'>On</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Master:";
	echo "</td>";
	echo "<td>";
		echo "<select name='Parent'>";
			echo "<option value=''></option>";
			$se = "SELECT * FROM _pages WHERE type = 'Master File';";
			$re = mysqli_query($db,$se);
			@$nu = mysqli_num_rows($re);
			for($t=0; $t<$nu; $t++)
			{
			$r = mysqli_fetch_array($re);
			$id = $r["id"];
			$name = $r["name"];
			$title = $r["title"];
			$name = $r["name"];
			echo "<option value='".$id."'>".$title."</option>";
			}
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
elseif(($_REQUEST["createBtn"]=="Next" || $_REQUEST["mode"]) || (($_REQUEST["createBtn"]=="Create Page" || $_REQUEST["createBtn"]=="Create Table") && ($numf>="1")))
{
$datalinkx = "?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&PageType=".$_REQUEST["PageType"]."&Parent=".$_REQUEST["Parent"]."&sidebar=".$_REQUEST["sidebar"]."&Privacy=".$_REQUEST["Privacy"]."&title=".$_REQUEST["title"]."&mode=".$_REQUEST["mode"];
//echo "<p align='center'><a href='".$datalinkx."&pmode=auto'>Auto Input Script Type Detection (Auto Closing Tag is set ot OFF in this setting)</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$datalinkx."&pmode=static'>Programing Script Mode (Auto Closing Tag is set ot ON in this setting)</a></p>";
$datalink = "?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&PageType=".$_REQUEST["PageType"]."&Parent=".$_REQUEST["Parent"]."&sidebar=".$_REQUEST["sidebar"]."&Privacy=".$_REQUEST["Privacy"]."&title=".$_REQUEST["title"]."&pmode=".$_REQUEST["pmode"];
	
	if($_REQUEST["PageType"]=="File" || $_REQUEST["PageType"]=="Master File" || $_REQUEST["PageType"]=="Home Page")
	{
	echo "<form action='' method='post'>";		
	include_once "codemirror.php";
	
	$defualt_text = "\n";
	$reque = '$'.'_REQUEST'.'['.'"function"'.']';
	$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
	$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
	$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
	$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';
	
	if($_REQUEST["PageType"]=="Master File" || $_REQUEST["PageType"]=="Home Page")
	{

	}
	elseif($_REQUEST["PageType"]=="File")
	{	
	include_once "precode.php";
	include_once "enca.php";
	}
	?>
	<input type=hidden value="<?php echo $_REQUEST["mode"];?>" id=mode onload="change()">
	<input type="hidden" name="title" value="<?php echo $_REQUEST["title"];?>">
	<?php
	if($_REQUEST["PageType"]=="Home Page")
	{
	?>
	<input type="hidden" name="PageType" value="Master File">
	<input type='hidden' value='SYS INDEX' name='misc'>
	<?php
	}
	else
	{
	?>
	<input type="hidden" name="PageType" value="<?php echo $_REQUEST["PageType"];?>">
	<?php
	}
	?>
	<input type="hidden" name="Privacy" value="<?php echo $_REQUEST["Privacy"];?>">
	<input type="hidden" name="sidebar" value="<?php echo $_REQUEST["sidebar"];?>">
	<input type="hidden" name="Parent" value="<?php echo $_REQUEST["Parent"];?>">
	<table align="center">
	<tr>
	<td><?php
	?>
	File Name: <input type="text" name="PageName" value="<?php echo $FileName.".".$extn;?>"></td>
	</tr><?php
	if($_REQUEST["PageType"]=="File")
	{
	?>
	<tr><td>
	<textarea id="code" name="PageData"><?php
	if(!$_REQUEST["PageData"])
	{
	echo '<?php ';
	echo $defualt_text;
	echo '?>';
	}
	else
	{
	echo $_REQUEST["PageData"];
	}
	?></textarea></td>
	</tr><?php
		if($_REQUEST["Parent"])
		{
		$sl = "SELECT * FROM _pages WHERE misc = 'INDEX' AND parent_page = '".$_REQUEST["Parent"]."';";
		$rl = mysqli_query($db,$sl);
		@$nl = mysqli_num_rows($rl);			
			if($nl<"1")
			{
			$ckt = " checked";
			$ckt2 = "";
			}
			else
			{
			$ckt = "";
			$ckt2 = " checked";
			}
		?>		
	<tr>
		<td align="right">
		Master File Index: <input type='radio' value='INDEX' name='misc'<?php echo $ckt;?>><br>
		Ordinary File: <input type='radio' value='' name='misc'<?php echo $ckt2;?>></td>
	</tr>
		<?php 
		}
	}
	elseif($_REQUEST["PageType"]=="Master File" || $_REQUEST["PageType"]=="Home Page")
	{
	?><?php
	}
	?>
	<tr>
		<td><input type='submit' value='Create Page' name='createBtn'></td>
	</tr>
	</table></form>
	<?php
	include_once "codemirror2.php";
	}
	elseif($_REQUEST["PageType"]=="Post")
	{
	?>
	
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: "textarea#textarea1",
    theme: "modern",
    width: 800,
    height: 350,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
</script>

  <link rel="stylesheet" href="jquery-ui.css">

  <script>
  $(document).ready(function() {
      $('#textarea1').highlightTextarea({
          words: {
            color: '#ADF0FF',
            words: ['print','echo']
          },
          debug: true
      });

  });
  </script>

  <style>
  #demo5-wrap mark {
      padding:0 3px;
      margin:0 -3px;
      border-radius:0.5em;
      background-color:#9999FF !important;
  }
  </style>
	<form action="" method="post">
	<input type="hidden" name="title" value="<?php echo $_REQUEST["title"];?>">
	<input type="hidden" name="PageType" value="<?php echo $_REQUEST["PageType"];?>">
	<input type="hidden" name="Privacy" value="<?php echo $_REQUEST["Privacy"];?>">
	<input type="hidden" name="sidebar" value="<?php echo $_REQUEST["sidebar"];?>">
	<input type="hidden" name="Parent" value="<?php echo $_REQUEST["Parent"];?>">
	<table align="center">
	<tr><td>
	<textarea cols="120" rows="3" onkeyup="AutoGrowTextArea(this)" id="textarea1" name="PageData">
	</textarea>
	<script type="text/javascript">
	AutoGrowTextArea(document.getElementById("textarea1"));
	</script></td></tr>
	<tr>
		<td><input type='submit' value='Create Page' name='createBtn'></td>
	</tr>
	</table></form>  
	<?php
	}
	elseif(!($_REQUEST["PageType"]=="") && !($_REQUEST["PageType"]=="Post") && !($_REQUEST["PageType"]=="Master File") && !($_REQUEST["PageType"]=="File") && !($_REQUEST["PageType"]=="Home Page"))
	{
		
echo "<form action='' method='post'>";
	include_once "codemirror.php";
		
	$defualt_text = "\n";
	$reque = '$'.'_REQUEST'.'['.'"function"'.']';
	$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
	$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
	$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
	$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';
			
	include_once "page/encpre.php";
	include_once "page/encview.php";
	include_once "page/encadd.php";
	include_once "page/encedit.php";
	include_once "page/enclist.php";
	include_once "page/encdelete.php";
	include_once "page/encsetup.php";
	include_once "precode.php";
	
	include_once "enca.php";
	?>
	<input type=hidden value="<?php echo $_REQUEST["mode"];?>" id=mode onload="change()">
	<input type="hidden" name="title" value="<?php echo $_REQUEST["title"];?>">
	<input type="hidden" name="PageType" value="File">
	<input type="hidden" name="Privacy" value="<?php echo $_REQUEST["Privacy"];?>">
	<input type="hidden" name="sidebar" value="<?php echo $_REQUEST["sidebar"];?>">
	<input type="hidden" name="Parent" value="<?php echo $_REQUEST["Parent"];?>">
	<table align="center">
	<tr>
	<td>
	File Name: <input type="text" name="PageName" value="<?php echo $FileName.".".$extn;?>"></td>
	</tr>
	<tr><td>
	<textarea id="code" name="PageData"><?php
	if(!$_REQUEST["PageData"])
	{
	echo '<?php ';
	echo $defualt_text;
	echo '?>';
	}
	else
	{
	echo $_REQUEST["PageData"];
	}
	?></textarea></td>
	</tr><?php
		if($_REQUEST["Parent"])
		{
		$sl = "SELECT * FROM _pages WHERE misc = 'INDEX';";
		$rl = mysqli_query($db,$sl);
		@$nl = mysqli_num_rows($rl);			
			if($nl<"1")
			{
			$ckt = " checked";
			$ckt2 = "";
			}
			else
			{
			$ckt = "";
			$ckt2 = " checked";
			}
		?>		
	<tr>
		<td align="right">
		Master File Index: <input type='radio' value='INDEX' name='misc'<?php echo $ckt;?>><br>
		Ordinary File: <input type='radio' value='' name='misc'<?php echo $ckt2;?>></td>
	</tr>
		<?php 
		}
	?>
	<tr>
		<td><input type='submit' value='Create Page' name='createBtn'></td>
	</tr>
	</table></form>
<?php	
	include_once "codemirror2.php";
	}
}
elseif(($_REQUEST["createBtn"]=="Create Page" || $_REQUEST["createBtn"]=="Create Table") && ($numf<="0"))
{

	if($_REQUEST["PageType"]=="File")
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
	$ses = md5(md5($random)."".md5($v)."".md5($_SESSION[SesUID()]));
	$ses2 = md5(md5($random2)."".md5($v)."".md5($_SESSION[SesUID()]));

		
		$dd = explode(".",$_REQUEST["PageName"]);
		$filenameB = $dd[0];
		$filetypeB = $dd[1];
	
		if(strtolower($filenameB)=="index")
		{		
		$page_name = $_REQUEST["PageName"];	
		}
		else
		{
		$page_name = $ses2.".".$filetypeB;	
		}
		
		$act = "Active";
		
		if($_REQUEST["Parent"])
		{		
		$sl = "SELECT * FROM _pages WHERE id = '".$_REQUEST["Parent"]."';";
		$rl = mysqli_query($db,$sl);
		@$nl = mysqli_num_rows($rl);
		@$rwl = mysqli_fetch_array($rl);
		$srcx = $rwl["src"];
		
		$msel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$srcx."' AND meta_data = '".md5($dirIMP)."');";
		$resm = mysqli_query($db,$msel);
		@$rwm = mysqli_fetch_array($resm);
		$nml = $rwm["data"];
		
		//echo "<br>".$msel."<br>";
		
			if($nml)
			{
			$dirv = $nml."/";
			}
			else
			{
			$dirv = "";
			}
		}
		else
		{
		$dirv = "";
		}
		
		
		$sel2 = "mis/".$dirv.$page_name;
	//echo $_REQUEST["Parent"];
		
		@ $fp = fopen($sel2, "w+", 1);
		if (!$fp)
		{
		echo "<p><strong> Your file could not be created at this time. "
		."Please try again later.</strong></p>";
		}
		else
		{
			fwrite($fp, @ eregi_replace("<\textarea>","</textarea>", $_REQUEST["PageData"]));
			fclose($fp);
			
			$in = "INSERT INTO _pages (id, name, title, src, type, sidebar, parent_page, url, mode, misc, status, uid) VALUES ('', '".$filenameB."', '".$_REQUEST["title"]."', '".$ses."', '".$_REQUEST["PageType"]."', '".$_REQUEST["sidebar"]."', '".$_REQUEST["Parent"]."', '', '".$_REQUEST["Privacy"]."', '".$_REQUEST["misc"]."', '".$act."', '".$userID."');";
			$rez = mysqli_query($db,$in);
			
			$in2 = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$sel2."', '".md5("IMPORT-PAGES")."');";
			$rez2 = mysqli_query($db,$in2);
			
			if($rez && $rez2)
			{
			echo "<p><strong>Success! Your file has been created.</p>";
			}
			else
			{
			echo "<p><strong>Your file has been created, but an error took place while integrating it to the MIS.</p>";
			}
		echo "<p><strong>Success! Your file has been created.</p>";
		}
	}
	elseif($_REQUEST["PageType"]=="Master File")
	{
	include_once "enca.php";
	
		@$year = date(Y);
		@$day = date(z);
		@$hour = date(G);
		@$hour2 = date(h);
		@$mins = date(i);
		@$sec = date(s);
		@$x = ($year*365*24)+($day*24)+($hour);
		@$v = ($sec*$x)+55973;
		$random = rand(0,9999998);
		$random2 = rand(9999999,99999999998);
		$random3 = rand(99999999999,99999999999999999);
		$ses = md5(md5($random)."".md5($v)."".md5($_SESSION[SesUID()]));
		$ses2 = md5(md5($random2)."".md5($v)."".md5($_SESSION[SesUID()]));
		$ses3 = md5(md5($random3)."".md5($v)."".md5($_SESSION[SesUID()]));

		$dd = explode(".",$_REQUEST["PageName"]);
		$filenameB = $dd[0];
		$filetypeB = $dd[1];

		if(strtolower($filenameB)=="index")
		{	
		$page_name = $_REQUEST["PageName"];	
		}
		else
		{
		$page_name = $ses2.".".$filetypeB;	
		}

		$act = "Active";
	
		$dirv = "";
		$sel2 = "mis/".$dirv.$page_name;

		@ $fp = fopen($sel2, "w+", 1);
		if (!$fp)
		{
		echo "<p><strong> Your file could not be created at this time. "."Please try again later.</strong></p>";
		}
		else
		{
			$pageData = '<?php ';
			$pageData .= $defualt_text;
			$pageData .= '?>';
		
			fwrite($fp, @ eregi_replace("<\textarea>","</textarea>", $pageData));
			fclose($fp);
			
			mkdir("mis/".$ses3);
			
			$in = "INSERT INTO _pages (id, name, title, src, type, sidebar, parent_page, url, mode, misc, status, uid) VALUES ('', '".$filenameB."', '".$_REQUEST["title"]."', '".$ses."', '".$_REQUEST["PageType"]."', '".$_REQUEST["sidebar"]."', '".$_REQUEST["Parent"]."', '', '".$_REQUEST["Privacy"]."', '".$_REQUEST["misc"]."', '".$act."', '".$userID."');";
			$rez = mysqli_query($db,$in);
			
			$in2 = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$sel2."', '".md5($pagesIMP)."');";
			$rez2 = mysqli_query($db,$in2);
			
			$in2x = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$ses3."', '".md5($dirIMP)."');";
			$rez2x = mysqli_query($db,$in2x);
			
			if($rez && $rez2 && $rez2x)
			{
			echo "<p><strong>Success! Your file has been created.</p>";
			}
			else
			{
			echo "<p><strong>Your file has been created, but an error took place while integrating it to the MIS.</p>";
			}
		
		}
	}
	elseif($_REQUEST["PageType"]=="Post")
	{
	
	}
	elseif($_REQUEST["PageType"]=="Gallery")
	{
	
	}
	elseif($_REQUEST["PageType"]=="MySQL Data Form")
	{
	?>
	<form action="" method="POST">
	<input type=hidden value="<?php echo $_REQUEST["mode"];?>" id=mode onload="change()">
	<input type="hidden" name="title" value="<?php echo $_REQUEST["title"];?>">
	<input type="hidden" name="PageType" value="MySQL Data Form">
	<input type="hidden" name="Privacy" value="<?php echo $_REQUEST["Privacy"];?>">
	<input type="hidden" name="sidebar" value="<?php echo $_REQUEST["sidebar"];?>">
	<input type="hidden" name="Parent" value="<?php echo $_REQUEST["Parent"];?>">
	<input type="hidden" name="PageName" value="<?php echo $_REQUEST["PageName"];?>">	
	<input type="hidden" name="mysqltable" value="<?php echo $_REQUEST["mysqltable"];?>">	
	<input name="tablecols" type="hidden" value="<?php echo $_REQUEST["tablecols"];?>">
	<input name="position" type="hidden" value="<?php echo $_REQUEST["position"];?>">
	<input name="Aftercolumn" type="hidden" value="<?php echo $_REQUEST["Aftercolumn"];?>">
		<table align="center" ID='tables_css' width="600">
			<tr>
				<td><b>Name</b></td><td><b>Type</b></td><td><b>Length</b></td><td><b>Default</b></td><td><b>Default (User Defined)</b></td><td><b>Null</b></td><td><b>AI</b></td><td><b>Index</b></td><td><b>include_once In Form</b></td><td><b>Form Input Type</b></td>
			</tr>
		<?php
		for($d=0; $d<$_REQUEST["tablecols"]; $d++)
		{
		?>
			<tr>
				<td><input name="column<?php echo $d;?>" type="text" size="20"></td><td><select name='columntype<?php echo $d;?>'><option value='INT'>INT</option><option value='VARCHAR'>VARCHAR</option><option value='TEXT'>TEXT</option><option value='DATE'>DATE</option><option value='TINYINT'>TINYINT</option><option value='SMALLINT'>SMALLINT</option><option value='MEDIUMINT'>MEDIUMINT</option><option value='INT'>INT</option><option value='BIGINT'>BIGINT</option><option value='DECIMAL'>DECIMAL</option><option value='FLOAT'>FLOAT</option><option value='DOUBLE'>DOUBLE</option><option value='REAL'>REAL</option><option value='BIT'>BIT</option><option value='BOOLEAN'>BOOLEAN</option><option value='SERIAL'>SERIAL</option><option value='DATE'>DATE</option><option value='DATETIME'>DATETIME</option><option value='TIMESTAMP'>TIMESTAMP</option><option value='TIME'>TIME</option><option value='YEAR'>YEAR</option><option value='CHAR'>CHAR</option><option value='VARCHAR'>VARCHAR</option><option value='TINYTEXT'>TINYTEXT</option><option value='TEXT'>TEXT</option><option value='MEDIUMTEXT'>MEDIUMTEXT</option><option value='LONGTEXT'>LONGTEXT</option><option value='BINARY'>BINARY</option><option value='VARBINARY'>VARBINARY</option><option value='TINYBLOB'>TINYBLOB</option><option value='MEDIUMBLOB'>MEDIUMBLOB</option><option value='BLOB'>BLOB</option><option value='LONGBLOB'>LONGBLOB</option><option value='ENUM'>ENUM</option><option value='SET'>SET</option><option value='GEOMETRY'>GEOMETRY</option><option value='POINT'>POINT</option><option value='LINESTRING'>LINESTRING</option><option value='POLYGON'>POLYGON</option><option value='MULTIPOINT'>MULTIPOINT</option><option value='MULTILINESTRING'>MULTILINESTRING</option><option value='MULTIPOLYGON'>MULTIPOLYGON</option><option value='GEOMETRYCOLLECTION'>GEOMETRYCOLLECTION</option></select></td>
				<td><input name="length<?php echo $d;?>" type="text" size="20"></td><td><select name="defualt<?php echo $d;?>"><option value="None">None</option><option value="User Defined">User Defined</option><option value="NULL">NULL</option><option value="CURRENT_TIMESTAMP">CURRENT_TIMESTAMP</option></select></td><td><input name="defualtUserDefined<?php echo $d;?>" type="text" size="20"></td><td><input name="null<?php echo $d;?>" type="checkbox" value="NULL"></td><td><input name="AI<?php echo $d;?>" type="checkbox" value="AUTO_INCREMENT"></td><td><select name="Index<?php echo $d;?>"><option value="">---</option><option value="PRIMARY KEY">PRIMARY</option><option value="UNIQUE">UNIQUE</option><option value="INDEX">INDEX</option><option value="FULLTEXT">FULLTEXT</option></select></td><td><input type="checkbox" name="IncludeInForm<?php echo $d;?>" value="Yes"></td><td><select name="FormInputType<?php echo $d;?>"><option value="Text">Text</option><option value="Select">Select</option><option value="Checkbox">Checkbox</option><option value="Radio">Radio</option><option value="Textarea">Textarea</option><option value="Range">Range</option></select></td>
			</tr>
		<?php
		}
		?>
			<tr>
				<td><input name="createBtn" type="submit" value="Submit"></td>
			</tr>
		</table>
	</form>
	<?php
	}
	elseif(!($_REQUEST["PageType"]=="") && !($_REQUEST["PageType"]=="Post") && !($_REQUEST["PageType"]=="Gallery") && !($_REQUEST["PageType"]=="MySQL Data Form") && !($_REQUEST["PageType"]=="Master File") && !($_REQUEST["PageType"]=="File") && !($_REQUEST["PageType"]=="Blog") && !($_REQUEST["PageType"]=="Home Page") && !($_REQUEST["PageType"]=="DB Page") && !($_REQUEST["PageType"]=="Slider"))
	{
		
	}
}
elseif($_REQUEST["createBtn"]=="Submit")
{
$datalinkx = "?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&PageType=".$_REQUEST["PageType"]."&Parent=".$_REQUEST["Parent"]."&sidebar=".$_REQUEST["sidebar"]."&Privacy=".$_REQUEST["Privacy"]."&title=".$_REQUEST["title"]."&mode=".$_REQUEST["mode"];
//echo "<p align='center'><a href='".$datalinkx."&pmode=auto'>Auto Input Script Type Detection (Auto Closing Tag is set ot OFF in this setting)</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$datalinkx."&pmode=static'>Programing Script Mode (Auto Closing Tag is set ot ON in this setting)</a></p>";
$datalink = "?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&PageType=".$_REQUEST["PageType"]."&Parent=".$_REQUEST["Parent"]."&sidebar=".$_REQUEST["sidebar"]."&Privacy=".$_REQUEST["Privacy"]."&title=".$_REQUEST["title"]."&pmode=".$_REQUEST["pmode"];
	
	echo "<form action='' method='post'>";
	include_once "codemirror.php";
	include_once "pmodes.php";
		
	$defualt_text = "\n";
	$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
	$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
	$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
	$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';
	
	?>
	<input type=hidden value="<?php echo $_REQUEST["mode"];?>" id=mode onload="change()">
	<input type="hidden" name="title" value="<?php echo $_REQUEST["title"];?>">
	<input type="hidden" name="PageType" value="MySQL Data Form">
	<input type="hidden" name="Privacy" value="<?php echo $_REQUEST["Privacy"];?>">
	<input type="hidden" name="sidebar" value="<?php echo $_REQUEST["sidebar"];?>">
	<input type="hidden" name="Parent" value="<?php echo $_REQUEST["Parent"];?>">
	<input type="hidden" name="PageName" value="<?php echo $_REQUEST["PageName"];?>">	
	<input type="hidden" name="mysqltable" value="<?php echo $_REQUEST["mysqltable"];?>">	
	<input name="tablecols" type="hidden" value="<?php echo $_REQUEST["tablecols"];?>">
	<input name="position" type="hidden" value="<?php echo $_REQUEST["position"];?>">
	<input name="Aftercolumn" type="hidden" value="<?php echo $_REQUEST["Aftercolumn"];?>">
	<table align="center">
	<tr>
	<td>
	<?php
	
	$prim = "";
	for($px=0; $px<$_REQUEST["tablecols"]; $px++)
	{
		
		$ffxx = explode(" ",$_REQUEST["column".$px]);
		$cxx = count($ffxx);
		$ColumnName = "";
		for($txx=0; $txx<$cxx+1; $txx++)
		{
		$ColumnName .= strtolower($ffxx[$txx]);
		}	
		
		if($_REQUEST["Index".$px]=="PRIMARY KEY" || $_REQUEST["Index".$px]=="UNIQUE" || $_REQUEST["Index".$px]=="INDEX" || $_REQUEST["Index".$px]=="FULLTEXT")
		{
		$prim .= $ColumnName."|";
		}	
	}
	
	$dddx = explode("|",$prim);
	$pindex = $dddx[0];
	
	
	$precode = "";
	$precode .= "\t";
	$precode .= "if($"."_REQUEST[".'"function"'."]==".'"add"'.")";
	$precode .= "\n";
	$precode .= "\t{";
	$precode .= "\n";	
	
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."error = '';";
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "if(".'$'."_REQUEST[".'"submitBtn"'."]==".'""'." || (".'$'."_REQUEST[".'"submitBtn"'."]==".'"Proceed"'." && !($"."error"."==".'""'.")))";
	$precode .= "\n\t\t{\n";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= 'echo "<form action='."''".' method='."'POST'".'><'.''.'table'.' '.'align='."'"."center"."'".' id='."'".'tables_css'."'".' width='."'"."600"."'".'>";';
	$precode .= "\n";
	
	
	for($p=0; $p<$_REQUEST["tablecols"]; $p++)
	{
		
		$ffx = explode(" ",$_REQUEST["column".$p]);
		$cx = count($ffx);
		$ColumnName = "";
		for($tx=0; $tx<$cx+1; $tx++)
		{
		$ColumnName .= strtolower($ffx[$tx]);
		}
		
		if($_REQUEST["IncludeInForm".$p]=="Yes")
		{		
		
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "<tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
			$precode .= 'echo "<td><b>';
			$precode .= $_REQUEST["column".$p];
			$precode .= ':</b> </td>';
			$precode .= '<td>';
			if($_REQUEST["FormInputType".$p]=="Text")
			{
			$precode .= "<input name='".$ColumnName."' type='text' size='25' value=''>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Textarea")
			{
			$precode .= '<textarea name='."'".$ColumnName."'".' rows='."'4'".' cols='."'30'".'><\textarea>';
			}
			elseif($_REQUEST["FormInputType".$p]=="Checkbox")
			{
			$precode .= "<input name='".$ColumnName."' type='checkbox' size='25' value=''>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Range")
			{
			$precode .= "<input name='".$ColumnName."' type='range' size='25' value='' min='0' max='10'>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Select")
			{
			$precode .= "<select name='".$ColumnName."'></select>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Radio")
			{
			$precode .= "<input name='".$ColumnName."' type='radio' size='25' value=''>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Datearea")
			{
			$precode .= "<input name='".$ColumnName."' type='text' size='25' value=''>";
			}
			$precode .= '</td>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "</tr>";';
		$precode .= "\n";
		
		}
	}
			
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "<tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
			$precode .= 'echo "<td></td>';
			$precode .= '<td>';
			$precode .= "<input name='submitBtn' type='submit' size='25' value='Proceed'>";
			$precode .= '</td>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "</tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
	$precode .= 'echo "</table></form>";';
	$precode .= "\n";
	$precode .= "\n\t\t}";
	$precode .= "\n\t\t";
	$precode .= "elseif(".'$'."_REQUEST[".'"submitBtn"'."]==".'"Proceed"'." && ($"."error"."==".'""'."))";
	$precode .= "\n\t\t{";
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= 'echo "<form action='."''".' method='."'POST'".'><'.''.'table'.' '.'align='."'"."center"."'".' id='."'".'tables_css'."'".' width='."'"."600"."'".'>";';
	$precode .= "\n";
	$precode .= "\n";
	
	for($p=0; $p<$_REQUEST["tablecols"]; $p++)
	{	
		if($_REQUEST["IncludeInForm".$p]=="Yes")
		{
		
		$ffx = explode(" ",$_REQUEST["column".$p]);
		$cx = count($ffx);
		$ColumnName = "";
		for($tx=0; $tx<$cx+1; $tx++)
		{
		$ColumnName .= strtolower($ffx[$tx]);
		}
		
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "echo ".'"'."<input name='".$ColumnName."' type='hidden' value='".'".'."$".'_REQUEST["'.$ColumnName.'"]'."".'."'."'>".'"'.";";
		$precode .= "\n";
		}
	}
	$precode .= "\n";
	for($p=0; $p<$_REQUEST["tablecols"]; $p++)
	{
		if($_REQUEST["IncludeInForm".$p]=="Yes")
		{
		
		$ffx = explode(" ",$_REQUEST["column".$p]);
		$cx = count($ffx);
		$ColumnName = "";
		for($tx=0; $tx<$cx+1; $tx++)
		{
		$ColumnName .= strtolower($ffx[$tx]);
		}
		
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "<tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
			$precode .= 'echo "<td><b>';
			$precode .= $_REQUEST["column".$p];
			$precode .= ':</b> </td>';
			$precode .= '<td>';
		$precode .= " ".'"'.".$".'_REQUEST["'.$ColumnName.'"]'."".'."'."";
			$precode .= '</td>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "</tr>";';
		$precode .= "\n";
		
		}
	}
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "<tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
			$precode .= 'echo "<td></td>';
			$precode .= '<td>';
			$precode .= "<input name='submitBtn' type='submit' value='Submit'>";
			$precode .= '</td>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "</tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
	$precode .= 'echo "</table></form>";';
	$precode .= "\n";
	$precode .= "\n\t\t}";
	$precode .= "\n\t\t";
	$precode .= "elseif(".'$'."_REQUEST[".'"submitBtn"'."]==".'"Submit"'.")";
	$precode .= "\n\t\t{";
	$precode .= "\n";
	$precode .= "\n";
	
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	
	$cols = "";
	$coldata = "";
	
	for($p=0; $p<$_REQUEST["tablecols"]; $p++)
	{
		
		$ffx = explode(" ",$_REQUEST["column".$p]);
		$cx = count($ffx);
		$ColumnName = "";
		for($tx=0; $tx<$cx+1; $tx++)
		{
		$ColumnName .= strtolower($ffx[$tx]);
		}
		
		if($p==($_REQUEST["tablecols"]-1))
		{
			$cols .= $ColumnName;
			if($_REQUEST["columntype".$p]=="INT" && $_REQUEST["AI".$p]=="AUTO_INCREMENT")
			{
			$coldata .= "''";
			}
			else
			{
			$coldata .= "'".''.'".$'.'_REQUEST["'.$ColumnName.'"].'.'"'."'";
			}
		}
		else
		{
			$cols .= $ColumnName.",";
			if($_REQUEST["columntype".$p]=="INT" && $_REQUEST["AI".$p]=="AUTO_INCREMENT")
			{
			$coldata .= "'',";
			}
			else
			{
			$coldata .= "'".'".$'.'_REQUEST["'.$ColumnName.'"].'.'"'."',";
			}
		}
	}
	
	$precode .= "$"."insert = ".'"INSERT INTO '.$_REQUEST["mysqltable"]." (".$cols.") VALUES (".$coldata.")".';"'.";";
	
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."res = mysqli_query($db,$"."insert".");";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "if($"."res)";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t{";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "echo ".'"'."<p align='center'>Success!</p>".'"'.";";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t}";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "else";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t{";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "echo ".'"'."<p align='center'>Error! Please try again later</p>".'"'.";";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "}";
	$precode .= "\n";
	$precode .= "\n\t\t}";	
	
	$precode .= "\n";
	$precode .= "\t}";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "elseif($"."_REQUEST[".'"function"'."]==".'"delete"'.")";
	$precode .= "\n";
	$precode .= "\t{";
	$precode .= "\n";
	
	
	
	

	$precode .= "\n\t\t";
	$precode .= "$"."select = ".'"SELECT * FROM '.$_REQUEST["mysqltable"].' WHERE '.$pindex.' = '."'".'".$'.'_REQUEST["idx"]."'."'".';"'.";";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."result = mysqli_query($db,$"."select);";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."row = mysqli_fetch_array($"."result);";
	
	for($px=0; $px<$_REQUEST["tablecols"]; $px++)
	{
		
		$ffxx = explode(" ",$_REQUEST["column".$px]);
		$cxx = count($ffxx);
		$ColumnName = "";
		for($txx=0; $txx<$cxx+1; $txx++)
		{
		$ColumnName .= strtolower($ffxx[$txx]);
		}	
		
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$".$ColumnName." = $"."row[".'"'.$ColumnName.'"'."];";
	}
	
	$precode .= "\n";
	$precode .= "\n";
	

	$precode .= "\t";
	$precode .= "\t";
	$precode .= "if(".'$'."_REQUEST[".'"submitBtn"'."]==".'""'.")";
	$precode .= "\n\t\t{\n";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= 'echo "<form action='."''".' method='."'POST'".'><'.''.'table'.' '.'align='."'"."center"."'".' id='."'".'tables_css'."'".' width='."'"."600"."'".'>";';
	$precode .= "\n";

			
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "<tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
			$precode .= 'echo "<td>Are you sure you want to delete this record from the system? </td>';
			$precode .= '<td>';
			$precode .= "<input name='submitBtn' type='submit' size='25' value='Delete'>";
			$precode .= '</td>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "</tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
	$precode .= 'echo "</table></form>";';
	$precode .= "\n";
	$precode .= "\n\t\t}";
	$precode .= "\n\t\t";
	$precode .= "elseif(".'$'."_REQUEST[".'"submitBtn"'."]==".'"Delete"'.")";
	$precode .= "\n\t\t{";
	$precode .= "\n";
	
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	
	$cols = "";
	$coldata = "";
		
		$ffx = explode(" ",$_REQUEST["column".$p]);
		$cx = count($ffx);
		$ColumnName = "";
		for($tx=0; $tx<$cx+1; $tx++)
		{
		$ColumnName .= strtolower($ffx[$tx]);
		}
		
	$coldata = "'".'".$'.'_REQUEST["'.$ColumnName.'"].'.'"'."'";
	
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."delete".$p." = ".'"DELETE FROM '.$_REQUEST["mysqltable"]." WHERE ".$pindex." = '".'".$'.'_REQUEST["idx"]."'."'".';"'.";";
	
	
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."res".$p." = mysqli_query($db,$"."delete".$p.");";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "if($"."res".$p.")";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t{";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "echo ".'"'."<p align='center'>Success!</p>".'"'.";";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t}";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "else";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t{";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "echo ".'"'."<p align='center'>Error! Please try again later</p>".'"'.";";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "}";
	$precode .= "\n";	
	$precode .= "\n\t\t}";	
	
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\t}";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "elseif($"."_REQUEST[".'"function"'."]==".'"update"'.")";
	$precode .= "\n";
	$precode .= "\t{";
	$precode .= "\n";	

	$precode .= "\n\t\t";
	$precode .= "$"."select = ".'"SELECT * FROM '.$_REQUEST["mysqltable"].' WHERE '.$pindex.' = '."'".'".$'.'_REQUEST["idx"]."'."'".';"'.";";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."result = mysqli_query($db,$"."select);";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."row = mysqli_fetch_array($"."result);";
	
	for($px=0; $px<$_REQUEST["tablecols"]; $px++)
	{
		
		$ffxx = explode(" ",$_REQUEST["column".$px]);
		$cxx = count($ffxx);
		$ColumnName = "";
		for($txx=0; $txx<$cxx+1; $txx++)
		{
		$ColumnName .= strtolower($ffxx[$txx]);
		}	
		
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$".$ColumnName." = $"."row[".'"'.$ColumnName.'"'."];";
	}
	
	$precode .= "\n";
	$precode .= "\n";	
		
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "if(".'$'."_REQUEST[".'"submitBtn"'."]==".'""'.")";
	$precode .= "\n\t\t{\n";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= 'echo "<form action='."''".' method='."'POST'".'><'.''.'table'.' '.'align='."'"."center"."'".' id='."'".'tables_css'."'".' width='."'"."600"."'".'>";';
	$precode .= "\n";
	
	for($p=0; $p<$_REQUEST["tablecols"]; $p++)
	{
		if($_REQUEST["IncludeInForm".$p]=="Yes")
		{
		
		$ffx = explode(" ",$_REQUEST["column".$p]);
		$cx = count($ffx);
		$ColumnName = "";
		for($tx=0; $tx<$cx+1; $tx++)
		{
		$ColumnName .= strtolower($ffx[$tx]);
		}
		
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "<tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
			$precode .= 'echo "<td><b>';
			$precode .= $_REQUEST["column".$p];
			$precode .= ':</b> </td>';
			$precode .= '<td>';
			if($_REQUEST["FormInputType".$p]=="Text")
			{
			$precode .= "<input name='".$ColumnName."' type='text' size='25' value='".'".'."$".$ColumnName."".'."'."'>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Textarea")
			{
			$precode .= '<textarea name='."'".$ColumnName."'".' rows='."'4'".' cols='."'30'".'>".$'.$ColumnName.'."<\textarea>';
			}
			elseif($_REQUEST["FormInputType".$p]=="Checkbox")
			{
			$precode .= "<input name='".$ColumnName."' type='checkbox' size='25' value='".'".'."$".$ColumnName."".'."'."'>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Range")
			{
			$precode .= "<input name='".$ColumnName."' type='range' size='25' value='".'".'."$".$ColumnName."".'."'."' min='0' max='10'>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Select")
			{
			$precode .= "<select name='".$ColumnName."'><option value='".'".'."$".$ColumnName."".'."'."'>".'".'."$".$ColumnName."".'."'."</option></select>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Radio")
			{
			$precode .= "<input name='".$ColumnName."' type='radio' size='25' value='".'".'."$".$ColumnName."".'."'."' checked>";
			}
			elseif($_REQUEST["FormInputType".$p]=="Datearea")
			{
			$precode .= "<input name='".$ColumnName."' type='text' size='25' value='".'".'."$".$ColumnName."".'."'."'>";
			}
			$precode .= '</td>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "</tr>";';
		$precode .= "\n";
		
		}
	}
			
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "<tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
			$precode .= 'echo "<td></td>';
			$precode .= '<td>';
			$precode .= "<input name='submitBtn' type='submit' size='25' value='Submit'>";
			$precode .= '</td>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= "\t";
		$precode .= 'echo "</tr>";';
		$precode .= "\n";
		$precode .= "\t";
		$precode .= "\t";
	$precode .= 'echo "</table></form>";';
	$precode .= "\n";
	$precode .= "\n\t\t}";
	$precode .= "\n\t\t";
	$precode .= "elseif(".'$'."_REQUEST[".'"submitBtn"'."]==".'"Submit"'.")";
	$precode .= "\n\t\t{";
	$precode .= "\n";
	$precode .= "\n";
	
	
	$cols = "";
	$coldata = "";
	
	for($p=0; $p<$_REQUEST["tablecols"]; $p++)
	{
		
		$ffx = explode(" ",$_REQUEST["column".$p]);
		$cx = count($ffx);
		$ColumnName = "";
		for($tx=0; $tx<$cx+1; $tx++)
		{
		$ColumnName .= strtolower($ffx[$tx]);
		}
		
	$coldata = "'".'".$'.'_REQUEST["'.$ColumnName.'"].'.'"'."'";
	
		if($_REQUEST["IncludeInForm".$p]=="Yes")
		{
			
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	
	$precode .= "if($".$ColumnName." == $"."_REQUEST[".'"'.$ColumnName.'"'."])";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t{";
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t}";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\telse";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t{";
	
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."update".$p." = ".'"UPDATE '.$_REQUEST["mysqltable"]." SET ".$ColumnName." = ".$coldata." WHERE ".$pindex." = '".'".$'.'_REQUEST["idx"]."'."'".';"'.";";
	
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."res".$p." = mysqli_query($db,$"."update".$p.");";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "if($"."res".$p.")";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t{";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "echo ".'"'."<p align='center'>Success! ".$_REQUEST["column".$p]." has been updated.</p>".'"'.";";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t}";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "else";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t{";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "echo ".'"'."<p align='center'>Error! Please try again later</p>".'"'.";";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "}";
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "\t}";
	$precode .= "\n";
	
	if($p==($_REQUEST["tablecols"]-1))
	{
	
	}
	else
	{
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\n";
	}
	
	
		}
	}	
	
	$precode .= "\n\t\t}";	
	
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\t}";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "elseif($"."_REQUEST[".'"function"'."]==".'"list"'.")";
	$precode .= "\n";
	$precode .= "\t{";
	$precode .= "\n";
	
	
	
	

	$precode .= "\n\t\t";
	$precode .= "$"."select = ".'"SELECT * FROM '.$_REQUEST["mysqltable"].' WHERE '.$pindex.' = '."'".'".$'.'_REQUEST["idx"]."'."'".';"'.";";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."result = mysqli_query($db,$"."select);";
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$"."row = mysqli_fetch_array($"."result);";
	
	for($px=0; $px<$_REQUEST["tablecols"]; $px++)
	{
		
		$ffxx = explode(" ",$_REQUEST["column".$px]);
		$cxx = count($ffxx);
		$ColumnName = "";
		for($txx=0; $txx<$cxx+1; $txx++)
		{
		$ColumnName .= strtolower($ffxx[$txx]);
		}	
		
	$precode .= "\n";
	$precode .= "\t";
	$precode .= "\t";
	$precode .= "$".$ColumnName." = $"."row[".'"'.$ColumnName.'"'."];";
	}
	
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\n";
	$precode .= "\t}";
	$precode .= "\n";
	
	include_once "enca.php";
	
	
	
	$ff = explode(" ",$_REQUEST["title"]);
	$c = count($ff);
	$FileName = "";
	for($t=0; $t<$c+1; $t++)
	{
	$FileName .= strtolower($ff[$t]);
	}
	?>
	File Name: <input type="text" name="PageName" value="<?php echo $_REQUEST["PageName"];?>"></td>
	</tr>
	<tr><td>
	<textarea id="code" name="PageData"><?php
	if(!$_REQUEST["PageData"])
	{
	echo '<?php ';
	echo $defualt_text;
	echo '?>';
	}
	else
	{
	echo $_REQUEST["PageData"];
	}
	?></textarea></td>
	</tr><?php
		if($_REQUEST["Parent"])
		{
		$sl = "SELECT * FROM _pages WHERE misc = 'INDEX';";
		$rl = mysqli_query($db,$sl);
		@$nl = mysqli_num_rows($rl);			
			if($nl<"1")
			{
			$ckt = " checked";
			$ckt2 = "";
			}
			else
			{
			$ckt = "";
			$ckt2 = " checked";
			}
		?>		
	<tr>
		<td align="right">
		Master File Index: <input type='radio' value='INDEX' name='misc'<?php echo $ckt;?>><br>
		Ordinary File: <input type='radio' value='' name='misc'<?php echo $ckt2;?>></td>
	</tr>
		<?php 
		}
	?>
	<tr>
		<td><input type='submit' value='Create Page' name='createBtn'></td>
	</tr>
	</table></form>
	<?php
	include_once "codemirror2.php";
}
elseif($_REQUEST["createBtn"]=="Finish")
{
	//Add after selected column After
	//$sql = "ALTER TABLE mdl_assign ADD test1 INT(11) NOT NULL AFTER name, ADD test2 TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER test1, ADD test3 VARCHAR(10) NOT NULL DEFAULT \'15\' AFTER test2";
	
	//Add at begining of table
	//$sql = "ALTER TABLE `mdl_assign` ADD `test1` INT(11) NOT NULL FIRST, ADD `test2` VARCHAR(14) NOT NULL DEFAULT \'New\' AFTER `test1`, ADD `test3` TEXT NULL AFTER `test2`, ADD `test4` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `test3`";
	
	//Add at end of table
	//$sql = "ALTER TABLE `mdl_assign` ADD `test1` INT NOT NULL";
	
	$sql = "CREATE TABLE ".$_REQUEST["component"]." (";
	
	for($d=0; $d<$_REQUEST["tablecols"]; $d++)
	{	
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
		
		
		
		if($d<($_REQUEST["tablecols"]-1))
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
	$ses = md5(md5($random)."".md5($v)."".md5($_SESSION[SesUID()]));
	$ses2 = md5(md5($random2)."".md5($v)."".md5($_SESSION[SesUID()]));
	
	$dd = explode(".",$_REQUEST["PageName"]);
	$filenameB = $dd[0];
	$filetypeB = $dd[1];

	if(strtolower($filenameB)=="index")
	{		
	$page_name = $_REQUEST["PageName"];	
	}
	else
	{
	$page_name = $ses2.".".$filetypeB;	
	}
	
	$act = "Active";
	
	if($_REQUEST["Parent"])
	{		
	$sl = "SELECT * FROM _pages WHERE id = '".$_REQUEST["Parent"]."';";
	$rl = mysqli_query($db,$sl);
	@$nl = mysqli_num_rows($rl);
	@$rwl = mysqli_fetch_array($rl);
	$srcx = $rwl["src"];
	
	$msel = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$srcx."' AND meta_data = '".md5($dirIMP)."');";
	$resm = mysqli_query($db,$msel);
	@$rwm = mysqli_fetch_array($resm);
	$nml = $rwm["data"];
	
		if($nml)
		{
		$dirv = $nml."/";
		}
		else
		{
		$dirv = "";
		}
	}
	else
	{
	$dirv = "";
	}
	
	
	$sel2 = "mis/".$dirv.$page_name;
	
	
	@ $fp = fopen($sel2, "w+", 1);
	if (!$fp)
	{
	echo "<p><strong> Your file could not be created at this time. "
	."Please try again later.</strong></p>";
	}
	else
	{
		fwrite($fp, @ eregi_replace("<\textarea>","</textarea>", $_REQUEST["PageData"]));
		fclose($fp);
		
		$in = "INSERT INTO _pages (id, name, title, src, type, sidebar, parent_page, url, mode, misc, status, uid) VALUES ('', '".$filenameB."', '".$_REQUEST["title"]."', '".$ses."', '".$_REQUEST["PageType"]."', '".$_REQUEST["sidebar"]."', '".$_REQUEST["Parent"]."', '', '".$_REQUEST["Privacy"]."', '".$_REQUEST["misc"]."', '".$act."', '".$userID."');";
		$rez = mysqli_query($db,$in);
		
		$in2 = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$sel2."', '".md5($pagesIMP)."');";
		$rez2 = mysqli_query($db,$in2);
		
		if($rez && $rez2)
		{
		echo "<p><strong>Success! Your file has been created.</p>";
		}
		else
		{
		echo "<p><strong>Your file has been created, but an error took place while integrating it to the MIS.</p>";
		}
	echo "<p><strong>Success! Your file has been created.</p>";
	}
}
?>