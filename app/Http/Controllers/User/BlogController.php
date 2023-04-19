<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Setting;

class BlogController extends Controller {
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

    public function index($type) {
        $items  = Post::where('status','active')->where('type',$type)->orderByDesc('id')->paginate($this->controller_paginate());
        $latest = Post::where('status','active')->orderByDesc('id')->take(4)->get();
        return view('user.blog.index', compact('items','latest','type'));
    }

    public function store(Request $request) {
        $items  = Post::where('status','active')->where( 'title' ,  'like' , '%'. $request->search .'%' )->orderByDesc('id')->paginate($this->controller_paginate());
        $type   = $request->type;
        $latest = Post::orderByDesc('id')->take(4)->get();
        return view('user.blog.index',compact('type','items','latest'),['title' => 'جستجو در اطلاعیه ها , مقالات و آموزش ها']);
    }

    public function show($id, $slug=null) {
        $blog   = Post::where('status','active')->where('id',$id)->firstOrFail();
        $type   = $blog->type;
        $blog->seen+=1;
        $blog->update();
        $latest = Post::orderByDesc('id')->take(4)->get();
        return view('user.blog.show', compact('blog','latest','type'));
    }

}