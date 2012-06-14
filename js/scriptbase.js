var carpetaImg = "/img/";
var iconoRapidoDefaultAjax = "<img src='" + carpetaImg + "ajax-loader.gif'>";

function isIE()
{return document.all?true:false;}

function getHostname() {
	return "http://" + window.location.hostname;
}

function redirect(url) {
	window.location = getHostname() + url;
}
function submit_cargando(formulario) {

	waiter_run();

	obj = $$('#' + formulario + ' input.boton_standart')[0];
	if (obj)
	{
		obj.setStyle('display', 'none');
		contenedor = obj.getParent();
		contenedor.innerHTML = contenedor.innerHTML + iconoRapidoDefaultAjax;
	}
}

function submit_cargado(formulario) {

	waiter_disable();

	obj = $$('#' + formulario + ' input.boton_standart')[0];
	if (obj)
	{
	contenedor = obj.getParent();
	img = contenedor.getChildren("img");
	img.destroy();
	obj.setStyle('display', '');
	}

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
			onRequest : function() { 
				submit_cargando(formulario);
			},
			onSuccess : function(responseText) {
				log("respuesta");
				submit_cargado(formulario);
	
				if ($(ver_resultado))
					$(ver_resultado).innerHTML = responseText;
	
				if (responseText != "OK") {
					log("error: " + responseText + ".");
					if (ver_resultado != "" && $(ver_resultado)) {
						$(ver_resultado).innerHTML = responseText;
					} else
						eval(responseText);
	
				} else {
					log("OK -> exec" + ejecutar_si_ok);
					if (ejecutar_si_ok != "")
						eval(ejecutar_si_ok);
					else if (redirect_url != "ok")
						redirect(redirect_url);
				}
			}
		}).send();
	
	$(formulario).eliminate('send');
	
	
	
		
	}
}

function request_simple_post(url_txt, vars, eval_to_do) {
	
	vars=extra_vars+vars;
	log('envio vars: '+vars);
	
	new Request({
		url : url_txt,
		method : 'post',
		data : vars,
		onRequest : function() {
			if (!isIE())
				waiter_run();
		},
		onSuccess : function(responseText) {

			log(responseText);
			if (!isIE())
				waiter_disable();
			
			if (eval_to_do != '')
				eval(eval_to_do);
			else{
				if (responseText != '')
					eval(responseText);
			}
			

		},
		onFailure : function() {
			alert('error no response');
			if (!isIE())
				waiter_disable();
			}
	}).send(vars);
}


function darAnchoContenedorVariable(){
	
	contenedor=$('contenedor_variable');
	contenedor.setStyle('width',contenedor.getStyle('width'));
		
}

function cargar_pagina_stadart(url_txt, vars, caja_respuesta,evalToDo) {
	
	
	
	var caja_respuesta_txt;
	var hasNuevo;
	
	if (!$(caja_respuesta))
		caja_respuesta_txt = 'contenedor_variable';
	else
		caja_respuesta_txt = caja_respuesta;
	
	
	if (url_txt == '' || url_txt == '/') 
	{
		// auto carga esta misma funcion por medio del detectos de cambios de hash
		// que hay implementado
		if (nombre_unico!='portada')
			hasNuevo= '!listado_noticias' + vars;
		else
			hasNuevo= '!portada' + vars;
		
		if (location.hash != "#"+hasNuevo)
		{
			location.hash= hasNuevo;
			if (evalToDo!='' )
			{
				(function() {
					eval(evalToDo);
				}).delay(1000);
			}	
			return;
		}
	}

	caja_respuesta = $(caja_respuesta_txt);
	

	/*
	 * pos=url_txt.indexOf("/")+1;
	 * 
	 * if (url_txt.length <= pos || pos==0) hash_txt = ''; else hash_txt=
	 * url_txt.substring(pos);
	 */
	
	hasNuevo = '!' + url_txt + vars;
	
	if (location.hash != "#"+hasNuevo)
	{
		location.hash = hasNuevo;
		if (evalToDo!='' )
		{
			(function() {
				eval(evalToDo);
			}).delay(1000);
		}
		return;  // revisar
	}
	
	vars = extra_vars + 'nombre_unico=' + nombre_unico + '&ishash=1&' + vars;
	log("peticion "+url_txt + " vars "+vars);
	new Request({
		url : '/' + url_txt,
		method : 'post',
		data : vars,
		onRequest : function() {
			if (!isIE())
				waiter_run();
			
			if (caja_respuesta.get('slide') && !isIE())
			{
				caja_respuesta.set('slide', {mode:'horizontal' ,duration: 'long'});
				caja_respuesta.get('slide').slideOut();
			}
		},
		onSuccess : function(responseText) {
			
			//log(responseText);
			if (!isIE())
				waiter_disable();
			
			caja_respuesta.empty();
			caja_respuesta.innerHTML = responseText;
			
			if (caja_respuesta.get('slide') && !isIE())
			{
				
				caja_respuesta.get('slide').slideIn();
			}
			//(function() {
				runJS(caja_respuesta_txt);
				
				if (evalToDo!='' )
					eval(evalToDo);
				
				setPosBottom();
				
			//}).delay(600);
		},
		onFailure : function() {
			log('fail');
			if (!isIE())
				waiter_disable();
			
			alert('error no response');

		}
	}).send(vars);
}
function copyToClipboard (text) {
	  window.prompt ("Copy to clipboard: Ctrl+C, Enter", text);
}
function runJS(caja_respuesta_txt) {
	window.addEvent('domready', function() {
		$$('#'+caja_respuesta_txt+' .'+auto_ejecutar_js).each(function(el) {
				eval(el.innerHTML);
			});
	});

}

function cargarPaginaInit(evalToDo) {
	darAnchoContenedorVariable();
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
			
		log(variables);
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
function setPosBottom(){
	if (!isIE() && extra_vars == "")
	{ 
		var posFooter=$('footer').getCoordinates();
		spy.options.min=posFooter.top-600;
	}
}
function scrolToElement(idElement){
	if ($(idElement))
		var myFx = new Fx.Scroll(window).toElement(idElement);
}
function scrollToComents(){
	scrolToElement('titulo_comentarios');
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
function generic_modificarAtributoCSS(class_name,color_txt,style_txt){
	
	[].every.call( document.styleSheets, function ( sheet ) {
	    return [].every.call( sheet.cssRules, function ( rule ) {
	    	
	        if ( rule.selectorText === class_name ) {
	        	
	            eval("rule.style." +style_txt+"= color_txt");
	            return false;
	        }
	        return true;
	    });
	});
}
function log (str){
    if (window.console) console.log('[apuntes] ' + str);        
}

function modificarAtributoCSS_color(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,color_txt,'color');
}
function modificarAtributoCSS_size(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,color_txt,'fontSize');
}
function modificarAtributoCSS_fondo(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,color_txt,'backgroundColor');
}
function modificarAtributoCSS_fondoImagen(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,"url('" + color_txt + "')",'backgroundImage');
}
function modificarAtributoCSS_borderSize(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,color_txt,'borderWidth');
}
function modificarAtributoCSS_borderStyle(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,color_txt,'borderStyle');
}
function modificarAtributoCSS_borderColor(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,color_txt,'borderColor');
}
function modificarAtributoCSS_fontFamily(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,color_txt,'fontFamily');
}
function modificarAtributoCSS_textShadow(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,color_txt,'textShadow');
}
function modificarAtributoCSS_textBoxShadow(class_name,color_txt){
	generic_modificarAtributoCSS(class_name,color_txt,'boxShadow');
}
function activarTab(id,obj){
	log(obj.innerHTML);
	var Padretab=obj.getParent();
	Padretab.getChildren('.opciontab').each(function(el) {
		if (el==obj){
			el.addClass('active');
		}else{
			if (el.hasClass('active'))
				el.removeClass('active');
		}
	});
	
	contidoTabs=obj.getNext('.contidoTabs');
	contidoTabs.getChildren('.tabcontenido').each(function(el) {
		if (el.get('id')==id){
			
			el.style.display='';
		}else{
			
			el.style.display='none';
		}
	});
}
function volver(){
	
}