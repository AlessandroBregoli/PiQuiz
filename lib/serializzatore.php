<?php
function getSerializzato($file = ACCESSI){
    if(!file_exists($file)){
        $fp= fopen($file,"w");
        fwrite($fp,serialize(array()));
        fclose($fp);
    }
    $fp= fopen($file,"r");
    $tentativi = 0;
    if(flock($fp,LOCK_EX)){
	$accessi = unserialize(fread($fp,filesize($file)));
    }
    else{
	die("mannaggia");
    }
    flock($fp,LOCK_UN);
    fclose($fp);
    return $accessi;
}

function setSerializzato($accessi,$file = ACCESSI){
    $fp = fopen($file ,"w");
    $tentativi = 0;
    if(flock($fp,LOCK_EX)){
	fwrite($fp,serialize($accessi));
	fflush($fp);
    }
    else{
	die("mannaggia");
    }
    flock($fp,LOCK_UN);
    fclose($fp);
}
?>
