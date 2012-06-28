<?php 
$i=0;
$comentarios_hijos=array();
foreach ($comentarios as $comentario){
	if ($comentario->id_respuesta != 0)
		$comentarios_hijos[$i]=$comentario;
	
	++$i;
}

if (!isset($device))
	$device=false;

foreach ($comentarios as $comentario){
	if ($comentario->id_respuesta == 0)
		write_comment($comentario,$comentarios_hijos,$comentarios,$admin,$nombre_unico,$noticia,$id_web,$usuario_configuracion,$comentable,$device,0);
}

function write_comment($comentario,$comentarios_hijos,$comentarios,$admin,$nombre_unico,$noticia,$id_web,$usuario_configuracion,$comentable,$device,$nivel){
	$thiss=& get_instance();
	
	++$nivel;
	
	echo 
		'<div id="comentario'.$comentario->id_comentario.'" class="comentario_completo ">
			<span class="este_comentario '.(($id_web == $comentario->id_usuario) ? 'propietario' : '' ).'">
				<img class="avatar" src="http://'.URL_BASE.'/'.PATH_IMG.'usuario/avatar/'.$comentario->avatar.'" title="'.$comentario->nombre.' '.$comentario->apellidos.'">
				<div class="categoria_noticia">
					'.(((isset($_SESSION['usuario']) && $_SESSION['usuario']->id_usuario== $comentario->id_usuario && $comentario->mute == 0 ) || ($admin)) ? '<span class="comentario_admin"> '
						.((isset($_SESSION['usuario']) && $_SESSION['usuario']->id_usuario== $comentario->id_usuario && $comentario->mute == 0 ) ? '<img ALIGN="absmiddle" src="'.PATH_IMG.'1x1.gif" class="modificar" width="32" height="32"  onclick="toggleModificarComentario('.$comentario->id_comentario.')" title="'.$thiss->lang->line('modificar_noticia').'" >' : '' )
						.(($admin)? '
								<img ALIGN="absmiddle" width="24" height="24" title="'.$thiss->lang->line('muter_comentario').'" src="'.PATH_IMG.'1x1.gif" class="mute" width="32" height="32"  onclick="if (ismuted('.$comentario->id_comentario.')==false) preguntar_input(\''.$thiss->lang->line('mute_titulo').'\',\''.$thiss->lang->line('mute_default').'\',\'llamadaMuteo('.$comentario->id_comentario.')\'); else llamadaMuteo('.$comentario->id_comentario.');">
								<img ALIGN="absmiddle" width="24" height="24" title="'.$thiss->lang->line('borrar_comentario').'" src="'.PATH_IMG.'1x1.gif" class="borrar" width="32" height="32" onclick="request_simple_post(\'/forms/comentario_form/delete\',\'&id='.$comentario->id_comentario.'\',\'\')">
									 ' : '').'
					</span>' : '' ).'			
				</div>
				<span class="nombre_autor">'.substr( (($comentario->id_usuario == ID_ANONIMO ) ?  $thiss->lang->line('anonimo') : $comentario->nombre.' '.$comentario->apellidos),0, ((isset($device)) ? 16 :  100 )).'</span> 
				<div class="contenido_comentario">'
					.(($comentario->mute==1) ?  '<span class="muteado"><img ALIGN="absmiddle" width="48" height="48"  src="'.PATH_IMG.'1x1.gif" class="muteado"> <b>'.$thiss->lang->line('comentario_muteado').'</b>, '.$thiss->lang->line('mute_default').': '.$comentario->razon : nl2br(parse_smileys($comentario->comentario,  PATH_IMG."smileys/")))			
			  .'</div>';
	
				$vars['accion']='update';$vars['fieldset']=false;$vars['comentario']=$comentario;$vars['comentable']=true;
				
		echo 	((isset($_SESSION['usuario']) && $_SESSION['usuario']->id_usuario== $comentario->id_usuario && $comentario->mute == 0 ) ? '
			  	<div class="modificar_comentario" style="display: none">
			  		'.$thiss->load->view('forms/comentario_fview',$vars,true).'
			  	</div>
			  		' : '' ).
		 	   '<div class="extras_comentario">
		 	   	'.(($comentario->editado >0 ) ? '<span class="editado">'.$thiss->lang->line('editado').': '.$comentario->editado.' '.$thiss->lang->line('veces').'</span>' : '').'
		 	   		<span class="fecha_come">'.$thiss->lang->line('fecha').': '.$comentario->fecha.'</span>	
					<img src="'.PATH_IMG.'1x1.gif" width="24" height="24" class="positivo" onclick="request_simple_post(\'/forms/comentario_form/voto_positivo\',\'&id='.$comentario->id_comentario.'\',\'\')" align="absmiddle"> <span id="comentario_voto_positivo'.$comentario->id_comentario.'">'.$comentario->votos_positivos.'</span>
					<img src="'.PATH_IMG.'1x1.gif" width="24" height="24" class="negativo" onclick="request_simple_post(\'/forms/comentario_form/voto_negativo\',\'&id='.$comentario->id_comentario.'\',\'\')" align="absmiddle"> <span id="comentario_voto_negativo'.$comentario->id_comentario.'">'.$comentario->votos_negativos.'</span>
					';
					if ($comentable && $nivel < 4)
					{
		echo		'<input type="button" id="resp_to'.$comentario->id_comentario.'" style="margin-left:10px" class="boton_standart" onclick="responder_visible($(\'resp_to'.$comentario->id_comentario.'\'))" value="'.$thiss->lang->line('responder').'">	
				
					<div class="responder" style="display:none">
						';
						$vars['accion']='insert';$vars['id_respuesta']=$comentario->id_comentario;$vars['comentario']=null;$vars['comentable']=$comentable;
						$thiss->load->view('forms/comentario_fview',$vars);
						
		echo		'</div>';
					}
					
				
		echo	'</div>
			</span>
			<div class="respuestas">
			';$i=0;
				foreach ($comentarios_hijos as $coment_search){
					if ($comentario->id_comentario == $coment_search->id_respuesta)
					{
						write_comment($coment_search,$comentarios_hijos,$comentarios,$admin,$nombre_unico,$noticia,$id_web,$usuario_configuracion,$comentable,$device,$nivel);
					}
					++$i;
				}
	echo	'</div>
		</div>';
}



?>

<div class='<?= AUTO_EJECUTAR_JS ?>' style='display:none'>
	reloadAllCaptchasOnclick('');
</div>

