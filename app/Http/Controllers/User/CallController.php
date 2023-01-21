<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Model\ServiceCat;
use App\Model\Setting;
use App\Model\Service;
use App\Model\CallRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CallController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    public function controller_paginate()
    {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return ' تماس های من';
        } elseif ('single') {
            return ' بخش کاربران';
        }
    }
    public function request($service_id,$type)
    {
      $user=Auth::user();
        $service=Service::where('id',$service_id)->where('status', 'active')->first();
        if(!$service)
        {
            return redirect()->back()->with('call_message', 'مشاوره مد نظر شما یافت نشد');
        }
        if($service->user_id==auth()->id())
        {
            return redirect()->back()->with('call_message', 'این تماس امکان پذیر نمی باشد');
        }
        if(Auth::user()->amount<$service->price)
        {
            return redirect()->back()->with('call_message', 'موجودی شما برای برقراری تماس کافی نمی باشد');
        }

        $today=week_name_now()[0];
        $today_e=week_name_now()[1];

        if(str_replace(':','',$service->$today) > Carbon::now()->format('Hi') || str_replace(':','',$service->$today_e) < Carbon::now()->format('Hi'))
        {
            return redirect()->back()->with('call_message', 'مشاوره مد نظر آفلاین می باشد');
        }

        $call_request=CallRequest::where('user_id',Auth::id())->whereIN('status',['pending','doing'])->first();
        if($call_request)
        {
            return redirect()->back()->with('call_message', $call_request->status=='pending'?'شما یک تماس دارید،که منتظر پاسخ از طرف مشاور می باشد':'شما یک تماس دارید،که در حال حاضر برقرار می باشد');
        }
        $call_request1=CallRequest::where('consultant_id',$service->user_id)->whereIN('status',['pending','doing'])->first();
        if($call_request1)
        {
            return redirect()->back()->with('call_message', $call_request1->status=='pending'?'مشاور یک تماس دارد،که منتظر پاسخ از طرف مشاور می باشد':'مشاور یک تماس دارد،که در حال حاضر برقرار می باشد');
        }
        try {
            //$rev=intval($service->time)>0?intval($service->time):1;
          	$rev=round((int)auth()->user()->amount/(int)$service->price);
            //$price_min=$service->price/$rev;
          	$price_min=$service->price;
            $item=CallRequest::create([
               'unique_code'=>time().Auth::id().$service->user_id,
               'type'=>$type,
               'service_id'=>$service_id,
               'user_id'=>Auth::id(),
               'consultant_id'=>$service->user_id,
               //'price_service'=>$service->price,
              'price_service'=>$user->amount,
               //'time_service'=>$service->time,
              'time_service'=>$rev,
               'price_min'=>$price_min,
               'type_phone'=>str_contains(type_phone(),'iPhone')?'iphone':'no_iphone',
               'reload_answer'=>0,
               'reload_answer2'=>0,
            ]);

            //minuse amount
            
            //$user->amount-=$item->price_service;
          	$user->amount=0;
            $user->update();

            session(['back_url' => url()->previous()]);

            return redirect()->route('user.call.index',$item->unique_code)->with('call_message', 'درخواست تماس از طرف شما ثبت گردید، از صفحه خارج نشوید و منتظر پاسخ باشید');
        }catch (\Exception $e) {
         
            return redirect()->back()->withInput()->with('call_message', 'مشکلی بوجود آمده،مجددا تلاش کنید');
        }
    }
    public function index($unique_code,Request $request)
    {
        $call=CallRequest::where('unique_code',$unique_code)->whereIN('status',['pending','doing'])->first();
        if(!$call)
        {
            return redirect()->back()->withInput()->with('call_message', 'صفحه یافت نشد، مجددا تلاش کنید');
        }

        if($call->user_id==Auth::id())
        {
            $user1=User::find(Auth::id());
            $user2=User::find($call->consultant_id);
        }
        elseif($call->consultant_id==Auth::id())
        {
            $user1=User::find(Auth::id());
            $user2=User::find($call->user_id);
        }
        else
        {
            return redirect()->back()->withInput()->with('call_message', 'صفحه یافت نشد، مجددا تلاش کنید');
        }

        if($call->consultant_id == auth()->id())
        {
            $call->reload_answer2+=1;
            $call->update();
        }
        if($call->consultant_id == auth()->id())
        {
            $call->reload_answer+=1;
            $call->update();
        }
            $end_request=Carbon::parse($call->created_at)->addSeconds(20);
            $end_time=Carbon::parse($call->created_at)->addMinutes($call->time_service);
            $min_time=Carbon::now()->diffInSeconds($end_time,false);
            if($min_time<=0)
            {
                $call->status='end_time';
                $call->end_call=Carbon::now();
                $call->update();
                if($call->service)
                    return redirect()->route('user.subServices',$call->service->category_id)->with('call_message', 'زمان مشاوره پایان یافته');
                else
                    return redirect()->route('user.index')->with('call_message', 'زمان مشاوره پایان یافته');
            }
        return view('user.call.index', compact('user1','user2','unique_code','call','end_time','min_time','end_request'));
    }
    public function accept($unique_code,$status)
    {
        $cal=CallRequest::where('unique_code',$unique_code)->where('status','pending')->first();
        if(!$cal)
        {
            return redirect()->back()->withInput()->with('call_message', 'تماس یافت نشد، مجددا تلاش کنید');
        }
        if($cal->consultant_id!=Auth::id())
        {
            return redirect()->back()->withInput()->with('call_message', 'تماس یافت نشد، مجددا تلاش کنید');
        }

        $cal->status=$status;

        if($status=='doing')
            $cal->start_call=Carbon::now();
        else
            $cal->end_call_id=Auth::id();

        $cal->update();

        if($status=='blocked')
        {
            //return amount
            $user=$cal->user;
            if($user)
            {
                $user->amount+=$cal->price_service;
                $user->update();
            }
        }
        if($status=='doing')
        {
            session(['back_url' => url()->previous()]);
            return redirect()->route('user.call.index',$cal->unique_code)->with('call_message', 'درخواست تماس پاسخ داده شد منتظر ارتباط باشید');
        }
        else
            return redirect()->back()->with('call_message', 'درخواست تماس توسط شما رد شد');
    }
    public function end($unique_code)
    {
        $cal=CallRequest::where('unique_code',$unique_code)->first();
        if(!$cal)
        {
            return redirect()->back()->withInput()->with('call_message', 'تماس یافت نشد، مجددا تلاش کنید');
        }
        if($cal->user_id!=Auth::id() && $cal->consultant_id!=Auth::id())
        {
            return redirect()->back()->withInput()->with('call_message', 'تماس یافت نشد، مجددا تلاش کنید');
        }

        $old_status=$cal->status;

        $cal->status='end';
        if($old_status=='doing')
            $cal->end_call=Carbon::now();

        $cal->end_call_id=Auth::id();
        $cal->update();

        if($old_status=='doing')
        {
            $min_call=Carbon::parse($cal->start_call)->diffInSeconds(Carbon::parse($cal->end_call),false);

            $cal->price_call=(round($min_call/60,1))*$cal->price_min;
            $cal->update();

            //return amount
            $user=$cal->user;
            if($user)
            {
                $user->amount+=($cal->price_service-$cal->price_call);
                $user->update();
            }
        }
        elseif($old_status=='pending')
        {
            //return amount
            $user=$cal->user;
            if($user)
            {
                $user->amount+=$cal->price_service;
                $user->update();
            }
        }


        if (session()->has('back_url'))
            return redirect(session('back_url'))->with('call_message', ' تماس توسط شما پایان یافت');
        elseif($cal->service)
            return redirect()->route('user.subServices',$cal->service->category_id)->with('call_message', ' تماس توسط شما پایان یافت');
        else
            return redirect()->route('user.index')->with('call_message', ' تماس توسط شما پایان یافت');
    }
    public function end_not_device($unique_code)
    {
        $cal=CallRequest::where('unique_code',$unique_code)->first();
        if(!$cal)
        {
            return redirect()->back()->withInput()->with('call_message', 'تماس یافت نشد، مجددا تلاش کنید');
        }
        if($cal->user_id!=Auth::id() && $cal->consultant_id!=Auth::id())
        {
            return redirect()->back()->withInput()->with('call_message', 'تماس یافت نشد، مجددا تلاش کنید');
        }

        $old_status=$cal->status;

        $cal->status='end';
        if($old_status=='doing')
            $cal->end_call=Carbon::now();

        $cal->end_call_id=Auth::id();
        $cal->update();

        if($old_status=='doing')
        {
            $min_call=Carbon::parse($cal->start_call)->diffInSeconds(Carbon::parse($cal->end_call),false);

            $cal->price_call=(round($min_call/60,1))*$cal->price_min;
            $cal->update();

            //return amount
            $user=$cal->user;
            if($user)
            {
                $user->amount+=($cal->price_service-$cal->price_call);
                $user->update();
            }
        }
        elseif($old_status=='pending')
        {
            //return amount
            $user=$cal->user;
            if($user)
            {
                $user->amount+=$cal->price_service;
                $user->update();
            }
        }


        if (session()->has('back_url'))
            return redirect(session('back_url'))->with('call_message', ' تماس بعلت یافت نشدن دستگاه میکروفن قطع شد');
        elseif($cal->service)
            return redirect()->route('user.subServices',$cal->service->category_id)->with('call_message', ' تماس بعلت یافت نشدن دستگاه میکروفن قطع شد');
        else
            return redirect()->route('user.index')->with('call_message', ' تماس بعلت یافت نشدن دستگاه میکروفن قطع شد');
    }
    public function no_reply($unique_code)
    {
        $cal=CallRequest::where('unique_code',$unique_code)->whereIN('status',['pending','doing'])->first();
        if(!$cal)
        {
            $cal=CallRequest::where('unique_code',$unique_code)->whereIN('status',['blocked','end','end_time'])->first();
            if($cal)
            {
                if (session()->has('back_url'))
                    return redirect(session('back_url'))->with('call_message', ' تماس پایان یافت');
                elseif($cal->service)
                    return redirect()->route('user.subServices',$cal->service->category_id)->with('call_message', 'تماس پایان یافت');
                else
                    return redirect()->route('user.index')->with('call_message', 'تماس پایان یافت');
            }
            return redirect()->back()->withInput()->with('call_message', 'تماس یافت نشد، مجددا تلاش کنید');
        }
        $cal->status='not';
        $cal->update();

        //return amount
        $user=$cal->user;
        if($user)
        {
            $user->amount+=$cal->price_service;
            $user->update();
        }

        if (session()->has('back_url'))
            return redirect(session('back_url'))->with('call_message', ' درخواست تماس توسط گیرنده پاسخ داده نشد');
        elseif($cal->service)
            return redirect()->route('user.subServices',$cal->service->category_id)->with('call_message', 'درخواست تماس توسط گیرنده پاسخ داده نشد');
        else
            return redirect()->route('user.index')->with('call_message', 'درخواست تماس توسط گیرنده پاسخ داده نشد');
    }
    public function user_call_report()
    {
        $items = CallRequest::orderByDesc('id')->where('user_id',auth()->id())->paginate( $this->controller_paginate() );
        return view('admin.call.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }
    public function app_user_call_report()
    {
        $items = CallRequest::orderByDesc('id')->where('user_id',auth()->id())->paginate( $this->controller_paginate() );
        return view('user.call.user_call_report', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }
}
