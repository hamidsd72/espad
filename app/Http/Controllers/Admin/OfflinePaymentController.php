<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\User;
use App\Model\Setting;
use App\Model\Basket;
use App\Model\OfflinePayment;
use App\Model\Sms; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Model\Notification;

class OfflinePaymentController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return ' لیست درخواست ها';
        } elseif ('single') {
            return ' درخواست ';
        }
    } 

    public function controller_paginate()
    {
        $settings = Setting::select('paginate')->latest()->firstOrFail();
        return $settings->paginate;
    }

    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }
  
    public function index($type=null) {
        if ($type=='pending') {
            if (auth()->user()->hasRole('مدیر')) {
                $items = OfflinePayment::where('status', 'pending')->paginate($this->controller_paginate());
            }
            else {
                $items = OfflinePayment::where('status', 'pending')->where('user_id',auth()->user()->id)->paginate($this->controller_paginate());
            } 
        } else {
            if (auth()->user()->hasRole('مدیر')) {
                $items = OfflinePayment::where('status', '!=', 'pending')->paginate($this->controller_paginate());
            }
            else {
                $items = OfflinePayment::where('status', '!=', 'pending')->where('user_id',auth()->user()->id)->paginate($this->controller_paginate());
            } 
        }

        return view('admin.offline_payment.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function action($id , $type) {

        if (auth()->user()->hasRole('مدیر')) {
            $item   = OfflinePayment::where('status', 'pending')->findOrFail($id);

            if ($item->model_type=='App\Model\ServicePackage') {
                $service    = \App\Model\ServicePackage::findOrFail($item->item_id);
            } else abort('403');

            $notife = new Notification();
            $notife->user_id = $item->user_id;
            $item->admin_id = auth()->id();

            if ($type=='reject') {
                $notife->subject = 'عدم تایید فیش پرداخت آفلاین';
                $notife->description = 'لطفا اطلاعات فیش را بررسی و مجددا از طریق درگاه آفلاین ارسال کنید';
                $item->status = 'deactive';
            } else {
                $notife->subject = 'تایید فیش پرداخت آفلاین';
                $notife->description = 'فیش واریزی تایید و دسترسی سرویس فعال شد';
                $item->status = 'active';
                $this->add_basket( $service->id, $service->type, $service->price, $item->user_id );
            }

            $item->update();
            $notife->save();

            // Sms::SendSms( (' تایید رسید پرداخت شماره : '.$item->id) , env('ADMIN_MOBILE'));
            // Sms::SendSms( (' تایید رسید پرداخت شماره : '.$item->id) , $user->mobile);
            return redirect()->back()->with('flash_message', 'با موفقیت انجام شد.'); 
        }

        abort('503');
    }


    function add_basket($id, $type, $price, $user_id) {
        $items = Basket::where('user_id', $user_id)->where('sale_id',$id)->where('type',$type)->get();
        foreach ($items->where('status','!=','active') as $item) $item->delete();        
        if ($items->where('status','active')->count()) return redirect()->back()->withInput()->with('err_message', ' در پکیج های فعلی موجود می باشد');

        $basket = new Basket();
        $basket->user_id    = $user_id;
        $basket->sale_id    = $id;
        $basket->type       = 'package';
        $basket->status     = 'active';
        $basket->price      = $price;
        $basket->save();
    }
    
}


