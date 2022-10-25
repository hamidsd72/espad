<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        "page_name",
        "service_id",
        "title",
        "text",
        "section",
        "sort",
        "link",
        "pic",
        "video",
        "status",
        "last_modify_user_id",
    ];

    public function service()
    {
        return $this->belongsTo('App\Model\Service','service_id')->first();
    }

}

