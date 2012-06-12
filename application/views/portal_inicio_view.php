<div id="cuerpo">
	<div id="bloque_izq">
		
		<div id="arbol">
			<?php 
			$this->load->view('peques/arbol_categorias_view');
			?>
		</div>
		<div class="titulo_l">Calendario</div>
		<div id="calendario">
			<?php 
			$this->load->view('peques/calendario_view');
			?>
		</div>
	</div>
	<div id="contenido">
		
			<?
			$this->load->view('peques/admin_web_view');
			?>
		
		<div id="contenedor_variable">
			<?= ((isset($contenido_variable) )? $contenido_variable : '') ?>
		</div>
	</div>
</div>