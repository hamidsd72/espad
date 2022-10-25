<?php

namespace App\Http\Controllers\User;

use App\Model\JobOpportunity;
use App\Http\Controllers\Controller;
use App\Model\Data;

class CooperationController extends Controller
{
    public function index($id = 1)
    {
        $items = JobOpportunity::where('status','active')->where('sub_cat_id', 0)->get(['id','title']);
        $sub_items = JobOpportunity::where('status','active')->where('sub_cat_id', '!=', 0)->get();
        $body = Data::where('page_name','دعوت-به-همکاری')->get();
        return view('user.cooperation.index', compact('items','body','sub_items','id'));
    }

    public function show($id)
    {
        $items = JobOpportunity::where('status','active')->where('sub_cat_id', 0)->get(['id','title']);
        $sub_items = JobOpportunity::where('status','active')->where('sub_cat_id', '!=', 0)->get();
        $body = Data::where('page_name','دعوت-به-همکاری')->get();
        return view('user.cooperation.index', compact('items','body','sub_items','id'));
    }

}
