<?php
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');header('Access-Control-Allow-Headers:X-CSRF-TOKEN, Origin, X-Requested-With, Content-Type,Accept, Authortization');
// header('Access-Control-Allow-Origin: *');
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('echo', function() {
    return "OK";
});

Route::get('demo', function() {
    return "Hello world";
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['middleware' => ['api', 'jwt.auth'], 'prefix' => 'users'], function ($router) {
    Route::get('', 'UserController@getPartial');
    Route::post('create', 'UserController@create');
    Route::post('update/{id}', 'UserController@update');
    Route::get('getById/{id}', 'UserController@getById');
});

Route::group(['middleware' => ['api', 'jwt.auth'], 'prefix' => 'report'], function ($router) {
    Route::post('getPartial', 'ReportController@getPartial');
    Route::post('create', 'ReportController@create');
    Route::post('update/{id}', 'ReportController@update');
    Route::post('delete/{id}', 'ReportController@delete');
    Route::post('find/{id}', 'ReportController@find');
    Route::post('getByFilter', 'ReportController@getByFilter');
});

Route::group(['middleware' => ['api', 'jwt.auth'], 'prefix' => 'team'], function ($router) {
    Route::get('', 'TeamController@getPartial');
    Route::get('getAll', 'TeamController@getAll');
    Route::post('create', 'TeamController@create');
    Route::post('update/{id}/{idUser}', 'TeamController@update');
    Route::post('delete/{id}', 'TeamController@delete');
    Route::get('getById/{id}', 'TeamController@getById');
});

Route::group(['middleware' => ['api', 'jwt.auth'], 'prefix' => 'payment'], function ($router) {
    Route::get('getPaypalConfig', 'PaymentController@getPaypalConfig');
    Route::post('processPayment', 'PaymentController@processPayment');
});
