<form id='registro_form' name="registro_form" class='formulario_estandar' action="javascript:enviar_form_ajax('registro_form','/forms/registro_forms','','','/index.php?info=1')" method="post" accept-charset="utf-8">
<fieldset>
	<legend><?= $this->lang->line('registro') ?></legend>

	<table class='formulario_estandar'>
		<tr><th><?= $this->lang->line('correo') ?></th><td><input type="text" name="correo" value="" id="correo"></td></tr>
		<tr><th><?= $this->lang->line('contrasena') ?></th><td><input type="password" name="contrasena" value="" id="contrasena"></td></tr>
		<tr><th><?= $this->lang->line('recontrasena') ?></th><td><input type="password" name="recontrasena" value="" id="recontrasena"></td></tr>
		<tr><th><?= $this->lang->line('nombre') ?></th><td><input type="text" name="nombre" value="" id="nombre"></td></tr>
		<tr><th><?= $this->lang->line('apellidos') ?></th><td><input type="text" name="apellidos" value="" id="apellidos"></td></tr>
		<tr><th><?= $this->lang->line('titulo') ?></th><td><input type="text" name="titulo" value="" id="titulo_registro"></td><td id="titulo_registro_result" class="pantallas_grandes">http://?.<?= URL_BASE ?></td></tr>
		<tr><th><?= $this->lang->line('uso_horario') ?></th><td>
		<select name="uso_horario" id="uso_horario">
			<?php foreach($huso_horario as $huso){
				?><option <?=  ($huso->default == 1) ? 'selected="selected"' : '' ?> value="<?= $huso->id_zone_time ?>"><?= $huso->gmt ?></option>  <?php 
			} ?>
		</select>
		</td></tr>
		<tr><td colspan='2' align='right'><input type="submit" name="enviar" class='boton_standart' value="<?= $this->lang->line('enviar') ?>"></td></tr>
	</table>
	<input name="iehack" type="hidden" value="&#9760;" />
	<div id='resultado_form' ></div>
	</fieldset>
</form>

<script>
//new VentanaError('recontrasena','asdsd');


</script>
<?php $TipoMessage=((isset($device)) ? 2 : 1) ?>
<div class='<?= AUTO_EJECUTAR_JS ?>' style='display:none'>
	creacionEventos('apellidos','','',<?= $TipoMessage ?>);
	creacionEventos('nombre','','',<?= $TipoMessage ?>);
	creacionEventos('correo','','email',<?= $TipoMessage ?>);
	creacionEventos('titulo_registro','','',<?= $TipoMessage ?>);
	creacionEventos('contrasena','','',<?= $TipoMessage ?>);
	creacionEventos('recontrasena','','igual',<?= $TipoMessage ?>);
	
	if ($('titulo_registro_result').getStyle('display')!="none")
	{
			
		$('titulo_registro').addEvent('keyup', function(e){
			e.stop();
			vars='url='+encodeURIComponent($('titulo_registro').value);
			new Request({
				url : '/extras/varios/get_url',
				method : 'post',
				data : vars,
				onRequest : function() {
				},
				onSuccess : function(responseText) {
					var valor='http://'+responseText+'.<?= URL_BASE ?>';
					log(valor.trim());
			   		$('titulo_registro_result').innerHTML=valor.trim();
				}
			
			}).send(vars);
		});
	}
	
</div>