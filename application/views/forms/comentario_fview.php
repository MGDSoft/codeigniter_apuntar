<?
if ($comentable)
{
	$id_respuesta= ((isset($id_respuesta)) ? $id_respuesta : '0' );
	$unicoId = ((isset($comentario)) ? $comentario->id_comentario.'-'.$id_respuesta.$accion : '0-'.$id_respuesta.$accion );
?>
<form id='comentario_form<?= $unicoId ?>' class='formulario_estandar' name="comentario_form<?= $unicoId ?>"  action="javascript:enviar_form_ajax('comentario_form<?= $unicoId ?>','/forms/comentario_form/<?= (($accion=='insert')? 'insertar' : 'update') ?>','','','')" method="post" accept-charset="utf-8">
<?php  if (!isset($fieldset) || $fieldset==true) {?>
<fieldset>
	<legend><?= (($accion == 'insert') ? $this->lang->line('nuevo_comentario') : $this->lang->line('modificar_comentario')) ?></legend>
<?php }?>
		<table class='formulario_estandar' >
			<?php  if ($accion!='update') {?>
			<tr><th style='text-align:left'><?= $this->lang->line('autor') ?></th></tr>
			<tr><td><input disabled="disabled" type="text" value="<?= ((isset($_SESSION['usuario']))? $_SESSION['usuario']->nombre.' '.$_SESSION['usuario']->apellidos : $this->lang->line('anonimo')) ?>" ></td>
			<?php }?>
			<tr><th style='text-align:left'><?= $this->lang->line('comentario') ?></th></tr>
			<tr><td><textarea name='comentario' id='comentario<?= $unicoId ?>'><?= ((isset($comentario))? $comentario->comentario :'' )?></textarea></td></tr>
			<?php  if (!isset($_SESSION['usuario'])) {?>
			<tr><th style='text-align:left'><?= $this->lang->line('seguridad') ?></th></tr>
			<tr><td class="seguridad"><?= $captcha ?> <input type="text" id="captcha<?= $unicoId ?>" name="captcha" value="" ></td></tr>
			<?php }?>
			<tr><td align='right'><input type="submit" name="enviar" class='boton_standart' value="<?= $this->lang->line('enviar') ?>"></td></tr>
		</table>
		<input name="iehack" type="hidden" value="&#9760;" />
		<input name="id_noticia" type="hidden" value="<?= $noticia->id_noticia ?>" />
		<input name="id_respuesta" type="hidden" value="<?= $id_respuesta ?>" />
		<input name="id_unico" type="hidden" value="<?= $unicoId ?>" />
		<?= (($accion=='update') ? '<input name="id_comentario" type="hidden" value="'.$comentario->id_comentario.'" />' :'' ) ?>
<?php  if (!isset($fieldset) || $fieldset=true) {?>
</fieldset>
<?php }?>
</form>

<div class='<?= AUTO_EJECUTAR_JS ?>' style='display:none'>
<?php 
$TipoMessage=((isset($device)) ? 2 : 1);

if (!isset($_SESSION['usuario'])) {?>
	creacionEventos('captcha<?= $unicoId ?>','','',1,<?= $TipoMessage ?>);
<?php }?>
	creacionEventos('comentario<?= $unicoId ?>','','',1,<?= $TipoMessage ?>);
</div>

<script type="text/javascript">
	eval($('<?= AUTO_EJECUTAR_JS ?>').innerHTML);
</script>
<?php }?>