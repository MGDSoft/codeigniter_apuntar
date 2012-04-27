<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* my constantes web */

define ('HTACCESS_WEB_USUARIO_TERMINACION','.html');

define ('PATH_JS','/js/');
define ('PATH_CSS','/css/');
define ('PATH_IMG','/img/');

define ('MSG_ERROR','alert("%s");');
define ('MSG_ERROR_CAMPO','new VentanaError("%s","%s");');

define ('RESPONSE_OK_JS','OK');

define ('MSG_INFO_URGENT','new Message({isUrgent: true,icon:"okMedium.png",title: "%s",message: "%s"}).say();');
define ('MSG_INFO','new Message({icon:"okMedium.png",title: "%s",message: "%s"}).say();');
define ('MSG_WATCHOUT','var msg = new Message({icon: "cautionMedium.png",title: "%s",message: "%s"}).say();msg.tell();');
define ('MSG_QUESTION','new Message({icon: "mediumQuestion.png", title: "%s", message: "%s", callback: "%s"}).ask();');
define ('REDIRECT_URL_JS','redirect("/%s");');

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