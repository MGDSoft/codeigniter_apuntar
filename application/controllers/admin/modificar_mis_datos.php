<?php
class Modificar_mis_datos extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_usuario_helper');
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Usuario_model');
		comprobar_session_activa_y_redirect();
	}

	function index()
	{
		$portal_ini=comprobarAdmin(false,true);
		
		
		$portal_ini['usuario']=$this->Usuario_model->getById($_SESSION['usuario']->id_usuario);
		
		$this->load->model('Zone_time_model');
		$portal_ini['huso_horario']=$this->Zone_time_model->getData();
		
		$portal_ini['titulo']=$portal_ini['nombre_unico'].' - '.$this->lang->line('administrador');
		$portal_ini['descripcion']=$portal_ini['nombre_unico'].' - '.$this->lang->line('administrador');
		
		$this->load->view('admin/modificar_mis_datos_view',$portal_ini);
	}
	
}
?>