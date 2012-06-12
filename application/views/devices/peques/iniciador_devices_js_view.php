<script type="text/javascript">
var js_categoria_modificar_titulo = '<?= $this->lang->line('js_categoria_modificar_titulo') ?>';
var js_categoria_borrar_titulo = '<?= $this->lang->line('js_categoria_borrar_titulo') ?>';
var js_categoria_borrar = '<?= $this->lang->line('js_categoria_borrar') ?>';
var js_categoria_incluir_titulo = '<?= $this->lang->line('js_categoria_incluir_titulo') ?>';
var nombre_unico = 'portal_devices';
var id_web = '<?= ((isset($id_web))? $id_web : '') ?>';
var extra_vars = 'device=1&';

var auto_ejecutar_js='<?= AUTO_EJECUTAR_JS ?>';

var obj_menu_carpetas;


var msg_waiter = new Message({ 	 		
icon: "blackWaiter.gif",   		
title: "<?= $this->lang->line('js_msg_cargando') ?>",   		
message: "<?= $this->lang->line('js_msg_titlo') ?>" 
});

var preguntar_input_value='';
function preguntar_input(titulo,valor_default,objRequest) 
{
	<?= printf(MSG_QUESTION_DEFAULT,'titulo','"+valor_default+"' ,"'preguntar_input_value=$(\"js_commentText\").value ;'+ objRequest"); ?>
	
}

function preguntar_si_no(titulo,descripcion,objRequest) 
{
	<?= printf(MSG_QUESTION_SI_NO_DEFAULT,'titulo','descripcion',"objRequest"); ?>	
}
var waiter_run = function(){if (msg_waiter.isDisplayed) msg_waiter.dismiss();  msg_waiter.waiter();};
var waiter_disable = function(){msg_waiter.dismiss() };

window.addEvent('domready', function() {
	<?= ((isset($_SESSION['usuario'])) ? 'cargarPaginaInit();' : '' ) ?>
				
	<? if (isset($_SESSION['usuario']))
	{
		?>
		obj_buscador_sugerencias=new buscadorCategorias($('buscador_txt'),<?= $usuario_configuracion->id_usuario ?>,'/extras/buscador/buscar_sugerencias',1);
		obj_buscadorCategorias=new buscadorCategorias($('buscador_tipo'),<?= $usuario_configuracion->id_usuario ?>,'/extras/buscador/buscar_categorias',0);
	
		$$('#buscar_boton input')[0].addEvent('click', function(){
			
			var parametros='&id_web=' + id_web + '&categoria=' + obj_buscadorCategorias.getValorInput() + '&valor=' + obj_buscador_sugerencias.getValorInput() + '';
			cargar_pagina_stadart('buscador',parametros,'','');
			obj_buscador_sugerencias.vaciarCajaSugerencias();
			obj_buscadorCategorias.vaciarCajaSugerencias();
		});
	<? } ?>
	var HM = new HashListener();
	var anteriorHas;
	HM.addEvent('hashChanged',function(new_hash){ 
		
		if (new_hash != anteriorHas)
		{
			
			anteriorHas=new_hash;
			cargarPaginaInit();
		}
		
	}); 	
});



</script>