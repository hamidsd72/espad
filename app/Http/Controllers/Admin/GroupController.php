<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class GroupController extends Controller {
    
    public function controller_title($type) {
        if ($type == 'sum') {
            return 'دسته بندی های گروه اوراق بهادار';
        } elseif ('single') {
            return 'دسته بندی های گروه اوراق بهادار';
        }
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $items = Group::orderByDesc('id')->paginate($this->controller_paginate());
        return view('admin.group.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function create() {
        return view('admin.group.create',['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:250',
            'slug'  => 'required|max:250',
        ],
            [
                'title.required' => 'نام دسته بندی واردنشده',
                'title.max'      => 'نام دسته بندی نباید بیشتر از 240 کاراکتر باشد',
                'slug.required' => 'اسلاگ دسته بندی واردنشده',
                'slug.max'      => 'اسلاگ دسته بندی نباید بیشتر از 240 کاراکتر باشد',
            ]);
        try {
            $item = new Group();
            $item->title = $request->title;
            $item->slug  = $request->slug;
            $item->save();
            return redirect()->route('admin.group.index')->with('flash_message', 'دسته بندی با موفقیت ایجاد شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ایجاد دسته بندی بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function edit($id) {
        $item = Group::find($id);
        return view('admin.group.edit', compact('item'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required|max:250',
            'slug'  => 'required|max:250',
        ],
            [
                'title.required' => 'نام دسته بندی واردنشده',
                'title.max'      => 'نام دسته بندی نباید بیشتر از 240 کاراکتر باشد',
                'slug.required' => 'اسلاگ دسته بندی واردنشده',
                'slug.max'      => 'اسلاگ دسته بندی نباید بیشتر از 240 کاراکتر باشد',
            ]);
        $item = Group::findOrFail($id);
        try {
            $item->title = $request->title;
            $item->slug  = $request->slug;
            $item->update();
            return redirect()->route('admin.group.index')->with('flash_message', 'موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشکلی در ویرایش بوجود آمده،مجددا تلاش کنید');
        }
    }

    public function destroy($id) {
        Group::findOrFail($id)->delete();
        return redirect()->back()->with('flash_message', 'دسته بندی با موفقیت حذف شد.');
    }
}


