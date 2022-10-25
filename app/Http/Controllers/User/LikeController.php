<?php

namespace App\Http\Controllers\User;

use App\Model\Like;
use App\Model\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Sms; 

class LikeController extends Controller {
    public function controller_title($type) {
        if ($type == 'sum') {
            return ' امتیازات';
        } elseif ('single') {
            return ' امتیاز';
        }
    }

    public function __construct() {
        $this->middleware('auth');
    } 

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function store(Request $request) {
        $form = new Like();
        $form->item_id      = $request->item_id;
        $form->type         = $request->type;
        if (auth()->user()) {
            $form->user_id  = auth()->user()->id ;
        }
        $form->star         = $request->star;
        $form->save();
        return redirect()->back()->withInput()->with('flash_message', ' امتیاز شما با موفقیت ثبت شد.');
    }

}
