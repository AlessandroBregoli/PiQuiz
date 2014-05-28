<?php
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
		sleep(mt_rand(0,10)/100);
		$tentativi ++;
		if($tentativi > 10)
		    die("mannaggia");
	}
	fwrite($fp,serialize($accessi));
	flock($fp,LOCK_UN);
	fclose($fp);
}
?>
