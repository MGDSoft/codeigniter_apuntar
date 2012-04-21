login
<?php echo form_open('/forms/login_form' ); ?></form>
<form id='login_form' action="javascript:enviar_form_ajax('login_validacion()','login_form','/forms/login_form','resultado_form','')" method="post" accept-charset="utf-8">
<label><?= $this->lang->line('correo') ?></label>
<input type="text" name="correo" value="" id="correo">
<label><?= $this->lang->line('password') ?></label>
<input type="text" name="password" value="" id="password">
<input type="submit" name="enviar" value="enviar">
<input name="iehack" type="hidden" value="&#9760;" />
<div id='resultado_form' style='border:1px solid red'></div>
</form>

