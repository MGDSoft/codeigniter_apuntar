<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imagenes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_file_upload_helper');
		$this->load->model('Usuario_model');
		$this->load->model('Usuario_configuracion_model');
		
	}
	public function index()
	{
		
	}
	
	
	
	
	public function logo()
	{
		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array();
		// max file size in bytes
		$sizeLimit = 1 * 1024 * 1024;
	
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload('.'.PATH_IMG.'usuario/logo/','prueba'.$_SESSION['usuario']->id_usuario);
		
		if (isset($result['success']))
		{
			$config['source_image'] = '.'. $result['directory'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 200;
			$config['height'] = 170;
			$this->load->library('image_lib', $config);
			
			if ( ! $this->image_lib->resize()){
					
			}
		}
		
		
		// to pass data through iframe you will need to encode all html tags
		
		
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	}
	
	public function avatar()
	{
		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array();
		// max file size in bytes
		$sizeLimit = 1 * 1024 * 1024;
	
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload('.'.PATH_IMG.'usuario/avatar/',$_SESSION['usuario']->id_usuario);
	
		if (isset($result['success']))
		{
			$config['source_image'] = '.'. $result['directory'];
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 60;
			$config['height'] = 60;
			$this->load->library('image_lib', $config);
				
			if ( ! $this->image_lib->resize()){
					
			}
			$update['avatar']= str_replace(PATH_IMG.'usuario/avatar/', '', $result['directory']); 
			$this->Usuario_model->update($_SESSION['usuario']->id_usuario,$update);
			$_SESSION['usuario']->avatar=$update['avatar'];
		}
	
		
		// to pass data through iframe you will need to encode all html tags
	
	
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	}
	
	public function sobreti()
	{
		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array();
		// max file size in bytes
		$sizeLimit = 1 * 1024 * 1024;
	
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload('.'.PATH_IMG.'usuario/personal/','prueba'.$_SESSION['usuario']->id_usuario);
		
		if (isset($result['success']))
		{
			$config['source_image'] = '.'. $result['directory'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;
			$this->load->library('image_lib', $config);
			
			if ( ! $this->image_lib->resize()){
					
			}
		}
		
		
		// to pass data through iframe you will need to encode all html tags
		
		
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	}
	
	public function fondo()
	{
		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array();
		// max file size in bytes
		$sizeLimit = 1 * 1024 * 1024;
		
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload('.'.PATH_IMG.'usuario/fondo/','prueba'.$_SESSION['usuario']->id_usuario);
		// to pass data through iframe you will need to encode all html tags
		
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	}
	
	
}