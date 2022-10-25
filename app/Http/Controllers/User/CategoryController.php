<?php

namespace App\Http\Controllers\User;

use App\Model\About;
use App\User;
use App\Model\Slider;
use App\Model\Network;
use App\Model\ServiceCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller {

    public function index() {
        $items = ServiceCat::where('status', 'active')->where('type', 'service')->orderBy('sort')->get();
        return view('user.consultation.index',compact('items'));
    }

    public function show($id) {
        return view('user.categories.mali-va-borsi');
    }

    public function cat($slug) {
        return view('user.categories.mali-va-borsi', compact('slug'));
    }
}
