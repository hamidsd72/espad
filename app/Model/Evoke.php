<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Evoke extends Model {
    protected $table = 'evokes';

    protected $fillable = [
        "item_id",
        "user_id",
        "consultation_id",
        "notify",
    ];
    // ارسال شده
    public function evokes() {
        return $this->belongsTo('App\User','consultation_id')->where('notify','در انتظار ارسال');
    }

}
