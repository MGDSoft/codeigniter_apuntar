<?php
function sendEmail($address,$subject,$text){
	
	$text_top="Tiriri";
	$text_bottom="fin";

  	$this->email->to($address);
    $this->email->from('your@example.com','Apuntes.net');
    $this->email->subject($subject);
    $this->email->message($text_top.$text.$text_bottom);
    
    //$config['protocol'] = 'sendmail';
    //$config['charset'] = 'iso-8859-1'; // Default value utf-8
    //$config['wordwrap'] = TRUE;
    
    $this->email->send();
	
}   
?>