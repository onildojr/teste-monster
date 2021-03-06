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

$router->group(['middleware' => 'throttle:30,1'], function () use ($router) {
    $router->post('api/hash/generate', [
        'as' => 'generate',
        'uses' => 'HashController@generate'
    ]);

    $router->get('api/hash', [
        'as' => 'all',
        'uses' => 'HashController@all'
    ]);
});
