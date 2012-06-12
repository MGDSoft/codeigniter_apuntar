<?php 

foreach ($web_configuracion_separadores as $separador)
{
	echo '<div id="separador_'.$separador->id_separador.'" style="background-color: '.$separador->fondo.'; border-top-color: '.$separador->color_borde.'; border-right-color: '.$separador->color_borde.'; border-bottom-color: '.$separador->color_borde.'; border-left-color: '.$separador->color_borde.'; border-top-width: '.(($separador->posicion != '0px') ? $separador->grosor : '0px').'; border-bottom-width: '.$separador->grosor.'; border-left-width: 0px; border-right-width: 0px; border-top-style: '.$separador->estilo.'; border-right-style: '.$separador->estilo.'; border-bottom-style: '.$separador->estilo.'; border-left-style: '.$separador->estilo.'; width: 100%; height: '.$separador->altura.'; position: absolute; top: '.$separador->posicion.'; left: 0px; z-index: -1;"></div>';
}

?> 