<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pencatatan::user');
// $routes->get('/dashboard', 'Pencatatan::index');

$routes->get('/user', 'Pencatatan::user');
$routes->get('/user/edit/(:segment)', 'Pencatatan::editUser/$1');
$routes->post('/user/update/(:num)', 'Pencatatan::updateUser/$1');
$routes->delete('/user/(:num)', 'Pencatatan::deleteUser/$1');

$routes->get('/barang', 'Pencatatan::barang');
$routes->delete('/barang/(:num)', 'Pencatatan::delete/$1');
$routes->get('/barang/edit/(:segment)', 'Pencatatan::edit/$1');
$routes->post('/barang/update/(:num)', 'Pencatatan::update/$1');

$routes->get('/masuk', 'Pencatatan::masuk');
$routes->delete('/bm/(:num)', 'Pencatatan::deleteBM/$1');
$routes->get('/bm/edit/(:segment)', 'Pencatatan::editBM/$1');
$routes->post('/barangMasuk/update/(:num)', 'Pencatatan::updateBM/$1');

$routes->get('/keluar', 'Pencatatan::keluar');
$routes->delete('/bk/(:num)', 'Pencatatan::deleteBK/$1');
$routes->get('/bk/edit/(:segment)', 'Pencatatan::editBK/$1');
$routes->post('/barangKeluar/update/(:num)', 'Pencatatan::updateBK/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
