<?php

namespace App\Http\Controllers\Admin;

use App\Model\StockPortfolio;
use App\Model\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockPortfolioCategoryController extends Controller {
    
    public function __construct() { $this->middleware('auth'); }

    public function controller_title($type) {
        if ($type == 'sum') {
            return 'دسته بندی های سبد سهام';
        } elseif ('single') {
            return 'دسته بندی سبد سهام';
        }
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function index() {
        $items = StockPortfolio::where('cat_id', null)->orderByDesc('id')->paginate($this->controller_paginate());
        return view('admin.stock-portfolio.category.index', compact('items'), ['title1' => $this->controller_title('sum') , 'title2' => $this->controller_title('single')]);
    }

    public function create() {
        return view('admin.stock-portfolio.category.create', ['title1' => ' افزودن '.$this->controller_title('sum') , 'title2' => $this->controller_title('single')]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:240',
            'slug'  => 'required|max:250',
            // 'text'  => 'required|max:2550',
        ]);

        try {
            $item = new StockPortfolio();
            $item->title    = $request->title;
            $item->slug     = $request->slug;
            $item->text     = $request->text;
            $item->save();
            return redirect()->route('admin.stock-portfolio-categories.index')->with('flash_message', 'با موفقیت ثبت شد.');
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function edit($id) {
        $item = StockPortfolio::findOrFail($id);
        return view('admin.stock-portfolio.category.edit', compact('item'), ['title1' => ' ویرایش '.$this->controller_title('sum') , 'title2' => $this->controller_title('single')]);
    }

    public function update(Request $request, $id) {
        $item = StockPortfolio::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|max:240',
            'slug'  => 'required|max:250',
            // 'text'  => 'required|max:2550',
        ]);

        try {
            $item->title    = $request->title;
            $item->slug     = $request->slug;
            $item->text     = $request->text;
            $item->status   = $request->status;
            $item->save();
            return redirect()->route('admin.stock-portfolio-categories.index')->with('flash_message', 'با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function sort(Request $request, $id) {
        $item = StockPortfolio::findOrFail($id);
        $this->validate($request, [
            'sort' => 'required|integer',
        ]);

        try {
            $item->sort = $request->sort;
            $item->save();
            return redirect()->route('admin.stock-portfolio-categories.index')->with('flash_message', 'با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function destroy($id) {
        StockPortfolio::findOrFail($id)->delete();
        return redirect()->back()->withInput()->with('flash_message',' با موفقیت حذف شد.');
    }

}
