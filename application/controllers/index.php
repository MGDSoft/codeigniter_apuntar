<?php
 class Index extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();
		
	}
  function index()
  {
 	if (isset($_GET['logout']))
 	{
 		session_unset();
 		$this->load->helper('cookie');
 		delete_cookie('auto_login');
 		redirect('/', 'refresh');
 	}
   /*$this->session->set_userdata('language', ENGLISH);
   $language = $this->session->userdata('language');
  	*/
   $data['titulo']="tit";
   $data['descripcion']="desc";
   
   $this->load->view('subtemplates/metas_view',$data);
   $this->load->view('subtemplates/header_inicio_view');
   echo date('l jS \of F Y h:i:s A');
   $this->load->view('subtemplates/footer_inicio_view');
  }
 }
?>