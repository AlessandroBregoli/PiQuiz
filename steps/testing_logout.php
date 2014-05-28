<?php
$users= getSerializzato(ACCESSI);
$users[$_SESSION['uname']]->timestamp = 0;
setSerializzato($users,ACCESSI);
checkUsers();
$risposta = new Risposta("Logout");
?>
