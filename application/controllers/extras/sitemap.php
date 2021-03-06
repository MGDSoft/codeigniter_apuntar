<?php
class Sitemap extends CI_Controller{

	private $archivo="./descargas/sitemap.xml";
	private $sitemap_txt="";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_configuracion_model');
		$this->load->model('Noticias_model');
	}
	
	public function index()
	{
		$ahora=date('c', time());
		$this->cabecera($ahora);
		$this->urls_paginas('0.95',$ahora);
		$this->urls_noticias('0.59',$ahora);
		$this->cierre();
		$this->grabar_archivo();
		
	}
	
	private function grabar_archivo(){
		
		if (file_exists($this->archivo))
			unlink($this->archivo) ;
		
		$fp = fopen($this->archivo, "a+");
		$write = fputs($fp, $this->sitemap_txt);
		fclose($fp);
		
	}
	
	
	private function cierre(){
		
		$this->sitemap_txt .= '
</urlset> ';
		
	}
	private function cabecera($ahora){
		
		$this->sitemap_txt .= '<?xml version="1.0" encoding="UTF-8"?> 
<!-- Sitemap File Generated by http://apuntar.net/ at '.$ahora.' --> 
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
		
	}
	
	
	public function urls_paginas($prioridad,$ahora)
	{
		
		$paginas=$this->Usuario_configuracion_model->getData();
		foreach ($paginas as $pag)
		{
			$this->sitemap_txt .= '
	<url> 
      <loc>http://'.$pag->nombre_unico.'.'.URL_BASE.'/</loc> 
      <lastmod>'.$ahora.'</lastmod> 
      <priority>'.$prioridad.'</priority> 
      <changefreq>daily</changefreq> 
   </url>';
		}
	}
	public function urls_noticias($prioridad,$ahora)
	{
		$paginas=$this->Noticias_model->getData(true);
		foreach ($paginas as $pag)
		{
			$this->sitemap_txt .= '
	<url>
		<loc>http://'.$pag->nombre_unico.'.'.URL_BASE.'/portal#!news/'.$pag->titulo.'/'.$pag->id_noticia.'/</loc>
		<lastmod>'.$ahora.'</lastmod>
		<priority>'.$prioridad.'</priority>
		<changefreq>daily</changefreq>
	</url>';
		}
	}
	
	
}
?>