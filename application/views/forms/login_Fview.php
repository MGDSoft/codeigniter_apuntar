<a href="/registro"><?= $this->lang->line('registrate') ?></a> <a href="/registro"><?= $this->lang->line('recordar_password') ?></a>
<br><br>
<form id='login_form' action="javascript:enviar_form_ajax('login_form','/forms/login_form','','','')" method="post" accept-charset="utf-8">
<table class='formulario_estandar'>
<tr><th><?= $this->lang->line('correo') ?></th><td><input type="text" name="correo" value="" id="correo_autentificacion"></td></tr>
<tr><th><?= $this->lang->line('contrasena') ?></th><td><input type="text" name="password" value="" id="password_autentificacion"></td></tr>
<tr><td colspan='2' align='right' id='resultado_login_form' class='respuesta_fallida'></td></tr>
<tr><td colspan='2' align='right'><input type="submit" name="enviar" value="<?= $this->lang->line('enviar') ?>" class="boton_standart"></td></tr>
</table>

<input name="iehack" type="hidden" value="&#9760;" />

</form>
  

<script>
creacionEventos('correo_autentificacion','','email',1);
creacionEventos('password_autentificacion','','',1);
</script>