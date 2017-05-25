	var objects = {
		Background:{
			init_params:1,
			id_required:true,
			functions:[
				{setColor:1}
			]
		},
		Bottom_bar:{
			init_params:1,
			id_required:true,
			functions:[
				{setColor:1}
			]
		},
		Left_bar:{
			init_params:1,
			id_required:true,
			functions:[
				{setColor:1}
			]
		},
		Top_bar:{
			init_params:1,
			id_required:true,
			functions:[
				{setColor:1}
			]
		},
		Right_bar:{
			init_params:1,
			id_required:true,
			functions:[
				{setColor:1}
			]
		},
		Terminal:{
			init_params:0,
			id_required:false,
			functions:[
				{setColor:1}
			]
		}
	}
	var commands = {
		help:{
			object_id:false,
			user_id:false,
			login_required:false,
			variables:0
		},
		mkdir:{
			object_id:false,
			user_id:false,
			login_required:false,
			variables:1
		},
		cd:{
			object_id:false,
			user_id:false,
			login_required:false,
			variables:1
		},
		ls:{
			object_id:false,
			user_id:false,
			login_required:false,
			variables:0
		},
		login:{
			object_id:false,
			user_id:false,
			login_required:false,
			variables:0
		},
		init:{
			object_id:true,
			user_id:false,
			login_required:false,
			variables:1
		},
		setColor:{
			object_id:true,
			user_id:false,
			login_required:false,
			variables:1
		},
		begin:{
			object_id:false,
			user_id:false,
			login_required:false,
			variables:0
		}
	}

//cmd looks like [cmd] $[object_id] :[user_id] | [variables]
//if cmd looks like [cmd] [variables] then only the command and variables will be interpreted. 

function sendCommandToKernal(command){
	var reply = { 
		error:"",
		response:""
	}
	var delims = ['$',':','|'];

	var cmd = '';
	var user_id = '';
	var object_id = '';
	var variables = [];

	var full_form = false;

	var first_delim = true;

	var error = false;

	for (var i = 0; i < command.length; i++){
		if (delims.indexOf(command[i]) != -1){
			full_form = true;
			if (first_delim == true){
				cmd = command.slice(0,i).split(' ').join('');
				first_delim = false;
			}
			var next_delim = -1;
			for (var j = i; j < command.length; j++){
				if (j != i && delims.indexOf(command[j]) != -1){
					next_delim = j;
					break;
				}
			}

			if (next_delim != -1){
				switch(command[i]){
					case '$':
						object_id = command.slice(i,next_delim);
						break;
					case ':':
						user_id = command.slice(i,next_delim);
						break;
					case '|':
						variables = command.slice(i,next_delim).split(',');
						break;
				}
			} else {
				switch(command[i]){
					case '$':
						object_id = command.slice(i);
						break;
					case ':':
						user_id = command.slice(i);
						break;
					case '|':
						variables = command.slice(i).split(',');
						break;
				}
			}
		}
	}

	if (full_form == false){
		cmd = command.split(' ');
		if (cmd.length == 1){ 
			cmd = cmd[0];
		} else if (cmd.length == 2){
			cmd = command.split(' ')[0];
			variables = command.split(' ')[1].split(',');
		} else {
			reply.error = 'Too many keywords';
			error = true; 
		} 
	}
	delims.push(' ');
	for (var i = 0 ; i < delims.length; i++){
		cmd = cmd.split(delims[i]).join('');
		user_id = user_id.split(delims[i]).join('');
		object_id = object_id.split(delims[i]).join(''); 
		for (var j = 0; j < variables.length; j++){
			variables[j] = variables[j].split(delims[i]).join('').split(';').join('');
		}
	}


	if (commands.hasOwnProperty(cmd)){
		var command = commands[cmd];
		if (command.user_id == true && user_id == ""){
			reply.error = "Command '" + cmd + "' requires a user_id varirble. ";
			error = true;
		}
		if (command.object_id == true && object_id == ""){
			reply.error = "Command '" + cmd + "' requires an object_id varaible. ";
			error = true;
		}
		if (variables.length != command.variables) {
			reply.error = "Command '" + cmd + "' requires " + command.variables + " variables. ";
			error = true;
		}
		
	} else {
		reply.error = "Command '" + command + "' does not exist";
	}

	if (error == false){
		return kernal({
			cmd:cmd,
			object_id:object_id,
			user_id:user_id,
			variables:variables
		});
	}

	return reply;  
}

var domObjs = {}; 

function kernal(command){
	reply = {error:"",response:""};
	command.cmd = command.cmd.split(' ').join('');
	console.log(command.cmd.indexOf('init'));
	if (command.cmd.indexOf('init') != -1){
		console.log(command);
		if (domObjs.hasOwnProperty(command.object_id)){
			reply.error = "Object with id: '" + command.object_id + "' already exists";
		} else {

			try {

				domObjs[command.object_id] = (eval("new " + command.variables[0].trim() + "('" + command.object_id + "')"));
				reply.response = command.object_id + " created successfully";		
			} catch (error) {
				reply.error = "Something went wrong: " + error;
			}
		}
	}
	
	if (command.cmd == 'setColor'){
		console.log(domObjs);
		console.log(command.variables[0]);
		if (domObjs.hasOwnProperty(command.object_id)){
			console.log(domObjs[command.object_id]);
			try {

				domObjs[command.object_id].setColor(command.variables[0]);
				reply.response = command.object_id + " created successfully";
			} catch (error) {
				reply.error = "Something went wrong: " + error;
			}	
		}
	}
	
	//return reply;
}
 
function runScript(scriptName){
	$.get('jKernal/getBin.php',{bin:scriptName},function(data){
		data = JSON.parse(data);
		for (var i = 0; i < data.length; i++){

			response = sendCommandToKernal(data[i].split('↵').join(''));
			console.log(data[i].split('↵').join(''),response);

		}
	});
}