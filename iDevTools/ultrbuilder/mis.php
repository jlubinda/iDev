 <?php
 if(chkSes()=="Inactive")
{

} 
else 
{
?>
<?php
if($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="a1")
{

	$levels = $_REQUEST["level"];
	$levelsx = $_REQUEST["level"]+1;
	$level_urls = '';
	
	
	//$dirx = ".";
	$root_dir = "mis";
	
	if(!$_REQUEST["level"])
	{
	$dirx = $root_dir;
	}
	else
	{
	$dirx = $root_dir;
	
		for($o=0; $o<($levels); $o++)
		{
				if($_REQUEST["level".$o])
				{
				$dirx .= "/".$_REQUEST["level".$o]."";
				}
				else
				{
				$dirx .= "";
				}
		}
	}

	
  if($_REQUEST["function"]=="list")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		include_once "dirlist.php";
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
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
	
			if($_REQUEST["type"]=="folder")
			{
			$typedis = "folder ";
			$namedis = $_REQUEST["unitclass"];
			$namedis2 = $_REQUEST["newName"];
			}
			else
			{
			$typedis = $_REQUEST["type"]." file ";
			$namedis = $_REQUEST["unitclass"].".".$_REQUEST["type"];
			$namedis2 = $_REQUEST["newName"].".".$_REQUEST["type"];
			}
			
			
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				$selurl = $dirx."/";
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				$selurl = $dirx."/";
				}			
				
			echo "<p align='center'>".$sel."</p>";
			
		if(!$_REQUEST["submitBtn"])
		{
		echo "<form action='' method='post'>";
		
	include_once "codemirror.php";
?><style type="text/css">
	<!--
	#tierPm div{
	display: none;
	}
	
	#tierPm{
	position: relative;
	width: 150px;
	height: 30px;
	padding: 10px;
	color: #000000;
	text-decoration: none;
	z-index: 999;
	}

	#tierPm:hover {
	color: #000000;
	}

	#tierPm a:hover{
	color: #000000;
	background:none;
	}

	#tierPm a{
	color:#000000;
	background:none;
	font-style: normal;
	font-weight:bold;
	font-variant: normal;
	}
	
	#tierPm2{
	position: relative;
	width: 900px;
	height: 200px;
	top: 1px;
	padding: 10px;
	color: #000000;
	left:0;
	text-decoration: none;
	display: block;
	}

	#tierPm2:hover {
	color: #000000;
	display: block;
	}

	#tierPm2 a:hover{
	color: #000000;
	background:#00FFF;
	font-style: normal;
	font-weight:bold;
	font-variant: normal;
	text-decoration: none;
	}

	#tierPm2 a{
	color:#000000;
	background:none;
	font-style: normal;
	font-weight:bold;
	font-variant: normal;
	text-decoration: none;
	}

	-->
    </style><?php
	//include_once "cpmode.php";
	?>
	<link rel=stylesheet href="codemirror/doc/docs.css">
	<script src="codemirror/lib/codemirror.js"></script>
	<link rel="stylesheet" href="codemirror/lib/codemirror.css">
	<script src="codemirror/mode/<?php echo $_REQUEST["mode"];?>/<?php echo $_REQUEST["mode"];?>.js"></script>
	<script src="codemirror/addon/search/searchcursor.js"></script>
	<script src="codemirror/addon/search/match-highlighter.js"></script>
	<script src="codemirror/addon/hint/show-hint.js"></script>
	<script src="codemirror/addon/hint/<?php echo $_REQUEST["mode"];?>-hint.js"></script>
	<script src="codemirror/addon/hint/anyword-hint.js"></script>
	<script src="codemirror/addon/selection/active-line.js"></script>
	<script src="codemirror/mode/scheme/scheme.js"></script>
	<script src="codemirror/addon/edit/closebrackets.js"></script>
	<script src="codemirror/addon/edit/closetag.js"></script>
	<script src="codemirror/mode/css/css.js"></script>
	<script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script src="codemirror/addon/mode/loadmode.js"></script>
	<link rel="stylesheet" href="codemirror/addon/display/fullscreen.css">
	<link rel="stylesheet" href="codemirror/theme/night.css">
	<script src="codemirror/addon/display/fullscreen.js"></script>
	<script src="codemirror/mode/javascript/javascript.js"></script>
	<script src="codemirror/addon/display/rulers.js"></script>
	<link rel="stylesheet" href="codemirror/addon/fold/foldgutter.css">
	<link rel="stylesheet" href="codemirror/addon/dialog/dialog.css">
	<script src="codemirror/addon/search/searchcursor.js"></script>
	<script src="codemirror/addon/search/search.js"></script>
	<script src="codemirror/addon/dialog/dialog.js"></script>
	<script src="codemirror/addon/edit/matchbrackets.js"></script>
	<script src="codemirror/addon/edit/closebrackets.js"></script>
	<script src="codemirror/addon/comment/comment.js"></script>
	<script src="codemirror/addon/wrap/hardwrap.js"></script>
	<script src="codemirror/addon/fold/foldcode.js"></script>
	<script src="codemirror/addon/fold/brace-fold.js"></script>
	<script src="codemirror/keymap/sublime.js"></script>
	<script src="codemirror/addon/search/searchcursor.js"></script>
	<script src="codemirror/addon/search/search.js"></script>
	<script src="codemirror/addon/fold/xml-fold.js"></script>
	<script src="codemirror/addon/edit/matchtags.js"></script>
	<script src="codemirror/mode/xml/xml.js"></script>	
	<script src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/> 
<script src="js/jquery-ui.min.js"></script>
	<style type="text/css">
		  .CodeMirror {
			border: 1px solid #eee;
			height: auto;
		  }
		  .CodeMirror-scroll {
			overflow-y: hidden;
			overflow-x: auto;
		  }
		  .breakpoints {width: .8em;}
		  .breakpoint { color: #822; }
		  .CodeMirror {border: 1px solid black;}
		  .CodeMirror-focused .cm-matchhighlight {
			background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAFklEQVQI12NgYGBgkKzc8x9CMDAwAAAmhwSbidEoSQAAAABJRU5ErkJggg==);
			background-position: bottom;
			background-repeat: repeat-x;
		  }
    </style><body  onload="change()">
	<table align="center" bgcolor='#fcfcfc' id='tables_css'>
	<tr><td>
	<textarea id="code" name="newName"><?php
					/*Open handle to file */
$fp = fopen($sel, 'r', TRUE);
/* Read all lines and print them */
while (!feof($fp)) {
$line = htmlentities(trim(fgets($fp, 512)));
echo "$line\n";
}
/* Close the stream handle */
fclose($fp);
	?></textarea></td>
	</tr>
	<tr>
		<td><input type='submit' value='Save' name='submitBtn'></td>
	</tr>
	</table></form>

    <script>eval(document.getElementById("code").value);</script>
<script>
CodeMirror.modeURL = "codemirror/mode/%N/%N.js";
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
	value: "<html>\n  " + document.documentElement.innerHTML + "\n</html>",
	lineNumbers: true,
	highlightSelectionMatches: {showToken: /\w/},
	extraKeys: {"Ctrl-Space": "autocomplete"},
	styleActiveLine: true,
	lineNumbers: true,
	lineWrapping: true,	
	iewportMargin: Infinity,
    keyMap: "sublime",
    autoCloseBrackets: true,
    matchBrackets: true,
    showCursorWhenSelecting: true,
	gutters: ["CodeMirror-linenumbers", "breakpoints"],
    matchTags: {bothTags: true},
	autoCloseTags: true,
    extraKeys: {
        "F11": function(cm) {
          cm.setOption("fullScreen", !cm.getOption("fullScreen"));
        },
        "Esc": function(cm) {
          if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
        },
		"Ctrl-J": "toMatchingTag",
      }
  });

var modeInput = document.getElementById("mode");
CodeMirror.on(modeInput, "keypress", function(e) {
  if (e.keyCode == 13) change();
});
function change() {
   editor.setOption("mode", modeInput.value);
   CodeMirror.autoLoadMode(editor, modeInput.value);
}
editor.on("gutterClick", function(cm, n) {
  var info = cm.lineInfo(n);
  cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
});

function makeMarker() {
  var marker = document.createElement("div");
  marker.style.color = "#822";
  marker.innerHTML = "+";
  return marker;
}

  var value = "// The bindings defined specifically in the Sublime Text mode\nvar bindings = {\n";
  var map = CodeMirror.keyMap.sublime, mapK = CodeMirror.keyMap["sublime-Ctrl-K"];
  for (var key in map) {
    if (key != "Ctrl-K" && key != "fallthrough" && (!/find/.test(map[key]) || /findUnder/.test(map[key])))
      value += "  \"" + key + "\": \"" + map[key] + "\",\n";
  }
  for (var key in mapK) {
    if (key != "auto" && key != "nofallthrough")
      value += "  \"Ctrl-K " + key + "\": \"" + mapK[key] + "\",\n";
  }
  value += "}\n\n// The implementation of joinLines\n";
  value += CodeMirror.commands.joinLines.toString().replace(/^function\s*\(/, "function joinLines(").replace(/\n  /g, "\n") + "\n";
</script>

<script>
$(function() {
var availableTags = ["<a href='jQuery.com", "<a href='jQueryUI.com", "<a href='jQueryMobile.com", "<a href='jQueryScript.net", "<a href='jQuery", "<a href='Free jQuery Plugins"]; // array of autocomplete words
var minWordLength = 2;
function split(val) {
return val.split("<a href=");
}
 
function extractLast(term) {
return split(term).pop();
}
$("#code") // jQuery Selector
// don't navigate away from the field on tab when selecting an item
.bind("keydown", function(event) {
if (event.keyCode === $.ui.keyCode.TAB && $(this).data("ui-autocomplete").menu.active) {
event.preventDefault();
}
}).autocomplete({
minLength: minWordLength,
source: function(request, response) {
// delegate back to autocomplete, but extract the last term
var term = extractLast(request.term);
if(term.length >= minWordLength){
response($.ui.autocomplete.filter( availableTags, term ));
}
},
focus: function() {
// prevent value inserted on focus
return false;
},
select: function(event, ui) {
var terms = split(this.value);
// remove the current input
terms.pop();
// add the selected item
terms.push(ui.item.value);
// add placeholder to get the comma-and-space at the end
terms.push("");
this.value = terms.join("'>");
return false;
}
});
});
</script>
<?php
		}
		elseif($_REQUEST["submitBtn"]=="Save")
		{
			/*
				if(!$_REQUEST["unitdir"])
				{
				$sel = "mis/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = "mis/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
				else
				{
				$sel = "mis/".$_REQUEST["unitdir"]."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = "mis/".$_REQUEST["unitdir"]."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}	*/		
				
				$fp = fopen($sel, "w", 1);
$filelock = flock($fp, 2); // lock the file for writing
$rename = fwrite($fp, $_REQUEST["newName"]);
$fileunlock = flock($fp, 3); // release write lock
fclose($fp);
			

			//echo $_REQUEST["type"]." - type<br>";
			
			if($rename)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
			
			echo "<p align='center'><a href=''>Back</a></p>";
		}
	}
	else
	{
	//Security Breach
	include_once "iDevTools/access_denied.php";
	//Security Breach
	}
  }
  elseif($_REQUEST["function"]=="unzip")
  {
  
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/";
			
			
			
$zip = new ZipArchive;
if ($zip->open($sel) === TRUE) {
    $zip->extractTo($sel2);
    $zip->close();
    echo '<p align="center">Success!</p>';
} else {
    echo '<p align="center">Error!</p>';
}

  }
  elseif($_REQUEST["function"]=="multidelete")
  {
	$oc = 0;
		for($oc1=0; $oc1<$_REQUEST["numfiles"]; $oc1++)
		{	
		$oc = $oc+1;
		  if($_REQUEST["delete".$oc]=="Yes")
		  {
			if($_REQUEST["type".$oc]=="folder")
			{
				$sel = $dirx."/".$_REQUEST["filename".$oc];
				
				$rename = rmdir($sel);
			}
			else
			{
				$sel = $dirx."/".$_REQUEST["filename".$oc];
				
				$rename = unlink($sel);
			}

			
			if($rename)
			{
			echo "<p align='center'>Successfully deleted ".$_REQUEST["filename".$oc]."!</p>";
			}
			else
			{
			echo "<p align='center'>Error deleting ".$_REQUEST["filename".$oc]."!</p>";
			}
		  }
		}
  }
  elseif($_REQUEST["function"]=="rename")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		if(!$_REQUEST["submitBtn"])
		{
			if($_REQUEST["type"]=="folder")
			{
			$typedis = "folder ";
			$namedis = $_REQUEST["unitclass"];
			}
			else
			{
			$typedis = $_REQUEST["type"]." file ";
			$namedis = $_REQUEST["unitclass"].".".$_REQUEST["type"];
			}
			?>
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center">Provide a new name for the <?php echo $typedis; ?> '<?php echo $namedis; ?>' <input name="newName" type="text" size="25"><input name="submitBtn" type="submit" value="Rename"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Rename")
		{
			if($_REQUEST["type"]=="folder")
			{
			$typedis = "folder ";
			$namedis = $_REQUEST["unitclass"];
			$namedis2 = $_REQUEST["newName"];
			}
			else
			{
			$typedis = $_REQUEST["type"]." file ";
			$namedis = $_REQUEST["unitclass"].".".$_REQUEST["type"];
			$namedis2 = $_REQUEST["newName"].".".$_REQUEST["type"];
			}
			?>
			<form action="" method="POST">
			<input name="newName" type="hidden" value="<?php echo $_REQUEST["newName"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center">Confirm the renaming of the <?php echo $typedis; ?> '<?php echo $namedis; ?>' to '<?php echo $namedis2; ?>' <input name="submitBtn" type="submit" value="Confirm"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm")
		{
			
			if(!$_REQUEST["type"]=="folder")
			{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
			}
			else
			{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
				else
				{
				$sel = $dirx."/";
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}
			}
			
			$rename = rename($sel,$sel2);
			
			if($rename)
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
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		if(!$_REQUEST["submitBtn"])
		{
			if($_REQUEST["type"]=="folder")
			{
			$typedis = "folder ";
			$namedis = $_REQUEST["unitclass"];
			$namedis2 = $_REQUEST["newName"];
			}
			else
			{
			$typedis = $_REQUEST["type"]." file ";
			$namedis = $_REQUEST["unitclass"].".".$_REQUEST["type"];
			$namedis2 = $_REQUEST["newName"].".".$_REQUEST["type"];
			}
			?>
			<form action="" method="POST">
			<input name="newName" type="hidden" value="<?php echo $_REQUEST["newName"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center">Confirm the deleting of the <?php echo $typedis; ?> '<?php echo $namedis; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Delete")
		{
			
			if($_REQUEST["type"]=="folder")
			{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}			
				
				$rename = rmdir($sel);
			}
			else
			{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				}			
				
				$rename = unlink($sel);
				
				$delY = "SELECT * FROM meta WHERE data like '%".$_REQUEST["unitclass"]."%';";
				$delYr = mysqli_query($db,$delY);
				$delYrw = mysqli_fetch_array($delYr);
				$rwYr = $delYrw["userid"];
				
				$delX = "DELETE FROM _pages WHERE src = '".$rwYr."'";
				$resX = mysqli_query($db,$delX);
				
				$delX2 = "DELETE FROM meta WHERE userid = '".$rwYr."'";
				$resX2 = mysqli_query($db,$delX2);
			}

			//echo $_REQUEST["type"]." - type<br>";
			
			if($rename)
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
  elseif($_REQUEST["function"]=="upload")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		//if(!$_REQUEST["submitBtn"])
		//{
			if($_REQUEST["type"]=="folder")
			{
			$typedis = "folder ";
			$namedis = $_REQUEST["unitclass"];
			$namedis2 = $_REQUEST["newName"];
			}
			else
			{
			$typedis = $_REQUEST["type"]." file ";
			$namedis = $_REQUEST["unitclass"].".".$_REQUEST["type"];
			$namedis2 = $_REQUEST["newName"].".".$_REQUEST["type"];
			}
			?>
			<form action="" method="POST" enctype="multipart/form-data">
			<table align="center" width="300" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="left"><input type="file" name="newName" id="file"></td>
				</tr>
				<tr>
					<td align="left"><select name="register"><option value="Register">Register Upload As Part of MIS</option><option value="Do Not Register">Do Not Register Upload As Part of MIS</option></select></td>
				</tr>
				<tr>
					<td align="left">					
					<select name='Privacy'>";
						<option value='Free|Open'>Open To All</option>
						<option value='Secure|Open'>Logged In Access</option>
						<option value='Secure|Priv'>Available To Specific User Group</option>
						<option value='Secure|Password'>Password Access Only</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="left"><input name="submitBtn" type="submit" value="Upload"></td>
				</tr>
			</table>
			</form>
			<?php
		//}
		
		if($_REQUEST["submitBtn"]=="Upload")
		{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				$sel2x = $dirx."/";
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitclass"].".".$_REQUEST["type"];
				$sel2 = $dirx."/".$_REQUEST["newName"].".".$_REQUEST["type"];
				$sel2x = $dirx."/";
				}		

 $target = $sel2x; 
 $target = $target . basename( $_FILES['newName']['name']) ;
 
 if(move_uploaded_file($_FILES['newName']['tmp_name'], $target)) 
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
	$menu_title = "IMPORT-PAGES";
		
		$dd = explode(".",$_FILES['newName']['name']);
		$filenameB = $dd[0];
		$filetypeB = $dd[1];
		
		if(strtolower($filenameB)=="index")
		{		
		$sel2 = $dirx."/".$_FILES['newName']['name'];	
		}
		else
		{
		$sel2 = $dirx."/".$ses2.".".$filetypeB;		
		rename($target,$sel2);
		}
		
		if($_REQUEST["register"]=="Register")
		{
		$act = "Active";
		}
		else
		{
		$act = "Dormant";
		}
	
		$in = "INSERT INTO _pages (id, name, title, src, type, sidebar, parent_page, url, mode, misc, status, uid) VALUES ('', '".$ses3."', '".$filenameB."', '".$ses."', 'File', '".$_REQUEST["sidebar"]."', '".$_REQUEST["Parent"]."', '', '".$_REQUEST["Privacy"]."', '', '".$act."', '".$userID."');";
		$rez = mysqli_query($db,$in);
		
		$in2 = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$sel2."', '".md5($menu_title)."');";
		$rez2 = mysqli_query($db,$in2);
		
	echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded";
	$rename = "success";
 } 
 else 
 {
 echo "Sorry, there was a problem uploading your file.";
 $rename = "";
 }
			
			if($rename)
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
  elseif($_REQUEST["function"]=="create_file")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
if(!$_REQUEST["createBtn"])
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
			echo "<option value='File'>File</option>";
			echo "<option value='Post'>Post</option>";
			echo "<option value='Gallery'>Gallery</option>";
			echo "<option value='Calendar'>Calendar</option>";
		echo "</select>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Privacy Level:";
	echo "</td>";
	echo "<td>";	
		echo "<select name='Privacy'>";
			echo "<option value='Free|Open'>Open To All</option>";
			echo "<option value='Secure|Open'>Logged In Access</option>";
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
		echo "Parent Page:";
	echo "</td>";
	echo "<td>";
		echo "<select name='Parent'>";
			echo "<option value=''></option>";
			$se = "SELECT * FROM _pages;";
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
elseif($_REQUEST["createBtn"]=="Next")
{

	if($_REQUEST["PageType"]=="File")
	{
	?>
	<script type="text/javascript">
	// Auto-Grow-TextArea script.
	// Script copyright (C) 2011 www.cryer.co.uk.
	// Script is free to use provided this copyright header is included.
	function AutoGrowTextArea(textField)
	{
	  if (textField.clientHeight < textField.scrollHeight)
	  {
		textField.style.height = textField.scrollHeight + "px";
		if (textField.clientHeight < textField.scrollHeight)
		{
		  textField.style.height = 
			(textField.scrollHeight * 2 - textField.clientHeight) + "px";
		}
	  }
	}
	</script><?php
	$defualt_text = "\n";
	$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
	$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
	
	if($_REQUEST["Privacy"]=="Free|Open")
	{
	$defualt_text .= " if(privacy('Free|Open')=='Granted');";
	$defualt_text .= "\n{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE ABOVE THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n}";
	}
	elseif($_REQUEST["Privacy"]=="Secure|Open")
	{
	$defualt_text .= " if(privacy('Secure|Open')=='Granted');";
	$defualt_text .= "\n{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE ABOVE THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n}";
	}
	elseif($_REQUEST["Privacy"]=="Secure|Priv")
	{
	$defualt_text .= " if(privacy('Secure|Priv')=='Granted');";
	$defualt_text .= "\n{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE ABOVE THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n}";
	}
	elseif($_REQUEST["Privacy"]=="Secure|Password")
	{
	$defualt_text .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
	$defualt_text .= " echo postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
	$defualt_text .= " 	if(privacy('Secure|Password')=='Granted')";
	$defualt_text .= "\n	{";
	$defualt_text .= "\n";
	$defualt_text .= "//START YOUR CODE BELOW THIS LINE";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "\n";
	$defualt_text .= "//END YOUR CODE ABOVE THIS LINE";
	$defualt_text .= "\n	}";
	$defualt_text .= "\n}\n";
	}
	?>
	<form action="" method="post">
	<input type="hidden" name="title" value="<?php echo $_REQUEST["title"];?>">
	<input type="hidden" name="PageType" value="<?php echo $_REQUEST["PageType"];?>">
	<input type="hidden" name="Privacy" value="<?php echo $_REQUEST["Privacy"];?>">
	<input type="hidden" name="sidebar" value="<?php echo $_REQUEST["sidebar"];?>">
	<input type="hidden" name="Parent" value="<?php echo $_REQUEST["Parent"];?>">
	<table align="center">
	<tr>
	<td>
	File Name: <input type="text" name="PageName" value="<?php echo $_REQUEST["PageName"];?>"></td>
	</tr>
	<tr><td>
	<textarea cols="120" rows="3" onkeyup="AutoGrowTextArea(this)" id="textarea1" name="PageData"><?php
	echo '<?php ';
	echo $defualt_text;
	echo '?>';
	?></textarea>
	<script type="text/javascript">
	AutoGrowTextArea(document.getElementById("textarea1"));
	</script></td>
	</tr>
	<tr>
		<td><input type='submit' value='Create Page' name='createBtn'></td>
	</tr>
	</table></form>
	<?php
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
	</trM
	</table></form>  
	<?php
	}
	elseif($_REQUEST["PageType"]=="Gallery")
	{
	
	}
	elseif($_REQUEST["PageType"]=="Calendar")
	{
	
	}
}
elseif($_REQUEST["createBtn"]=="Create Page")
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
		$ses = md5(md5($random)."".md5($v)."".md5(SesVar()));
		$ses2 = md5(md5($random2)."".md5($v)."".md5(SesVar()));
		$menu_title = "IMPORT-PAGES";
			
			$dd = explode(".",$_REQUEST["PageName"]);
			$filenameB = $dd[0];
			$filetypeB = $dd[1];
			
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"];
				$sel2 = $dirx."/".$ses2.".".$filetypeB;
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitdir"];
				$sel2 = $dirx."/".$ses2.".".$filetypeB;
				}		
				
				$rename = fopen($sel2,"w+", TRUE);
				fwrite($rename, $_REQUEST["PageData"]);
				fclose($rename);

			
			if($rename)
			{
				$in = "INSERT INTO _pages (id, name, title, src, type, sidebar, parent_page, url, mode, misc, status, uid) VALUES ('', '".$ses2."', '".$filenameB."', '".$ses."', '".$_REQUEST["PageType"]."', '".$_REQUEST["sidebar"]."', '".$_REQUEST["Parent"]."', '', '".$_REQUEST["Privacy"]."', '', 'Active', '".$userID."');";
				$rez = mysqli_query($db,$in);
				
				$in2 = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$sel2."', '".md5($menu_title)."');";
				$rez2 = mysqli_query($db,$in2);
				
				if($rez && $rez2)
				{
				echo "<p align='center'>Success!</p>";
				}
				else
				{
				unlink($sel2);
				echo "<p align='center'>Error!</p>";
				}
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
	}
	elseif($_REQUEST["PageType"]=="Post")
	{	
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
		$menu_title = "IMPORT-PAGES";

			$in = "INSERT INTO _pages (id, name, title, src, type, sidebar, parent_page, url, mode, misc, status, uid) VALUES ('', '', '".$_REQUEST["title"]."', '".$ses."', '".$_REQUEST["PageType"]."', '".$_REQUEST["sidebar"]."', '".$_REQUEST["Parent"]."', '', '".$_REQUEST["Privacy"]."', '', 'Active', '".$userID."');";
			$rez = mysqli_query($db,$in);
			
			$in2 = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$_REQUEST["PageData"]."', '".md5($menu_title)."');";
			$rez2 = mysqli_query($db,$in2);
			
			if($rez && $rez2)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
	}
	elseif($_REQUEST["PageType"]=="Gallery")
	{
	
	}
	elseif($_REQUEST["PageType"]=="Calendar")
	{
	
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
  elseif($_REQUEST["function"]=="create_folder")
  {
	if(!$bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
		if(!$_REQUEST["submitBtn"])
		{
			if($_REQUEST["type"]=="folder")
			{
			$typedis = "folder ";
			$namedis = $_REQUEST["unitclass"];
			$namedis2 = $_REQUEST["newName"];
			}
			else
			{
			$typedis = $_REQUEST["type"]." file ";
			$namedis = $_REQUEST["unitclass"].".".$_REQUEST["type"];
			$namedis2 = $_REQUEST["newName"].".".$_REQUEST["type"];
			}
			?>
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center"><input name="newName" type="text" size="30"> <input name="submitBtn" type="submit" value="Create"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Create")
		{
				if(!$_REQUEST["unitdir"])
				{
				$sel = $dirx."/".$_REQUEST["unitclass"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}
				else
				{
				$sel = $dirx."/".$_REQUEST["unitdir"];
				$sel2 = $dirx."/".$_REQUEST["newName"];
				}			
				
				$rename = mkdir($sel2);

			//echo $_REQUEST["type"]." - type<br>";
			
			if($rename)
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
?>