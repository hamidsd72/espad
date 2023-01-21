<?php

namespace App\Http\Controllers\User;
use App\Model\Sms;
use App\Model\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
class TicketController extends Controller {
    public function __construct() {
       $this->middleware('auth');
    }
    
    public function form_post(Request $request) {   
        try {
            $name = 'بدون نام';
            $belongs_to_item = 0;
            if (auth()->user()->first_name || auth()->user()->last_name) {
                $name = auth()->user()->first_name.' '.auth()->user()->last_name;
            }
            if ($request->belongs_to_item) {
                $belongs_to_item = $request->belongs_to_item;
            }
            $ticket = new Contact();
            $ticket->user_id         = auth()->user()->id; 
            $ticket->full_name       = $name;
            $ticket->subject         = $request->subject;
            $ticket->category        = $request->category;
            $ticket->text            = $request->text;
            if ($request->category=='رسید پرداخت') {
                $ticket->text   = ' شماره فیش : '.$request->fish_id.' جهار رقم آخر کارت : '.$request->card_number.' از بانک '.$request->bank.' '.$request->text;
            } elseif ($request->category=='کد تخفیف') {
                $ticket->text   = $request->q1.','.$request->q2.','.$request->q3.','.$request->q4.','.$request->text;

            }
            $ticket->belongs_to_item = $belongs_to_item;
            $ticket->answered        = 'no';
            if ($request->hasFile('attach')) {
                $ticket->attach = file_store($request->attach, 'source/asset/uploads/ticket/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                // $request->validate([
                //     'attach' => 'required|mimes:pdf,xlx,csv|max:2048',
                // ]);          
            }
            $ticket->save();
            $msg = ' یک تیکت ارسال شد ';
            if ($request->category=='رسید پرداخت') {
                $msg = ' یک رسید پرداخت ارسال شد ';
            } elseif ($request->category=='کد تخفیف') {
                $msg = ' یک درخواست کد تخفیف ارسال شد ';
            }
            // Sms::SendSms( $msg , env('ADMIN_MOBILE'));
            return redirect()->back()->withInput()->with('flash_message', 'پیام شما با موفقیت ارسال شد');
        }
        catch (\Exception $error) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ارسال فرم بوجود آمده ، مجدد تلاش کنید');
        }
    }
}
