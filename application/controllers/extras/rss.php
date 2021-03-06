<?php
class Rss extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('my_usuario_helper');
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Noticias_model');
	}

	function index()
	{
		
		$portal_ini=comprobarAdmin();
		$portal_ini['noticias']=$this->Noticias_model->getByIdUsuario($portal_ini['usuario_configuracion']->id_usuario, 1 , 0);
		
		$portal_ini['titulo']=$portal_ini['usuario_configuracion']->titulo.': '.$portal_ini['usuario_configuracion']->eslogan;
		$portal_ini['feed_url']='http://'.$portal_ini['nombre_unico'].URL_BASE.'/rss';
		$portal_ini['description']=$portal_ini['usuario_configuracion']->eslogan;
		
		if (count($portal_ini['noticias'])>0)
			$portal_ini['pubdate']=$portal_ini['noticias'][count($portal_ini['noticias'])-1]->fecha;
		else 
			$portal_ini['pubdate']='nada';
		
		
		$this->load->view('extras/rss_view',$portal_ini);
	}
	
}
?>