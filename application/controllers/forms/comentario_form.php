<?php 

class Comentario_form extends CI_Controller {

	
	 public function __construct()
	 {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Usuario_model');
		$this->load->model('Noticias_model');
		$this->load->model('Comentarios_model');
		$this->load->model('Usuario_configuracion_model');
		
	 }
	 public function index()
	 {
	 	
	 }
	 
	 public function mute()
	 {
	 	$this->form_validation->set_rules('id','id','is_numeric');
	 	if ($this->form_validation->run()==FALSE)
	 	{
	 		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	 	}else{
	 
	 		$id=$this->input->post('id');
	 		
	 
	 		$comentario=$this->Comentarios_model->getById($id);
	 		if (!$comentario)
	 			exit;
	 
	 		$noticia=$this->Noticias_model->getById($comentario->id_noticia);
	 		if (!$noticia)
	 			exit;
	 
	 
	 		if (isset($_SESSION['usuario']) && $noticia->id_usuario == $_SESSION['usuario']->id_usuario)
	 		{
	 			if ($comentario->mute==1)
	 			{
	 				$update['mute']=0;
	 			}else{
	 				$update['mute']=1;
	 				$razon=$this->input->post('razon');
	 				$update['razon']=$razon;
	 			}
	 			
	 			
	 			
	 			if($this->Comentarios_model->update($id,$update)){
	 
	 				printf(RELOAD_PAGINA_JS, '');
	 				
	 				if ($comentario->mute==1)
	 					printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('comentario_desmuteado'));
	 				else
	 					printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('comentario_muteado'));
	 			}else{
	 				printf(MSG_ERROR, $this->lang->line('error_db'));
	 			}
	 				
	 		}else{
	 			printf(MSG_ERROR, $this->lang->line('trampeando'));
	 		}
	 
	 	}
	 }
	 
	 
	 public function delete()
	 {
	 	$this->form_validation->set_rules('id','id','is_numeric');
	 	if ($this->form_validation->run()==FALSE)
	 	{
	 		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	 	}else{
	 		
	 		$id=$this->input->post('id');
	 		
	 		$comentario=$this->Comentarios_model->getById($id);
	 		if (!$comentario)
	 			exit;
	 		
	 		$noticia=$this->Noticias_model->getById($comentario->id_noticia);
	 		if (!$noticia)
	 			exit;
	 		
	 		
	 		if (isset($_SESSION['usuario']) && $noticia->id_usuario == $_SESSION['usuario']->id_usuario)
	 		{
	 			if($this->Comentarios_model->deleteById($id)){
	 				
	 				$update['comentarios']=$this->Comentarios_model->countByIdNoticia($noticia->id_noticia);
	 				$this->Noticias_model->update($noticia->id_usuario,$noticia->id_noticia,$update);
	 				
	 				
	 				printf(RELOAD_PAGINA_JS, '');
	 				printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('comentario_borrado'));
	 			}else{
	 				printf(MSG_ERROR, $this->lang->line('error_db'));
	 			}
	 			
	 		}else{
	 			printf(MSG_ERROR, $this->lang->line('trampeando'));
	 		}

	 	}
	 }
	 
	 public function voto_noticia()
	 {
	 	$this->form_validation->set_rules('id','id','is_numeric');
	 	$this->form_validation->set_rules('voto','voto','is_numeric');
	 	
	 	if ($this->form_validation->run()==FALSE)
	 	{
	 		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	 	}else{
	 		
	 		$id=$this->input->post('id');
	 		$voto=$this->input->post('voto');
	 		$restar=0;
	 		
	 		if (isset($_SESSION['noticia_voto'.$id]))
	 		{
	 			$restar=$_SESSION['noticia_voto'.$id];
	 		}
	 
	 		if ($this->Noticias_model->agregar_voto($id,$voto,$restar)){
	 			
	 			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('voto_incluido'));
	 			$_SESSION['noticia_voto'.$id]=$voto;
	 			
	 			if ($restar==0)
	 				printf(MODIFICAR_VOTO_NOTICIA_JS, 'noticia_n_votos'.$id);
	 			
	 		}else{
	 			printf(MSG_ERROR, $this->lang->line('error_db'));
	 		}
	 		
	 	}
	 }
	 
	 
	 public function voto_positivo()
	 {
	 	$this->form_validation->set_rules('id','id','is_numeric');
	 	if ($this->form_validation->run()==FALSE)
	 	{
	 		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	 	}else{
	 		$id=$this->input->post('id');
	 		$borrado=0;
	 		if (isset($_SESSION['comentario'.$id]))
	 		{
	 			if ($_SESSION['comentario'.$id]==1)
	 			{
	 				exit;
	 			}else{
	 				
	 				$borrado=-1;
	 			}
	 		}
	 		
	 		
	 		if ($this->Comentarios_model->update_votos($id,+1,$borrado)){
	 			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('voto_incluido'));
	 			$_SESSION['comentario'.$id]=1;
	 			printf(MODIFICAR_VOTO_JS, 'comentario_voto_positivo'.$id, 'mas');
	 			if ($borrado==-1)
	 				printf(MODIFICAR_VOTO_JS, 'comentario_voto_negativo'.$id, 'menos');
	 			
	 		}else{
	 			printf(MSG_ERROR, $this->lang->line('error_db'));
	 		}
	 		//echo $this->db->last_query();
	 	}
	 }
	 
	 public function voto_negativo()
	 {
	 	$this->form_validation->set_rules('id','id','is_numeric');
	 	if ($this->form_validation->run()==FALSE)
	 	{
	 		printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
	 	}else{
	 		
	 		$id=$this->input->post('id');
	 		$borrado=0;
	 		
	 		if (isset($_SESSION['comentario'.$id]))
	 		{
	 			if ($_SESSION['comentario'.$id]==-1)
	 			{
	 				exit;
	 			}else{
	 				$borrado=-1;
	 			}
	 		}
	 
	 		if ($this->Comentarios_model->update_votos($id,$borrado,+1)){
	 			
	 			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('voto_incluido'));
	 			$_SESSION['comentario'.$id]=-1;
	 			printf(MODIFICAR_VOTO_JS, 'comentario_voto_negativo'.$id, 'mas');
	 			
	 			if ($borrado==-1)
	 				printf(MODIFICAR_VOTO_JS, 'comentario_voto_positivo'.$id, 'menos');
	 		}else{
	 			printf(MSG_ERROR, $this->lang->line('error_db'));
	 		}
	 		//echo $this->db->last_query();
	 	}
	 }
	 
	public function insertar()
	{
		
		$this->form_validation->set_rules('id_noticia','id_noticia','required|is_numeric');
		$this->form_validation->set_rules('id_respuesta','id_respuesta','required|is_numeric');
		$this->form_validation->set_rules('comentario',$this->lang->line('comentario'),'required|xss_clean|strip_tags');
		
		if (!isset($_SESSION['usuario']))
			$this->form_validation->set_rules('captcha','captcha','required');
		
		
		if ($this->form_validation->run()==FALSE)
		{
			 printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
		}else{
			
			if (!isset($_SESSION['usuario']))
			{
				$captcha= $this->input->post('captcha');
				if (trim(strtoupper($captcha)) != $_SESSION['captcha'])
				{
					$this->load->helper('my_create_captcha');
					$cap=my_create_captcha();
					printf(RELOAD_CAPTCHAS_JS,PATH_IMG.'captcha/'. $cap['time'].'.jpg');
					
					printf(MSG_ERROR_CAMPO, 'captcha'.$this->input->post('id_unico'), $this->lang->line('captcha_invalido'));
					exit ;
				}
			}
			
			$insert['id_noticia']= $this->input->post('id_noticia');
			$insert['comentario']= $this->input->post('comentario');
			$insert['id_respuesta']= $this->input->post('id_respuesta');
			
			$noticia=$this->Noticias_model->getById($insert['id_noticia']);
			
			
			if (!$noticia || ($noticia->visible==0 && !isset($_SESSION['usuario']) && $noticia->id_usuario != $_SESSION['usuario']->id_usuario) )
			{
				printf(MSG_ERROR, $this->lang->line('trampeando'));
				exit;
			}
			
			
			if (isset($_SESSION['usuario']))
				$insert['id_usuario']= $_SESSION['usuario']->id_usuario;
			else
				$insert['id_usuario']= 0; // Anónimo
			
			$usuarioAdmin=$this->Usuario_model->getById($noticia->id_usuario,false,true);
			
			if ($id_comment=$this->Comentarios_model->insert($insert))
			{
				// Envio de correo si el comentarios es de una respuesta
				if ($insert['id_respuesta']!= 0)
				{
					$comentario=$this->Comentarios_model->getById($insert['id_respuesta']);
					
					if ($comentario->id_usuario!= ID_ANONIMO)
						$usuarioRespuesta=$this->Usuario_model->getById($comentario->id_usuario,false,true);

					if (isset($usuarioRespuesta) && $usuarioRespuesta->aviso_respuesta==1)
					{
						$texto_correo=sprintf($this->lang->line('aviso_correo_respuesta_comentario')
								,$noticia->titulo
								, (isset($_SESSION['usuario']) ? $_SESSION['usuario']->nombre.' '.$_SESSION['usuario']->apellidos : $this->lang->line('anonimo'))
								, $insert['comentario']
								,"<a href='http://".$usuarioAdmin->nombre_unico.'.'.URL_BASE.'/portal#!news/'.url_title($noticia->titulo).'/'.$noticia->id_noticia.'/\'>'.$noticia->titulo.'</a>'
						);
						sendEmail($usuarioRespuesta->correo,$this->lang->line('aviso_subject_correo_respuesta_comentario'), $texto_correo);
					}
						
				}
				
				// Envio de correo para el administrador de la página
				
				
				if ($usuarioAdmin && $usuarioAdmin->aviso_comentario==1 
						&& !(isset($usuarioRespuesta) && $usuarioRespuesta->aviso_respuesta==1 && $usuarioAdmin->aviso_comentario==1 
								&& $usuarioRespuesta->id_usuario == $usuarioAdmin->id_usuario))
				{

					$texto_correo=sprintf($this->lang->line('aviso_correo_nuevo_comentario')
							,$noticia->titulo
							, (isset($_SESSION['usuario']) ? $_SESSION['usuario']->nombre.' '.$_SESSION['usuario']->apellidos : $this->lang->line('anonimo'))
							, $insert['comentario']
							,"<a href='http://".$usuarioAdmin->nombre_unico.'.'.URL_BASE.'/portal#!news/'.url_title($noticia->titulo).'/'.$noticia->id_noticia.'/\'>'.$noticia->titulo.'</a>'
							);
					sendEmail($usuarioAdmin->correo,$this->lang->line('aviso_subject_correo_nuevo_comentario'), $texto_correo);
				}

				// Fin de los envios de correo
					
				$update['comentarios']=$this->Comentarios_model->countByIdNoticia($noticia->id_noticia);
				$this->Noticias_model->update($noticia->id_usuario,$noticia->id_noticia,$update);
				
				$toexec=sprintf(SCROLL_ELEMENT_JS, 'comentario'.$id_comment);
				$toexec.=sprintf(HIGHLIGHT_ELEMENT_JS, 'comentario'.$id_comment);
				
				printf(RELOAD_PAGINA_JS, $toexec);
				printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('comentario_incluido'));
			}else{
				printf(MSG_ERROR, $this->lang->line('error_db'));				
			}

			
			$this->load->helper('my_create_captcha');
			$cap=my_create_captcha();
			printf(RELOAD_CAPTCHAS_JS,PATH_IMG.'captcha/'. $cap['time'].'.jpg');
				
			
		}
			 
	}
	
	
	public function update()
	{
	
		$this->form_validation->set_rules('id_noticia','id_noticia','required|is_numeric');
		$this->form_validation->set_rules('id_comentario','id_comentario','required|is_numeric');
		$this->form_validation->set_rules('comentario',$this->lang->line('comentario'),'required|xss_clean|strip_tags');
	
		if (!isset($_SESSION['usuario']))
			$this->form_validation->set_rules('captcha','captcha','required');
	
	
		if ($this->form_validation->run()==FALSE)
		{
			printf(MSG_ERROR, preg_replace('~[\r\n]+~', '', validation_errors()));
		}else{
				
			$id_noticia= $this->input->post('id_noticia');
			$id_comentario= $this->input->post('id_comentario');

			$update['comentario']= $this->input->post('comentario');
			
				
			$noticia=$this->Noticias_model->getById($id_noticia);
				
			
			if ($this->Comentarios_model->updateMasUpdate($id_comentario,$_SESSION['usuario']->id_usuario,$update))
			{
	
				$toexec=sprintf(SCROLL_ELEMENT_JS, 'comentario'.$id_comentario);
				$toexec.=sprintf(HIGHLIGHT_ELEMENT_JS, 'comentario'.$id_comentario);
	
				printf(RELOAD_PAGINA_JS, $toexec);
				printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('comentario_modificado'));
			}else{
				printf(MSG_ERROR, $this->lang->line('error_db'));
			}
	
			
		}
	
	}
			
}
	


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */