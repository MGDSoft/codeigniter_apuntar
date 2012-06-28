<?php  
if (!isset($_SESSION['app']))
{
$this->load->view('peques/analitycs_view'); 
echo '</head>
<body>';
}
?>
<div id="contenedor_portal">
	<div id="menu_device" >
		<ul>
			<a href="<?= RUTA_PORTAL ?>#!admin/nueva_noticia"><li><?= $this->lang->line('admin_nueva_noticia') ?></li></a>
			<a href="<?= RUTA_PORTAL ?>#!listado_noticias"><li><?= $this->lang->line('noticias') ?></li></a>
			<a href="<?= RUTA_PORTAL ?>#!admin/categorias"><li class="last"><?= $this->lang->line('categorias') ?></li></a>
		</ul>
	</div>
	<div id="contenedor_titulo_buscador">
		<div id="buscador">
			 		<?php   $this->load->view('peques/buscador_view'); ?>
		</div>
	</div>
	<div id="contenido">
		<div id="contenedor_variable">
	

	