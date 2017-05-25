<?php

$file_name = 'bin/'.$_GET['bin'].'.txt';

$file = fopen($file_name,"r");
$commands = array();
while(! feof($file))
  {
  	array_push($commands,substr(fgets($file),0,-1));
  }

fclose($file);

echo json_encode($commands); 

?>