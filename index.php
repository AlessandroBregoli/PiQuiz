<?php
include("settings.php");
if (isset($_SESSION['uname'])){
	$u = $_SESSION['uname'];
}
else {
	echo "Benvenuto. ti voglio chiamare giovanni";
	$_SESSION['uname']="giovanni";
}
?>
