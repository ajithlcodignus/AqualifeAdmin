<?php
$host = "122.0.0.1";
$port = 20205;
/*$host = "15.207.87.192";
$port = 80;*/
set_time_limit(0);

$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("could not create socket \n");
$result = socket_bind($sock, $host,$port) or die("could not bind socket \n");

$result = socket_listen($sock, 3) or die("Could not setup socket listener");

echo "Lisening connection";

class Chat
{
    function readline()
    {
        return rtrim(fgets(STDIN));
    }
}

do
{
    $accept = socket_accept($sock) or die("Could not accept incomming connections");
    $msg = socket_read($accept, 1024) or die("Could not read input");

    $msg = rtrim($msg);

    echo "Client says".$msg."\n\n";
    $line = new chat();

    echo "Enter reply:\t";

    $reply = $line->readline();

    socket_write($accept, $reply, strlen($reply)) or die("Could not write output");

} while(true);
socket_close($accept, $sock);
?>