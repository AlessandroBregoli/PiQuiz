<?php
checkUsers();
$arrayUtenti = getSerializzato(ACCESSI);
$risposta = new Risposta ("Lista accessi", TipoRisposta::Successo, $arrayUtenti);
?>
