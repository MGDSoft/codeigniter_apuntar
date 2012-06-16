<form id='nueva_noticia_form' class='formulario_estandar' name="nueva_noticia_form"  action="javascript:enviar_form_ajax('nueva_noticia_form','/forms/noticias_forms/<?= (($accion=='insert')? 'insertar_noticia' : 'update_noticia') ?>','','','/index.php?info=1')" method="post" >
<fieldset>
	<legend><?= (($accion == 'insert') ? $this->lang->line('admin_nueva_noticia') : $this->lang->line('admin_modificar_noticia')) ?></legend>
			
	
		<table class='formulario_estandar' >
			<tr><th><?= $this->lang->line('titulo_noticia') ?></th></tr>
			<tr><td><input MAXLENGTH='200' type="text" name="titulo_noticia" id="titulo_noticia" value="<?= ((isset($noticia))? $noticia->titulo :'' ) ?>" ></td></tr>
			<tr><th><?= $this->lang->line('categoria') ?></th></tr>
			<tr><td><select name="categoria_noticia" id="categoria_noticia">
			<?php foreach($categorias as $categoria){
				?><option <?= ((isset($noticia) && $noticia->id_categoria == $categoria->id_categoria)? 'selected="selected"' :'' ) ?> value="<?= $categoria->id_categoria ?>"><?= $categoria->nombre ?></option>  <?php 
			 } ?>
			</select>
			</td></tr>
			
			
			
			<tr><th><?= $this->lang->line('noticia') ?></th></tr>
			<tr><td>
			
			<textarea name="texto_noticia" id="texto_noticia" ><?= ((isset($noticia))? $noticia->noticia :'' ) ?></textarea></td></tr>
			<tr><th><?= $this->lang->line('visible') ?></th></tr>
			<tr><td><input type="checkbox" name="visible_noticia" id="visible_noticia" value="si" <?= ((isset($noticia) && $noticia->visible == 0)? '' :'checked="checked"' ) ?> ></td></tr>
			<tr><th><?= $this->lang->line('comentable') ?></th></tr>
			<tr><td><input type="checkbox" name="comentable_noticia" id="comentable_noticia" value="si" <?= ((isset($noticia) && $noticia->comentable == 0)? '' :'checked="checked"' ) ?> ></td></tr>
			
			<tr><td align='right'><input type="submit" name="enviar" class='boton_standart' value="<?= $this->lang->line('enviar') ?>"></td></tr>
			</table>
			
		<?= (($accion=='update') ? '<input name="id" type="hidden" value="'.$noticia->id_noticia.'" />' :'' ) ?>
</fieldset>
</form>

<div class='<?= AUTO_EJECUTAR_JS ?>' style='display:none'>
	creacionEventos('titulo_noticia','','',1);
	
	if ( typeof CKEDITOR == 'undefined' )
	{
		
	}
	else
	{
		var instance = CKEDITOR.instances['texto_noticia'];
	    if(instance)
	    {
	        CKEDITOR.remove(instance);
	    }
			
		CKEDITOR.replace( 'texto_noticia',
			 {
			 toolbar: [['Source','Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'UIColor'],[ 'TextColor','BGColor' ],[ 'Code']],
			 width:  <?= ((isset($_SESSION['device'])) ? '(window.getSize().x - 80)' : '600') ?>
			 
			});
		

	}			
	document.title="<?= $titulo ?>";
	document.description="<?= $descripcion ?>";	  
</div>
<script type="text/javascript">
	eval($('<?= AUTO_EJECUTAR_JS ?>').innerHTML);
</script>

<?php $this->load->view('admin/volver_view'); ?>