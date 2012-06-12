<style>

</style>
</head>
<body>
<div id="gototop" style="visibility:hidden;">
	<img src="<?= PATH_IMG ?>1x1.gif" class="arriba" height="100" width="91" onclick="new Fx.Scroll(window).toTop();">
	<img id="gotodown" src="<?= PATH_IMG ?>1x1.gif" class="abajo" height="100" width="91" onclick="new Fx.Scroll(window).toBottom();">
</div>
<img src="/img/portada/fondo_logoo.png" id='logo_fondo'>
<div id="separador_1" class="color_gradient_z" style=" border-top-color: #969696; border-right-color: #969696; border-bottom-color: #969696; border-left-color: #969696; border-top-width: 1px; border-bottom-width: 1px; border-left-width: 0px; border-right-width: 0px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; width: 100%; height: 60px; position: absolute; top: 90px; left: 0px; z-index: -1;"></div>

<div id="contenedor_portal">
	<div id="cabecera">
		<div id="logo">
			<div>
	 			<a href="<?= RUTA_PORTAL ?>#!"><img src="<?= PATH_IMG.'portada/logo_apuntes.png' ?>"></a>
	 		</div>
	 	</div>
	 	<div id="caja_login">
	 		<?php   $this->load->view('subtemplates/login_view'); ?>
	 	</div>
	 	<div id="contenedor_titulo_buscador">
	 		<div id="contenidos_extra">
	 			<?php   $this->load->view('peques/contact_view'); ?>
	 		</div>
	 		<div id="titulo_desc">
	 			<span id="titulo">
		 			<a href="<?= RUTA_PORTAL ?>#!"><?= URL_BASE ?></a>
		 		</span>
		 		<span id="descripcion">
		 			Apunta todo lo que necesites rápido y para cualquier entorno
		 		</span>
	 		</div>
	 		
			<div id="buscador">
		 		<div id="galeria">
					<span>Necesitas un sitio donde puedas apuntar todo lo que necesitas y tener un acceso rápido y fácil a cualquier plataforma ?!</span>
					<span style="display:none">Es visible en cualquier plataforma, con aplicación de escritorio y en breves, aplicación para móviles</span>
					<span style="display:none">Esta es tu página, con multiples opciones tanto visuales como configuración de tu "blog"!</span>
				</div>
		 	</div>
	 	</div>
	</div>
