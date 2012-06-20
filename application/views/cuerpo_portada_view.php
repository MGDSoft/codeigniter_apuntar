<div id="cuerpo">
	<div id="bloque_izq">
		
		<div class="titulo_l">Aplicación de escritorio</div>
		<ul>
			<li><a href="/descargas/apuntar_win32.jar" target="_blank">Windows 32bits</a></li>
			<li><a href="/descargas/apuntar_win64.jar" target="_blank">Windows 64bits</a></li>
			<li><a href="/descargas/apuntar_lin32.jar" target="_blank">Linux 32bits</a></li>
			<li><a href="/descargas/apuntar_lin64.jar" target="_blank">Linux 64bits</a></li>
		</ul>
		<a href="https://www.java.com/es/download/" class="need_java" target="_blank" rel="nofollow">Es necesario tener instalado java 1.6 en adelante</a>
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