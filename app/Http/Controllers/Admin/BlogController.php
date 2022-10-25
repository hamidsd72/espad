<?php

namespace App\Http\Controllers\Admin;

use App\Model\Post;
use App\Model\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function controller_paginate() {
        return Setting::select('paginate')->latest()->firstOrFail()->paginate;
    }
    // index
    public function index($type) {
        $items = Post::where('type',$type)->orderByDesc('id')->paginate($this->controller_paginate());
        return view('admin.blogs.index', compact('items','type'), ['title1' => $type , 'title2' => $type]);
    }
    // create
    public function show($id) {
        $type = $id;
        return view('admin.blogs.create',compact('type'), ['title1' => $id.' افزودن ', 'title2' => $id.' افزودن ']);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title'     => 'required|max:240',
            'slug'      => 'required|max:250',
            'short_text'=> 'required',
            'text'      => 'required',
            'photo'     => 'required',
        ]);
        if( Post::where('type',$request->type)->where('slug',$request->slug)->count() ) {
            return redirect()->back()->withInput()->with('flash_message', 'عنوان تکراری می باشد');
        }
        try {
            $item = new Post();
            $item->type             = $request->type;
            $item->title            = $request->title;
            $item->slug             = $request->slug;
            $item->short_text       = $request->short_text;
            $item->text             = $request->text;
            $item->writer           = auth()->user()->id;
            $item->titleseo         = $request->titleseo;
            $item->keywordsseo      = $request->keywordsseo;
            $item->descriptionseo   = $request->descriptionseo;
            if ($request->hasFile('photo')) {
                $item->photo = file_store($request->photo, 'source/asset/uploads/posts/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'post-');;
            }
            $item->save();
            return redirect()->route('admin.post.index.type',$item->type)->with('flash_message', 'با موفقیت ثبت شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function edit($id) {
        $item = Post::find($id);
        return view('admin.blogs.edit', compact('item'), ['title1' => $item->title , 'title2' => $item->title]);
    }

    // Update Function
    public function update(Request $request, $id)
    { 
        $item = Post::findOrFail($id);
        $this->validate($request, [
            'title'     => 'required|max:240',
            'slug'      => 'required|max:250',
            'short_text'=> 'required',
            'text'      => 'required',
        ]);

        if( Post::where('type',$item->type)->where('slug',$request->slug)->where('id','!=',$item->id)->count() ) {
            return redirect()->back()->withInput()->with('err_message', 'عنوان تکراری می باشد');
        }
        
        try {
            $item->title            = $request->title;
            $item->slug             = $request->slug;
            $item->short_text       = $request->short_text;
            $item->text             = $request->text;
            $item->writer           = auth()->user()->id;
            $item->titleseo         = $request->titleseo;
            $item->keywordsseo      = $request->keywordsseo;
            $item->descriptionseo   = $request->descriptionseo;
            if ($request->hasFile('photo')) {
                if ($item->photo) {
                    $old_path = $item->photo;
                    File::delete($old_path);
                }
                $item->photo = file_store($request->photo, 'source/asset/uploads/posts/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'post-');;
            }
            $item->save();
            return redirect()->route('admin.post.index.type',$item->type)->with('flash_message', 'با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'یک خطا رخ داده است، لطفا بررسی بفرمایید.');
        }
    }

    public function destroy($id) {
        Post::findOrFail($id)->delete();
        return redirect()->back()->withInput()->with('flash_message',' با موفقیت حذف شد.');
    }

    public function active($id) {
        $item = Post::findOrFail($id);
        if($item->status=='active') {
            $item->status='pending';
        } else {
            $item->status='active';
        }
        $item->update();
        return redirect()->back()->with('flash_message',' با موفقیت تغییر یافت.');
    }

}
