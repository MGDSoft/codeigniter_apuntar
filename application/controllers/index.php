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
	
   public function index()
    {
  	$this->logout_();
  	$this->redirect_web();
   $data['titulo']="tit";
   $data['descripcion']="desc";
   $portal->contacto_pagina_personal='';
   $portal->contacto_steam='';
   $portal->contacto_youtube='';
   $portal->contacto_tuenti='';
   $portal->contacto_steam='';
   $portal->contacto_twitter='';
   $portal->contacto_facebook='';
   
   $datos['usuario_configuracion']=$portal;
   $datos['nuevos']=$this->Usuario_model->getLast10();
   $datos['ejemplos']=$this->Usuario_model->getLast10('ASC',3);
   
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
  	if (isset($_GET['logout']))
  	{
  		session_unset();
  		$this->load->helper('cookie');
  		delete_cookie('auto_login');
  		delete_cookie('conectado_ahora');
  		redirect('/', 'refresh');
  	}
  }
 }
?>