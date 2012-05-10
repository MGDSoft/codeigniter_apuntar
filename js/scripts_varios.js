function responder_visible(obj){
	obj_target=obj.getNext('.responder');
	if (obj_target.getStyle('display')=='none')
		obj_target.setStyle('display','');
	else
		obj_target.setStyle('display','none');
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
function llamadaMuteo(id){
	request_simple_post('/forms/comentario_form/mute','&id='+id+'&razon='+preguntar_input_value,'');
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