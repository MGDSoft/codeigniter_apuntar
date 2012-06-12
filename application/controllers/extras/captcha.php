<?php
class Captcha extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_usuario_helper');
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
	}
	function nuevo_captcha()
	{
		$this->load->helper('my_create_captcha');
			
		$cap=my_create_captcha();
		printf(RELOAD_CAPTCHAS_JS,PATH_IMG.'captcha/'. $cap['time'].'.jpg');
	}
	
	function index()
	{
	
	}
	
}
?>