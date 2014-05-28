<?php
$users= getSerializzato(ACCESSI);
try{
	if(isset($_SESSION['uname'])){
		unset($users[$_SESSION['uname']]);
		unset($_SESSION['uname']);
	}
}
catch(Exception $e){}
setSerializzato($users,ACCESSI);
$risposta = new Risposta("Logout");
?>
