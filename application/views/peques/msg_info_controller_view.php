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
				printf(MSG_WATCHOUT,  $this->lang->line('error'),$this->lang->line('pagina_no_encontrada'));
				break;
			case 3:
				printf(MSG_WATCHOUT,  $this->lang->line('error'),$this->lang->line('pagina_privada'));
				break;
				
		}
	
	?>
});
</script>
<?php 
	}
?>