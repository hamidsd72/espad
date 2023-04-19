<?php

namespace App\Http\Controllers\Admin;

use App\Model\CallRequest;
use App\Model\NewCallRequest;
use App\Model\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CallController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return ' تماس های مشاوره';
        } elseif ('single') {
            return ' بخش مشاوران';
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
        if(auth()->user()->hasRole('مدرس')) {
            $items = NewCallRequest::where('consultant_id',auth()->id())->orderBy('status');
        } elseif(auth()->user()->hasRole('کاربر')) {
            $items = NewCallRequest::where('user_id',auth()->id())->orderBy('status');
        } elseif(auth()->user()->hasRole('مدیر')) {
            $items = NewCallRequest::orderBy('status');
        } else {
            return false;
        }
        $items = $items->paginate( $this->controller_paginate() );
        return view('admin.call.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

}


