<?php
if(isset($_SESSION['uname'])){
	$users= getSerializzato(ACCESSI);
	$users[$_SESSION['uname']]->timestamp = 0;
	setSerializzato($users,ACCESSI);
	$logout = base64_decode(file_get_contents(CODAEVENTI));
	checkUsers();
	session_destroy();
	aggiungiEvento(new Evento("",DispositivoTv."sincroUtenti",null));
	$risposta = new Risposta("logout");
}
else $risposta = new Risposta("not logged");
?>
