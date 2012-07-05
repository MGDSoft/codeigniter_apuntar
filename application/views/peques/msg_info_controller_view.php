<?php 
if (isset($_GET['info']))
	{
?>
<script type="text/javascript">
window.addEvent('domready', function() {
	<?php 
	
		switch ($_GET['info']){
			case 1:
				printf(MSG_INFO_URGENT,  $this->lang->line('correcto'),$this->lang->line('activar_tu_cuenta'));
				break;
			case 2:
				printf(MSG_WATCHOUT,  $this->lang->line('error'),$this->lang->line('js_pagina_no_encontrada'));
				break;
			case 3:
				printf(MSG_WATCHOUT,  $this->lang->line('error'),$this->lang->line('pagina_privada'));
				break;
			case 4:
				printf(MSG_WATCHOUT,  $this->lang->line('error'),$this->lang->line('sesion_acabada'));
				break;
			case 5:
				printf(MSG_INFO_URGENT,  $this->lang->line('correcto'),$this->lang->line('cuenta_recuperada'));
				break;
			case 6:
				printf(MSG_INFO_URGENT,  $this->lang->line('correcto'),$this->lang->line('bienvenida_social'));
				break;
			case 7:
				printf(MSG_WATCHOUT,  $this->lang->line('error'),$this->lang->line('error_correo_social'));
				break;
			case 8:
				printf(MSG_INFO_URGENT,  $this->lang->line('correcto'),$this->lang->line('bienvenida_normal'));
				break;
				
		}
	
	?>
});
</script>
<?php 
	}
?>