getStep(entryFile+"controllaAccesso", function(risposta){
	alert(risposta.contenuto);
	if(risposta.tipo == 1){
		$('registrazione').style.display="block";
	}
	else{
		paginaSetup();
	}
});
$('registrazione').addEventListener("submit", function(ev){
		var str = getInputValues(this);
		getStep(entryFile + "uniscitiAlGioco" + str, function(risposta){
			if(risposta.tipo == 0){
				paginaSetup();
			}
		});
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
	EventLib.requireService("PIEvent.tv.arrossisci");
}
