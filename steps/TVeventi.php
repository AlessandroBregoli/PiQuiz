<?php
	$evnti = pullEventi();
	$risposta = new Risposta("Eventi",TipoRisposta::Successo, $eventi);
?>
