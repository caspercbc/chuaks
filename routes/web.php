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

Route::prefix('admin')->group(function () {

	Route::get('/', function () {
	    return redirect('admin/dashboard');
	});

    Route::get('/dashboard', function() {
		return view('admin/dashboard');
	});

	Route::get('/transactions', function() {
		return view('admin/transactions');
	});

	Route::get('/products', function() {
		return view('admin/products');
	});

	Route::get('/members', function() {
		return view('admin/members');
	});

	Route::get('/members/:id', function() {
		return view('admin/members');
	});

	Route::get('/reports', function() {
		return view('admin/reports');
	});
});