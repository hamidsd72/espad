<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserForm extends Model
{
    protected $table = 'forms';

    protected $fillable = [
        "item_id",
        "type",
        "title",
        "cons_id",
        "user_id",
        "name",
        "uuid",
        "mobile",
        "code",
        "text",
        "status",
        "attach",
    ];

    public function user() {
        return $this->belongsTo('App\User','user_id')->first(['id','first_name','last_name']);
    }

    public function consultation() {
        return $this->belongsTo('App\User','cons_id')->first(['id','first_name','last_name']);
    }
    
    public function item() {
        return $this->belongsTo('App\Model\Service','item_id')->first(['id','title']);
    }

    public function job() {
        return $this->belongsTo('App\Model\JobOpportunity','item_id')->first(['id','title']);
    }
}
