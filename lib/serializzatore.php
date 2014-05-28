<?php
function getSerializzato($file,$printer=false){
    if(!file_exists($file)){
        return array();
    }
    $fp= fopen($file,"r");
    $tentativi = 0;
    if(flock($fp,LOCK_SH)){
	$size=filesize($file);
	$contenutoFile = file_get_contents($file);
	$accessi = unserialize(base64_decode($contenutoFile));
	if($accessi === false){
	    debug_print_backtrace();
	    echo base64_decode($contenutoFile);
	    echo "\n$size, ".strlen($contenutoFile)." " .filesize($file);
	}
    }
    else{
	die("mannaggia");
    }
    flock($fp,LOCK_UN);
    fclose($fp);
    return $accessi;
}

function setSerializzato($accessi,$file){
    $fp = fopen($file ,"c");
    if(flock($fp,LOCK_EX)){
	ftruncate($fp,0);
	fwrite($fp,base64_encode(serialize($accessi)));
	fflush($fp);
    }
    else{
	die("mannaggia");
    }
    flock($fp,LOCK_UN);
    fclose($fp);
}
?>
