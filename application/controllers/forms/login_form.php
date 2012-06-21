<?php 

class Login_form extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

	}
	public function index()
	{
		
		$this->form_validation->set_rules('correo','correo','required|valid_email|trim');
		$this->form_validation->set_rules('password','password','required|trim|md5');
		
		if ($this->form_validation->run()==FALSE)
		{
			 printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
		}	
		else{
			
			$correo= $this->input->post('correo');
			$password= $this->input->post('password');
			$recordar= $this->input->post('recordar');
			
			$this->load->model('Usuario_model');
			$user=$this->Usuario_model->login($correo,$password);
			
			if (!$user)
			{
				printf(MSG_WATCHOUT, $this->lang->line('error_form_estandar'),$this->lang->line('login_incorrecto'));
				exit;
			}
			
			if ($user->activo !=1)
			{
				printf(MSG_WATCHOUT, $this->lang->line('error_form_estandar'),$this->lang->line('activar_tu_cuenta'));
				exit;
			}else{
				$this->load->helper('cookie');
				
				if (isset($recordar))
				{
					$cookie = array(
							'name'   => 'auto_login',
							'value'  => $user->correo.';'.$user->password,
							'expire' => '86500'
					);
					
					set_cookie($cookie);
				}
				
				$cookie = array(
						'name'   => 'conectado_ahora',
						'value'  => $user->correo.';'.$user->password,
						'expire' => '3600' // 1 hora
				);
					
				$this->input->set_cookie($cookie);
				
				$this->load->model('Usuario_configuracion_model');
				
				//$user_configuration=$this->Usuario_configuracion_model->getById($user->id_usuario);
				
				$_SESSION['usuario']=$user;
				
				printf(REDIRECT_URL_JS, RUTA_PORTAL);
				exit;
			}
			
		}
			
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */