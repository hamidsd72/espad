<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StockPortfolio extends Model {

    protected $table = 'stock_portfolio';

    protected $fillable = [
        "cat_id",
        "status",
        "title",
        "text",
        "slug",
        "photo",
        "video",
        "file_title",
        "file",
    ];

    public function items() {
        return $this->hasMany('App\Model\StockPortfolio', 'cat_id')->get();
    }
}
