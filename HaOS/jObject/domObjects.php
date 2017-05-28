<script>

function Background(id){
	this.id = id;
	this.height = '100%';
	this.width = '100%';
	this.color = "gray";
	this.html = "<div id='" + id + "' style='position:absolute;top:0;height:" + this.height + ";width:" + this.width + "'></div>";
	console.log(this.html);
	$('body').append(this.html);
}

Background.prototype.setColor = function(color){
	this.color = color;
	console.log($('#' + this.id).css('background-color'));
	$('#' + this.id).css('background-color',this.color);
}
window.$vars = {};




function Terminal(id){
	this.id = id;
	this.commands = [];
	this.width = 500;
	this.height = 200;
	this.tX = 300;
	this.tY = 100;
	this.deltaX = 0;
	this.deltaY = 0;
	this.minWidth = 200;
	this.minHeight = 50;
	this.html = "<div class='draggable' id='" + this.id + "' style='cursor:grab;position:absolute;background-color:#17003d;top:" + this.tY + "px;left:" + this.tX + "px;height:20px;width:"+this.width+"px;border:1px solid black'><h3 style='color:#7142f4;float:right;margin-top:-5px;' id='" + this.id + "-exit'>&#9746;</h3><div id='" + this.id + "-cont' style='left:-1px;top:20px;position:absolute;height:"+ this.height +"px;width:"+this.width+"px;background-color:#095ab7;border:1px solid black'><h4 style='position:absolute:bottom:0;color:#00c660;width:50px;display:inline'>Anon@HaOS:~/</h4>&nbsp;<input spellcheck='false' id='" + this.id + "-input' type='text' style='position:absolute;" + (this.width * .7) + "px;background-color:#095ab7;color:#00c660;border:0px' value=''><textarea resizable='false' readonly spellcheck='false' id='" + this.id + "-output' style='width:" + this.width +"px;height:" + (this.height-20) + "px;background-color:#095ab7;color:#00c660;border: 0px'></textarea><h3 class='resizable' id='" + this.id + "-resize' style='color:#7142f4;cursor:se-resize;float:right;position:absolute;bottom:-18px;right:0'>&nbsp;&nbsp;&nbsp;&nbsp;</h3></div></div>"; 
	$('body').append(this.html);
	//$('#' + this.id + "-input");
	//console.log($('#' + this.id + '-input'));
	window.$vars[this.id] = {index:-1,commands:[],tX:this.tX,tY:this.tY,xDelta:0,yDelta:0};
	$('#' + this.id + '-exit').bind({
		click:function(){
			$(this).parent('div','span').remove();
		}
	});
	$('#' + this.id + '-input').bind({

		keydown:function(event){
			var id = this.id.split('-');
			id = id[0] + '-' + id[1];
			if (event.keyCode == 13){
				var cmd = $('#' + id + "-input" ).val();
				$('#' + this.id).val('');
				if (cmd.split(' ').join('') != ""){
					window.$vars[id].index = window.$vars[id].commands.length;
					window.$vars[id].commands.push(cmd);
				}
				$('#' + id + '-output').html('>> ' + cmd + "\n" + $('#' + id + '-output').html());
			}

			if (event.keyCode == 38){
				if (window.$vars[id].index > 0){
					window.$vars[id].index -= 1;
					$('#' + id + '-input').val(window.$vars[id].commands[window.$vars[id].index]);
				}
				
			}
			if (event.keyCode == 40){
				if (window.$vars[id].index < window.$vars[id].commands.length-1){
					window.$vars[id].index += 1;
					$('#' + id + '-input').val(window.$vars[id].commands[window.$vars[id].index]);
				}
				
				if (window.$vars[id].index == window.$vars[id].commands.length-1){
					$('#' + id + '-input').val('');
					window.$vars[id].index = window.$vars[id].commands.length;
				}
			} 
		}
	});

	$('#' + this.id).bind({
		click:function(event){
			var id = this.id.split('-');
			id = id[0] + '-' + id[1] + '-input';
			if ($("#" + id).is(":focus") == false ){
				this.parentNode.appendChild(this);
				$('#' + id).focus();
			}			
		},
		mousedown:function(event){
			this.deltaX = event.pageX - this.tX;
			this.deltaY = event.pageY - this.tY;
		}

	});


	$('#' + this.id + '-input').val('');
}

Terminal.prototype.drag = function(mX,mY){
	if (mX > 0 && mY > 0){
		if (this.deltaX == 0 || this.deltaY == 0){
			this.deltaX = mX - this.tX;
			this.deltaY = mY - this.tY;
		}

		var tX = mX - this.deltaX
		var tY = mY - this.deltaY

		$('#' + this.id).css('left',tX + 'px');
		$('#' + this.id).css('top', tY + 'px');
		console.log(tX,tY,this.deltaX,this.deltaY);
	}
}

Terminal.prototype.stopdrag = function(mX,mY){

	this.tY = $('#' + this.id).css('top');
	this.tX = $('#' + this.id).css('left');
	this.tY = parseInt(this.tY.substring(0,this.tY.length-2));
	this.tX = parseInt(this.tX.substring(0,this.tX.length-2));

	this.deltaX = 0;
	this.deltaY = 0; 

}

Terminal.prototype.resize = function(mX,mY){
	this.tY = $('#' + this.id).css('top');
	this.tX = $('#' + this.id).css('left');
	this.tY = parseInt(this.tY.substring(0,this.tY.length-2));
	this.tX = parseInt(this.tX.substring(0,this.tX.length-2));
	var height = mY - this.tY;
	var width = mX - this.tX;


	if (width > this.minWidth){
		$('#' + this.id).css('width',width + 'px');
		$('#' + this.id + '-cont').css('width',width+'px');
		$('#' + this.id + '-input').css('width',Math.floor(width - 150) +'px');
		$('#' + this.id + '-output').css('width',width+'px');

	}
	if (height > this.minHeight){
		$('#' + this.id + '-cont').css('height',height+'px');
		$('#' + this.id + '-output').css('height',(height-20)+'px');
	}

}

function Bar_bottom(id){
	this.id = id;
	this.height = '50px';
	this.width = '100%';

	this.html = "<div id='" + this.id + "' style='height:" + this.height + ";width:" + this.width + ";position:absolute;bottom:0'></div>";
	$('body').append(this.html);

}

Bar_bottom.prototype.setColor = function(color){
	$('#' + this.id).css('background-color',color);
}


function Bar_top(id){
	this.id = id;
	this.height = '50px';
	this.width = '100%';

	this.html = "<div id='" + this.id + "' style='height:" + this.height + ";width:" + this.width + ";position:absolute;top:0'></div>";
	$('body').append(this.html);

}

Bar_top.prototype.setColor = function(color){
	$('#' + this.id).css('background-color',color);
}

function Bar_right(id){
	this.id = id;
	this.height = '100%';
	this.width = '50px';

	this.html = "<div id='" + this.id + "' style='height:" + this.height + ";width:" + this.width + ";position:absolute;right:0;top:0'></div>";
	$('body').append(this.html);

}

Bar_right.prototype.setColor = function(color){
	$('#' + this.id).css('background-color',color);
}

function Bar_left(id){
	this.id = id;
	this.height = '100%';
	this.width = '50px';

	this.html = "<div id='" + this.id + "' style='height:" + this.height + ";width:" + this.width + ";position:absolute;left:0;top:0'></div>";
	$('body').append(this.html);
}

Bar_left.prototype.setColor = function(color){
	$('#' + this.id).css('background-color',color);
}

function Form(id){

}
</script>

<style>

input:focus,textarea:focus {
	outline:none;
}

textarea{
	resize:none;
}
</style>