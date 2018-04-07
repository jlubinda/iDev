<style type="text/css">
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
	<link rel=stylesheet href="plugins/codemirror/doc/docs.css">
	<script src="plugins/codemirror/lib/codemirror.js"></script>
	<link rel="stylesheet" href="plugins/codemirror/lib/codemirror.css">
	<script src="plugins/codemirror/mode/<?php echo $_REQUEST["mode"];?>/<?php echo $_REQUEST["mode"];?>.js"></script>
	<script src="plugins/codemirror/addon/search/searchcursor.js"></script>
	<script src="plugins/codemirror/addon/search/match-highlighter.js"></script>
	<script src="plugins/codemirror/addon/hint/show-hint.js"></script>
	<script src="plugins/codemirror/addon/hint/<?php echo $_REQUEST["mode"];?>-hint.js"></script>
	<script src="plugins/codemirror/addon/hint/anyword-hint.js"></script>
	<script src="plugins/codemirror/addon/selection/active-line.js"></script>
	<script src="plugins/codemirror/mode/scheme/scheme.js"></script>
	<script src="plugins/codemirror/addon/edit/closebrackets.js"></script>
	<script src="plugins/codemirror/addon/edit/closetag.js"></script>
	<script src="plugins/codemirror/mode/css/css.js"></script>
	<script src="plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script src="plugins/codemirror/addon/mode/loadmode.js"></script>
	<link rel="stylesheet" href="plugins/codemirror/addon/display/fullscreen.css">
	<link rel="stylesheet" href="plugins/codemirror/theme/night.css">
	<script src="plugins/codemirror/addon/display/fullscreen.js"></script>
	<script src="plugins/codemirror/mode/javascript/javascript.js"></script>
	<script src="plugins/codemirror/addon/display/rulers.js"></script>
	<link rel="stylesheet" href="plugins/codemirror/addon/fold/foldgutter.css">
	<link rel="stylesheet" href="plugins/codemirror/addon/dialog/dialog.css">
	<script src="plugins/codemirror/addon/search/searchcursor.js"></script>
	<script src="plugins/codemirror/addon/search/search.js"></script>
	<script src="plugins/codemirror/addon/dialog/dialog.js"></script>
	<script src="plugins/codemirror/addon/edit/matchbrackets.js"></script>
	<script src="plugins/codemirror/addon/edit/closebrackets.js"></script>
	<script src="plugins/codemirror/addon/comment/comment.js"></script>
	<script src="plugins/codemirror/addon/wrap/hardwrap.js"></script>
	<script src="plugins/codemirror/addon/fold/foldcode.js"></script>
	<script src="plugins/codemirror/addon/fold/brace-fold.js"></script>
	<script src="plugins/codemirror/keymap/sublime.js"></script>
	<script src="plugins/codemirror/addon/search/searchcursor.js"></script>
	<script src="plugins/codemirror/addon/search/search.js"></script>
	<script src="plugins/codemirror/addon/fold/xml-fold.js"></script>
	<script src="plugins/codemirror/addon/edit/matchtags.js"></script>
	<script src="plugins/codemirror/mode/xml/xml.js"></script>
	
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