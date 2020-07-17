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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Classes
Route::get('/classes', 'ClassController@index')->name('classes.index');
Route::get('/classes/create', 'ClassController@create')->name('classes.create');
Route::post('/classes', 'ClassController@store')->name('classes');
// Community
Route::get('/classes/{class}/community', 'CommunityController@show')->name('classes.community');