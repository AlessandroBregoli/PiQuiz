function newAjax() {
	var xmlHttp;
	try {
		// Firefox, Opera e Safari
		xmlHttp= new XMLHttpRequest();
	}
	catch (exc){// Internet Explorer
		try{
			xmlHttp= new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (exc){
			try{
				xmlHttp= new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (exc){
				alert("Il tuo browser non supporta AJAX!");
				return false;
			}
		}
	}
	return xmlHttp;
}
