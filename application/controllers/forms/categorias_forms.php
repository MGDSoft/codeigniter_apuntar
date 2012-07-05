<?php
 class Categorias_forms extends CI_Controller{
 	
 	private $i=1;
 	
  	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Categorias_model');
		$this->load->library('form_validation');
		$this->load->helper('my_usuario_helper');
		comprobar_session_activa_y_redirect(false);
	}
	  function index()
	  {
	
	  }

	  function nueva_categoria()
	  {
	  	
	  	
	  	$this->form_validation->set_rules('nombre_categoria','papuxi','required|trim');
	  	$this->form_validation->set_rules('id_padre','id_padre','required|trim');
	  	
	  	
	  	if ($this->form_validation->run()==FALSE)
	  	{
	  		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	  	}else{
	  			
	  		$categoria= $this->input->post('nombre_categoria');
	  		$id_padre= $this->input->post('id_padre');
	  		
	  		$insert['nombre']=$categoria;
	  		$insert['id_padre']=$id_padre;
	  		
	  		if ($id_nueva=$this->Categorias_model->insert($insert))
	  		{
	  			$this->reordenarByIdUsuario($_SESSION['usuario']->id_usuario);
	  			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('categoria_incluida'));
	  			
	  		}else{
	  			printf(MSG_ERROR, $this->lang->line('error_db'));
	  		}
	  		
	  	}
	  	
	  }
	  
	  public function prueba_borrar_cat(){
	  	print_r( $this->Categorias_model->obtenerIdsCategoriasHijas($_SESSION['usuario']->id_usuario,3));
	  }
	  function borrar_categoria()
	  {

	  	$this->form_validation->set_rules('id','id','required|trim');
	  	 
	  	 
	  	if ($this->form_validation->run()==FALSE)
	  	{
	  		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	  	}else{
	  		 
	  		$id_categoria= $this->input->post('id');
	  
	  		if ($this->Categorias_model->delete($_SESSION['usuario']->id_usuario,$id_categoria))
	  		{
	  			$this->reordenarByIdUsuario($_SESSION['usuario']->id_usuario);
	  			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('categoria_borrada'));
	  			 
	  		}else{
	  			printf(MSG_ERROR, $this->lang->line('error_db'));
	  		}
	  
	  	}
	  	 
	  }
	  
	  function modificar_categoria()
	  {
	  
	  
	  	$this->form_validation->set_rules('nombre_categoria','papuxi','required|trim');
	  	$this->form_validation->set_rules('id','id','required|trim');
	  
	  
	  	if ($this->form_validation->run()==FALSE)
	  	{
	  		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	  	}else{
	  
	  		$categoria= $this->input->post('nombre_categoria');
	  		$id_categoria= $this->input->post('id');
	  	    
	  		$update['nombre']=$categoria;
	  		
	  	  
	  		if ($id_nueva=$this->Categorias_model->update($_SESSION['usuario']->id_usuario,$id_categoria,$update))
	  		{
	  			//$this->reordenarByIdUsuario($_SESSION['usuario']->id_usuario);
	  			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('categoria_modificada'));
	  
	  		}else{
	  			printf(MSG_ERROR, $this->lang->line('error_db'));
	  		}
	  	  
	  	}
	  
	  }
	  
	  function re_cargar(){
	  	//print_r($_POST);
	  	$this->re_cargarById($this->input->post('idUsuario'));
	  }
	  function re_cargarById($id){
	  	
	  	
	  	$portal_ini['categorias']=$this->Categorias_model->getByIdUsuario($id);
	  	$portal_ini['admin']=(isset($_SESSION['usuario']) && $_SESSION['usuario']->id_usuario==$id) ? true : false;
	  	
	  	//print_r($portal_ini);
	  	$this->load->view('peques/arbol_categorias_view',$portal_ini);
	  	
	  }
	  
	  public function reordenamientoPost(){
	  	
	  	$id_usuario=$this->input->post('id_usuario');
	  	
	  		if (is_numeric($id_usuario))
	  		{
	  			$_SESSION['usuario']->id_usuario=$id_usuario;
	  			$this->reordenarByIdUsuario($id_usuario);
	  			session_unset($_SESSION['usuario']);
	  		}
	  			
	  		
	  		
	  }
	  
	  private function reordenarByIdUsuario($id_usuario)
	  {
	  	$this->i=1;
	  	$categorias=$this->Categorias_model->getByIdUsuarioParaOrdenar($id_usuario);
	  	

	  	$result;
	  	
	  	foreach ($categorias as $categoria)
	  	{
	  		if ($categoria->id_padre == 0)
	  		{
	  			$datos['orden']=$this->i;++$this->i;$datos['id_usuario']=$_SESSION['usuario']->id_usuario;
	  			$this->Categorias_model->update($_SESSION['usuario']->id_usuario,$categoria->id_categoria,$datos);
	  			
	  			$this->buscar_dependencias($categorias,$categoria->id_categoria);
	  		}
	  	}
	  }
	  
	  function buscar_dependencias($categorias,$id_categoria)
	  {
	  	foreach ($categorias as $categoria)
	  	{
	  		if ($categoria->id_padre == $id_categoria)
	  		{
	  			$datos['orden']=$this->i;++$this->i;
	  			
	  			$this->Categorias_model->update($_SESSION['usuario']->id_usuario,$categoria->id_categoria,$datos);
	  			$this->buscar_dependencias($categorias,$categoria->id_categoria);
	  			
	  		}
	  	}
	  }
 }
?>