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

Route::get('/', function() {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

# login
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login/action', 'Auth\LoginController@authenticate')->name('login.action');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::post('/register/action', 'Auth\RegisterController@create')->name('register.action');

# dashboard admin
Route::get('/admin', function() {
    return view('admin.dashboard');
})->middleware('auth');

# events
Route::prefix('/admin/events')->group(function() {
    Route::get('/', 'Admin\EventsController@index')->name('admin.events.index')->middleware('auth');
    Route::get('/create', 'Admin\EventsController@create')->name('admin.events.create')->middleware('auth');
    Route::post('/store', 'Admin\EventsController@store')->name('admin.events.store')->middleware('auth');
    Route::get('/edit/{id}', 'Admin\EventsController@edit')->name('admin.events.edit')->middleware('auth');
    Route::post('/update', 'Admin\EventsController@update')->name('admin.events.update')->middleware('auth');
    Route::get('/delete/{id}', 'Admin\EventsController@destroy')->name('admin.events.delete')->middleware('auth');
});

# dashboard admin
Route::get('/user', function() {
    return view('user.show');
})->middleware('auth');