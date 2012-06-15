<?php
 class Noticia_detalle extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Comentarios_model');
		$this->load->model('Noticias_model');
		
		$this->load->helper('my_usuario_helper');
		
		$this->load->library('pagination');
		$this->load->library('table');
		$this->load->helper('smiley');
	}
  function index()
  {
  		
  		$id_noticia=($this->uri->segment(3) ?  $this->uri->segment(3) : '' );
  		
  		if (empty($id_noticia))
  		{
  			//no hay id de la noticia existe
  			exit;
  		}
  		
  		$portal_ini=comprobarAdmin();
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
  		
  		
		$this->load->view('peques/noticia_detalle_view',$portal_ini);
		$this->load->view('peques/listado_comentarios_view',$portal_ini);
 		
		$portal_ini['id_respuesta']=null;$portal_ini['comentario']=null;$portal_ini['accion']='insert';$portal_ini['fieldset']=true;
		$this->load->view('forms/comentario_fview',$portal_ini);
		$this->load->view('extras/tiempos_view');
  }
  
 }
?>