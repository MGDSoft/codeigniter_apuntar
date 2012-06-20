<?php
 class Configuracion_web_forms extends CI_Controller{
 	
 	private $i=1;
 	
  	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Web_configuracion_separadores_model');
		$this->load->model('Web_configuracion_diseno_model');
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Web_sobre_mi_model');
		$this->load->library('form_validation');
		
	}
	 public function index()
	  {
	
	  }

	  public function sobre_mi_update(){
	  	
	  	$user_configuration=$this->Usuario_configuracion_model->getById($_SESSION['usuario']->id_usuario);
	  	
	  	if (!$user_configuration || !$_POST)
	  	{
	  		printf(MSG_ERROR, $this->lang->line('trampeando'));
	  		exit;
	  	}
	  	
	  	if (isset($_POST['imagen_sobreti']) && $_POST['imagen_sobreti']!=""&& file_exists('.'.$this->input->post('imagen_sobreti')))
	  	{
	  		$update['sobre_mi']=  str_replace("prueba", "", $this->input->post('imagen_sobreti'));
	  		copy ( '.'.$this->input->post('imagen_sobreti'), '.'.$update['sobre_mi']);
	  		unlink ( '.'.$this->input->post('imagen_sobreti'));
	  		$update['imagen_sobre_mi']=str_replace(PATH_IMG."usuario/personal/", "", $update['sobre_mi']);
	  	}else if ($this->input->post('imagen_sobreti')=='borrar'){
	  		$update['imagen_sobre_mi']=null;
	  	}

	  		$update['sobre_mi'] = $this->input->post('texto_sobre_ti'); 
	  	
	  	if ($this->Web_sobre_mi_model->update($user_configuration->id_configuracion,$update))
	  	{
	  		printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('modificacion_incluida'));
	  			
	  	}else{
	  			
	  		printf(MSG_ERROR, $this->lang->line('error_db'));
	  	}
	  	
	  }
	  
	  
	  public function general_update()
	  {
	  
	  	$user_configuration=$this->Usuario_configuracion_model->getById($_SESSION['usuario']->id_usuario);
	  	 
	  	if (!$user_configuration || !$_POST)
	  	{
	  		printf(MSG_ERROR, $this->lang->line('trampeando'));
	  		exit;
	  	}
	  	
	  	if (isset($_POST['comentable_anonimos']) && $_POST['comentable_anonimos']=="1")
	  		$update['comentable_anonimos']=1;
	  	else
	  		$update['comentable_anonimos']=0;
	  	
	  	if (isset($_POST['visible']) && $_POST['visible']=="1")
	  		$update['visible']=1;
	  	else
	  		$update['visible']=0;
	  	
	  	if (isset($_POST['aviso_comentario']) && $_POST['aviso_comentario']=="1")
	  		$update['aviso_comentario']=1;
	  	else
	  		$update['aviso_comentario']=0;
	  	
	  	$update['eslogan']=$this->input->post('eslogan');
	  	
	  	if (isset($_POST['logo_imagen']) && $_POST['logo_imagen']!="" && file_exists('.'.$this->input->post('logo_imagen')))
	  	{
		  		$update['logo']=  str_replace("prueba", "", $this->input->post('logo_imagen'));	
		  		copy ( '.'.$this->input->post('logo_imagen'), '.'.$update['logo']);
		  		unlink ( '.'.$this->input->post('logo_imagen'));
		  		$update['logo']=str_replace(PATH_IMG."usuario/logo/", "", $update['logo']);	
	  	}
	  	
  		$update['contacto_facebook']= $this->input->post('contacto_facebook');
  		$update['contacto_google']= $this->input->post('contacto_google');
  		$update['contacto_email']= $this->input->post('contacto_email');
  		$update['contacto_steam']= $this->input->post('contacto_steam');
  		$update['contacto_youtube']= $this->input->post('contacto_youtube');
  		$update['contacto_twitter']= $this->input->post('contacto_twitter');
  		$update['contacto_tuenti']= $this->input->post('contacto_tuenti');
  		$update['contacto_pagina_personal']= $this->input->post('contacto_pagina_personal');
  		
  		if ($this->Usuario_configuracion_model->update($user_configuration->id_configuracion,$update))
  		{
  			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('modificacion_incluida'));
  			
  		}else{
  			
  			printf(MSG_ERROR, $this->lang->line('error_db'));
  		}
  
  
	  
	  }
	  
	public function diseno_propio_update()
	  {
	  	
	  	
	  	
	    foreach ( $_POST as $clave => $valor){
	  		$value= $this->input->post($clave);
	  		if ($value!= "" && !empty($value) && $clave != 'iehack')
	  		{
	  			$update[$clave]=$value;
	  		}
	  	}
	  	
	  	if (isset($update['fondo_imagen']) && $update['fondo_imagen']=='borrar'){
	  		$update['fondo_imagen']=null;
	  	}
	  	
	  	if (count($update)>0 && isset($_SESSION['usuario']))
	  	{
	  		$user_configuration=$this->Usuario_configuracion_model->getById($_SESSION['usuario']->id_usuario);
	  		
	  		if (!$user_configuration)
	  		{
	  			printf(MSG_ERROR, $this->lang->line('trampeando'));
	  			exit;
	  		}
	  		 
	  		if ($this->Web_configuracion_diseno_model->update($user_configuration->id_configuracion,$update))
	  			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('diseno_modificado'));
	  		else
	  			printf(MSG_ERROR, $this->lang->line('error_db'));
	  		
	  		
	  	}
	  	
	  	
	  }
	  
	  public function separadores_update()
	  {
	  	$inserts=array();
	  	
	  	foreach ( $_POST as $clave => $valor){
	  		$value= $this->input->post($clave);
	  		
	  		if ($value!= "" && !empty($value) && $clave != 'iehack')
	  		{
	  			$arrClave=preg_split('/\-/', $clave);
	  			$inserts[$arrClave[0]][$arrClave[1]]=$value;
	  		}
	  	}
	  
	  	
	  	if (isset($_SESSION['usuario']))
	  	{
	  		$user_configuration=$this->Usuario_configuracion_model->getById($_SESSION['usuario']->id_usuario);
	  	  
	  		if (!$user_configuration)
	  		{
	  			printf(MSG_ERROR, $this->lang->line('trampeando'));
	  			exit;
	  		}
	 		
	  		$this->Web_configuracion_separadores_model->deleteById($user_configuration->id_configuracion);
	  		
	  		$i=1;
	  		foreach ($inserts as $insert){
	  			$insert['id_configuracion']=$user_configuration->id_configuracion;
	  			$insert['id_separador']=$i;
	  			$this->Web_configuracion_separadores_model->insert($insert);
				++$i;
	  		}
	 	
	  		printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('separadores_modificado'));
	  	
	  	}
	  
	  
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
	  
	  function pruebareordenar()
	  {
	  	echo $_GET['id_usuario'];
	  	$this->reordenarByIdUsuario($_GET['id_usuario']);
	  }
	  
	  function reordenarByIdUsuario($id_usuario)
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