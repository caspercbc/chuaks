<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Point;
use App\User;

class PointController extends Controller
{
	public function index()
	{
		return Point::all(); 
	}

	public function userTotalPoint(User $user)
	{
		return response()->json(['total_points' => $user->points()->sum('point')]);
	}

	public function userTransaction(User $user)
	{
		return $user->points()->get();
	}

    public function store()
    {
    	$trans = new Point;

		$trans->point = request()->points;
		$trans->user_id = request()->userId;
		$trans->save();

    	return response()->json(['message' => 'Transaction added']);
    }

    public function update(User $user)
    {
    	DB::table('points')->where([
    		['user_id', $user->id],
    		['point', request()->point],
    		['created_at', '2018-06-25 08:48:28']
    	])->update(['point' => request()->updatePoint]);

    	return response()->json(['message' => 'User '.$user->name.' points edited']);
    }
}
