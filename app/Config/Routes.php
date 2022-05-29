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
$routes->setDefaultController('Signin');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Signin::index');
$routes->get('/signup', 'Signup::index');
$routes->post('/signup/', 'Signup::store');
$routes->get('/signin', 'Signin::index');
$routes->post('/signin/', 'Signin::loginAuth');
$routes->get('/profile', 'Profile::index',['filter' => 'authGuard']);
$routes->get('/signout', 'Signout::index');
$routes->post('/user/login', 'User::login');
$routes->post('/user/register', 'User::register');
$routes->get('/signin/facebookLogin', 'Signin::facebookLogin');
$routes->get('/drugs', 'DrugList::index');
$routes->get('/schedule', 'Schedule::index');
$routes->post('/schedule/', 'Schedule::store');
$routes->get('/send-code', 'RenewPassword::index');
$routes->post('/send-code', 'RenewPassword::send_code');
$routes->get('/renew-password', 'RenewPassword::renewal');
$routes->post('/renew-password', 'RenewPassword::renew');
$routes->get('/set-password', 'RenewPassword::show_set_password');
$routes->post('/set-password', 'RenewPassword::set_password');
$routes->get('/delete-drug/(:num)', 'Drug::delete_drug_schedule/$1');
$routes->add('/drug/(:num)', 'Drug::index/$1');
$routes->get('/edit-schedule/(:num)', 'Schedule::update_drug/$1');
$routes->post('/edit-schedule/(:num)', 'Schedule::save_update_drug/$1');

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
