</head>
<body>
<div style="position:absolute;z-index:-1;width:100%;height:58px;background:#F5F5F5;top:100px;left:0px;border-top:1px solid #ccc;border-bottom:1px solid #ccc;"></div>  
<div id="contenedor_portal">
	<div id="cabecera">
		<div id="logo">
	 		<img src="<?= PATH_IMG ?>logo_default.png" width="190">
	 	</div>
	 	<div id="caja_login">
	 		<?php   $this->load->view('subtemplates/login_view'); ?>
	 	</div>
	 	<div id="contenedor_titulo_buscador">
	 		<div id="contenidos_extra">
	 			<img src="<?= PATH_IMG ?>steam.png">
	 			<img src="<?= PATH_IMG ?>youtube.png">
	 			<img src="<?= PATH_IMG ?>twitter.png">
	 			<img src="<?= PATH_IMG ?>facebook.png">
	 			<img src="<?= PATH_IMG ?>email.png">
	 			<img src="<?= PATH_IMG ?>rss.png">
	 		</div>
	 		<div id="titulo_desc">
	 			<span id="titulo">
		 			MGDSoftware
		 		</span>
		 		<span id="descripcion">
		 			"Todo lo que necesitas saber sobre la informática"
		 		</span>
	 		</div>
	 		
			<div id="buscador">
		 		<?php   $this->load->view('peques/buscador_view'); ?>
		 	</div>
	 	</div>
	</div>
	
	<div style="position:absolute;z-index:-1;left:0px;width:100%;height:100%;border-top:1px dashed #CFE0FC"></div>