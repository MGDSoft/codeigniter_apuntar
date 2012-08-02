<?php
 class Listado_noticias extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();
				
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
		
		// Auto cargar pagina entera
		$this->load->model('Web_configuracion_separadores_model');
		$this->load->model('Categorias_model');
		$this->load->model('Web_sobre_mi_model');
		//
		
		$this->load->helper('my_usuario_helper');
		
		
		$this->load->library('pagination');
		$this->load->library('table');
		$this->load->library('cache_fragment');
		$this->load->helper('smiley');
	}
	function por_fecha()
	{
	
		
		$pagina=(isset($_POST['pag']) ?  $this->input->post('pag') : 0 );
		
		$ano=$this->uri->segment(3);
		$mes=$this->uri->segment(4);
		$dia=$this->uri->segment(5);
		
		if (!is_numeric($ano) || !is_numeric($mes) || !is_numeric($dia))
		{
			// no valido trampeando
			exit;
		}
		
		$portal_ini=comprobarAdmin();
		$fechaMin  = date('y-m-d', mktime(0, 0, 0, $mes, $dia,  $ano));
		$fechaMax = date('y-m-d', mktime(0, 0, 0,$mes, $dia+1,  $ano));
		
		$busqueda_visible=$this->n_comentable($portal_ini['usuario_configuracion']);
		$portal_ini['noticias']=$this->Noticias_model->getByDates($portal_ini['usuario_configuracion']->id_usuario ,$busqueda_visible, $fechaMin,$fechaMax, $pagina);
		 
		
		$config['base_url'] = RUTA_PORTAL.'#!news/fecha/'.$ano.'/'.$mes.'/'.$dia.'/&pag=';
		$config['total_rows'] = $this->Noticias_model->getByDates($portal_ini['usuario_configuracion']->id_usuario ,$busqueda_visible ,$fechaMin,$fechaMax, null,true);
		$config['per_page'] = NUMERO_POR_PAGINA;
		$config['num_links'] = NUMERO_POR_PAGINA;
		$config['cur_page'] = $pagina;
		$config['uri_segment'] = 100;
		
	
		//iniciamos la paginacion
		$this->pagination->initialize($config);
	
		$portal_ini['titulo']=$portal_ini['nombre_unico'].' - '.$this->lang->line('busqueda_fecha').' '.$fechaMin.' '.$fechaMax;
		$portal_ini['descripcion']=$portal_ini['nombre_unico'].' - '.$this->lang->line('busqueda_fecha').' '.$fechaMin.' '.$fechaMax;
	
		$this->load->view('peques/listado_noticias_view',$portal_ini);
			
	}
	
	public function por_mes()
	{
	
	
		$pagina=(isset($_POST['pag']) ?  $this->input->post('pag') : 0 );
	
		$ano=$this->uri->segment(3);
		$mes=$this->uri->segment(4);
		$dia=1;
	
		if (!is_numeric($ano) || !is_numeric($mes) || !is_numeric($dia))
		{
			// no valido trampeando
			exit;
		}
	
		$portal_ini=comprobarAdmin();
		$fechaMin  = date('y-m-d', mktime(0, 0, 0, $mes, $dia,  $ano));
		$fechaMax = date('y-m-d', mktime(0, 0, 0,$mes+1, $dia,  $ano));
		
		$busqueda_visible=$this->n_comentable($portal_ini['usuario_configuracion']);
	
		$portal_ini['noticias']=$this->Noticias_model->getByDates($portal_ini['usuario_configuracion']->id_usuario ,$busqueda_visible,$fechaMin,$fechaMax, $pagina);
			
	
		$config['base_url'] = RUTA_PORTAL.'#!news/mes/'.$ano.'/'.$mes.'/&pag=';
		$config['total_rows'] = $this->Noticias_model->getByDates($portal_ini['usuario_configuracion']->id_usuario ,$busqueda_visible,$fechaMin,$fechaMax, null,true);
		$config['per_page'] = NUMERO_POR_PAGINA;
		$config['num_links'] = NUMERO_POR_PAGINA;
		$config['cur_page'] = $pagina;
		$config['uri_segment'] = 100;
	
	
		//iniciamos la paginacion
		$this->pagination->initialize($config);
	
		$portal_ini['titulo']=$portal_ini['nombre_unico'].' - '.$this->lang->line('busqueda_fecha').' '.$fechaMin.' '.$fechaMax;
		$portal_ini['descripcion']=$portal_ini['nombre_unico'].' - '.$this->lang->line('busqueda_fecha').' '.$fechaMin.' '.$fechaMax;
		
	
		$this->load->view('peques/listado_noticias_view',$portal_ini);
			
	}
  public function index()
  {

  		$pagina=(isset($_POST['pag']) ?  $this->input->post('pag') : 0 );
  		
  		if (isset($_GET['ishash']))
  			$portal_ini=comprobarAdmin();
  		else  
  			$portal_ini=comprobarAdmin(true);

  		$busqueda_visible=$this->n_comentable($portal_ini['usuario_configuracion']);
  		$portal_ini['pagina']=$pagina;
	  	$portal_ini['noticias']=$this->Noticias_model->getByIdUsuario($portal_ini['usuario_configuracion']->id_usuario, $busqueda_visible , $pagina);
	  
	  	$config['base_url'] = RUTA_PORTAL.'#!listado_noticias&pag=';
	  	$config['total_rows'] = $this->Noticias_model->getByIdUsuario($portal_ini['usuario_configuracion']->id_usuario,$busqueda_visible,null,true);
	  	$config['per_page'] = NUMERO_POR_PAGINA;
	  	$config['num_links'] = NUMERO_POR_PAGINA;
	  	$config['cur_page'] = $pagina;
	  	
	  	//iniciamos la paginacion
	  	$this->pagination->initialize($config);
	  	
	  	$portal_ini['titulo']=str_replace(array('"', "'"), "", $portal_ini['nombre_unico'].' - '.$this->lang->line('noticias'));
	  	$portal_ini['descripcion']=str_replace(array('"', "'"), "", $portal_ini['nombre_unico'].' - '.$this->lang->line('noticias').' '. $this->lang->line('pagina') .' '.($pagina+1) );
	  	
		$this->load->view('peques/listado_noticias_view',$portal_ini);
		
		$this->load->view('extras/tiempos_view');
		
  }
  private function n_comentable($user_config){
  	
  	if (isset($_SESSION['usuario']) && $user_config->id_usuario == $_SESSION['usuario']->id_usuario)
	  	return 0;
	else
	  	return 1;
  }
  
  
  
 }
?>