<?php
function aggiungiEvento($oggetto){
	$eventi = getUsers(CODAEVENTI);
	$eventi[] = $oggetto;
	setSerializzato($eventi, CODAEVENTI);
}

function eliminaEventi(){
	getSerializzato(array(),CODAEVENTI);
}
?>
