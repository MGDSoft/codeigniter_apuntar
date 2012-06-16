<?php 

class Registro_forms extends CI_Controller {
	
	 public function __construct()
	 {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Usuario_model');
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Web_configuracion_diseno_model');
		$this->load->model('Web_configuracion_separadores_model');
		$this->load->model('Web_sobre_mi_model');
		$this->load->model('Categorias_model');
		$this->load->model('Noticias_model');
		$this->load->helper('string');
		$this->load->helper('cookie');
		
	 }
	 public function update()
	 {
	 	$this->form_validation->set_rules('correo','correo','required|valid_email|trim');
	 	$this->form_validation->set_rules('nombre','nombre','required|trim');
	 	$this->form_validation->set_rules('apellidos','apellidos','required|trim');
	 	$this->form_validation->set_rules('uso_horario','uso_horario','required|trim');
	 	
	 	
	 	if ($this->form_validation->run()==FALSE)
	 	{
	 		printf(MSG_ERROR, trim(validation_errors()));
	 	}else{
	 			
	 		$this->load->helper('string');
	 			
	 		
	 			
	 		$update['nombre']= $this->input->post('nombre');
	 		$update['apellidos']= $this->input->post('apellidos');
	 		$update['correo']= $this->input->post('correo');
	 		$update['id_zone_time']= $this->input->post('uso_horario');
	 			
	 			
	 		if ($this->Usuario_model->update($_SESSION['usuario']->id_usuario,$update))
			{
				$upd['id_zone_time']=$update['id_zone_time'];
				$this->Usuario_configuracion_model->update($_SESSION['usuario']->id_usuario,$upd);
				$user=$this->Usuario_model->login($update['correo'],null,false);
				$_SESSION['usuario']=$user;
				$_SESSION['timezone']=$user->tz;
				
				
				
				printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('modificacion_incluida'));
				echo "$$('.nombre_user')[0].innerHTML='<b>".$update['nombre'].' '.$update['apellidos']."</b>'";
			}else{
				printf(MSG_ERROR, $this->lang->line('error_db'));
			}
	 	}
	 	
	 }
	 
	 public function password()
	 {
	 	$this->form_validation->set_rules('anteriorcontrasena','anteriorcontrasena','required|trim');
	 	$this->form_validation->set_rules('contrasena','contrasena','required|trim');
	 	$this->form_validation->set_rules('recontrasena','recontrasena','required|trim|matches[contrasena]');
	 	 
	 	 
	 	if ($this->form_validation->run()==FALSE)
	 	{
	 		printf(MSG_ERROR, trim(validation_errors()));
	 	}else{
	 	 	
	 		$usuario=$this->Usuario_model->getById($_SESSION['usuario']->id_usuario);
	 		if (!$this->Usuario_model->login($usuario->correo,md5($this->input->post('anteriorcontrasena'))))
	 		{
	 			printf(MSG_WATCHOUT, $this->lang->line('error_form_estandar'),$this->lang->line('contrasena_invalida'));
	 			exit;
	 		}
	 		
	 		$update['password']=md5($this->input->post('contrasena'));
	 			
	 		if ($this->Usuario_model->update($_SESSION['usuario']->id_usuario,$update))
	 		{
	 			printf(MSG_INFO, $this->lang->line('correcto'), $this->lang->line('modificacion_incluida'));
	 		}else{
	 			printf(MSG_ERROR, $this->lang->line('error_db'));
	 		}
	 	}
	 	 
	 }
	 
	 public function recordar()
	 {

	 	$this->form_validation->set_rules('correo','correo','required|valid_email|trim');
	 
	 	if ($this->form_validation->run()==FALSE)
	 	{
	 		printf(MSG_ERROR, trim(validation_errors()));
	 	}else{
	 		
	 		// Protección anti abussers
	 		
	 		if (!isset($_SESSION['conteo']))
	 			$_SESSION['conteo']=1;
	 		else
	 			++$_SESSION['conteo'];
	 		
	 		
	 		$cookie=$this->input->cookie('exceso_recuperar', TRUE);
	 		
	 		if ($_SESSION['conteo']>3)
	 		{
	 			printf(MSG_WATCHOUT, $this->lang->line('trampeando'), $this->lang->line('numero_de_peticiones_excesiva'));
	 			$cookie = array(
	 					'name'   => 'exceso_recuperar',
	 					'expire' => '10000'
	 			);
	 			
	 			set_cookie($cookie);
	 			exit;
	 		}
	 		
	 		// Fin protección anti abussers
	 		
	 		$correo=$this->input->post('correo');
	 		
	 		if ($this->Usuario_model->existe_correo($correo))
			{
				$update['password']=md5(strtoupper(random_string('alpha', 6)));
				if ($this->Usuario_model->updateByCorreo($correo,$update))
				{
					// Mandar correo que falta
					printf(MSG_INFO_URGENT, $this->lang->line('correcto'), $this->lang->line('password_cambiada'));
					
				}else
					
					printf(MSG_ERROR, $this->lang->line('error_db'));
				
			}else{
				
				
				printf(MSG_WATCHOUT, $this->lang->line('error'), $this->lang->line('correo_no_existe'));
			}
	 		
	 	}
	 
	 }
	 
	public function index()
	{
		
		$this->form_validation->set_rules('correo','correo','required|valid_email|trim');
		$this->form_validation->set_rules('contrasena','contrasena','required|trim|md5');
		$this->form_validation->set_rules('recontrasena','recontrasena','required|matches[contrasena]|trim');
		$this->form_validation->set_rules('nombre','nombre','required|trim');
		$this->form_validation->set_rules('apellidos','apellidos','required|trim');
		$this->form_validation->set_rules('titulo','titulo','required|trim');
		$this->form_validation->set_rules('uso_horario','uso_horario','required|trim');
		
		
		if ($this->form_validation->run()==FALSE)
		{
			 printf(MSG_ERROR, trim(validation_errors()));
		}else{
			
			$this->load->helper('string');
			
			
			
			$insertUsuario['nombre']= $this->input->post('nombre');
			$insertUsuario['apellidos']= $this->input->post('apellidos');
			$insertUsuario['correo']= $this->input->post('correo');
			$insertUsuario['id_zone_time']= $this->input->post('uso_horario');
			$insertUsuario['password']= $this->input->post('contrasena');
			$insertUsuario['activar_cuenta']= random_string('alnum', 16);
			
			
			$insertConfiguracion['id_zone_time']= $insertUsuario['id_zone_time'];
			$insertConfiguracion['titulo']= $this->input->post('titulo');
			$insertConfiguracion['nombre_unico']= url_title($this->input->post('titulo'));
			
			
			/*Validaciones de BD*/
			
			if ($this->Usuario_model->existe_correo($insertUsuario['correo']))
			{
				printf(MSG_ERROR_CAMPO, 'correo',$this->lang->line('correo_error_repetido'));
				exit;
				
			}else if ($this->Usuario_configuracion_model->existe_nombre_unico($insertConfiguracion['nombre_unico'])){
				
				printf(MSG_ERROR_CAMPO, 'titulo_registro',$this->lang->line('titulo_error_repetido'));
				exit;
				
			}else{
				
				$this->db->trans_begin();
				
				$id_user=$this->Usuario_model->insert($insertUsuario);
				$insertConfiguracion['id_usuario']= ($id_user) ? $id_user : null;
				$insertConfiguracion['eslogan']=$this->lang->line('descripcion_default');
				
				$id_configuracion=$this->Usuario_configuracion_model->insert($insertConfiguracion);
				
				$insertBasico['id_configuracion']=$id_configuracion;
				
				$this->Web_configuracion_diseno_model->insert($insertBasico);
				
				

				// Separador por defecto
				$insertSeparador['id_configuracion']=$id_configuracion;
				$insertSeparador['id_separador']=1;
				$insertSeparador['fondo']='#e8e8e8';
				$insertSeparador['grosor']='1px';
				$insertSeparador['estilo']='solid';
				$insertSeparador['color_borde']='#969696';
				$insertSeparador['altura']='60px';
				$insertSeparador['posicion']='90px';
				
				$this->Web_configuracion_separadores_model->insert($insertSeparador);
				
				
				$insertCategoria['nombre']='Trabajo';
				$insertCategoria['id_usuario']=$id_user;
				$insertCategoria['id_padre']=0;
				
				$id_trabajo=$this->Categorias_model->insert($insertCategoria);
				
				$insertCategoria['nombre']='Ocio';
				$this->Categorias_model->insert($insertCategoria);
				
				$insertCategoria['nombre']='Links interesantes';
				$id_links=$id_links=$this->Categorias_model->insert($insertCategoria);
				
				$insertCategoria['nombre']='Personal';
				$this->Categorias_model->insert($insertCategoria);
				
				
				$insertCategoria['nombre']='Otros';
				$id_otros=$this->Categorias_model->insert($insertCategoria);
				
				$insertCategoria['id_padre']=$id_links;
				$insertCategoria['nombre']='Ocio';
				$this->Categorias_model->insert($insertCategoria);
				
				$insertCategoria['nombre']='Trabajo';
				$this->Categorias_model->insert($insertCategoria);
				
				$insertCategoria['id_padre']=$id_trabajo;
				$insertCategoria['nombre']='Pendiente';
				$this->Categorias_model->insert($insertCategoria);
				
				$insertCategoria['nombre']='Finalizado';
				$this->Categorias_model->insert($insertCategoria);
				
				
				$noticiaInsert['id_usuario']=$id_user;
				$noticiaInsert['id_categoria']=$id_otros;
				
				
				
				$noticiaInsert['titulo']='Esta es una noticia de prueba';
				$noticiaInsert['noticia']='Hola y bienvenido a '.URL_BASE.'.<br><br> Te mostramos una noticia de prueba para que la pruebes en cualquier dispositivo (móvil, tablet o escritorio).<br>Para los desarrolladores tienen una opción de copiar codigo de programación de forma que se vea mas claramente, como se puede ver mas abajo.'.
						'<br><br><pre class="brush:cpp;">#include&lt;stdio.h&gt;
 
int main()
{
    int radio;
    float area, perimetro;
 
    // SALIDA: mensaje un pantalla
    printf(&quot;Introduce el radio del circulo: &quot;);
 
    //ENTRADA: recibir dato desde teclado
    scanf(&quot;%d&quot;, &amp;radio);
 
    // calculos
    area = 3.1416 * radio * radio;
    perimetro = 3.1416 * radio * 2;
 
    //SALIDA: resultado en pantalla
    printf(&quot;El area es %.2f y el perimetro %.2f&quot;, area, perimetro);
    getch();
 
    return 0;
}</pre><br>'.'Gracias por utilizar '.URL_BASE.' y recuerda que con la aplicación de escritorio podras agregar las noticias de una forma muy comoda y rápida para que no se te olvide nada.<br><br>Un saludo desde el equipo de '.URL_BASE.' !';
				
				$this->Noticias_model->insert($noticiaInsert);
				$insertSobremi=$insertBasico;
				$insertSobremi['sobre_mi']='Rellena información sobre ti en las configuraciones de la página.<br> Es importante darte a conocer en este mundo y sobre todo si tienes tu propia página, que menos conocer quién escribe !!';
				
				$this->Web_sobre_mi_model->insert($insertSobremi);
				
				
				//echo $this->db->last_query();
				//echo $this->db->trans_status();
				
				if ($this->db->trans_status() === FALSE)
				{
					
					$this->db->trans_rollback();
					printf(MSG_ERROR, $this->lang->line('error_db'));
					
				}else{
					
					$this->db->trans_commit();
					
					// correo se envia despues ya que sino afecta a la transaccion y se queda la pagina colgada . No me digas xq... 
					$urlActivarCuenta='http://'.URL_BASE.'/activar_cuenta?id='.$id_user.'&codigo='.$insertUsuario['activar_cuenta'];
					$texto_correo=sprintf($this->lang->line('activar_tu_cuenta_correo_texto'),$urlActivarCuenta,$urlActivarCuenta,$insertUsuario['correo'],$this->input->post('recontrasena'));
					sendEmail($insertUsuario['correo'],$this->lang->line('activar_tu_cuenta_correo_subject'), $texto_correo);
						
					
					printf(HIDE_REQUEST, 'forms/categorias_forms/reordenamientoPost','id_usuario='.$id_user);
					printf(MSG_INFO_URGENT,  $this->lang->line('correcto'),$this->lang->line('activar_tu_cuenta'));
					printf(CARGAR_PAGINA_JS,((isset($_SESSION['device'])) ? 'bienvenido' : '' ));
					
				}
				
			}
				
				
					
				
		}
			 
	}
			
}
	


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */