<?php

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

$router->get('/projects', 'ProjectController@index');
$router->post('/projects', 'ProjectController@store');
$router->get('/projects/{project}', 'ProjectController@show');
$router->put('/projects/{project}', 'ProjectController@update');
$router->patch('/projects/{project}', 'ProjectController@update');
$router->delete('/projects/{project}', 'ProjectController@destroy');
