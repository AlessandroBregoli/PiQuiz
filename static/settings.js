var pingInterval = 10000;
var mainLoopInterval = 2000;
var entryFile = "entry.php?step=";
function $(id){
	return document.getElementById(id);
}

function getInputValues(form){
	var inputs = form.getElementsByTagName('input');
	var argString = "";
	var partito = false;
	for (x in inputs){
		if (partito){
			argString += "&";
		}
		var nome = inputs[x].name;
		var valore = inputs[x].value;
		argString += nome + "=" + valore;
		partito = true;
	}
	return argString
}
