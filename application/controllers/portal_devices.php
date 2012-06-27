<?php
 class Portal_devices extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Web_configuracion_separadores_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
		$this->load->model('Web_sobre_mi_model');
		$this->load->helper('my_usuario_helper');
	}

	public function bienvenido(){
		$portal_ini=iniVarsDevices();
		
		$this->load->view('devices/peques/bienvenido_view');
		$this->load->view('forms/login_Fview',$portal_ini);
		
	}
	
  public function index()
  {
  	
	  	$data['titulo']=$this->lang->line('titulo_portada_device');
	  	$data['descripcion']=$this->lang->line('descripcion_portada_meta');
	  	
  		if (!isset($_SESSION['usuario']))
  		{
	  		$portal_ini=iniVarsDevices();
		  	
	  		$this->load->view('devices/subtemplates/metas_devices_view',$data);
	  		$this->load->view('devices/peques/iniciador_devices_js_view');
	  		$this->load->view('devices/peques/bienvenido_header_view');
	  		$this->load->view('devices/subtemplates/footer_devices_view');
	  		
  		}else{
  			$portal_ini=comprobarAdminDevices();
  			
  			$this->load->view('devices/subtemplates/metas_devices_view',$data);
  			$this->load->view('devices/peques/iniciador_devices_js_view',$portal_ini);
  			$this->load->view('devices/subtemplates/header_devices_view');
  
  			$this->load->view('devices/subtemplates/footer_devices_view');
  		}	
	  		
  		/*
  		
  		
  	
  		$busqueda_visible=$this->n_comentable($portal_ini['usuario_configuracion']);
  		
	  	$portal_ini['categorias']=$this->Categorias_model->getByIdUsuario($portal_ini['usuario_configuracion']->id_usuario);
	  	
	  	$arbol['usuario_configuracion']=$portal_ini['usuario_configuracion'];
	  	$arbol['admin']=$portal_ini['admin'];
	  	
	  	$portal_ini['web_sobre_mi']=$this->Web_sobre_mi_model->getById($portal_ini['usuario_configuracion']->id_configuracion);
	  	
	  	$portal_ini['calendario']= $this->load_calendar(date('m'),date('y'),$portal_ini['usuario_configuracion']->id_usuario,$portal_ini['nombre_unico'],$busqueda_visible);
	  	
	  	if (isset($_GET['ishash']))
	  	{
	  	
	  		$this->load->view('peques/listado_noticias_view',$portal_ini);
	  	
	  	}else{
	  	   
			
		   $this->load->view('subtemplates/metas_view',$data);
		   $this->load->view('peques/iniciador_js_view',$arbol);
		   $this->load->view('subtemplates/header_inicio_view',$portal_ini);
		   $this->load->view('portal_inicio_view',$portal_ini);
		   $this->load->view('subtemplates/footer_inicio_view',$portal_ini);
  		}*/
  }
  public function cargar_calendario()
  {
	  	$ano=$this->uri->segment(2);
	  	$mes=$this->uri->segment(3);

	  	if (!is_numeric($ano) || !is_numeric($mes))
	  	{
	  		$ano=date('y');
	  		$mes=date('m');
	  	}
	  	
	  	/*$portal_ini=comprobarAdmin();
	  	$busqueda_visible=$this->n_comentable($portal_ini['usuario_configuracion']);
	  	*/
	  	
	  	$user_config->id_usuario=$this->input->post('id');
	  	$busqueda_visible=$this->n_comentable($user_config);
	  	
	  	echo $this->load_calendar($mes,$ano,$this->input->post('id'),$this->input->post('nombre_unico'),$busqueda_visible);
	  	
  }
  
  private function load_calendar($mes,$ano,$id_usuario,$nombre_unico,$busqueda_visible){
	  	$prefs = array (
	  			'month_type'   => 'short',
	  			'day_type'     => 'abr',
	  			'show_next_prev'  => TRUE,
	  			'next_prev_url'   => '/calendario/',
	  			'template'=> '{table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}
	  	
	  			{heading_row_start}<tr>{/heading_row_start}
	  	
	  			{heading_previous_cell}<th><a href="javascript:cargar_calendario(\'{previous_url}\',\'id='.$id_usuario.'&nombre_unico='.$nombre_unico.'\')">&lt;&lt;</a></th>{/heading_previous_cell}
	  			{heading_title_cell}<th colspan="{colspan}"><a href="'.RUTA_PORTAL.'#!news/mes/'.$ano.'/'.$mes.'/">{heading}</a></th>{/heading_title_cell}
	  			{heading_next_cell}<th><a href="javascript:cargar_calendario(\'{next_url}\',\'id='.$id_usuario.'&nombre_unico='.$nombre_unico.'\')">&gt;&gt;</a></th>{/heading_next_cell}
	  	
	  			{heading_row_end}</tr>{/heading_row_end}
	  	
	  			{week_row_start}<tr>{/week_row_start}
	  			{week_day_cell}<td>{week_day}</td>{/week_day_cell}
	  			{week_row_end}</tr>{/week_row_end}
	  	
	  			{cal_row_start}<tr>{/cal_row_start}
	  			{cal_cell_start}<td>{/cal_cell_start}
	  	
	  			{cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
	  			{cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
	  	
	  			{cal_cell_no_content}{day}{/cal_cell_no_content}
	  			{cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}
	  	
	  			{cal_cell_blank}&nbsp;{/cal_cell_blank}
	  	
	  			{cal_cell_end}</td>{/cal_cell_end}
	  			{cal_row_end}</tr>{/cal_row_end}
	  	
	  			{table_close}</table>{/table_close}
	  			'
	  	);
	  	$this->load->library('calendar',$prefs);
  	
	  	$fecha_inicio  = date('y-m-1', mktime(0, 0, 0, $mes, 1, $ano));
	  	$fecha_fin  = date('y-m-1', mktime(0, 0, 0, $mes+1, 1, $ano));
  	
	  	
	  	$noticiasEsteMes=$this->Noticias_model->getByDatesOnlyDates($id_usuario,$busqueda_visible,$fecha_inicio,$fecha_fin);
	  	$dias_noticias=array();
	  	foreach($noticiasEsteMes as $not)
	  	{
	  		$dias_noticias[$not->dia]=RUTA_PORTAL.'#!news/fecha/'.$not->ano.'/'.$not->mes.'/'.$not->dia.'/';
	  	}
	  	
	  	return $this->calendar->generate($ano, $mes,$dias_noticias);
  }
  
  private function n_comentable($user_config){
  	 
  	if (isset($_SESSION['usuario']) && $user_config->id_usuario == $_SESSION['usuario']->id_usuario)
	  	return 0;
	else
	  	return 1;
  }
  
 }
?>