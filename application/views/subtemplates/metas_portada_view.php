<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xmlns:fb="http://www.facebook.com/2008/fbml">
<head> 
<?php $this->load->view('subtemplates/metas_comunes_view'); ?>
<base href="http://<?= $_SERVER['SERVER_NAME'] ?>">

<script src="/extras/cargar_archivos/js_comun" type="text/javascript"></script>
<script src="<?= PATH_JS ?>galeria.js" type="text/javascript"></script>
<link href="/extras/cargar_archivos/css_comun" media="screen" rel="stylesheet"  type="text/css" />
<link href="<?= PATH_CSS ?>portada.css" rel="stylesheet"  type="text/css" />  

<?php $this->load->view('peques/msg_info_controller_view'); ?>