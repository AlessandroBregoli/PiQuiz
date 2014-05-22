<?php
define("ROOT", realpath(dirname(__FILE__))."/");
define("DATABASES", ROOT."dbDomande/");
define("INCLUDES", ROOT."lib/");

function getExtension($nomeFile){
	$pos = strrpos($nomeFile, ".");
	return substr($nomeFile,$pos);
}
$dir = opendir(INCLUDES);
while($d = readdir($dir)){
	if (getExtension($d) ==".php"){
		echo $d;
	}
}
closedir($dir);
?>
