<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('my_file_upload_helper');
		$this->load->model('Usuario_model');
		$this->load->model('Usuario_configuracion_model');
		
	}
	public function enviar_correo(){
		$this->form_validation->set_rules('id','id','required|trim|numeric');
		$this->form_validation->set_rules('texto_correo','texto_correo','required');
		
		if ($this->form_validation->run()==FALSE)
		{
			printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
		}else{
			$texto_correorecp=$this->input->post('texto_correo');
			$texto_correo="";
			$id=$this->input->post('id');
			
			if (isset($_SESSION['usuario']))
				$texto_correo='Te han enviado un mensaje el siguiente usuario: <br><br> '.$_SESSION['usuario']->nombre.' '.$_SESSION['usuario']->apellidos.' <br>email: '.$_SESSION['usuario']->correo;
			else
				$texto_correo='Te han enviado un mensaje un usuario Anónimo';
			
			$texto_correo.='<br><br>Mensaje: '.$texto_correorecp;
			
			$usuario=$this->Usuario_configuracion_model->getById($id);
			if ($usuario)
			{
				sendEmail($usuario->contacto_email,$this->lang->line('envio_correo_subject'), $texto_correo);
				printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('correo_enviado'));
			}else{
				printf(MSG_ERROR, $this->lang->line('error_db'));
			}
			
			
		}
	}
	public function prueba()
	{
		$correo=$this->input->get('correo');
		if (isset($correo))
			sendEmail($correo,'titulo correo', 'texto informativo enviado a '. $correo);
	}
	
	
	
	
	
	
}