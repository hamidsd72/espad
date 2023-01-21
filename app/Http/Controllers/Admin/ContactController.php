<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\User;
use App\Model\Setting;
use App\Model\Contact;
use App\Model\Photo; 
use App\Model\Sms; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Model\Notification;

class ContactController extends Controller
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
        if ($type=='unread') {
            $items = Contact::whereNotIn('category',['رسید پرداخت','کد تخفیف','کاربر ویژه'])->where('reply',0)->where('answered', 'no')->orderByDesc('id')->where('belongs_to_item', '=', 0);
        } elseif ($type=='read') {
            $items = Contact::whereNotIn('category',['رسید پرداخت','کد تخفیف','کاربر ویژه'])->where('reply','>',0)->where('answered', 'no')->orderByDesc('id')->where('belongs_to_item', '=', 0);
        } elseif ($type=='unread-pay') {
            $items = Contact::where('category','=','رسید پرداخت')->where('reply',0)->where('answered', 'no')->orderByDesc('id');
        } elseif ($type=='read-pay') {
            $items = Contact::where('category','=','رسید پرداخت')->where('reply','>',0)->where('answered', 'no')->orderByDesc('id');
        } elseif ($type=='unread-offCode') {
            $items = Contact::where('category','=','کد تخفیف')->where('reply',0)->where('answered', 'no')->orderByDesc('id');
        } elseif ($type=='read-offCode') {
            $items = Contact::where('category','=','کد تخفیف')->where('reply','>',0)->where('answered', 'no')->orderByDesc('id');
        } elseif ($type=='unread-special') {
            $items = Contact::where('category','=','کاربر ویژه')->where('reply',0)->where('answered', 'no')->orderByDesc('id');
        } elseif ($type=='read-special') {
            $items = Contact::where('category','=','کاربر ویژه')->where('reply','>',0)->where('answered', 'no')->orderByDesc('id');
        } else {
            $items = Contact::where('category','!=','رسید پرداخت')->where('answered', 'no')->orderByDesc('id')->where('belongs_to_item', '=', 0);
        }
        if (auth()->user()->hasRole('مدیر')) $items = $items->paginate($this->controller_paginate());
        else $items = $items->where('user_id',auth()->user()->id)->paginate($this->controller_paginate());

        // elseif (Auth::user()->hasRole('حقوقی')) {
        //     $items = Contact::where('category', 'حقوقی')->where('answered', 'no')->orderBy('id','desc')->where('belongs_to_item', '=', 0)->paginate($this->controller_paginate());
        // }
        // elseif (Auth::user()->hasRole('ویزا')) {
        //     $items = Contact::where('category', 'ویزا')->where('answered', 'no')->orderBy('id','desc')->where('belongs_to_item', '=', 0)->paginate($this->controller_paginate());
        // }
        // elseif (Auth::user()->hasRole('استعدادیابی')) {
        //     $items = Contact::where('category', 'استعدادیابی')->where('answered', 'no')->orderBy('id','desc')->where('belongs_to_item', '=', 0)->paginate($this->controller_paginate());
        // }
        $sub_items = '';
        if($items->count()) $sub_items = Contact::where('answered', 'no')->whereIn('belongs_to_item', $items->pluck('id') )->get();
        return view('admin.content.contact.index', compact('items','sub_items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function send_email(Request $request,$id)
    {
        $item=Contact::find($id);
        try {
        send_mail($item->email, 'پاسخ به تماس با ما آی مشاور با موضوع : '.$item->subject,$request->text);
        $item->reply+=1;
        $item->update();
        return redirect()->back()->with('flash_message', 'ارسال ایمیل با موفقیت انجام شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ارسال ایمیل تماس بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function send_ticket(Request $request,$id)
    {
        $item = Contact::find($id);
        $sub_items = Contact::where('belongs_to_item', $item->id )->get();
        try {
            $belongs_to_item              = 0;
            if ($request->belongs_to_item) {
                $belongs_to_item = $request->belongs_to_item;
            }
            $ticket = new Contact();
            $ticket->user_id              = $item->user_id;
            $ticket->full_name            = $item->full_name;
            $ticket->belongs_to_item      = $belongs_to_item;
            $ticket->subject              = 'پاسخ به تیکت با موضوع : '.$item->subject;
            $ticket->text                 = $request->text;
            $ticket->category             = $request->category;
            $ticket->answered             = 'yes';
            if ($request->hasFile('attach')) {
                // $request->validate([
                //     'attach' => 'required|mimes:pdf,xlx,csv|max:2048',
                // ]);          
                $ticket->attach = file_store($request->attach, 'source/asset/uploads/ticket/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
            }
            $ticket->save();

            $item->reply+=1;
            $item->update();

            foreach ($sub_items as $sub_item) {
                $sub_item->reply+=1;
                $sub_item->update();
            }

            return redirect()->back()->with('flash_message', 'ارسال تیکت با موفقیت انجام شد.'); 

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ارسال تیکت بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function destroy($id)
    {
        $item = Contact::find($id);
        try {
            $item->delete();
            return redirect()->back()->with('flash_message', 'تماس با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در حذف تماس بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function accept($id ,Request $request) {
        $item = Contact::findOrFail($id);
        $user = User::findOrFail($item->user_id);
        
        $notife = new Notification();
        $notife->user_id = $user->id;

        if (auth()->user()->hasRole('مدیر')) {
            if ($item->category == 'کاربر ویژه' && $request->num > 0) {
                $user->is_special = Carbon::now()->addMonth($request->num);
                $notife->subject = 'فیش واریزی بررسی و دسترسی شما به قسمت ویژه فعال شد';
            } else {
                $user->amount += $item->subject;
                $notife->subject = 'فیش واریزی تایید و پنل کاربری شارژ شد';
            }
            $user->update();
            
            $item->reply += 1;
            $item->update();
            

            
            $notife->description = $item->text;
            $notife->save();

            // Sms::SendSms( (' تایید رسید پرداخت شماره : '.$item->id) , env('ADMIN_MOBILE'));
            // Sms::SendSms( (' تایید رسید پرداخت شماره : '.$item->id) , $user->mobile);
            return redirect()->back()->with('flash_message', 'با موفقیت انجام شد.'); 
        }
        abort('503');
    }

    public function reject($id) {
        $item = Contact::findOrFail($id);
        $user = User::findOrFail($item->user_id);

        if (auth()->user()->hasRole('مدیر')) {
            $item->text   = 'این رسید تایید نشده است';
            $item->reply += 1;
            $item->update();

            $notife = new Notification();
            $notife->user_id = $user->id;
            $notife->subject = 'عدم تایید فیش واریزی پرداخت آفلاین';
            $notife->description = $item->text;
            $notife->save();
            // Sms::SendSms( (' عدم تایید رسید پرداخت شماره : '.$item->id) , env('ADMIN_MOBILE'));
            // Sms::SendSms( (' عدم تایید رسید پرداخت شماره : '.$item->id) , $user->mobile);
            return redirect()->back()->with('flash_message', 'با موفقیت انجام شد.'); 
        }
        abort('503');
    }
}


