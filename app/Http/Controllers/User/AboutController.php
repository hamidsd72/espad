<?php

namespace App\Http\Controllers\User;

use App\Model\About;
use App\Model\AboutJoin;
use App\Http\Controllers\Controller;

class AboutController extends Controller {
    public function index() {
        $item=About::first();
        $items=AboutJoin::where('type','about')->get();
        return view('user.about.index',compact('item','items'));
    }

    public function show() {
        $item=About::first();
        $items=AboutJoin::where('type','about')->get();
        return view('user.about.show',compact('item','items'));
    }

}