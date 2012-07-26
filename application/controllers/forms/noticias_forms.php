<?php

 class Noticias_forms extends CI_Controller{
 	
 	private $i=1;
 	
  	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
		$this->load->library('form_validation');
	}
	  function index()
	  {
	
	  }

	  function insertar_noticia()
	  {
	  	if (isset($_POST['id']))
	  	{
	  		$this->update_noticia();
	  		exit;
	  	}
	  	
	  	$this->form_validation->set_rules('titulo_noticia', $this->lang->line('titulo_noticia'),'required|trim');
	  	$this->form_validation->set_rules('categoria_noticia','categoria_noticia','required|trim');
	  	$this->form_validation->set_rules('texto_noticia','texto_noticia','required');
	  	
	  	if ($this->form_validation->run()==FALSE)
	  	{
	  		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	  	}else{
	  		
	  		$insert['titulo']= $this->input->post('titulo_noticia');
	  		$insert['id_categoria']= $this->input->post('categoria_noticia');
	  		$insert['id_usuario']= $_SESSION['usuario']->id_usuario;
	  		
	  		$insert['noticia'] =  $this->input->post('texto_noticia');

	  		$insert['visible']=  (isset($_POST['visible_noticia']))? 1 : 0;
	  		$insert['comentable']=  (isset($_POST['comentable_noticia']))? 1 : 0;
	  		
	  		if ($id_nueva=$this->Noticias_model->insert($insert))
	  		{
	  			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('noticia_incluida'));
	  			echo "noticia_cambio_modificar($id_nueva,'".$this->lang->line('modificar')."','".$this->lang->line('admin_modificar_noticia')."','news/".url_title($insert['titulo'])."/$id_nueva/')";
	  		}else{
	  			printf(MSG_ERROR, $this->lang->line('error_db'));
	  		}
	  	}
	  }
	  
	  function update_noticia()
	  {
	  	 
	  
	  	$this->form_validation->set_rules('titulo_noticia', $this->lang->line('titulo_noticia'),'required|trim');
	  	$this->form_validation->set_rules('categoria_noticia','categoria_noticia','required|trim');
	  	$this->form_validation->set_rules('texto_noticia','texto_noticia','required|trim');
	  	$this->form_validation->set_rules('id','id','required|trim');
	  	
	  	if ($this->form_validation->run()==FALSE)
	  	{
	  		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	  	}else{
	  		
	  		$update['titulo']= $this->input->post('titulo_noticia');
	  		$update['id_categoria']= $this->input->post('categoria_noticia');
	  		$update['id_usuario']= $_SESSION['usuario']->id_usuario;
	  		
	  	
	  		$update['noticia'] = $this->input->post('texto_noticia') ;
	  		
	  		$update['visible']=  (isset($_POST['visible_noticia']))? 1 : 0;
	  		$update['comentable']=  (isset($_POST['comentable_noticia']))? 1 : 0;
	  		
	  		$id_noticia=$this->input->post('id');
	  		
	  		if ($this->Noticias_model->update($_SESSION['usuario']->id_usuario,$id_noticia,$update))
	  		{
	  			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('noticia_modificada'));
	  			
	  		}else{
	  			echo $this->db->last_query();
	  			printf(MSG_ERROR, $this->lang->line('error_db'));
	  		}
	  	}
	  	 
	  }
	  
	  
	  
	  function delete_noticia()
	  {

	  	$this->form_validation->set_rules('id','id','required|trim');
	  	 
	  	 
	  	if ($this->form_validation->run()==FALSE)
	  	{
	  		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	  	}else{
	  		 
	  		$id_noticia= $this->input->post('id');
	  		$id_usuario= $_SESSION['usuario']->id_usuario;
	  
	  		if ($this->Noticias_model->delete($id_usuario,$id_noticia))
	  		{
	  			$usuario_configuracion_model=$this->Usuario_configuracion_model->getById($id_usuario);
	  			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('noticia_borrada'));
	  			printf(CARGAR_PAGINA_JS,'');
	  			 
	  		}else{
	  			printf(MSG_ERROR, $this->lang->line('error_db'));
	  		}
	  		
	  	}
	  	 
	  }
	 
 }
?>