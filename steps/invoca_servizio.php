<?php 
	
	if(isset($datiJs['servizio'],$datiJs['argomenti'])){
		if(strpos($datiJs['servizio'], DispositivoClient) != -1){
			$utenti = getSerializzato(ACCESSI);
			foreach($utenti as $k => $utente){
				aggiungiEvento(new Evento($k, $datiJs['servizio'], $datiJs['argomenti']));
			}
		}
		else if(strpos($datiJs['servizio'], DispositivoSuperClient) != -1){
			aggiungiEvento(new Evento(getSuperClient(), $datiJs['servizio'], $datiJs['argomenti']));
		}
		else if(strpos($datiJs['servizio'], DispositivoTv) != -1){
			aggiungiEvento(new Evento("", $datiJs['servizio'], $datiJs['argomenti']));
		}
		else {
			die("AAAAAAAAAAAAAAAAAAAAAAAARGH");
		}
	}
	else {
		$fp = fopen("argh.txt", "w+");
		fwrite($fp, serialize($datiJs));
		fclose($fp);
	}
	$risposta = new Risposta("",TipoRisposta::Niente);
?>
