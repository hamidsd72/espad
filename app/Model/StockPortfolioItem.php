<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StockPortfolioItem extends Model {

    // protected $table = 'stock_portfolio';

    protected $fillable = [
        "item_id",
        "text",
        "sort",
    ];

    public function item() {
        return $this->hasOne('App\Model\StockPortfolio', 'item_id');
    }

}
