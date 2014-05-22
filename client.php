<?php
include("settings.php");
$html = file_get_contents(STATICS."client.html");
$html = str_replace("{STATICS}","./static/",$html);
echo $html;
?>
