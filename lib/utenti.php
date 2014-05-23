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
	$accessi = getSerializzato();
	if(isset($accessi[$nome])){
		$accessi[$nome]->calcolaPunteggio($punteggio);
		setSerializzato($accessi);
	 }
}
function registerUser($nome){
    
    $accessi = getSerializzato();
    $super = count($accessi) == 0;
    //se l'utente esiste, aggiorna il taimstamp del ping
    if(isset($accessi[$nome]))
	$accessi[$nome]->timestamp= time();
    //altrimenti lo aggiunge.
    else $accessi[$nome] = new Utente(time(),$super);
    setSerializzato($accessi);
}
function getSerializzato($file = ACCESSI){
    if(!file_exists($file)){
        $fp= fopen($file,"w");
        fwrite($fp,serialize(array()));
        fclose($fp);
    }
    $fp= fopen($file,"r");
    $accessi = unserialize(fread($fp,filesize($file)));
    fclose($fp);
    return $accessi;
}

function setSerializzato($accessi,$file = ACCESSI){
    $fp = fopen($file ,"w");
	$tentativi = 0;
	while(!flock($fp,LOCK_EX)){
		sleep(0.1);
		$tentativi ++;
		if($tentativi > 10)
		    die();
	}
	fwrite($fp,serialize($accessi));
	flock($fp,LOCK_UN);
	fclose($fp);
}

function checkUsers(){
    $time = time();
    $accessi = getSerializzato();
    $modificato = false;
    foreach($accessi as $nome=>$Utente){
	if ($time - $Utente->timestamp > PINGTIMEOUT){
	    unset($accessi[$nome]);
	    $modificato = true;
	}
    }
    if($modificato)
	setSerializzato($accessi);
}
function checkPing($uname){
    //controlla se l'utente è nei ping
    
    $accessi = getSerializzato();
    return isset($accessi[$uname]);
}
?>
