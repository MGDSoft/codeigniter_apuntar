<?php
class Buscador extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_usuario_helper');
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
		$this->load->helper('smiley');
	}
	function index()
	{
	
		
		$this->load->library('pagination');
		$portal_ini=comprobarAdmin();

		$pagina= (isset($_POST['pag']) ? $this->input->post('pag') : 0 );
		$valor= $this->input->post('valor');
		$id_web= $this->input->post('id_web');
		$categoria= $this->input->post('categoria');
		$visibilidad_busqueda=$this->n_comentable($id_web);
		
		$portal_ini['noticias']=$this->Noticias_model->getNoticiasBusqueda($valor,$id_web,$categoria,$visibilidad_busqueda,$pagina);
		
		$config['base_url'] = RUTA_PORTAL.'#!listado_noticias&pag=';
		$config['total_rows'] = $this->Noticias_model->getNoticiasBusqueda($valor,$id_web,$categoria,1,false,true);
		$config['per_page']   = NUMERO_POR_PAGINA;
		$config['num_links']   = 10;
		$config['cur_page']   = $pagina;

		$this->pagination->initialize($config);
		$portal_ini['titulo']=$portal_ini['nombre_unico'].' - '.$this->lang->line('busqueda');
		$portal_ini['descripcion']=$portal_ini['nombre_unico'].' - '.$this->lang->line('busqueda');
		
		$this->load->view('peques/listado_noticias_view',$portal_ini);
		
		
	}
	
	
	
	function buscar_sugerencias()
	{
		
		$valor= $this->input->post('valor');
		$id_web= $this->input->post('id_web');
		$categoria= $this->input->post('categoria');
		
		$sugerencias=$this->Noticias_model->getSugerencias($valor,$this->n_comentable($id_web),$id_web,$categoria);
		echo json_encode($sugerencias);
		//echo $this->db->last_query();

	}
	
	function buscar_categorias()
	{
	
		$valor= $this->input->post('valor');
		$id_web= $this->input->post('id_web');
	
	
		$sugerencias=$this->Categorias_model->getSugerencias($valor,$id_web);
		echo json_encode($sugerencias);
	
	}
	
	private function n_comentable($id_web){
	
		if (isset($_SESSION['usuario']) && $id_web == $_SESSION['usuario']->id_usuario)
			return 0;
		else
			return 1;
	}
	
}
?>