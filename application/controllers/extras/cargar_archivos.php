<?php
class Cargar_archivos extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
	
			
	}
	private function cache(){
		
	}
	
	public function css_devices()
	{
		$this->header_css();
		$this->cache();
		
		include '.'.PATH_JS .'validacion/css/main.css';
		include '.'.PATH_CSS.'general.css';
		include '.'.PATH_JS .'Message-Class/css/message.css';
		
		include '.'.PATH_CSS.'formularios_devices.css';
		include '.'.PATH_CSS.'devices_general.css';
		include '.'.PATH_CSS.'highlight/styles/googlecode.css';
		include '.'.PATH_CSS.'arbol.css';
	}
	
	public function js_devices()
	{
		
		$this->header_js();
		$this->cache();
		
		include '.'.PATH_JS .'mootools-core-1.4.2.js';
		include '.'.PATH_JS .'mootools-more.js';
		
		include '.'.PATH_JS .'scriptbase.js';
		include '.'.PATH_JS .'validacion/js/objetos.js';
		include '.'.PATH_JS .'validacion/js/validacion.js';
		include '.'.PATH_JS .'validacion/js/idiomas/spanish.js';
	
		include '.'.PATH_JS .'scripts_varios.js';
		
		include '.'.PATH_JS .'arbol.js';
		
		include '.'.PATH_JS .'buscador.js';
		
		include '.'.PATH_JS .'arieh-historymanager/Source/HashListener.js';
		
		include '.'.PATH_JS .'Message-Class/js/message_src.js';
		
		include '.'.PATH_JS .'MooStarRating/Source/moostarrating.js';
		
		
		include '.'.PATH_JS .'highlight/highlight.pack.js';
		include '.'.PATH_JS .'highlight/numberLines.js';
		
		include '.'.PATH_JS .'arieh-historymanager/Source/HashListener.js';
		
		include '.'.PATH_JS .'ckeditor/ckeditor.js';
		
		include '.'.PATH_JS .'arbol.js';
	}
	
	public function css_comun()
	{
		$this->header_css();
		
		include '.'.PATH_JS.'validacion/css/main.css';
		include '.'.PATH_CSS.'arbol.css';
		include '.'.PATH_JS.'Message-Class/css/message.css';
		include '.'.PATH_CSS.'pc.css';
		include '.'.PATH_CSS.'formularios.css';
		include '.'.PATH_CSS.'general.css';
		include '.'.PATH_JS.'highlight/styles/googlecode.css';
		include '.'.PATH_JS.'mooRainbow/Assets/mooRainbow.css';
		include '.'.PATH_JS.'valums-file-uploader/client/fileuploader.css';
		
	}
	
	public function js_comun()
	{
		
		$this->header_js();
		
		include '.'.PATH_JS.'mootools-core-1.4.2.js';
		include '.'.PATH_JS.'mootools-more.js';

		include '.'.PATH_JS.'scriptbase.js';
		include '.'.PATH_JS.'validacion/js/objetos.js';
		include '.'.PATH_JS.'validacion/js/validacion.js';
		include '.'.PATH_JS.'validacion/js/idiomas/spanish.js';
		
		
		include '.'.PATH_JS.'scripts_varios.js';
		
		include '.'.PATH_JS.'arbol.js';
		
		include '.'.PATH_JS.'buscador.js';
		
		include '.'.PATH_JS.'Message-Class/js/message_src.js';
		
		include '.'.PATH_JS.'highlight/highlight.pack.js';
		include '.'.PATH_JS.'highlight/numberLines.js';
		
		include '.'.PATH_JS.'arieh-historymanager/Source/HashListener.js';
		
		include '.'.PATH_JS.'ckeditor/ckeditor.js';
		
		include '.'.PATH_JS.'mooRainbow/Source/mooRainbow.js';
		
		include '.'.PATH_JS.'valums-file-uploader/client/fileuploader.js';
		
		include '.'.PATH_JS.'MooStarRating/Source/moostarrating.js';
		
		include '.'.PATH_JS.'ScrollSpy/Source/ScrollSpy-yui-compressed.js';
			
	}
	
	private function header_js(){
		Header("content-type: application/x-javascript; charset: UTF-8");
	}
	
	private function header_css(){
		Header("content-type: text/css; charset: UTF-8");
	}
	
	
	
	
}
?>