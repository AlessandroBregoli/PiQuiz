<?php
	$coda = getSerializzato(CODAEVENTI);
	$disp = -1;
	if(isset($_GET['sonolatv'])){
		$disp = DispositivoTv;
	}
	else if(isset($_SESSION['uname'])){
		$disp = DispositivoClient;
	}
	$return = array();
	foreach($coda as $key=>$evento){
		if($evento->a == "" && $disp == DispositivoTv){
			$return[] = $evento;
			unset($coda[$key]);
		}
		else if($evento->a == $_SESSION['uname']){
			$return[] = $evento;
			unset($coda[$key]);
		}
	}
	setSerializzato($coda, CODAEVENTI);
	$risposta = new Risposta("Eventi", TipoRisposta::Successo, $return);
?>
