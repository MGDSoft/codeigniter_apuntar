<?php

if (!$noticias)
	echo '<div id="no_noticias"><img src="'.PATH_IMG.'vacio.png"><h1>'.$this->lang->line('no_noticias').'</h1></div>'; 
	

$i=1;
 foreach ($noticias as $noticia){
 	
	echo '
		<div class="noticia_completa listado">
			<div class="categoria_noticia">'
				.(($admin)? '<span class="noticia_admin"> 
				<a href="'.RUTA_PORTAL.'#!admin/modificar_noticia&id='.$noticia->id_noticia.'"><img ALIGN="absmiddle" src="'.PATH_IMG.'1x1.gif" class="modificar" width="32" height="32" title="'.$this->lang->line('modificar_noticia').'" ></a> 
				<img ALIGN="absmiddle" title="'.$this->lang->line('borrar_noticia').'" src="'.PATH_IMG.'1x1.gif" class="borrar" width="32" height="32"  onclick="request_simple_post(\'/forms/noticias_forms/delete_noticia\',\'&id='.$noticia->id_noticia.'\',\'\')"> </span>' : '')
				.((!isset($device))? $this->lang->line('categoria').': <a href="javascript:nada()" onclick="buscarCategoria(this)">'.$noticia->nombre.'</a>' : '' ).'
			</div>
			<span class="titulo_noticia"><a href="'.RUTA_PORTAL.'#!news/'.url_title($noticia->titulo).'/'.$noticia->id_noticia.'/"><h2>'.$noticia->titulo.'</h2></a></span>
			<div class="contenido_noticia">'.parse_smileys( $noticia->noticia, PATH_IMG."smileys/").'<br></div>
			<div class="extras_noticia '.((count($noticias) == $i ) ? 'last' : '').'">
				<span class="extra_fecha_noticia">
					'.$noticia->noticia_fecha.'</span>'
					.(($noticia->visible == 1) ? '<span class="extra_nombre">Leídos:</span> <span class="extra_valor">'.$noticia->leidos.'</span> ' : '' )
					.(($noticia->comentable == 1)? '<span class="link_falso" onclick="cargar_pagina_stadart(\'news/'.url_title($noticia->titulo).'/'.$noticia->id_noticia.'/\', \'\', \'\',\'scrollToComents()\')"><span class="extra_nombre">Comentarios:</span> <span class="extra_valor">'.$noticia->comentarios.'</span></span> <span class="extra_nombre">Valoracion:</span> <span class="extra_valor">'.((!$noticia->valoracion)? '--': round($noticia->valoracion/$noticia->n_votos_valoracion)) . '</span>' : '' )
					.'<span class="extra_nombre visible_">'.$this->lang->line('visible').':</span> <span class="extra_valor visible_"> '.(($noticia->visible == 1) ? $this->lang->line('si') : $this->lang->line('no') ).'</span> 
			</div>
			
		</div>';
	++$i;
}
$links=$this->pagination->create_links();
if ($links!="")
	echo '<div class="paginado">'.$links.'</div>';

?>

<div class='<?= AUTO_EJECUTAR_JS ?>' style='display:none'>
	$$('#contenedor_variable pre').each(function(el){

		if (el.getChildren('.custom_code').length==0)
		{
				
				if (isIE())
					hljs.highlightBlock(el,false,true);
				else
					hljs.highlightBlock(el,false,false);
					
				numberLines(el,1,true);
				
				if (nombre_unico != 'portal_devices')
					mycustom(el,'<?= $this->lang->line('copiar') ?>','<?= $this->lang->line('expandir') ?>','<?= $this->lang->line('contraer') ?>',false);
			
			
		}
	});
	document.title="<?= $titulo ?>";
	document.description="<?= $descripcion ?>";
</div>

