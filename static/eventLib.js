
var Dispositivo = {
	client : [1, prefisso + "client."],
	tv : [2, prefisso + "tv."]
}
var EventLib = {
	serviceDict : {},
	prefisso : {},
	init : function(dispositivo){
		this.prefisso = dispositivo[1];
	},
	registerService : function(nomeServizio, funzione, callingObject){
		nomeServizio = this.prefisso + nomeServizio;
		if (!callingObject)
			callingObject = window;
		this.serviceDict[nomeServizio] = [funzione, callingObject];
	},
	requireService : function(nomeServizio, argList){
		if (nomeServizio.indexOf(this.prefisso) != -1){
			//se il servizio è locale, lo eseguiamo e basta
			if(nomeServizio in this.serviceDict){
				var serv = this.serviceDict[nomeServizio]
				serv[0].apply(serv[1],argList);
			}
			else {
				alert("servizio "+nomeServizio+" non trovato");
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
		}, {'sonolatv': (EventLib.prefisso == Dispositivo.tv[1])});
	}
}
