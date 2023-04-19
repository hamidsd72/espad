<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class OfflinePayment extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function admin() {
        return $this->belongsTo('App\User','admin_id');
    }

    public function package() {
        return $this->belongsTo('App\Model\ServicePackage','item_id');
    }
    
}
