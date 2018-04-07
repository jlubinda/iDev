 <?php
 if(chkSes()=="Inactive")
{

} 
else 
{
//echo "<form action='' method='get'><div id='search_field'><input type='hidden' size='25' name='page' value='".$_REQUEST["ref"]."'><input type='hidden' size='25' name='segment' value='d1'><input type='text' size='25' name='search'><input type='submit' value='Search' name='searchBtn'></div></form>";

if($_REQUEST["ref"]=="2")
{

	$levels = $_REQUEST["level"];
	$levelsx = $_REQUEST["level"]+1;
	$level_urls = '';
	
	//echo "Levels: ".$levels."<br>";
	//echo "Level URL: ".$level_urls."<br>";
	
	
	//$dirx = ".";
	if(!$_REQUEST["level"])
	{
	$dirx = ".";
	}
	else
	{
		for($o=0; $o<($levelsx); $o++)
		{
			if($o==0)
			{
			$dirx = $_REQUEST["level".$o]."";
			}
			else
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
	?>
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
CodeMirror.modeURL = "plugins/codemirror/mode/%N/%N.js";
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
			
	echo "test: ".$sel."<br>";		
			
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
				delete_files($sel);
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
				
				//$rename = rmdir($sel);
				delete_files($sel);
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
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td align="center"><input type="file" name="newName" id="file"> &nbsp;&nbsp;<input name="submitBtn" type="submit" value="Upload"></td>
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
				 
				// echo $target."<br>";
				 
				if ($_SERVER['REQUEST_METHOD'] == 'POST') 
				{
				 	if (isset($_FILES['newName'])) 
				 	{
					     if ($_FILES['newName']['error'] === UPLOAD_ERR_OK) 
					     {
						 if(move_uploaded_file($_FILES['newName']['tmp_name'], $target))
						 {
						 //echo "";
						 $rename = "success";
						 } 
						 else
						 {
						 //echo "Sorry, there was a problem uploading your file.";
						 $rename = "";
						 }
									
						if($rename)
						{
						echo "<p align='center'>Success! The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded</p>";
						}
						else
						{
						echo "<p align='center'>Error moving file to target location!</p>";
						}
					     }
					     else 
					     {
						echo "<p align='center'>Error while uploading!</p>";
					     }
					}   
					else 
				 	{
				        	echo "<p align='center'>Error! No upload.</p>"; //... no upload at all, not even an attempt
				 	}
				}
				else 
				{
				   echo "<p align='center'>Sorry. You are only allowed to upload via POST.</p>";
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
				
				$rename = fopen($sel2,"w", TRUE);
				fclose($rename);

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