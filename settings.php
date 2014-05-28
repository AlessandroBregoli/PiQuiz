<?php

session_start();
define("ROOT", str_replace("\\","/",realpath(dirname(__FILE__))."/"));
define("DOCROOT", str_replace("\\","/",$_SERVER['DOCUMENT_ROOT']));
define("ROOTURI", (isset($_SERVER['HTTPS'])?"https://" : "http://") . gethostname() . str_replace(DOCROOT, "", ROOT));
define("ROOTURIIP", (isset($_SERVER['HTTPS'])?"https://" : "http://") . gethostbyname(gethostname()). str_replace(DOCROOT, "", ROOT));
define("DATABASES", ROOT."dbDomande/");
define("INCLUDES", ROOT."lib/");
define("STEPS", ROOT."steps/");
define("STATICS", ROOT."static/");
define("ACCESSI", ROOT."accessi.txt");
define("CODAEVENTI", ROOT."eventi.txt");
define("PINGTIMEOUT",15);
define("PREFISSO", "PIevent.");

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
