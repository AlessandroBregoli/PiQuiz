var pingInterval = setInterval(function(){
		var ajax= newAjax();
		ajax.open("GET",entryFile + "ping",true);
		ajax.send(null);
	}, pingInterval);
