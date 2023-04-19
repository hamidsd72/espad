<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\StockPortfolio;
use App\Model\Setting;
use App\Model\Data;
use Carbon\Carbon;

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

    function old_special_user() {
        if (auth()->user()) {
            $special = Carbon::parse(auth()->user()->is_special);
            $created = Carbon::parse(auth()->user()->created_at);
            if ( $created->diffInDays($special,false) > 0 ) return true;
        }
        return false;
    }

    public function index() {
        $items      = StockPortfolio::where('status','active')->where('cat_id',8)->orderByDesc('created_at')->paginate($this->controller_paginate());
        $latest     = StockPortfolio::where('status','active')->orderByDesc('id')->take(4)->get();
        $cats       = StockPortfolio::where('status','active')->where('id','!=',8)->where('cat_id',null)->orderByDesc('sort')->get();
        $old_user   = $this->old_special_user();
        $data       = Data::where('page_name', 'سبد-سهام')->get();
        $item       = StockPortfolio::find(8);
        $item->seen = $item->seen + 1;
        $item->update();
        return view('user.consultation.stock-portfolio.index', compact('data','items','cats','latest','old_user'));
    }

    public function edit($id) {
        $item   = StockPortfolio::where('status','active')->where('cat_id',null)->where('slug',$id)->firstOrFail();
        $item->seen = $item->seen + 1;
        $item->update();
        $latest = StockPortfolio::where('status','active')->orderByDesc('id')->take(4)->get();
        $items  = StockPortfolio::where('status','active')->where('cat_id',$item->id)->orderByDesc('created_at')->paginate($this->controller_paginate());
        $cats   = StockPortfolio::where('status','active')->where('id','!=',8)->where('cat_id',null)->orderByDesc('sort')->get();
        $old_user   = $this->old_special_user();
        $data       = Data::where('page_name', 'سبد-سهام')->get();
        return view('user.consultation.stock-portfolio.index', compact('data','items','cats','id','latest','old_user'));
    }

    public function store(Request $request) {
        $items  = StockPortfolio::where('status','active')->where('cat_id','!=',null)->where( 'title' ,  'like' , '%'. $request->search .'%' )->orderByDesc('created_at')->paginate($this->controller_paginate());
        $cats   = StockPortfolio::where('status','active')->where('id','!=',8)->where('cat_id',null)->orderByDesc('sort')->get();
        $latest = StockPortfolio::where('status','active')->orderByDesc('id')->take(4)->get();
        $old_user   = $this->old_special_user();
        $data       = Data::where('page_name', 'سبد-سهام')->get();
        return view('user.consultation.stock-portfolio.index', compact('data','items','cats','latest','old_user') , ['title' => 'نتایج جستجوی']);
    }

    public function show($id) {
        if (auth()->user()) {
            $item   = StockPortfolio::where('status','active')->where('cat_id','!=',null)->where('id',$id)->firstOrFail();
            $latest = StockPortfolio::where('status','active')->orderByDesc('id')->take(4)->get();
            $cats   = StockPortfolio::where('status','active')->where('id','!=',8)->where('cat_id',null)->orderByDesc('sort')->get();
            return view('user.consultation.stock-portfolio.show', compact('item','cats','id','latest'));
        }
        return redirect()->route('user.home-goust')->with('flash_message', 'برای مشاهده این بخش ابتدا وارد شوید');
    }

}