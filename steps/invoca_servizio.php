<?php 
	if(isset($datiJs['servizio'],$datiJs['argomenti'])){
		if(strpos($datiJs['servizio'], Dispositivo::client[1]) != -1){
			$utenti = getSerializzato(ACCESSI);
			foreach($utenti as $k => $utente){
				aggiungiEvento(new Evento($k, $datiJs['servizio'], $datiJs['argomenti']);
			}
		}
		else if(strpos($datiJs['servizio'], Dispositivo::superClient[1]) != -1){
			aggiungiEvento(new Evento(getSuperClient(), $datiJs['servizio'], $datiJs['argomenti']));
		}
	}
?>
