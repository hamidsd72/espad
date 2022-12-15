<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        "type",
        "status",
        "title",
        "slug",
        "short_text",
        "text",
        "writer",
        "titleseo",
        "keywordsseo",
        "descriptionseo",
        "other",
        "photo",
        "video",
        "file_title",
        "file",
    ];

    public function user() {
        return $this->belongsTo('App\User', 'writer')->first();
    }
}
