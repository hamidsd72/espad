<?php

namespace App\Http\Controllers\User;

use App\Model\ServicePackage;
use App\Model\Sms; 
use App\Model\Setting; 
use App\User;
use App\Model\Basket;
use App\Model\Data;
use App\Model\Service;
use App\Model\ServiceCat;
use App\Model\Evoke;
use Carbon\Carbon;
use App\Model\Comment;
use App\Model\ServiceFactor;
use App\Model\Like;
use App\Model\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller {

    public function today($type) {
        switch (Carbon::now()->dayName) {
            case 'شنبه':
                $today      = 'shanbe';
                $e_today    = 'e_shanbe';
                break;
            case 'یکشنبه':
                $today      = 'yekshanbe';
                $e_today    = 'e_yekshanbe';
                break;
            case 'دوشنبه':
                $today      = 'doshanbe';
                $e_today    = 'e_doshanbe';
                break;
            case 'سه‌شنبه':
                $today      = 'seshanbe';
                $e_today    = 'e_seshanbe';
                break;
            case 'چهارشنبه':
                $today      = 'chaharshanbe';
                $e_today    = 'e_chaharshanbe';
                break;
            case 'پنجشنبه':
                $today      = 'panjshanbe';
                $e_today    = 'e_panjshanbe';
                break;
            case 'جمعه':
                $today      = 'jome';
                $e_today    = 'e_jome';
                break;
            default:
                break;
        }
        if ($type=='start') {
            return $today;
        }
        return $e_today;
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function toEnNumber($input) {
        $replace_pairs = array(
              '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
              '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'
        );
        
        return strtr( $input, $replace_pairs );
    }

    public function index() {
    //     $items = Item::all();
    //     $page_name = ServiceCat::whereIn('slug',$items->pluck('page_name'))->get(['id','slug']);
    //     foreach ($items as $item) {
    //         if ($page_name->where('slug',$item->page_name)->first()) {
    //             $item->page_id = $page_name->where('slug',$item->page_name)->first()->id;
    //             $item->save();
    //         }
    //     }
    //     dd('');
        $item       = ServiceCat::findOrFail(96);
        $data       = Data::where("page_id", 96)->where('status','active')->orderBy('sort')->get();
        $items      = Service::where('status', 'active')->whereIn('category_id', ServiceCat::where('status', 'active')->where('type', 'sub_service')->where('service_id', 96 )->pluck('id'))->get();
        return view('user.consultation.store.index', compact('item','items','data'));
    }

    public function show($id) {
        $item       = ServiceCat::where('status', 'active')->findOrFail($id);
        $data       = Data::where("page_id", 96)->where('status','active')->orderBy('sort')->get();
        $items      = Service::where('status', 'active')->where('category_id', $id )->get();
        return view('user.consultation.store.index', compact('id','item','items','data'));
    }

    public function edit($id) {
        $item       = Service::findOrFail($id);
        $header     = Data::where("page_name", 96)->where('status','active')->get();
        $status     = 'offline';
        if (Service::where('status', 'active')->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'))->where('id',$id)->count()) {
            $status = 'online';    
        }
        return view('user.consultation.store.show', compact('item','header','status'));
    }

    public function store(Request $request) {
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
        
        $price      = $item->price?intval($item->price):0;
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
