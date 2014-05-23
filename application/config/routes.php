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
$route['chongwen'] = "chongwen";
$route['blog'] = 'home/entradas';
$route['blog/pagina/(:num)'] = 'home/entradas/$1';
$route['blog/(:any)'] = 'home/detalle_articulo/$1';
$route['back_end'] = 'home_be';
$route['back_end/entradas'] = 'home_be/entradas';
$route['back_end/foto'] = 'home_be/subir_imagen';
$route['back_end/entradas/anadir'] = 'form';
$route['back_end/entradas/(:any)'] = 'home_be/modificarEntrada/$1';
$route['back_end/update/(:any)'] = 'form/validar_update/$1';
$route['back_end/delete/(:any)'] = 'home_be/borrar_entrada/$1';
$route['back_end/categorias'] = 'home_be/categorias';
$route['back_end/categorias/recetas'] = 'categorias/listar_recetas';
$route['back_end/categorias/reservas'] = 'categorias/listar_reservas';
$route['back_end/categorias/noticias'] = 'categorias/listar_noticias';
$route['back_end/categorias/offtopic'] = 'categorias/listar_offtopic';
$route['imagenes/tratar_imagen'] = 'imagenes_controller/tratar_imagen';


$route['back_end/web'] = 'home_be/web';
$route['back_end/salir'] = 'home/salir';
$route['equipo'] = 'equipo';
$route['carta'] = 'carta';
$route['contacto'] = 'contacto';

// Reservas
/************************************************************************/

// Reserva FRONT END
$route['reservas'] = "reserva_controller";
$route['reserva/validar'] = "reserva_controller/validar";
$route['testing_reservas'] = 'TestingReservasManager';
$route['verificar'] = 'reserva_controller/verificarReserva';

// Reserva BACK END
$route['back_end/reservas'] = 'home_be/reserva'; /* Modificado por Leo */

// Backend AJAX routes
$route['back_end/turnosdisponibles'] = 'ajax_reserva/getTurnos';
$route['back_end/proximasreservas'] = 'ajax_reserva/ajaxProximasReservas';
$route['back_end/ultimos7dias'] = 'ajax_reserva/ajaxReservasUltimos7Dias';
$route['back_end/todaslasreservas'] = 'ajax_reserva/ajaxTodasLasReservas';
$route['back_end/reservascompletadas'] = 'ajax_reserva/ajaxReservasCompletadas';






/* End of file routes.php */
/* Location: ./application/config/routes.php */