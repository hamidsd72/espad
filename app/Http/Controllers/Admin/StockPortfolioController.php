<?php

namespace App\Http\Controllers\Admin;

use App\Model\StockPortfolio;
use App\Model\StockPortfolioItem;
use App\Model\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StockPortfolioController extends Controller {
    
    public function __construct() { $this->middleware('auth'); }

    public function controller_title($type) {
        if ($type == 'sum') {
            return 'آیتم های سبد سهام';
        } elseif ('single') {
            return 'آیتم سبد سهام';
        }
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }

    public function index() {
        $items = StockPortfolio::where('cat_id', '!=', null)->orderByDesc('id')->paginate($this->controller_paginate());
        return view('admin.stock-portfolio.index', compact('items'), ['title1' => $this->controller_title('sum') , 'title2' => $this->controller_title('single')]);
    }

    public function show($id) {
        $items = StockPortfolio::where('cat_id',$id)->orderByDesc('id')->paginate($this->controller_paginate());
        return view('admin.stock-portfolio.index', compact('items','id'), ['title1' => $this->controller_title('sum') , 'title2' => $this->controller_title('single')]);
    }

    public function create($id) {   
        $item = StockPortfolio::where('cat_id',null)->findOrFail($id);
        return view('admin.stock-portfolio.create', compact('id'), ['title1' => ' افزودن '.$this->controller_title('sum').' -> '.$item->title , 'title2' => $this->controller_title('single')]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title'     => 'required|max:240',
            'slug'      => 'required|max:250',
            'text'      => 'required',
        ]);

        try {
            $item = new StockPortfolio();
            $item->cat_id           = $request->cat_id;
            $item->title            = $request->title;
            $item->slug             = $request->slug;
            $item->text             = $request->text;
            $item->writer           = $request->writer?$request->writer:'ادمین سایت';
            $item->short_text       = $request->short_text;
            if ($request->hasFile('photo')) $item->photo = file_store($request->photo, 'source/asset/uploads/stock-portfolio/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
            if ($request->hasFile('video')) $item->video = file_store($request->video, 'source/asset/uploads/stock-portfolio/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/videos/', 'video_card-');
            if ($request->hasFile('file')) $item->file = file_store($request->file, 'source/asset/uploads/stock-portfolio/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/files/', 'attach-');
            $item->save();
            return redirect()->route('admin.stock-portfolio.show',$request->cat_id)->with('flash_message', 'با موفقیت ثبت شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function edit($id) {
        $item = StockPortfolio::findOrFail($id);
        return view('admin.stock-portfolio.edit', compact('item'), ['title1' => ' ویرایش '.$this->controller_title('sum') , 'title2' => $this->controller_title('single')]);
    }

    public function update(Request $request, $id) {
        $item = StockPortfolio::findOrFail($id);
        $this->validate($request, [
            'title'     => 'required|max:240',
            'slug'      => 'required|max:250',
            'text'      => 'required',
        ]);

        try {
            $item->title            = $request->title;
            $item->slug             = $request->slug;
            $item->text             = $request->text;
            $item->status           = $request->status;
            $item->writer           = $request->writer?$request->writer:'ادمین سایت';
            $item->short_text       = $request->short_text;
            if ($request->hasFile('photo')) {
                if ($item->photo) File::delete($item->photo);
                $item->photo = file_store($request->photo, 'source/asset/uploads/stock-portfolio/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
            }
            if ($request->hasFile('video')) {
                if ($item->video) File::delete($item->video);
                $item->video = file_store($request->video, 'source/asset/uploads/stock-portfolio/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/videos/', 'video_card-');
            }
            if ($request->hasFile('file')) {
                $item->file_title = $request->file_title;
                if ($item->file) File::delete($item->file);
                $item->file = file_store($request->file, 'source/asset/uploads/stock-portfolio/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/files/', 'attach-');
            }
            $item->save();

            $items  = $item->children;
            foreach ($items as $children) {
                $txt            = 'text'.$children->id;
                $children->text = $request->$txt;
                $children->update();
            }
            
            if ( $request->new_text != null ) {
                StockPortfolioItem::create([
                    'item_id'   => $item->id,
                    'text'      => $request->new_text,
                ]);
            }
            return redirect()->route('admin.stock-portfolio.show',$item->cat_id)->with('flash_message', 'با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function destroy($id) {
        $item = StockPortfolio::findOrFail($id);
        foreach ($item->children as $children) $children->delete();
        if ($item->photo) File::delete($item->photo->path);
        if ($item->video) File::delete($item->video);
        if ($item->file) File::delete($item->file);
        $item->delete();
        return redirect()->back()->withInput()->with('flash_message',' با موفقیت حذف شد.');
    }

    public function children_destroy($id) {
        $item = StockPortfolioItem::findOrFail($id);
        $item->delete();
        return redirect()->back()->withInput()->with('flash_message',' با موفقیت حذف شد.');
    }

    public function active($id) {
        $item = StockPortfolio::findOrFail($id);
        if($item->status=='active') $item->status='pending';
        else $item->status='active';
        $item->update();
        return redirect()->back()->with('flash_message',' با موفقیت تغییر یافت.');
    }

}
