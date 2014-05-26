<?php
$users= getSerializzato(ACCESSI);
try{
	unset($users[$_SESSION['uname']]);
	unset($_SESSION['uname']);
}
catch(Exception $e){}
$risposta = new Risposta("Logout");
?>
