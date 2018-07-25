<?php
namespace App\Repositories;

use App\PointTransaction;
use App\User;

class PointRepository
{
    public function getPointTransactions()
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

        return PointTransaction::orderBy($orderBy[0], $orderBy[1])->paginate($itemLimit);
    }

    public function addPointTransaction()
    {
        $trans = new PointTransaction;

        $trans->user_id = request()->userId;
        $trans->point = request()->point;
        $trans->reward_id = request()->rewardId;
        $trans->description = request()->description;
        $trans->save();

        return response()->json(['message' => 'Transaction added']);
    }

    public function editPointTransaction(PointTransaction $point)
    {
        $point->user_id = request()->userId;
        $point->point = request()->point;
        $point->reward_id = request()->rewardId;
        $point->description = request()->description;
        $point->save();

        return response()->json(['message' => 'Transaction edited']);
    }

    public function destroyPointTransaction(PointTransaction $point)
    {
        $point->delete();

        return response()->json(['message' => 'Transaction deleted']);
    }


    // User Related
    public function getUserTotalPoint(User $user)
    {
        return $user->pointTransactions()->sum('point');
    }

    public function getUserPointTransactions(User $user)
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

        return $user->pointTransactions()->orderBy($orderBy[0], $orderBy[1])->paginate($itemLimit);
    }

    public function getUserPtWithReward(User $user)
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

        return \DB::table('point_transactions')->select('point_transactions.id', 'user_id', 'reward_id', 'image_url', 'name', 'point_transactions.point', 'point_transactions.description as pt_desc', 'rewards.description as item_desc', 'point_transactions.created_at', 'point_transactions.updated_at')->where('user_id', '=', $user->id)->leftJoin('rewards', 'point_transactions.reward_id', '=', 'rewards.id')->orderBy($orderBy[0], $orderBy[1])->paginate($itemLimit);
    }

    public function adjustUserPoint(User $user)
    {
        $trans = new PointTransaction;

        if( empty(request()->rewardId) ){
            $trans->reward_id = null;
        } else {
            $trans->reward_id = request()->rewardId;
        }

        $trans->user_id = $user->id;
        $trans->point = request()->point;
        $trans->description = request()->description;
        $trans->save();

        return response()->json(['message' => 'Transaction added']);
    }

    public function editUserPoint(User $user)
    {
        DB::table('points')->where([
            ['user_id', $user->id],
            ['point', request()->point],
            ['created_at', '2018-06-25 08:48:28']
        ])->update(['point' => request()->updatePoint]);

        return response()->json(['message' => 'User '.$user->name.' points edited']);
    }

}