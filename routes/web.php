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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

$router->group(['prefix' => 'customers'], function () use ($router) {
    $router->get('/', 'CustomerController@index');
    $router->get('/{id}', 'CustomerController@show');
    $router->post('/', 'CustomerController@store');
    $router->put('/{id}', 'CustomerController@update');
    $router->delete('/{id}', 'CustomerController@destroy');
});

$router->group(['prefix' => 'products'], function () use ($router) {
    $router->get('/', 'ProductController@index');
    $router->get('/{id}', 'ProductController@show');
    $router->post('/', 'ProductController@store');
    $router->put('/{id}', 'ProductController@update');
    $router->delete('/{id}', 'ProductController@destroy');
});

$router->group(['prefix' => 'orders'], function () use ($router) {
    $router->get('/', 'OrderController@index');
    $router->get('/{id}', 'OrderController@show');
    $router->post('/', 'OrderController@store');
    $router->put('/{id}', 'OrderController@update');
    $router->delete('/{id}', 'OrderController@destroy');
});

