<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User\HomeController::index');
$routes->get('error/404', function() {
    return view('error/html/error_404');
});

$routes->group('Admin', function($routes){
    $routes->get('home', 'Admin\HomeController::index');
    $routes->group('User', function($routes){
        $routes->get('list', 'Admin\UserController::list');
        $routes->get('add', 'Admin\UserController::add');
        $routes->post('create', 'Admin\UserController::create');
        $routes->get('edit/(:num)', 'Admin\UserController::edit/$1');
        $routes->post('update', 'Admin\UserController::update');
    });
});
$routes->get('home','User\HomeController::index');
$routes->group('user', function($routes){
    $routes->get('home','User\HomeController::index');
    $routes->post('login','User\LoginController::login');
    $routes->get('signup', 'User\LoginController::signup');
    $routes->post('create', 'User\LoginController::create');
    $routes->get('edit/(:num)', 'User\LoginController::edit/$1');
    $routes->post('update', 'User\LoginController::update');
});
