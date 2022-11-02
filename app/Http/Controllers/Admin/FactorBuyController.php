<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Setting;
use App\Model\BasketFactor;
use App\Model\ServiceFactor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class FactorBuyController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'خرید ها';
        } elseif ('single') {
            return 'خرید ها';
        }
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     $items="";

    //     if (Auth::user()->hasRole('مدیر')){
    //         $items = BasketFactor::where('status','!=','pending')->orderBy('id','desc')->paginate($this->controller_paginate());
    //     }
    //     elseif (Auth::user()->hasRole('کاربر')){
    //         $items = BasketFactor::where('status','!=','pending')->where('user_id',Auth()->user()->id)->orderBy('id','desc')->where('status','!=','blocked')->paginate($this->controller_paginate());
    //     }
    //     return view('admin.factor.buy.index', compact('items'), ['title1' => 'خدمات', 'title2' => $this->controller_title('sum')]);
    // }

    public function index() {
        if (auth()->user()->hasRole('مدیر')) {
            $items = ServiceFactor::orderByDesc('id')->paginate($this->controller_paginate());
        }
        else {
            $items = ServiceFactor::where('user_id',auth()->user()->id)->orderByDesc('id')->paginate($this->controller_paginate());
        }
        return view('admin.factor.buy.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function edit($id) {
        if (auth()->user()->hasRole('مدیر')) {
            $item = ServiceFactor::findOrFail($id);
        }
        else {
            $item = ServiceFactor::where('user_id',auth()->user()->id)->findOrFail($id);
        }
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
            return redirect()->back()->withInput()->with('flash_message', ' سفارش در حال پردازش میباشد , تغییر وضعیت ممکن نیست.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در تغییر وضعیت سفارش بوجود آمده،مجددا تلاش کنید');
        }
    }


//    public function active($id, $type)
//    {
//        $item = ServiceFactor::find($id);
//        try {
//            $item->status = $type;
//            $item->update();
//            if ($type == 'cancel') {
//                return redirect()->back()->with('flash_message', ' با موفقیت کنسل شد.');
//            }
//            if ($type == 'working') {
//                return redirect()->back()->with('flash_message', ' با موفقیت تایید شد.');
//            }
//            if ($type == 'active') {
//                return redirect()->back()->with('flash_message', ' با موفقیت انجام شد.');
//            }
//        } catch (\Exception $e) {
//            return redirect()->back()->withInput()->with('err_message', 'مشکلی در تغییر وضعیت بوجود آمده،مجددا تلاش کنید');
//        }
//    }
}


