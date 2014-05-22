var interval = setInterval(pingInterval, function(){
		var ajax= newAjax();
		ajax.open("GET",entryFile + "ping",true);
		ajax.send(null);
	}
);
