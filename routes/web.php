<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function (){
    return response(null, 200);
});

$router->post('/register', 'UserController@register');

$router->post('/login', 'UserController@login');

$router->get('/history/{player}', [
    'middleware' => 'auth',
    'uses' => 'GameController@getPlayerHistory'
]);

$router->post('/save', [
    'middleware' => 'auth',
    'uses' => 'GameController@saveGame'
]);