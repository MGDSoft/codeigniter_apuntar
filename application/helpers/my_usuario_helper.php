<?php
function comprobarAdmin($configuracion_diseno=false,$expulsar_no_admins=false){
	
	if (isset($_SESSION['device']))
	{
		
		return comprobarAdminDevices($configuracion_diseno=false,$expulsar_no_admins=false);
		exit;
	}
	$CI =& get_instance();
	
	if (isset($_POST['nombre_unico']))
	{
		$nombre_unico= $CI->input->post('nombre_unico');
	}else{
		
		if($_SERVER['SERVER_NAME']!= base_url())
	  	{
	  		$array = explode('.',$_SERVER['SERVER_NAME']);
	  	
	  		if($array[0]!='www')
	  			$nombre_unico=$array[0];
	  		elseif($array[0]=='www')
	  			$nombre_unico=$array[1];
	 	
	  	}
	}
	 	
		
  	$user_configuration=$CI->Usuario_configuracion_model->getByNombreUnico($nombre_unico,$configuracion_diseno);

  	$result['admin']=((isset($_SESSION['usuario']) 
  			&& $_SESSION['usuario']->id_usuario==$user_configuration->id_usuario) 
  			? true : false);
  	
  	if ($expulsar_no_admins)
  	{
  		if (!$result['admin'])
  		{
  			$toexec=sprintf(MSG_WATCHOUT, $CI->lang->line('trampeando'), $CI->lang->line('sin_permiso'));
  			$toexec.=sprintf(CARGAR_PAGINA_JS, '');
  			printf(CARGAR_JS_AUTO, $toexec);
  			exit;
  		}
  	}	
  	
  	
  	if ($configuracion_diseno)
  		$result['web_configuracion_separadores']=$CI->Web_configuracion_separadores_model->getById($user_configuration->id_configuracion);
  	
  	
  	if (!$user_configuration)
  		redirect(URL_WEB_NOT_FOUND, 'refresh');
  	
  	if ($user_configuration->visible==0 && (!isset($_SESSION['usuario']) || $user_configuration->id_usuario != $_SESSION['usuario']->id_usuario ))
  	{
  		redirect(URL_WEB_PRIVADA, 'refresh');
  		
  	}

  	
  	if (!isset($_SESSION['usuario']))
  	{
  		$_SESSION['timezone']=$user_configuration->tz;
  	}
  	
  	$result['usuario_configuracion']=$user_configuration;
  	
  	$result['nombre_unico']=$user_configuration->nombre_unico;
  	$result['id_web']=$user_configuration->id_usuario;
  	
  	return $result;
}   

function comprobarAdminDevices($configuracion_diseno=false,$expulsar_no_admins=false){

	$CI =& get_instance();
	
	$result=iniVarsDevices();
	
	if (!isset($_SESSION['usuario']))
		exit;
	
	
	$user_configuration=$CI->Usuario_configuracion_model->getById($_SESSION['usuario']->id_usuario,$configuracion_diseno);

	
	$result['admin']=((isset($_SESSION['usuario'])
			&& $_SESSION['usuario']->id_usuario==$user_configuration->id_usuario)
			? true : false);
	 
	if ($expulsar_no_admins)
	{
		if (!$result['admin'])
		{
			$toexec=sprintf(MSG_WATCHOUT, $CI->lang->line('trampeando'), $CI->lang->line('sin_permiso'));
			$toexec.=sprintf(CARGAR_PAGINA_JS, '');
			printf(CARGAR_JS_AUTO, $toexec);
			exit;
		}
	}
	 
	 
	if ($configuracion_diseno)
		$result['web_configuracion_separadores']=$CI->Web_configuracion_separadores_model->getById($user_configuration->id_configuracion);
	 
	 
	if (!$user_configuration)
		redirect(URL_WEB_NOT_FOUND, 'refresh');
	 
	if ($user_configuration->visible==0 && (!isset($_SESSION['usuario']) || $user_configuration->id_usuario != $_SESSION['usuario']->id_usuario ))
	{
		redirect(URL_WEB_PRIVADA, 'refresh');

	}

	 
	if (!isset($_SESSION['usuario']))
	{
		$_SESSION['timezone']=$user_configuration->tz;
	}
	 
	$result['usuario_configuracion']=$user_configuration;
	
	$result['id_web']=$user_configuration->id_usuario;
	 
	return $result;
}

function iniVarsDevices(){
	if (!isset($_SESSION['device']))
	{
		$_SESSION['device']=true;
	}
	$portal_ini['nombre_unico']="portal_devices";
	$portal_ini['device']=true;
	return $portal_ini;
}
?>