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
}
function registerUser($nome){
    
    $accessi = getUsers();
    $super = count($accessi) == 0;
    //se l'utente esiste, aggiorna il taimstamp del ping
    if(isset($accessi[$nome]))
	$accessi[$nome]->timestamp= time();
    //altrimenti lo aggiunge.
    else $accessi[$nome] = new Utente(time(),$super);
    setUsers($accessi);
}
function getUsers(){
    if(!file_exists(ACCESSI)){
        $fp= fopen(ACCESSI,"w");
        fwrite($fp,serialize(array()));
        fclose($fp);
    }
    $fp= fopen(ACCESSI,"r");
	$accessi = unserialize(fread($fp,filesize(ACCESSI)));
	fclose($fp);
	return $accessi;
}

function setUsers($accessi){
    $fp = fopen(ACCESSI,"w");
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
    $accessi = getUsers();
    $modificato = false;
    foreach($accessi as $nome=>$Utente){
	if ($time - $Utente->timestamp > PINGTIMEOUT){
	    unset($accessi[$nome]);
	    $modificato = true;
	}
    }
    if($modificato)
	setUsers($accessi);
}
function checkPing($uname){
    //controlla se l'utente è nei ping
    
    $accessi = getUsers();
    return isset($accessi[$uname]);
}
?>
