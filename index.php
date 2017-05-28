<?php
include 'secure.php';

if ($logged_in != true){
	header("Location: welcome");
}
include 'jObject/domObjects.php';

?>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/1.4.2/js/jquery.terminal.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/1.4.2/css/jquery.terminal.min.css" rel="stylesheet"/>
<script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>

<script src="jKernal/parser.js"></script>

<html>
	<body>

	</body>
</html>

<script>

var terminals = [];
window.$mouse = {event:'mouseUp',target:''};
var FPS = 60;
window.$millis = Math.floor(1000/FPS);
window.$currentTime = 0;

function run(){
	var t = new Date();
	t = t.getTime();
	console.log(t - window.$currentTime);
	if (t > window.$currentTime + window.$millis){
		window.$currentTime = t;
		return true;
	} else {
		return false;
	}
}

$(document).ready(function(){
	runScript("onload");
});

$(document).keydown(function(event){
	console.log(event.ctrlKey,event.keyCode);
    if (event.keyCode == 89 && event.ctrlKey){
    	var terminal_id = "terminal-" + terminals.length;
    	terminals.push(terminal_id);
        sendCommandToKernal("init $ " + terminal_id + " | Terminal");
    }
});

$(document).mouseup(function(event){
	var mX = event.pageX;
	var mY = event.pageY;
	if (window.$mouse.event == 'dragging'){
		sendCommandToKernal('stopdrag $' + window.$mouse.target + ' | ' + mX + ',' + mY);
	}

	if (window.$mouse.event == 'resizing'){
		sendCommandToKernal('stopresize $' + window.$mouse.target + ' | ' + mX + ',' + mY)
	}
	window.$mouse = {event:'mouseUp',target:''};
})

$(document).mousedown(function(event){
	window.$mouseDown = true;
	var id = event.target.id;
	var className = $('#' + id).prop('className');
	
	if (className == 'draggable'){
		window.$mouse.event = 'dragging';
		window.$mouse.target = id;
	}
	if (className == 'resizable'){
		window.$mouse.event = 'resizing';
		window.$mouse.target = id;
	}
})

$(document).mousemove(function(event){
	if (run()){
		var id = window.$mouse.target.split('-');
		id = id[0] + '-' + id[1];
		if (window.$mouse.event == 'dragging'){
			var mX = event.pageX;
			var mY = event.pageY;
			sendCommandToKernal('drag $' + id + ' | ' + mX + ',' + mY);
		}
		if (window.$mouse.event == 'resizing'){
			var mX = event.pageX;
			var mY = event.pageY;
			sendCommandToKernal('resize $' + id + ' | ' + mX + ',' + mY)
		}
	}
});

</script>

<style>


</style>