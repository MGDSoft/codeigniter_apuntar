<?php 

class Login_form extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
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
			 printf(MSG_ERROR, trim(validation_errors()));
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
				
				if (isset($recordar))
				{
					$cookie = array(
							'name'   => 'auto_login',
							'value'  => $user->correo.';'.$user->password,
							'expire' => '86500'
					);
					$this->load->helper('cookie');
					set_cookie($cookie);
				}
				
				$this->load->model('Usuario_configuracion_model');
				
				$user_configuration=$this->Usuario_configuracion_model->getById($user->id_usuario);
				
				$_SESSION['usuario']=$user;$_SESSION['usuario_configuracion']=$user_configuration;
				
				printf(REDIRECT_URL_JS, $user_configuration->nombre_unico);
				exit;
			}
			
		}
			
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */