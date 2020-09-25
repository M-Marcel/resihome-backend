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
Route::get('/testarray', function () {

    $array = [
        "{
            'name': 'John Doe',
            'age': 29,
            'city': 'Aba',

         }"
    ];

    return $array[0];

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
// Route::patch('/users', 'UserController@update');

//Authentication
Route::post('/login', 'AuthController@login');
Route::post('/adminLoginn', 'AuthController@adminLogin');
Route::post('/register', 'AuthController@register');


Route::get('/sign-in/{provider}/redirect', 'AuthController@redirectToProvider');
Route::get('/sign-in/{provider}/callback', 'AuthController@handleProviderCallback');



Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'AuthController@logout');
});

Route::middleware('auth:api')->group(function () {
    //User
    Route::post('/userprofile', 'UserController@update');
    Route::apiResource('/users', 'UserController');

    //Property Image
    // Route::apiResource('/image', 'Property\PropertyImageController');
    Route::post('/propimage', 'Property\PropertyImageController@store');
    Route::post('/propimage/{imageId}', 'Property\PropertyImageController@update');
    Route::get('/propimageshow/{imageId}', 'Property\PropertyImageController@show');
    Route::delete('/propimage/{imageId}', 'Property\PropertyImageController@destroy');

    // Properties
    Route::apiResource('/propertyown', 'Property\ByOwnerPropertyController');
    Route::apiResource('/propertysale', 'Property\ForSalePropertyController');
    Route::apiResource('/propertynew', 'Property\NewHomePropertyController');
    Route::apiResource('/propertylong', 'Property\LongLeasePropertyController');
    Route::apiResource('/propertyshort', 'Property\ShortLeasePropertyController');

    //Mansion
    Route::apiResource('/mansion', 'Property\MansionController');

    //Saved Property
    Route::get('/savedProperties', 'Property\PropertyUserController@index');
    Route::get('/save/{id}', 'Property\PropertyUserController@save');
    Route::get('/remove/{id}', 'Property\PropertyUserController@removeSaved');
    Route::get('/userproperty', 'PropertyController@index');

    // Contact us
    Route::get('/getcontactus', 'ContactusController@index');
    Route::get('/getcontactus/{contactId}', 'ContactusController@show');

    // Contact Agent
    Route::get('/getcontactagent', 'ContactAgentController@index');
    Route::get('/getcontactagent/{contactId}', 'ContactAgentController@show');

    //Admin
    Route::post('/adminRegisterr', 'AdminController@adminRegister');
    Route::apiResource('/resiadmin', 'AdminController');
    Route::get('/blockuser/{id}', 'AdminController@blockUser');
    // Route::post('/update', 'AdminController@update');
});

Route::get('/showallimages/{propertyId}', 'Property\PropertyImageController@index');
Route::get('image/{filename}', 'UserController@imageCheck');

// Route::get('/customer', function () {
//     //
// })->middleware('auth:api-customers');
// Route::apiResource('/property', 'PropertyController');
Route::post('/property1own', 'Property\ByOwnerPropertyController@update');
Route::get('/imageAll', 'Property\PropertyImageController@index');
// Route::get('/testImage', 'Property\PropertyImageController@index');
Route::get('/imageShow/{imageId}', 'Property\PropertyImageController@show');
Route::get('/allUser', 'UserController@allUser');



//Properties
Route::get('/propertyown11', 'Property\ByOwnerPropertyController@index');
Route::get('/propertyown', 'Property\ByOwnerPropertyController@index');
Route::get('/propertysale', 'Property\ForSalePropertyController@index');
Route::get('/propertynew', 'Property\NewHomePropertyController@index');
Route::get('/propertylong', 'Property\LongLeasePropertyController@index');
Route::get('/propertyshort', 'Property\ShortLeasePropertyController@index');
Route::get('/property/{id}', 'PropertyController@show');

//Mansion
Route::get('/allMansion', 'Property\MansionController@index');
Route::get('/showMansion/{mansionid}', 'Property\MansionController@show');

//Search
Route::post('/search', 'PropertyController@search');
Route::post('/homesearch', 'PropertyController@mainSearch');
Route::get('/propertyAddress', 'PropertyController@fetchAddress');
Route::post('/agentsearch', 'AgentController@agentSearch');
Route::post('/renosearch', 'RenoController@renoSearch');
Route::post('/buildersearch', 'BuilderController@builderSearch');

//Sold Property
Route::get('/sold', 'PropertyController@sold');
Route::get('/leased', 'PropertyController@leased');
Route::get('/isSold/{id}', 'PropertyController@isSold');

// Contact Us
Route::post('/contactus', 'ContactusController@store');

// Contact Agent
Route::post('/contactagent', 'ContactAgentController@store');

//Expert Request
Route::post('/expertRequest', 'ExpertRequestController@expertRequest');

//Sample Policy
Route::get('/policy', function () {
    return view('policy');
});

