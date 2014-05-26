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

function getStep(src,func,argomenti){
	var ajax= newAjax();
	if(argomenti){
		var json = JSON.encode(argomenti);
		src += "&dati=" + encodeURIComponent(json);
	}
	ajax.open("GET",src,true);
	ajax.send(null);
	ajax.onreadystatechange= function(){
		if (ajax.readyState == 4) {
			if( ajax.status == 200){
				try{
					func(JSON.parse(ajax.responseText));
				}
				catch(e){
					alert('Error name: '+e.name+'\nError message: '+e.message+'\nScript: \n'+ajax.responseText);
				}
			}
		}
	}
}
