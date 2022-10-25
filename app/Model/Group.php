<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {
    protected $table = 'groups';

    protected $fillable = [
        "title",
        "slug",
    ];

    public function items_count() {
        return $this->hasMany('App\Model\ServiceCat','group_id')->where('service_id',83)->count();
    }
}
