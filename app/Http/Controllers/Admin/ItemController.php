<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\Item;
use App\Model\ServiceCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ItemController extends Controller {
    public function controller_title($type) {
        if ($type == 'sum') {
            return 'آیتم های صفحه';
        } elseif ('single') {
            return 'آیتم صفحه';
        }
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $items = Item::orderByDesc('id')->paginate($this->controller_paginate());
        return view('admin.items.show', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function show($id) {
        $items = Item::where('page_name',$id)->orderByDesc('id')->paginate($this->controller_paginate());
        return view('admin.items.show', compact('id','items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function create($id=null) {
        return view('admin.items.create', compact('id'),['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'nullable|max:250',
            'link'  => 'nullable|max:250',
            'pic'   => 'nullable|max:250',
            'text'  => 'nullable|max:2500',
        ],
            [
                'title.max' => 'نام آیتم نباید بیشتر از 240 کاراکتر باشد',
                'link.max'  => 'لینک نباید بیشتر از 250 کاراکتر باشد',
                'pic.max'   => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
                'text.max'  => 'تکست اریا نباید بیشتر از 2500 کاراکتر باشد',
            ]);
        try {
            $item = new Item();
            $page_name = ServiceCat::where('slug',$request->page_name)->first('id');
            if ($page_name) {
                $item->page_id          = $page_name->id;
            }
            $item->page_name            = $request->page_name;
            $item->title                = $request->title;
            $item->text                 = $request->text;
            $item->section              = $request->section;
            $item->sort                 = $request->sort;
            $item->link                 = $request->link;
            $item->status               = $request->status;
            $item->last_modify_user_id  = auth()->user()->id;
            if ($request->hasFile('pic')) {
                $item->pic = file_store($request->pic, 'source/asset/uploads/item/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'pic_card-');
            }
            if ($request->hasFile('video')) {
                $item->video = file_store($request->video, 'source/asset/uploads/item/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'video_card-');
            }
            $item->save();
            return redirect()->route('admin.item.show',$request->page_name)->withInput()->with('flash_message', 'آیتم با موفقیت ایجاد شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ایجاد آیتم بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function edit($id) {
        $item = Item::find($id);
        return view('admin.items.edit', compact('item'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function update(Request $request, $sub_service) {
        $this->validate($request, [
            'title' => 'nullable|max:250',
            'link'  => 'nullable|max:250',
            'pic'   => 'nullable|max:250',
            'text'  => 'nullable|max:2500',
        ],
            [
                'title.max' => 'نام آیتم نباید بیشتر از 240 کاراکتر باشد',
                'link.max'  => 'لینک نباید بیشتر از 250 کاراکتر باشد',
                'pic.max'   => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
                'text.max'  => 'تکست اریا نباید بیشتر از 2500 کاراکتر باشد',
            ]);
        $item = Item::findOrFail($sub_service);
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
                $item->pic = file_store($request->pic, 'source/asset/uploads/item/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'pic_card-');
            }
            if ($request->hasFile('video')) {
                if ($item->video != null) {
                    File::delete($item->video);
                }
                $item->video = file_store($request->video, 'source/asset/uploads/item/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'video_card-');
            }
            $item->update();
            return redirect()->route('admin.item.show',$item->page_name)->withInput()->with('flash_message', 'موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ویرایش بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function destroy($id) {
        $item = Item::findOrFail($id);
        if ($item->pic != null) {
            File::delete($item->pic);
        }
        $item->delete();
        return redirect()->back()->withInput()->with('flash_message', 'آیتم با موفقیت حذف شد.');
    }
}

