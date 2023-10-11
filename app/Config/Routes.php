<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::index');

$routes->get('/user/create', 'User::create');
$routes->get('/user/edit/(:segment)', 'User::edit/$1');
$routes->delete('/user/(:num)', 'User::delete/$1');

$routes->get('/user/(:any)', 'User::detail/$1');