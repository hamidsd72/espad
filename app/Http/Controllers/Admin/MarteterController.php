<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Setting;
use App\Model\Sms;
use App\Model\Agent;
use App\Model\Marketer;
use App\Model\Photo;
use App\Model\ProvinceCity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MarteterController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'لیست بازاریاب ها';
        } elseif ('single') {
            return 'بازاریاب';
        }
    }

    public function controller_paginate()
    {
        $settings = Setting::select('paginate')->latest()->firstOrFail();
        return $settings->paginate;
    }

    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index()
    {
        $items = User::role('بازاریاب')->paginate($this->controller_paginate());
        return view('admin.user.marketer.index', compact('items'), ['title1' => 'کاربران', 'title2' => $this->controller_title('sum')]);
    }

    public function show($id)
    {
        if (Auth::user()->hasRole('مدیر')) {
            $item = User::find($id);
        } else {
            abort(404);
        }
        return view('admin.user.marketer.show', compact('item'), ['title1' => 'کاربران', 'title2' => 'پروفایل بازاریاب']);
    }

    public function create()
    {
        $states = ProvinceCity::where('parent_id', null)->get();
        $agents = Agent::where('status', 'active')->where('abbreviation', '!=', null)->get();
        return view('admin.user.marketer.create', compact('states', 'agents'), ['title1' => 'کاربران', 'title2' => 'افزودن بازاریاب']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:240',
            'last_name' => 'required|max:240',
            'mobile' => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric|unique:users',
            'email' => 'required|email|unique:users',
            'whatsapp' => 'required',
            'date_birth' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'locate' => 'required',
            'address' => 'required',
            'education' => 'required',
            'password' => 'required|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ],
            [
                'first_name.required' => 'لطفا نام خود را وارد کنید',
                'first_name.max' => 'نام نباید بیشتر از 240 کاراکتر باشد',
                'last_name.required' => 'لطفا نام خانوادگی خود را وارد کنید',
                'last_name.max' => 'نام خانوادگی نباید بیشتر از 240 کاراکتر باشد',
                'mobile.required' => 'لطفا موبایل خود را وارد کنید',
                'mobile.regex' => 'لطفا موبایل خود را وارد کنید',
                'mobile.digits' => 'لطفا فرمت موبایل را رعایت کنید',
                'mobile.numeric' => 'لطفا موبایل خود را بصورت عدد وارد کنید',
                'mobile.unique' => 'موبایل وارد شده یکبار ثبت نام شده',
                'email.required' => 'لطفا ایمیل خود را وارد کنید',
                'email.email' => 'فرمت ایمیل را رعایت کنید',
                'email.unique' => ' ایمیل وارد شده یکبار ثبت نام شده',
                'whatsapp.required' => 'لطفا شماره واتساپ فعال خود را وارد کنید',
                'date_birth.required' => 'لطفا تاریخ تولد خود را وارد کنید',
                'state_id.required' => 'لطفا استان خود را وارد کنید',
                'city_id.required' => 'لطفا شهر خود را وارد کنید',
                'locate.required' => 'لطفا منطقه خود را وارد کنید',
                'address.required' => 'لطفا آدرس خود را وارد کنید',
                'education.required' => 'لطفا مدرک تحصیلی خود را وارد کنید',
                'password.required' => 'لطفا رمز عبور خود را وارد کنید',
                'password.min' => 'رمز عبور نباید کمتر از 6 کاراکتر باشد',
                'password.confirmed' => 'رمز عبور با تکرار آن برابر نیست',
                'photo.image' => 'لطفا یک تصویر انتخاب کنید',
                'photo.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                'photo.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
            ]);
        $agent = null;
        if ($request->abbreviation_agent != null and $request->abbreviation_agent != '') {
            $agent = Agent::where('abbreviation',$request->abbreviation_agent)->first();
        }
        try {
            $item = new User();
            $item->first_name = $request->first_name;
            $item->last_name = $request->last_name;
            $item->mobile = $request->mobile;
            $item->email = $request->email;
            $item->whatsapp = $request->whatsapp;
            $item->date_birth = num_to_en($request->date_birth);
            $item->state_id = $request->state_id;
            $item->city_id = $request->city_id;
            if ($agent) {
                $item->abbreviation_agent = $request->abbreviation_agent;
                $item->reagent_id = $agent->abbreviation .'_'.time();
            }else{
                $item->reagent_id = 'sedar_'.time();
            }
            $item->locate = $request->locate;
            $item->address = $request->address;
            $item->education = $request->education;
            $item->password = $request->password;
            $item->mobile_status = 'active';
            $item->email_status = 'active';
            $item->user_status = 'active';
            $item->reagent_code = Auth::user()->reagent_id;
            $item->save();
            $item->assignRole('بازاریاب');
            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/asset/uploads/user/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $item->photo()->save($photo);
                img_resize(
                    $photo->path,//address img
                    $photo->path,//address save
                    100,// width: if width==0 -> width=auto
                    100// height: if height==0 -> height=auto
                // end optimaiz
                );
            }
            $marketer = new Marketer();
            $marketer->user_id = $item->id;
            if ($agent) {
                $marketer->agent_id=$agent->id;
            }
                $marketer->discount = $request->discount;
            $marketer->save();
            return redirect()->route('admin.marketer.list')->with('flash_message', 'بازاریاب با موفقیت ایجاد شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ایجاد نماینده بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function edit($id)
    {
        $item = User::find($id);
        $states = ProvinceCity::where('parent_id', null)->get();
        $citys = ProvinceCity::where('parent_id', $item->state_id)->get();
        $agents = Agent::where('status', 'active')->where('abbreviation', '!=', null)->get();
        return view('admin.user.marketer.edit', compact('item', 'states', 'agents', 'citys'), ['title1' => 'کاربران', 'title2' => 'ویرایش باراریاب']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|max:240',
            'last_name' => 'required|max:240',
            'mobile' => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric|unique:users,mobile,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'whatsapp' => 'required',
            'date_birth' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'locate' => 'required',
            'address' => 'required',
            'education' => 'required',
            'password' => 'nullable|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ],
            [
                'first_name.required' => 'لطفا نام خود را وارد کنید',
                'first_name.max' => 'نام نباید بیشتر از 240 کاراکتر باشد',
                'last_name.required' => 'لطفا نام خانوادگی خود را وارد کنید',
                'last_name.max' => 'نام خانوادگی نباید بیشتر از 240 کاراکتر باشد',
                'mobile.required' => 'لطفا موبایل خود را وارد کنید',
                'mobile.regex' => 'لطفا موبایل خود را وارد کنید',
                'mobile.digits' => 'لطفا فرمت موبایل را رعایت کنید',
                'mobile.numeric' => 'لطفا موبایل خود را بصورت عدد وارد کنید',
                'mobile.unique' => 'موبایل وارد شده یکبار ثبت نام شده',
                'email.required' => 'لطفا ایمیل خود را وارد کنید',
                'email.email' => 'فرمت ایمیل را رعایت کنید',
                'email.unique' => ' ایمیل وارد شده یکبار ثبت نام شده',
                'whatsapp.required' => 'لطفا شماره واتساپ فعال خود را وارد کنید',
                'date_birth.required' => 'لطفا تاریخ تولد خود را وارد کنید',
                'state_id.required' => 'لطفا استان خود را وارد کنید',
                'city_id.required' => 'لطفا شهر خود را وارد کنید',
                'locate.required' => 'لطفا منطقه خود را وارد کنید',
                'address.required' => 'لطفا آدرس خود را وارد کنید',
                'education.required' => 'لطفا مدرک تحصیلی خود را وارد کنید',
                'password.min' => 'رمز عبور نباید کمتر از 6 کاراکتر باشد',
                'password.confirmed' => 'رمز عبور با تکرار آن برابر نیست',
                'photo.image' => 'لطفا یک تصویر انتخاب کنید',
                'photo.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                'photo.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
            ]);
        $item = User::find($id);
        try {
            $item->first_name = $request->first_name;
            $item->last_name = $request->last_name;
            $item->mobile = $request->mobile;
            $item->email = $request->email;
            $item->whatsapp = $request->whatsapp;
            $item->date_birth = num_to_en($request->date_birth);
            $item->state_id = $request->state_id;
            $item->city_id = $request->city_id;
            $item->locate = $request->locate;
            $item->address = $request->address;
            $item->education = $request->education;
            if ($request->password) {
                $item->password = $request->password;
            }
            $item->update();
            if ($request->hasFile('photo')) {
                if ($item->photo) {
                    $old_path = $item->photo->path;
                    File::delete($old_path);
                    $item->photo->delete();
                }
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/asset/uploads/user/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $item->photo()->save($photo);
                img_resize(
                    $photo->path,//address img
                    $photo->path,//address save
                    100,// width: if width==0 -> width=auto
                    100// height: if height==0 -> height=auto
                // end optimaiz
                );
            }
            $item->marketer->discount = $request->discount;
            $item->marketer->save();
            return redirect()->route('admin.marketer.list')->with('flash_message', 'بازاریاب  با موفقیت ویرایش شد.');
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ویرایش نماینده بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function destroy($id)
    {
        $item = User::find($id);
        try {
            $item->marketer->delete();
            $item->delete();
            return redirect()->back()->with('flash_message', 'بازاریاب با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در حذف نماینده بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function active($id, $type)
    {
        $item = User::find($id);
        try {
            $status = $item->user_status;
            $item->user_status = $type;
            $item->update();
            if ($type == 'blocked') {
                return redirect()->back()->with('flash_message', 'بازاریاب با موفقیت مسدود شد.');
            }
            if ($type == 'active') {
                if ($status == 'pending') {
                    $fullname = $item->first_name . ' ' . $item->last_name;
                    $text = $fullname . ' عزیز درخواست شما جهت پذیرش نمایندگی توسط ادمین تایید شد';
                    // Sms::SendSms($text, $item->mobile);
                }
                return redirect()->back()->with('flash_message', 'بازاریاب با موفقیت فعال شد.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در تغییر وضعیت نماینده بوجود آمده،مجددا تلاش کنید');
        }
    }
}


