<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    public function pointTransactions()
    {
    	return $this->hasMany(PointTransaction::class);
    }
}
