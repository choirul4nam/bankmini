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
$route['default_controller'] = 'C_Login';

$route['login'] = 'c_login';
$route['siswa-login'] = 'c_login/siswa';

$route['dashboard'] = 'dashboardsiswa';
$route['siswa-histori'] = 'siswa/historiTransaksi';

//route siswa
$route['siswa-det/(:any)'] = 'siswa/siswa_detail/$1';
$route['siswa-add'] = 'siswa/siswa_add';
$route['siswa-hps/(:any)'] = 'siswa/siswa_delete/$1';
$route['siswa-edt/(:any)'] = 'siswa/siswa_edit/$1';
$route['siswa-grad'] = 'siswa/siswa_graduate/';
$route['siswa-gradpage'] = 'siswa/graduate_page/';
$route['siswa-export'] = 'siswa/siswa_export/';
$route['siswa-import'] = 'siswa/siswa_import/';
$route['siswa-checkImport'] = 'siswa/upload/';
//akhir route siswa

//route kelas
$route['kelas-add'] = 'kelas/kelas_add';
$route['kelas-hps/(:any)'] = 'kelas/kelas_delete/$1';
$route['kelas-edt/(:any)'] = 'kelas/kelas_edit/$1';
// akhir route kelas

//route master transaksi
$route['mtransaksi-add'] = 'mtransaksi/transaksi_add';
$route['mtransaksi-hps/(:any)'] = 'mtransaksi/transaksi_delete/$1';
$route['mtransaksi-edt/(:any)'] = 'mtransaksi/transaksi_edit/$1';
//akhir route master transaksi

//tipe user
$route['tipeuser-det/(:any)'] = 'tipeuser/detail/$1';
$route['tipeuser-add'] = 'tipeuser/tambahData';
$route['tipeuser-ubah/(:any)'] = 'tipeuser/ubahData/$1';
$route['tipeuser-akses/(:any)'] = 'tipeuser/akses/$1';
//tahun akademik
$route['tahunakademik-det/(:any)'] = 'tahunakademik/detail/$1';
$route['tahunakademik-add'] = 'tahunakademik/tambahdata';
$route['tahunakademik-ubah/(:any)'] = 'tahunakademik/ubahdata/$1';
//staff
$route['staff-add'] = 'staff/tambahdata';
$route['staff-det/(:any)'] = 'staff/detail/$1';
$route['staff-ubah/(:any)'] = 'staff/ubahdata/$1';


//user
$route['profile'] = 'users/profile';
$route['ubah-profile'] = 'users/profile_ubah';
// akhir route user

//route transaksi
$route['transaksi-add'] = 'transaksi/transaksi_add';
$route['transaksi-hps/(:any)'] = 'transaksi/transaksi_delete/$1';
$route['transaksi-edt/(:any)'] = 'transaksi/transaksi_edit/$1';
//akhir route transaksi

//kas masuk
$route['kas-masuk-add'] = 'kasmasuk/tambah';
$route['kas-masuk-edt/(:any)'] = 'kasmasuk/ubah/$1';

//kas keluar
$route['kas-keluar-add'] = 'kaskeluar/tambah';
$route['kas-keluar-edt/(:any)'] = 'kaskeluar/ubah/$1';

//mastercoa
$route['mastercoa-add'] = 'mastercoa/tambah';
$route['mastercoa-edt/(:any)'] = 'mastercoa/ubah/$1';
$route['mastercoa-det/(:any)'] = 'mastercoa/detail/$1';

// jurnal
$route['jurnal-add'] = 'jurnal/jurnal_add';

//route users
$route['users-add'] = 'users/users_add';
$route['users-hps/(:any)'] = 'users/users_delete/$1';
$route['users-edit/(:any)'] = 'users/users_edit/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
