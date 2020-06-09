<?php

error_reporting(E_ALL);

set_time_limit(0);

ob_implicit_flush(); //scarico output

$host = "127.0.0.1";
$port = 12296;

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die ("creazione socket fallita");
$ris = socket_bind($socket, $host, $port) or die ("associazione fallita del socket");
$ris = socket_listen($socket, 3) or die ("creazione canale di ascolto fallito");
$canale = socket_accept($socket) or die ("ascolto non inizializzato");

$input = socket_read($canale, 1024) or die ("Non riesco a leggere il pacchetto");

echo "messaggio criptato client: ".$input;

$pippo = base64_decode($input);
echo"<br>messaggio decriptato client: ".$pippo;

$msg = base64_encode($pippo);

$output = $msg;

socket_write($canale, $msg, strlen($msg)) or die ("non posso inoltare il pacchetto");

socket_close($canale);
socket_close($socket);


?>