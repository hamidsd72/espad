<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Model\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function show()
    {
        $item=About::find(1);
        return view('user.about.show',compact('item'));
    }

}
