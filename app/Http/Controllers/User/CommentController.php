<?php

namespace App\Http\Controllers\User;

use App\Model\Comment;
use App\Model\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Sms;

class CommentController extends Controller {
    public function controller_title($type) {
        if ($type == 'sum') {
            return ' تظرات';
        } elseif ('single') {
            return ' نظر';
        }
    }

    public function __construct() {
        $this->middleware('auth');
    } 

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function store(Request $request) {
        $form = new Comment();
        $form->item_id      = $request->item_id;
        $form->type         = $request->type;
        if (auth()->user()) {
            $form->user_id  = auth()->user()->id ;
        }
        if ($request->subject) {
            $form->text     = $request->subject.' '.$request->text;
        } else {
            $form->text     = $request->text;
        }
        $form->save();
        // Sms::SendSms( ' یک نظر ارسال شد ' , env('ADMIN_MOBILE'));
        return redirect()->back()->withInput()->with('flash_message', ' نظر شما با موفقیت ثبت شد.');
    }

}
