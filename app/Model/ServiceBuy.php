<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceBuy extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function service()
    {
        return $this->belongsTo('App\Model\Service','buy_id');
    }
    public function pluses()
    {
        return $this->hasMany('App\Model\ServicePlusBuy','buy_id');
    }
}
