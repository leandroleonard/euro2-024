<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'LoginController::form');

$routes->post('/submit', 'PlayerController::submit');

$routes->get('/region', 'RegionController::create');

$routes->group('/team', static function($routes){
    $routes->get('/', 'TeamController::index');
    $routes->get('(:segment)', 'TeamController::submit/$1');
    $routes->get('create', 'TeamController::submit');
});

$routes->group('/groups', static function($routes){
    $routes->get('/', 'TeamsGroupController::index');
    $routes->get('/sort', 'TeamsGroupController::sort');
});


$routes->group('player', static function($routes){
    $routes->get('/', 'PlayerController::index');
    $routes->get('create', 'PlayerController::form');
    $routes->get('(:segment)', 'PlayerController::form/$1');
});

$routes->group('coach', static function($routes){
    $routes->get('/', 'CoachController::index');
    $routes->get('create', 'CoachController::form');
    $routes->get('(:segment)', 'CoachController::form/$1');
});



$routes->group('api/v1', static function($routes){
    $routes->get('player/get/(:segment)', 'PlayerController::get/$1');
    $routes->post('player/create', 'PlayerController::save');
    $routes->post('player/update', 'PlayerController::update');

    $routes->post('player/update', 'PlayerController::update');

    $routes->group('team', static function($routes){
        $routes->get('/', 'TeamController::get');
        $routes->get('(:segment)', 'TeamController::get/$1');

        $routes->get('(:segment)/delete', 'TeamController::delete/$1');

        $routes->post('/', 'TeamController::save');
    });

    $routes->group('player', static function($routes){
        $routes->get('/', 'PlayerController::get');
        $routes->get('(:segment)', 'PlayerController::get/$1');

        $routes->get('(:segment)/delete', 'PlayerController::delete/$1');

        $routes->post('/', 'PlayerController::submit');
    });

    $routes->group('coach', static function($routes){
        $routes->get('/', 'CoachController::get');
        $routes->get('(:segment)', 'CoachController::get/$1');

        $routes->get('(:segment)/delete', 'CoachController::delete/$1');

        $routes->post('/', 'CoachController::submit');
    });

    $routes->group('groups', static function($routes){
        $routes->get('/', 'TeamsGroupController::get');

        $routes->get('match', 'MatchController::sortMatchGroups');
    });
});


