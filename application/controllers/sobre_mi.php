<?php
 class Sobre_mi extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_usuario_helper');
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Web_sobre_mi_model');
		
	}
  function index()
  {
 	$portal_ini=comprobarAdmin();
 	$portal_ini['web_sobre_mi']=$this->Web_sobre_mi_model->getById($portal_ini['usuario_configuracion']->id_configuracion);
 	$this->load->view('peques/sobre_mi_view',$portal_ini);
 	$this->load->view('extras/tiempos_view');
  }
 }
?>