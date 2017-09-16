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

$app->get('/', function () use ($app) {
	return $app->version();
});

$app->get('/api/random-beer', 'ApiController@getRandomBeer');
$app->get('/api/search', 'ApiController@search');
$app->get('/api/flush-cache', 'ApiController@flushCache');

/**
 /user 
 */
$app->get('/user','UserController@index');
$app->get('/user/{id}','UserController@getUser');
$app->post('/user','UserController@createUser');
$app->put('/user/{id}','UserController@updateUser');
$app->delete('/user/{id}','UserController@deleteUser');

$app->get('/zones', function () {
	return ['error' => 0, 'zones' => App\Zone::all()];
});

/**
 /item
 */
$app->get('/item','ItemController@index');
$app->get('/item/{id}','ItemController@getItem');
$app->post('/item','ItemController@createItem');
$app->put('/item/{id}','ItemController@updateItem');
$app->delete('/item/{id}','ItemController@deleteItem');
$app->get('/items/{catId}', ['uses' => 'ItemController@all']);
$app->get('/nearby-items', ['uses' => 'ItemController@nearby']);
$app->get('/featured-items', ['uses' => 'ItemController@featured']);
$app->get('/pending-items', ['uses' => 'ItemController@pending']);
$app->get('/find-items/{term}', ['uses' => 'ItemController@find']);
$app->get('/items-user-id/{userId}', ['uses' => 'ItemController@itemsByUser']);
$app->get('/approve-pending-item/{id}', ['uses' => 'ItemController@approvePendingItem']);
$app->get('/decline-pending-item/{id}', ['uses' => 'ItemController@declinePendingItem']);


/**
 /categories
 */
$app->get('/category','CategoryController@index');
$app->get('/category/{id}','CategoryController@getCategory');
$app->post('/category','CategoryController@createCategory');
$app->put('/category/{id}','CategoryController@updateCategory');
$app->delete('/category/{id}','CategoryController@deleteCategory');

$app->get('/categories', ['uses' => 'CategoryController@all']);

/**
 /subcategories
 */
$app->get('/subcategories/{catId}', ['uses' => 'CategoryController@sub']);

/**
 * files
 */
$app->get('/file','FileController@index');
$app->post('/upload', ['uses' => 'FileController@upload']);


$app->get('foo', ['middleware' => 'auth', 'as' => 'bar', 'uses' => 'TestController@xyz']);

$app->post('foo', function () {
	//
});