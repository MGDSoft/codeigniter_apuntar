<?php
 class Nueva_noticia extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();
		
	}
  function index()
  {
	
  	if ($this->uri->segment(1) === FALSE)
  		redirect(URL_WEB_NOT_FOUND, 'refresh');
  	else
  		$nombre_unico = str_replace(HTACCESS_WEB_USUARIO_TERMINACION, "",$this->uri->segment(1) );
  		
  	$user_configuration=$this->Usuario_configuracion_model->getByNombreUnico($nombre_unico);
  	$portal_ini['categorias']=$this->Categorias_model->getByIdUsuario($user_configuration->id_usuario);
  	 
  	$portal_ini['admin']=(isset($_SESSION['usuario']) && $_SESSION['usuario']->id_usuario==$user_configuration->id_usuario) ? true : false;
  	 
  	 
  	$arbol['usuario_configuracion']=$user_configuration;
  	$arbol['admin']=$portal_ini['admin'];

  }
 }
?>