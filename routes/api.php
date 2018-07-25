<?php

use Illuminate\Http\Request;

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

// Route::get('points', function() {
// 	return App\Point::all();
// });
// Route::post('points', 'PointController@store');
// Route::put('points/{user}', 'PointController@update');
// Route::get('points/{user}/transactions', 'PointController@userTransaction');

// Route::get('users', 'UserController@index');
// Route::get('users/{user}', 'UserController@user');
// Route::post('users', 'UserController@store');
// Route::put('users/{user}', 'UserController@update');
// Route::delete('users/{user}', 'UserController@destroy');
// Route::get('users/{user}/details', 'UserController@details');
// Route::get('users/{user}/points', 'PointController@userTotalPoint');



Route::get('pointtransactions/{user}', 'PointTransactionController@userTransactions');



// Route::get('users', 'UserController@users');
// Route::get('users/{user}', 'UserController@user');

Route::get('users', 'UserController@index');

// Route::post('users', 'UserController@store');
Route::post('users', 'UserController@addUserWithPoint');



Route::get('users/{user}', 'UserController@user');
Route::put('users/{user}', 'UserController@update');

Route::get('users/{user}/pttrans', 'UserController@getPtWithReward');

Route::post('users/{user}/point', 'UserController@adjustPoint');


Route::get('rewards', 'RewardController@index');
Route::get('rewards/{reward}', 'RewardController@reward');




Route::prefix('test')->group(function () {

	Route::get('/pt/{user}', function (App\User $user) {
	    return $user->pointTransactions()->get();
	});

	Route::get('/ptu/{user}', 'UserController@pointTransactions');

	Route::get('/pagi', function() {
		return App\User::paginate(50);
	});


	Route::get('userctrl', 'UserController@testGetUsers');
});

// Route::post('test/abc', 'PointTransactionController@store');

// Route::get('test/token', 'TestController@tokenGet');

// Route::get('test/token/route', 'TestController@testReturn')->middleware('auth:api');

// Route::get('test/redirect', function () {
//     $query = http_build_query([
//         'client_id' => 5,
//         'redirect_uri' => 'http://127.0.0.1/',
//         'response_type' => 'code',
//         'scope' => '',
//     ]);

//     return redirect('http://127.0.0.1:8000/oauth/authorize?'.$query);
// });

// Route::get('test/anotherRedirect', function() {
// 	// $response = $http->post('http://your-app.com/oauth/token', [
//  //        'form_params' => [
//  //            'grant_type' => 'authorization_code',
//  //            'client_id' => 'client-id',
//  //            'client_secret' => 'client-secret',
//  //            'redirect_uri' => 'http://example.com/callback',
//  //            'code' => $request->code,
//  //        ],
//  //    ]);

//     // return json_decode((string) $response->getBody(), true);

//     return 'yay';
// });

// Route::get('/abcde', function() {
//     return 'abc';
// })->middleware('auth');