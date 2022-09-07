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
$routes->get('/', 'Home::index');
$routes->get('ijess', 'Ijess::index');
$routes->get('/ijess/create', 'ijess::create');
$routes->get('/ijess/edit/(:segment)', 'ijess::edit/$1');
$routes->delete('/ijess/(:num)', 'ijess::delete/$1');
$routes->get('jtep', 'Jtep::index');
$routes->get('/jtep/create', 'jtep::create');
$routes->get('/jtep/edit/(:segment)', 'jtep::edit/$1');
$routes->delete('/jtep/(:num)', 'jtep::delete/$1');
$routes->get('ahjpm', 'Ahjpm::index');
$routes->get('/ahjpm/create', 'ahjpm::create');
$routes->get('/ahjpm/edit/(:segment)', 'ahjpm::edit/$1');
$routes->delete('/ahjpm/(:num)', 'ahjpm::delete/$1');
$routes->get('jogta', 'Jogta::index');
$routes->get('/jogta/create', 'jogta::create');
$routes->get('/jogta/edit/(:segment)', 'jogta::edit/$1');
$routes->delete('/jogta/(:num)', 'jogta::delete/$1');
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
