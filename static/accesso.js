var superClient = false;
getStep("controllaAccesso", function(risposta){
	if(risposta.tipo == 1){
		$('registrazione').style.display="block";
	}
	else{
		if(risposta.data){
			if(risposta.data.seiSuper){
				sonoSuper();
			}
			$('nomeutente').innerHTML= risposta.data.utente;
			paginaSetup();
		}
	}
});
$('registrazione').addEventListener("submit", function(ev){
		var argV = getInputValues(this);
		getStep("uniscitiAlGioco", function(risposta){
			if(risposta.tipo == 0){
				paginaSetup();
				$('nomeutente').innerHTML= argV.registerUname;
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
window.addEventListener('close',function(){
		stopPing();
		getStep("logout",false,null,true);
	});

function sonoSuper(){
	superClient = true;
	EventLib.prefisso = Dispositivo.superClient;
	$('nomeutente').style.fontWeight= 'bold';
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
	stopPing();
	getStep("logout", function(){
		document.location.reload(); 
	})
}
