<?php
if(isset($_SESSION['uname']) && checkPing($_SESSION['uname'])){
	$risposta = new Risposta("OK", TipoRisposta::Successo, array("utente"=>$_SESSION['uname'],"seiSuper" => $_SESSION['uname']==getSuperClient()));
}
else{
	if(isset($_SESSION['uname']))
		unset($_SESSION['uname']);
	$risposta = new Risposta("NO",TipoRisposta::Eccezione);
}
?>
