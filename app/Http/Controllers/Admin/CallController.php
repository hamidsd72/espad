<?php

namespace App\Http\Controllers\Admin;

use App\Model\CallRequest;
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
        $items = CallRequest::orderByDesc('id');
        if(auth()->user()->hasRole('مدرس')) {
            $items = $items->where('consultant_id',auth()->id());
        }
        $items = $items->paginate( $this->controller_paginate() );
        return view('admin.call.index', compact('items'), ['title1' => $this->controller_title('single'), 'title2' => $this->controller_title('sum')]);
    }

}


