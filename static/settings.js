var pingInterval = 10000
var eventsLoopInterval = 2000;
var usersLoopInterval = 5000;
var entryFile = "entry.php?step=";
var prefisso = "PIevent.";
var pollingInterval= 2000;

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
		argString += nome + "" + valore;
		partito = true;
	}
	return argString
}
