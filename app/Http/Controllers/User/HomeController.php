<?php

namespace App\Http\Controllers\User;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Slider;
use App\Model\ServiceCat;
use App\Model\About;
use App\Model\AboutJoin;
use App\Model\Service;
use App\Model\OffCode;
use App\Model\ServicePackage;
use App\Model\ServiceBuy;
use App\Model\ServiceFactor;
use App\Model\ServicePlus;
use App\Model\ServicePlusBuy;
use App\Model\Network;
use App\Model\ServicePackagePrice;
use Illuminate\Support\Facades\Auth;
use App\Model\Setting;
use App\Model\Contact;
use App\Model\Evoke;
use App\Model\Comment;
use App\Model\Sms;
use App\Model\Like;
use App\Model\Basket;
use Carbon\Carbon;

class HomeController extends Controller {

    public function __construct()
    {
       $this->middleware('auth');
    }

    public function toEnNumber($input) {
        $replace_pairs = array(
              '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
              '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'
        );
        
        return strtr( $input, $replace_pairs );
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }
    
    function fa_number($number) {
        $arr = array();
        for ($i=0; $i < strlen($number); $i++) { 
            switch ($number) {
                case $number[$i] == "0":
                    array_push($arr, "۰" );
                break;
                case $number[$i] == "1":
                    array_push($arr, "۱" );
                break;
                case $number[$i] == "2":
                    array_push($arr, "۲" );
                break;
                case $number[$i] == "3":
                    array_push($arr, "۳" );
                break;
                case $number[$i] == "4":
                    array_push($arr, "۴" );
                break;
                case $number[$i] == "5":
                    array_push($arr, "۵" );
                break;
                case $number[$i] == "6":
                    array_push($arr, "۶" );
                break;
                case $number[$i] == "7":
                    array_push($arr, "۷" );
                break;
                case $number[$i] == "8":
                    array_push($arr, "۸" );
                break;
                case $number[$i] == "9":
                    array_push($arr, "۹" );
                break;
            
                default:
                    array_push($arr, $number[$i] );
            } 
        }
        return implode("",$arr);
    }

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
    
    public function index() {
        $sliders        = Slider::whereIn('status', ['in_app','in_all'])->get();
        $about          = About::first();
        $joins          = AboutJoin::where('type','about')->get();
        // $customers  = Custom::where('status','active')->get();
        $serviceCat     = ServiceCat::where('view', 'header')->where('status', 'active')->where('slug','!=','کد-تخفیف')->where('type', 'service')->orderBy('sort')->get();
        $serviceCat2    = ServiceCat::where('view', 'body')->where('status', 'active')->where('slug','!=','کد-تخفیف')->where('type', 'service')->orderBy('sort')->get();
        $packages       = ServicePackage::where('type','sample')->orderByDesc('id')->where('status', 'active')->where('home_view', 1)->get();
        // $gold_package = ServicePackage::where('status', 'active')->where('custom', 1)->first();
        // $service_custom = Service::all();
        $network = Network::where('status', 'active')->orderBy('sort')->get();

        $evokes = Evoke::where( 'consultation_id',auth()->user()->id )->where('notify','در انتظار ارسال')->get(['id','user_id','notify']);
        foreach ($evokes as $evoke) {
            $user = User::find($evoke->user_id);
            if ($user && $user->mobile) {
                // Sms::SendSms( 'مشاور مورد نظر آنلاین شد' , $user->mobile);
            }
            $evoke->notify = 'ارسال شده';
            $evoke->update();
        }
        return redirect()->route('user.home-goust');
        
        return view('user.index', compact('serviceCat2','serviceCat','sliders', 'about', 'joins', 'packages','network'));
    }
    
    public function tickets() {
        $items = Contact::where('category','!=','رسید پرداخت')->where('user_id', Auth::user()->id )->where('belongs_to_item', '=', 0)->orderBy('id','desc')->paginate(10);
        foreach ($items as $item) {
            $item->mobile = Contact::where('belongs_to_item', $item->id )->count();
        }
        $serviceCat = ServiceCat::where('status', 'active')->get();
        return view('user.ticket.index', compact('items', 'serviceCat')); 
    }
    
    public function web_tickets() { 
        $items = Contact::whereNotIn('category',['رسید پرداخت','کد تخفیف','کاربر ویژه'])->where('user_id', Auth::user()->id )->where('belongs_to_item', '=', 0)->orderBy('id','desc')->paginate(10);
        foreach ($items as $item) {
            $item->mobile = Contact::where('belongs_to_item', $item->id )->count();
        }
        $serviceCat = ServiceCat::where('status', 'active')->get();
        return view('user.ticket.web.index', compact('items', 'serviceCat')); 
    }
    
    public function show_ticket($id) 
    {
        $item = Contact::where('user_id', Auth::user()->id )->where('id',$id)->first();
        try {
            $items = Contact::where('belongs_to_item', $item->id )->orderBy('id','desc')->paginate(10);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('err_message', 'فایل مورد نظر یافت نشد لطفا مجدد تلاش فرمائید');
        }
        $serviceCat = ServiceCat::where('status', 'active')->where('title', $item->category)->first();
        return view('user.ticket.show', compact('item','items','serviceCat')); 
    }

    public function web_show_ticket($id) 
    {
        $item = Contact::where('user_id', Auth::user()->id )->where('id',$id)->first();
        try {
            $items = Contact::where('belongs_to_item', $item->id )->orderBy('id','desc')->paginate(10);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('err_message', 'فایل مورد نظر یافت نشد لطفا مجدد تلاش فرمائید');
        }
        $serviceCat = ServiceCat::where('status', 'active')->where('title', $item->category)->first();
        return view('user.ticket.web.show', compact('item','items','serviceCat')); 
    }

    public function services($cat_id) {
        $ServiceCat = ServiceCat::where('id', $cat_id)->firstOrFail();
        // مشگل تصویر زیردسته های اوراق بهادار
        if ($ServiceCat->service_id==83) {
            $ServiceCat->pic = ServiceCat::findOrFail(83)->pic;
        }
        $SubService = ServiceCat::where('status','active')->where('service_id', $ServiceCat->id)->where('type','sub_service')->get();
        return view('user.services', compact('ServiceCat','SubService'));
    }

    public function subServices($cat_id)  {
        $item = ServiceCat::findOrFail($cat_id);

        if ( $item->slug!="دعاوی-حقوقی" && ServiceCat::where('status', 'active')->where('type', 'sub_service')->where('service_id', $item->id )->count()>0 ) {
            return redirect()->route('user.services',$item->id);
        }
        
        $ServiceCat = ServiceCat::where('id', $cat_id)->where('type','sub_service')->firstOrFail();
        // all
        $items1 = Service::where('status', 'active')->where('category_id', $ServiceCat->id)->paginate($this->controller_paginate());
        // online
        $items = $items1->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'));
        // offline
        $items2 = $items1->whereNotIn('id', $items->pluck('id'));
        if ( in_array( $ServiceCat->slug, ["میزگرد-عمومی","میزگرد-تخصصی"] )) {
            $items = ServicePackage::where('status','active')->where('title', 'like' ,'%'. $ServiceCat->title .'%')->get();
            return view('user.package.index', compact('items','ServiceCat'));
        } elseif ( in_array( $ServiceCat->slug, ["کارگاه-های-تخصصی","معرفی-اساتید"] )) {
            $items = ServicePackage::where('status','active')->whereIn('user_id',$items1->pluck('user_id'))->where('reagent_id',$items1->pluck('id'))->get();
            return view('user.package.index', compact('items','ServiceCat'));
        }

        return view('user.services', compact('items','items2','ServiceCat','items1'));
    }

    public function subServices2($cat_id)  {
        if ($cat_id==81) {
            $cat_id=345;
        }
        $ServiceCat = ServiceCat::findOrFail($cat_id);
        if ($ServiceCat->id==80) {
            $items1 = Service::where('status', 'active')->whereIn('category_id', ServiceCat::where('service_id',80)->pluck('id'))->get();
        } else {
            $items1 = Service::where('status', 'active')->where('category_id', $cat_id)->get();
        }
        // online
        $items = $items1->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'));
        // offline
        $items2 = $items1->whereNotIn('id', $items->pluck('id'));
        return view('user.services', compact('items','items2','ServiceCat'));
    }

    public function service($id,$slug) {

        $item = Service::findOrFail($id);
        $ServiceCat = ServiceCat::where('id', $item->category_id)->first();
        $item       = Service::findOrFail($id);
        $services   = ServicePackage::where('status','active')->where('user_id',$item->user_id)->get();
        $comments   = Comment::where('type','consultation')->where('status','active')->where('item_id',$item->id)->orderByDesc('id')->get();
        $likes      = Like::where('type','consultation')->where('item_id',$item->id)->orderByDesc('id')->get();
        $status     = 'offline';
        if (Service::where('status', 'active')->where( $this->today('start') ,'<',Carbon::now()->format('H:i'))->where( $this->today('end') ,'>',Carbon::now()->format('H:i'))->where('id',$id)->count()) {
            $status = 'online';    
        }
        // if ($item->category_id && ServiceCat::find($item->category_id) && ServiceCat::find($item->category_id)->service_id==81) {
        //     return view('user.service.startup', compact('item','ServiceCat','status','comments','likes','services'));
        // } else
        if ($item->category_id && ServiceCat::find($item->category_id) && ServiceCat::find($item->category_id)->service_id==96) {
            return view('user.service.store', compact('item','ServiceCat','status','comments','likes','services'));
        }

        return view('user.service.show', compact('item','ServiceCat','status','comments','likes','services'));
    }

    public function packages_category()
    {
        $items = ServiceCat::where('type', 'package')->orderBy('id', 'ASC')->where('id', '!=', 4)->get();
        return view('user.package.category', compact('items'));
    }

    public function packages()
    { 
        $items = ServicePackage::where('status', 'active')->get();

        return view('user.package.index', compact('items'));
    }

    public function package($slug)
    {
        $item = ServicePackage::where('slug', $slug)->firstOrFail();
        $endItemSignUpDate = Carbon::parse(j2g($this->toEnNumber($item->deleted_at)));
        if (Carbon::now()->diffInDays($endItemSignUpDate) > 0) {
            $endItemSignUpDate = true;
        } else {
            $endItemSignUpDate = false;
        }
        $max = Basket::where('type','package')->where('status','active')->where('sale_id',$item->id)->count();
        return view('user.package.show', compact('item','endItemSignUpDate','max'));

        /*    if($item->type=='learning')
        {
        }
        elseif($item->type=='sample')
        {
            $gold_package = ServicePackage::where('status', 'active')->where('custom', 1)->first();
            $service_custom = Service::where('category_id', '!=', 4)->whereNotIn('id', $gold_package->joins->pluck('service_id'))->get();
            return view('user.package.show', compact('item','service_custom'));
        }*/
    }

    public function reserve($type, $slug)
    {
        if ($type == "package") {
            $item = ServicePackage::where('slug', $slug)->first();
        } elseif ($type == 'service') {
            $item = Service::where('slug', $slug)->first();
        }
        if (isset($item)) {
            try {

                $service_buy = new ServiceBuy();
                $service_buy->buy_id = $item->id;
                $service_buy->buy_type = $type;
                $service_buy->buy_id = $item->id;
            } catch (\Exception $error) {
                return redirect()->back()->withInput()->with('err_message', 'مشکلی به وجود آمده، لطفا با پشتیبانی تماس بگیرید.');
            }

        } else {
            return redirect()->back()->withInput()->with('err_message', 'سرویس مورد نظر یافت نشد لطفا مجدد تلاش فرمائید');

        }

    }

    public function validation_email(Request $request)
    {
        $p_id = $request->get('p_id');
        $star = $request->get('value_star');
        return response()->json(['success1' => true, 'p' => $p_id]);

    }

    public function login_package_buy(Request $request, $slug, $price_id = null)
    {
        if (!is_null($price_id)) {
            session(['price_id' => $price_id]);
        }
        session(['package_slug' => $slug]);
        if (isset($request->service)) {
            session(['service_gold' => $request->service]);
        }

        if (isset($request->plus)) {
            session(['plus' => $request->plus]);
        }
        if (Auth::check()) {
            $off_code=OffCode::where('code',$request->off_code)->where('status','active')->first();
            //isset code
            if($off_code)
            {
                // not used code
                if($off_code->used=='no')
                {
                    // used code all user
                    if($off_code->user_id==0)
                    {
                        $factor=ServiceFactor::where('user_id',Auth::user()->id)->where('off_code',$request->off_code)->wherein('pay_status',['paid','credit'])->first();
                        //used user code all user
                        if(!$factor)
                        {
                            session(['off_id' => $off_code->id]);
                        }

                    }
                    // used code personal user
                    else {
                        if($off_code->user_id==Auth::user()->id) {
                            session(['off_id' => $off_code->id]);
                        }
                    }
                }
            }
            return redirect()->route('user.package.buy');
        }
        if ($request->type == "login") {
            return redirect()->route('login');
        } else {
            return redirect()->route('user.mobile');
        }
    }

    public function package_buy()
    {
        $order_code = 10001;
        $slug = '';
        $service_gold = '';
        $plus = "";
        $plus_price = 0;

        if (session()->has('package_slug')) {
            $slug = session('package_slug');
            if (session()->has('plus')) {
                $plus = session('plus');
            }
            if (session()->has('service_gold')) {
                $service_gold = session('service_gold');
            }
            $package = ServicePackage::where('slug', $slug)->first();
            if ($service_gold != "") {
                if ($package->custom_service_count < count($service_gold)) {
                    return redirect()->route('user.index')->with('err_message', 'دوست عزیز ; موردی مشکوک به ساختارشکنی مشاهده شده ، لطفا مجدد و با شرایط درست اقدام فرمائید ');
                }
            }
            if (session()->has('price_id')) {
                $package_price = ServicePackagePrice::find(session('price_id'));
            }
            try {
                $item = ServiceFactor::latest()->first();
                if ($item) {
                    $order_code = intval($item->order_code) + intval(rand(10, 100));
                }
                $factor = new ServiceFactor();
                $factor->order_code = $order_code;
                $factor->user_id = Auth()->user()->id;
                if (isset($package_price)) {
                    $factor->all_price = $package_price->price;
                    $factor->month_time = $package_price->month_time;
                } else {
                    $factor->all_price = $package->price;
                }
                $factor->package_id = $package->id;
                $factor->type = 'package';
                if ($package->custom == 1) {
                    $factor->custom = 1;
                }
                $factor->save();
                foreach ($package->join as $service) {
                    $servide_buy = new ServiceBuy();
                    $servide_buy->factor_id = $factor->id;
                    $servide_buy->price = $service->price;
                    $servide_buy->buy_id = $service->id;
                    $servide_buy->save();
                    if ($plus != "" and count($plus) > 0) {
                        foreach ($plus as $plu) {
                            $item_plus = ServicePlus::find($plu);
                            if (isset($item_plus) and $item_plus->service->id == $service->id) {
                                $new_plus = new ServicePlusBuy ();
                                $new_plus->service_id = $service->id;
                                $new_plus->plus_id = $item_plus->id;
                                $new_plus->price = $item_plus->price;
                                $new_plus->factor_id = $factor->id;
                                $new_plus->buy_id = $servide_buy->id;
                                $new_plus->user_id = auth()->user()->id;
                                $new_plus->save();
                                $plus_price += $item_plus->price;
                            }
                        }
                    }
                }

                if ($package->custom == 1) {
                    if ($service_gold != null) {
                        $service_arry = [];
                        foreach ($service_gold as $serv) {
                            array_push($service_arry, $serv);
                            $service_golds = Service::whereIn('id', $service_arry)->get();
                        }
                        foreach ($service_golds as $service) {
                            $servide_buy = new ServiceBuy();
                            $servide_buy->factor_id = $factor->id;
                            $servide_buy->price = $service->price;
                            $servide_buy->buy_id = $service->id;
                            $servide_buy->type = 1;
                            $servide_buy->save();
                            if ($plus != '' and count($plus) > 0) {
                                foreach ($plus as $plu) {
                                    $item_plus = ServicePlus::find($plu);
                                    if (isset($item_plus) and $item_plus->service->id == $service->id) {
                                        $new_plus = new ServicePlusBuy ();
                                        $new_plus->service_id = $service->id;
                                        $new_plus->plus_id = $item_plus->id;
                                        $new_plus->price = $item_plus->price;
                                        $new_plus->factor_id = $factor->id;
                                        $new_plus->buy_id = $servide_buy->id;
                                        $new_plus->user_id = auth()->user()->id;
                                        $new_plus->save();
                                        $plus_price += $item_plus->price;
                                    }
                                }
                            }
                        }
                    }
                }
                $factor->all_price += $plus_price;
                $factor->save();
                //off code set
                if (session()->has('off_id')) {
                    $off_code=OffCode::where('id',session('off_id'))->where('used','no')->where('status','active')->first();
                    if($off_code)
                    {
                        if($off_code->user_id==0)
                        {
                            $factor_set=ServiceFactor::where('user_id',Auth::user()->id)->where('off_code',$off_code->code)->wherein('pay_status',['paid','credit'])->first();
                            if(!$factor_set)
                            {
                                $total=$factor->all_price-($factor->all_price*$off_code->percent)/100;
                                $factor->off_code=$off_code->code;
                                $factor->off_percent=$off_code->percent;
                                $factor->total=$total;
                                $factor->save();
                            }
                        }
                        else {
                            if($off_code->user_id==Auth::user()->id)
                            {
                                $total=$factor->all_price-($factor->all_price*$off_code->percent)/100;
                                $factor->off_code=$off_code->code;
                                $factor->off_percent=$off_code->percent;
                                $factor->total=$total;
                                $factor->save();
                            }
                        }
                    }
                }
                session()->forget('package_slug');
                session()->forget('service_gold');
                session()->forget('plus');
                if (session()->has('price_id')) {
                    session()->forget('price_id');
                }
                if (session()->has('off_id')) {
                    session()->forget('off_id');
                }
                if (auth()->user()->reagent_code == 'rytl_user' || auth()->user()->sim == 'rightel') {
                    return redirect()->route('user.refah.pay', [$factor->id, "package"]);
                }
                if(!is_null($factor->total))
                {
                    return redirect()->route('user.zarinpal-pay-user', [$factor->id, $factor->total, auth()->user()->id, "package"]);
                }
                else {
                    return redirect()->route('user.zarinpal-pay-user', [$factor->id, $factor->all_price, auth()->user()->id, "package"]);
                }
            } catch (\Exception $e) {
                session()->forget('package_slug');
                session()->forget('service_gold');
                session()->forget('plus');
                if (session()->has('price_id')) {
                    session()->forget('price_id');
                }
                if (session()->has('off_id')) {
                    session()->forget('off_id');
                }
                return redirect()->back()->with('err_message','عملیات با مشکل مواجه شد، مجددا تلاش بفرمایید(catch)');
            }

        }
        session()->forget('package_slug');
        session()->forget('service_gold');
        session()->forget('plus');
        if (session()->has('price_id')) {
            session()->forget('price_id');
        }
        if (session()->has('off_id')) {
            session()->forget('off_id');
        }
        return redirect()->back()->with('err_message','عملیات با مشکل مواجه شد، مجددا تلاش بفرمایید(session)');
    }

    public function off_check($code,$price,Request $request)
    {
        $off_code=OffCode::where('code',$code)->where('status','active')->first();
        //isset code
        if($off_code)
        {
            // not used code
            if($off_code->used=='no')
            {
                // used code all user
                if($off_code->user_id==0)
                {
                    $factor=ServiceFactor::where('user_id',Auth::user()->id)->where('off_code',$code)->wherein('pay_status',['paid','credit'])->first();
                    //used user code all user
                    if($factor)
                    {
                        return
                            [
                                'type'=>'danger',
                                'msg'=>'کد تخفیف توسط شما استفاده شده',
                            ];
                    }
                    $total=$price-($price*$off_code->percent)/100;
                    return
                        [
                            'type'=>'success',
                            'percent'=>$off_code->percent,
                            'total'=>$total,
                            'msg'=>'کد تخفیف اعمال شد',
                        ];
                }
                // used code personal user
                else {
                    if($off_code->user_id==Auth::user()->id) {
                        $total=$price-($price*$off_code->percent)/100;
                        return
                            [
                                'type'=>'success',
                                'percent'=>$off_code->percent,
                                'total'=>$total,
                                'msg'=>'کد تخفیف اعمال شد',
                            ];
                    }
                    else {
                        return
                            [
                                'type'=>'danger',
                                'msg'=>'کد تخفیف اشتباه می باشد',
                            ];
                    }
                }
            }
            // used code Check out the credit
            else {
                return
                    [
                        'type'=>'danger',
                        'msg'=>'اعتبار کد تخفیف به اتمام رسیده',
                    ];
            }
        }
        // not code
        else {
            return
            [
                'type'=>'danger',
                'msg'=>'کد تخفیف اشتباه می باشد',
            ];
        }
    }
}
