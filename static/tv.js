var TV = {
	_listaUtenti : [],
	setUtenti : function(obj){
		this._listaUtenti = obj;
		this.interfaccia.creaListaUtenti(this._listaUtenti);
	},
	interfaccia : {
		faseGioco : 1,
		creaListaUtenti : function(lista){
			var ul = $('fase' + this.faseGioco + "_utenti");
			ul.innerHTML = "";
			for (x in lista){
				var li = document.createElement("li");
				li.innerHTML = x;
				if(lista[x].super)
					li.className += " super";
				ul.appendChild(li);
			}
		}
	}
}
/*
var eventsLoop = setInterval(function(){
		getStep(entryFile + "TVEventi", function(risposta){
			
		});
		/*var ajax= newAjax();
		ajax.open("GET",entryFile + "pulisciAccessi",true);
		ajax.send(null);
		
	}, eventsLoopInterval);*/
function controllaUtenti(){
	getStep(entryFile + "listaUtenti", function(risposta){
			if (risposta.tipo == 0){
				TV.setUtenti(risposta.data);
			}
		});
}
controllaUtenti();
var usersLoop = setInterval (controllaUtenti, usersLoopInterval);
EventLib.init(Dispositivo.tv);
EventLib.pollEventi();


function arrossisci(colore){
	document.body.style.background = colore;
}
EventLib.registerService("arrossisci", arrossisci);
var intervallo1 = setInterval(EventLib.pollEventi, pollingInterval);
