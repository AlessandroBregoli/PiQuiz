<?php

session_start();
define("ROOT", realpath(dirname(__FILE__))."/");
define("DATABASES", ROOT."dbDomande/");
define("INCLUDES", ROOT."lib/");
define("STEPS", ROOT."steps/");
define("ACCESSI", ROOT."accessi.txt");

function getExtension($nomeFile){
	$pos = strrpos($nomeFile, ".");
	return substr($nomeFile,$pos);
}
$dir = opendir(INCLUDES);
while($d = readdir($dir)){
	if (getExtension($d) ==".php"){
		include(INCLUDES . $d);
	}
}
closedir($dir);

function shutdown(){
	//session_close();
}

register_shutdown_function('shutdown');

function registerUser($nome){
    if(!file_exists(ACCESSI)){
        file_put_contents(ACCESSI,serialize(array()));
    }
	while(!flock(ACCESSI,LOCK_EX)){
	echo "ciao!";
		sleep(1);
	}
	$accessi = unserialize(file_get_contents(ACCESSI));
	$accessi[$nome] = time();
	file_put_contents(ACCESSI,serialize($accessi));
	flock(ACCESSI,LOCK_UN);
}
?>
