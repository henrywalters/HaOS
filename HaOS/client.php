<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

$result = socket_connect($socket, '155.94.243.17', 4200);

if(!$result) {
    die('cannot connect '.socket_strerror(socket_last_error()).PHP_EOL);
}

$bytes = socket_write($socket, round(microtime(true) * 1000));

echo "wrote ".number_format($bytes).' bytes to socket'.PHP_EOL;

?>