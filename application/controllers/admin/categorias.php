<?php
 class Categorias extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Web_configuracion_separadores_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
		$this->load->model('Web_sobre_mi_model');
		$this->load->helper('my_usuario_helper');
		comprobar_session_activa_y_redirect();
	}

	
  public function index()
  {
  		
  		$portal_ini=comprobarAdmin(true);
  	
  		$busqueda_visible=$this->n_comentable($portal_ini['usuario_configuracion']);
  		
	  	$portal_ini['categorias']=$this->Categorias_model->getByIdUsuario($portal_ini['usuario_configuracion']->id_usuario);
	  	
	  	$arbol['usuario_configuracion']=$portal_ini['usuario_configuracion'];
	  	$arbol['admin']=$portal_ini['admin'];
	  	
	    $this->load->view('peques/arbol_categorias_view',$portal_ini);
  }
 
  
  private function n_comentable($user_config){
  	 
  	if (isset($_SESSION['usuario']) && $user_config->id_usuario == $_SESSION['usuario']->id_usuario)
	  	return 0;
	else
	  	return 1;
  }
  
 }
?>