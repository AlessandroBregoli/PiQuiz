<?php
if(isset($_SESSION['uname']) && checkPing($_SESSION['uname'])){
	$risposta = new Risposta("OK");
}
else{
	$risposta = new Risposta("NO",TipoRisposta::Eccezione);
}
?>
