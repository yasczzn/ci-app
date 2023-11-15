<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('coba', [Coba::class, 'index']);
// $routes->get('(:segment)', [Coba::class, 'view']);
$routes->get('/pages', 'Pages::index');

$routes->get('/orang/printpdf', 'Orang::printpdf');

$routes->get('/user/create', 'User::create');
$routes->get('/user/edit/(:segment)', 'User::edit/$1');
$routes->post('/user/edit/(:segment)', 'User::update/$1');
$routes->delete('/user/(:num)', 'User::delete/$1');
$routes->get('/user/print/(:segment)', 'User::print/$1');
$routes->get('/user/preview/(:segment)', 'User::preview/$1');
$routes->get('/user/details/(:segment)', 'User::detail/$1');