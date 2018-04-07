<?php
if(!$_REQUEST["createBtn"] && !$_REQUEST["mode"])
{
echo "<form action='' method='post'><table align='center' id='tables_css' width='400'>";
echo "<tr>";
	echo "<td>";
		echo "<b>Title:</b>";
	echo "</td>";
	echo "<td>";
		echo "<input name='title' type='text' size='30'>";
	echo "</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "<b>Privacy Level:</b>";
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

	$bb = 0;
			$bb = $bb+1;
			echo "<tr>";
				echo "<td><b>Admin Bar:</b></td>";
				echo "<td>";
					echo "<input type='hidden' value='AdminBar0001' name='codeSidebar".$bb."'>";
					echo "<input type='checkbox' value='Yes' name='selectSidebar".$bb."'> &nbsp;&nbsp;";
					echo "Order: <input type='text' value='".$bb."' name='orderSidebar".$bb."' size='2'>";
				echo "</td>";
			echo "</tr>";

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
				
			
			if($sidebar_feature=="Yes")
			{
			$bb = $bb+1;
			echo "<tr>";
				echo "<td><b>".$plugin_name.":</b></td>";
				echo "<td>";
					echo "<input type='hidden' value='".$data."' name='codeSidebar".$bb."'>";
					echo "<input type='checkbox' value='Yes' name='selectSidebar".$bb."'> &nbsp;&nbsp;";
					echo "Order: <input type='text' value='".$bb."' name='orderSidebar".$bb."' size='2'>";
				echo "</td>";
			echo "</tr>";
			}
		}
	}
echo "<input type='hidden' value='".$bb."' name='numSidebar'>";
echo "<tr>";
	echo "<td>";
	echo "</td>";
	echo "<td>";
		echo "<input type='submit' value='Next' name='createBtn'>";
	echo "</td>";
echo "</tr>";
echo "</table></form>";
}
elseif($_REQUEST["createBtn"]=="Next" || $_REQUEST["mode"])
{
$datalinkx = "?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&PageType=".$_REQUEST["PageType"]."&Parent=".$_REQUEST["Parent"]."&sidebar=".$_REQUEST["sidebar"]."&Privacy=".$_REQUEST["Privacy"]."&title=".$_REQUEST["title"]."&mode=".$_REQUEST["mode"];
//echo "<p align='center'><a href='".$datalinkx."&pmode=auto'>Auto Input Script Type Detection (Auto Closing Tag is set ot OFF in this setting)</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$datalinkx."&pmode=static'>Programing Script Mode (Auto Closing Tag is set ot ON in this setting)</a></p>";
$datalink = "?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&PageType=".$_REQUEST["PageType"]."&Parent=".$_REQUEST["Parent"]."&sidebar=".$_REQUEST["sidebar"]."&Privacy=".$_REQUEST["Privacy"]."&title=".$_REQUEST["title"]."&pmode=".$_REQUEST["pmode"];
	

	echo "<form action='' method='post'>";
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
	include_once "cpmode.php";
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
	<?php
		//sidebar
	include_once "pmodes.php";
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
	<td><?php
	$ff = explode(" ",$_REQUEST["title"]);
	$c = count($ff);
	$FileName = "";
	for($t=0; $t<$c+1; $t++)
	{
	$FileName .= strtolower($ff[$t]);
	}
	?>
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
		$sl = "SELECT * FROM _sidebars WHERE misc = 'INDEX';";
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
		Master FIle Index: <input type='radio' value='INDEX' name='misc'<?php echo $ckt;?>><br>
		Ordinary File: <input type='radio' value='' name='misc'<?php echo $ckt2;?>></td>
	</tr>
		<?php 
		}
	?>
	<tr>
		<td><input type='submit' value='Create Page' name='createBtn'></td>
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
	$ses = md5(md5($random)."".md5($v)."".md5($_SESSION[SesUID()]));
	$ses2 = md5(md5($random2)."".md5($v)."".md5($_SESSION[SesUID()]));
	$menu_title = "IMPORT-PAGES";
		
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
		$sl = "SELECT * FROM _sidebars WHERE id = '".$_REQUEST["Parent"]."';";
		$rl = mysqli_query($db,$sl);
		@$nl = mysqli_num_rows($rl);
		@$rwl = mysqli_fetch_array($rl);
		$nml = $rwl["name"];
		
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
			fwrite($fp, $_REQUEST["PageData"]);
			fclose($fp);
			
			$in = "INSERT INTO _sidebars (id, name, title, src, type, url, mode, misc, status, uid) VALUES ('', '".$ses3."', '".$filenameB."', '".$ses."', '".$_REQUEST["PageType"]."', '', '".$_REQUEST["Privacy"]."', '".$_REQUEST["misc"]."', '".$act."', '".$userID."');";
			echo $in;
			$rez = mysqli_query($db,$in);
			
			$in2 = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$sel2."', '".md5($menu_title)."');";
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
	/*elseif($_REQUEST["PageType"]=="Master File")
	{
	$defualt_text = "\n";
	$requ = '$'.'_REQUEST'.'['.'"postPasswordBtn"'.']';
	$requ2 = '$'.'_REQUEST'.'['.'"Password"'.']';
	$requ3 = '$'.'_REQUEST'.'['.'"ref"'.']';
	$requ4 = '$'.'_REQUEST'.'['.'"segment"'.']';
		
		if($_REQUEST["Privacy"]=="Free|Open")
		{
		$defualt_text .= " if(@privacy('Free|Open')=='Granted')";
		$defualt_text .= "\n{";
		$defualt_text .= "\n";
		$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) BELOW THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) ABOVE THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "subPages(".$requ3.",".$requ4.");";
		$defualt_text .= "\n";
		$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) BELOW THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) ABOVE THIS LINE";	
		$defualt_text .= "\n";
		$defualt_text .= "\n}";
		}
		elseif($_REQUEST["Privacy"]=="Secure|Open")
		{
		$defualt_text .= " if(@ privacy('Secure|Open')=='Granted')";
		$defualt_text .= "\n{";
		$defualt_text .= "\n";
		$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) BELOW THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) ABOVE THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "subPages(".$requ3.",".$requ4.");";
		$defualt_text .= "\n";
		$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) BELOW THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) ABOVE THIS LINE";	
		$defualt_text .= "\n";
		$defualt_text .= "\n}";
		}
		elseif($_REQUEST["Privacy"]=="Secure|Priv")
		{
		$defualt_text .= " if(@ privacy('Secure|Priv')=='Granted')";
		$defualt_text .= "\n{";
		$defualt_text .= "\n";
		$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) BELOW THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) ABOVE THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "subPages(".$requ3.",".$requ4.");";
		$defualt_text .= "\n";
		$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) BELOW THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) ABOVE THIS LINE";	
		$defualt_text .= "\n";
		$defualt_text .= "\n}";
		}
		elseif($_REQUEST["Privacy"]=="Secure|Password")
		{
		$defualt_text .= "if(!".$requ." || (".$requ."=='Access Post' && !".$requ2."))\n{ \n";
		$defualt_text .= " echo @postPassword(); \n} \nelseif(".$requ."=='Access Post' && ".$requ2.")\n{\n";
		$defualt_text .= " 	if(@privacy('Secure|Password')=='Granted')";
		$defualt_text .= "\n	{";
		$defualt_text .= "\n";
		$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) BELOW THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED ABOVE THE SUBSEQUENT PAGES) ABOVE THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "subPages(".$requ3.",".$requ4.");";
		$defualt_text .= "\n";
		$defualt_text .= "//START YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) BELOW THIS LINE";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "\n";
		$defualt_text .= "//END YOUR CODE (ANY CODE THAT SHOULD BE EXCECUTED BELOW THE SUBSEQUENT PAGES) ABOVE THIS LINE";	
		$defualt_text .= "\n	}";
		$defualt_text .= "\n}\n";
		}
		
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
	$menu_title = "IMPORT-PAGES";
	
	
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
		
			fwrite($fp, $pageData);
			fclose($fp);
			
			mkdir("mis/".$ses3);
			
			$in = "INSERT INTO _sidebars (id, name, title, src, type, url, mode, misc, status, uid) VALUES ('', '".$ses3."', '".$filenameB."', '".$ses."', '".$_REQUEST["PageType"]."', '', '".$_REQUEST["Privacy"]."', '".$_REQUEST["misc"]."', '".$act."', '".$userID."');";
			$rez = mysqli_query($db,$in);
			
			$in2 = "INSERT INTO meta (id, userid, data, meta_data) VALUES ('', '".$ses."', '".$sel2."', '".md5($menu_title)."');";
			$rez2 = mysqli_query($db,$in2);
			
			if($rez && $rez2)
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
	elseif($_REQUEST["PageType"]=="Calendar")
	{
	
	}*/
}
?>