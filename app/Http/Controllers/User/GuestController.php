<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Model\Slider;
use App\Model\ServiceCat;
use App\Model\Network;
use App\Model\Data;
use App\Model\Setting;

class GuestController extends Controller {
    public function index() {
        // if (auth()->user()) {
        //     return redirect()->route('user.index');
        // }
        $setting        = Setting::first();
        $serviceCats    = ServiceCat::where('status', 'active')->where('type', 'service')->orderBy('sort')->get();
        $SubServices    = ServiceCat::where('status', 'active')->whereIn('service_id', $serviceCats->pluck('id') )->where('type','sub_service')->get();
        $sliders        = Slider::whereIn('status', ['in_home','in_all'])->orderBy('sort')->get();
        $network        = Network::where('status', 'active')->orderBy('sort')->get();
        $data           = Data::where('page_name','اصلی')->where('status','active')->orderBy('sort')->get();
        return view('user.website.home', compact('setting','serviceCats','SubServices','sliders','network','data'));
        // return view('auth.register');
    }

    public function app() {
        if (auth()->user()) {
            return redirect()->route('user.index');
        }
        return view('auth.register');
    }

    public function create() {
        if (auth()->user()) {
            return redirect()->route('user.index');
        }

        $show_modal = true;
        return view('auth.register1', compact('show_modal'));
    }
}