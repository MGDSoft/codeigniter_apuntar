function responder_visible(obj){
	obj_target=obj.getNext('.responder');
	if (obj_target.getStyle('display')=='none')
		obj_target.setStyle('display','');
	else
		obj_target.setStyle('display','none');
}

function cargarBordes(color,fondo){
	var brillo1= new Color(color).mix(fondo,50);
	var brillo2= new Color(color).mix(fondo,85);

	modificarAtributoCSS_borderColor('ul#menu li, .comentario_completo div.extras_comentario, .formulario_estandar fieldset, .contenedorTabs .contidoTabs, .contenedorTabs .opciontab, #contenido div.extras_noticia, .formulario_estandar input, .formulario_estandar select, .formulario_estandar textarea, #contenedor_portal #footer, div.paginado a, div.paginado strong, div.paginado',color );
	modificarAtributoCSS_textBoxShadow('#caja_login div.avatar','3px 4px 6px '+brillo1.hex );
	modificarAtributoCSS_textBoxShadow('#caja_login','0px 8px 8px '+brillo1.hex );

	modificarAtributoCSS_borderColor('.comentario_completo img.avatar, span.volver a, #caja_login div.avatar',brillo1.hex);
	modificarAtributoCSS_borderColor('.respuestas div.comentario_completo',brillo2.hex);
	
}
function modificar_voto(id,accion){
	if ($(id))
	{
		if (accion=='mas')
			$(id).set('text', parseInt($(id).get('text')) +1)
		else
			$(id).set('text', parseInt($(id).get('text')) -1)
	}	
}
function modificar_voto_noticia(id){
	$(id).set('text', parseInt($(id).get('text')) +1)
}
function enviarVotoNoticia(id,voto){
	request_simple_post('/forms/comentario_form/voto_noticia','&id='+id+'&voto='+voto,'')
}
function cargar_calendario(url,vars){
	request_simple_post(url,vars,'$("calendario").innerHTML=responseText');
}
function llamadaMuteo(id){
	request_simple_post('/forms/comentario_form/mute','&id='+id+'&razon='+preguntar_input_value,'');
}
function nada(){
	return false;
}

function buscarCategoria(obj){
	obj_buscadorCategorias.agregarBusqueda(obj.get('text'));
}
function ismuted(id){

	if ($$('#comentario'+id+' span.muteado').length > 0)
		return true
	else
		return false
}

function toggleModificarComentario(id)
{
	obj_modificar=$$('#comentario'+id+' div.modificar_comentario')[0];
	obj_contenido=$$('#comentario'+id+' div.contenido_comentario')[0];
	if (obj_modificar.getStyle('display')=='none')
	{
		obj_contenido.setStyle('display','none')
		obj_modificar.setStyle('display','')
	}else{
		obj_contenido.setStyle('display','')
		obj_modificar.setStyle('display','none')
	}
}

function cargarSeparadores(){
	
	separadorActu=$('separadores_guardados').value;
	var obj=null;
	if (!$("separador_"+separadorActu))
	{
		
		for (i=1;i<30;i++){
			
			if (!$("separador_"+i))
			{
				separadorActu=i;
				var obj=new Element('div', {
					'id': 'separador_'+i
				}).inject($(document.body),'top');
				
				var newoption = new Option(i, i);
				try
				{
					$('separadores_guardados').add(newoption, null);
				}
				catch (err)
				{
					$('myselect').add(newoption);
				}
				$('separadores_guardados').value=i;
				break;
			}
		}
	}else{
		
		obj=$("separador_"+separadorActu);
	}
	
	obj.setStyles({
		backgroundColor: $('separador_fondo').value,
		borderColor: $('separador_color_borde').value, 
		'border-top-width': (($('separador_posicion').value == "0px" ) ? '0px' : $('separador_grosor').value),
	    'border-bottom-width': $('separador_grosor').value,
	    'border-left-width': '0px',
	    'border-right-width': '0px',
	    borderStyle:  $('separador_estilo').value,
	    width: '100%',
	    height: $('separador_altura').value,
	    position: 'absolute',
	    top:  $('separador_posicion').value,
	    left: 0,
	    'z-index' : '-1'
	});
	
}
function borrarTodos(){

	$$("#separadores_guardados option").each(function(el) {
		if ($("separador_"+el.value))
			$("separador_"+el.value).destroy();
			
		if (el.value != 0)
			el.destroy();
	});
}
function enviarFormsSeparadores(){
	var varToSend="";
	$$("#separadores_guardados option").each(function(el) {
		valor=el.value;
		if (valor!=0)
		{
			separadorActu=$("separador_"+valor);
			
			varToSend+="&"+valor+"-fondo="+separadorActu.getStyle('background-color');
			varToSend+="&"+valor+"-grosor="+separadorActu.getStyle('border-bottom-width');
			varToSend+="&"+valor+"-estilo="+separadorActu.getStyle('border-style');
			
			varToSend+="&"+valor+"-color_borde="+separadorActu.getStyle('border-color');
			varToSend+="&"+valor+"-altura="+separadorActu.getStyle('height');
			varToSend+="&"+valor+"-posicion="+separadorActu.getStyle('top');
		}
	});
	log(varToSend);
	request_simple_post('/forms/configuracion_web_forms/separadores_update',varToSend,'');
}
function recuperarSeparador(){
	
	valor=$('separadores_guardados').value;
	if (valor==0)
	{
		separadoresToDefault();
		return ;
	}
	separadorActu=$("separador_"+valor);
	
	$('separador_fondo').value=separadorActu.getStyle('background-color');
	$('separador_grosor').value=separadorActu.getStyle('border-bottom-width');
	$('separador_estilo').value=separadorActu.getStyle('border-style');
	
	$('separador_color_borde').value=separadorActu.getStyle('border-color');
	$('separador_altura').value=separadorActu.getStyle('height');
	$('separador_posicion').value=separadorActu.getStyle('top');
}

function borrarSeparador(){
	valor=$('separadores_guardados').value;
	if (valor!=0 && $("separador_"+valor))
	{	
		separadorActu=$("separador_"+valor);
		separadorActu.destroy();
		
		$$("#separadores_guardados option[value='"+valor+"']").each(function(el) {
			el.destroy();
		});
	}
}
function separadoresToDefault(){
	
	$('separador_fondo').value='#F5F5F5';
	$('separador_grosor').value='1px';
	$('separador_estilo').value='solid';
	
	$('separador_color_borde').value='#CCCCCC';
	$('separador_altura').value='60px';
	$('separador_posicion').value='100px';
}

function enviar_correo_request(id){
	request_simple_post("extras/correo/enviar_correo", 'id='+id+'&texto_correo='+encodeURIComponent(preguntar_input_value) , '');
}

