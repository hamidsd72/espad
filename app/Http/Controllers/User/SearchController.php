<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Service;
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
 
    // public function search(Request $request)  {
    //     if ($request->search) {
    //         $users      = User::where('last_name', 'like' , '%'. $request->search .'%')->role('مدرس')->pluck('id');
    //         $ServiceCat = ServiceCat::where('title', 'like' ,'%'. $request->search .'%')->where('type','sub_service')->first();
    //         if ($users->count()) {
    //             $items1 = Service::where('status', 'active')->whereIn('user_id',$users)->get();
    //             // online
    //             $items = $items1->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'));
    //             // offline
    //             $items2 = $items1->whereNotIn('id', $items->pluck('id'));
                
    //             if ($items->count() || $items2->count()) {
    //                 if ($request->route=='web') {
    //                     $data = Data::where("page_name", "مشاوران-شو")->where('status','active')->orderBy('sort')->get();
    //                     return view('user.consultation.categories.search', compact('items','items2','data'));
    //                 }
    //                 return view('user.services', compact('items','items2'))->with('flash_message', ' نمایش همه نتایج ');
    //             }
    //         } elseif ($ServiceCat) {
    //             $items1 = Service::where('status', 'active')->where('category_id', $ServiceCat->id)->get();
    //             // online
    //             $items = $items1->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'));
    //             // offline
    //             $items2 = $items1->whereNotIn('id', $items->pluck('id'));
                
    //             if ($items->count() || $items2->count()) {
    //                 if ($request->route=='web') {
    //                     $data = Data::where("page_name", "مشاوران-شو")->where('status','active')->orderBy('sort')->get();
    //                     return view('user.consultation.categories.search', compact('items','items2','data'));
    //                 }
    //                 return view('user.services', compact('items','items2'))->with('flash_message', ' نمایش همه نتایج ');
    //             }
    //         }
    //         return redirect()->back()->with('err_message', 'موردی یافت نشد');
    //     }
    //     return abort(403);
    // }

    public function search(Request $request)  {
        if ($request->type=='user') {
            $items = User::where('last_name', 'like' , '%'. $request->search .'%')->role('مدرس')->pluck('id');

            $items1 = Service::where('status', 'active')->whereIn('user_id',$items)->take(30)->get();
            // online
            $items = $items1->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'));
            // offline
            $items2 = $items1->whereNotIn('id', $items->pluck('id'));
            
            if ($items->count() || $items2->count()) {
                if ($request->route=='web') {
                    return view('user.consultation.categories.search', compact('items','items2'));
                }
                return view('user.services', compact('items','items2'))->with('flash_message', ' نمایش همه نتایج ');
            }        
        } else if ($request->type=='category') {
            $item = ServiceCat::where('title', 'like' ,'%'. $request->search .'%')->first();
            if ($item) {
                if ($request->route=='web') {
                    return redirect()->route('user.consultation.category',$item->slug);
                }
                return redirect()->route('user.services',$item->id);
            }
        } else if ($request->type=='consultation') {
            $items = ServiceCat::where('title', 'like' ,'%'. $request->search .'%')->where('type','sub_service')->get('id');
            $items1 = Service::where('status', 'active')->whereIn('category_id', $items->pluck('id'))->take(30)->get();
            // online
            $items = $items1->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'));
            // offline
            $items2 = $items1->whereNotIn('id', $items->pluck('id'));
            
            if ($items->count() || $items2->count()) {
                if ($request->route=='web') {
                    return view('user.consultation.categories.search', compact('items','items2'));
                }
                return view('user.services', compact('items','items2'))->with('flash_message', ' نمایش همه نتایج ');
            }
        }
        return redirect()->back()->with('err_message', 'موردی یافت نشد');
    }

    public function ajax_search($type, $search)  {
        if ($type=='user') {
            $items = User::where('last_name', 'like' , '%'. $search .'%')->role('مدرس')->pluck('id');
            $items = Service::whereNotIn('category_id',[53,57,58])->where('status', 'active')->whereIn('user_id',$items)->take(10)->get(['id','user_id','title','category_id']);
            $users = User::whereIn('id',$items->pluck('user_id'))->get(['id','first_name','last_name']);
            foreach ($items as $item) {
                if ($users->find($item->user_id)) {
                    $item->user_id = $users->find($item->user_id)->first_name.' '.$users->find($item->user_id)->last_name;
                }
            }
        } else if ($type=='category') {
            $items = ServiceCat::where('status', 'active')->where('title', 'like' ,'%'. $search .'%')->get('id');
            $items = ServiceCat::where('status', 'active')->where('type', 'sub_service')->whereIn('service_id', $items->pluck('id'))->take(10)->get(['id','title']);
        } else if ($type=='consultation') {
            $items = ServiceCat::where('title', 'like' ,'%'. $search .'%')->where('type','sub_service')->pluck('id');
            $items = Service::whereNotIn('category_id',[53,57,58])->where('status', 'active')->where('category_id', $items)->take(10)->get(['id','user_id','title','category_id']);
            $users = User::whereIn('id',$items->pluck('user_id'))->get(['id','first_name','last_name']);
            foreach ($items as $item) {
                if ($users->find($item->user_id)) {
                    $item->user_id = $users->find($item->user_id)->first_name.' '.$users->find($item->user_id)->last_name;
                }
            }
        }
        if ($items->count()) {
            return response()->json($items);
        } else {
            return response()->json(array('msg' => 'موردی یافت نشد'));
        }
    }
    
}
