<?php 

class crud extends CI_Controller {

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
		//$this->load->scaffolding('usuarios');
		
	}
	public function index()
	{
		$this->output->enable_profiler(TRUE);

	}
	public function rendimiento()
	{
		$this->benchmark->mark('inicio_test');
		
		
		$this->benchmark->mark('fin_test');
		echo "Tiempo".$this->benchmark->elapsed_time('inicio_test','fin_test');
	}
	public function test()
	{
		$this->load->library('unit_test');
		
		$tests=Array(3+2,2+3,1+4,2+1,'texto');
		$resulado_esperado=5;
		foreach ($tests as $tes)
		{
			$this->unit->run($tes,$resulado_esperado,'test');
		}
		
		echo $this->unit->report();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */