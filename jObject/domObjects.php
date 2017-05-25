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

function Terminal(){
	var t = new Date();
	this.id = "terminal-" + t.getTime();
	jQuery(function($, undefined) {
    	$('#' + this.id).terminal(function(command) {
	        if (command !== '') {
	        	var response = sendCommandToKernal(command);
	        	if (response.error != null){
	        		this.echo(response.error);
	        	} else {
	        		this.echo(response.response);
	        	}
	        } else {
	           this.echo('');
	        }
	    }, {
	        greetings: 'Welcome to HaOS multi-user web OS. To join a network please type "login" or else any changes you make to this session will be destroyed.',
	        name: 'HaOS - Login Terminal',
	        prompt: 'anon@HaOS:~/'
	    });
	});
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
</script>