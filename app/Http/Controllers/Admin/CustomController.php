<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Setting;
use App\Model\Custom;
use App\Model\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CustomController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return ' لیست مشتریان';
        } elseif ('single') {
            return ' مشتریان';
        }
    }

    public function controller_paginate()
    {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Custom::paginate($this->controller_paginate());
        return view('admin.content.customer.index', compact('items'), ['title1' => 'محتوا سایت', 'title2' => $this->controller_title('sum')]);
    }

    public function create()
    {
        return view('admin.content.customer.create', ['title1' => 'محتوا سایت', 'title2' => 'افزودن مشتری']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:240',
            'photo' => 'required|image|mimes:png|max:5120',
        ],
            [
                'title.required' => 'لطفا عنوان را وارد کنید',
                'title.max' => 'عنوان نباید بیشتر از 240 کاراکتر باشد',
                'photo.required' => 'لطفا یک تصویر انتخاب کنید',
                'photo.image' => 'لطفا یک تصویر انتخاب کنید',
                'photo.mimes' => 'لطفا یک تصویر با پسوندهای (png) انتخاب کنید',
                'photo.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
            ]);
        try {
            $item = new Custom();
            $item->title = $request->title;
            $item->save();
            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/asset/uploads/customer/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $item->photo()->save($photo);
                img_resize(
                    $photo->path,//address img
                    $photo->path,//address save
                    120,// width: if width==0 -> width=auto
                    0// height: if height==0 -> height=auto
                // end optimaiz
                );
            }
            return redirect()->route('admin.customer.list')->with('flash_message', ' مشتری با موفقیت ایجاد شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ایجاد مشتری بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function edit($id)
    {
        $item = Custom::find($id);
        return view('admin.content.customer.edit', compact('item'), ['title1' => 'محتوا سایت', 'title2' => 'ویرایش مشتری']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:240',
            'photo' => 'nullable|image|mimes:png|max:5120',
        ],
            [
                'title.required' => 'لطفا خدمت را وارد کنید',
                'title.max' => 'عنوان  نباید بیشتر از 240 کاراکتر باشد',
                'photo.image' => 'لطفا یک تصویر انتخاب کنید',
                'photo.mimes' => 'لطفا یک تصویر با پسوندهای (png) انتخاب کنید',
                'photo.max' => 'لطفا حجم تصویر حداکثر 5 مگابایت باشد',
            ]);
        $item = Custom::find($id);
        try {
            $item->title = $request->title;
            $item->update();
            if ($request->hasFile('photo')) {
                if ($item->photo)
                {
                    $old_path = $item->photo->path;
                    File::delete($old_path);
                    $item->photo->delete();
                }
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/asset/uploads/customer/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $item->photo()->save($photo);
                img_resize(
                    $photo->path,//address img
                    $photo->path,//address save
                    120,// width: if width==0 -> width=auto
                    0// height: if height==0 -> height=auto
                // end optimaiz
                );
            }
            return redirect()->route('admin.customer.list')->with('flash_message', 'مشتری با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ویرایش مشتری بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function destroy($id)
    {
        $item = Custom::find($id);
        try {
            $item->delete();
            return redirect()->back()->with('flash_message', 'مشتری با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در حذف مشتری بوجود آمده،مجددا تلاش کنید');
        }
    }
    public function active($id, $type)
    {
        $item = Custom::find($id);
        try {
            $item->status = $type;
            $item->update();
            if ($type == 'pending') {
                return redirect()->back()->with('flash_message', 'مشتری با موفقیت غیرفعال شد.');
            }
            if ($type == 'active') {
                return redirect()->back()->with('flash_message', 'مشتری با موفقیت فعال شد.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در تغییر وضعیت پکیج خدمت بوجود آمده،مجددا تلاش کنید');
        }
    }

}


