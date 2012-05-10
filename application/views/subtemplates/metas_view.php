<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xmlns:fb="http://www.facebook.com/2008/fbml">
<head> 
<title><?= $titulo ?></title>
<meta name="title" content="<?= $titulo ?> | myEquipo.com"/>
<meta property="og:title" content="<?= $titulo ?>"/>
<meta property="og:site_name" content=""/>
<meta name="description" content="<?= $descripcion ?>" lang="es"/>
<meta http-equiv="Content-Language" content="es-ES"/>
<meta name="author" content="MGDSoftware"/>
<link rev="made" href="mailto:administracion@myequipo.com"/>
<meta name="locality" content="Madrid, España"/>
<meta name="distribution" content="global"/>
<meta name="language" content="es-ES"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta name="resource-type" content="document"/>
<meta name="fragment" content="!">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="imagenesWeb/myequipo.ico" /> 
<base href="<?=base_url();?>">

<script src="<?= PATH_JS ?>zeroclipboard/ZeroClipboard.js" type="text/javascript"></script>
<script type="text/javascript">
to_clip = new ZeroClipboard.Client();
to_clip.setText( "Copy me!" );
to_clip.setHandCursor( true );

to_clip.setText( '' ); // will be set later on mouseDown
to_clip.setHandCursor( true );
to_clip.setCSSEffects( true );

to_clip.addEventListener('load', function (client) {
	alert("Flash movie loaded and ready.");
});
to_clip.addEventListener('complete', function (client, text) {
	<?php printf(MSG_INFO,  $this->lang->line('correcto'),$this->lang->line('copiado'));?>
});

to_clip.addEventListener( 'complete', function(client, text) {
    alert("Copied text to clipboard: " + text );
} );
</script>

<script src="<?= PATH_JS ?>mootools-core-1.4.2.js" type="text/javascript"></script>
<script src="<?= PATH_JS ?>mootools-more.js" type="text/javascript"></script> 
<!-- <script src="<?= PATH_JS ?>Message-Class/js/mootools.js" type="text/javascript"></script>

<script src="<?= PATH_JS ?>Message-Class/js/mootools-Dependencies.js" type="text/javascript"></script>  -->

<script src="<?= PATH_JS ?>scriptbase.js" type="text/javascript"></script>   
<script src="<?= PATH_JS ?>validacion/js/objetos.js" type="text/javascript"></script> 
<script src="<?= PATH_JS ?>validacion/js/validacion.js" type="text/javascript"></script>  
<script src="<?= PATH_JS ?>validacion/js/idiomas/spanish.js" type="text/javascript"></script>  
<link href="<?= PATH_JS ?>validacion/css/main.css" rel="stylesheet"  type="text/css" />   

<script src="<?= PATH_JS ?>scripts_varios.js" type="text/javascript"></script>

<script src="<?= PATH_JS ?>arbol.js" type="text/javascript"></script>
<link href="<?= PATH_CSS ?>arbol.css" rel="stylesheet"  type="text/css" />

<script src="<?= PATH_JS ?>buscador.js" type="text/javascript"></script>

<script src="<?= PATH_JS ?>Message-Class/js/message_src.js" type="text/javascript" /></script>
<link href="<?= PATH_JS ?>Message-Class/css/message.css" rel="stylesheet"  type="text/css" />

<link href="<?= PATH_CSS ?>formularios.css" rel="stylesheet"  type="text/css" />  
<link href="<?= PATH_CSS ?>general.css" rel="stylesheet"  type="text/css" /> 

<link rel="stylesheet" href="<?= PATH_JS ?>highlight/styles/googlecode.css">
<script src="<?= PATH_JS ?>highlight/highlight.pack.js" type="text/javascript"></script>
<script src="<?= PATH_JS ?>highlight/numberLines.js" type="text/javascript"></script>

<script src="<?= PATH_JS ?>arieh-historymanager/Source/HashListener.js" type="text/javascript"></script>

<script src="<?= PATH_JS ?>ckeditor/ckeditor.js" type="text/javascript"></script>



<?php $this->load->view('peques/msg_info_controller_view'); ?>


