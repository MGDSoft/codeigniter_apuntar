<style>
/* Estilos modificables on fly u_U */
body{
	text-align: left;
	font-weight:normal;
	
	background-image: <?= (( $usuario_configuracion->fondo_imagen)? 'url("'.$usuario_configuracion->fondo_imagen. '")' : 'none') ?>;
	font-family: <?= $usuario_configuracion->texto_estilo ?>;
	color:  <?= $usuario_configuracion->texto_color ?>;
	font-size: <?= $usuario_configuracion->texto_tamano ?>;
}
body, #caja_login{
	background-color: <?= $usuario_configuracion->fondo_color ?>;
}
a{
	color:  <?= $usuario_configuracion->link_color ?>;
	font-size:  <?= $usuario_configuracion->link_tamano ?>;
	text-decoration:none;
}

a:visited{
	color:  <?= $usuario_configuracion->link_visitado_color ?>;
	text-decoration:none;
}

/* formularios */
.formulario_estandar th{
	text-align: left;
	font-weight:normal;
	padding-right:8px;
	color: <?= $usuario_configuracion->formulario_color ?>;
	font-family: <?= $usuario_configuracion->formulario_estilo ?>;
	font-size: <?= $usuario_configuracion->formulario_tamano ?>;
}

/* atributos para titulos */
#contenedor_titulo_buscador #titulo, #titulo_comentarios, .formulario_estandar legend, .formulario_estandar th.separador, #contenedor_portal #footer #contacto_f strong{
	color: <?= $usuario_configuracion->titulo_color ?>;
	font-family: <?= $usuario_configuracion->titulo_estilo ?>;
}
/* titulo principal tamano */
#contenedor_titulo_buscador #titulo_desc{
	font-size: <?= $usuario_configuracion->titulo_principal_tamano ?>;
	height: 90px;
	margin:0px 0px 10px 20px;
	color:#005396;
	overflow: hidden;
	
}

/* atributos para botones */
#contenedor_titulo_buscador #buscar_boton input, .formulario_estandar .boton_standart, .boton_standart, #contenedor_titulo_buscador input[type="submit"]{
	color: <?= $usuario_configuracion->botones_color ?>;
	moz-box-shadow: 3px 4px 0px <?= $usuario_configuracion->botones_caja_sombra ?>;
	-webkit-box-shadow: 3px 4px 0px <?= $usuario_configuracion->botones_caja_sombra ?>;
	box-shadow: 3px 4px 0px <?= $usuario_configuracion->botones_caja_sombra ?>;
	border-width: 1px;
	border-style: solid;
	border-color: <?= $usuario_configuracion->botones_borde_color ?>;
	background-color: <?= $usuario_configuracion->botones_fondo ?>;
	text-shadow: 1px 1px 0px <?= $usuario_configuracion->botones_sombra_letra ?>;
	font-family: <?= $usuario_configuracion->botones_tipo_letra ?>;
	cursor:pointer;
}
/* bordes */
ul#menu li, .comentario_completo div.extras_comentario, .formulario_estandar fieldset, .contenedorTabs .contidoTabs, .contenedorTabs .opciontab, #contenido div.extras_noticia, .formulario_estandar input, .formulario_estandar select, .formulario_estandar textarea, #contenedor_portal #footer, div.paginado a, div.paginado strong, div.paginado{
	border-color: <?= $usuario_configuracion->bordes_color ?>;
}
/* bordes clarito color */
.comentario_completo img.avatar, span.volver a, #caja_login div.avatar{
	border-color: #5C5C5C;
	
}
/* bordes mas clarito color */
.respuestas div.comentario_completo{
	border-color: #F5F5F5; 
}

#caja_login{
	overflow:hidden;
	float:right;
	width:290px;
	text-align:center;
	margin-right:15px;
	height: 143px;
	border-width: 1px;
	border-top: 0px;
	border-style: solid;
	border-color: <?= $usuario_configuracion->bordes_color ?>;
	padding: 7px 0px 0px 0px;
	-webkit-border-bottom-right-radius: 10px;
	-webkit-border-bottom-left-radius: 10px;
	-moz-border-radius-bottomright: 10px;
	-moz-border-radius-bottomleft: 10px;
	border-radius: 0 0 10px 10px;
	border-bottom-right-radius: 10px;
	border-bottom-left-radius: 10px;
	font-size:0.9em !important;
	-moz-box-shadow: 0px 8px 15px <?= $usuario_configuracion->bordes_color ?>;
	-webkit-box-shadow: 0px 8px 15px <?= $usuario_configuracion->bordes_color ?>;
	box-shadow: 0px 8px 15px <?= $usuario_configuracion->bordes_color ?>;
	behavior: url('/img/PIE.htc');
}
div.paginado a,div.paginado strong{
	-moz-box-shadow: 0px 8px 15px <?= $usuario_configuracion->bordes_color ?>;
	-webkit-box-shadow: 0px 8px 15px <?= $usuario_configuracion->bordes_color ?>;
	box-shadow: 0px 8px 15px <?= $usuario_configuracion->bordes_color ?>;
}

/* otros */
#contenedor_titulo_buscador #descripcion{
	font-size:0.7em;
	display:block;
	font-style: italic;
	padding: 0 10px;
	
	color: <?= $usuario_configuracion->otros_color ?>;
}
</style>
<script>
	cargarBordes("<?= $usuario_configuracion->bordes_color.'","'. $usuario_configuracion->fondo_color ?>");
</script>
