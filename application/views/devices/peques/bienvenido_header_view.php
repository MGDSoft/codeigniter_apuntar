<script>
window.addEvent('domready', function() {
	cargar_pagina_stadart('bienvenido','');
});
</script>
</head>
<body>
<div id="contenedor_portal">
	<a href="<?= RUTA_PORTAL.'#!bienvenido' ?>">
	<div id="menu_device" >
		<span><?= $this->lang->line('bienvenido') ?></span>
	</div>
	</a>
	<div id="contenedor_variable">
		
