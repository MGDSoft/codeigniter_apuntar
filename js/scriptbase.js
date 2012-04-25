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
		
		$(formulario).set('send',{url:getHostname() + url_envio
		,method:'post'
		,onRequest:function(){ submit_cargando(formulario); }
		,onComplete:function(responseText){

			submit_cargado(formulario);
			
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
