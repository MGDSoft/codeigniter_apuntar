<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Lenguaje
{
	function idiomas_carga()
	{
		$CI =& get_instance();
		
		$lang = $CI->session->userdata('idioma');
		if(empty($lang))
		{
			$lang = "spanish";
			$CI->session->set_userdata(array('idioma'=>'spanish'));
		}

		$CI->lang->load('textos', $lang);
	}
}