<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Model\ProvinceCity;
use App\Model\Agent;
use App\Model\Filep;
use App\Model\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function show()
    {
        $states=ProvinceCity::where('parent_id',null)->get();
        $item=About::find(1);
        return view('user.agent.show',compact('states','item'));
    }
    public function agent_request(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required',
//            'web_site' => 'required',
            'mobile' => 'required|regex:/(09)[0-9]{9}/',
            'phone' => 'required',
            'text' => 'required',
            'file' => 'nullable|mimes:zip,rar|max:30720',

        ],
            [
                'first_name.required' => 'لطفا نام خود را وارد کنید',
                'last_name.required' => 'لطفا نام خانوادگی خود را وارد کنید',
                'company_name.required' => 'لطفا نام شرکت خود را وارد کنید',
//                'web_site.required' => 'لطفا آدرس وب سایت خود را وارد کنید',
                'mobile.required' => 'لطفا شماره مبایل خود را وارد کنید',
                'mobile.regex' => 'لطفا شماره مبایل را بصورت صحیح وارد کنید',
                'mobile.digits' => 'شماره موبایل باید 11 رقم باشد',
                'phone.required' => 'لطفا شماره ثابت خود را وارد کنید',
                'phone.regex' => 'لطفا شماره ثابت را بصورت صحیح وارد کنید',
                'phone.digits' => 'شماره تلفن باید 11 رقم باشد',
                'text.required' => 'لطفا توضیحات را وارد کنید',
                'file.mimes' => 'لطفا یک فایل با پسوند (zip یا rar) انتخاب کنید',
                'file.max' => 'لطفا حجم فایل حداکثر 30 مگابایت باشد',
            ]);
        try{
            $item=new Agent();
            $item->first_name=$request->first_name;
            $item->last_name=$request->last_name;
            $item->company_name=$request->company_name;
            $item->mobile=$request->mobile;
            $item->phone=$request->phone;
            $item->text=$request->text;
            $item->save();

            if ($request->hasFile('file')) {
                $file = new Filep();
                $file->path = file_store($request->file, 'source/asset/uploads/agent/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/files/', 'file-');;
                $item->file()->save($file);
            }
        return redirect()->route('user.agent.rule.show')->with('flash_message', 'درخواست شما با موفقیت ثبت شد، منتظر تماس کارشناسان ما باشید.');

         }catch (\Exception $e){
            return redirect()->route('user.agent.rule.show')->with('err_message', 'مشکلی در ثبت درخواست به وجود آمده لطفا مجدد تلاش فرمائید.');

        }

    }

}
