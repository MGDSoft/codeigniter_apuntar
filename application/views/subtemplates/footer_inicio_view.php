	<div id="footer">
		<img id="img_sobremi" <?=  ((file_exists('.'.PATH_IMG.'usuario/personal/'.$web_sobre_mi->imagen_sobre_mi) && $web_sobre_mi->imagen_sobre_mi!="") ? 'src="'. PATH_IMG.'usuario/personal/'.$web_sobre_mi->imagen_sobre_mi  : '') ?> ">
		<div id="contacto_f">
			<strong><?= $this->lang->line('contacto') ?></strong>
			<div><?php   $this->load->view('peques/contact_view'); ?></div>
		</div>
		<span id="sobre_mi_val">
			<?=  $web_sobre_mi->sobre_mi ?>
		</span>
	</div>
</div>
</body>
</html>
<?php $this->load->view('extras/load_post_carga_view'); ?>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ur-dc998efb-c353-e08d-ca94-cfc61c85bbf7"}); </script>