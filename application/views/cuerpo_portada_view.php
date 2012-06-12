<div id="cuerpo">
	<div id="bloque_izq">
		
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