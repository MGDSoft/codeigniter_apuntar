<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_file_upload_helper');
		$this->load->model('Usuario_model');
		$this->load->model('Usuario_configuracion_model');
		
	}
	public function prueba()
	{
		$correo=$this->input->get('correo');
		if (isset($correo))
			sendEmail($correo,'titulo correo', 'texto informativo enviado a '. $correo);
	}
	
	
	
	
	
	
}