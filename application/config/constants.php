<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* my constantes web */
define ('URL_BASE','apuntes-dev');
define ('AUTO_EJECUTAR_JS','exec_js');

define ('HTACCESS_WEB_USUARIO_TERMINACION','.html');


$array = explode('.',$_SERVER['SERVER_NAME']);

if($array[0]!='www')
	$method=$array[0];
elseif($array[0]=='www')
	$method=$array[1];

if ($method=="devices")
	define ('RUTA_PORTAL','portal_devices');
else if ($method==URL_BASE)
	define ('RUTA_PORTAL','');
else
	define ('RUTA_PORTAL','portal');


define ('URL_WEB_NOT_FOUND','/index.php?info=2');
define ('URL_WEB_PRIVADA','/index.php?info=3');

define ('ID_ANONIMO','0');
define ('PATH_JS','/js/');
define ('PATH_CSS','/css/');
define ('PATH_IMG','/img/');

define ('MSG_ERROR','alert("%s");');
define ('MSG_ERROR_CAMPO','new VentanaError("%s","%s");');

define ('RESPONSE_OK_JS','OK');

define ('URL_SUB_DOMAIN','http://%s.'.URL_BASE);

define ('MSG_INFO_URGENT','new Message({isUrgent: true,icon:"okMedium.png",title: "%s",message: "%s"}).say();');
define ('MSG_INFO','new Message({icon:"okMedium.png",title: "%s",message: "%s"}).say();');
define ('MSG_WATCHOUT','new Message({icon: "cautionMedium.png",title: "%s",message: "%s"}).say();');
define ('MSG_QUESTION','new Message({icon: "speakMedium.png.png", title: "%s", message: "%s", callback: "%s"}).ask();');
define ('MSG_QUESTION_DEFAULT','new Message({isUrgent: true,icon: "speakMedium.png",width: 300,fontSize: 14,autoDismiss: false,title: %s ,message: "<input type=\'text\' id=\'js_commentText\' value=%s>",callback: %s}).say();');
define ('HIDE_REQUEST','new Request({url : "%s", method : "post", data: "%s", onRequest : function() {},	onSuccess : function(responseText) { log(responseText) }}).send();');


define ('MSG_QUESTION_SI_NO_DEFAULT','new Message({icon: "questionMedium.png",title: %s,message: %s,callback: %s}).ask();');

define ('REDIRECT_URL_JS','redirect("/%s");');



define ('CARGAR_JS_AUTO','<div class="'.AUTO_EJECUTAR_JS.'" style="display:none">%s</div>');
define ('CARGAR_PAGINA_JS','cargar_pagina_stadart (\'%s\',\'\',\'\',\'\');');
define ('CARGAR_PAGINA_VARS_JS','cargar_pagina_stadart (\'%s\',\'%s\',\'\',\'\');');
define ('RELOAD_PAGINA_JS','reloadActual ("%s");');
define ('SCROLL_ELEMENT_JS','scrolToElement(\'%s\');');
define ('HIGHLIGHT_ELEMENT_JS','highLight(\'%s\');');
define ('RELOAD_CAPTCHAS_JS','reloadAllCaptchas(\'%s\');');
define ('AGREGAR_COMENTARIO_JS','agregarComentario(\'%s\',\'%s\');');
define ('MODIFICAR_VOTO_JS','modificar_voto(\'%s\',\'%s\');');
define ('MODIFICAR_VOTO_NOTICIA_JS','modificar_voto_noticia(\'%s\');');
define ('NUMERO_POR_PAGINA',10);
define ('COMENTARIOS_POR_PAGINA',20);



/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */