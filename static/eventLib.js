
var Dispositivo = {
	client : prefisso + "client.",
	superClient : prefisso + "superClient.",
	tv : prefisso + "tv."
}
var EventLib = {
	serviceDict : {},
	prefisso : {},
	init : function(dispositivo){
		this.prefisso = dispositivo;
	},
	registerService : function(nomeServizio, funzione, callingObject){
		nomeServizio = this.prefisso + nomeServizio;
		if (!callingObject)
			callingObject = window;
		this.serviceDict[nomeServizio] = [funzione, callingObject];
	},
	requireService : function(nomeServizio, argList){
		if (nomeServizio.indexOf(EventLib.prefisso) != -1){
			//se il servizio è locale, lo eseguiamo e basta
			if(nomeServizio in EventLib.serviceDict){
				var serv = EventLib.serviceDict[nomeServizio]
				serv[0].apply(serv[1],argList);
			}
			else {
				alert("servizio "+nomeServizio+" non trovato. servizi=" + EventLib.serviceDict);
			}
		}
		else {
			getStep(entryFile + "invoca_servizio", function(){}, {'servizio': nomeServizio, 'argomenti': argList ? argList : {}});
		}
	},
	pollEventi : function(){
		getStep(entryFile + "coda_servizi", function(risposta){
			for(x in risposta.data){
				EventLib.requireService(risposta.data[x].nomeServizio, risposta.data[x].data);
			}
		}, {'sonolatv': (EventLib.prefisso == Dispositivo.tv)});
	}
}
