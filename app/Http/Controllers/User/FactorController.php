<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Setting;
use App\Model\BasketFactor;
use App\Model\Service;
use App\Model\ServicePackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FactorBuyController extends Controller {

    public function controller_title($type) {
        if ($type == 'sum') {
            return 'سبد خریدها';
        } elseif ('single') {
            return 'سبد خرید';
        }
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $items = ServiceFactor::where('user_id',auth()->user()->id)->get();
        return view('admin.factor.buy.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function edit($id) {
        $item = ServiceFactor::findOrFail($id);
        try {
            if ($item->status=='cancel') {
                $item->status = 'pending';
                $item->update();
                return redirect()->back()->with('flash_message', ' با موفقیت تایید شد.');
            } elseif($item->status=='pending') {
                $item->status = 'cancel';
                $item->update();
                return redirect()->back()->with('flash_message', ' با موفقیت کنسل شد.');
            }
            return redirect()->back()->with('flash_message', ' سفارش در حال پردازش میباشد , تغییر وضعیت ممکن نیست.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در تغییر وضعیت سفارش بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function store(Request $request) {
        dd('');
        $type       = $request->type;
        $package_id = $request->id;
        $count      = $request->count;
        
        switch ($request->type) {
            case 'service':
                $item = Service::findOrFail($package_id);
                break;
            case 'package':
                $item = ServicePackage::findOrFail($package_id);
                break;
        }
        
        $price      = $item->price?$item->price:0;
        $all_price  = $price * $count;
        
        try {
            ServiceFactor::create([
                'user_id'       => auth()->user()->id,
                'type'          => $type,
                'package_id'    => $package_id,
                'count'         => $count,
                'all_price'     => $all_price,
            ]);
            return redirect()->back()->with('flash_message', 'سفارش با موفقیت ثبت شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ثبت سفارش بوجود آمده،مجددا تلاش کنید');
        }
    }

}

