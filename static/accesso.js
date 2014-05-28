var superClient = false;
getStep(entryFile+"controllaAccesso", function(risposta){
	alert(risposta.data);
	if(risposta.tipo == 1){
		$('registrazione').style.display="block";
		if(risposta.data.seiSuper){
			sonoSuper();
		}
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

function sonoSuper(){
	superClient = true;
	EventLib.prefisso = Dispositivo.superClient;
	alert("sono super!");
}
EventLib.init(Dispositivo.client);
EventLib.registerService("seiSuper", sonoSuper);
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
