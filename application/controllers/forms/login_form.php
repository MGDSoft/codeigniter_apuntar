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
		
		$this->form_validation->set_rules('correo','correo','required');
		$this->form_validation->set_rules('password','password','required|valid_email');
		
		if ($this->form_validation->run()==FALSE)
		{
			 echo validation_errors();
		}	
		else{
			  
		}
			
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */