<?php
 class Index extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');

	}
	public function portada()
	{
		$this->load->view('peques/portada_contenido_view');
	}
	public function error_404(){
		$_GET['info']=2;
		$this->index();
	}
	
   public function index()
    {
  	$this->logout_();
  	$this->redirect_web();
  	
	if (!isset($_GET['info']))
	{
		$data['titulo']=$this->lang->line('titulo_portada_meta');
		$data['descripcion']=$this->lang->line('descripcion_portada_meta');
	}else{
		$data['titulo']=$this->lang->line('js_pagina_no_encontrada') . '|' .URL_BASE;
		$data['descripcion']=$this->lang->line('js_pagina_no_encontrada') . '|' .URL_BASE;
	}
  	
    
   $portal->contacto_pagina_personal='';
   $portal->contacto_steam='';
   $portal->contacto_youtube='';
   $portal->contacto_tuenti='';
   $portal->contacto_steam='';
   $portal->contacto_twitter='';
   $portal->contacto_facebook='';
   $portal->contacto_email='';
   
   
   $datos['usuario_configuracion']=$portal;
   $datos['nuevos']=$this->Usuario_model->getLast('DESC',4);
   $datos['ejemplos']=$this->Usuario_model->getLast('ASC',4);
   
   $this->load->view('subtemplates/metas_portada_view',$data);
   $this->load->view('peques/iniciador_portada_js_view');
   $this->load->view('subtemplates/header_portada_view',$datos);
   $this->load->view('cuerpo_portada_view');
   $this->load->view('subtemplates/footer_portada_view');
  }
  
  private function redirect_web(){
  	
  	if($_SERVER['SERVER_NAME']!= base_url())
  	{
 			
  		$array = explode('.',$_SERVER['SERVER_NAME']);
  		
  		if($array[0]!='www')
  			$method=$array[0];
  		
  		elseif($array[0]=='www')
  			$method=$array[1];

  		if ($method=="devices")
  			redirect('http://'.$_SERVER['SERVER_NAME'].'/portal_devices', 'refresh');
  		if (!stripos(base_url(), $method))  			
  			redirect('http://'.$_SERVER['SERVER_NAME'].'/portal', 'refresh');
  		  	
  	}
 }
  	
  private function logout_(){
  	// En el cambio de dominio desconectarlo si se da al logout
  	$cookie=$this->input->cookie('conectado_ahora', TRUE);
  	 
  	if (!$cookie && isset($_SESSION['usuario']))
  		unset ($_SESSION['usuario']);
  	
  	if (isset($_GET['logout']) || isset($_POST['logout']))
  	{
  		unset ($_SESSION['usuario']);
  		//session_unset();
  		$this->load->helper('cookie');
  		delete_cookie('auto_login');
  		delete_cookie('conectado_ahora');
  		
  		if (isset($_SESSION['app']))
  			printf(REDIRECT_URL_JS, RUTA_PORTAL);
  		else
  			redirect('/', 'refresh');
  	}
  	
  	
  	  	
  }
 }
?>