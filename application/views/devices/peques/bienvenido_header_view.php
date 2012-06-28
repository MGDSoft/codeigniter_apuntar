<?php  
$exec="cargar_pagina_stadart('bienvenido','','','');";
if (!isset($_SESSION['app']))
{
	echo '<script>window.addEvent(\'domready\', function() {'.$exec.'});</script>';
?>
	
	</head>
	<body>
<?php }else{
	echo '<div class="'.AUTO_EJECUTAR_JS.'">'.$exec.'</div>';
}
?>
<div id="contenedor_portal">
	<a href="<?= RUTA_PORTAL.'#!bienvenido' ?>">
	<div id="menu_device" >
		<span><?= $this->lang->line('bienvenido') ?></span>
	</div>
	</a>
	<div id="contenedor_variable">
		
