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

    public function children() {
        return $this->hasMany('App\Model\StockPortfolioItem', 'item_id')->orderByDesc('id');
    }

    public function photo() {
        return $this->morphOne('App\Model\Photo', 'pictures');
    }

    public function pic() {
        return $this->hasOne('App\Model\Photo', 'pictures_id')->where('pictures_type','App\Model\StockPortfolio');
    }

}
