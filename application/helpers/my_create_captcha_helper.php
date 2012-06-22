<?php
function my_create_captcha(){
	
			$CI =& get_instance();
			$CI->load->helper('captcha');
  			$CI->load->helper('string');
  			
  			$captchaValue=strtoupper(random_string('numeric', 4));
  			$_SESSION['captcha']=$captchaValue;
  			
  			 $vals = array(
		    'word'	 => $captchaValue,
		    'img_path'	 => '.'.PATH_IMG.'captcha/',
		    'img_url'	 => PATH_IMG.'captcha/',
		    'font_path'	 => '.'.PATH_IMG.'default_text.ttf',
		    'img_width'	 => '110',
		    'img_height' => 32,
		    'expiration' => 7200
		    );
  			 
  			return create_captcha($vals);
	
}   
