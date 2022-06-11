<?php
$token = substr(hash('sha256',bin2hex(random_bytes(16)).'Cruz Azul Campeon'),1,16);
echo $token;
?>