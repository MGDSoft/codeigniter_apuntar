<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'] =  array(
								array(
	                                'class'    => 'Lenguaje',
	                                'function' => 'idiomas_carga',
	                                'filename' => 'Lenguaje.php',
	                                'filepath' => 'hooks'
                                )
								,array(
									'class'    => 'Login',
									'function' => 'auto_login',
									'filename' => 'Login.php',
									'filepath' => 'hooks'
                                )
								,array(
										'class'    => 'Huso_horario',
										'function' => 'auto_load_huso_horario',
										'filename' => 'Huso_horario.php',
										'filepath' => 'hooks'
								)
                                );



/* End of file hooks.php */
/* Location: ./application/config/hooks.php */