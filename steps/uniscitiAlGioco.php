<?php
	$nome = $datiJs['registerUname'];
	$accessiAttuali = getSerializzato(ACCESSI);
	if(isset($accessiAttuali[$nome])){
		$risposta = new Risposta("Attenzione: il nome utente esiste già",TipoRisposta::Eccezione);
	}
	else {
		if(trim($nome) != ""){
			$risposta = new Risposta("Sei stato registrato come ".$nome);
			$_SESSION['uname'] = $nome;
			registerUser($nome);
		}
		else{
			$risposta = new Risposta("Attenzione: nome utente vuoto",TipoRisposta::Eccezione);
		}
	}
?>
