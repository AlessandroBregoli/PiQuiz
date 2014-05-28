<?php
$users= getSerializzato(ACCESSI);
$users[$_SESSION['uname']]->timestamp = 0;
setSerializzato($users,ACCESSI);
touch("disastro.txt");
checkUsers();
session_destroy();
aggiungiEvento(new Evento("",DispositivoTv."sincroUtenti",null));
$risposta = new Risposta("Logout");
?>
