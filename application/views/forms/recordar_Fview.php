<form id='recordar_form' class='formulario_estandar' action="javascript:enviar_form_ajax('recordar_form','/forms/registro_forms/recordar','','','')" method="post" accept-charset="utf-8">
<fieldset >
<legend><?= $this->lang->line('recordar_password') ?></legend>

<table class='formulario_estandar'>
<tr><th><?= $this->lang->line('correo') ?></th><td><input type="text" name="correo" value="" id="correo_recordar"></td></tr>
<tr><td colspan="2" align="right">
<input type="submit" name="enviar" value="<?= $this->lang->line('enviar') ?>" class="boton_standart"></td></tr>
</table>

<input name="iehack" type="hidden" value="&#9760;" />


</fieldset>
</form>

<div class='<?= AUTO_EJECUTAR_JS ?>' id='recordar_form_exe' style='display:none'>
	creacionEventos('correo_recordar','','email',1,<?= ((isset($_SESSION['device'])) ? 2 : 1 ) ?>);
</div>
<script>
	eval($('recordar_form_exe').innerHTML);
</script>