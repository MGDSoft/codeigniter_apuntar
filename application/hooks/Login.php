<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Login
{
	function auto_login()
	{
		$this->recordar_login();
		$this->login_diferentes_dominios();
	}
	
	function recordar_login(){
		if (!isset($_SESSION['usuario']))
		{
			$CI =& get_instance();
				
			$CI->load->helper('cookie');
			$cookie=$CI->input->cookie('auto_login', TRUE);
			//$cookie=cookie('auto_login');
			
				
			if ($cookie)
			{
				$this->agregar_valores_session($cookie);
			}
		}
	}
	
	function login_diferentes_dominios(){
		$CI =& get_instance();
		$CI->load->helper('cookie');
		$cookie=$CI->input->cookie('conectado_ahora', TRUE);
		
		if (!$cookie && isset($_SESSION['usuario']))
		{
			/*
			$user=$_SESSION['usuario'];
			$cookie = array(
					'name'   => 'conectado_ahora',
					'value'  => $user->correo.';'.$user->password,
					'expire' => '3600' // 1 hora
			);
			
			$CI->input->set_cookie($cookie);*/
			unset($_SESSION['usuario']);
			
		}else if ($cookie && !isset($_SESSION['usuario'])){
			$this->agregar_valores_session($cookie);
		}
	}
	
	function agregar_valores_session($cookie){
		$obj = explode(';', $cookie);
		//echo 'cookie '.$cookie; 
		$CI =& get_instance();
		$CI->load->model('Usuario_model');
		$CI->load->model('Usuario_configuracion_model');
		
		if (isset($obj[0]) && isset($obj[1]))
		{
			
			$user=$CI->Usuario_model->login($obj[0],$obj[1]);
			
			if ($user)
				$_SESSION['usuario']=$user;
		}
		
	}
}