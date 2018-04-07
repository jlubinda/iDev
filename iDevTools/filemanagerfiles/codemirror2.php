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