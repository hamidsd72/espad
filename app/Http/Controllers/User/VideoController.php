<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Model\Setting;
use App\Model\ServiceCat;
use App\Model\Data;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'ویدیو ها';
        } elseif ('single') {
            return 'نمایش ویدیو ';
        }
    }

    public function controller_paginate()
    {
        $settings = Setting::select('paginate')->latest()->firstOrFail();
        return $settings->paginate;
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Data::orderByDesc('sort')->paginate($this->controller_paginate());
        return view('admin.data.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function show($id)
    {
        $item = Data::findOrFail($id);
        return view('admin.data.create', compact('item'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function update(Request $request, $sub_service)
    {
        $item = Data::findOrFail($sub_service);
        try {
            $item->title                = $request->title;
            $item->text                 = $request->text;
            $item->section              = $request->section;
            $item->sort                 = $request->sort;
            $item->link                 = $request->link;
            $item->status               = $request->status;
            $item->last_modify_user_id  = auth()->user()->id;
            if ($request->hasFile('pic')) {
                if ($item->pic != null) {
                    File::delete($item->pic);
                }
                $item->pic = file_store($request->pic, 'source/asset/uploads/data/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'pic_card-');
            }
            if ($request->hasFile('video')) {
                if ($item->video != null) {
                    File::delete($item->video);
                }
                $item->video = file_store($request->video, 'source/asset/uploads/data/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'video_card-');
            }
            $item->update();
            return redirect()->route('admin.data.show',$item->page_name)->withInput()->with('flash_message', 'موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ویرایش بوجود آمده،مجددا تلاش کنید');
        }
    }

}


