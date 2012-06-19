<?php
class Varios extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		
	}
	public function get_url()
	{
		$url=$this->input->post('url');
		if ($url)
		{
			echo url_title($url);
		}
	}
	
	
}
?>