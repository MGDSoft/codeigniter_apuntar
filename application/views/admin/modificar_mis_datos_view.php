
<form id='modificar_mis_datos_form' class='formulario_estandar' name="modificar_mis_datos_form"  action="javascript:enviar_form_ajax('modificar_mis_datos_form','/forms/registro_forms/update','','','')" method="post" accept-charset="utf-8">
<fieldset>
	<legend><?= $this->lang->line('modificar_datos_usuario') ?></legend>
			
	<table class='formulario_estandar' >
		<tr><th><?= $this->lang->line('correo') ?></th><td><input type="text" name="correo" value="<?= $usuario->correo ?>" id="correo"></td></tr>
		<tr><th><?= $this->lang->line('nombre') ?></th><td><input type="text" name="nombre" value="<?= $usuario->nombre ?>" id="nombre"></td></tr>
		<tr><th><?= $this->lang->line('apellidos') ?></th><td><input type="text" name="apellidos" value="<?= $usuario->apellidos ?>" id="apellidos"></td></tr>
		<tr><th><?= $this->lang->line('uso_horario') ?></th><td>
		<select name="uso_horario" id="uso_horario">
			<?php foreach($huso_horario as $huso){
				?><option <?=  ($huso->id_zone_time == $usuario->id_zone_time) ? 'selected="selected"' : '' ?> value="<?= $huso->id_zone_time ?>"><?= $huso->gmt ?></option>  <?php 
			} ?>
		</select>
		</td></tr>
		<tr><th><?= $this->lang->line('aviso_respuesta_correo') ?></th><td><input type="checkbox" name="aviso_respuesta" id="aviso_respuesta" value="1" <?= (($usuario->aviso_respuesta==1 )? 'checked="checked"' : '' ) ?>></td></tr>
		<tr><td colspan='2' align='right'><input type="submit" name="enviar" class='boton_standart' value="<?= $this->lang->line('enviar') ?>"></td></tr>
		</table>
		<input name="iehack" type="hidden" value="&#9760;" />
</fieldset>
</form>



<form id='mis_datos_pass_form' class='formulario_estandar' name="mis_datos_pass_form"  action="javascript:enviar_form_ajax('mis_datos_pass_form','/forms/registro_forms/password','','','')" method="post" accept-charset="utf-8">
<fieldset>
	<legend><?= $this->lang->line('cambiar_contrasena') ?></legend>
			
	<table class='formulario_estandar' >
		<?php if ($usuario->id_social == ""){ ?>
		<tr><th><?= $this->lang->line('anterior_contrasena') ?></th><td><input type="password" name="anteriorcontrasena" value="" id="anteriorcontrasena"></td></tr>
		<?php } ?>
		<tr><th><?= $this->lang->line('contrasena_nueva') ?></th><td><input type="password" name="contrasena" value="" id="contrasena"></td></tr>
		<tr><th><?= $this->lang->line('recontrasena') ?></th><td><input type="password" name="recontrasena" value="" id="recontrasena"></td></tr>
		<tr><td colspan='2' align='right'><input type="submit" name="enviar" class='boton_standart' value="<?= $this->lang->line('enviar') ?>"></td></tr>
		</table>
		<input name="iehack" type="hidden" value="&#9760;" />
</fieldset>
</form>

<div class='<?= AUTO_EJECUTAR_JS ?>' style='display:none'>

creacionEventos('apellidos','','',1);
creacionEventos('nombre','','',1);
creacionEventos('correo','','email',1);
<?php if ($usuario->id_social == ""){ ?>
creacionEventos('anteriorcontrasena','','',1);
<?php } ?>
creacionEventos('contrasena','','',1);
creacionEventos('recontrasena','','',1);
document.title="<?= $titulo ?>";
	document.description="<?= $descripcion ?>";
</div>


<?php $this->load->view('admin/volver_view'); ?>