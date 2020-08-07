<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Route::patch('/users', 'UserController@update');

Route::post('/login', 'AuthController@login');
Route::post('/adminLoginn', 'AuthController@adminLogin');
Route::post('/register', 'AuthController@register');
Route::post('/adminRegisterr', 'AuthController@adminRegister');


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'AuthController@logout');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/userprofile', 'UserController@update');
    Route::apiResource('/users', 'UserController');
    Route::apiResource('/image', 'Property\PropertyImageController');
    Route::apiResource('/propertyown', 'Property\ByOwnerPropertyController');
    Route::apiResource('/propertysale', 'Property\ForSalePropertyController');
    Route::apiResource('/propertynew', 'Property\NewHomePropertyController');
    Route::apiResource('/propertylong', 'Property\LongLeasePropertyController');
    Route::apiResource('/propertyshort', 'Property\ShortLeasePropertyController');
    Route::apiResource('/mansion', 'Property\MansionController');

    Route::get('/savedProperties', 'Property\PropertyUserController@index');
    Route::get('/save/{id}', 'Property\PropertyUserController@save');
    Route::get('/remove/{id}', 'Property\PropertyUserController@removeSaved');
    Route::get('/userproperty', 'PropertyController@index');

});

// Route::get('userimage/{filename}', 'PhotoController@profileImage');
// Route::get('propertyimage/{filename}', 'PhotoController@propertyImage');
Route::get('image/{filename}', 'UserController@imageCheck');

// Route::get('/customer', function () {
//     //
// })->middleware('auth:api-customers');
// Route::get('/api/properties', 'PropertyController@index');
// Route::post('/properties', 'PropertyController@store');
// Route::patch('/properties/{property}', 'PropertyController@update');
// Route::delete('/properties/{property}', 'PropertyController@destroy');

// Route::apiResource('/property', 'PropertyController');
Route::post('/property1own', 'Property\ByOwnerPropertyController@update');
// Route::get('/property1own', 'Property\ByOwnerPropertyController@store');
// Route::post('/findProperty', 'Property\ByOwnerPropertyController@search');
// Route::post('/findProperty', 'Property\ByOwnerPropertyController@search');
// Route::post('/image', 'Property\PropertyImageController@store');
// Route::post('/image/{$id}', 'Property\PropertyImageController@update');




Route::get('/propertyown11', 'Property\ByOwnerPropertyController@index');
Route::get('/propertyown', 'Property\ByOwnerPropertyController@index');
Route::get('/propertysale', 'Property\ForSalePropertyController@index');
Route::get('/propertynew', 'Property\NewHomePropertyController@index');
Route::get('/propertylong', 'Property\LongLeasePropertyController@index');
Route::get('/propertyshort', 'Property\ShortLeasePropertyController@index');

Route::get('/property/{id}', 'PropertyController@show');
Route::get('/allMansion', 'MansionController@index');
Route::get('/search', 'PropertyController@search');
Route::get('/sold', 'PropertyController@sold');
Route::get('/isSold/{id}', 'PropertyController@isSold');

// Route::post('/test', function()
// {
//   // Run controller and method
//   $app = app();
//   $controller = $app->get('Property\PropertyImageController');
//   return $controller->callAction('destroy', $parameters = array('id'=> 21));

// });
