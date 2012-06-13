<?php if ($admin) {
	?>
	<div id="admin">
		<a href="/<?= RUTA_PORTAL ?>#!admin/nueva_noticia" class="nueva_noticia" >a
			<img align="absmiddle" src="<?= PATH_IMG ?>1x1.gif" width="32" height="32"><?= $this->lang->line('admin_nueva_noticia') ?>
		</a>
		<a href="/<?= RUTA_PORTAL ?>#!admin/configurar_web/" class="config_Web">
			<img align="absmiddle" src="<?= PATH_IMG ?>1x1.gif" width="32" height="32"><?= $this->lang->line('admin_configura_web') ?>
		</a>	
			
		
	</div>
	<?php 
		}
		?>