<?php

namespace App\Http\Controllers\User;
use App\Model\Sms;
use App\Model\OfflinePayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
class OfflinePaymentController extends Controller {
    public function __construct() {
       $this->middleware('auth');
    }
    
    public function form_post(Request $request) {
        try {
            if ($request->model_type=='App\Model\ServicePackage') {
                $item   = \App\Model\ServicePackage::findOrFail($request->item_id);
            } else abort('403');

            $data = [];
            array_push( $data, ['fish_id' => $request->fish_id]);
            array_push( $data, ['number' => $request->card_number]);
            array_push( $data, ['bank' => $request->bank]);

            $ticket = new OfflinePayment();
            $ticket->user_id    = auth()->user()->id; 
            $ticket->item_id    = $item->id;
            $ticket->model_type = $request->model_type;
            $ticket->price      = intVal($item->price);
            $ticket->data       = json_encode($data);

            if ($request->hasFile('attach')) {
                // $request->validate([ 'attach' => 'required|mimes:image|max:48000', ]);
                $ticket->attach = file_store($request->attach, 'source/asset/uploads/ofline-payment/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
            }
            $ticket->save();
            $msg = ' یک درخواست پرداخت کارگاهی ارسال شد ';
            // Sms::SendSms( $msg , env('ADMIN_MOBILE'));
            return redirect()->back()->withInput()->with('flash_message', 'پیام شما با موفقیت ارسال شد');
        }
        catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ارسال فرم بوجود آمده ، مجدد تلاش کنید');
        }
    }
}
