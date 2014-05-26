getStep(entryFile+"controllaAccesso", function(risposta){
	if(risposta.tipo == 1){
		$('registrazione').style.display="block";
	}
	else{
		paginaSetup();
	}
});
$('registrazione').addEventListener("submit", function(ev){
		var argV = getInputValues(this);
		getStep(entryFile + "uniscitiAlGioco", function(risposta){
			if(risposta.tipo == 0){
				paginaSetup();
			}
		}, argV);
		try{
			ev.preventDefault();
		}
		catch(e){}
		return false;
	}, false);

function paginaSetup(){
	//l'utente è registato
	$('registrazione').style.display="none";
}

EventLib.init(Dispositivo.client);
EventLib.pollEventi();
var intervallo1 = setInterval(EventLib.pollEventi, pollingInterval);

$('clicche').onclick = function(){
	EventLib.requireService("PIevent.tv.arrossisci",['green']);
}

$('clicche2').onclick = function(){
	EventLib.requireService("PIevent.tv.arrossisci",['red']);
}

$('logout').onclick = function(){
	clearInterval(pingInterval);
	getStep(entryFile + "testing_logout", function(){
		document.location.reload(); 
	})
}
