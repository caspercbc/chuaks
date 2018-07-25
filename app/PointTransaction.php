<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function redeemableProduct()
    {
    	return $this->belongsTo(Reward::class, 'reward_id');
    }
}
