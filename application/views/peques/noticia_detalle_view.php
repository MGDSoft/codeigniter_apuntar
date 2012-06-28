<?php 
	echo '
		<div class="noticia_completa">
			<div class="categoria_noticia">'
				.(($admin)? '<span class="noticia_admin"> 
				<a href="'.RUTA_PORTAL.'#!admin/modificar_noticia&id='.$noticia->id_noticia.'"><img ALIGN="absmiddle" src="'.PATH_IMG.'1x1.gif" class="modificar" width="32" height="32" title="'.$this->lang->line('modificar_noticia').'" ></a> 
				<img ALIGN="absmiddle" title="'.$this->lang->line('borrar_noticia').'" src="'.PATH_IMG.'1x1.gif" class="borrar" width="32" height="32" onclick="request_simple_post(\'/forms/noticias_forms/delete_noticia\',\'&id='.$noticia->id_noticia.'\',\'\')"> </span>' : '')
				.( ( ! isset($device) && ($noticia->comentable !=0 && !count($comentarios)==0 )) ? '<img ALIGN="absmiddle" title="'.$this->lang->line('ir_a_comentarios').'" class="anchorCom" height="32" width="32" src="'.PATH_IMG.'1x1.gif" onclick="scrolToElement(\'titulo_comentarios\')" > '.$this->lang->line('categoria').': <a href="javascript:nada()" onclick="buscarCategoria(this)">'.$noticia->nombre.'</a> ' : '' ).'
			</div>
			<span class="titulo_noticia"><a href="'.RUTA_PORTAL.'#!news/'.url_title($noticia->titulo).'/'.$noticia->id_noticia.'/"><h1>'.$noticia->titulo.'</h1></a></span>
			<div class="contenido_noticia">'.parse_smileys($noticia->noticia,  PATH_IMG."smileys/").'</div>
			<div class="extras_noticia" style="border:0px">
			<form name="simple"> 
				
			    
			    <span class="extra_fecha_noticia">
					'.$noticia->noticia_fecha.'</span>';
					if ($noticia->n_votos_valoracion > 0)
						$valor=round($noticia->valoracion / $noticia->n_votos_valoracion);
					else 
						$valor =0;
					
					for ($i=1; $i<=5;$i++)
					{
						echo '<input type="radio" name="rating" value="'.$i.'" '.(($i== $valor) ? 'checked' : '').'> ';
					}
					
	echo			'<br>
			    &nbsp;&nbsp;&nbsp;&nbsp;'.$this->lang->line('votos_totales').': <span id="noticia_n_votos'.$noticia->id_noticia.'">'.$noticia->n_votos_valoracion.'</span>
			</form> 
			
				
			</div>
			
		</div>
		<div id="titulo_comentarios">
			<div>
				<span class="st_facebook_hcount" displayText="Facebook"></span>
				<span class="st_twitter_hcount" displayText="Tweet"></span>
				<span class="st_reddit_hcount" displayText="Reddit"></span>
				<span class="st_digg_hcount" displayText="Digg"></span>
				<span class="st_delicious_hcount" displayText="Delicious"></span>
				<span class="st_linkedin_hcount" displayText="LinkedIn"></span>
				<span class="st_email_hcount" displayText="Email"></span>
			</div>
			'.(($noticia->comentable == 0 &&  count($comentarios) ==0 ) ? '' : $this->lang->line('comentarios').' ('.count($comentarios).') ' ).'
		</div>
	';


//echo $this->pagination->create_links();
?>

<div class='<?= AUTO_EJECUTAR_JS ?>' style='display:none'>
	
	$$('#contenedor_variable pre').each(function(el){
		if (isIE())
			hljs.highlightBlock(el,false,true);
		else
			hljs.highlightBlock(el,false,false);
			
		numberLines(el,1,true);
		mycustom(el,'<?= $this->lang->line('copiar') ?>','<?= $this->lang->line('expandir') ?>','<?= $this->lang->line('contraer') ?>',true);
		
		<? if (isset($_SESSION['app']))
		{ ?>
		el.addEvent("swipe", function(event){
		    resultOverflow=-(event.start - event.end);
		    calculoScroll(el,resultOverflow);
		});
		<? } ?>
	});
	var basicRating = new MooStarRating({ form: 'basic',imageFolder : '<?=substr( PATH_JS,1 )?>MooStarRating/Graphics',imageHover: 'star_hover_.png',imageFull: 'star.png',imageEmpty: 'star_empty_.png',width:32,height:32 }); 
	basicRating.addEvent('click', function (value) { 
	    enviarVotoNoticia(<?= $noticia->id_noticia ?>,value) ;
	}); 
	
	document.title="<?= $titulo ?>";
	document.description="<?= $descripcion ?>";
</div>

