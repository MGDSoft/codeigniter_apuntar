<script type="text/javascript">
var js_categoria_modificar_titulo = '<?= $this->lang->line('js_categoria_modificar_titulo') ?>';
var js_categoria_borrar_titulo = '<?= $this->lang->line('js_categoria_borrar_titulo') ?>';
var js_categoria_borrar = '<?= $this->lang->line('js_categoria_borrar') ?>';
var js_categoria_incluir_titulo = '<?= $this->lang->line('js_categoria_incluir_titulo') ?>';
var nombre_unico = '<?= $usuario_configuracion->nombre_unico ?>';
var id_web = '<?= $usuario_configuracion->id_usuario ?>';

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
var modificadorStylos;
var spy;
var obj_buscadorCategorias;
var obj_buscador_sugerencias;
window.addEvent('domready', function() {

	
	
	cargarPaginaInit();
	obj_menu_carpetas=new menuCarpetas('menu',<?= $usuario_configuracion->id_usuario ?>,'<?= $this->lang->line('opciones_txt') ?>','<?= $this->lang->line('carpeta_hija_txt') ?>','<?= $this->lang->line('modificar_nombre_txt') ?>','<?= $this->lang->line('borrar_txt') ?>');
	obj_buscador_sugerencias=new buscadorCategorias($('buscador_txt'),<?= $usuario_configuracion->id_usuario ?>,'/extras/buscador/buscar_sugerencias',1);
	obj_buscadorCategorias=new buscadorCategorias($('buscador_tipo'),<?= $usuario_configuracion->id_usuario ?>,'/extras/buscador/buscar_categorias',0);

	$$('#buscar_boton input')[0].addEvent('click', function(){
		
		var parametros='&id_web=' + id_web + '&categoria=' + obj_buscadorCategorias.getValorInput() + '&valor=' + obj_buscador_sugerencias.getValorInput() + '';
		cargar_pagina_stadart('buscador',parametros,'','');
		obj_buscador_sugerencias.vaciarCajaSugerencias();
		obj_buscadorCategorias.vaciarCajaSugerencias();
	});

	if (!isIE())
	{
		spy = new ScrollSpy({ 
		    min: 1000, 
		    onEnter: function() { 
		        $('gotodown').fade('out');
		    }, 
		    onLeave: function() { 
		    	$('gotodown').fade('in'); 
		    } 
		});

		/* my "Go To Top" link element */ 
		var link = document.id('gototop'); 
		/* scrollspy instance */ 
		var ss = new ScrollSpy({ 
		    min: 300, 
		    onEnter: function() { 
		        link.fade('in'); //show the "Go To Top" link 
		    }, 
		    onLeave: function() { 
		        link.fade('out'); //hide the "Go To Top" link 
		    } 
		});
	}
	
	
	

	var HM = new HashListener();
	var anteriorHas;
	HM.addEvent('hashChanged',function(new_hash){ 
		
		if (new_hash != anteriorHas)
		{
			anteriorHas=new_hash;
			cargarPaginaInit();
		}
		
	}); 
	<?php  
	if (isset($_SESSION['usuario']))
	{
		echo 'var uploader = new qq.FileUploader({
			element: document.getElementById("modificar_avatar"),
				titulo: "'.$this->lang->line('modificar_avatar').'",
			action: "/extras/imagenes/avatar",
			debug: true,
			onComplete: function(id, fileName, responseJSON){
				 
				if (responseJSON.success)
				{
					$$(".avatar img").set("src",responseJSON.directory);
					 
				}
				 
			}
		});';
	}
	?>
	
});



</script>