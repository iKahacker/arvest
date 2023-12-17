function iOSversion() {
	if (/iPad/.test(navigator.platform)) {
		var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
		return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
	}
}

ver = iOSversion();
var mvp = document.getElementById('myViewport');
iOS = navigator.userAgent.match(/iPad/i);

if (iOS) {
	if (ver[0] < 7) {
		(function(doc) {
			var addEvent = 'addEventListener',
				type = 'gesturestart',
				qsa = 'querySelectorAll',
				scales = [1, 1],
				meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

			function fix() {
				meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
				doc.removeEventListener(type, fix, true);
			}

			if ((meta = meta[meta.length - 1]) && addEvent in doc) {
				fix();
				scales = [.25, 1.6];
				doc[addEvent](type, fix, true);
			}

		}(document));
		var viewportmeta = document.querySelector('meta[name="viewport"]');
		if (viewportmeta) {
			viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0';
			document.body.addEventListener('gesturestart', function () {
				viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
			}, false);


	    }

	} else if (ver[0] == 7) {
		mvp.content = 'width=device-width, initial-scale=1';
	}
}
if (!iOS) {
	/*
	if ((screen.width < 767) && (screen.width > 500)) {
		mvp.setAttribute('content','width=768');
		var a = window.addEventListener("resize", function() {
			handleOrientation();
		}, false);
	} else if (screen.width < 499) {
		mvp.setAttribute('content','width=768');
	} else {
		mvp.setAttribute('content','width=device-width, initial-scale=1');
	}
	function handleOrientation() {
		if(window.innerHeight > window.innerWidth) {
			//Portrait
			mvp.setAttribute('content','width=768');

		} else {
			//Landscape
			mvp.setAttribute('content','width=device-width');
		}
	}
	*/
}