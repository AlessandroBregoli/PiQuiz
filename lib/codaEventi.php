<?php
define("DispositivoSuperClient", PREFISSO . "superClient.");
define("DispositivoClient", PREFISSO . "client.");
define("DispositivoTv", PREFISSO . "tv.");
class Evento{
	public $nomeServizio;
	public $data;
	public $a;
	public function __construct($a, $nomeServizio, $argomenti){
		$this->a = $a;
		$this->nomeServizio = $nomeServizio;
		$this->data = $argomenti;
	}
}

function aggiungiEvento($oggetto){
	$eventi = getSerializzato(CODAEVENTI);
	$eventi[] = $oggetto;
	setSerializzato($eventi, CODAEVENTI);
}
function pullEventi(){
	$eventi = getSerializzato(CODAEVENTI);
	eliminaEventi();
	return $eventi;
}
function eliminaEventi(){
	getSerializzato(array(),CODAEVENTI);
}
?>
