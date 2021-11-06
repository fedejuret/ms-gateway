<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'middleware' => 'client.credentials'
], function () use ($router) {
    /**
     * Authors routes
     */
    $router->get('/authors', 'AuthorController@index');
    $router->post('/authors', 'AuthorController@store');
    $router->get('/authors/{authorId}', 'AuthorController@show');
    $router->put('/authors/{authorId}', 'AuthorController@update');
    $router->patch('/authors/{authorId}', 'AuthorController@update');
    $router->delete('/authors/{authorId}', 'AuthorController@destroy');

    /**
     * Books routes
     */
    $router->get('/books', 'BookController@index');
    $router->post('/books', 'BookController@store');
    $router->get('/books/{bookId}', 'BookController@show');
    $router->put('/books/{bookId}', 'BookController@update');
    $router->patch('/books/{bookId}', 'BookController@update');
    $router->delete('/books/{bookId}', 'BookController@destroy');

    /**
     * Users routes
     */
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->get('/users/{userId}', 'UserController@show');
    $router->put('/users/{userId}', 'UserController@update');
    $router->patch('/users/{userId}', 'UserController@update');
    $router->delete('/users/{userId}', 'UserController@destroy');

});

$router->group([
    'middleware' => 'auth:api'
], function () use ($router) {

    $router->get('/users/me', 'UserController@me');

});
