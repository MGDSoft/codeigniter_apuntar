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
	  	
	  	$nombre_unico=$this->input->post('nombre_unico');
	  	if ($user_configuration->titulo != $nombre_unico)
	  	{
	  		global $nombresProhibidos;
	  		
	  		$nombre_unico_un=url_title($nombre_unico);
	  		if(in_array($nombre_unico_un, $nombresProhibidos)){
	  		
	  			printf(MSG_ERROR_CAMPO, 'nombre_unico',$this->lang->line('titulo_error_restringido'));
	  			exit;
	  		
	  		}else if ($this->Usuario_configuracion_model->existe_nombre_unico($nombre_unico) ){
	  		
	  			printf(MSG_ERROR_CAMPO, 'nombre_unico',$this->lang->line('titulo_error_repetido'));
	  			exit;
	  		
	  		}
	  		$update['titulo']=$nombre_unico;
	  		$update['nombre_unico']=$nombre_unico_un;
	  	}
	  	
	  	$update['eslogan']=$this->input->post('eslogan');
	  	
	  	if (isset($_POST['logo_imagen']) && $_POST['logo_imagen']!="" && file_exists('.'.$this->input->post('logo_imagen')))
	  	{
		  		$update['logo']=  str_replace("prueba", "", $this->input->post('logo_imagen'));	
		  		copy ( '.'.$this->input->post('logo_imagen'), '.'.$update['logo']);
		  		unlink ( '.'.$this->input->post('logo_imagen'));
		  		$update['logo']=str_replace(PATH_IMG."usuario/logo/", "", $update['logo']);	
	  	}
	  	
  		$update['contacto_facebook']= (($this->input->post('contacto_facebook')=='http://')? '' : $this->input->post('contacto_facebook'));
  		$update['contacto_google']= (($this->input->post('contacto_google')=='http://')? '' : $this->input->post('contacto_google'));$this->input->post('contacto_google');
  		$update['contacto_email']= $this->input->post('contacto_email');
  		$update['contacto_steam']= (($this->input->post('contacto_steam')=='http://')? '' : $this->input->post('contacto_steam'));
  		$update['contacto_youtube']= (($this->input->post('contacto_youtube')=='http://')? '' : $this->input->post('contacto_youtube'));
  		$update['contacto_twitter']= (($this->input->post('contacto_twitter')=='http://')? '' : $this->input->post('contacto_twitter'));
  		$update['contacto_tuenti']= (($this->input->post('contacto_tuenti')=='http://')? '' : $this->input->post('contacto_tuenti'));
  		$update['contacto_pagina_personal']= (($this->input->post('contacto_pagina_personal')=='http://')? '' : $this->input->post('contacto_pagina_personal'));
  		
  		if ($this->Usuario_configuracion_model->update($user_configuration->id_configuracion,$update))
  		{
  			if (isset($update['nombre_unico']))
  				echo "window.location = 'http://".$update['nombre_unico'].'.'.URL_BASE.'/portal#!admin/configurar_web/\'';
  			else
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
	  	
	  	if (isset($update) && count($update)>0 && isset($_SESSION['usuario']))
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
	  
	  public function cargar_diseno_azul(){
	  	$json='{ 
	  	bordes_color: "#005485",
	  	botones_borde_color: "#000000",
	  	botones_caja_sombra: "#999999",
	  	botones_color: "#00244a",
	  	botones_fondo: "#ffffff",
	  	botones_sombra_letra: "#ebebeb",
	  	botones_tipo_letra: "\'Comic Sans MS\',cursive",
	  	eslogan_separacion_vertical: "6px",
	  	fondo_color: "#ffffff",
	  	fondo_estilo: "imagen_repite_x",
	  	fondo_imagen: "'.PATH_IMG.'usuario/fondo/fondo_azul.jpg",
	  	formulario_color: "#0d0d0d",
	  	formulario_estilo: "Arial,\'DejaVu Sans\',\'Liberation Sans\',Freesans,sans-serif",
	  	formulario_tamano: "15px",
	  	link_color: "#22637d",
	  	link_tamano: "15px",
	  	link_visitado_color: "#014070",
	  	otros_color: "#015170",
	  	texto_color: "#000000",
	  	texto_estilo: "\'Trebuchet MS\', Helvetica, sans-serif",
	  	texto_tamano: "14px",
	  	titulo_color: "#00244a",
	  	titulo_estilo: "Times New Roman, Times, serif",
	  	titulo_principal_tamano: "41px",
	  	titulo_sombra: "#ffffff"
	  	}';
	  	
	  	echo trim( '
	  				modo_espera=true;
	  				dar_valores_diseno('.$json.');
	  				modo_espera=false;
	  				carga_diseno_opciones('.$json.');
	  				borrarTodos();');
	  }
	  
	  public function cargar_diseno_gris(){
	  	$json='{
	  			bordes_color: "#9e9e9e",
	  			botones_borde_color: "#5c5c5c",
	  			botones_caja_sombra: "#999999",
	  			botones_color: "#FFFFFF",
	  			botones_fondo: "#dedede",
	  			botones_sombra_letra: "#000000",
	  			botones_tipo_letra: "Arial,\'DejaVu Sans\',\'Liberation Sans\',Freesans,sans-serif",
	  			eslogan_separacion_vertical: "4px",
	  			fondo_color: "#ffffff",
	  			fondo_estilo: "centrado",
	  			fondo_imagen: "none",
	  			formulario_color: "#0D0D0D",
	  			formulario_estilo: "Arial,\'DejaVu Sans\',\'Liberation Sans\',Freesans,sans-serif",
	  			formulario_tamano: "15px",
	  			link_color: "#00244A",
	  			link_tamano: "17px",
	  			link_visitado_color: "#015269",
	  			otros_color: "#636363",
	  			texto_color: "#303030",
	  			texto_estilo: "Arial,\'DejaVu Sans\',\'Liberation Sans\',Freesans,sans-serif",
	  			texto_tamano: "15px",
	  			titulo_color: "#00244A",
	  			titulo_estilo: "Arial,\'DejaVu Sans\',\'Liberation Sans\',Freesans,sans-serif",
	  			titulo_principal_tamano: "35px",
	  			titulo_sombra: "#EDEDED"
	  }';
	  	echo trim('modo_espera=true;
	  			dar_valores_diseno('.$json.');
	  			modo_espera=false;
	  			carga_diseno_opciones('.$json.');
	  			borrarTodos();
	  			modificar_separados_json({  
					separador_fondo: "#F5F5F5",
					separador_color_borde: "#CCCCCC",
					separador_posicion: "90px",
					separador_grosor: "1px",
					separador_estilo: "solid",
					separador_altura: "60px"
				});
	  			cargarSeparadores();
	  			');
	  }
	  
 }
?>