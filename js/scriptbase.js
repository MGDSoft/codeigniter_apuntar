var carpetaImg = "/img/";
var iconoRapidoDefaultAjax = "<img src='" + carpetaImg + "ajax-loader.gif'>";

function getHostname() {
	return "http://" + window.location.hostname;
}

function redirect(url) {
	window.location = getHostname() + url;
}
function submit_cargando(formulario) {

	waiter_run();

	obj = $$('#' + formulario + ' input[type="submit"]')[0];
	obj.setStyle('display', 'none');
	contenedor = obj.getParent();
	contenedor.innerHTML = contenedor.innerHTML + iconoRapidoDefaultAjax;

}

function submit_cargado(formulario) {

	waiter_disable();

	obj = $$('#' + formulario + ' input[type="submit"]')[0];

	contenedor = obj.getParent();
	img = contenedor.getChildren("img");
	img.destroy();
	obj.setStyle('display', '');

}

function comprobar_estado_form(form) {
	validacion = true;

	$$('#' + form + ' input[validacion="si"]').each(function(el) {

		var objReferencia = $(el.get('id').substring(18));

		eval("validacion_mgd" + el.get('aviso'));

		if (el.value == 0)
			validacion = false;

	});

	return validacion;
}

function enviar_form_ajax(formulario, url_envio, ver_resultado, ejecutar_si_ok,
		redirect_url) {

	valido = comprobar_estado_form(formulario);

	if ($(ver_resultado)) {
		$(ver_resultado).className = '';
		$(ver_resultado).innerHTML = '';
	}

	if (valido) {
		var llego = 0;
		$(formulario).set('send', {
			url : getHostname() + url_envio,
			method : 'post',
			onRequest : function() { // submit_cargando(formulario);

			},
			onSuccess : function(responseText) {

				// submit_cargado(formulario);

				if ($(ver_resultado))
					$(ver_resultado).innerHTML = responseText;

				if (responseText != "OK") {
					alert("error: " + responseText + ".");
					if (ver_resultado != "" && $(ver_resultado)) {
						$(ver_resultado).innerHTML = responseText;
					} else
						eval(responseText);

				} else {
					alert("OK -> exec" + ejecutar_si_ok);
					if (ejecutar_si_ok != "")
						eval(ejecutar_si_ok);
					else if (redirect_url != "ok")
						redirect(redirect_url);
				}
			}
		}).send();
	}
}

function request_simple_post(url_txt, vars, eval_to_do) {

	new Request({
		url : url_txt,
		method : 'post',
		data : vars,
		onRequest : function() {
			waiter_run();
		},
		onSuccess : function(responseText) {

			alert(responseText);

			waiter_disable();
			if (eval_to_do != '')
				eval(eval_to_do);

			if (responseText != '')
				eval(responseText);

		},
		onFailure : function() {
			alert('error no response');
			waiter_disable();
			}
	}).send(vars);
}

function cargar_pagina_stadart(url_txt, vars, caja_respuesta,evalToDo) {
	
	var caja_respuesta_txt;
	
	if (!$(caja_respuesta))
		caja_respuesta_txt = 'contenedor_variable';
	else
		caja_respuesta_txt = caja_respuesta;
	
	if (url_txt == '' || url_txt == '/') {
		cargar_pagina_stadart('listado_noticias', '', '',evalToDo);
		return;
	}

	
	caja_respuesta = $(caja_respuesta_txt);
	

	/*
	 * pos=url_txt.indexOf("/")+1;
	 * 
	 * if (url_txt.length <= pos || pos==0) hash_txt = ''; else hash_txt=
	 * url_txt.substring(pos);
	 */
	location.hash = '!' + url_txt + vars;
	
	vars = 'nombre_unico=' + nombre_unico + '&ishash=1&' + vars;
	
	new Request({
		url : '/' + url_txt,
		method : 'post',
		data : vars,
		onRequest : function() {
			waiter_run();
			if (caja_respuesta.get('slide'))
			{
				caja_respuesta.set('slide', {mode:'horizontal' ,duration: 'long'});
				caja_respuesta.get('slide').slideOut();
			}
		},
		onSuccess : function(responseText) {
			
			waiter_disable();
			caja_respuesta.empty();
			caja_respuesta.innerHTML = responseText;
			
			if (caja_respuesta.get('slide'))
			{
				
				caja_respuesta.get('slide').slideIn();
			}
			(function() {
				
				
				runJS(caja_respuesta_txt);
				(function() {
					if (evalToDo!='' )
						eval(evalToDo);
				}).delay(500);
				
			}).delay(500);
		},
		onFailure : function() {
			waiter_disable();
			alert('error no response');

		}
	}).send(vars);
}

function runJS(caja_respuesta_txt) {
	window.addEvent('domready', function() {
		$$('#'+caja_respuesta_txt+' .'+auto_ejecutar_js).each(function(el) {
			
				eval(el.innerHTML);
			});
	});

}

function cargarPaginaInit(evalToDo) {

	var url = location.hash;

	if (url == "" || url == "undefined" || !url) {
		cargar_pagina_stadart('listado_noticias', '', '','');
		return;
	} else {

		var brokenstring = url.split("&");
		var variables;
		if (url.length <= brokenstring[0].length)
		{
			variables = '';
		}else{
			variables = url.substring(brokenstring[0].length );
		}
			
		alert(variables);
		var aux = "";

		cargar_pagina_stadart(brokenstring[0].substring(2), variables, '',evalToDo);

	}
}
function reloadActual(evalToDo) {
	cargarPaginaInit(evalToDo);
}

function reloadAllCaptchasOnclick(padre) {
	
	if (padre='' || !$(padre))
		padre = 'contenedor_variable';
	
	$$('#'+padre+' img.captcha').each(function(el) {
		el.addEvent('click', function(){
			createNewCaptcha();
		});
	});
}

function reloadAllCaptchas(src) {
	$$('img.captcha').each(function(el) {
		el.set('src',src);
	});
}

function createNewCaptcha() {
	request_simple_post('extras/captcha/nuevo_captcha', '', '');
}

function scrolToElement(idElement){
	if ($(idElement))
		var myFx = new Fx.Scroll(window).toElement(idElement);
	else
		alert('no existe');

}
function highLight(idElement){
	window.addEvent('domready', function() {
	if ($(idElement))
		$(idElement).highlight('#ddf');
});
}

var chainDo = new Class({
	  Implements: Chain,
	  initialize: function(){
	    this.chain.apply(this, arguments);
	  }
	});
