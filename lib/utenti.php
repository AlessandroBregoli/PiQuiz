<?php
class Utente{
    public $timestamp;
    public $punteggio;
    public $super = false;
    public function __construct($timestamp,$super=false){
        $this->timestamp = $timestamp;
        $this->punteggio = 0;
	$this->super = $super;
    }
    //algoritmo ultracomplesso per il calcolo del punteggio
    public function calcolaPunteggio($punteggio){
		$this->punteggio +=$punteggio;
	}
}
function aggiungiPunti($nome, $punteggio){
    if(trim($nome) != ""){
	$accessi = getSerializzato(ACCESSI);
	if(isset($accessi[$nome])){
	    $accessi[$nome]->calcolaPunteggio($punteggio);
	    setSerializzato($accessi,ACCESSI);
	}
    }
}
function registerUser($nome){
    if(trim($nome) != ""){
	$accessi = getSerializzato(ACCESSI);
	$super = count($accessi) == 0;
	if($super){
	    aggiungiEvento(new Evento($nome, DispositivoClient."seiSuper"));
	}
	//se l'utente esiste, aggiorna il taimstamp del ping
	if(isset($accessi[$nome]))
	    $accessi[$nome]->timestamp= time();
	//altrimenti lo aggiunge.
	else $accessi[$nome] = new Utente(time(),$super);
	setSerializzato($accessi,ACCESSI);
    }
}

function checkUsers(){
    $time = time();
    $accessi = getSerializzato(ACCESSI);
    $modificato = false;
    foreach($accessi as $nome=>$Utente){
	if (($time - $Utente->timestamp) > PINGTIMEOUT){
	    if ($accessi[$nome]->super){
		//se l'utente è superutente, facciamo diventare super il primo della lista
		unset($accessi[$nome]);
		$chiavi = array_keys($accessi);
		if(isset($chiavi[0])){
		    $accessi[$chiavi[0]]->super = true;
		    aggiungiEvento(new Evento($chiavi[0], DispositivoClient."seiSuper"));
		}
	    }
	    else{
		unset($accessi[$nome]);
	    }
	    $modificato = true;
	}
    }
    if($modificato)
	setSerializzato($accessi,ACCESSI);
}
function checkPing($uname){
    //controlla se l'utente è nei ping
    
    $accessi = getSerializzato(ACCESSI);
    return isset($accessi[$uname]);
}
function getSuperClient(){
    $users = getSerializzato(ACCESSI);
    foreach($users as $nome=>$usr){
	if($usr->super){
	    return $nome;
	}
    }
}
?>
