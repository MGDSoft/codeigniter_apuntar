<?php
 class Registro extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		
	}
  function index()
  {
   
	   /*$this->session->set_userdata('language', ENGLISH);
	   $language = $this->session->userdata('language');
	  	*/
	   $data['titulo']="tit";
	   $data['descripcion']="desc";
	   
	   $this->load->model('Zone_time_model');
	   
	   $vars['huso_horario']=$this->Zone_time_model->getData();
	   //print_r($huso_horario);
	   
	   $this->load->view('subtemplates/metas_view',$data);
	   $this->load->view('subtemplates/header_inicio_view');
	   $this->load->view('forms/registro_Fview',$vars);
	   $this->load->view('subtemplates/footer_inicio_view');
  }
 }
?>