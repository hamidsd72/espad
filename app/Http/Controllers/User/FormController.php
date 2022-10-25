<?php

namespace App\Http\Controllers\User;

use App\Model\UserForm;
use App\Model\Setting;
use App\Model\Sms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormController extends Controller {
    public function controller_title($type) {
        if ($type == 'sum') {
            return ' فرم ها و قرارداد ها';
        } elseif ('single') {
            return ' فرم و قرارداد';
        }
    }


    public function __construct() {
        $this->middleware('auth');
    } 

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function index() {   
        $items = UserForm::orderByDesc('id')->where('user_id',auth()->user()->id)->orderByDesc('id')->paginate($this->controller_paginate());
        if (auth()->user()->hasRole('مدیر'))
        {
            $items = UserForm::orderByDesc('id')->where("pay_status" , "active")->paginate($this->controller_paginate());
            return view('admin.admin-form.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
        }
        return view('user.user-form.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    } 

    public function edit($id) {
        $item = UserForm::where('user_id',auth()->user()->id)->findOrFail($id);
        if (auth()->user()->hasRole('مدیر')) {
            $item = UserForm::findOrFail($id);
            return view('admin.admin-form.show', compact('item'), ['title1' => $item->form_type, 'title2' =>$item->form_type]);
        }
        return view('user.user-form.show', compact('item'), ['title1' => $item->form_type, 'title2' =>$item->form_type]);
    }

    public function store(Request $request) {
        $form = new UserForm();
        $form->item_id      = $request->item_id;
        $form->type         = $request->type;
        $form->title        = $request->title;
        $form->cons_id      = $request->cons_id;
        if (auth()->user()) {
            $form->user_id  = auth()->user()->id ;
        }
        $form->name         = $request->name;
        $form->uuid         = $request->uuid;
        $form->mobile       = $request->mobile;
        $form->code         = $request->code;
        if ($request->subject) {
            $form->text     = $request->subject.' '.$request->text;
        } else {
            $form->text     = $request->text;
        }

        if ($request->hasFile('attach')) {
            $form->attach = file_store($request->attach, 'source/asset/uploads/form/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/forms/', 'form-');
        }
        $form->save();
        Sms::SendSms( ' یک فرم ارسال شد ' , env('ADMIN_MOBILE'));
        return redirect()->back()->withInput()->with('flash_message', ' درخواست با موفقیت ثبت شد.');
    }

}
