<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Service;
use App\Model\Data;
use App\Model\ServiceCat;
use Carbon\Carbon;

class SearchController extends Controller {
    // public function __construct() {
    //    $this->middleware('auth');
    // }

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
 
    public function search(Request $request)  {
        if ($request->search) {
            $users      = User::where('last_name', 'like' , '%'. $request->search .'%')->role('مدرس')->pluck('id');
            $ServiceCat = ServiceCat::where('title', 'like' ,'%'. $request->search .'%')->where('type','sub_service')->first();
            if ($users->count()) {
                $items1 = Service::where('status', 'active')->whereIn('user_id',$users)->get();
                // online
                $items = $items1->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'));
                // offline
                $items2 = $items1->whereNotIn('id', $items->pluck('id'));
                
                if ($items->count() || $items2->count()) {
                    if ($request->route=='web') {
                        $data = Data::where("page_name", "مشاوران-شو")->where('status','active')->orderBy('sort')->get();
                        return view('user.consultation.categories.search', compact('items','items2','data'));
                    }
                    return view('user.services', compact('items','items2'))->with('flash_message', ' نمایش همه نتایج ');
                }
            } elseif ($ServiceCat) {
                $items1 = Service::where('status', 'active')->where('category_id', $ServiceCat->id)->get();
                // online
                $items = $items1->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'));
                // offline
                $items2 = $items1->whereNotIn('id', $items->pluck('id'));
                
                if ($items->count() || $items2->count()) {
                    if ($request->route=='web') {
                        $data = Data::where("page_name", "مشاوران-شو")->where('status','active')->orderBy('sort')->get();
                        return view('user.consultation.categories.search', compact('items','items2','data'));
                    }
                    return view('user.services', compact('items','items2'))->with('flash_message', ' نمایش همه نتایج ');
                }
            }
            return redirect()->back()->with('err_message', 'موردی یافت نشد');
        }
        return abort(403);
    }
}