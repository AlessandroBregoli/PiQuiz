<?php
if(isset($_SESSION['uname']) && checkPing($_SESSION['uname'])){
	$risposta = new Risposta("OK"/*, array("seiSuper" => $_SESSION['uname']==getSuperClient())*/);
}
else{
	$risposta = new Risposta("NO",TipoRisposta::Eccezione);
}
?>
