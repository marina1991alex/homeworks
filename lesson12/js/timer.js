var seconds = 0;
var minutes = 0;
var hours = 0;
	setInterval(function(){
		seconds++;
		if (seconds == 60) {
			 minutes++;
			document.getElementById("minutes").innerHTML = pad(minutes % 60);
			seconds = 0;
		}
		if (minutes == 60) {
			hours++;
			document.getElementById("hours").innerHTML = hours;
			minutes=0;
		}
		document.getElementById("seconds").innerHTML = pad(seconds % 60);
	}, 1000)
		function pad(val) {
		var valString = val + '';
		if (valString.length < 2) {
			return '0' + valString;
		}
		else {
			return valString;
		}
	}