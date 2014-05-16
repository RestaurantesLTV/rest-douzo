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
$route['404_override'] = '';
$route['default_controller'] = "home";
$route['blog'] = 'home/entradas';
$route['blog/(:any)'] = 'home/detalle_articulo/$1';
$route['back_end'] = 'home_be';
$route['back_end/entradas'] = 'home_be/entradas';
$route['back_end/entradas/anadir'] = 'form';
$route['back_end/entradas/(:any)'] = 'home_be/modificarEntrada/$1';
$route['back_end/categorias'] = 'home_be/categorias';
$route['back_end/reservas'] = 'home_be/reservas';
$route['back_end/menu'] = 'home_be/menu';
$route['back_end/web'] = 'home_be/web';
$route['back_end/salir'] = 'home/salir';
$route['carta'] = 'carta';









/* End of file routes.php */
/* Location: ./application/config/routes.php */