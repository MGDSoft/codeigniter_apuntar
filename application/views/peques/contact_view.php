			<span class="contacto_links">
			<?php 
			if ( isset($usuario_configuracion)  )
			{?>
				<?= (($usuario_configuracion->contacto_pagina_personal != "")? '<a href="'.$usuario_configuracion->contacto_pagina_personal.'" target="_blank"><img width="32" height="32" class="pag_perso" src="'.PATH_IMG.'1x1.gif" alt="'.$this->lang->line('contacto_pagina_personal').'" title="'.$this->lang->line('contacto_pagina_personal').'"></a>' : '' )?>
	 			
	 			<?= (($usuario_configuracion->contacto_steam != "")? '<a href="'.$usuario_configuracion->contacto_steam.'" target="_blank"><img width="32" height="32"  class="steam" src="'.PATH_IMG.'1x1.gif"></a>' : '' )?>
	 			<?= (($usuario_configuracion->contacto_youtube != "")? '<a href="'.$usuario_configuracion->contacto_youtube.'" target="_blank"><img width="32" height="32"  class="youtube" src="'.PATH_IMG.'1x1.gif"></a>' : '' )?>
	 			
	 			<?= (($usuario_configuracion->contacto_tuenti != "")? '<a href="'.$usuario_configuracion->contacto_tuenti.'" target="_blank"><img width="32" height="32" class="tuenti" src="'.PATH_IMG.'1x1.gif"></a>' : '' )?>
	 			<?= (($usuario_configuracion->contacto_email != "")	? '<img width="32" height="32"  class="email" src="'.PATH_IMG.'1x1.gif" onclick="preguntar_formulario('.$usuario_configuracion->id_usuario.',\''.$this->lang->line('titulo_ventana_correo').'\',\'enviar_correo_request('.$usuario_configuracion->id_usuario.')\')">' : '' )?>
	 			<?= (($usuario_configuracion->contacto_twitter != "")? '<a href="'.$usuario_configuracion->contacto_twitter.'" target="_blank"><img width="32" height="32"  class="twitter" src="'.PATH_IMG.'1x1.gif"></a>' : '' )?>
	 			<?= (($usuario_configuracion->contacto_facebook != "")? '<a href="'.$usuario_configuracion->contacto_facebook.'" target="_blank"><img width="32" height="32"  class="facebook" src="'.PATH_IMG.'1x1.gif"></a>' : '' )?>
	 			
	 			<?= ((isset($usuario_configuracion->nombre_unico)) ? '<a href="/'.$usuario_configuracion->nombre_unico .'/rss" target="_blank"><img  width="32" height="32" class="rss" src="'. PATH_IMG .'1x1.gif"></a>' :'') ?>
 			<?php 
			} ?>
 			</span>