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
    return view('welcome');
});
//Routes created by make:auth
Auth::routes();
//Standart Routes
Route::get('/home', 'HomeController@index')->name('home');
//Extended Routes for login form for administartor
Route::prefix('admin')->group(function(){
  Route::get('/', 'AdminController@index')->name('admin.index');
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
});
//Routes for CMS
Route::prefix('manage')->middleware('auth:admin')->group(function(){
	Route::get('/', 'AdminController@index')->name('manage.dashboard');
});
