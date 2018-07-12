<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function tokenGet()
    {
    	// return response()->json(['message' => 'abcde']);


    	$data = [
    		'client_id' => env('PASSWORD_CLIENT_ID'),
    		'client_secret' => env('PASSWORD_CLIENT_SECRET'),
    		'grant_type' => 'password',
    		'username' => 'abcde@example.com',
    		'password' => 'password'
    	];

    	// $response = 

    	// return response()->json(['message' => 'abcde']);
    }

    public function testReturn()
    {
    	return 'returned!';
    }
}
