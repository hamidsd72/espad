<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Sms;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Model\Evoke; 

class NewRegisterController extends Controller {
    public function __construct() {
        $this->middleware('guest');
    }

    public function toEnNumber($input) {
        $replace_pairs = array(
              '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
              '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'
        );
        return strtr( $input, $replace_pairs );
    }

    public function store(Request $request) {
        $this->validate($request, [
            'mobile'    => 'required|max:11',
            'password'  => 'required|max:240',
            'f_name'    => 'max:240',
            'l_name'    => 'max:240',
            'code'      => 'max:10',
        ],
            [
                'mobile.required'       => 'لطفا موبایل را وارد کنید',
                'mobile.max'            => 'شماره موبایل ۱۱ رقم میباشد',
                'password.required'     => 'لطفا رمزعبور وارد کنید',
                'password.max'          => 'رمزعبور نباید بیشتر از ۲۴۰ کاراکتر باشد',
                'f_name.max'            => 'نام نباید بیشتر از ۲۴۰ کاراکتر باشد',
                'l_name.max'            => 'نام خانوادگی نباید بیشتر از ۲۴۰ کاراکتر باشد',
                'code.max'              => 'کدملی ۱۰ رقم میباشد',
            ]);        
        if ( strlen($request->mobile) == 11 ) {
            $code       = $request->code;
            $number     = $request->mobile;
            $password   = $request->password;
            $user = User::where('mobile', $number)->first();

            switch ($request->form_set) {
                case 'register':
                    if ($user) {
                        return redirect()->back()->withInput()->with('err_message', 'این شماره قبلا ثبت شده است');
                    } elseif ($password != $request->conf_password) {
                        return redirect()->back()->withInput()->with('err_message', 'رمزعبور با تکرار آن برابر نیست لطفا مجددا امتحان کنید');
                    } elseif ($request->conf_password && $request->f_name && $request->l_name) {
                        $user = new User();
                        $user->referrer_code    = $code;
                        $user->mobile           = $number;
                        $user->first_name       = $request->f_name;
                        $user->last_name        = $request->l_name;
                        $user->password         = $password;
                        $user->save();
                        $user->assignRole('کاربر');
                        auth()->loginUsingId($user->id, true);
                        return redirect()->back()->withInput()->with('flash_message', 'ثبت نام شما با موفقیت انجام شد');
                    }
                    return redirect()->back()->withInput()->with('err_message', 'لطفا فیلدها را کامل کنید');
                    break;
                case 'login':
                    if ($user) {
                        if ( password_verify( $password, $user->password) ) {
                            auth()->loginUsingId($user->id, true);
                            $evokes = Evoke::where( 'consultation_id',auth()->user()->id )->where('notify','در انتظار ارسال')->get(['id','user_id','notify']);
                            foreach ($evokes as $evoke) {
                                $user = User::find($evoke->user_id);
                                if ($user && $user->mobile) {
                                    // Sms::SendSms( 'مشاور مورد نظر آنلاین شد' , $user->mobile);
                                }
                                $evoke->notify = 'ارسال شده';
                                $evoke->update();
                            }
                            return redirect()->route('user.index');
                        }
                    }
                    return redirect()->back()->withInput()->with('err_message', 'شماره یا رمز عبور اشتباه است لطفا مجددا امتحان کنید');
                    break;
            }
        }
        return redirect()->back()->withInput()->with('err_message', 'فرمت شماره وارد شده نامعتبر است لطفا مجددا امتحان کنید');
    }

    public function remember_password(Request $request) {
        $user   = User::where('mobile',$this->toEnNumber($request->id))->firstOrFail();
        $user->mobile_verified = rand(100000, 999999);
        $user->update();
        $id     = $user->mobile;
        // Sms::SendSms( (' کد تایید هویت شما : '.$user->mobile_verified.' سامانه مانابورس ') , $id);
        return view('auth.app-resend-password', compact('id'))->with('flash_message', 'کد ۶ رقمی تایید هویت به موبایل ارسال شد');
    }
    
    public function resend_password(Request $request) {
        $this->validate($request, [
            'mobile'    => 'required|max:11',
            'acc_code'  => 'required|max:6',
            'password'  => 'required|max:240',
        ],
            [
                'mobile.required'       => 'لطفا موبایل را وارد کنید',
                'mobile.max'            => 'شماره موبایل ۱۱ رقم میباشد',
                'password.required'     => 'لطفا رمزعبور وارد کنید',
                'password.max'          => 'رمزعبور نباید بیشتر از ۲۴۰ کاراکتر باشد',
                'acc_code.required'     => 'کد وارد کنید',
                'acc_code.max'          => 'کد تایید ۶ رقم میباشد',
            ]);
        $user = User::where('mobile',$request->mobile)->first();
        if ($user) {
            if ($user->mobile_verified == $request->acc_code  && $user->updated_at->diffInMinutes(Carbon::now(), false) < 5) {
                if ($request->conf_password && $request->password == $request->conf_password) {
                    $user->password = $request->password;
                    $user->update();
                    auth()->loginUsingId($user->id, true);
                    return redirect()->back()->withInput()->with('flash_message', 'رمز عبور تغییر یافت');
                }
                auth()->loginUsingId($user->id, true);
                return redirect()->back()->withInput()->with('flash_message', 'رمز عبور با تکرار آن برابر نیست اما وارد حساب خود شدید');
            }
        }
        return redirect()->back()->with('err_message', 'کد تایید اشیباه یا تاریخ گذشته است');
    }

    public function show($id)
    {
        //
    }

    // public function edit(Request $request) {
    //     $number = $request->id;

    //     if ( strlen($request->mobile) == 11 ) {
    //         $mobile_verified = rand(100000, 999999);
    //         $user            = User::where('mobile', $number)->first();
    
    //         if ($user) {
    //             $user->mobile_verified = $mobile_verified;
    //             $user->update();
    //             Sms::SendSms( (' کد فعالسازی imoshaver : '.$user->mobile_verified) , $number);
    //             return view('auth.verify', compact('number') );
    //         }
    //         $error = 'شماره وارد شده یافت نشد';
    //     }
    //     $error = 'شماره وارد شده نامعتبر است';
    //     return redirect()->route('login')->withInput()->with(['error' => $error,'status' => 'danger']);
    // }

    public function update(Request $request, $id) {
        $number     = $id;
        $password   = $request->password;
        $error      = 'کد وارد شده نامعتبر است';
        if ( strlen($request->code) == 6 ) {
            $user = User::where('mobile',$id)->first();
            
            if ($user->mobile_verified == $request->code  && $user->updated_at->diffInMinutes(Carbon::now(), false) < 5) {
                $user->password = Hash::make($password);
                $user->update();
                auth()->loginUsingId($user->id, true);
                return redirect()->route('user.index');
            }
            $error  = 'کد صحیح نیست یا تاریخ گذشته است';
        }
        return view('auth.verify', compact('number', 'error') )->withInput()->with(['error' => $error,'status' => 'danger']);;
    }

    public function destroy($id)
    {
        //
    }
}