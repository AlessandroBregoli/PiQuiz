<?php
include("settings.php");
if(isset($_GET['dati'])){
	$datiJs = json_decode($_GET['dati'], true);
}
else{
	$datiJs = array();
}
if(isset ($_GET['step'])){
	$nomeStep = STEPS . basename($_GET['step']).".php";
	if (file_exists($nomeStep)){
		include($nomeStep);
	}
	else {
		$risposta = new Risposta("Step non trovato: $nomeStep", TipoRisposta::Eccezione);
	}
}
?>
