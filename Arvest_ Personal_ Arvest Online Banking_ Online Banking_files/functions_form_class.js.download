function input_node_observe(node) {
	//console.log('input_node_observe',node);
	var type = node.getAttribute('type'),
		validation_handled_correctly = wf2_implementation[type] !== undefined ?
			wf2_implementation[type][0] :
			true;
	if (!validation_handled_correctly && wf2_implementation[type][0][1] ) {
		node.removeAttribute('required');
	}
	if( typeof node.checkValidity === 'function' && classNameHas(node,'invalid') ) {
		// input may be presented initially as flagged, but browser has native validity checking
		addEvent(node,'change',function() {
			// only validate... don't invalidate
			var valid = node.checkValidity();
			if (valid ) {
				classNameRemove(node,'invalid');
			}
		});
	}
}

function set_value(fieldname,value,form) {
	var i = 0;
	if (form === undefined ) {
		form = document.forms[0];
	}
	// must go all this trouble due to complications with forms[0].name.value if name is an int
	if (form ) {
		for (i=0; i<form.length; i++) {
			if (form.elements[i].name !== undefined && form.elements[i].name === fieldname ) {
				form.elements[i].value = value;
				break;
			}
		}
	}
}

/**
 * if form has validated, sets value of all submit buttons to please wait and disables them
 */
function please_wait(node_form,sub) {
	//console.log('please_wait', node_form, sub);
	var is_chrome	= navigator.userAgent.indexOf('Chrome') > -1,	// Chrome UA contains both 'chrome' and 'safari'
		is_safari	= ( navigator.userAgent.indexOf("Safari") > -1 ) && !is_chrome,
		form		= null,
		f			= 0,
		i			= 0;
	/**
	 * disable submit buttons first / mucho important
	 */
	if (node_form && typeof node_form.submitting !== 'undefined' && node_form.submitting ) {
		return;
	}
	node_form.submitting = true;
	for ( f=0; f<document.forms.length; f++ ) {
		form = document.forms[f];
		for ( i=0; i<form.length; i++ ) {
			if (form.elements[i].type !== undefined && form.elements[i].type === 'submit' ) {
				if (!form.elements[i].className.match(/\bnowait\b/) ) {
					form.elements[i].value_old = form.elements[i].value;
					form.elements[i].value = 'Please Wait...';
					form.elements[i].disabled = true;
					if (typeof $ !== 'undefined' && typeof $.mobile !== 'undefined' ) {
						$(form.elements[i]).button('refresh');
					}
				}
			}
		}
	}
	if (node_form && typeof node_form.checkValidity === "function" && !node_form.checkValidity() ) {
		// Safari has a checkValidity method, but it provids zero feedback to the user
		//    so, for Safari, go ahead and submit the invalid form
		if (!is_safari ) {
			un_wait();
			return;
		}
	}
	setTimeout(function(){
		un_wait();
	}, 15000);
	if (sub === undefined ) {
		sub = true;
	}
	if (sub && node_form !== undefined ) {
		$(window).unbind("beforeunload");
		node_form.submit();
	}
}

function un_wait() {
	var form	= null,
		f		= 0,
		i		= 0;
	for ( f=0; f<document.forms.length; f++ ) {
		form = document.forms[f];
		form.submitting = false;
		for ( i=0; i<form.length; i++ ) {
			if (form.elements[i].type !== undefined && form.elements[i].type === 'submit' ) {
				form.elements[i].disabled = false;
				if (form.elements[i].value_old !== undefined ) {
					form.elements[i].value = form.elements[i].value_old;
				}
			}
		}
	}
}

function get_form_elements(form_id,name) {
	var es_all = document.getElementById(form_id).elements,
		es	= [],
		e	= null,
		i	= 0;
	if (es_all ) {
		for ( i=0; i<es_all.length; i++ ) {
			e = es_all[i];
			if (e.getAttribute('name') === name ) {
				es.push(e);
			}
		}
	}
	return es;
}

function get_value(form_id,name) {
	var ret		= [],
		es		= get_form_elements(form_id,name),
		e		= null,
		type	= '',
		val		= null,
		i		= 0,
		j		= 0;
	for ( i=0; i<es.length; i++ ) {
		e = es[i];
		type = e.getAttribute('type');
		if (in_array(type,['radio','checkbox']) ) {
			if (e.checked ) {
				ret.push(e.value);
			}
		} else if (type === "select" && e.getAttribute('multiple') ) {
			for ( j=0; j<e.options.length; j++ ) {
				if (e.options[j].selected ) {
					ret.push(e.options[j].value);
				}
			}
		} else {
			val = e.value;
			if (val === e.getAttribute('placeholder') ) {
				val = '';
			}
			ret.push(val);
		}
	}
	if (name.indexOf('[]') < 0 ) {
		ret = ret[0] === undefined ? "" : ret[0];
	}
	return ret;
}

// http://parentnode.org/javascript/working-with-the-cursor-position/
function setCaretTo(obj, pos) {
	if (obj.createTextRange) {
		var range = obj.createTextRange();
		range.move("character", pos);
		range.select();
	} else if (typeof obj.selectionStart === 'number') {
		obj.focus();
		obj.setSelectionRange(pos, pos);
	}
}

function wf2_check_implementation() {
	//debug('wf2_check_implementation');
	var testForm = document.createElement('form'),
		results = {},
		testInputs = [],
		addTestWidget = function(type,value) {
			var node = document.createElement('input');
			try {
				node.type	= type;
			} catch(e){}
			node.name		= type+'_validity_test';
			node.required	= true;
			if (type === 'radio' || type === 'checkbox' ) {
				node.checked = value;
			} else {
				node.value = value;
			}
			testForm.appendChild(node);
			testInputs.push(node);
		};
	if (testForm.checkValidity ) {
		addTestWidget('radio',false);
		addTestWidget('radio',true);
		//addTestWidget('checkbox',false);
		//addTestWidget('checkbox',true);
		addTestWidget('number','abc');
		results = {
			//type		: [supported,remove_required_if_not_supported]
			radio		: [testInputs[0].checkValidity(),	true],
			//checkbox	: [testInputs[2].checkValidity(),	true],
			number		: [!testInputs[2].checkValidity(),	false]
		};
	}
	return results;
}

function set_required(form_id,name,req) {
	//console.log('set_required',form_id,name,req);
	var node_form = document.getElementById(form_id),
		es		= get_form_elements(form_id,name),
		e		= null,
		type	= '',
		vhc		= false,	// validatiion handled correctly
		c		= true,
		i		= 0;
	for ( i=0; i<es.length; i++ ) {
		e = es[i];
		type = e.getAttribute('type');
		vhc = typeof wf2_implementation[type] !== 'undefined' ? wf2_implementation[type][0] : true;
		if (!vhc && wf2_implementation[type][1] ) {
			req = false;
		}
		if (e.form ) {
			if (req ) {
				e.setAttribute('required','required');	// !! don't set to 1, or true
			} else {
				e.removeAttribute('required');
				classNameRemove(e,'required');
			}
		}
	}
	for ( i=0; i<es.length; i++ ) {
		e = es[i];
		c = true;
		while ( c ) {
			if (classNameHas(e,'invalid') ) {
				classNameRemove(e,'invalid');
			}
			if (classNameHas(e,'field_container') ) {
				c = false;
			} else {
				e = e.parentNode;
				if ( e === node_form ) {
					c = false;
				}
			}
		}
		if (typeof set_req_callback === 'function' ) {
			set_req_callback(es[i]);
		}
	}
}

function in_array(v,a) {
	var i = 0;
	for ( i=0; i<a.length; i++ ) {
		if (a[i] === v ) {
			return true;
		}
	}
	return false;
}
function classNameHas(node,className) {
	var re = new RegExp('\\b'+className+'\\b','i'),
		str = node.className;
	return str && str.match(re);
}
function classNameAdd(node,className) {
	var str = node.className;
	if (!classNameHas(node,className) ) {
		node.className = str === null ? className : str + ' ' + className;
	}
}
function classNameRemove(node,className) {
	var str		= node.className,
		classes = [],
		i		= 0;
	if (str ) {
		classes = str.split(' ');
		for ( i=0; i<classes.length; i++ ) {
			if (classes[i].toLowerCase() === className.toLowerCase() ) {
				classes.splice(i,1);
			}
		}
		node.className = classes.join(' ');
	}
}

function getEvtTarget(evt) {
	return evt.target || evt.srcElement;
}

//addEvent(document.getElementById(id), 'event-name', handler, byAssignment);
function addEvent(obj, event_name, fnc) {
	if (typeof obj === 'string' ) {
		obj = document.getElementById(obj);
	}
	if (obj ) {
		if (obj.attachEvent ) {
			obj.attachEvent('on'+event_name, fnc);
		} else if (obj.addEventListener ) {
			obj.addEventListener(event_name, fnc, false);
		}
	}
}

function removeEvent(obj,event_name,fnc) {
	if (typeof obj === 'string' ) {
		obj = document.getElementById(obj);
	}
	if (obj ) {
		if (obj.detachEvent ) {
			obj.detachEvent('on'+event_name, fnc);
		} else if (obj.removeEventListener ) {
			obj.removeEventListener(event_name, fnc, false);
		}
	}
}

//
//from http://www.atan.cn/article.asp?id=517 and http://dean.edwards.name/weblog/2006/06/again/
function onDomLoaded(func) {
	var domTimer,
		script,
		domLoaded = false;
	if (typeof Prototype === 'object' ) {
		document.observe('dom:loaded',func);
		return;
	} else if (typeof jQuery !== 'undefined' ) {
		$(document).ready(func);
		return;
	}
	function init() {
		if (domLoaded ) {
			return;
		}
		domLoaded = true;
		if (domTimer ) {
			clearInterval(domTimer);
		}
		func.call();
		script = document.getElementById("__ie_onload");
		if (script ) {
			script.parentNode.removeChild(script);
		}
	}
	/* for Mozilla/Opera9 */
	if (document.addEventListener ) {
		document.addEventListener("DOMContentLoaded", init, false);
	}
	/* for Internet Explorer */
	/*@cc_on @*/
	/*@
	@if (@_win32)
		document.write('<script id="__ie_onload" defer><\/script>');
		script = document.getElementById("__ie_onload");
		script.onreadystatechange = function() {
			if (this.readyState === "complete" )
				init(); // call the onload handler
		};
	@end
	@*/
	/* for Safari */
	if (/WebKit/i.test(navigator.userAgent) ) {
		domTimer = setInterval( function() {
			if (/loaded|complete/.test(document.readyState) ) {
				init();
			}
		}, 10);
	}
	/* for other browsers */
	window.onload = init;
}

var wf2_implementation = wf2_check_implementation();
var functions_form_class_loaded = false;
//addEvent(window, 'focus', un_wait);
addEvent(window, 'load', function() {
	if (functions_form_class_loaded ) {
		return;
	}
	//debug('functions_form_class: window loaded');
	functions_form_class_loaded = true;
	var forms = document.getElementsByTagName('form'),
		form,
		input,
		i,
		j;
	for ( i=0; i < forms.length; i++ ) {
		form = forms[i];
		for ( j=0; j < form.length; j++ ) {
			input = form.elements[j];
			if (input.getAttribute('autofocus') !== null ) {
				try {
					input.focus();
					break;
				}
				catch(ignore){}
			}
		}
	}
});

onDomLoaded( function() {
	//debug('functions_form_class: dom loaded');
	var inputs = document.getElementsByTagName('input'),
		node,
		i;
	for ( i=0; i < inputs.length; i++ ) {
		node = inputs[i];
		input_node_observe(node);
	}
});