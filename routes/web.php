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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/abcde', function() {
	return 'abc';
})->middleware('auth');

Route::get('/admin', function() {
	return view('myvue');
})->middleware('auth');


Route::get('/dashboard', function() {
	return view('dashboard');
});

Route::get('/transactions', function() {
	return view('transactions');
});

Route::get('/products', function() {
	return view('products');
});

Route::get('/members', function() {
	return view('members');
});

Route::get('/reports', function() {
	return view('reports');
});