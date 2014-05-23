<?php
function aggiungiEvento($oggetto){
	$eventi = getUsers(CODAEVENTI);
	$eventi[] = $oggetto;
	setSerializzato($eventi, CODAEVENTI);
}
function pullEventi(){
	$eventi = getUsers(CODAEVENTI);
	eliminaEventi();
	return $eventi;
}
function eliminaEventi(){
	getSerializzato(array(),CODAEVENTI);
}
?>
