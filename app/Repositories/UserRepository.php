<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Hash;

use App\User;
use App\PointTransaction;

class UserRepository
{
	public function getUser(User $user)
	{
		$res = [];
        $query = [];
        $pointFlag = false;

        if(request()->query('field')){
            $query = explode(',', request()->query('field'));
        } else {
            $query = ['*'];
        }

        if(in_array("total_points", $query)){
            $pointFlag = true;
            $query = array_diff($query, ["total_points"]);
        }

        if( sizeof($query) > 0 ){
            $res = User::select($query)->find($user->id);
        }

        if( $pointFlag ){
            $res['total_points'] = $user->pointTransactions()->sum('point');
        }

        return $res;
	}

	public function getUsers()
	{
		$res = [];
        $query = '*';
        $itemLimit = 15;
        $orderBy = ['id', 'desc'];
        $where = null;

        if(request()->query('field')){
            $query = explode(',', request()->query('field'));
        }

        if(request()->query('limit')){
            $itemLimit = request()->query('limit');
        }
        
        if(request()->query('sort')){
            $orderBy = explode(',',request()->query('sort'));

            if(sizeof($orderBy) < 2){
                $orderBy[1] = 'asc';
            }
        }

        if(request()->query('search')){
            // $term = explode(',',request()->query('search'));
            // $where = [[$term[0], $term[1], $term[2]]];
            $where = request()->query('search');
        }

        try {
            if(request()->query('search')){

                $res = User::select($query)
                    ->where('id','=', $where)
                    ->orWhere('name', 'LIKE', '%'.$where.'%')
                    ->orWhere('email', 'LIKE', '%'.$where.'%')
                    ->orderBy($orderBy[0], $orderBy[1])
                    ->paginate($itemLimit);

            } else {
                $res = User::select($query)->orderBy($orderBy[0], $orderBy[1])->paginate($itemLimit);
            }

        }catch(\Exception $e){
            
            return response()->json(array("message" => $e->getMessage()), 500);
        }

        return $res;
	}

	public function addUser()
	{
		$user = new User;

		$user->name = request()->name;
		$user->email = request()->email;
		$user->password = Hash::make(request()->password);
		$user->save();

    	return response()->json(['message' => 'User added']);
	}

	public function editUser(User $user, $changePassword)
	{
        $user->name = request()->name;
        $user->email = request()->email;
        if( $changePassword ){
            $user->password = Hash::make(request()->password);
        }
        $user->save();

    	return response()->json(['message' => 'User updated']);
	}

	public function deleteUser(User $user)
	{
		$user->delete();

    	return response()->json(['message' => 'User deleted']);
	}


    // Add user with point
    public function addUserWithPoint()
    {
        try {
            \DB::beginTransaction();

            $user = new User;

            $user->name = request()->name;
            $user->email = request()->email; 
            $user->password = Hash::make(request()->password);
            $user->save();

            $trans = new PointTransaction;

            $trans->user_id = $user->id;
            $trans->point = request()->point;
            $trans->reward_id = null;

            if( empty(request()->description) ){
                $trans->description = 'Initial point granted';
            } else {
                $trans->description = request()->description;
            }
            $trans->save();
    
            \DB::commit();
        } catch(\Illuminate\Database\QueryException $e) {
            \DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 409);
        }

        return response()->json(['message' => 'User added']);
    }
}