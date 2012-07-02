<?php   $this->load->view('peques/cargar_estilos_web_view'); 
   $this->load->view('peques/analitycs_view'); ?>
</head>
<body class="<?= $usuario_configuracion->fondo_estilo ?>">
<?php   $this->load->view('peques/cargar_separadores_web_view'); ?>
<div id="gototop" style="visibility:hidden;">
	<img src="<?= PATH_IMG ?>1x1.gif" class="arriba" height="100" width="91" onclick="new Fx.Scroll(window).toTop();">
	<img id="gotodown" src="<?= PATH_IMG ?>1x1.gif" class="abajo" height="100" width="91" onclick="new Fx.Scroll(window).toBottom();">
</div>

<div id="contenedor_portal">
	<div id="cabecera">
		<div id="logo">
			<div>
	 			<a href="<?= RUTA_PORTAL ?>#!"><img src="<?= PATH_IMG.'usuario/logo/'.$usuario_configuracion->logo ?>"></a>
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
		 			<a href="<?= RUTA_PORTAL ?>#!"><?= $usuario_configuracion->titulo ?></a>
		 		</span>
		 		<span id="descripcion">
		 			<?= $usuario_configuracion->eslogan ?>
		 		</span>
	 		</div>
	 		
			<div id="buscador">
		 		<?php   $this->load->view('peques/buscador_view'); ?>
		 	</div>
	 	</div>
	</div>
