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
		$this->form_validation->set_rules('contrasena','contrasena','required|trim|md5');
		$this->form_validation->set_rules('recontrasena','recontrasena','required|matches[contrasena]|trim');
		$this->form_validation->set_rules('nombre','nombre','required|trim');
		$this->form_validation->set_rules('apellidos','apellidos','required|trim');
		$this->form_validation->set_rules('titulo','titulo','required|trim');
		$this->form_validation->set_rules('uso_horario','uso_horario','required|trim');
		
		
		if ($this->form_validation->run()==FALSE)
		{
			 printf(MSG_ERROR, trim(validation_errors()));
		}else{
			
			$this->load->helper('string');
			
			$this->load->model('Usuario_model');
			$this->load->model('Usuario_configuracion_model');
			
			
			$insertUsuario['nombre']= $this->input->post('nombre');
			$insertUsuario['apellidos']= $this->input->post('apellidos');
			$insertUsuario['correo']= $this->input->post('correo');
			$insertUsuario['id_zone_time']= $this->input->post('uso_horario');
			$insertUsuario['password']= $this->input->post('contrasena');
			$insertUsuario['activar_cuenta']= random_string('alnum', 16);
			
			
			$insertConfiguracion['id_zone_time']= $insertUsuario['id_zone_time'];
			$insertConfiguracion['titulo']= $this->input->post('titulo');
			$insertConfiguracion['nombre_unico']= url_title($this->input->post('titulo'));
			
			
			/*Validaciones de BD*/
			
			if ($this->Usuario_model->existe_correo($insertUsuario['correo']))
			{
				printf(MSG_ERROR_CAMPO, 'correo',$this->lang->line('correo_error_repetido'));
				exit;
				
			}else if ($this->Usuario_configuracion_model->existe_nombre_unico($insertConfiguracion['nombre_unico'])){
				
				printf(MSG_ERROR_CAMPO, 'titulo',$this->lang->line('titulo_error_repetido'));
				exit;
				
			}else{
				
				$this->db->trans_begin();
				$id_user=$this->Usuario_model->insert($insertUsuario);
				$insertConfiguracion['id_usuario']= ($id_user) ? $id_user : null;
				
				$id_user=$this->Usuario_configuracion_model->insert($insertConfiguracion);
				
				echo $this->db->last_query();
				echo $this->db->trans_status();
				
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					printf(MSG_ERROR, $this->lang->line('error_db'));
					
				}else{
					//sendEmail($insertUsuario['correo'],$this->lang->line('activar_tu_cuenta_correo_cuenta'),$this->lang->line('activar_tu_cuenta_correo_texto'));
					$this->db->trans_commit();
					echo RESPONSE_OK_JS;
				}
			}
				
				
					
				
		}
			 
	}
			
}
	


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */