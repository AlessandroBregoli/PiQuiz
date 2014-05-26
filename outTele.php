<?php
include("settings.php");
include ("phpqrcode/qrlib.php");    
$html = file_get_contents(STATICS."outTele.html");
$html = str_replace("{STATICS}","./static/",$html);
$html = str_replace("{GAMEURL}", ROOTURIIP ,$html);
$imgUrl = "img/".md5(ROOTURIIP).".png";
if(!file_exists($imgUrl)){
	QRcode::png(ROOTURIIP, $imgUrl, "H", 20, 2);
}
$html = str_replace("{IMGURL}", $imgUrl ,$html);
echo $html;
?>
