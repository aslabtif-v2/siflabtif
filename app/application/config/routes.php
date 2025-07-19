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

$route['default_controller'] = "login";
$route['404_override'] = '';

$route['mhs/signin'] = 'signin/index';
$route['mhs/dashboard'] = 'signin/dashboard';
$route['mhs/signout'] = 'signin/signout';
$route['mhs/kuisioner'] = 'kuisioner/index';

$route['admin/kuisioner_mahasiswa'] = 'adminkuisioner/mahasiswa';
$route['admin/kuisioner_asisten'] = 'adminkuisioner/asisten';
$route['admin/kuisioner_mahasiswa/(:any)'] = 'adminkuisioner/detailPenilaianMahasiswa/$1';
$route['admin/kuisioner_asisten/(:any)'] = 'adminkuisioner/detailPenilaianAsisten/$1';

$route['asisten/penilaian_asisten'] = 'asistenkuisioner/penilaianAsisten';
$route['asisten/penilaian_asisten/(:any)'] = 'asistenkuisioner/formPenilaianAsisten/$1';
$route['asisten/penilaian_diri'] = 'asistenkuisioner/penilaianDiri';


/* End of file routes.php */
/* Location: ./application/config/routes.php */