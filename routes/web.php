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

$router->get('/', function () {
    return view('index');
});

$router->get('poll', ['as' => 'poll_1.index', 'uses' => 'PollController@index']);
$router->get('poll/{hash}', ['as' => 'poll_1.view', 'uses' => 'PollController@show']);
$router->put('poll', ['as' => 'poll_1.create', 'uses' => 'PollController@store']);
