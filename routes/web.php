<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {

    $array = [
        "{
            'name': 'John Doe',
            'age': 29,
            'city': 'Aba'

         }"
    ];

    $main = json_decode($array[0]);
    return $main;

});
