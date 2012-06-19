<?php
class Noticia extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_usuario_helper');
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
		comprobar_session_activa_y_redirect();
	}

	
	function index()
	{
	}
	

	
	function nueva_noticia()
	{
		
		$portal_ini=comprobarAdmin(false,true);
		$portal_ini['categorias']=$this->Categorias_model->getByIdUsuarioParaOrdenar($portal_ini['usuario_configuracion']->id_usuario);
		$portal_ini['accion']='insert';
		$portal_ini['titulo']=$portal_ini['nombre_unico'].' - '.$this->lang->line('administrador');
		$portal_ini['descripcion']=$portal_ini['nombre_unico'].' - '.$this->lang->line('administrador');
		
		$this->load->view('admin/admin_noticia_view',$portal_ini);

	}
	
	function modificar_noticia()
	{
		
		
		$id=$this->input->post('id');
	  
	  	
	  	if (!is_numeric($id))
	  	{
	  		printf(MSG_ERROR, $this->lang->line('error'));
	  	}else{
	  		$portal_ini=comprobarAdmin(false,true);
	  		$portal_ini['noticia']=$this->Noticias_model->getById($id);
	  		$portal_ini['categorias']=$this->Categorias_model->getByIdUsuarioParaOrdenar($portal_ini['usuario_configuracion']->id_usuario);
	  		$portal_ini['accion']='update';
	  		$portal_ini['titulo']=$portal_ini['nombre_unico'].' - '.$this->lang->line('administrador');
	  		$portal_ini['descripcion']=$portal_ini['nombre_unico'].' - '.$this->lang->line('administrador');
	  		
	  		$this->load->view('admin/admin_noticia_view',$portal_ini);
	  	}
		
		
	
	}
	
}
?>