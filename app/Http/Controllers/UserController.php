<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function index()
    {
    	return User::all();
    }

    public function user(User $user)
    {
    	return $user;
    }

    public function details(User $user)
    {
    	$res = $user->toArray();
    	$total = $user->points()->selectRaw('sum(point) as total_points')->first();
		$res['total_points'] = $total['total_points'];

		return response()->json($res);
    }

    public function store()
    {
     	$user = new User;

		$user->name = request()->name;
		$user->email = request()->email;
		$user->password = Hash::make(request()->password);
		$user->save();

    	return response()->json(['message' => 'User added']);
    }

    public function update(User $user)
    {
    	$user->update([
    		'name' => request()->name,
    		'email' => request()->email,
    		'password' => Hash::make(request()->password)
    	]);

    	return response()->json(['message' => 'User updated']);
    }

    public function destroy(User $user)
    {
    	$user->delete();

    	return response()->json(['message' => 'User deleted']);
    }
}
