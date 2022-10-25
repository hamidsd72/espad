<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\About;
use App\Model\AboutJoin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AboutController extends Controller {
    public function controller_title($type) {
        if ($type == 'sum') {
            return 'درباره ما';
        } elseif ('single') {
            return 'درباره ما';
        }
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function __construct() {
        $this->middleware('auth');
    }

    public function edit() {
        $item = About::first();
        $items = AboutJoin::where('type','about')->get();
        return view('admin.content.about.edit', compact('item','items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function update2(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required|max:240',
            'text' => 'required',
            'title_target' => 'required|max:240',
            'text_target' => 'required',
            'title_home' => 'required|max:240',
            'text_home' => 'required',
            'pic' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'pic_home' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ],
            [
                'title.required' => 'لطفا عنوان درباره ما را وارد کنید',
                'title.max' => 'عنوان درباره ما نباید بیشتر از 240 کاراکتر باشد',
                'title_home.required' => 'لطفا عنوان درباره ما صفحه اصلی را وارد کنید',
                'title_home.max' => 'عنوان درباره ما صفحه اصلی نباید بیشتر از 240 کاراکتر باشد',
                'title_target.required' => 'لطفا عنوان اهداف ما را وارد کنید',
                'title_target.max' => 'عنوان اهداف ما نباید بیشتر از 240 کاراکتر باشد',
                'text.required' => 'لطفا متن درباره ما را وارد کنید',
                'text_home.required' => 'لطفا متن درباره ما صفحه اصلی را وارد کنید',
                'text_target.required' => 'لطفا متن اهداف ما را وارد کنید',
                'pic.image' => 'لطفا یک تصویر انتخاب کنید',
                'pic.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                'pic.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
                'pic_home.image' => 'لطفا یک تصویر انتخاب کنید',
                'pic_home.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                'pic_home.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
            ]);
        $item = About::find($id);
        try {
            $item->title = $request->title;
            $item->title_home = $request->title_home;
            $item->title_target = $request->title_target;
            $item->text = $request->text;
            $item->text_home = $request->text_home;
            $item->text_target = $request->text_target;
            if ($request->hasFile('pic')) {
                if (is_file($item->pic)) {
                    $old_path = $item->pic;
                    File::delete($old_path);
                }
                $item->pic = file_store($request->pic, 'source/asset/uploads/about/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'pic-');;

            }
            if ($request->hasFile('pic_home')) {
                if (is_file($item->pic_home))
                {
                    $old_path = $item->pic_home;
                    File::delete($old_path);
                }
                $item->pic_home = file_store($request->pic_home, 'source/asset/uploads/about/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'pic_home-');;
            }
            $item->update();
            // if ($request->hasFile('pic_home')) {
            //     img_resize(
            //         $item->pic_home,//address img
            //         $item->pic_home,//address save
            //         700,// width: if width==0 -> width=auto
            //         0// height: if height==0 -> height=auto
            //     // end optimaiz
            //     );
            // }
            // if ($request->hasFile('pic')) {
            //     img_resize(
            //         $item->pic,//address img
            //         $item->pic,//address save
            //         700,// width: if width==0 -> width=auto
            //         0// height: if height==0 -> height=auto
            //     // end optimaiz
            //     );
            // }
            if(isset($request->title_join)) {
                $items=AboutJoin::where('type','about')->get();
                foreach ($items as $itemss) {
                    $itemss->delete();
                }
                foreach ($request->title_join as $key=>$val)
                {
                    $pic=null;
                    if(isset($request->pic_join[$key]))
                    {
                        $pic=$request->pic_join[$key];
                    }
                    $about_join=new AboutJoin();
                    $about_join->title=$val;
                    $about_join->type='about';
                    $about_join->text=$request->text_join[$key];
                    if (is_file($pic)) {
                        if(isset($request->pic_join1[$key]) and is_file($request->pic_join1[$key]))
                        {
                            File::delete($request->pic_join1[$key]);
                        }
                        $about_join->pic = file_store($pic, 'source/asset/uploads/about/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'pic_'.$key.'-');;
                    }
                    elseif($request->pic_join1[$key]!=null)
                    {
                        $about_join->pic=$request->pic_join1[$key];
                    }
                    // $about_join->save();
                    // img_resize(
                    //     $about_join->pic,//address img
                    //     $about_join->pic,//address save
                    //     700,// width: if width==0 -> width=auto
                    //     0// height: if height==0 -> height=auto
                    // // end optimaiz
                    // );
                }
            }

            return redirect()->back()->with('flash_message', 'درباره ما با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ویرایش درباره ما بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function store(Request $request) {
        $this->validate($request, [
            'join_title'    => 'required|max:240',
            'join_text'     => 'max:2400',
            'join_pic'      => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ],
            [
                'join_title.required' => 'لطفا عنوان درباره ما را وارد کنید',
                'join_title.max' => 'عنوان درباره ما نباید بیشتر از 240 کاراکتر باشد',
                'join_text.max' => 'متن نباید بیشتر از ۲۴۰۰ کاراکتر باشد',
                'join_pic.image' => 'لطفا یک تصویر انتخاب کنید',
                'join_pic.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                'join_pic.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
            ]);
        $item = new AboutJoin();
        try {
            $item->join_title    = $request->join_title;
            $item->join_text    = $request->join_text;
            $item->type         = 'about';
            if ($request->hasFile('join_pic')) {
                $item->join_pic = file_store($request->join_pic, 'source/asset/uploads/about_join/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'pic-');;

            }
            $item->save();

            return redirect()->back()->with('flash_message', 'درباره ما با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ویرایش درباره ما بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'join_title'    => 'required|max:240',
            'join_text'     => 'max:2400',
            'join_pic'      => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ],
            [
                'join_title.required' => 'لطفا عنوان درباره ما را وارد کنید',
                'join_title.max' => 'عنوان درباره ما نباید بیشتر از 240 کاراکتر باشد',
                'join_text.max' => 'متن نباید بیشتر از ۲۴۰۰ کاراکتر باشد',
                'join_pic.image' => 'لطفا یک تصویر انتخاب کنید',
                'join_pic.mimes' => 'لطفا یک تصویر با پسوندهای (png,jpg,jpeg) انتخاب کنید',
                'join_pic.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
            ]);
        $item = AboutJoin::findOrFail($id);
        try {
            $item->join_title   = $request->join_title;
            $item->join_text    = $request->join_text;
            $item->type         = 'about';
            if ($request->hasFile('join_pic')) {
                if (is_file($item->join_pic)) {
                    File::delete($item->join_pic);
                }
                $item->join_pic = file_store($request->join_pic, 'source/asset/uploads/about_join/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'pic-');;

            }
            $item->save();

            return redirect()->back()->with('flash_message', 'درباره ما با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ویرایش درباره ما بوجود آمده،مجددا تلاش کنید');
        }
    }
    
    public function destroy($id) {
        $item = AboutJoin::findOrFail($id);
        if (is_file($item->pic)) {
            File::delete($item->pic);
        }
        $item->delete();
        return redirect()->back()->withInput()->with('flash_message', 'درباره ما با موفقیت حذف شد.');
    }

}


