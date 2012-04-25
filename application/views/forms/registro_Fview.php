registro
<form id='registro_form' name="registro_form"  action="javascript:enviar_form_ajax('registro_form','/forms/registro_form','','','/index.php?info=1')" method="post" accept-charset="utf-8">
	<table class='formulario_estandar'>
		<tr><th><?= $this->lang->line('correo') ?></th><td><input type="text" name="correo" value="" id="correo"></td></tr>
		<tr><th><?= $this->lang->line('contrasena') ?></th><td><input type="password" name="contrasena" value="" id="contrasena"></td></tr>
		<tr><th><?= $this->lang->line('recontrasena') ?></th><td><input type="password" name="recontrasena" value="" id="recontrasena"></td></tr>
		<tr><th><?= $this->lang->line('nombre') ?></th><td><input type="text" name="nombre" value="" id="nombre"></td></tr>
		<tr><th><?= $this->lang->line('apellidos') ?></th><td><input type="text" name="apellidos" value="" id="apellidos"></td></tr>
		<tr><th><?= $this->lang->line('titulo') ?></th><td><input type="text" name="titulo" value="" id="titulo"></td></tr>
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
	<div id='resultado_form' style='border:1px solid red'></div>
</form>

<script>
//new VentanaError('recontrasena','asdsd');
creacionEventos('apellidos','informativo','texto',1);
creacionEventos('nombre','informativo','texto',1);
creacionEventos('correo','informativo','email',1);
creacionEventos('titulo','informativo','',1);
creacionEventos('contrasena','contrasena','',1);
creacionEventos('recontrasena','recontrasena','igual',1);

</script>