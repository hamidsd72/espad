<?php

namespace App\Http\Controllers\Admin;

use App\Model\JobOpportunity;
use App\Model\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JobOpportunitiesController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'موقعیت های شغلی';
        } elseif ('single') {
            return 'موقعیت های شغلی';
        }
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }
    // index
    public function index($type=null) {
        if ($type=='دسته') {
            $items = JobOpportunity::where('sub_cat_id','==',0)->orderByDesc('id')->paginate($this->controller_paginate());
        } else {
            $items = JobOpportunity::where('sub_cat_id','>',0)->orderByDesc('id')->paginate($this->controller_paginate());
        }
        return view('admin.jobOpportunity.index', compact('type','items'), ['title1' => $this->controller_title('single') , 'title2' => $this->controller_title('sum')]);
    }
    // create
    public function show($type) {
        return view('admin.jobOpportunity.show',compact('type'), ['title1' => ' افزودن ', 'title2' => ' افزودن ']);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title'         => 'required|max:240',
            'history'       => 'max:250',
            'education'     => 'max:250',
            'type'          => 'max:250',
            'amount'        => 'max:250',
            'address'       => 'max:250',
            'description'   => 'max:2500',
        ]);

        try {
            $item = new JobOpportunity();
            $item->title        = $request->title;
            $item->sub_cat_id   = $request->sub_cat_id?$request->sub_cat_id:0;
            $item->history      = $request->history;
            $item->education    = $request->education;
            $item->type         = $request->type;
            $item->amount       = $request->amount;
            $item->address      = $request->address;
            $item->description  = $request->description;
            if ($request->hasFile('attach')) {
                $item->attach = file_store($request->attach, 'source/asset/uploads/jobs/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/attach/', 'attachment-');
            }            
            $item->save();
            return redirect()->route('admin.job-opportunities.type',$request->type)->with('flash_message', 'با موفقیت ثبت شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function edit($id) {
        $item = JobOpportunity::find($id);
        return view('admin.jobOpportunity.edit', compact('item'), ['title1' => $item->title , 'title2' => $item->title]);
    }

    // Update Function
    public function update(Request $request, $id)
    { 
        $item = JobOpportunity::findOrFail($id);
        $type='موقعیت';
        if ( $item->sub_cat_id==0 ) {
            $type='دسته';
        }
        $this->validate($request, [
            'title'         => 'required|max:240',
            'history'       => 'max:250',
            'education'     => 'max:250',
            'type'          => 'max:250',
            'amount'        => 'max:250',
            'address'       => 'max:250',
            'description'   => 'max:2500',
        ]);

        try {
            $item->title        = $request->title;
            $item->history      = $request->history;
            $item->education    = $request->education;
            $item->type         = $request->type;
            $item->amount       = $request->amount;
            $item->address      = $request->address;
            $item->description  = $request->description;
            if ($request->hasFile('attach')) {
                if ($item->attach) {
                    $old_path   = $item->attach;
                    File::delete($old_path);
                    $item->attach->delete();
                }
                $item->attach = file_store($request->attach, 'source/asset/uploads/jobs/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/attach/', 'attachment-');
            }
            $item->save();
            return redirect()->route('admin.job-opportunities.type',$type)->with('flash_message', 'با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function destroy($id) {
        JobOpportunity::findOrFail($id)->delete();
        return redirect()->back()->withInput()->with('flash_message',' با موفقیت حذف شد.');
    }

    public function active($id) {
        $item = JobOpportunity::findOrFail($id);
        if($item->status=='active') {
            $item->status='pending';
        } else {
            $item->status='active';
        }
        $item->update();
        return redirect()->back()->with('flash_message',' با موفقیت تغییر یافت.');
    }

}
