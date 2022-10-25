<?php

namespace App\Http\Controllers\Admin;

use App\Model\Bank;
use App\Model\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BanksController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function controller_title($type) {
        if ($type == 'sum') {
            return 'لیست بانک ها';
        } elseif ('single') {
            return 'لیست بانک ها';
        }
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function index() {
        $items = Bank::orderByDesc('id')->paginate($this->controller_paginate());
        return view('admin.banks.index', compact('items'), ['title1' => $this->controller_title('single') , 'title2' => $this->controller_title('sum')]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:240',
        ]);

        try {
            $item = new Bank();
            $item->title = $request->title;
            $item->save();
            return redirect()->route('admin.banks.index')->with('flash_message', 'با موفقیت ثبت شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function update(Request $request, $id) { 
        $item = Bank::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|max:240',
        ]);

        try {
            $item->title = $request->title;
            $item->save();
            return redirect()->route('admin.banks.index')->with('flash_message', 'با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function destroy($id) {
        JobOpportunity::findOrFail($id)->delete();
        return redirect()->back()->withInput()->with('flash_message',' با موفقیت حذف شد.');
    }

}
