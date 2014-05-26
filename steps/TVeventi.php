<?php
	$eventi = pullEventi();
	$risposta = new Risposta("Eventi",TipoRisposta::Successo, $eventi);
?>
