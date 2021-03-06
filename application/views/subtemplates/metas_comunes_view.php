<title><?= $titulo ?></title>
<meta name="title" content="<?= $titulo ?> | <?= URL_BASE ?>"/>
<meta property="og:title" content="<?= $titulo ?>"/>
<meta property="og:site_name" content="<?= URL_BASE ?>"/>
<meta name="description" content="<?= $descripcion ?>" lang="es"/>
<meta http-equiv="Content-Language"/>
<meta name="author" content="MGDSoftware"/>
<link rev="made" href="mailto:administracion@apuntar.net"/>
<meta name="locality" content="Madrid, España"/>
<meta name="distribution" content="global"/>
<meta name="language" content="es-ES"/>
<meta name="viewport" content="target-densitydpi=device-dpi, width=475">
<meta http-equiv="Pragma" content="no-cache"/>
<meta name="resource-type" content="document"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/img/favicon_apuntes.ico" /> 
<?php if (isset($_GET['_escaped_fragment_']) && isset($usuario_configuracion))
{
	echo '<link rel="canonical" href="http://'.$usuario_configuracion->nombre_unico.'.'.URL_BASE.'/'.RUTA_PORTAL.'#!'.$_GET['_escaped_fragment_'].'" />';
}?>
