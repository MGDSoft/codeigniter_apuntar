<?php 
if ($resultado)
{
	echo $this->lang->line('cuenta_activada');
}else{
	echo $this->lang->line('cuenta_no_activada');
}
?>