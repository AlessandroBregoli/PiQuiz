<?php
$nome = $_GET['registerUname'];
$accessiAttuali = getUsers();
if(isset($accessiAttuali[$nome])){
	$risposta = new Risposta("Attenzione: il nome utente esiste già",TipoRisposta.Eccezione);
}
else {
	$risposta = new Risposta("Sei stato registrato come ".$nome);
	$_SESSION['uname'] = $nome;
	registerUser($nome);
}
?>
