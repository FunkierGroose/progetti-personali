<?php
error_reporting(E_ALL);

$host = "127.0.0.1";
$port = 12296;

echo"<form method=post action=client.php>";
echo"<input type=text placeholder=scrivi... name=msg>";
echo"<input type=submit name=action value=invia!>";
echo"</form>";
echo"<br>";


if(isset($_POST['action'])){

    $messaggio = $_POST['msg'];
    
    $msg = base64_encode($messaggio);

    echo"<br>";
    echo"messaggio da inoltrare al server: ".$messaggio;
    echo"<br>";
    echo"messaggio crittografato con l'algoritmo di criptaggio inoltrare al server: ".$msg;
    

    $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die ("socket non creato");
    $ris = socket_connect($socket, $host, $port) or die ("impossibile connetersi al server");
    socket_write($socket, $msg, strlen($msg)) or die ("impossibile inviare i dati al server");
    $ris = socket_read($socket, 1024) or die ("impossibile leggere la risposta del server");

    
    echo"<br>";
    echo"<br>risposta del server: ".$ris;
    echo "<br>".$pippo = base64_decode($ris);

    socket_close($socket);
}
?>