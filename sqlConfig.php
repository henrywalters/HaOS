<?php
	$servername = "localhost:3306";
	$username = 'root';
	$password = '';
	$db_name = "";
	$GLOBALS['sql_conn'] = new mysqli($servername, $username, $password);
	mysqli_select_db($GLOBALS['sql_conn'],$db_name);
	// Check connection
?>