<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// --- Opérateur : Préfixes ---
$routes->get('operateur/prefixes',                'PrefixeController::index');
$routes->get('operateur/prefixes/create',         'PrefixeController::create');
$routes->post('operateur/prefixes/store',         'PrefixeController::store');
$routes->get('operateur/prefixes/edit/(:num)',    'PrefixeController::edit/$1');
$routes->post('operateur/prefixes/update/(:num)', 'PrefixeController::update/$1');
$routes->get('operateur/prefixes/delete/(:num)',  'PrefixeController::delete/$1');

// --- Opérateur : Barèmes de frais ---
$routes->get('operateur/baremes',                'BaremeController::index');
$routes->get('operateur/baremes/create',         'BaremeController::create');
$routes->post('operateur/baremes/store',         'BaremeController::store');
$routes->get('operateur/baremes/edit/(:num)',    'BaremeController::edit/$1');
$routes->post('operateur/baremes/update/(:num)', 'BaremeController::update/$1');
$routes->get('operateur/baremes/delete/(:num)',  'BaremeController::delete/$1');

// --- Opérateur : Situations ---
$routes->get('operateur/situation/gain',    'SituationController::gain');
$routes->get('operateur/situation/comptes', 'SituationController::comptes');
