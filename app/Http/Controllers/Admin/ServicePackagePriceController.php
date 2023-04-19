<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\ServicePackagePrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicePackagePriceController extends Controller {

    public function controller_paginate() {
        return Setting::firstOrFail('paginate')->paginate;
    }

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $items = ServicePackagePrice::orderByDesc('id')->get();
        return view('admin.service.package.price.index', compact('items'), ['title1' => 'افزودن پکیج سبد سهام', 'title2' => 'لیست قیمت : ']);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'day'   => 'required',
            'price' => 'required',
        ],
            [
                'title.required' => 'لطفا عنوان را وارد کنید',
                'day.required'  => 'لطفا روز را وارد کنید',
                'price.required' => 'لطفا قیمت را وارد کنید',
            ]);
        try {
            $item = new ServicePackagePrice();
            $item->title        = $request->title;
            $item->day          = $request->day;
            $item->price        = $request->price;
            $item->off_price    = $request->off_price;
            $item->save();
            return redirect()->back()->with('flash_message', '  با موفقیت ایجاد شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ایجاد قیمت پکیج بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function destroy($id) {
        $item = ServicePackagePrice::findOrFail($id);
        try {
            $item->delete();
            return redirect()->back()->with('flash_message', ' با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در حذف قیمت پکیج بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function sort(Request $request) {

        $item = ServicePackagePrice::findOrFail($request->id);
        try {
            $item->sort = $request->sort;
            $item->update();
            return redirect()->back()->with('flash_message', 'ترتیب با موفقیت تغییر کرد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در تغییر ترتیب بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function active($id,$type) {

        $item = ServicePackagePrice::findOrFail($id);
        try {
            $item->status = $type;
            $item->update();
            if ($type == 'pending') return redirect()->back()->with('flash_message', 'نمایش قیمت با موفقیت غیرفعال شد.');
            if ($type == 'active') return redirect()->back()->with('flash_message', 'نمایش قیمت با موفقیت فعال شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در تغییر وضعیت قیمت پکیج بوجود آمده،مجددا تلاش کنید');
        }
    }
}


