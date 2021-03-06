<div id="cuerpo">
	<div id="cuerpo_max">
		<div id="bloque_izq">
			
			<div class="titulo_l">Aplicación de escritorio</div>
			<ul>
				<li><a href="/descargas/apuntar_win.zip" target="_blank">Windows</a></li>
				<li><a href="/descargas/apuntar_all.zip" target="_blank">Linux / Mac</a></li>
			</ul>
			<a href="https://www.java.com/es/download/" class="need_java" target="_blank" rel="nofollow">Es necesario tener instalado java 1.6 en adelante, para el 99% ya esta instalado</a>
			<div class="titulo_l" style="margin-top:20px">Aplicación para móvil</div>
			 	<ul>
			 		<li><a href="https://play.google.com/store/apps/details?id=com.mgd.apuntar&feature=search_result#?t=W251bGwsMSwxLDEsImNvbS5tZ2QuYXB1bnRhciJd" rel="nofollow">Android</a></li>
			 		<li><a>iPhone IOS</a> pendiente</li>
			 		<li><a>Blackberry</a> pendiente</li>
			 	</ul>
			 	
			 <div class="titulo_l">Blogs de ejemplo</div>
			<ul>
					<?php foreach ($ejemplos as $nuevo)
					{
						echo '<li><a target="_blank" href="http://'.$nuevo->nombre_unico.'.'.URL_BASE.'">'.$nuevo->titulo.'</a></li>';
					}?>
			</ul>
			 
			<div class="titulo_l">Blogs nuevos</div>
				<ul>
					<?php foreach ($nuevos as $nuevo)
					{
						echo '<li><a target="_blank" href="http://'.$nuevo->nombre_unico.'.'.URL_BASE.'">'.$nuevo->titulo.'</a></li>';
					}?>
				</ul>
		</div>
		<div id="contenido">
			<div id="contenido_portada">
				<div id="contenedor_variable">
				
					
				<?
				$this->load->view('peques/portada_contenido_view');
				?>
					
				</div>
			</div>	
		</div>
	</div>
</div>