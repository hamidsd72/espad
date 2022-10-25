<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CallPackage extends Model {
    protected $table = 'call_packages';

    protected $fillable = [
        "user_id",
        "item_id",
        "amount",
        "free_time",
        "used",
        "status",
    ];

    public function my_packages() {
        return $this->belongsTo('App\User','user_id');
    }

    public function my_active_packages() {
        return $this->belongsTo('App\User','user_id')->where('status','active');
    }

}
