var carpetaImg="/img/";
var iconoRapidoDefaultAjax="<img src='"+carpetaImg+"ajax-loader.gif'>";

function getHostname() {
	return "http://" + window.location.hostname;
}

function redirect(url)
{
	window.location=getHostname()+url;
}
function submit_cargando(formulario){

	waiter_run();
	
	obj=$$('#'+formulario + ' input[type="submit"]')[0];
	obj.setStyle('display','none');
	contenedor = obj.getParent();
	contenedor.innerHTML=contenedor.innerHTML + iconoRapidoDefaultAjax;

}

function submit_cargado(formulario){

	waiter_disable();
	
	obj=$$('#'+formulario + ' input[type="submit"]')[0];
	
	contenedor = obj.getParent();
	img=contenedor.getChildren("img");
	img.destroy();
	obj.setStyle('display','');

}

function comprobar_estado_form(form){
	validacion=true;
	
	$$('#'+form + ' input[validacion="si"]').each(function(el)
	{
		
		var objReferencia=$(el.get('id').substring(18));
		
		eval("validacion_mgd"+el.get('aviso'));
		
		if (el.value==0)
			validacion=false;
		
	});
	
	return validacion;
}


function enviar_form_ajax(formulario,url_envio,ver_resultado,ejecutar_si_ok,redirect_url){
		
	valido=comprobar_estado_form(formulario);
	
	if ($(ver_resultado))
	{
		$(ver_resultado).className='';
		$(ver_resultado).innerHTML='';
	}
	
	if (valido)
	{
		var llego=0;
		$(formulario).set('send',{url:getHostname() + url_envio
		,method:'post'
		,onRequest:function(){ //submit_cargando(formulario); 
			
		}
		,onSuccess:function(responseText){

			
			//submit_cargado(formulario);
			
			if ($(ver_resultado))
				$(ver_resultado).innerHTML=responseText;

			
			if (responseText!="OK")		
			{
				alert("error: "+responseText + ".");
				if (ver_resultado != "" && $(ver_resultado))
				{
					$(ver_resultado).innerHTML=responseText;
				}else
					eval(responseText);
				
			}else{
				alert("OK -> exec" + ejecutar_si_ok);
				if (ejecutar_si_ok!="")
					eval(ejecutar_si_ok);
				else if (redirect_url !="ok")
					redirect(redirect_url);
			}
		}}).send();
	}
}



function request_simple_post(url_txt,vars,eval_to_do){
	waiter_run();
	new Request({
	    url: url_txt,
	    method: 'post',
	    data: vars,
	    onRequest: function(){
	    	
	    },
	    onSuccess: function(responseText){
	    	
	    	alert(responseText);
	    	waiter_disable();
	    	if (eval_to_do)
	    		eval(eval_to_do);
	    	
	    	if (responseText)
	    		eval(responseText);
	    	
	    	
	    },
	    onFailure: function(){
	    	waiter_disable();
	    	alert('error no response');
	    	
	    }
	}).send(vars);
}

function cargar_pagina_stadart (url_txt,vars,caja_respuesta){
	
	if (!caja_respuesta)
		caja_respuesta=$('contenedor_variable');
	else
		caja_respuesta=$(caja_respuesta);
	
	pos=url_txt.indexOf("/")+1;
	
	if (url_txt.length <= pos || pos==0)
		hash_txt = '';
	else
		hash_txt= url_txt.substring(pos);
	
	location.hash = hash_txt+vars;
	vars='ishash=1'+vars;
	alert(vars);
	new Request({
	    url: url_txt,
	    method: 'get',
	    data: vars,
	    onRequest: function(){
	    	waiter_run();
	    },
	    onSuccess: function(responseText){
	    	
	    	waiter_disable();
	    	caja_respuesta.innerHTML=responseText;
	    	
	    	(function(){ runJS(auto_ejecutar_js); }).delay(500);
	    },
	    onFailure: function(){
	    	waiter_disable();
	    	alert('error no response');
	    	
	    }
	}).send(vars);
}

function runJS(Idobj) 
{ 
	window.addEvent('domready', function(){
			if ($(Idobj))
				eval($(Idobj).innerHTML);	
		});
	
}