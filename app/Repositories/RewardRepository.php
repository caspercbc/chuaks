<?php
namespace App\Repositories;

use App\Reward;

class RewardRepository
{
	public function getReward(Reward $reward)
	{
		return $reward;
	}

	public function getRewards()
	{
		$itemLimit = 15;
        $orderBy = ['id', 'desc'];

        if(request()->query('limit')){
            $itemLimit = request()->query('limit');
        }

        if(request()->query('sort')){
            $orderBy = explode(',',request()->query('sort'));

            if(sizeof($orderBy) < 2){
                $orderBy[1] = 'asc';
            }
        }

        return Reward::orderBy($orderBy[0], $orderBy[1])->paginate($itemLimit);
	}

	public function addReward()
	{
		$reward = new Reward;

		$reward->image_url = request()->image_url;
		$reward->name = request()->name;
		$reward->description = request()->description;
		$reward->point = request()->point;
		$reward->save();

    	return response()->json(['message' => 'Reward added']);
	}

	public function editReward(Reward $reward)
	{
		$reward->update([
    		'image_url' => request()->image_url,
    		'name' => request()->name,
    		'description' => request()->description,
    		'point' => request()->point
    	]);

    	return response()->json(['message' => 'Reward updated']);
	}

	public function deleteReward(Reward $reward)
	{
		$reward->delete();

    	return response()->json(['message' => 'Reward deleted']);
	}
}