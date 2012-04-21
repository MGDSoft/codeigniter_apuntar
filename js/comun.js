
function caracteristicas(obj,tarjetas,asistencias,puntos,dorsal,nombre,posicion,id,nombrePuntos,tarjetasRojas){
	
	
	if (tarjetasRojas!=0)
		extra="<tr><td align='left'>T. Rojas</td><td align='center' >"+tarjetasRojas+"</td></tr>";
	else
		extra="";
	html="<table  style='color:#ffffff' ><tr valing='top'> <td colspan='2' align='center' height='20'><b>"+nombre+"</b></td></tr> <tr><td align='left'>Dorsal</td><td align='center' >"+dorsal+"</td></tr> <tr><td align='left'>Posicion</td><td align='center' >"+posicion+"</td></tr> <tr><td align='left'>Tarjetas</td><td align='center' >"+tarjetas+"</td></tr> "+extra+"<tr><td align='left'>Asistencias</td><td align='center' >"+asistencias+"</td></tr> <tr><td align='left'>"+nombrePuntos+"</td><td align='center' >"+puntos+"</td></tr></table>";texto=new TextareaContador(obj,html,id);}
function enviarFormulario(url,formid,resultado){var Formulario=document.getElementById(formid);var longitudFormulario=Formulario.elements.length;var cadenaFormulario="";var sepCampos;sepCampos="";for(var i=0;i<=Formulario.elements.length-1;i++){cadenaFormulario+=sepCampos+Formulario.elements[i].name+'='+encodeURI(Formulario.elements[i].value);sepCampos="&";}
peticion=createObject();peticion.open("POST",url,true);peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=ISO-8859-1');peticion.send(cadenaFormulario);peticion.onreadystatechange=function(){if(peticion.readyState==4&&(peticion.status==200||window.location.href.indexOf("http")==-1)){document.getElementById(resultado).innerHTML=peticion.responseText;}}}
function enviarFormularioIcono(url,formid,resultado,icono){sepCampos="";if(formid!=""){var Formulario=document.getElementById(formid);var longitudFormulario=Formulario.elements.length;var cadenaFormulario="";var sepCampos;for(var i=0;i<=Formulario.elements.length-1;i++){cadenaFormulario+=sepCampos+Formulario.elements[i].name+'='+encodeURI(Formulario.elements[i].value);sepCampos="&";}}
document.getElementById(resultado).innerHTML=icono;peticion=objetoAjax2();peticion.open("POST",url,true);peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=ISO-8859-1;multipart/form-data');peticion.send(cadenaFormulario);peticion.onreadystatechange=function(){if(peticion.readyState==4&&(peticion.status==200||window.location.href.indexOf("http")==-1)){document.getElementById(resultado).innerHTML=peticion.responseText;}}}
function enviarFormularioIconoDefault(url,formid,resultado){sepCampos="";if(formid!=""){var Formulario=document.getElementById(formid);var longitudFormulario=Formulario.elements.length;var cadenaFormulario="";var sepCampos;for(var i=0;i<=Formulario.elements.length-1;i++){cadenaFormulario+=sepCampos+Formulario.elements[i].name+'='+encodeURI(Formulario.elements[i].value);sepCampos="&";}}
document.getElementById(resultado).innerHTML='<img src="/imagenesWeb/ajax-loader.gif">';peticion=objetoAjax2();peticion.open("POST",url,true);peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=ISO-8859-1');peticion.send(cadenaFormulario);peticion.onreadystatechange=function(){if(peticion.readyState==4&&(peticion.status==200||window.location.href.indexOf("http")==-1)){if(peticion.responseText=="")
document.getElementById(resultado).innerHTML="<div style='color:blue'>Envio correcto</div>";else
document.getElementById(resultado).innerHTML=peticion.responseText;}}}

function borrarAll(id){
	$(id).fade('out');
	(function(){ $(id).destroy();}).delay(1200);
}

function borrarChat(id)
{
	borrarAll('comBor'+id);
}

