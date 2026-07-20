<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Client\AuthController::showLogin');

// -------------------------------------------------------------------------
// Côté opérateur
// -------------------------------------------------------------------------

$routes->get('operateur/prefixes',                'PrefixeController::index');
$routes->get('operateur/prefixes/create',         'PrefixeController::create');
$routes->post('operateur/prefixes/store',         'PrefixeController::store');
$routes->get('operateur/prefixes/edit/(:num)',    'PrefixeController::edit/$1');
$routes->post('operateur/prefixes/update/(:num)', 'PrefixeController::update/$1');
$routes->get('operateur/prefixes/delete/(:num)',  'PrefixeController::delete/$1');

$routes->get('operateur/baremes',                'BaremeController::index');
$routes->get('operateur/baremes/create',         'BaremeController::create');
$routes->post('operateur/baremes/store',         'BaremeController::store');
$routes->get('operateur/baremes/edit/(:num)',    'BaremeController::edit/$1');
$routes->post('operateur/baremes/update/(:num)', 'BaremeController::update/$1');
$routes->get('operateur/baremes/delete/(:num)',  'BaremeController::delete/$1');

$routes->get('operateur/situation/gain',       'SituationController::gain');
$routes->get('operateur/situation/comptes',    'SituationController::comptes');
$routes->get('operateur/situation/operateurs', 'SituationController::operateurs');

// -------------------------------------------------------------------------
// Côté client
// -------------------------------------------------------------------------

$routes->get('/login',  'Client\AuthController::showLogin');
$routes->post('/login', 'Client\AuthController::login');
$routes->get('/logout', 'Client\AuthController::logout');

$routes->group('client', ['filter' => 'clientAuth'], static function (RouteCollection $routes) {
    $routes->get('dashboard', 'Client\DashboardController::index');

    $routes->get('operation/(:segment)',  'Client\OperationController::form/$1');
    $routes->post('operation/(:segment)', 'Client\OperationController::process/$1');

    $routes->get('historique', 'Client\HistoriqueController::index');
});
