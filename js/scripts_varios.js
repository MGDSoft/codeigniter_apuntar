function responder_visible(obj){
	obj_target=obj.getNext('.responder');
	if (obj_target.getStyle('display')=='none')
		obj_target.setStyle('display','');
	else
		obj_target.setStyle('display','none');
}

function cargarBordes(color,fondo){
	if (fondo!="" && color!="")
	{
		var brillo1= new Color(color).mix(fondo,50);
	
	var brillo2= new Color(color).mix(fondo,85);

	modificarAtributoCSS_borderColor('ul#menu li, .comentario_completo div.extras_comentario, .formulario_estandar fieldset, .contenedorTabs .contidoTabs, .contenedorTabs .opciontab, #contenido div.extras_noticia, .formulario_estandar input, .formulario_estandar select, .formulario_estandar textarea, #contenedor_portal #footer, div.paginado a, div.paginado strong, div.paginado',color );
	modificarAtributoCSS_textBoxShadow('#caja_login div.avatar','3px 4px 6px '+brillo1.hex );
	modificarAtributoCSS_textBoxShadow('#caja_login','0px 8px 8px '+brillo1.hex );

	modificarAtributoCSS_borderColor('.comentario_completo img.avatar, span.volver a, #caja_login div.avatar',brillo1.hex);
	modificarAtributoCSS_borderColor('.respuestas div.comentario_completo',brillo2.hex);
	}
	
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
	
	
	cargar_separadores(obj,obtener_json_separadores());
	
	
}
function obtener_json_separadores(){
	return {  
		separador_fondo: $('separador_fondo').value,
		separador_color_borde: $('separador_color_borde').value,
		separador_posicion: $('separador_posicion').value,
		separador_grosor: $('separador_grosor').value,
		separador_estilo: $('separador_estilo').value,
		separador_altura: $('separador_altura').value,
		separador_posicion: $('separador_posicion').value
	};
}

function modificar_separados_json(json){
	$('separador_fondo').value=json.separador_fondo;
	$('separador_grosor').value=json.separador_grosor;
	$('separador_estilo').value=json.separador_estilo;
	
	$('separador_color_borde').value=json.separador_color_borde;
	$('separador_altura').value=json.separador_altura;
	$('separador_posicion').value=json.separador_posicion;
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
function carga_diseno_on_fly(){
	carga_diseno_opciones(obtener_json_diseno());
}
function obtener_json_diseno(){
	return {  
		fondo_color: $('fondo_color').value,
		fondo_imagen: $('fondo_imagen').value,
		fondo_estilo: $('fondo_estilo').value,
		texto_tamano: $('texto_tamano').value,
		texto_color: $('texto_color').value,
		texto_estilo: $('texto_estilo').value,
		formulario_tamano: $('formulario_tamano').value,
		formulario_color: $('formulario_color').value,
		formulario_estilo: $('formulario_estilo').value,
		botones_fondo: $('botones_fondo').value,
		botones_color: $('botones_color').value,
		botones_sombra_letra: $('botones_sombra_letra').value,
		botones_borde_color: $('botones_borde_color').value,
		botones_caja_sombra: $('botones_caja_sombra').value,
		botones_tipo_letra: $('botones_tipo_letra').value,
		titulo_color: $('titulo_color').value,
		titulo_sombra: $('titulo_sombra').value,
		titulo_principal_tamano: $('titulo_principal_tamano').value,
		titulo_estilo: $('titulo_estilo').value,
		separador_altura: $('titulo_estilo').value,
		otros_color: $('otros_color').value,
		eslogan_separacion_vertical: $('eslogan_separacion_vertical').value,
		link_color: $('link_color').value,
		link_visitado_color: $('link_visitado_color').value,
		link_tamano: $('link_tamano').value,
		bordes_color: $('bordes_color').value
	};
}
function dar_valores_diseno(jsonObj){
	 $('fondo_color').value= jsonObj.fondo_color ;
	 $('fondo_imagen').value= jsonObj.fondo_imagen ;
	 $('fondo_estilo').value= jsonObj.fondo_estilo ;
	 $('texto_tamano').value= jsonObj.texto_tamano ;
	 $('texto_color').value= jsonObj.texto_color ;
	 $('texto_estilo').value= jsonObj.texto_estilo ;
	 $('formulario_tamano').value= jsonObj.formulario_tamano ;
	 $('formulario_color').value= jsonObj.formulario_color ;
	 $('formulario_estilo').value= jsonObj.formulario_estilo ;
	 $('botones_fondo').value= jsonObj.botones_fondo ;
	 $('botones_color').value= jsonObj.botones_color ;
	 $('botones_sombra_letra').value= jsonObj.botones_sombra_letra ;
	 $('botones_borde_color').value= jsonObj.botones_borde_color ;
	 $('botones_caja_sombra').value= jsonObj.botones_caja_sombra ;
	 $('botones_tipo_letra').value= jsonObj.botones_tipo_letra ;
	 $('titulo_color').value= jsonObj.titulo_color ;
	 $('titulo_sombra').value= jsonObj.titulo_sombra ;
	 $('titulo_principal_tamano').value= jsonObj.titulo_principal_tamano ;
	 $('titulo_estilo').value= jsonObj.titulo_estilo ;
	 $('titulo_estilo').value= jsonObj.titulo_estilo ;
	 $('otros_color').value= jsonObj.otros_color ;
	 $('eslogan_separacion_vertical').value= jsonObj.eslogan_separacion_vertical ;
	 $('link_color').value= jsonObj.link_color ;
	 $('link_visitado_color').value= jsonObj.link_visitado_color ;
	 $('link_tamano').value= jsonObj.link_tamano ;
	 $('bordes_color').value= jsonObj.bordes_color ;

}

function carga_diseno_opciones(jsonObj)
{
 if (modo_espera==false)
	{
	 
	 
	 
   modificarAtributoCSS_fondo('body, #caja_login',jsonObj.fondo_color);
   modificarAtributoCSS_fondoImagen('body',jsonObj.fondo_imagen);
   $$('body')[0].className=jsonObj.fondo_estilo;
   modificarAtributoCSS_size('body',jsonObj.texto_tamano);
   modificarAtributoCSS_color('body',jsonObj.texto_color);
   $('contenedor_portal').setStyle('font-family',jsonObj.texto_estilo); 
   
   modificarAtributoCSS_size('.formulario_estandar th',jsonObj.formulario_tamano);
   modificarAtributoCSS_color('.formulario_estandar th',jsonObj.formulario_color);
   modificarAtributoCSS_fontFamily('.formulario_estandar th',jsonObj.formulario_estilo) 
   
   modificarAtributoCSS_color('#contenedor_titulo_buscador #titulo, #titulo_comentarios, .formulario_estandar legend, .formulario_estandar th.separador, #contenedor_portal #footer #contacto_f strong',jsonObj.titulo_color);
   modificarAtributoCSS_color('a:visited',jsonObj.link_visitado_color); 
   modificarAtributoCSS_color('a',jsonObj.link_color);
   modificarAtributoCSS_size('a',jsonObj.link_tamano);
   
   var botones_ids='#contenedor_titulo_buscador #buscar_boton input, .formulario_estandar .boton_standart, .boton_standart, #contenedor_titulo_buscador input[type="submit"]';
   
   modificarAtributoCSS_textShadow(botones_ids,'1px 1px 0px '+jsonObj.botones_sombra_letra);
   modificarAtributoCSS_color(botones_ids,jsonObj.botones_color);
   modificarAtributoCSS_fondo(botones_ids,jsonObj.botones_fondo);
   modificarAtributoCSS_textBoxShadow(botones_ids,'3px 4px 0px '+jsonObj.botones_caja_sombra );
   modificarAtributoCSS_textBoxShadow('.formulario_estandar .boton_standart:hover','1px 2px 1px '+jsonObj.botones_caja_sombra );
   modificarAtributoCSS_fontFamily(botones_ids,jsonObj.botones_tipo_letra);
   modificarAtributoCSS_borderColor(botones_ids,jsonObj.botones_borde_color);
   
   var titulos_ids='#contenedor_titulo_buscador #titulo, #titulo_comentarios, .formulario_estandar legend, .formulario_estandar th.separador, #contenedor_portal #footer #contacto_f strong';
   
   modificarAtributoCSS_color(titulos_ids,jsonObj.titulos_color);
   modificarAtributoCSS_textShadow('#contenedor_titulo_buscador #descripcion','0px 2px 0px '+jsonObj.titulo_sombra);
   modificarAtributoCSS_textShadow('#contenedor_titulo_buscador #titulo_desc','0px 2px 0px '+jsonObj.titulo_sombra);
   modificarAtributoCSS_size('#contenedor_titulo_buscador #descripcion',jsonObj.titulo_tamano);
   modificarAtributoCSS_size('#contenedor_titulo_buscador #titulo_desc',jsonObj.titulo_principal_tamano);
   
   modificarAtributoCSS_fontFamily(titulos_ids,jsonObj.titulo_estilo);
   
   modificarAtributoCSS_color('#contenedor_titulo_buscador #descripcion',jsonObj.otros_color);
   generic_modificarAtributoCSS('#contenedor_titulo_buscador #descripcion',jsonObj.eslogan_separacion_vertical,'marginTop');
   
   cargarBordes(jsonObj.bordes_color,jsonObj.fondo_color);
	}
}
function cargar_separadores(obj,jsonObj){
	obj.setStyles({
		backgroundColor: jsonObj.separador_fondo,
		borderColor: jsonObj.separador_color_borde, 
		'border-top-width': ((jsonObj.separador_posicion == "0px" ) ? '0px' : jsonObj.separador_grosor),
	    'border-bottom-width':jsonObj.separador_grosor,
	    'border-left-width': '0px',
	    'border-right-width': '0px',
	    borderStyle: jsonObj.separador_estilo,
	    width: '100%',
	    height: jsonObj.separador_altura,
	    position: 'absolute',
	    top:  jsonObj.separador_posicion,
	    left: 0,
	    'z-index' : '-1'
	});
}
