<div class="registro"><a href="<?= RUTA_PORTAL ?>#!registro"><?= $this->lang->line('registrate') ?></a> <a href="<?= RUTA_PORTAL ?>#!recordar"><?= $this->lang->line('recordar_password') ?></a></div>

<form id='login_form' action="javascript:enviar_form_ajax('login_form','/forms/login_form','','','')" method="post" accept-charset="utf-8">
<table class='formulario_estandar'>
<tr><th><?= $this->lang->line('correo') ?></th><td><input type="text" name="correo" value="" id="correo_autentificacion"></td></tr>
<tr><th><?= $this->lang->line('contrasena') ?></th><td><input type="password" name="password" value="" id="password_autentificacion"></td></tr>
<tr><th style="padding-top:4px"><?= (!isset($device) ? $this->lang->line('recordar') : '')  ?></th><td align="left"><input <?= (isset($device) ? 'checked="checked" style="display:none"' : '')  ?>  type="checkbox" name="recordar" id="recordar" value="ok">
<input type="submit" name="enviar" value="<?= $this->lang->line('enviar') ?>" class="boton_standart"></td></tr>
</table>

<input name="iehack" type="hidden" value="&#9760;" />

</form>

<script>
creacionEventos('correo_autentificacion','','',1,2);
creacionEventos('password_autentificacion','','',1,2);
</script>