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
use App\Model\Like;
use App\Model\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultationController extends Controller {

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

    public function index($slug=null) {
        $data = Data::where("page_name", "مشاوران")->where('status','active')->orderBy('sort')->get();
        $cats  = 0;
        if (! is_null($slug)) {
            $items = ServiceCat::where('slug', $slug)->orderBy('sort')->get();
            $cats  = $items;

            $sub_service = ServiceCat::where('status', 'active')->where('type', 'sub_service')->whereIn('service_id', $items->pluck('id') )->get();
            // اگر زیردسته داشت
            if ( $sub_service->count() ) {
                $items = $sub_service;
            }

            $slug = $cats->first()->slug;
            $cats = $cats->first()->service_id;

            $data = Data::where("page_name", $slug)->where('status','active')->orderBy('sort')->get();
            return view('user.consultation.index',compact('items','data','slug','cats'));
        } else {
            $items = ServiceCat::where('status', 'active')->where('slug','!=','کد-تخفیف')->where('type', 'service')->orderBy('sort')->get();
            return view('user.consultation.index',compact('items','data','slug','cats'));
        }
    }

    public function show($id) {
        // کسب و کارهای نوین -> معرفی کسب و کارهای نوین
        if ($id==81) {
            $id=345;
        }
        $item   = ServiceCat::findOrFail($id);
        $body   = Item::where("page_name", $item->slug)->get();
        $header = Data::where("page_name", $item->slug)->where('status','active')->get();
        if ( $item->slug!="دعاوی-حقوقی" && ServiceCat::where('status', 'active')->where('type', 'sub_service')->where('service_id', $item->id )->count()>0 ) {
            return redirect()->route('user.consultation.category',$item->slug);
        }
        // دعاوی-حقوقی
        if ($item->id==80) {
            $items1 = Service::where('status', 'active')->whereIn('category_id', ServiceCat::where('service_id',80)->pluck('id'))->paginate($this->controller_paginate());
        } else {
            $items1 = Service::where('status', 'active')->where('category_id', $id)->paginate($this->controller_paginate());
        }
        // online
        $items = $items1->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'));
        // offline
        $items2 = $items1->whereNotIn('id', $items->pluck('id'));
        if ($item->slug=="کد-تخفیف-") {
            return view('user.offCode.index', compact('item','header','body'));
        }
        return view('user.consultation.show', compact('item','items','items2','header','body','items1'));
    }

    public function edit($id) {
        $item = ServicePackage::where('slug', $id)->firstOrFail();
        $endItemSignUpDate  = Carbon::parse(j2g($this->toEnNumber($item->deleted_at)));
        if ($endItemSignUpDate->diffInDays(Carbon::now(), false) > 0) {
            $endItemSignUpDate = true;
        } else {
            $endItemSignUpDate = false;
        }
        $max  = Basket::where('type','package')->where('status','active')->where('sale_id',$item->id)->count();
        $users = User::whereIn('id',explode(',',$item->user_id))->get(['id','first_name','last_name']);
        return view('user.package.web.show', compact('item','max','endItemSignUpDate','users'));
    }

    public function profile($id) {
        $header     = Data::where("page_name", 'پروفایل-مشاور')->where('status','active')->get();
        $item       = Service::findOrFail($id);
        $services   = ServicePackage::where('status','active')->where('user_id',$item->user_id)->get();
        $comments   = Comment::where('type','consultation')->where('status','active')->where('item_id',$item->id)->orderByDesc('id')->get();
        $likes      = Like::where('type','consultation')->where('item_id',$item->id)->orderByDesc('id')->get();
        $status     = 'offline';
        if (Service::where('status', 'active')->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'))->where('id',$id)->count()) {
            $status = 'online';    
        }
        return view('user.consultation.profile.show', compact('item','status','comments','likes','services','header'));
    }

    public function profile2($id, $package) {
        $item       = Service::findOrFail($id);
        $services   = ServicePackage::where('status','active')->where('user_id',$item->user_id)->get();
        $comments   = Comment::where('type','consultation')->where('status','active')->where('item_id',$item->id)->orderByDesc('id')->get();
        $likes      = Like::where('type','consultation')->where('item_id',$item->id)->orderByDesc('id')->get();
        $status     = 'offline';
        if (Service::where('status', 'active')->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'))->where('id',$id)->count()) {
            $status = 'online';    
        }
        return view('user.consultation.categories.profile2', compact('item','package','status','comments','likes','services'));
    }

    public function profile3($id, $package) {
        $item       = Service::findOrFail($id);
        $services   = ServicePackage::where('status','active')->where('user_id',$item->user_id)->get();
        $comments   = Comment::where('type','consultation')->where('status','active')->where('item_id',$item->id)->orderByDesc('id')->get();
        $likes      = Like::where('type','consultation')->where('item_id',$item->id)->orderByDesc('id')->get();
        $status     = 'offline';
        if (Service::where('status', 'active')->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'))->where('id',$id)->count()) {
            $status = 'online';    
        }
        return view('user.consultation.categories.profile3', compact('item','package','status','comments','likes','services'));
    }

    public function profile4($id) {
        $item       = Service::findOrFail($id);
        $services   = ServicePackage::where('status','active')->where('user_id',$item->user_id)->get();
        $comments   = Comment::where('type','consultation')->where('status','active')->where('item_id',$item->id)->orderByDesc('id')->get();
        $likes      = Like::where('type','consultation')->where('item_id',$item->id)->orderByDesc('id')->get();
        $status     = 'offline';
        if (Service::where('status', 'active')->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'))->where('id',$id)->count()) {
            $status = 'online';    
        }
        $sub_items  = Item::where("page_name", 'پروفایل-دانش-بنیان')->where("service_id", $item->id)->get();
        return view('user.consultation.categories.profile4', compact('item','status','comments','likes','services','sub_items'));
    }

    public function startup($id) { 
        $item   = ServiceCat::findOrFail(81);
        $body   = Item::where("page_name", $item->slug)->findOrFail($id);
        return view('user.consultation.categories.startup-show', compact('item','body'));
    }

    public function evoke($id) {
        $item = Service::findOrFail($id);
        Evoke::create([
            "user_id"           => auth()->user()->id,
            "consultation_id"   => $item->user_id,
            "item_id"           => $id,
        ]);
        return redirect()->back()->withInput()->with('flash_message', 'هر موقع مشاور آنلاین شد برای شما پیامک ارسال میشود');
    }
}
