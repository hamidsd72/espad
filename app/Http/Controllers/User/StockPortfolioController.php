<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\StockPortfolio;
use App\Model\Setting;

class StockPortfolioController extends Controller {

    public function __construct() {
       $this->middleware(['checksinglesession']);
    }
    
    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    function fa_number($number) {
        $arr = array();
        for ($i=0; $i < strlen($number); $i++) { 
            switch ($number) {
                case $number[$i] == "0":
                    array_push($arr, "۰" );
                break;
                case $number[$i] == "1":
                    array_push($arr, "۱" );
                break;
                case $number[$i] == "2":
                    array_push($arr, "۲" );
                break;
                case $number[$i] == "3":
                    array_push($arr, "۳" );
                break;
                case $number[$i] == "4":
                    array_push($arr, "۴" );
                break;
                case $number[$i] == "5":
                    array_push($arr, "۵" );
                break;
                case $number[$i] == "6":
                    array_push($arr, "۶" );
                break;
                case $number[$i] == "7":
                    array_push($arr, "۷" );
                break;
                case $number[$i] == "8":
                    array_push($arr, "۸" );
                break;
                case $number[$i] == "9":
                    array_push($arr, "۹" );
                break;
            
                default:
                    array_push($arr, $number[$i] );
            } 
        }
        return implode("",$arr);
    }

    public function index() {
        $items  = StockPortfolio::where('status','active')->where('cat_id',8)->orderByDesc('id')->paginate($this->controller_paginate());
        $latest = StockPortfolio::where('status','active')->orderByDesc('id')->take(4)->get();
        $cats   = StockPortfolio::where('status','active')->where('id','!=',8)->where('cat_id',null)->orderByDesc('sort')->get();
        return view('user.consultation.stock-portfolio.index', compact('items','cats','latest'));
    }

    public function edit($id) {
        $item   = StockPortfolio::where('status','active')->where('cat_id',null)->where('slug',$id)->firstOrFail();
        $latest = StockPortfolio::where('status','active')->orderByDesc('id')->take(4)->get();
        $items  = StockPortfolio::where('status','active')->where('cat_id',$item->id)->orderByDesc('id')->paginate($this->controller_paginate());
        $cats   = StockPortfolio::where('status','active')->where('id','!=',8)->where('cat_id',null)->orderByDesc('sort')->get();
        return view('user.consultation.stock-portfolio.index', compact('items','cats','id','latest'));
    }

    public function store(Request $request) {
        $items  = StockPortfolio::where('status','active')->where('cat_id','!=',null)->where( 'title' ,  'like' , '%'. $request->search .'%' )->orderByDesc('id')->paginate($this->controller_paginate());
        $cats   = StockPortfolio::where('status','active')->where('id','!=',8)->where('cat_id',null)->orderByDesc('sort')->get();
        $latest = StockPortfolio::where('status','active')->orderByDesc('id')->take(4)->get();
        return view('user.consultation.stock-portfolio.index', compact('items','cats','latest') , ['title' => 'نتایج جستجوی']);
    }

    public function show($id) {
        if (auth()->user()) {
            $item   = StockPortfolio::where('status','active')->where('cat_id','!=',null)->where('slug',$id)->firstOrFail();
            $latest = StockPortfolio::where('status','active')->orderByDesc('id')->take(4)->get();
            $cats   = StockPortfolio::where('status','active')->where('id','!=',8)->where('cat_id',null)->orderByDesc('sort')->get();
            return view('user.consultation.stock-portfolio.show', compact('item','cats','id','latest'));
        }
        return false;
    }

}