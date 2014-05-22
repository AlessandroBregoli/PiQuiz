<?php
class Utente{
    public $timestamp;
    public $punteggio;
    public function __construct($timestamp){
        $this->timestamp = $timestamp;
        $this->punteggio = 0;
    }
}
function registerUser($nome){
    
	$accessi = getUsers();
	if(isset($accessi[$nome]))
	    $accessi[$nome]->timestamp= time();
    else $accessi[$nome] = new Utente(time());
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
	        unset($nome);
	        $modificato = true;
	    }
	}
	if($modificato)
	    setUsers($accessi);
}
?>
