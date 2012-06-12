<div class="nombre_user"><b><?= $_SESSION['usuario']->nombre. ' '. $_SESSION['usuario']->apellidos ?></b></div>
<div class="avatar"><img  src="<?= PATH_IMG .'usuario/avatar/'. $_SESSION['usuario']->avatar ?>"></div>	
<div class="opc_user">
	<ul>
		<li><a  href="<?= sprintf(URL_SUB_DOMAIN,$_SESSION['usuario']->nombre_unico).'/'. RUTA_PORTAL ?>"><?= $this->lang->line('ir_a_mi_web') ?></a></li>
		<li><a  href="/<?= RUTA_PORTAL ?>#!admin/modificar_mis_datos"><?= $this->lang->line('modificar_datos_usuario') ?></a></li>
		<li><div id="modificar_avatar">       
							    <noscript>          
							        <p>Please enable JavaScript to use file uploader.</p>
							        <!-- or put a simple form for upload here -->
							    </noscript>         
			</div>
		</li>
	</ul>
</div>
<div class="logout">
	<a href="/index.php?logout=1"><?= $this->lang->line('salir') ?> <img src="<?= PATH_IMG ?>1x1.gif" width="32" height="32" align="absmiddle" ></a>
</div>
