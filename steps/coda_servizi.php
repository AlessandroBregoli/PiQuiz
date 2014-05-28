<?php
	$time1 = microtime();
	$coda = getSerializzato(CODAEVENTI);
	$time2 = microtime();
	$disp = -1;
	if(isset($datiJs['sonolatv']) and $datiJs['sonolatv']){
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
		else if(isset($_SESSION['uname']) && $evento->a == $_SESSION['uname']){
			$return[] = $evento;
			unset($coda[$key]);
		}
	}
	$time3 = microtime();
	setSerializzato($coda, CODAEVENTI);
	$time4 = microtime();
	//$fp= fopen("timing.txt","w+");
	//fwrite($fp,($time2- $time1) ." ". ($time4-$time3));
	//fclose($fp);
	$risposta = new Risposta("Eventi", TipoRisposta::Successo, $return);
?>
