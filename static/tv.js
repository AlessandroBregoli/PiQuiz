var mainLoop = setInterval(mainLoopInterval , function(){
		getStep(entryFile + "TVEventi", function(risposta){
			
		});
		var ajax= newAjax();
		ajax.open("GET",entryFile + "pulisciAccessi",true);
		ajax.send(null);
		
	});
