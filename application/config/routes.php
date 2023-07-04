<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'beranda/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';

$route['beranda'] = 'beranda/index';
$route['beranda/info/show/(:any)'] = 'beranda/info_show/$1';
$route['beranda/info/confirm/(:any)'] = 'beranda/info_confirm/$1';

$route['alur/pemesanan'] = 'alur/pemesan';
$route['alur/pemesanan/pemesan'] = 'alur/pemesan';
$route['alur/pemesanan/store_pemesan'] = 'alur/store_pemesan';
$route['alur/pemesanan/pemesanan'] = 'alur/pemesanan';
$route['alur/pemesanan/store_pemesanan'] = 'alur/store_pemesanan';
$route['alur/pemesanan/pemesanan_kursi'] = 'alur/pemesanan_kursi';
$route['alur/pemesanan/store_pemesanan_kursi'] = 'alur/store_pemesanan_kursi';
$route['alur/pemesanan/pembayaran'] = 'alur/pembayaran';
$route['alur/pemesanan/store_pembayaran'] = 'alur/store_pembayaran';

$route['bis'] = 'bis/index';
$route['bis/create'] = 'bis/create';
$route['bis/store'] = 'bis/store';
$route['bis/edit/(:any)'] = 'bis/edit/$1';
$route['bis/update/(:any)'] = 'bis/update/$1';
$route['bis/destroy/(:any)'] = 'bis/destroy/$1';

$route['bisjenis'] = 'bisjenis/index';
$route['bisjenis/create'] = 'bisjenis/create';
$route['bisjenis/store'] = 'bisjenis/store';
$route['bisjenis/edit/(:any)'] = 'bisjenis/edit/$1';
$route['bisjenis/update/(:any)'] = 'bisjenis/update/$1';
$route['bisjenis/destroy/(:any)'] = 'bisjenis/destroy/$1';

$route['jadwal'] = 'jadwal/index';
$route['jadwal/create'] = 'jadwal/create';
$route['jadwal/store'] = 'jadwal/store';
$route['jadwal/edit/(:any)'] = 'jadwal/edit/$1';
$route['jadwal/update/(:any)'] = 'jadwal/update/$1';
$route['jadwal/destroy/(:any)'] = 'jadwal/destroy/$1';

$route['kursi'] = 'kursi/index';
$route['kursi/create'] = 'kursi/create';
$route['kursi/store'] = 'kursi/store';
$route['kursi/edit/(:any)'] = 'kursi/edit/$1';
$route['kursi/update/(:any)'] = 'kursi/update/$1';
$route['kursi/destroy/(:any)'] = 'kursi/destroy/$1';

$route['pemesan'] = 'pemesan/index';
$route['pemesan/create'] = 'pemesan/create';
$route['pemesan/store'] = 'pemesan/store';
$route['pemesan/edit/(:any)'] = 'pemesan/edit/$1';
$route['pemesan/update/(:any)'] = 'pemesan/update/$1';
$route['pemesan/destroy/(:any)'] = 'pemesan/destroy/$1';

$route['rute'] = 'rute/index';
$route['rute/create'] = 'rute/create';
$route['rute/store'] = 'rute/store';
$route['rute/edit/(:any)'] = 'rute/edit/$1';
$route['rute/update/(:any)'] = 'rute/update/$1';
$route['rute/destroy/(:any)'] = 'rute/destroy/$1';

$route['pemesanan'] = 'pemesanan/index';
$route['pemesanan/create'] = 'pemesanan/create';
$route['pemesanan/store'] = 'pemesanan/store';
$route['pemesanan/show/(:any)'] = 'pemesanan/show/$1';
$route['pemesanan/edit/(:any)'] = 'pemesanan/edit/$1';
$route['pemesanan/update/(:any)'] = 'pemesanan/update/$1';
$route['pemesanan/destroy/(:any)'] = 'pemesanan/destroy/$1';

$route['pemesanan/kursi/create/(:any)'] = 'pemesanan/create_kursi/$1';
$route['pemesanan/kursi/store'] = 'pemesanan/store_kursi';
$route['pemesanan/kursi/edit/(:any)'] = 'pemesanan/edit_kursi/$1';
$route['pemesanan/kursi/update/(:any)'] = 'pemesanan/update_kursi/$1';
$route['pemesanan/kursi/destroy/(:any)'] = 'pemesanan/destroy_kursi/$1';

$route['pemesanan/pembayaran/create/(:any)'] = 'pemesanan/create_pembayaran/$1';
$route['pemesanan/pembayaran/store'] = 'pemesanan/store_pembayaran';

$route['admin'] = 'admin/index';
$route['admin/create'] = 'admin/create';
$route['admin/store'] = 'admin/store';
$route['admin/edit/(:any)'] = 'admin/edit/$1';
$route['admin/update/(:any)'] = 'admin/update/$1';
$route['admin/destroy/(:any)'] = 'admin/destroy/$1';
