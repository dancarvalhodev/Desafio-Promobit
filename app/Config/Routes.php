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
$routes->setDefaultController('User');
$routes->setDefaultMethod('loginForm');
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

// ================================================== GET ==================================================
// Get User
$routes->get('/', 'User::loginForm');
$routes->get('/register', 'User::registerForm');
$routes->get('/logout', 'User::logout');
$routes->get('/home', 'User::index');

// Get Product
$routes->get('/newProductForm', 'Product::newForm');
$routes->get('/listProducts', 'Product::read');
$routes->get('/deleteProduct/?(:num)?', 'Product::delete/$1');
$routes->get('/showProduct/?(:num)?', 'Product::show/$1');
$routes->get('/editProduct/?(:num)?', 'Product::editForm/$1');
//$routes->get('/report', 'Product::report');

// Get Tag
$routes->get('/newTagForm', 'Tag::newForm');
$routes->get('/listTags', 'Tag::read');
$routes->get('/deleteTag/?(:num)?', 'Tag::delete/$1');


// ================================================== POST ==================================================
// Post User
$routes->post('/read-user', 'User::read');
$routes->post('/create-user', 'User::create');

// Post Product
$routes->post('/create-product', 'Product::create');
$routes->post('/edit-product', 'Product::update');

// Post Tag
$routes->post('/create-tag', 'Tag::create');

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
