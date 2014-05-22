<?php
include("settings.php");

if(isset ($_GET['step'])){
	$nomeStep = STEPS . basename($_GET['step']).".php";
	if (file_exists($nomeStep)){
		include($nomeStep);
	}
}
?>
