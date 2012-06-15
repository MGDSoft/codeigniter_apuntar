<?php
/* Auto Formato de correo */
function sendEmail($address,$subject,$text){
	$CI =& get_instance();
	$CI->load->library('email');
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
	
	
	$CI->email->initialize(array('mailtype' => 'html'));
	
  	$CI->email->to($address);
    $CI->email->from('info@'.URL_BASE,URL_BASE);
    $CI->email->subject($subject);
    $CI->email->message($text_top.$text.$text_bottom);
   
    //$config['protocol'] = 'sendmail';
    //$config['charset'] = 'iso-8859-1'; // Default value utf-8
    //$config['wordwrap'] = TRUE;
    
    // Mostramos texto para localhost
    
    
    if (ENVIRONMENT=='development')
    	echo $text_top.$text.$text_bottom;
    else
    	$CI->email->send();
	
}   
?>