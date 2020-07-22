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


Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'AuthController@logout');
});

// Route::get('/customer', function () {
//     //
// })->middleware('auth:api-customers');
// Route::get('/api/properties', 'PropertyController@index');
// Route::post('/properties', 'PropertyController@store');
// Route::patch('/properties/{property}', 'PropertyController@update');
// Route::delete('/properties/{property}', 'PropertyController@destroy');

// Route::apiResource('/property', 'PropertyController');
Route::get('/property1own', 'Property\ByOwnerPropertyController@store');


Route::apiResource('/propertyown', 'Property\ByOwnerPropertyController');
Route::apiResource('/propertysale', 'Property\ForSalePropertyController');
Route::apiResource('/propertynew', 'Property\NewHomePropertyController');
Route::apiResource('/propertylong', 'Property\LongLeasePropertyController');
Route::apiResource('/propertyshort', 'Property\ShortLeasePropertyController');
// Route::get('/propertTest', 'PropertyController@test');
