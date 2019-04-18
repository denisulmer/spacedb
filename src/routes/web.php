<?php

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
    return redirect('images');
});

Auth::routes();

# Google OAuth
Route::get('login/google', 'Auth\LoginController@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');
# Github OAuth
Route::get('login/google', 'Auth\LoginController@redirectToGithub')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@handleGithubCallback');

# Routes for operators
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {
    Route::get('database/manufacturers/all', 'AdminController@showManufacturerDatabase');
});

# Manufacturer
Route::post('/manufacturer', 'ManufacturerController@store')->name('manufacturer.store');

# Public routes
Route::get('/', 'PagesController@start')->name('start');
Route::get('/discover', 'PagesController@discover')->name('discover');
Route::get('/user/{user}', 'UserController@gallery')->name('gallery');
Route::get('/image/{image}', 'ImageController@show')->name('image');
Route::get('/object/{object}', 'ObjectController@show')->name('object');
Route::get('/mount/{mount}', 'ImageController@showByMount')->name('image.by_mount');
Route::get('/optics/{optics}', 'ImageController@showByOptics')->name('image.by_optics');
Route::get('/camera/{camera}', 'ImageController@showByCamera')->name('image.by_camera');

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('upload', 'ImageController@create');
    Route::post('image', 'ImageController@store')->name('store_image');
    Route::get('/profile/equipment', 'UserController@standardEquipment')->name('equipment');
    Route::post('/profile/equipment', 'UserController@updateStandardEquipment')->name('update_equipment');
});

