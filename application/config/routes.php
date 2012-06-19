<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'index';
$route['web/(.+?)'] = 'portal_inicio/index/$1';
$route['(.+)/nueva_noticia(.*)'] = 'admin/noticia/nueva_noticia';
$route['(.+)/modificar_noticia(.*)'] = 'admin/noticia/modificar_noticia';
$route['bienvenido'] = 'portal_devices/bienvenido';
$route['recordar'] = 'registro/recordar';
$route['portada'] = 'index/portada';

$route['buscador'] = 'extras/buscador/index/';

$route['(:any)/rss'] = 'extras/rss/index';
$route['calendario/(:num)/(:num)'] = 'portal/cargar_calendario';
$route['news/fecha/(:num)/(:num)/(:num)'] = 'listado_noticias/por_fecha';
$route['news/mes/(:num)/(:num)'] = 'listado_noticias/por_mes';
$route['news/(:any)/(:num)'] = 'noticia_detalle/index/';

$route['scaffolding_trigger'] = 'secret';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */