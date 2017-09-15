<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('home', function () {
    return view('home');
});

Route::group(['middleware' => 'auth.checkrole:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {
        Route::get('/', ['as' => '', 'uses' => 'CategoriesController@index']);
        Route::get('/index', ['as' => 'index', 'uses' => 'CategoriesController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CategoriesController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'CategoriesController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'CategoriesController@update']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CategoriesController@store']);
    });
    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function() {
        Route::get('/', ['as' => '', 'uses' => 'ClientsController@index']);
        Route::get('/index', ['as' => 'index', 'uses' => 'ClientsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'ClientsController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ClientsController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'ClientsController@update']);
        Route::post('/store', ['as' => 'store', 'uses' => 'ClientsController@store']);
    });
    Route::group(['prefix' => 'products', 'as' => 'products.'], function() {
        Route::get('/', ['as' => '', 'uses' => 'ProductsController@index']);
        Route::get('/index', ['as' => 'index', 'uses' => 'ProductsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'ProductsController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ProductsController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'ProductsController@update']);
        Route::post('/store', ['as' => 'store', 'uses' => 'ProductsController@store']);
        Route::get('/destroy/{id}', ['as' => 'destroy', 'uses' => 'ProductsController@destroy']); 
    });
    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function() {
        Route::get('/', ['as' => '', 'uses' => 'OrdersController@index']);
        Route::get('/index', ['as' => 'index', 'uses' => 'OrdersController@index']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'OrdersController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'OrdersController@update']);
    });
    Route::group(['prefix' => 'cupoms', 'as' => 'cupoms.'], function() {
        Route::get('/', ['as' => '', 'uses' => 'CupomsController@index']);
        Route::get('/index', ['as' => 'index', 'uses' => 'CupomsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CupomsController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'CupomsController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'CupomsController@update']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CupomsController@store']);
        Route::get('/destroy/{id}', ['as' => 'destroy', 'uses' => 'CupomsController@destroy']); 
    });
});

Route::group(['prefix' => 'customer', 'middleware' => 'auth.checkrole:client',  'as' => 'customer.'], function(){
    Route::get('order/create', ['as' => 'order.create', 'uses' => 'CheckoutController@create']);
    Route::get('order', ['as' => 'order.index', 'uses' => 'CheckoutController@index']);
    Route::post('order/store', ['as' => 'order.store', 'uses' => 'CheckoutController@store']);
    
});

// OAuth2
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['prefix' => 'api', 'middleware' => 'oauth',  'as' => 'api.'], function(){
    Route::group(['prefix' => 'client', 'middleware' => 'oauth.checkrole:client', 'as' => 'client.'], function() {
        Route::resource('order', Api\Client\ClientCheckoutController::Class, ['except' => ['create', 'edit', 'destroy']]);
    });
    Route::group(['prefix' => 'deliveryman', 'middleware' => 'oauth.checkrole:deliveryman', 'as' => 'deliveryman.'], function() {
        Route::resource('order', Api\Deliveryman\DeliverymanCheckoutController::class, ['except' => ['create', 'edit', 'destroy', 'store']]);
    }); 
    Route::patch('order/{id}/update-status',[
        'as' => 'order.update_status',
        'uses' => '\CodeDelivery\Http\Controllers\Api\Deliveryman\DeliverymanCheckoutController@updateStatus'
    ]);
});

