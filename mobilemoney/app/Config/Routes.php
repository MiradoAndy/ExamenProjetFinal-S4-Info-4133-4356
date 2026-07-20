<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// --------------------------------------------------------------------------
// Côté client (login + espace client)
// --------------------------------------------------------------------------

// Login (accessible sans être connecté)
$routes->get('/login', 'Client\AuthController::showLogin');
$routes->post('/login', 'Client\AuthController::login');
$routes->get('/logout', 'Client\AuthController::logout');

// Espace client, protégé par le filtre 'clientAuth' (nécessite d'être connecté)
$routes->group('client', ['filter' => 'clientAuth'], static function (RouteCollection $routes) {
    $routes->get('dashboard', 'Client\DashboardController::index');

    $routes->get('operation/(:segment)', 'Client\OperationController::form/$1');
    $routes->post('operation/(:segment)', 'Client\OperationController::process/$1');

    $routes->get('historique', 'Client\HistoriqueController::index');
});
