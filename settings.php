<?php

session_start();
define("ROOT", realpath(dirname(__FILE__))."/");
define("DATABASES", ROOT."dbDomande/");
define("INCLUDES", ROOT."lib/");
define("STEPS", ROOT."steps/");
define("STATICS", ROOT."static/");
define("ACCESSI", ROOT."accessi.txt");
define("PINGTIMEOUT",30);

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
	if(isset($GLOBALS['risposta'])){
		echo json_encode($GLOBALS['risposta']);
	}
}

register_shutdown_function('shutdown');

?>
