<!-- Visualización arbol categorias -->
<ul id='menu'>
<li categoria='0' id='categoria_0'>
	<span class="cont"><?=$this->lang->line('categorias') ?></span>
	<?php if ($admin)
	{
	?>
	<span class="opt" cerrado="si"></span>
	<span class="refresh"></span>
	<?php 
	}
	?>
</li>
	<?php
	$padre_act="";
	$i=0;
	$result; 
	$nivel=1;

	
	foreach ($categorias as $categoria)
	{
		
		if ( $nivel < $categoria->nivel)
		{
			//echo $categoria->nivel;
			$nivel=$categoria->nivel;
			echo '<ul>';
		}
		
		echo '<li categoria="'.$categoria->id_categoria.'" id="categoria_'.$categoria->id_categoria.'"><span class="mov"></span><span class="cont">'.$categoria->nombre.'</span>'. (($admin) ? '<span class="opt" cerrado="si"></span>' : '' ).'</li>';
		
		if (count($categorias) > ($i+1) && $categorias[$i+1]->nivel < $nivel)
		{
			for ($ii=$nivel;$ii > $categorias[$i+1]->nivel;--$ii)
			{
				//echo "inteto cerrado $nivel $ii";
				echo '</ul>';
			}
			
			$nivel=$categorias[$i+1]->nivel;
				
		}elseif(count($categorias) == ($i+1)){
			for ($ii=$nivel;$ii > 2;--$ii)
			{
				echo '</ul>';
			}
		}
		
		++$i;
	}
	
	?>
</ul></ul>
<?php if (isset($device))
{
	?>
<div class='<?= AUTO_EJECUTAR_JS ?>' style='display:none'>
	obj_menu_carpetas=new menuCarpetas('menu',<?= $usuario_configuracion->id_usuario ?>,'<?= $this->lang->line('opciones_txt') ?>','<?= $this->lang->line('carpeta_hija_txt') ?>','<?= $this->lang->line('modificar_nombre_txt') ?>','<?= $this->lang->line('borrar_txt') ?>');
</div>
<?php 
 $this->load->view('admin/volver_view'); 
}
?>
