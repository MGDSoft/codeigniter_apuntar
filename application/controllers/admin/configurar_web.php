<?php
class Configurar_web extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_usuario_helper');
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Web_configuracion_separadores_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
		$this->load->model('Web_sobre_mi_model');
	}

	function index()
	{
		$portal_ini=comprobarAdmin(true,true);
		$portal_ini['web_sobre_mi']=$this->Web_sobre_mi_model->getById($portal_ini['usuario_configuracion']->id_configuracion);
		
		$portal_ini['titulo']=$portal_ini['nombre_unico'].' - '.$this->lang->line('administrador');
		$portal_ini['descripcion']=$portal_ini['nombre_unico'].' - '.$this->lang->line('administrador');
		
		$this->load->view('admin/admin_configurar_web_view',$portal_ini);
	}
	
}
?>