<?php
 class Portal extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Web_configuracion_separadores_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
		$this->load->model('Web_sobre_mi_model');
		$this->load->model('Comentarios_model');
		$this->load->helper('my_usuario_helper');
		$this->load->library('pagination');
		$this->load->helper('smiley');
	}

	
  public function index()
  {
  		
  		$portal_ini=comprobarAdmin(true);
  	
  		$busqueda_visible=$this->n_comentable($portal_ini['usuario_configuracion']);
  		
	  	$portal_ini['categorias']=$this->Categorias_model->getByIdUsuario($portal_ini['usuario_configuracion']->id_usuario);

	  	$arbol['usuario_configuracion']=$portal_ini['usuario_configuracion'];
	  	$arbol['admin']=$portal_ini['admin'];
	  	
	  	$portal_ini['calendario']= $this->load_calendar(date('m'),date('y'),$portal_ini['usuario_configuracion']->id_usuario,$portal_ini['nombre_unico'],$busqueda_visible);

	  	$portal_ini['titulo']=str_replace(array('"', "'"), "", $portal_ini['usuario_configuracion']->titulo);
	  	$portal_ini['descripcion']=str_replace(array('"', "'"), "", $portal_ini['nombre_unico'].' - '.$portal_ini['usuario_configuracion']->eslogan);
	  	$portal_ini['web_sobre_mi']=$this->Web_sobre_mi_model->getById($portal_ini['usuario_configuracion']->id_configuracion);
	   
	  	
	   
	   
	  
	   if (isset($_GET['_escaped_fragment_']))
	   {
	   		if ($_GET['_escaped_fragment_']=='listado_noticias')
	   		{
	   			$pagina=0;
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
	   			
	   		}else if(preg_match("/news\/.+?\/([0-9]+)/", $_GET['_escaped_fragment_'], $coincidencias)){
	   			
	   			$id_noticia=$coincidencias[1];
	   			
	   			$portal_ini['noticia']=$this->Noticias_model->getById($id_noticia);
	   			if (!$portal_ini['noticia'])
	   			{
	   				//no existe
	   				exit;
	   			}
	   			$portal_ini['comentarios']=$this->Comentarios_model->getByIdNoticia($id_noticia);
	   			
	   			// Noticia privada
	   			if ($portal_ini['noticia']->visible == 0 && $portal_ini['admin']==0)
	   			{
	   				$toexec=sprintf(CARGAR_PAGINA_JS, '');
	   				printf(CARGAR_JS_AUTO, $toexec);
	   				exit;
	   			}
	   			
	   			if (!isset($_SESSION['usuario'])){
	   				$this->load->helper('my_create_captcha');
	   					
	   				$cap=my_create_captcha();
	   				$portal_ini['captcha']=$cap['image'];
	   			}
	   			
	   			if (!isset($_SESSION['noticia'.$portal_ini['noticia']->id_noticia]))
	   			{
	   				$_SESSION['noticia'.$portal_ini['noticia']->id_noticia]=1;
	   				$this->Noticias_model->sumarLeido($id_noticia);
	   			}
	   			
	   			// Ver si es comentable
	   			if ($portal_ini['noticia']->comentable == 0
	   					||  !isset($_SESSION['usuario']) && $portal_ini['usuario_configuracion']->comentable_anonimos == 0)
	   			{
	   				$portal_ini['comentable']=false;
	   			}else{
	   				$portal_ini['comentable']=true;
	   			}
	   			
	   			
	   			$portal_ini['titulo']=str_replace(array('"', "'"), "", $portal_ini['nombre_unico'].' - '.$portal_ini['noticia']->titulo);
	   			$portal_ini['descripcion']=str_replace(array('"', "'"), "", $portal_ini['nombre_unico'].' - '.$portal_ini['noticia']->titulo);
	   			
	   			
	   			
	   				
	   			$portal_ini['id_respuesta']=null;$portal_ini['comentario']=null;$portal_ini['accion']='insert';$portal_ini['fieldset']=true;
	   			
	   		}
	   		
	   		
	   }
	   
	   
	   $this->load->view('subtemplates/metas_view',$portal_ini);
	   $this->load->view('peques/iniciador_js_view',$arbol);
	   $this->load->view('subtemplates/header_inicio_view',$portal_ini);
	   $this->load->view('portal_inicio_view',$portal_ini);
	   
	   if (isset($_GET['_escaped_fragment_']))
	   {
		   	if ($_GET['_escaped_fragment_']=='listado_noticias')
		   	{
		   		$this->load->view('peques/listado_noticias_view',$portal_ini);
		   	}else if(preg_match("/news\/.+?\/([0-9]+)/", $_GET['_escaped_fragment_'], $coincidencias)){
		   		$this->load->view('peques/noticia_detalle_view',$portal_ini);
	   			$this->load->view('peques/listado_comentarios_view',$portal_ini);
		   	}
	   }
	   
	   $this->load->view('subtemplates/footer_inicio_view',$portal_ini);
  		
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
	  	$id_usuario=$this->input->post('id');
	  	
	  	
	  	$user_config->id_usuario=$id_usuario;
	  	$busqueda_visible=$this->n_comentable($user_config);
	  	
	  	echo $this->load_calendar($mes,$ano,$id_usuario,$this->input->post('nombre_unico'),$busqueda_visible);
	  	
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