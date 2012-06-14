<?php
 class Activar_cuenta extends CI_Controller{
 	
  	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
	}
  function index()
  {
	
	$id=$this->input->get('id');
	$codigo=$this->input->get('codigo');
	$usuario=$this->Usuario_model->getById($id,false);
	
	if (!$usuario)
		$this->mostrarTexto($this->lang->line('usuario_no_existe'));
	
	
	if ($usuario->activo==1)
		$this->mostrarTexto($this->lang->line('usuario_ya_activo'));
	
	if ($usuario->activar_cuenta==$codigo)
	{
		$usuario->activo=1;
		if ($this->Usuario_model->update($id,$usuario))
		{
			$_SESSION['usuario']=$this->Usuario_model->login($usuario->correo,false,false);
			redirect('/');
		}else
			$this->mostrarTexto($this->lang->line('error_db'));
		
	}else
		$this->mostrarTexto($this->lang->line('codigo_erroneo'));
	
	

  }
  
  private function mostrarTexto($texto){
  	$text_top='<div style="width:100%;text-align:center">
  	<div style="width:600px;background:#1F62BF;border:0px solid #000000;color:#ffffff;text-align:left;padding-bottom:20px;font-family: \'lucida grande\', tahoma, verdana, arial, sans-serif;-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;">
  	<div style="padding:20px 30px 20px 30px">
  	<img src="http://'.URL_BASE.'/img/portada/logo_apuntes_.png" align="right" width="100" height="85">
  	<a href="http://'.URL_BASE.'" style="font-size:20px;color:#ffffff;font-weight:bold;">'.URL_BASE.'</a><br><span style="font-size:14px;font-weight:bold">Apunta r&#225;pido todo lo que necesites recordar!</span>
  	</div>
  	<div style="padding:35px 8px 25px 18px;margin:20px 20x 20px 20px;text-align:left;border:1px solid #cccccc;background:#ffffff;color:#000000;font-size:13px">
  	Hola,<br><br>';
  	
  	
  	
  	$text_bottom='<br><br>
  	Gracias desde el equipo de '.URL_BASE.'
  	</div>
  	</div>
  	</div>';
  	echo $text_top.'<span style="font-size:1.4em">'.$texto.'</span>'.$text_bottom;
  	die;
  }
 }
?>