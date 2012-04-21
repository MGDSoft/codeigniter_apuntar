<?php 

class Registro_form extends CI_Controller {

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
		$this->form_validation->set_rules('contrasena','contrasena','required|trim');
		$this->form_validation->set_rules('recontrasena','recontrasena','required|matches[contrasena]|trim');
		$this->form_validation->set_rules('nombre','nombre','required|trim');
		$this->form_validation->set_rules('apellidos','apellidos','required|trim');
		$this->form_validation->set_rules('titulo','titulo','required|trim');
		$this->form_validation->set_rules('uso_horario','uso_horario','required|trim');
		
		
		if ($this->form_validation->run()==FALSE)
		{
			 printf(MSG_ERROR, trim(validation_errors()));
		}else{
			
			$this->load->model('Usuario_model');
			
			$insert['nombre']= $this->input->post('nombre');
			$insert['apellidos']= $this->input->post('apellidos');
			$insert['correo']= $this->input->post('correo');
			$insert['uso_horario']= $this->input->post('uso_horario');
			$insert['titulo']= $this->input->post('titulo');
			$insert['nombre_unico']= url_title($this->input->post('titulo'));
			$insert['password']= $this->input->post('password');
			
			/*Validaciones de BD*/
			
			if ($this->Usuario_model->existe_correo($insert['correo']))
				printf(MSG_ERROR_CAMPO, 'correo',$this->lang->line('correo_error_repetido'));
				
			else if ($this->Usuario_model->existe_nombre_unico($insert['nombre_unico']))	
				printf(MSG_ERROR_CAMPO, 'titulo',$this->lang->line('titulo_error_repetido'));
				
			else
			{
					
				if($this->Usuario_model->insert($insert))
					echo "OK";
				else
					printf(MSG_ERROR, $this->lang->line('error_db'));
				
			}
			 
		}
			
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */