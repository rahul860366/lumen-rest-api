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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('groups/{user_id}', 'GroupsController@getGroupsByUser');
$router->get('group/users/{group_id}', 'GroupsController@getGroupUsers');

$router->post('group/create', 'GroupsController@createGroup');
$router->put('group/update', 'GroupsController@updateGroup');
$router->delete('group/delete/{group_id}', 'GroupsController@deleteGroup');